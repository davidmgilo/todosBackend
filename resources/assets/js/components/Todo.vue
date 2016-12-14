<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div>
        <td>{{index + from}}</td>
        <td><div v-show="!nom[index]" @dblclick="canviaVisiNom(index,todo)">{{ todo.name }}</div>
            <input type="text" v-model="todo.name" v-show="nom[index]" @keyup.enter="canviaVisiNom(index,todo)"
                   v-todo-focus="nom[index]" onfocus="this.select();"></td>
        <td><div v-show="!prioritat[index]" @dblclick="canviaVisiPrioritat(index,todo)">{{ todo.priority }}</div>
            <input type="text" v-model="todo.priority" v-show="prioritat[index]" @keyup.enter="canviaVisiPrioritat(index,todo)"
                   v-todo-focus="prioritat[index]" onfocus="this.select();"></td>
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
        <td><button class="btn btn-warning btn-block" v-on:click=" eliminar(index,todo.id)"><i class="fa fa-trash-o"></i></button></td>
    </div>
    
</template>
<style>

</style>
<script>

    export default {

        data() {
            return {
                editing: false,
            }
        },
        created() {
            console.log('Component created');
        },
        methods:{
            hola : function() {
                console.log("Hola");

            },
    }
</script>


