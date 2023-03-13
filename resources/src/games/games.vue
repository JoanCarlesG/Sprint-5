<template>
    <div>
        <Header />
        <router-view />
        <div class="flex justify-around mt-8">
            <div>
                <div class="card mt-4">
                    <div class="img">
                        <img class="rounded-lg mt-2 ml-2" src="/img/user-icon.png" width="80" alt="Icon">
                    </div>
                    <div class="info">
                        <div><span>{{ username }}</span></div>
                    </div>
                    <router-link to="/edit">Edit Name</router-link>

                </div>
                <div class="flex justify-center mt-8">
                    <img class="rounded-lg mt-2 ml-2" src="/img/dice.gif" width="100" alt="Icon">
                </div>
            </div>

            <div>
                <div class="flex justify-around mt-4 mb-4">
                    <div class="button mr-2">
                        <button @click="rollDice">Roll Dice</button>
                    </div>
                    <div class="button">
                        <button @click="deleteHistory">Delete All Games</button>
                    </div>
                </div>
                <div class="col-12 flex justify-center">
                    <div class="table-responsive">
                        <table class="table rounded border">
                            <thead>
                                <tr class="tableheader text-center">
                                    <th>Dice 1</th>
                                    <th>Dice 2</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="game in games" :key="game.id">
                                    <td>{{ game.throw1 }}</td>
                                    <td>{{ game.throw2 }}</td>
                                    <td v-if="game.win == 1">Won</td>
                                    <td v-else="game.win == 2">Lost</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            data: {
                throw1: null,
                throw2: null,
                win: null,
            },
            username: JSON.parse(localStorage.getItem('user')).name,
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
                const gamesData = response.data;
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
    },
    methods: {
        rollDice() {
            let user = JSON.parse(localStorage.getItem('user'));
            let id = user.id;
            let token = localStorage.getItem('token');
            axios.post('api/players/' + id + '/games', this.data, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            })
                .then((response) => {
                    console.log(response);
                    alert(response.data.data.throw1 + " and " + response.data.data.throw2 + ' = ' + response.data.result);
                    window.location.reload();
                })
                .catch((error) => {
                    console.log(error);
                })

        },
        deleteHistory() {
            let user = JSON.parse(localStorage.getItem('user'));
            let id = user.id;
            let token = localStorage.getItem('token');
            axios.delete('api/players/' + id + '/games', {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            })
                .then((response) => {
                    if (confirm("Delete all games?")) {
                        alert(response.data.message);
                        window.location.reload();
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
}
</script>