<template>
    <div>
        <Header />
        <router-view />
        <div class="flex justify-around mt-8">
            <form @submit.prevent="changeName">
                <div class="card mt-4">
                    <div class="img">
                        <img class="rounded-lg mt-2 ml-2" src="/img/user-icon.png" width="80" alt="Icon">
                    </div>
                    <div class="info">
                        <input type="text" class="w-28 text-align" id="name" name="name" :placeholder="username" v-model="form.name">
                    </div>
                    <button class="button" type="submit">Change Name</button>
                </div>
            </form>
        </div>
        <div class="flex justify-center mt-4">
                <router-link to="/games" class="button">
                    Cancel
                </router-link>
            </div>
    </div>
</template>
  

<script>
import axios from 'axios';
import { resolveDirective } from 'vue';
import Header from '../components/Header.vue';

export default {
    name: 'updateName',
    components: {
        Header,
    },
    data() {
        return {
            form: {
                name: null,
            },
            username: JSON.parse(localStorage.getItem('user')).name,
        };
    },
    methods: {
        changeName() {
            let user = JSON.parse(localStorage.getItem('user'));
            let id = user.id;
            let token = localStorage.getItem('token');
            axios.put('api/players/' + id, { name: this.form.name }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            })
                .then(response => {
                    user.name = this.form.name;
                    localStorage.setItem('user', JSON.stringify(user));
                    alert(response.data.message);
                    this.$router.push({ name: 'showGames' });
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>