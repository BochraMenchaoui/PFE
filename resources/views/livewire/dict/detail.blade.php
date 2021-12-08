<div>
    <style>
        .clickable {
            cursor: pointer;
        }

    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200&display=swap');

        h3,
        h4 {
            font-family: Roboto Slab;
        }

        .link3 a {
            color: #343139;
            text-decoration: none;
            border-bottom: .125em solid #DDE1ED;
            box-shadow: inset 0 -0.125em 0 #DDE1ED;
            transition: box-shadow 270ms cubic-bezier(0.77, 0, 0.175, 1), color 270ms cubic-bezier(0.77, 0, 0.175, 1);
        }

        .link3 a:hover {
            box-shadow: inset 0 -1.125em 0 #DDE1ED;
            color: #000;
        }

        .link3 a:focus {
            background: #fff;
            outline: none;
            background: #DDE1ED;
            color: #fff;
            box-shadow: 8px 8px 24px rgba(0, 0, 0, 0.2);
        }

        .seven h4 {
            text-align: center;
            font-weight: 300;
            color: #222;
            letter-spacing: 1px;
            text-transform: uppercase;

            display: grid;
            grid-template-columns: 1fr max-content 1fr;
            grid-template-rows: 27px 0;
            grid-gap: 20px;
            align-items: center;
        }

        .seven h4:after,
        .seven h4:before {
            content: " ";
            display: block;
            border-bottom: 1px solid #c50000;
            border-top: 1px solid #c50000;
            height: 5px;
            background-color: #f8f8f8;
        }

        .socialIcons {
            cursor: pointer;
        }

    </style>
    <section class="section section-header bg-primary-app text-dark pb-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-sm-12">
                    <div class="row justify-content-center mb-1">
                        <div class="col-12 col-md-12 text-center">
                            <h3 class="display-3 mb-4">
                                @if ($word->published == 1)
                                    <i wire:click="fav" class="{{ $fav ? 'fas' : 'far' }} fa-bookmark"
                                        style="color: #ffc107; font-size: 30px; cursor: pointer;">
                                    </i>
                                @endif
                                {{ $lang }}
                                @if ($word->published === 0)
                                    <span class="badge badge-lg bg-secondary">UNPUBLISHED</span>
                                @endif
                            </h3>
                            <ul class="list-inline text-center mb-3 mt-1">
                                <li class="list-inline-item p-3 clickable">
                                    <img wire:click="changeWordLanguage('fr')" src="{{ asset('/images/france.svg') }}"
                                        style="width: 50px; height:50px;">
                                </li>
                                <li class="list-inline-item p-3 clickable">
                                    <img wire:click="changeWordLanguage('en')"
                                        src="{{ asset('/images/england.svg') }}" style="width: 50px; height:50px;">
                                </li>
                                <li class="list-inline-item p-3 clickable">
                                    <img wire:click="changeWordLanguage('ar')" src="{{ asset('/images/saudia.svg') }}"
                                        style="width: 50px; height:50px;">
                                </li>
                                <li class="list-inline-item p-3 clickable">
                                    <img wire:click="changeWordLanguage('lt')" style="width: 50px; height:50px;"
                                        src="{{ asset('/images/tunisia.svg') }}">
                                </li>
                            </ul>
                            <div class="seven mt-4">
                                <h4 class="display-3 mb-4">Chara7</h4>
                            </div>
                            {{-- <h4 style="text-decoration: underline;" class="display-3 mb-4"><em>Chara7</em></h4> --}}
                            <p class="fs-4 text-body">{{ $word->description }}</p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-1 mt-4">
                        <div class="col-12 col-sm-12 col-md-12 text-center mb-3">
                            <ul class="list-unstyled">
                                <li class="list-item h4 mb-4">
                                    {{-- <h4 style="text-decoration: underline;" class="display-3 mb-4"><em>Synonyme</em>
                                    </h4> --}}
                                    <div class="seven">
                                        <h4 class="display-3 mb-4">Synonymes</h4>
                                    </div>
                                </li>
                                <li class="list-item fw-normal mb-3 text-body">
                                    @if ($synonyms->isEmpty())
                                        <p class="link3 fs-4 text-body">
                                            Mazel mafama hata synonyme,
                                            @if ($word->published !== 0)
                                                aaleh matkounech nty loul? <a
                                                    href="{{ route('user.suggest.word') }}">Zid kelma</a>
                                            @endif
                                        </p>
                                    @else
                                        <p class="link3 fs-4 text-body">
                                            @foreach ($synonyms as $synonym)
                                                <a href="{{ route('details', ['id' => $synonym?->syn ?? -1]) }}">
                                                    {{ \App\Models\Word::find($synonym->syn)?->word_lt }}
                                                </a>
                                                @if (!$loop->last)
                                                    -
                                                @endif
                                            @endforeach
                                        </p>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 text-center mb-3">
                            <ul class="list-unstyled">
                                <li class="list-item h4 mb-4">
                                    <div class="seven">
                                        <h4 class="display-3 mb-4">Origin w Region</h4>
                                    </div>
                                </li>
                                <li class="list-item fw-normal mb-3 text-body">
                                    <p class=" fs-4 text-body">
                                        El kelma hedhi tet9al fi <em
                                            style="text-decoration: underline">{{ $word->region }}</em>, ama el assel
                                        mteeha ml <em style="text-decoration: underline">{{ $word->origin }}</em>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if ($word->published === 1)
                        <div class="row justify-content-center mt-4">
                            <h4 class="display-3 mb-4 text-center">
                                <em style="text-decoration: underline">Wenty mathebech tetfel maana?</em>
                            </h4>
                            <div class="col-12 col-md-8 text-center mb-4 mb-md-6">
                                <div class="row mb-2 mt-2 ">
                                    <div class="col-4 col-sm-4 col-lg-4 col-md-4 text-center">
                                        <div class="icon-box">
                                            <div
                                                class="icon icon-shape icon-md bg-white shadow-lg border-light rounded-circle mb-4">
                                                <span class="far fa-eye text-tertiary"></span>
                                            </div>
                                            <h2 class="h5 icon-box-title">{{ $views }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-lg-4 col-md-4 text-center">
                                        <div class="icon-box">
                                            <div
                                                class="icon icon-shape icon-md bg-white {{ $liked ? '' : 'shadow-lg' }} border-light {{ $liked ? '' : 'animate-down-2' }} rounded-circle mb-4">
                                                <span wire:click="like"
                                                    class="{{ $liked ? 'fas' : 'far' }} fa-thumbs-up text-tertiary socialIcons"></span>
                                            </div>
                                            <h2 class="h5 icon-box-title">{{ $likes }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-lg-4 col-md-4 text-center">
                                        <div class="icon-box">
                                            <div
                                                class="icon icon-shape icon-md bg-white {{ $disliked ? '' : 'shadow-lg' }} border-light {{ $disliked ? '' : 'animate-down-2' }} rounded-circle mb-4">
                                                <span wire:click="dislike"
                                                    class="{{ $disliked ? 'fas' : 'far' }} fa-thumbs-down text-tertiary socialIcons"></span>
                                            </div>
                                            <h2 class="h5 icon-box-title">{{ $dislikes }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <figure class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n2">
            <svg class="fill-white" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 43.4"
                style="enable-background:new 0 0 1920 43.4;" xml:space="preserve">
                <path
                    d="M0,23.3c0,0,405.1-43.5,697.6,0c316.5,1.5,108.9-2.6,480.4-14.1c0,0,139-12.2,458.7,14.3 c0,0,67.8,19.2,283.3-22.7v35.1H0V23.3z">
                </path>
            </svg>
        </figure>
    </section>

    <div class="section section-md bg-white text-black pt-0 line-bottom-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div>
                        <label class="h5 mb-4" for="exampleFormControlTextarea1">
                            <span
                                class="badge badge-md bg-primary text-uppercase me-2">{{ $word->comments->count() }}</span>
                            Comentairet
                        </label>
                        <textarea wire:model="body"
                            class="form-control border border-gray-300-gray {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            id="exampleFormControlTextarea1" placeholder="Zid commentairek hné.." rows="6"
                            data-bind-characters-target="#charactersRemaining" maxlength="1000">
                        </textarea>
                        @error('body')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="d-flex justify-content-between mt-3">
                            @if ($remainings <= 5)
                                <small class="fw-light text-danger">
                                    <span id="charactersRemaining">{{ $remainings }}</span>
                                    caractéres mezeloulik
                                </small>
                            @else
                                <small class="fw-light text-dark">
                                    <span id="charactersRemaining">{{ $remainings }}</span>
                                    caractéres mezeloulik
                                </small>
                            @endif
                            <button wire:click="comment" class="btn btn-primary animate-up-2">Eb3ath</button>
                        </div>
                        @foreach ($comments as $comment)
                            <div class="mt-5">
                                <div class="card bg-gray-200 border-gray-300 rounded p-4 mb-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <span class="font-small">
                                            <img class="avatar-sm img-fluid rounded-circle me-2"
                                                src="{{ asset('/images/' . ($comment->user?->avatar ?? 'default.png')) }}"
                                                alt="avatar">
                                            <span
                                                class="fw-bold">{{ $comment->user?->name ?? 'Deleted User' }}</span>
                                            <span class="ms-2">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </span>
                                        <div>
                                            @if (Auth::user()->owns($comment->id) || Auth()->user()->role === 0)
                                                <button wire:click="destroy({{ $comment->id }})"
                                                    class="btn btn-link text-danger" aria-label="delete button">
                                                    <span class="far fa-trash-alt"></span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="m-0">
                                        {{ $comment->body }}
                                    </p>
                                </div>
                        @endforeach
                        <div class="mt-5 text-center">
                            @if ($amount <= count($comments))
                                <button wire:click="load" class="btn btn-primary btn-loading-overlay me-2 mb-2">
                                    <span class="spinner">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
                                        </span>
                                    </span>
                                    <span class="ms-1 btn-inner-text">
                                        A9dem commentairet
                                    </span>
                                </button>
                            @else
                                <p id="allLoadedText">Madech fama hata commentaire!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/user/detail.js') }}"></script>
</div>
