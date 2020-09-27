<template>
    <Full title="Laravel-Auth">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" :class="{'is-invalid':$page.errors.name}" v-model="form.name">
                                <span v-if="$page.errors.name" class="invalid-feedback" role="alert">
                                    <strong>{{ $page.errors.name }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" :class="{'is-invalid':$page.errors.email}" v-model="form.email">
                                <span v-if="$page.errors.email" class="invalid-feedback" role="alert">
                                    <strong>{{ $page.errors.email }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" :class="{'is-invalid':$page.errors.password}" v-model="form.password">
                                <span v-if="$page.errors.password" class="invalid-feedback" role="alert">
                                <strong>{{ $page.errors.password }}</strong>
                            </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password Confirmation') }}</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" :class="{'is-invalid':$page.errors.password_confirmation}" v-model="form.password_confirmation">
                                <span v-if="$page.errors.password_confirmation" class="invalid-feedback" role="alert">
                                <strong>{{ $page.errors.password_confirmation }}</strong>
                            </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="form.terms" id="terms">
                                    <label class="form-check-label" for="terms">
                                        {{ __('Accept Terms') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
        name: "Login",
        props:['form','column'],
        components: {Full},
        data() {
            return {}
        },
        methods: {
            submit() {
                this.$call.post(this.$route('register'), this.form)
            },
            __(value){
                return value;
            },
        },
    }
</script>
<style>

</style>
