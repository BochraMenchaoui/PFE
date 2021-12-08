@extends('admin.layout')
@section('content')
    @livewire('admin.admin-profile')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/adminProfile.js') }}"></script>
@endsection
