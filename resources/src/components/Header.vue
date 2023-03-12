<template>
    <div class=" header flex">
        <img class="rounded-md m-3" src="/img/logo.png" width="75" alt="Logo">
        <router-link @click="logout" to="/" >Logout</router-link> |
        <router-link to="/games">Home</router-link> |
        <router-link to="/ranking">Ranking</router-link> |
        <router-link to="/admin">Admin</router-link>
    </div>
</template>

<script>
export default {
    name: 'Header',
    methods: {
        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            this.$router.push('/');
        }
    }
}

</script>

<style scoped>
.header {
    background: linear-gradient(to right, #550A21, black);
    color: black;
}
</style>