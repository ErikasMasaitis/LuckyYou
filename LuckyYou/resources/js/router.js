import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import Games from './pages/Games';
import Users from './pages/Users';
import NotFound from './pages/NotFound';
import Profile from './pages/Profile';
import Achievements from './pages/Achievements';
import MyAchievements from './pages/MyAchievements';
import History from './pages/History';
import UserHistory from './pages/UserHistory';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '*',
            name: 'notfound',
            component: NotFound
        },
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/games/:id',
            name: 'games',
            component: Games
        },
        {
            path: '/users',
            name: 'users',
            component: Users
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile
        },
        {
            path: '/achievements',
            name: 'achievements',
            component: Achievements
        },
        {
            path: '/user-achievements',
            name: 'Myachievements',
            component: MyAchievements
        },
        {
            path: '/history',
            name: 'history',
            component: History
        },
        {
            path: '/userhistory',
            name: 'userhistory',
            component: UserHistory
        },
    ]
});

export default router;
