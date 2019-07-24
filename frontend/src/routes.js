import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter);
import test from  './components/test.vue'

import loginPage from  './components/loginPage.vue'
import home from  './components/home.vue'
import registerPage from  './components/registerPage.vue'
import profile from  './components/profile.vue'
import adminPanel from './components/admin/adminPanel'
import manageUsers from './components/admin/manageUsers'
import manageProducts from './components/admin/manageProducts'
import manageOrders from './components/admin/manageOrders'
import manageReports from './components/admin/reports'
import manageSlideshow from './components/adminEditor/manageSlideshow'
import manageCategory from './components/adminEditor/manageCategory'
import manageLotQuantity from './components/adminEditor/manageLotQuantity'
import products from  './components/products'
import check from  './components/check'
import cartView from  './components/cartView'


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

    scrollBehavior() {
      return { x: 0, y: 0 };
    },

  

    

    
    routes:[
      
        {path:"/",component:home},
        {path:"/loginPage",beforeEnter: ShouldSkip,component:loginPage},
        {path:"/registerPage",beforeEnter: ShouldSkip,component:registerPage},
        {path:"/home",component:home},
        {path:"/category/:id",component:products},
        {path:"/check",component:check},
        {path:"/cartView",component:cartView},
        {path:"/profile",component:profile,meta:{requireAuth:true}},
        {path:"/admin",component:adminPanel,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/products",component:manageProducts,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/users",component:manageUsers,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/orders",component:manageOrders,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/reports",component:manageReports,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/slideshow",component:manageSlideshow,meta:{requireAuth:true,roles: ['admin','editor']}},
        {path:"/admin/category",component:manageCategory,meta:{requireAuth:true,roles: ['admin','editor']}},
        {path:"/admin/lotQuantity",component:manageLotQuantity,meta:{requireAuth:true,roles: ['admin','editor']}},
        {path:"*",component:test},
    ],



});



router.beforeEach((to, from, next) => {
//console.log(Store.getters.role);
if(to.meta.requireAuth){
    if(localStorage.getItem('token')){
        if(to.meta.roles){
        if (to.meta.roles.includes(Store.getters.role)) {
            next();    
        }else{
            
            next('home');    
        }
    }
    }else{
       
        next('./loginPage');  
    }
    
    }
    next();  
   
 }
 );


/*
const isLocalhost = Boolean(
    window.location.hostname === 'localhost' ||
    // [::1] is the IPv6 localhost address.
    window.location.hostname === '[::1]' ||
    // 127.0.0.1/8 is considered localhost for IPv4.
    window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/)
  )

  */
router.onReady(() => {
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script',`https://www.google-analytics.com/analytics.js`,'ga')
  
    ga('create', 'UA-139706203-1','auto')
    
    // Prevent any hits from being sent to Google Analytics
  /*  if (isLocalhost) {
      ga('set', 'sendHitTask', null)
    }
  */
    router.afterEach((to, from) => {
      ga('set', 'page', to.fullPath)
      ga('send', 'pageview')
    })
  })

  



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