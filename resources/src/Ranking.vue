<template>
    <div>
        <Header />
        <router-view />
        <!--Best and worst player-->

        <div class="flex justify-around mt-4">
            <div>
                <table class="table rounded border">
                    <thead>
                        <tr class="tableheader text-center">
                            <th>
                                <div class="flex justify-around tableheader">
                                    <img class="rounded-md mr-1 pl-0.5 pr-0.5" src="/img/crown-solid.svg" width="20"
                                        alt="Icon">
                                    Best player
                                    <img class="rounded-md ml-1 pl-0.5 pr-0.5" src="/img/crown-solid.svg" width="20"
                                        alt="Icon">
                                </div>
                            </th>
                            <th>Win rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>{{ winner.name }}</td>
                            <td>{{ winner.win_rate }} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <table class="table rounded border">
                    <thead>
                        <tr class="tableheader text-center">
                            <th>
                                <div class="flex justify-around tableheader">
                                    <img class="rounded-md mr-1 pl-0.5 pr-0.5" src="/img/flag-solid.svg" width="20"
                                        alt="Icon">
                                    Worst player
                                    <img class="rounded-md ml-1 pl-0.5 pr-0.5" src="/img/flag-solid.svg" width="20"
                                        alt="Icon">
                                </div>
                            </th>
                            <th>Win rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>{{ loser.name }}</td>
                            <td>{{ loser.win_rate }} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Full Ranking-->

        <div class="flex justify-center mt-8">
            <div>
                <h1 class="flex justify-center text-2xl">Full Ranking</h1>
                <table class="table rounded border">
                    <thead>
                        <tr class="tableheader text-center">
                            <th>Ranking</th>
                            <th>Username</th>
                            <th>Win rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="(user, index) in users" :key="user.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.win_rate }} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!--Cancel Button-->
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
import Header from './components/Header.vue';

export default {
    name: 'updateName',
    components: {
        Header,
    },
    data() {
        return {
            users: [],
            winner: "",
            loser: "",
        };
    },
    created() {
        const token = localStorage.getItem('token');
        axios.get('/api/players/ranking', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then((response) => {
                console.log(response.data.data);
                this.users = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
        axios.get('/api/players/ranking/winner', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then((response) => {
                console.log(response.data.data);
                this.winner = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            })
        axios.get('/api/players/ranking/loser', {
            headers: {
                Authorization: `Bearer ${token}`,
            }
        })
            .then((response) => {
                console.log(response.data.data);
                this.loser = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            })
    }
}
</script>