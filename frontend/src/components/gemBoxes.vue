<template>
  <div id="app">
    <v-app id="inspire">
<v-container grid-list-md text-xs-center>
    <v-layout row wrap>
     <v-flex v-for="i in 4" :key="`4${i}`" xs4>
        
          <br>
          <v-card>
            <v-img
              contain
              class="white--text"
              height="300px"
              align="center"
              src="https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-9/21769_1621551491424089_7080591978003687507_n.jpg?_nc_cat=104&_nc_ht=scontent.fcmb3-1.fna&oh=7631784490175ca34439f3123b6b441d&oe=5D66A8DA"
            >
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox>
                    <!--                   <span class="headline"></span> -->
                  </v-flex>
                </v-layout>
              </v-container>
            </v-img>
            <v-card-title>
              <div class="mx-5">
                <span class="title blue--text">2x2 White Colour Box</span>
                <br>
                <v-rating
                  readonly
                  small
                  dense
                  background-color="orange"
                  color="orange"
                  v-model="rating"
                ></v-rating>
                <span class="title">
                  <v-btn large color="info">$40</v-btn>
                </span> &nbsp
                <del class>
                  <v-btn disabled>$50</v-btn>
                </del>
              </div>
            </v-card-title>
            <v-card-actions>
              <v-btn
                large
                round
                depressed 
                :color="warning"
                class="mx-auto"
                @click="colchange"
              >ADD TO CART</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
      </v-container>
    </v-app>
  </div>


  

</template>
<style>
h1.entry-title {
  font-size: 2em;
  margin: 0.67em 0;
  color: #555;
  display: block;
}

.product-search {
  padding: 10px;
  color: #bd9ddb;
  padding-color: #7f74bb;
  /*border:1px solid;*/
  background-color: #c2c2c6;
}

article.product-default-article {
  padding: 30px;
  background-color: #efefef;
  border: 1px solid;
}

.second-search {
  padding-bottom: 20px;
}

.product-sidebar {
  width: 31.5%;
  display: block;
  border: 2px solid;
  float: left;
  border-block-color: black;
}
</style>

<script>
export default {};
</script>


