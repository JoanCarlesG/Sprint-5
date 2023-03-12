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

//OK    *ADMIN* GET /players: retorna el llistat de tots els jugadors/es del sistema amb el seu percentatge mitjà d’èxits 
//OK    POST /players : crea un jugador/a.
//OK    PUT /players/{id} : modifica el nom del jugador/a.
//OK   GET /players/{id}/games: retorna el llistat de jugades per un jugador/a.
//OK   POST /players/{id}/games/ : un jugador/a específic realitza una tirada dels daus.
//OK    DELETE /players/{id}/games: elimina les tirades del jugador/a.
//*ADMIN* GET /players/ranking: retorna el rànquing mitjà de tots els jugadors/es del sistema. És a dir, el percentatge mitjà d’èxits.
//*ADMIN* GET /players/ranking/loser: retorna el jugador/a amb pitjor percentatge d’èxit.
//*ADMIN* GET /players/ranking/winner: retorna el jugador/a amb millor percentatge d’èxit.