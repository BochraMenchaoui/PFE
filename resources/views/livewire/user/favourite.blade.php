<div>
    <section style="padding-top: 4rem" class="section section-header bg-primary-app text-dark pb-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="card-body px-5 py-5 text-center text-md-left">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h2 class="mb-3">
                                    @if ($countFav === 0)
                                        Maandek hata kelmaaa!
                                    @else
                                        @if ($countFav === 1)
                                            Andek kelma wahda
                                        @else
                                            Andek
                                            <span class="display-3 text-secondary fw-bold">
                                                {{ $countFav }}
                                            </span>
                                            kelmet
                                        @endif
                                    @endif
                                </h2>
                                <p class="mb-0">
                                    Tnajm tna7ehom wa9t mat7eb, zeda aaml tala ala ekher el kelmt li tzedo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <figure class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n2"><svg class="fill-white"
                version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewBox="0 0 1920 43.4" style="enable-background:new 0 0 1920 43.4;" xml:space="preserve">
                <path
                    d="M0,23.3c0,0,405.1-43.5,697.6,0c316.5,1.5,108.9-2.6,480.4-14.1c0,0,139-12.2,458.7,14.3 c0,0,67.8,19.2,283.3-22.7v35.1H0V23.3z">
                </path>
            </svg>
        </figure>
    </section>

    <div class="container mb-4">
        <div class="row justify-content-center pt-5 pt-md-0">
            <div class="col-12 col-lg-{{ count($favs) == 0 ? '10' : '4' }} mt-4">
                <div class="col-12 col-lg-12 bg-white" style="border-radius: 1rem;">
                    <div class="accordion" id="accordionExample1">
                        @foreach ($latestWords as $word)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $word->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $word->id }}">
                                        <div class="col">
                                            <h2 class="h6 mx-0 mb-1">
                                                <h2 class="h6 mx-0 mb-1">{{ $word->word_lt }} -
                                                    {{ $word->word_ar }}
                                                </h2>
                                                <div class="post-meta font-small"><a class="text-secondary me-3"
                                                        href="#">
                                                        <span class="far fa-eye me-2"></span>
                                                        {{ $word->views_count }}
                                                    </a>
                                                    <span>
                                                        <span class="far fa-clock me-2">
                                                        </span>
                                                        {{ $word->created_at->format('d-m-y') }}
                                                    </span>
                                                </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse{{ $word->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample1" style="">
                                    <div class="accordion-body">
                                        <a href="{{ route('details', ['id' => $word->id]) }}" target="_blank">
                                            {{ $word->description }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 mt-4">
                @foreach ($favs as $fav)
                    <div class="card border-gray-300 mb-1 py-3">
                        <div class="card-body d-flex align-items-center flex-wrap flex-lg-nowrap py-0">
                            <div class="col-auto col-lg-1 d-flex align-items-center px-0">
                                <span wire:click="unfav({{ $fav->id }})"
                                    style="color: #ffc107;  font-size:20px; cursor: pointer;"
                                    class="fas fa-bookmark vote"></span>
                            </div>
                            <div class="col-lg-3 col-8 ps-0 ms-2">
                                <a
                                    class="h6 text-sm">{{ Str::substr($fav->user?->name ?? 'Deleted User', 0, 16) }}</a>
                            </div>
                            <div class="col col-lg-1 text-right px-0 order-lg-4">
                                <span class="text-muted text-sm">{{ $fav->created_at->format('d-m') }}</span>
                            </div>
                            <div class="col-12 col-lg-7 d-flex align-items-center px-0">
                                <div class="col col-lg-11 px-0">
                                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center">
                                        <a href="{{ route('details', ['id' => $fav->id]) }}" target="_blank"
                                            class="col-12 col-lg ps-0 fw-normal text-dark d-none d-sm-block mt-2 mt-lg-0">
                                            {{ Str::substr($fav->description, 0, 40) }}...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
