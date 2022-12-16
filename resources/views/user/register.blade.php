@extends('layouts.master')
@section('title','Register')
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
                                <form id="register-form" action="{{route('registerUser')}}" method="post" role="form" style="display: block;">
                                    @csrf
                                    <h2>REGISTER</h2>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Full Name" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Register Now</button>
                                            </div>
                                        </div>
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

                    @if($errors->any())
                        <div class="alert alert-danger text-muted mt-1" role="alert">
                            {{ implode('', $errors->all(':message')) }}
                        </div>
                    @endif
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6 tabs">
                                <a href="{{route('login')}}" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
                            </div>
                            <div class="col-xs-6 tabs">
                                <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
