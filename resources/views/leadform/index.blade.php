@extends('layouts.master')
@section('title','Lead Form')
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
                                <form id="register-form" action="{{route('saveLeadForm')}}" method="post" role="form" style="display: block;">
                                    @csrf
                                    <h2>Lead Form</h2>
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Full Name" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="3" name="address" id="address" tabindex="2" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" name="phone-number" id="phone" tabindex="2" class="form-control" placeholder="Phone Number">
                                        <input type="hidden"  id="isValidPhone" name="isValidPhone" value="0"/>
                                        <span id="valid-msg" class="hide">✓ Valid</span>
                                        <span id="error-msg" class="hide"></span>
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="3" name="comment" id="comment" tabindex="2" class="form-control" placeholder="Comment"></textarea>
                                    </div>
                                    <input type="hidden" name="reference-page" value="{{ redirect()->getUrlGenerator()->previous() }}"/>
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
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button type="submit" name="register-lead-form-submit" id="register-lead-form-submit" tabindex="4" class="form-control btn btn-register">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var input = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        var iti = window.intlTelInput(input, {
            utilsScript: "{{asset('js/util.js?1638200991544')}}"
        });

        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
            $("#isValidPhone").val("0");
        };

        // on blur: validate
        input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                    $("#isValidPhone").val("1");
                } else {
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                    $("#isValidPhone").val("0");
                }
            }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
    </script>
@endsection
