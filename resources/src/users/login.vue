<template>
    <div class="flex justify-center">

        <form @submit.prevent="login">
            <div>
                <div class="max-w-7xl mx-auto p-6 lg:p-8 mt-20">
                    <div class="flex justify-center">
                        <div>
                            <img class="rounded-md mt-2" src="/img/logo-text.png" width="150" alt="Logo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <h4 class="mt-1 mb-12 pb-1 text-xl font-semibold">
                    Welcome!
                </h4>
            </div>
            <!-- Show error if invalid login 
            <p class="text-danger flex justify-center" v-if="error">{{ error }}</p>
            -->

            <div class="relative mb-4" data-te-input-wrapper-init>
                <input type="email"
                    class="form-control peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-500 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                    id="email" placeholder="Email" v-model="user.email" />
            </div>
            <div class="relative mb-4" data-te-input-wrapper-init>
                <input type="password"
                    class="form-control peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-500 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                    id="password" placeholder="Password" v-model="user.password" />
            </div>
            <div class="mb-12 pt-1 pb-1 text-center">
                <button
                    class="mb-3 inline-block w-full rounded px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_rgba(0,0,0,0.2)] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:outline-none focus:ring-0 active:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)]"
                    type="submit" data-te-ripple-init data-te-ripple-color="light"
                    style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                    Log in
                </button>
                <a href="#!">Forgot password?</a>
            </div>
            <div class="flex items-center justify-between pb-6">
                <p class="mb-0 mr-2">Don't have an account?</p>
                <router-link to="/register"
                    class="inline-block rounded border-2 border-danger px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                    data-te-ripple-init data-te-ripple-color="light">
                    Register
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Login',
    data() {
        return {
            user: {
                email: null,
                password: null,
            },
        };
    },
    methods: {
        login() {
            axios.post('/api/login', this.user)
                .then(response => {
                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                    this.$router.push({ name: 'showGames' })
                })
                .catch(error => {
                    this.error = error.response.data.message;
                })
        }
    }
}

</script>
