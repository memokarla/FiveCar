@extends('navbar') <!-- path yang menyimpan template navbar --> 

@section('content') <!-- berdasarkan yield('content') pada extends di atas -->
    @livewire('home.index') <!-- Menampilkan komponen Livewire Home -->
@endsection

