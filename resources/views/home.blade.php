@extends('layouts.app') <!-- path yang menyimpan template navbar dan footer --> 

@section('content') <!-- berdasarkan _@yield('content') pada app.blade.php -->
    @livewire('home.index') <!-- Menampilkan komponen Livewire Home -->
@endsection

