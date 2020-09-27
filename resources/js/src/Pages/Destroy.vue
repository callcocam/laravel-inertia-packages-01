<template>
    <layout title="Welcome">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Example Component</div>
                        <div class="card-body">
                            <template v-if="rows">
                                <table class="table table-bordered">
                                    <tr v-for="(row, index) in rows">
                                        <td>
                                            {{ row.name }}
                                        </td>
                                    </tr>
                                </table>
                            </template>
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
