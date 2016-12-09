<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Task</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="#">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" placeholder="Enter task name here"
                            v-model="newTodo"
                            @keyup.enter="addTodo">
                    </div>
                </div>
            </form>
        </div>
        <!--<p v-show="seen">{{message}}</p>-->
        <!--<input type="text" v-model="message">-->
        <!--<button v-on:click="reverseMessage"> Reverse </button>-->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>
                <div class="btn-group">
                    <button type="button" class="btn btn-default">{{visibility}}</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" v-on:click="setVisibility('all')">All</a></li> <!-- Equivalents -->
                        <li><a href="#" @click="setVisibility('active')">Active</a></li>
                        <li><a href="#" @click="setVisibility('completed')">Done</a></li>
                    </ul>
                </div>
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
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <td>{{index + from}}</td>
                        <td><div v-show="nom" @dblclick="canviaVisiNom(index,todo)">{{ todo.name }}</div>
                            <input type="text" v-model="todo.name" v-show="!nom" @keyup.enter="canviaVisiNom(index,todo)"></td>
                        <td><div v-show="prioritat" @dblclick="canviaVisiPrioritat()">{{ todo.priority }}</div>
                            <input type="text" v-model="filteredTodos[index].priority" v-show="!prioritat" @dblclick="canviaVisiPrioritat()"></td>
                        <td>{{ todo.done }}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-red">55%</span></td>
                        <td><button class="btn btn-warning btn-block" v-on:click=" eliminar(index)">E</button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries.</span>
                <pagination
                        :current-page="page"
                        :items-per-page="perPage"
                        :total-items="total"
                    @page-changed="pageChanged"
                ></pagination>
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

import Pagination from './Pagination.vue'

    export default {
        components : { Pagination },
        data() {
            return {
                todos: [],
                visibility: 'all', //'active', 'completed'
                newTodo: '',
                nom : true,
                prioritat : true,
                from: 0,
                to : 0,
                total: 0,
                perPage: 5,
                page: 1,
            }
        },
        computed: {
            filteredTodos: function () {

                var filters = {
                    all : function(todos){
                        return todos;
                    },
                    active : function(todos){
                        return todos.filter(function(todo){
                            return !todo.done;
                        });
                    },
                    completed : function(todos){
                        return todos.filter(function(todo){
                            return todo.done;
                        });
                    },
                }

                return filters[this.visibility](this.todos);


            },


        },
        created() {
            console.log('Component created');
            this.fetchData();
        },
        methods:{
            addTodo : function() {
                console.log(this.newTodo);
                var value = this.newTodo && this.newTodo.trim();
                if(!value){
                    return;
                }
                var todo = {
                         name : value,
                         priority: 1,
                         done: false,
                }
                this.filteredTodos.push(todo);
                this.newTodo = '';
                this.addTodoToApi(todo);
                this.fetchPage(this.page);
            },
            reverseMessage: function(){
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function (){
                return this.fetchPage(1);
            },
            addTodoToApi : function (todo) {
             this.$http.post('/api/v1/task',{
                name : todo.name,
                priority : todo.priority,
                done : todo.done,
             }).then((response) => {
                console.log(response);

            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });
            },
            fetchPage : function (page){
                    //Axios
                // GET someUrl
            this.$http.get('/api/v1/task?page=' + page).then((response) => {
                this.todos = response.data.data;
                this.to = response.data.to;
                this.from = response.data.from;
                this.total = response.data.total;
                this.perPage = response.data.per_page;
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });
            },
            setVisibility: function(visibility){
                console.log("Han fet click");
                this.visibility = visibility;
            },
            eliminar: function(index) {
                this.filteredTodos.splice(index, 1);
            },
            canviaVisiNom: function(index, todo) {
                this.nom = !this.nom;
                if (this.nom) this.modificaNom(index,todo);

            },
            modificaNom: function(index,todo){
                this.filteredTodos[index].name = todo.name;
                console.log(todo);
                console.log(this.filteredTodos[index].name);
            },
            canviaVisiPrioritat: function() {
                this.prioritat = !this.prioritat;
            },
            pageChanged : function (pageNum) {
                 this.page = pageNum;
                 this.fetchPage(pageNum);
            }
        }
    }
</script>


