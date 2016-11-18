@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
    <div id="app">
        <p v-show="seen">@{{message}}</p>
        <input type="text" v-model="message">
        <button v-on:click="reverseMessage"> Reverse </button>

        <ol>
            <li v-for="todo in todos">@{{ todo.name }} | @{{ todo.priority }} | @{{ todo.done }}</li>
        </ol>
    </div>
@endsection
