import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter);
import loginPage from  './components/loginPage.vue'
import home from  './components/home.vue'
import registerPage from  './components/registerPage.vue'
import profile from  './components/profile.vue'


function guard(to, from, next){
    if(localStorage.getItem('token')) {
        // or however you store your logged in state
        next(); // allow to enter route
    } else{
        next('/loginPage'); // go to '/login';
    }
}


const router = new VueRouter({
    mode:'history',
    routes:[
        {path:"/loginPage",component:loginPage},
        {path:"/registerPage",component:registerPage},
        {path:"/home",component:home},
        {path:"/profile", beforeEnter: guard,component:profile},
    ]


});


export  default router

