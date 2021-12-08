@extends('layout.nav')
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/user/search.css') }}">
    @livewire('dict.search')
@endsection
