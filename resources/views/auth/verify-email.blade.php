@extends('pixel')
@section('content')

    <section style='background: rgba(0, 0, 0, 0) url("/images/form-image.jpg") repeat scroll 0% 0%;'
        class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark"
        data-background="{{ asset('/images/form-image.jpg') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow text-center">
                        <div class="card-body">
                            <form action="{{ route('verification.send') }}" method="POST">
                                @csrf
                                <h3 class="h5 card-title">Bathnelk Mail Deja!</h3>
                                <p class="card-text">Ken mawslekesh tnajm tawed tabth mail ekher.</p>
                                <x-flash />
                                <button type="submit" class="btn btn-primary btn-sm">Awed Abth</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
