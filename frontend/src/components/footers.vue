 


 <template>
  <v-footer v-bind="localAttrs" :padless="padless">
    
    <v-card flat tile width="100%" class="grey darken-4 text-center">
      <v-container>
      <v-card-text>
        <v-layout column>
          <v-flex d-flex>
            <v-layout row wrap justify-center>
              <v-flex xs10 sm9 md9>
                <v-btn
                  v-for="link in links"
                  color="grey darken-3"
                  text
                  rounded
                  class="my-2"
                  :key="link.title"
                  :to="link.path"
                >
                  <v-list-tile-content>
                    <v-list-tile-title class="text-center">{{ link.title }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-btn>
              </v-flex>
            </v-layout>
          </v-flex>
          <v-flex d-flex>
            <v-layout row wrap justify-center>
              <v-flex xs10 sm6 md6>
                <v-btn v-for="icon in icons" :key="icon.icon" class="mx-4" icon :to="icon.link">
                  <v-icon size="24px" color="#616161">{{ icon.icon }}</v-icon>
                </v-btn>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-card-text>

      <v-divider  color="#757575"></v-divider>

      <v-card-text class="grey darken-4 body-2">
        <strong>
          <p class="caption" style="color:#757575; align:center;">
            <center>Copy right &copy; {{ new Date().getFullYear() }} web desing Srilanka</center>
          </p>
          <p class="caption"  style="color:#757575; align:center;">
            All rights design reserved design by
            <span
              class="red--text body-2 overline"
            >T E A M SPATA</span>
          </p>
        </strong>
      </v-card-text>
      </v-container>
    </v-card>
    
  </v-footer>
</template>
 

<script>
export default {
  data: () => ({
    links: [
      { title: "HOME", path: "home" },

      { title: "Cart", path: "cartView" },
      { title: "My Account", path: "profile" },

      { title: "About Us", path: "" },
      { title: "Contact Us", path: "contact" }
    ],
    icons: [
      {
        icon: "fab fa-facebook",
        link:
          "'https://www.facebook.com/jewelpackcompany/?__tn__=%2Cd%2CP-R&eid=ARDttFCuVtyeoBG_oePhv14EJYivkmMFPfZXD0Vop2gVfm4oqobUUDsR2TaNwAolFqTH6-4BkZWx9UwW'"
      },
      { icon: "fab fa-twitter", path: "orders" },
      { icon: "fab fa-google-plus", path: "orders" }
    ],

    items: ["default", "absolute", "fixed"],
    padless: false,
    variant: "default"
  }),
  computed: {
    localAttrs() {
      const attrs = {};

      if (this.variant === "default") {
        attrs.absolute = false;
        attrs.fixed = false;
      } else {
        attrs[this.variant] = true;
      }
      return attrs;
    }
  }
};
</script>




      <style>
.grey.darken-4.text-center.v-card.v-card--flat.v-sheet.v-sheet--tile.theme--light {
  margin-top: auto;
  margin-top: 250px;
}
footer.v-footer.theme--light {
  margin-top: 65px;
}
</style>