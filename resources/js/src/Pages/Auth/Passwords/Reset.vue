<template>
    <Full title="Laravel-Auth">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recover your password') }}</div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" :class="{'is-invalid':$page.errors.email}" v-model="form.email">
                                <span v-if="$page.errors.email" class="invalid-feedback" role="alert">
                                    <strong>{{ $page.errors.email }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset') }}
                                </button>
                                <call-link v-if="route().check('login')" class="btn btn-link" :href="route('login')">
                                    {{ __('Back to login?') }}
                                </call-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Full>
</template>
<script>
    import Full from "@/layouts/Full";
    export default {
        name: "Email",
        props:['form','column'],
        components: {Full},
        data() {
            return {}
        },
        methods: {
            submit() {
                this.$call.post(this.$route('password.update'), this.form)
            },
            __(value){
                return value;
            },
        },
    }
</script>
<style>

</style>
