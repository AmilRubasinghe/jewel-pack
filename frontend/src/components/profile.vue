 

<template>


 

 <v-container grid-list-md text-xs-center>

    <v-layout row wrap>

   

 

   <v-flex

        xs12

        md4

      >

     

          <v-avatar

            slot="offset"

            class="mx-auto d-block"

            size="150"

          >

            <img

              src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"

            >

          </v-avatar>

         

          <v-card-text class="text-xs-center">

            <h6 class="category text-gray font-weight-thin mb-3">CEO / CO-FOUNDER</h6>

            <h4 class="card-title font-weight-light">Alec Thompson</h4>

            <p class="card-description font-weight-light">Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>

            <v-btn

              color="success"

              round

              class="font-weight-light"

            >Follow</v-btn>

          </v-card-text>

       

    

</v-flex>

 

<v-flex

        xs12

        md8

       

      >

  <form>

    <v-text-field

      v-validate="'required|max:10'"

      :counter="10"

      :error-messages="errors.collect('name')"

      label="Name"

      data-vv-name="name"

      required

    ></v-text-field>

    <v-text-field

      v-validate="'required|email'"

      :error-messages="errors.collect('email')"

      label="E-mail"

      data-vv-name="email"

      required

    ></v-text-field>

    <v-select

      v-validate="'required'"

      :error-messages="errors.collect('select')"

      label="Select"

      data-vv-name="select"

      required

    ></v-select>

   

 

    <v-btn>submit</v-btn>

    <v-btn>clear</v-btn>

  </form>

</v-flex>

    </v-layout>

  </v-container>

</template>

 

<script>

export default {

  //

}

</script>

 