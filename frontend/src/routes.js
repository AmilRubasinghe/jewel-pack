import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter);
import loginPage from  './components/loginPage.vue'
import home from  './components/home.vue'
import registerPage from  './components/registerPage.vue'
import profile from  './components/profile.vue'
import adminPanel from './components/admin/adminPanel'
import manageUsers from './components/admin/manageUsers'
import manageProducts from './components/admin/manageProducts'
import Store from './store.js'
import { mapState } from 'vuex'

function guard(to, from, next){
    if(localStorage.getItem('token')) {
        // or however you store your logged in state
        next(); // allow to enter route
    } else{
        next('/loginPage'); // go to '/login';
    }
}

function ShouldSkip(to, from, next){
    if(localStorage.getItem('token')) {
        // or however you store your logged in state
        next('/profile'); // allow to enter route
    } else{
        next(); // go to '/login';
    }
}
function signout(){
    this.logout;
}


const router = new VueRouter({
    mode:'history',
    routes:[
        {path:"/",component:home},
        {path:"/loginPage",beforeEnter: ShouldSkip,component:loginPage},
        {path:"/registerPage",beforeEnter: ShouldSkip,component:registerPage},
        {path:"/home",component:home},
        {path:"/profile",component:profile,meta:{requireAuth:true}},
        {path:"/admin",component:adminPanel,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/products",component:manageProducts},
        {path:"/admin/users",component:manageUsers},
        {path:"/logout",beforeEnter:signout,component:home},
    ],



});



router.beforeEach((to, from, next) => {
console.log(Store.getters.role);
if(to.meta.requireAuth){
    if(localStorage.getItem('token')){
        if(to.meta.roles){
        if (to.meta.roles.includes(Store.getters.role)) {
            next();    
        }else{
            
            next('./home');    
        }
    }
    }else{
       
        next('./loginPage');  
    }
    
    }
    next();  
   
 }
 )

export  default router
/*
if(to.meta.requireAuth&&Store.getters.user){
    if (to.meta.roles.includes(Store.getters.user)) {
        console.log("includes working")
        next();    
    }
    }
switch (Store.getters.role) {
    case 'user':
      next({
        name: '/home'
      })
      break;
    case 'admin':
      next({
        name: '.'
      })
      break;
    default:
      next({
        name: 'UserHome'
     })
  }*/