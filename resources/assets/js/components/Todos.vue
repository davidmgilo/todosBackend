<template>
    <div>
        <p v-show="seen">{{message}}</p>
        <input type="text" v-model="message">
        <button v-on:click="reverseMessage"> Reverse </button>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Done</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="todo in todos">
                        <td>#</td>
                        <td>{{ todo.name }}</td>
                        <td>{{ todo.priority }}</td>
                        <td>{{ todo.done }}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-red">55%</span></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!--<ol>-->
            <!--<li v-for="todo in todos">{{ todo.name }} | {{ todo.priority }} | {{ todo.done }}</li>-->
        <!--</ol>-->
        <!--Hola-->
    </div>
</template>
<style>

</style>
<script>
    export default {
        data() {
            return {
                message: 'Hola que tal',
                seen: false,
                todos: []
            }
        },
        created() {
            console.log('Component created');
            this.fetchData();
        },
        methods:{
            reverseMessage: function(){
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function (){
                //Axios
                // GET someUrl
                this.$http.get('/api/v1/task').then((response) => {
                this.todos = response.data.data;
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });
            }
        }
    }
</script>


<!--data: {-->
<!--message: 'Hello Vue!',-->
<!--seen: false,-->
<!--todos: []-->

<!--},-->
<!--methods: {-->
<!--reverseMessage: function(){-->
<!--this.message = this.message.split('').reverse().join('');-->
<!--},-->
<!--fetchData: function (){-->
<!--//Axios-->
<!--// GET someUrl-->
<!--this.$http.get('/api/v1/task').then((response) => {-->
<!--this.todos = response.data.data;-->
<!--}, (response) => {-->
<!--// error callback-->
<!--sweetAlert("Oops...", "Something went wrong!", "error");-->
<!--console.log(response);-->
<!--});-->
<!--}-->
<!--},-->
<!--created: function() {-->
<!--console.log('App created');-->
<!--this.fetchData()-->
<!--}-->