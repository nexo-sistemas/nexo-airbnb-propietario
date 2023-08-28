@extends('app')
@section('title', 'Ficha')
@section('content')
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
                    <h4>Usuario no existe</h4>
                    <p><b>Ingresar bien la URL o solicitar al administrador encargado del edificio</b></p>
                </div>
            </div>
        </div>
    </main>
@endsection
