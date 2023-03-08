<template>
    <div>
        <Header />
        <router-view />
        <div class="flex justify-around mt-4 mb-4">
            <div>
                <router-link to="/games/create"
                    class="inline-block rounded border-2 border-danger px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                    data-te-ripple-init data-te-ripple-color="light">
                    New Game
                </router-link>
            </div>

            <div>
                <router-link to="/games/create"
                    class="inline-block rounded border-2 border-danger px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                    data-te-ripple-init data-te-ripple-color="light">
                    *Delete Games History*
                </router-link>
            </div>
        </div>

        <div class="col-12 flex justify-center">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Dice 1</th>
                            <th>Dice 2</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="game in games" :key="game.id">
                            <td>{{ game.throw1 }}</td>
                            <td>{{ game.throw2 }}</td>
                            <td>{{ game.win }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
  

<script>
import axios from 'axios';
import Header from '../components/Header.vue';

export default {
    name: 'games',
    components: {
        Header,
    },
    data() {
        return {
            games: [],
        };
    },
    created() {
        const user = JSON.parse(localStorage.getItem('user'));
        const id = user.id;
        const token = localStorage.getItem('token');
        axios.get('api/players/' + id + '/games', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
            .then(response => {
                console.log('api/players/' + id + '/games');
                const gamesData = response.data;
                console.log(gamesData);
                if (gamesData) {
                    if (gamesData.status === 200) {
                        this.games = gamesData.games;
                    } else {
                        console.error(gamesData.message);
                    }
                } else {
                    console.error('No games found');
                }
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>