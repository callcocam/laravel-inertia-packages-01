<script>
    export default {
        name: "AbstractPages",
        props:{
            actions: {
                default:[]
            },
            columns: {
                default: []
            },
            data: {
                default: {}
            },
            errors: {
                default: []
            },
            options: {
                default: []
            },
            source: {
                default: []
            },
        },
        methods: {
            currentTabComponent: function (Component) {
                return Component;
            },
            onFiltered: function () {
                console.log(this.filter)
            },
            changePagination: function (page) {
                this.updateQueryString({page})
            },
            updateQueryString(params) {
                this.selected = [];
                if ('URLSearchParams' in window) {
                    var searchParams = new URLSearchParams(window.location.search)
                    Object.keys(params).map(key => {
                        if (params[key]) {
                            searchParams.set(key, params[key]);
                        } else {
                            searchParams.delete(key)
                        }
                    })
                    var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
                    history.replaceState({foo: 'foo'}, '', newRelativePathQuery);
                }
                //this.refreshData(Object.assign({}, this.$route.query, params))
            }
        },
    }
</script>

<style scoped>

</style>
