<template>
    <div class="flex justify-center">

        <form @submit.prevent="register">
            <div>
                <div class="max-w-7xl mx-auto p-6 lg:p-8 mt-20">
                    <div class="flex justify-center">
                        <img class="rounded-md" src="/img/logo-text.png" width="150" alt="Logo">
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <h4 class="mt-1 mb-12 pb-1 text-xl font-semibold">
                    Create a new account!
                </h4>
            </div>
            <!-- Show error if invalid register -->
            <p class="text-danger flex justify-center mb-2" v-if="error">{{ error }}</p>

            <div class="relative mb-4" data-te-input-wrapper-init>
                <input type="name"
                    class="form-control peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-500 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                    id="name" placeholder="Username" v-model="user.name" />
            </div>

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
            <div class="relative mb-4" data-te-input-wrapper-init>
                <input type="password"
                    class="form-control peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-500 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                    id="c-password" placeholder="Confirm Password" v-model="user.c_password" />
            </div>
            <div class="pt-1 pb-1 text-center">
                <button
                    class="mb-3 inline-block w-full rounded px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal button shadow-[0_4px_9px_-4px_rgba(0,0,0,0.2)] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:outline-none focus:ring-0 active:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)]"
                    type="submit">
                    Register
                </button>
            </div>
            <div class="flex justify-center rounded px-6 pt-2.5 pb-2 text-xs font-medium uppercase">
                <router-link to="/" class="button">
                    Back
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Register',
    data() {
        return {
            user: {
                name: null,
                email: null,
                password: null,
                c_password: null,
            },
            error: null,
        };
    },
    methods: {
        register() {
            if (this.user.password === this.user.c_password) {
                axios.post('/api/players', this.user)
                    .then(response => {
                        alert(response.data.message);
                        this.$router.push({ name: 'login' })
                    })
                    .catch(error => {
                        this.error = error.response.data.message;
                    })
            } else {
                this.error = 'Passwords do not match';
            }
        }
    }
}

</script>
