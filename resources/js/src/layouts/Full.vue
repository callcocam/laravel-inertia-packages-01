<template>
    <div class="container">
        <div class="row justify-content-center">
            <slot></slot>
        </div>
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
    }
</script>
