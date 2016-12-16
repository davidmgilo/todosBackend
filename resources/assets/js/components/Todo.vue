<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <tr>
        <td>{{index + from}}</td>
        <td><div v-show="!editing" @dblclick="canviaNom(index,todo)">{{ todo.name }}</div>
            <input type="text" v-model="todo.name" v-show="editing" @keyup.enter="canviaNom(index,todo)"
                   v-todo-focus="editing" onfocus="this.select();"></td>
        <td><div v-show="!editingPri" @dblclick="canviaVisiPrioritat(index,todo)">{{ todo.priority }}</div>
            <input type="text" v-model="todo.priority" v-show="editingPri" @keyup.enter="canviaVisiPrioritat(index,todo)"
                   v-todo-focus="editingPri" onfocus="this.select();"></td>
        <td><span v-if="todo.done">
                                <input type="checkbox" class="minimal" checked="" @click="modificaDone(index,todo)">
                            </span>
            <span v-else>
                                <input type="checkbox" class="minimal" @click="modificaDone(index,todo)">
                            </span>
        </td>
        <td>
            <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
            </div>
        </td>
        <td><span class="badge bg-red">55%</span></td>
        <td><button class="btn btn-warning btn-block" v-on:click=" deletetodo(index,todo.id)"><i class="fa fa-trash-o"></i></button></td>
    </tr>
    
</template>
<style>

</style>
<script>

    export default {
        props: ['todo','index','from'],

        data() {
            return {
                editing: false,
                editingPri: false,
            }
        },
        created() {
            console.log('Component created');
        },
        methods:{
            hola : function() {
                console.log("Hola");

            },
            canviaNom: function(index, todo) {
                this.editing = !this.editing;
                if (!this.editing) this.modificaNom(index,todo);
                //this.fetchPage(this.page);

            },
            modificaNom: function(index,todo){
                //this.filteredTodos[index].name = todo.name;
                this.updateApi(todo);
                console.log(todo);
                //console.log(this.filteredTodos[index].name);
            },
            updateApi: function (todo){
            this.$http.put('/api/v1/task/' + todo.id,{
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
            canviaVisiPrioritat: function(index,todo) {
                this.editingPri = !this.editingPri;
                if (!this.editingPri) this.modificaPrioritat(index,todo);
               // this.fetchPage(this.page);
            },
            modificaPrioritat: function(index,todo){
               // this.filteredTodos[index].prioritat = todo.prioritat;
                this.updateApi(todo);
            },
            modificaDone: function(index,todo){
                todo.done = !todo.done;
                this.updateApi(todo);
              //  this.fetchPage(this.page);
            },
            deletetodo: function(index,id){
                this.$emit('todo-deleted', index, id);
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


