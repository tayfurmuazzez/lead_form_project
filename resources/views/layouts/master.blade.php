<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Muazzez Tayfur">
    <meta name="generator" content="LeadForm">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include('layouts.style')
</head>
<body style="background-color: #fafafa;">
@include('layouts.header')

<div class="container">
    <div class="row">
{{--        @include('layouts.sidebar')--}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('content')
        </main>
    </div>
</div>

@include('layouts.script')
</body>
</html>
