<div>
    <div class="row mt-6 px-5 py-4">
        @if (Auth::user()->role === 1)
            <div
                class="d-flex col-md-8 col-sm-12 mb-2 justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <div class="d-block mb-4 mb-md-0">
                    <button id="uploadFile" class="btn btn-sm btn-dark p-r-2">
                        <div wire:loading wire:target="document">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </div>
                        <span class="fas fa-upload me-2">
                        </span>
                        Import
                    </button>
                    <input wire:model="document" type="file" id="importUsers" hidden>
                    @error('document') <span class="text-danger">{{ $message }}</span> @enderror
                    @if (session()->has('message'))
                        <span class="text-danger">
                            {{ session('message') }}
                        </span>
                    @endif
                </div>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group ms-2 ms-lg-3">
                        <a wire:click="exportWordsCSV" class="btn btn-sm btn-outline-primary">CSV</a>
                        <a wire:click="exportWordsPDF" class="btn btn-sm btn-outline-primary">PDF</a>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-8 col-sm-12 mb-2">
            <div class="card border-light shadow-sm components-section">
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mb-4">
                                    <label for="derja">{{ __('El Kelma - Derja') }}</label>
                                    <input wire:model="derja" type="text"
                                        class="form-control  {{ $errors->has('derja') ? 'is-invalid' : '' }}"
                                        id="derja">
                                    @error('derja')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-4">
                                    <label for="latin">{{ __('El Kelma - Latin') }}</label>
                                    <input wire:model="latin" type="text"
                                        class="form-control  {{ $errors->has('latin') ? 'is-invalid' : '' }}"
                                        id="latin">
                                    @error('latin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-4">
                                    <label for="french">{{ __('Bil Francais') }}
                                        <span wire:loading wire:target="translateFrom"
                                            class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                    </label>
                                    <div class="input-group">
                                        <input wire:model="french" type="text"
                                            class="form-control {{ $errors->has('french') ? 'is-invalid' : '' }}"
                                            id="french" {{ $frenchToggled ? 'disabled' : '' }}>
                                        <span wire:click="translateFrom('fr')" id="lockUserCreate"
                                            class="input-group-text">
                                            <span class="fas fa-globe"></span>
                                        </span>
                                        <span wire:click="toggleDisable('fr')" id="lockUserCreate"
                                            class="input-group-text">
                                            <span
                                                class="fas {{ $frenchToggled ? 'fa-comment' : 'fa-comment-slash' }} }}"></span>
                                        </span>
                                    </div>
                                    @error('french')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-4">
                                    <label for="english">{{ __('Bil Anglais') }}
                                        <span wire:loading wire:target="translateFrom"
                                            class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                    </label>
                                    <div class="input-group">
                                        <input wire:model="english" type="text"
                                            class="form-control {{ $errors->has('english') ? 'is-invalid' : '' }}"
                                            id="english" {{ $englishToggled ? 'disabled' : '' }}>
                                        <span wire:click="translateFrom('en')" id="lockUserCreate"
                                            class="input-group-text">
                                            <span class="fas fa-globe"></span>
                                        </span>
                                        <span wire:click="toggleDisable('en')" id="lockUserCreate"
                                            class="input-group-text">
                                            <span
                                                class="fas {{ $englishToggled ? 'fa-comment' : 'fa-comment-slash' }}"></span>
                                        </span>
                                    </div>
                                    @error('english')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="mb-4">
                                    <label for="arabic">{{ __('Bil Aarbi') }}
                                        <span wire:loading wire:target="translateFrom"
                                            class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                    </label>
                                    <div class="input-group">
                                        <input wire:model="arabic" type="text"
                                            class="form-control {{ $errors->has('arabic') ? 'is-invalid' : '' }}"
                                            id="arabic" {{ $arabicToggled ? 'disabled' : '' }}>
                                        <span wire:click="translateFrom('ar')" id="lockUserCreate"
                                            class="input-group-text">
                                            <span class="fas fa-globe"></span>
                                        </span>
                                        <span wire:click="toggleDisable('ar')" id="lockUserCreate"
                                            class="input-group-text">
                                            <span
                                                class="fas {{ $arabicToggled ? 'fa-comment' : 'fa-comment-slash' }}"></span>
                                        </span>
                                    </div>
                                    @error('arabic')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="mb-4">
                                    <label for="exampleFormControlTextarea1"
                                        class="form-label">{{ __('EL description w el ma9sed') }}</label>
                                    <textarea wire:model="description"
                                        class="form-control  {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-4">
                                    <label for="origin">{{ __('Origin') }}</label>
                                    <input wire:model="origin" type="text"
                                        class="form-control {{ $errors->has('origin') ? 'is-invalid' : '' }}"
                                        id="origin">
                                    @error('origin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <label for="region">{{ __('Région') }}</label>
                                <select wire:model="region" class="form-select" id="region">
                                    <option>Ariana</option>
                                    <option>Beja</option>
                                    <option>Sousse</option>
                                    <option>Bizerte</option>
                                    <option>Gabes</option>
                                    <option>Nabeul</option>
                                    <option>Jendouba</option>
                                    <option>Kairouan</option>
                                    <option>Zaghouan</option>
                                    <option>Kebili</option>
                                    <option>Kef</option>
                                    <option>Mahdia</option>
                                    <option>Manouba</option>
                                    <option>Medenine</option>
                                    <option>Monastir</option>
                                    <option>Gafsa</option>
                                    <option>Sfax</option>
                                    <option>Bouzid</option>
                                    <option>Siliana</option>
                                    <option>Arous</option>
                                    <option>Tataouine</option>
                                    <option>Tozeur</option>
                                    <option>Tunis</option>
                                    <option>Kasserine</option>
                                </select>
                            </div>
                            <style>
                                .progress-bar {
                                    -webkit-transition: none !important;
                                    transition: none !important;
                                }

                            </style>
                            <div class="col-lg-10 col-12 mt-lg-0 mt-4 py-3">
                                <div class="progress progress-xl">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                        role="progressbar" style="width: {{ $width }}%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 mt-lg-0 mt-4">
                                <button class="btn w-100 btn-dark"
                                    {{ $width < 100 ? 'disabled' : 'enabled' }}>{{ __('Sjel') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            <div class="card shadow bg-white border-gray-300 flex-lg-row align-items-center g-0 p-2">
                <div class="card-body d-flex flex-column justify-content-between col-auto py-3 p-0 p-lg-3 p-xl-3">
                    <div class="row">
                        <div class="col-6 col-md-6 col-sm-6">
                            <h3 class="h3 text-center mb-3">
                                {{ !empty($derja) ? $derja : 'Derja' }}
                            </h3>
                        </div>
                        <div class="col-6 col-md-6 col-sm-6">
                            <h3 class="h3 text-center mb-3">
                                {{ !empty($latin) ? $latin : 'Latin' }}
                            </h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center mt-2">
                        <div class="col-4 text-center">
                            <p>{{ !empty($french) ? $french : 'francais' }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p>{{ !empty($english) ? $english : 'anglais' }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p>{{ !empty($arabic) ? $arabic : 'arabi' }}</p>
                        </div>
                    </div>
                    <hr>
                    <p>
                        @if ($description)
                            {{ $description }}
                        @else
                            Vel qui et debitis soluta. Voluptatem dolorem dolorem accusamus nemo. Voluptas qui
                            sapiente
                            dolorem perferendis ea doloribus exercitationem.
                        @endif
                    </p>
                    <hr>
                    <div class="row justify-content-center mt-2">
                        <div class="col-6 text-center">
                            <p>{{ !empty($origin) ? $origin : 'origin' }}</p>
                        </div>
                        <div class="col-6 text-center">
                            <p>{{ !empty($region) ? $region : 'region' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/admin/js/createWord.js') }}"></script>
</div>
