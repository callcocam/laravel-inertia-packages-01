<template>
    <layout title="Welcome">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Example Component Edit</div>
                        <div class="card-body">
                           Edit
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
        name: "Edit",
        components: {Layout},
        extends:AbstractPages
    }
</script>

<style scoped>

</style>
