import {createRouter, createWebHistory } from "vue-router";
//Import VUE files in js folder
const Ranking = () => import('../src/Ranking.vue');

//import components for users and games
const Login = () => import('../src/users/login.vue');
const Register = () => import('../src/users/register.vue');
const Admin = () => import('../src/users/admin.vue');
const UpdateName = () => import('../src/users/updateName.vue');

const Games = () => import('../src/games/games.vue');

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
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
        path: '/admin',
        name: 'admin',
        component: Admin
    },
    {
        path: '/edit',
        name: 'updateName',
        component: UpdateName
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;