@extends('app')
@section('title', 'Login Propietario')
@section('script-page')
    @vite(['resources/js/pages/index.js'])
@endsection
@section('content')


    <input type="hidden" id="codbase64" value="{{ base64_encode($usuario) }}">
    <input type="hidden" id="indexDB__">
    <main class="main-content position-relative max-height-vh-100 h-100">
        <nav class="navbar navbar-main navbar-expand-lg px-0" id="navbarBlur" navbar-scroll="true" style="background: #001a57">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <img src="{{ Vite::asset('resources/images/logoNexo.png') }}" class="navbar-brand-img h-100"
                        style="width: 130px;" alt="main_logo">
                </nav>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="card z-index-0">
                <div class="card-body">
                    <center>
                       <img src="{{ asset('Spinner-1.9s-298px.svg') }}" class="img-responsive">
                       <p><b>Cargando datos ...</b></p>
                    </center>
                </div>
            </div>
        </div>

    </main>
@endsection
