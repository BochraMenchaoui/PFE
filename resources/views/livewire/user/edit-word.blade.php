<div>
    <div class="row mt-6 px-5 py-4"">
        <div class=" col-12 col-lg-7 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="mb-4">
                                <label for="derja">{{ __('El Kelma - Derja') }}</label>
                                <input wire:model="derja" type="text"
                                    class="form-control  {{ $errors->has('derja') ? 'is-invalid' : '' }}" id="derja">
                                @error('derja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="mb-4">
                                <label for="latin">{{ __('El Kelma - Latin') }}</label>
                                <input wire:model="latin" type="text"
                                    class="form-control  {{ $errors->has('latin') ? 'is-invalid' : '' }}" id="latin">
                                @error('latin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="mb-4">
                                <label for="french">{{ __('Bil Francais') }}
                                </label>
                                <div class="input-group">
                                    <input wire:model="french" type="text"
                                        class="form-control {{ $errors->has('french') ? 'is-invalid' : '' }}"
                                        id="french">
                                </div>
                                @error('french')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="mb-4">
                                <label for="english">{{ __('Bil Anglais') }}
                                </label>
                                <div class="input-group">
                                    <input wire:model="english" type="text"
                                        class="form-control {{ $errors->has('english') ? 'is-invalid' : '' }}"
                                        id="english">
                                </div>
                                @error('english')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="mb-4">
                                <label for="arabic">{{ __('Bil Aarbi') }}
                                </label>
                                <div class="input-group">
                                    <input wire:model="arabic" type="text"
                                        class="form-control {{ $errors->has('arabic') ? 'is-invalid' : '' }}"
                                        id="arabic">
                                </div>
                                @error('arabic')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="mb-4">
                                <label for="exampleFormControlTextarea1"
                                    class="form-label">{{ __('Description/Meanings') }}</label>
                                <textarea wire:model="description"
                                    class="form-control  {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
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
                        <div class="col-lg-6 col-sm-12 mb-2">
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
                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="row justify-content-center">
                                <div class="col-4 text-center">
                                    <button class="btn w-100 btn-primary mt-2">{{ __('Sajel') }}</button>
                                </div>
                                <div class="col-4 text-center">
                                    <a wire:click="clearForm"
                                        class="btn w-100 btn-primary mt-2">{{ __('Nadhef') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5 mb-4">
        <div class="card shadow bg-white border-gray-300 flex-lg-row align-items-center g-0 p-2">
            <div class="card-body d-flex flex-column justify-content-between col-auto py-3 p-0 p-lg-3 p-xl-3">
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <h3 class="h3 text-center mb-3">
                            {{ empty($latin) ? 'Derja' : $latin }}
                        </h3>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6">
                        <h3 class="h3 text-center mb-3">
                            {{ empty($derja) ? 'Arbi' : $derja }}
                        </h3>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center mt-2">
                    <div class="col-4 text-center">
                        <p>{{ empty($french) ? 'Francais' : $french }}</p>
                    </div>
                    <div class="col-4 text-center">
                        <p>{{ empty($english) ? 'Anglais' : $english }}</p>
                    </div>
                    <div class="col-4 text-center">
                        <p>{{ empty($arabic) ? 'Aarbi' : $arabic }}</p>
                    </div>
                </div>
                <hr>
                @if (!empty($description))
                    <p>{{ $description }}</p>
                @else
                    <p>
                        Vel qui et debitis soluta. Voluptatem dolorem dolorem accusamus nemo. Voluptas qui
                        sapiente dolorem perferendis ea doloribus exercitationem.
                        Vel qui et debitis soluta. Voluptatem dolorem dolorem accusamus nemo. Voluptas qui
                        sapiente dolorem perferendis ea doloribus exercitationem.
                    </p>
                @endif
                <hr>
                <div class="row justify-content-center mt-2">
                    <div class="col-6 text-center">
                        <p>{{ empty($origin) ? 'Origin' : $origin }}</p>
                    </div>
                    <div class="col-6 text-center">
                        <p>{{ empty($region) ? 'Region' : $region }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/admin/js/createWord.js') }}"></script>
</div>
