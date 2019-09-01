<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-bottom justify-center>
          <v-flex xs12 sm8 md8 v-for="i in 2" :key="`6${i}`" xs6></v-flex>
          <v-flex xs12 sm8 md8 xs6>
            <v-card class="elevation-10">
              <v-toolbar color="bg-info" dark flat>
                <v-toolbar-title class="tertiary--text font-weight-light">Contact us</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Full Name"
                    name="Full Name"
                    prepend-icon="person"
                    type="text"
                  ></v-text-field>
                  <v-text-field label="Email" name="Email" prepend-icon="email" type="email"></v-text-field>

                  <v-textarea
                    class="purple-input"
                    label="Message"
                    prepend-icon="message"
                    type="text"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn>Send Message</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>
