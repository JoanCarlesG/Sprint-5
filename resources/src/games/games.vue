<template>
    <Header />
    <router-view />
    <div class="flex space-around">
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


    <div class="col-12">
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
                    <tr v-for="game in userGames" :key="game.id">
                        <td>{{ game.throw1 }}</td>
                        <td>{{ game.throw2 }}</td>
                        <td>{{ game.win }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Header from '../components/Header.vue';
export default {
    name: 'games',
    components: {
        Header,
    },
}
</script>

