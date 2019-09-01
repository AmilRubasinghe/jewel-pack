<template>
    <div id="app">
    <v-app id="inspire">
    <v-form v-model="valid" ref="form">
    <v-text-field
      label="First Name"
      v-model="firstname"
      :rules="nameRules"
      :counter="50"
      required
      box
    ></v-text-field>
    <v-text-field
      label="Last Name"
      v-model="lastname"
      :rules="nameRules"
      :counter="50"
      required
      box
    ></v-text-field>
    <v-text-field
      label="E-mail"
      v-model="email"
      :rules="emailRules"
      required
      box
    ></v-text-field>
     <v-text-field
      label="Contact No"
      v-model="phone"
      :rules="PhoneRules"
      required
      box
    ></v-text-field>
    <v-text-field
      label="Postal Code"
      v-model="postalcode"
      :rules="codeRules"
      required
      box
    ></v-text-field>
     <v-text-field
      label="Delivery Address"
      v-model="address"
      :rules="AddressRules"
      required
      box
    ></v-text-field>

    <v-btn @click="submit" :class="{ red: !valid, yellow: valid }">submit</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </v-form>
  </v-app>
</div>
</template>

<script>
export default {
     el: '#app',
    data(){
        return {
        valid: false,
        name: 'Default',
        nameRules: [
          (v) => !!v || 'Name is required',
          (v) => v && v.length <= 50 || 'Name must be less than 20 characters'
        ],
        email: '',
        emailRules: [
          (v) => !!v || 'E-mail is required',
          (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        phone:'',
        PhoneRules:[
             (v) => !!v || 'Contact No is required',
             (v) => v && v.length == 10 || 'Phone must be valid',
             (v) => /^\d{10}$/.test(v) || 'Phone number should only contains numbers'
            
        ],
        postalcode:'',
        codeRules:[
            (v) => !!v || 'Postal code is required',
            (v) => /^[0-9]{5}(?:-[0-9]{4})?$/.test(v) || 'Postal Code should be valid'
        ],

        address:'',
        AddressRules:[
             (v) => !!v || 'Address is required',
        ]
      }
    },

    methods: {
      submit () {
        this.$refs.form.validate()
      },
      clear () {
        this.$refs.form.reset()
      }
    }
}
</script>

