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
import manageOrders from './components/admin/manageOrders'
import manageReports from './components/admin/reports'
import manageSlideshow from './components/adminEditor/manageSlideshow'
import manageCategory from './components/adminEditor/manageCategory'
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
        {path:"/admin/products",component:manageProducts,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/users",component:manageUsers,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/orders",component:manageOrders,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/reports",component:manageReports,meta:{requireAuth:true,roles: ['admin']}},
        {path:"/admin/slideshow",component:manageSlideshow,meta:{requireAuth:true,roles: ['admin','editor']}},
        {path:"/admin/category",component:manageCategory,meta:{requireAuth:true,roles: ['admin','editor']}},
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
 router.afterEach(( to, from ) => {
     console.log("GA ran");
    ga('set', 'page', to.path);
    ga('send', 'pageview');
  });
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