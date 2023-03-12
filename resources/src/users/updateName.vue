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
                    <div class="info" data-te-input-wrapper-init>
                        <input type="text" class="w-28 text-align" id="name" name="name" :placeholder="username" v-model="form.name">
                    </div>
                    <button type="submit">Change Name</button>
                </div>
            </form>
        </div>
        <div class="flex justify-center mt-4">
                <router-link to="/games"
                    class="inline-block rounded border-2 border-danger px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                    data-te-ripple-init data-te-ripple-color="light">
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
                    console.log(user.name);
                    if (alert(response.data.message)) {
                        resolveDirective(this.$router, 'push', '/games');
                    };
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>