<template>
    <Full title="Laravel-Auth">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please confirm your password before continuing.') }}</div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" :class="{'is-invalid':$page.errors.password}" v-model="form.password">
                                <span v-if="$page.errors.password" class="invalid-feedback" role="alert">
                                <strong>{{ $page.errors.password }}</strong>
                            </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
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
                this.$call.post(this.$route('password.confirm'), this.form)
            },
            __(value){
                return value;
            },
        },
    }
</script>
<style>

</style>
