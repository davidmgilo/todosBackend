<template>

<form method="post" @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)">
        <div class="form-group has-feedback has-error">
            <input type="text" class="form-control" placeholder="" name="name" value="" v-model="form.name" autofocus/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <transition name="fade">
                <span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
            </transition>
        </div>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="" name="email" value="" v-model="form.email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="" name="password" v-model="form.password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="" name="password_confirmation" v-model="form.password_confirmation"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-1">
                <label>
                    <div class="checkbox_register icheck">
                        <label>
                            <input type="checkbox" name="terms" v-model="form.terms">
                        </label>
                    </div>
                </label>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">Accepta les condicions</button>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4 col-xs-push-1">
                <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="form.errors.any()"><i class="fa fa-refresh fa-spin" v-if="form.submitting"></i>Register</button>
            </div><!-- /.col -->
        </div>
    </form>

</template>

<script>

    import Form from 'davidmgilo-forms'

    export default {
        mounted() {
            console.log('Component register Form mounted.')
            this.initialitzeICheck()
        },
        data: function () {
            return {
                form: new Form(
                    {
                        name: '',
                        email: '',
                        password: '',
                        password_confirmation:'',
                        terms: ''
                    }
                )
            }
        },
        watch: {
            'form.terms': function (value) {
                if(value) {
                    $('input').iCheck('check')
                } else {
                    $('input').iCheck('uncheck')
                }
            }
        },
        methods: {
            initialitzeICheck() {
                var component = this
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%',
                    inheritClass: true
                }).on('ifChecked', function(event){
                    component.form.set('terms',true)
                    component.form.errors.clear('terms')
                }).on('ifUnchecked', function(event){
                    component.form.set('terms','')
                });
            },
            submit() {
                console.log('submitting')
                this.form.submit('post','/register')
                    .then(response => {
                        console.log(response)
                        //TODO redirect to home
                    })
                    .catch(error => {
                      console.log(error.response.data)
                    })
            }
        }
    }

</script>
<style>

    .fade-enter-active, .fade-leave-active {
        transition: opacity 3s ease;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>