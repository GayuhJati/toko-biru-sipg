@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mx-auto px-[50px] py-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard </h1>
        @can('isAdmin')
            <x-admin-dashboard />
        @endcan

        @can('isPemilik')
            <x-pemilik-dashboard />
        @endcan

        @can('isPegawai')
            <x-pegawai-dashboard />
        @endcan
    </div>
@endsection
