<template>
    <div>
        <Header />
        <router-view />
        <div class="flex justify-center mt-8">
            <!-- Show error if invalid login -->
            <p class="text-danger flex justify-center mb-2" v-if="error">{{ error }}</p>
            <div v-if="!error">
                <table class="border border-black-500">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Win rate</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.win_rate }} %</td>
                            <td>{{ user.role[0] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <router-link to="/games"
                class="inline-block rounded border-2 border-danger px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                data-te-ripple-init data-te-ripple-color="light">
                Back
            </router-link>
        </div>
    </div>
</template>
  

<script>
import axios from 'axios';
import Header from '../components/Header.vue';

export default {
    name: 'updateName',
    components: {
        Header,
    },
    data() {
        return {
            users: [],
            error: null,
        };
    },
    created() {
        const token = localStorage.getItem('token');
        axios.get('/api/players', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then((response) => {
                console.log(response.data.data);
                this.users = response.data.data;
            })
            .catch((error) => {
                this.error = error.response.data.message;
            })
    }
}
</script>