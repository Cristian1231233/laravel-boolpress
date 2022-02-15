import Vue from "vue";
import VueRouter from "vue-router";
// import { component } from "vue/types/umd";

// importo i vari componenti
import Home from './components/pages/Home'
import About from './components/pages/About'
import Contacts from './components/pages/Contacts'
import Posts from './components/pages/Posts'
import PostDetail from './components/pages/PostDetail'

Vue.use(VueRouter);
// inizializzo la classe del router che contiene tutte le rotte

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: About
        },
        {
            path: '/contatti',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/blog',
            name: 'blog',
            component: Posts
        },
        {
            path: '/detail/:slug',
            name: 'detail',
            component: PostDetail
        },
    ]
});

// esporto la classe router
export default router;