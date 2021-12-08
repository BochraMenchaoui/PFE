<div>
    <link rel="stylesheet" type="text/css" href="{{ asset('/trix/trix.css') }}">
    <script type="text/javascript" src="{{ asset('/trix/trix.js') }}"></script>
    <style>
        trix-editor {
            min-height: 30rem;
        }

        .trix-button-group--file-tools {
            display: none !important;
        }

    </style>
    <section class="section section-header bg-primary-app text-dark pt-7 pb-md-4">
        <div style="max-width: 1300px" class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-8 mt-0 mb-3">
                    <div class="card shadow text-center" style="border-left: 4rem solid #1c2540;">
                        <div class="card-hchangeeader bg-white border-0 pb-0">
                            <h5 class="mt-4">
                                Rédigi l article
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group text-left">
                                    <label for="title">Titre</label>
                                    <input wire:model.defer="title" type="text" placeholder="Ekteb titre houni"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                        id="title">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="form-group text-left">
                                    <label for="firstname">Contenu</label>
                                    <input id="x"
                                        name="content form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                                        hidden>
                                    <div wire:ignore>
                                        <trix-editor placeholder="Ikteb haja, lezm msh 9ssira barsha.." input="x"
                                            wire:model.defer="body">
                                        </trix-editor>
                                    </div>
                                    @error('body')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button wire:click="savePost" type="button" class="btn btn-secondary">
                                <span class="fas fa-share me-2"></span>
                                Partagi
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 mt-1">
                    <div class="card shadow text-center mb-4">
                        <div class="card-header bg-secondary border-0 p-2">
                            <h5 class="text-white">
                                Uploadi Coverture
                            </h5>
                        </div>
                        <div class="card-body">
                            <input wire:model="thumbnail" class="form-control form-control-sm" id="formFileSm"
                                type="file">
                            @error('thumbnail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="card shadow text-center">
                        <div class="card-header bg-secondary border-0 p-2">
                            <h5 class="text-white">
                                Tags
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" wire:keydown.enter="tags" wire:model.defer="userTag"
                                        placeholder="zid tags houni" class="form-control" id="tags">
                                </div>
                                @if ($tags)
                                    <div class="col-12 mt-4">
                                        @if ($tags)
                                            @foreach ($tags as $tag)
                                                <div class="row justify-content-center">
                                                    <div class="col-1">
                                                        <span class="icon icon-sm">
                                                            <span class="fas fa-hashtag"></span>
                                                        </span>
                                                    </div>
                                                    <div class="col-9 text-left">
                                                        <div>{{ $tag }}</div>
                                                    </div>
                                                    <div class="col-1">
                                                        <span wire:click="removeTag({{ $loop->index }})"
                                                            class="fas fa-minus text-danger"
                                                            style="cursor: pointer"></span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('/admin/js/adminProfile.js') }}"></script>
    <script>
        document.addEventListener("trix-file-accept", (e) => {
            e.preventDefault()
        })

    </script>
</div>
