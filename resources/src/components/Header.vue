<template>
    <div class=" bar flex text-center">
        <img class="rounded-md m-3" src="/img/logo.png" width="70" alt="Logo">
        <div class="bar">
            <div class="bar flex justify-center mt-4">
                <router-link class="header rounded-md mr-2 p-2 " @click="logout" to="/">Logout</router-link>
                <router-link class="header rounded-md mr-2 p-2 " to="/games">Home</router-link>
                <router-link class="header rounded-md mr-2 p-2 " to="/ranking">Ranking</router-link>
                <router-link class="header rounded-md mr-2 p-2 " v-if='role == 1' to="/admin">Admin</router-link>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            role: localStorage.getItem('roleNum'),
        }
    },
    created() {
        let role = localStorage.getItem('roleNum').trim();
        console.log(role);

    },
    methods: {
        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            localStorage.removeItem('roleNum');
            this.$router.push('/');
        }
    },

}

</script>

<style scoped>
.bar {
    background-color: #550A21;
    color: white;
}

.header {
    background-color: #550A21;
    color: white;
}

.header:hover {
    background-color: #410718;
}
</style>