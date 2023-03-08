<template>
    <h1 class="pt-4 pl-6">DICE IT!</h1>
    <div class="pl-6 pt-2 pb-2">
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