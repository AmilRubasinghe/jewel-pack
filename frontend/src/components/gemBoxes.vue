<template>
 <div id="app">
  <v-app id="inspire">
    <v-layout>
      <v-flex xs8 offset-xs2 sm6 offset-sm3 md4 offset-md4>
        <br>
        <v-card>
          <v-img
            contain
            class="white--text"
            height="300px"
            src="https://pngimg.com/uploads/men_shoes/men_shoes_PNG7475.png"
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
              <span class="title blue--text">{{name}}</span><br>
              <v-rating readonly small dense background-color="orange" color="orange" v-model="rating"></v-rating>
              <span class="title"> ${{display_price}}</span> &nbsp <del class=""> ${{price}}</del>
            </div>
          </v-card-title>
          <v-card-actions>
            <v-btn large round depressed :color="color" class="mx-auto" @click="colchange">ADD TO CART</v-btn>
            
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
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


