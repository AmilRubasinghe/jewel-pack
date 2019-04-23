<template>
<v-navigation-drawer permanent class="blue lighten-1" dark>
    <v-list>
      <v-list-tile v-for="item in items" :key="item.title" :to="{path: '/admin/' + item.path}">
        <v-list-tile-action>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
      
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default{
 data () {
      return {
        items: [
          { title: 'Dashboard', icon: 'dashboard' ,path:'' },
          { title: 'Users', icon: 'supervised_user_circle' ,path:'users' },
          { title: 'Orders', icon: 'library_books' , path:'orders'},
          { title: 'Products', icon: 'business_center' , path:'products'},
          { title: 'Category', icon: 'reorder' , path:'category'},
          { title: 'Reports', icon: 'file_copy' , path:'reports'},
          { title: 'Slide Show', icon: 'photo_library' , path:'slideshow'},
        ]
      }
    }
}
</script>


