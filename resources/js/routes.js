import {createRouter, createWebHistory } from "vue-router";
//Import VUE files in js folder
const Home = () => import('../src/Home.vue');
const Ranking = () => import('../src/Ranking.vue');

//import components for users and games
const Login = () => import('../src/users/login.vue');
const Register = () => import('../src/users/register.vue');

const Games = () => import('../src/games/games.vue');
const Create = () => import('../src/games/create.vue');

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/ranking',
        name: 'ranking',
        component: Ranking
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/games',
        name: 'showGames',
        component: Games
    },
    {
        path: '/games/create',
        name: 'newGame',
        component: Create
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;