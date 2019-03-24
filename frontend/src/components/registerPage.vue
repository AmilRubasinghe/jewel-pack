<template>
    <div>
    <div class="container box">
   <form @submit.prevent='registerUser'>



        <h1 align="center">Register</h1>
        <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" v-validate="'required'" v-model="register.firstname">
            <div v-show="errors.has('firstname')" class="help block alert alert-danger">
                    {{ errors.first('firstname') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" v-validate="'required'" v-model="register.lastname">
            <div v-show="errors.has('lastname')" class="help block alert alert-danger">
                    {{ errors.first('lastname') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" v-validate="'required|email'" v-model="register.email">
            <div v-show="errors.has('email')" class="help block alert alert-danger">
                    {{ errors.first('email') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <input type="password" class="form-control" id="password" placeholder="password" name="password" v-validate="'required'" v-model="register.password">
            <div v-show="errors.has('password')" class="help block alert alert-danger">
                    {{ errors.first('password') }}
            </div>
        </div>



        <div class="form-group form-group-lg">
            <input type="password" class="form-control" id="confirm_password" placeholder="confirm password" name="confirm_password" v-validate="'required'" v-model="register.confirm_password">
            <div v-show="errors.has('confirm_password')" class="help block alert alert-danger">
                    {{ errors.first('confirm_password') }}
            </div>
        </div>


        <div class="form-group form-group-lg">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>

        </div>

    </form>
    </div>
    </div>
</template>



<script>


export default{
    data(){
        return{
            register:{
                firstname:"",
                lastname:"",
                email:"",
                password:"",
                confirm_password:""
            }
        }
    },

    methods:{
        registerUser(){

            this.$validator.validateAll()
            if (!this.errors.any()) {
                 this.$http.post('http://localhost:8000/api/register',this.register)
                .then(response=>{
                    console.log("Done");
                    console.log(response);
                    alert('You would have received a verification email with link. Please click it!');
                    this.$router.push('/loginPage');
                })
                .catch(error=>{
                    console.log(error.response);
                    console.log("ERROR");
                })
            }

           
        }
    }

}

</script>