@extends('layouts.master')
@section('title','Login')
@section('styles')
@endsection
@section('content')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action={{route('loginUser')}} method="post" role="form" style="display: block;">
                                    @csrf
                                    <h2>LOGIN</h2>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>

                                    <div class="col-xs-6 form-group pull-right">
                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if(session('message'))
                        @if(session('status'))
                            <div class="alert alert-success text-muted mt-1" role="alert">
                                {{ session('message') }}
                            </div>
                        @else
                            <div class="alert alert-danger text-muted mt-1" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                    @endif
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6 tabs">
                                <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
                            </div>
                            <div class="col-xs-6 tabs">
                                <a href="{{route('register')}}" id="register-form-link"><div class="register">REGISTER</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
