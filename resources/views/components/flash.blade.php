@if (session()->has('message'))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
@endif
