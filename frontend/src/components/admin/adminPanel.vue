<template>
  <div>
    <v-container>
      <v-layout justify-center>
        <v-flex xs12 sm12>
          <v-card>
            <v-container fluid grid-list-md>
              <v-layout row wrap>
                <v-flex
                  v-for="card in cards"
                  :key="card.title"
                  v-bind="{ [`xs${card.flex}`]: true }"
                >
                  <v-hover>
                    <v-card
                      class="clickable"
                      :to="'admin/'+card.path"
                      slot-scope="{ hover }"
                      :class="`elevation-${hover ? 12 : 2}`"
                    >
                      <v-img :src="card.src" height="200px" :aspect-ratio="16/9"></v-img>
                      <v-card-title>
                        <div>
                          <span :class="card.class" v-text="card.title" class="headline"></span>
                        </div>
                      </v-card-title>
                    </v-card>
                  </v-hover>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
<script>
import navDrawer from "./navDrawer.vue";
export default {
  data: () => ({
    cards: [
      {
        title: "User Managment",
        src:
          "https://images.unsplash.com/photo-1526656001029-20a71b17f7ba?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=sear-greyson-671095-unsplash.jpg",
        flex: 4,
        class: "headline black--text",
        path: "users"
      },
      {
        title: "Orders Managment",
        src:
          "https://images.unsplash.com/photo-1509315703195-529879416a7d?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=micheile-henderson-429781-unsplash.jpg",
        flex: 4,
        class: "headline black--text",
        path: "orders"
      },
      {
        title: "Products Managment",
        src:
          "https://images.unsplash.com/photo-1465820909510-5aa8bb14978f?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=clem-onojeghuo-101915-unsplash.jpg",
        flex: 4,
        class: "headline black--text",
        path: "products"
      },
      {
        title: "Category Managment",
        src:
          "https://images.unsplash.com/photo-1465820909510-5aa8bb14978f?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&dl=clem-onojeghuo-101915-unsplash.jpg",
        flex: 4,
        class: "headline black--text",
        path: "category"
      }
    ]
  }),

  components: {
    navDrawer
  }
};
</script> 