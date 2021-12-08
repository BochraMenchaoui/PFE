<div class="section section-lg pb-5 pt-5 pt-md-7 bg-gray-200">
    <link rel="stylesheet" href="{{ asset('/admin/css/messages.css') }}">
    <div class="container">
        <div class="row pt-5 pt-md-0 justify-content-center">
            @if ($members)
                <div class="d-none d-md-block col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom border-gray-300">
                            <h2 class="h6 mb-0 text-center">El Members</h2>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush list">
                                @foreach ($members as $member)
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="user-avatar">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('/images/' . $member?->avatar ?? 'default.png') }}"
                                                        style="width: 40px; height:40px">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4 class="h6 mb-0">
                                                    {{ $member?->name ?? 'Deleted User' }}
                                                </h4>
                                                <span
                                                    class="text-{{ $member->isOnline() ? 'success' : 'danger' }}">●</span>
                                                <small>{{ $member->isOnline() ? 'Connecté' : 'Déconnecté' }}</small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-8">
                <div class="text-left mb-3">
                    <a wire:click="loadOlderMessages">
                        <span class="icon icon-xs">
                            <span class="fas fa-chevron-left me-2"></span>
                        </span>
                        Arja l msgt 9dom
                    </a>
                </div>
                @if ($texts)
                    @foreach ($texts as $message)
                        @if ($message->user_id === Auth::id())
                            <div class="card bg-primary text-white border-gray-300 p-4 ms-md-5 ms-lg-6 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-small">
                                        <span class="fw-bold">Ena</span>
                                        <span class="ms-2">{{ $message->created_at->format('M d, h:i') }}</span>
                                    </span>
                                </div>
                                <p class="m-0">{{ $message->body }}</p>
                            </div>
                        @else
                            <div class="card bg-white border-gray-300 p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-small">
                                        <img class="avatar-sm img-fluid rounded-circle me-2"
                                            src="{{ asset('/images/' . $message->user?->avatar ?? 'default.png') }}"
                                            alt="avatar">
                                        <span class="fw-bold">{{ $message->user?->name ?? 'Deleted User' }}</span>
                                        <span class="ms-2">
                                            {{ $message->created_at->format('M d, h:i') }}
                                        </span>
                                    </span>
                                </div>
                                <p class="m-0"> {{ $message->body }}</p>
                            </div>
                        @endif
                    @endforeach
                @endif
                @if ($typing)
                    <div class="typing">
                        <span class="dot bg-dark"></span>
                        <span class="dot bg-dark"></span>
                        <span class="dot bg-dark"></span>
                    </div>
                    <span class="typing-meta">{{ $name }} is Typing</span>
                @endif
                <div class="mt-4">
                    <textarea wire:model="body" class="form-control border border-gray-400 shadow-sm mb-4" id="textarea"
                        placeholder="{{ __('Your Message') }}" rows="4"></textarea>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="file-field">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button id="emojiTrigger"
                                class="btn btn-secondary btn-icon-only me-2 btn-primary text-warning">
                                <span class="far fa-smile-beam"></span>
                            </button>
                            <button id="sendMessage" wire:click="saveMessage" class="btn btn-secondary text-light">
                                <span class="fas fa-paper-plane me-2"></span>
                                {{ __('Send') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('/js/textarea.js') }}"></script>
</div>
