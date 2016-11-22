<template>
    <div>
        <p v-show="seen">{{message}}</p>
        <input type="text" v-model="message">
        <button v-on:click="reverseMessage"> Reverse </button>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th style="width: 10px">Priority</th>
                <th style="width: 10px">Done</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                </td>
            </tr>

            </tbody>
        </table>
        <ol>
            <li v-for="todo in todos">{{ todo.name }} | {{ todo.priority }} | {{ todo.done }}</li>
        </ol>
        <!--Hola-->
    </div>
</template>
<style>
    body{
        background-color:#ff0000;
    }
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