<template>
    <div class=" header flex">
        <img class="rounded-md m-3" src="/img/logo.png" width="75" alt="Logo">
        <router-link to="/" >Logout</router-link> |
        <router-link to="/games">Home</router-link> |
        <router-link to="/ranking">Ranking</router-link>
    </div>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style scoped>
.header {
    background: linear-gradient(to right, #550A21, black);
    color: black;
}
</style>