<div class="row mt-4">
    <style>
        .clickable {
            cursor: pointer;
        }

    </style>
    <div class="col-8 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-4">
                                <label for="derja">{{ __('Word - Derja') }}</label>
                                <input wire:model="derja" type="text"
                                    class="form-control  {{ $errors->has('derja') ? 'is-invalid' : '' }}" id="derja">
                                @error('derja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="mb-4">
                                <label for="latin">{{ __('Word - Latin') }}</label>
                                <input wire:model="latin" type="text"
                                    class="form-control  {{ $errors->has('latin') ? 'is-invalid' : '' }}" id="latin">
                                @error('latin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="mb-4">
                                <label for="french">{{ __('Word in French') }}
                                    <span wire:loading wire:target="translateFrom" class="spinner-grow spinner-grow-sm"
                                        role="status" aria-hidden="true"></span>
                                </label>
                                <div class="input-group">
                                    <input wire:model.defer="french" type="text"
                                        class="form-control {{ $errors->has('french') ? 'is-invalid' : '' }}"
                                        id="french" {{ $frenchToggled ? 'disabled' : '' }}>
                                    <span wire:click="translateFrom('fr')" id="lockUserCreate" class="input-group-text">
                                        <span class="fas fa-globe"></span>
                                    </span>
                                    <span wire:click="toggleDisable('fr')" id="lockUserCreate" class="input-group-text">
                                        <span
                                            class="fas {{ $frenchToggled ? 'fa-comment' : 'fa-comment-slash' }}"></span>
                                    </span>
                                </div>
                                @error('french')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="mb-4">
                                <label for="english">{{ __('Word in English') }}
                                    <span wire:loading wire:target="translateFrom" class="spinner-grow spinner-grow-sm"
                                        role="status" aria-hidden="true"></span>
                                </label>
                                <div class="input-group">
                                    <input wire:model.defer="english" type="text"
                                        class="form-control {{ $errors->has('english') ? 'is-invalid' : '' }}"
                                        id="english" {{ $englishToggled ? 'disabled' : '' }}>
                                    <span wire:click="translateFrom('en')" id="lockUserCreate" class="input-group-text">
                                        <span class="fas fa-globe"></span>
                                    </span>
                                    <span wire:click="toggleDisable('en')" id="lockUserCreate" class="input-group-text">
                                        <span
                                            class="fas {{ $englishToggled ? 'fa-comment' : 'fa-comment-slash' }}"></span>
                                    </span>
                                </div>
                                @error('english')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="mb-4">
                                <label for="arabic">{{ __('Word in Arabic') }}
                                    <span wire:loading wire:target="translateFrom" class="spinner-grow spinner-grow-sm"
                                        role="status" aria-hidden="true"></span>
                                </label>
                                <div class="input-group">
                                    <input wire:model.defer="arabic" type="text"
                                        class="form-control {{ $errors->has('arabic') ? 'is-invalid' : '' }}"
                                        id="arabic" {{ $arabicToggled ? 'disabled' : '' }}>
                                    <span wire:click="translateFrom('ar')" id="lockUserCreate" class="input-group-text">
                                        <span class="fas fa-globe"></span>
                                    </span>
                                    <span wire:click="toggleDisable('ar')" id="lockUserCreate" class="input-group-text">
                                        <span
                                            class="fas {{ $arabicToggled ? 'fa-comment' : 'fa-comment-slash' }}"></span>
                                    </span>
                                </div>
                                @error('arabic')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-4">
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
                        <div class="col-lg-6 col-sm-6">
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
                        <div class="col-lg-6 col-sm-6">
                            <label for="region">{{ __('Region') }}</label>
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
                        @if (count($synonyms) > 0)
                            <div class="col-lg-12 col-sm-12 mb-2">
                                <label for="synonyms">{{ __('Synonyms') }}</label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                @foreach ($synonyms as $syn)
                                                    @if ($loop->first)
                                                        <div
                                                            class="d-flex align-items-center justify-content-between {{ $loop->count > 1 ? 'border-bottom border-gray-300 pb-3' : '' }}  ">
                                                            <h6 class="mb-0">
                                                                {{ $syn['word'] }}
                                                            </h6>
                                                            <div>
                                                                <span wire:click="removeSyn({{ $loop->index }})"
                                                                    class="fas fa-trash-alt text-danger ms-2 clickable"></span>
                                                            </div>
                                                        </div>
                                                    @elseif($loop->last)
                                                        <div
                                                            class="d-flex align-items-center justify-content-between pt-3">
                                                            <h6 class="mb-0">
                                                                {{ $syn['word'] }}
                                                            </h6>
                                                            <div>
                                                                <span wire:click="removeSyn({{ $loop->index }})"
                                                                    class="fas fa-trash-alt text-danger ms-2 clickable"></span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="d-flex align-items-center justify-content-between border-bottom border-gray-300 py-3">
                                                            <h6 class="mb-0">
                                                                {{ $syn['word'] }}
                                                            </h6>
                                                            <div>
                                                                <span wire:click="removeSyn({{ $loop->index }})"
                                                                    class="fas fa-trash-alt text-danger ms-2 clickable"></span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="col-lg-12 col-sm-12 mb-2">
                                <div class="row justify-content-center">
                                    <div class="col-3 text-center">
                                        <button class="btn btn-dark w-100">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow bg-white border-gray-300 flex-lg-row align-items-center g-0 p-2">
            <div class="card-body d-flex flex-column justify-content-between col-auto py-3 p-0 p-lg-3 p-xl-3">
                <div class="row">
                    <div class="col-12">
                        <h3 class="h3 text-center mb-3">
                            Synonyms
                        </h3>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><span class="fas fa-search"></span></span>
                    <input wire:model="searchQuery" type="text" class="form-control" id="exampleInputIconLeft"
                        placeholder="Search" aria-label="Search">
                </div>
                @if ($results)
                    <div class="display: inline-block">
                        @foreach ($results as $result)
                            <span wire:click="addSyn({{ $result->id }}, '{{ $result->word_lt }}')"
                                id="badge-{{ $result->id }}"
                                class="badge badge-lg bg-primary clickable">{{ $result->word_lt }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- TODO: ken sart haja w alert js madsh yheb yekhdem aaml include hne-->
    <script>
        window.addEventListener('remove-tag', event => {
            $(document).ready(function() {
                $('#badge-' + event.detail.id).remove();
            });
        })

    </script>
    <script src="{{ asset('/admin/js/createWord.js') }}"></script>
</div>
