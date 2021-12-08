<div>
    <style>
        .clickable {
            cursor: pointer;
        }

        .loading span {
            display: inline-block;
            vertical-align: middle;
            width: .6em;
            height: .6em;
            margin: .19em;
            background: #007DB6;
            border-radius: .6em;
            animation: loading 1s infinite alternate;
        }

        .loading span:nth-of-type(2) {
            background: #008FB2;
            animation-delay: 0.2s;
        }

        .loading span:nth-of-type(3) {
            background: #009B9E;
            animation-delay: 0.4s;
        }

        .loading span:nth-of-type(4) {
            background: #00A77D;
            animation-delay: 0.6s;
        }

        .loading span:nth-of-type(5) {
            background: #00B247;
            animation-delay: 0.8s;
        }

        .loading span:nth-of-type(6) {
            background: #5AB027;
            animation-delay: 1.0s;
        }

        .loading span:nth-of-type(7) {
            background: #A0B61E;
            animation-delay: 1.2s;
        }

        @keyframes loading {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

    </style>
    <section class="section section-header pb-2 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 text-center">
                    <div class="form-group bg-white shadow-soft rounded-pill mb-4 px-3 py-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="input-group input-group-merge shadow-none">
                                    <div class="input-group-text bg-transparent border-0">
                                        <span class="fas fa-globe-africa"></span>
                                    </div>
                                    <input wire:model.defer="searchTerm" wire:keydown.enter="search" type="text"
                                        class="form-control border-0 form-control-flush shadow-none pb-2"
                                        placeholder="Kifeh n9oulo table bil tounsi?">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button wire:click="search"
                                    class="btn btn-block btn-primary rounded-pill">Tarjm</button>
                            </div>
                        </div>
                    </div>
                    <div wire:loading wire:target="search" class="loading">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="col-8 text-center display-5 mt-4">
                    @error('translate')
                        <div class="alert alert-dark" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="section bg-primary text-white section-md">
        <div class="container">
            <div class="row align-items-center justify-content-around">
                <div class="col-md-6 col-xl-6 mb-5">
                    <img class="organic-radius img-fluid"
                        src="{{ !is_null($pic) ? $pic : 'https://image.freepik.com/free-vector/cute-robot-cartoon-vector-icon-illustration-techology-robot-icon-concept-isolated-premium-vector-flat-cartoon-style_138676-1474.jpg' }}">
                </div>
                <div class=" col-md-6 col-xl-5 text-center text-md-left">
                    <h2 class="h1 mb-5">
                        {{ $title ?? 'DERJA' }}
                        @if ($flag == 'tn')
                            <img class="clickable" src="{{ asset('/images/france.svg') }}"
                                style="width: 50px; height:50px;">
                        @else
                            @if ($flag == 'fr')
                                <img class="clickable" src="{{ asset('/images/france.svg') }}"
                                    style="width: 50px; height:50px;">
                            @else
                                <img class="clickable" src="{{ asset('/images/england.svg') }}"
                                    style="width: 50px; height:50px;">
                            @endif
                        @endif
                    </h2>
                    <p class="lead">
                        @if ($meaning)
                            {{ $meaning }}
                        @else
                            Netkallem w nҟamem tunsi… Nħebb nekteb bel-tunsi, El-luġa mtèɛi w mtaɛ ajdèdi… El-dèrja
                            hiyya luġetna el-tunsiyya, elli taħki waħadha ɛla et-tèriҟ mtèɛna. Mel amaziġ w kartàj
                            netɛaddèou ɛar-rumèn, w el-wendàl, lel-bizantiyyin w el-ɛrab, luġetna hiyya tċakċika ħlowwa
                            fiha kelmèt w qwè3ed aṣlha amaziġi, buniqi, làtini, talyèni, frànsàwi w ɛarbi… ҟalta
                            tunsiyya mizyèna barċa tfasser tafattoħ el-ħađ̣àra mtèɛna el-hèyla.
                        @endif
                    </p>
                    @if ($link)
                        <em>
                            <p class="lead link5">
                                Ken t7eb ta9ra akther aleha tfa9ed e lien <a
                                    style="background-color: rgb(185, 185, 185); color:black" href="{{ $link }}"
                                    target=_blank>hedha</a>.
                            </p>
                        </em>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
