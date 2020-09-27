<template>
    <layout title="Welcome">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Example Component Destroy</div>
                        <div class="card-body">
                            Destroy
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
    import Layout from "@/layouts/Layout";
    import AbstractPages from "@/Pages/AbstractPages";
    export default {
        name: "Destroy",
        components: {Layout},
        extends:AbstractPages
    }
</script>

<style scoped>

</style>
