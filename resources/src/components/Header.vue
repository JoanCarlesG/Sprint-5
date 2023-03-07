<template>
    <h1 class="p-4">Welcome Page from Vue</h1>
    <div class="p-4">
        <router-link to="/">Logout</router-link> |
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
    h1, div {
        background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        color: black;
    }
</style>