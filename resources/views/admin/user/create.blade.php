@extends('layouts.master')

@section('title', 'User Create')


@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>User Create</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li class="active">
                    <strong>User Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <button type="submit" class="btn btn-primary">Button</button>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        @include('flash::message')
        <div class="row">
            <div class="col-sm-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>User Create</h5>
                    </div>
                    <div class="ibox-content">

                        <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name" v-model="form.name" name="name" class="form-control">
                                <span class="text-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" v-model="form.email" name="name" class="form-control">
                                <span class="text-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="password" v-model="form.password" name="name" class="form-control">
                                <span class="text-danger" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
                            </div>
                            <div class="form-group">
                                <label>Repeat Password</label>
                                <input type="password" id="repeat_password" v-model="form.repeat_password" name="repeat_password" class="form-control">
                                <span class="text-danger" v-if="form.errors.has('repeat_password')" v-text="form.errors.get('repeat_password')"></span>
                            </div>

                            <button :disabled="form.errors.any()" class="btn btn-success">Create</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection