<template>
    <div>
        <Header />
        <router-view />
        <div class="flex justify-center mt-8">
            <!-- Show error if invalid login -->
            <p class="text-danger flex justify-center mb-2" v-if="error">{{ error }}</p>
            <div v-if="!error">
                <table class="table rounded border">
                    <thead>
                        <tr class="tableheader text-center">
                            <th>Username</th>
                            <th>Email</th>
                            <th>Win rate</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="user in users" :key="user.id">
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
                class="button">
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