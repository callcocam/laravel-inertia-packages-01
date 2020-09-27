<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <header class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <call-link v-if="route().check('admin')" :href="route('admin')">Dashboard</call-link>
                <call-link v-if="route().check('admin.about')" :href="route('admin.about')">About</call-link>
                <call-link v-if="route().check('admin.contact')" :href="route('admin.contact')">Contact</call-link>
                <call-link v-if="route().check('logout')" :href="route('logout')" @click.prevent="logout">Logout</call-link>
            </div>
        </header>
        <main class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <slot />
        </main>
    </div>
</template>
<script>
    export default {
        props: {
            title: String,
        },
        watch: {
            title: {
                immediate: true,
                handler(title) {
                    document.title = title
                },
            },
        },
        methods:{
            logout(){
                this.$call.post(this.$route('logout'),{})
            }

        }
    }
</script>
