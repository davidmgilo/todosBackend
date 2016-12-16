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
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                        <todo v-for="(todo, index) in filteredTodos"
                              v-bind:todo="todo"
                              :index="index"
                              :from="from"
                              @todo-deleted="eliminar"
                        ></todo>
                        <!--<tr v-for>-->
                        <!--<td>{{index + from}}</td>-->
                        <!--<td><div v-show="!nom[index]" @dblclick="canviaVisiNom(index,todo)">{{ todo.name }}</div>-->
                            <!--<input type="text" v-model="todo.name" v-show="nom[index]" @keyup.enter="canviaVisiNom(index,todo)"-->
                                   <!--v-todo-focus="nom[index]" onfocus="this.select();"></td>-->
                        <!--<td><div v-show="!prioritat[index]" @dblclick="canviaVisiPrioritat(index,todo)">{{ todo.priority }}</div>-->
                            <!--<input type="text" v-model="todo.priority" v-show="prioritat[index]" @keyup.enter="canviaVisiPrioritat(index,todo)"-->
                                   <!--v-todo-focus="prioritat[index]" onfocus="this.select();"></td>-->
                        <!--<td><span v-if="todo.done">-->
                                <!--<input type="checkbox" class="minimal" checked="" @click="modificaDone(index,todo)">-->
                            <!--</span>-->
                            <!--<span v-else>-->
                                <!--<input type="checkbox" class="minimal" @click="modificaDone(index,todo)">-->
                            <!--</span>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<div class="progress progress-xs">-->
                                <!--<div class="progress-bar progress-bar-danger" style="width: 55%"></div>-->
                            <!--</div>-->
                        <!--</td>-->
                        <!--<td><span class="badge bg-red">55%</span></td>-->
                        <!--<td><button class="btn btn-warning btn-block" v-on:click=" eliminar(index,todo.id)"><i class="fa fa-trash-o"></i></button></td>-->
                        <!--</tr>-->

                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries.</span>
                <pagination
                        :current-page="page"
                        :items-per-page="perPage"
                        :total-items="total"
                    @page-changed="eliminar"
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
import Todo from './Todo.vue'

    export default {
        components : { Pagination, Todo },
        data() {
            return {
                todos: [],
                visibility: 'all', //'active', 'completed'
                newTodo: '',
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
            eliminar: function(index,id) {
                var funct = this;
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this task!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        funct.deleteFromApi(id);
                        swal("Deleted!", "Your task has been deleted.", "success");
                        funct.fetchPage(funct.page);

                    } else {
                        swal("Cancelled", "Your task is safe :)", "error");
                    }
                });

            },
            deleteFromApi: function(id) {
            this.$http.delete('/api/v1/task/' + id).then((response) => {
                console.log(response);
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });
            },
            pageChanged : function (pageNum) {
                 this.page = pageNum;
                 this.fetchPage(pageNum);
            }
        },
        directives: {
            'todo-focus': function (el, value) {
              if (value) {
                el.focus()
              }
            }
        }
    }
</script>


