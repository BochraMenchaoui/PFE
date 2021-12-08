<div class="row justify-content-center mt-5 mb-6">
    <link rel="stylesheet" href="{{ asset('/admin/css/messages.css') }}">
    <div class="col-12 d-flex justify-content-between flex-column flex-sm-row">
        <a wire:click="loadOlderMessages" class="fw-bold text-dark hover:underline mb-2 mb-lg-0">
            <span class="fas fa-inbox me-2">
            </span>Back to messages
        </a>
        <p class="text-muted fw-normal small">
            @if (\App\Models\Message::count() < 5)
                Showing {{ \App\Models\Message::count() }} messages.
            @else
                Showing last {{ $amount }} messages.
            @endif
        </p>
    </div>
    <div class="col-12">
        @foreach ($texts as $message)
            @if ($message->user_id === Auth::id())
                <div class="card bg-dark text-white shadow-sm p-4 ms-md-5 ms-lg-6 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-small">
                            <span class="fw-bold">{{ __('You') }}</span>
                            <span class="ms-2">
                                {{ $message->created_at->format('M d, h:i') }}
                            </span>
                        </span>
                    </div>
                    <p class="m-0">
                        {{ $message->body }}
                    </p>
                </div>
            @else
                <div class="card shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-small">
                            <a target='_blank'
                                href="{{ route('admin.users.detail', ['id' => $message->user?->id ?? -1, 'lang' => app()->getLocale()]) }}">
                                <img class="avatar-sm img-fluid rounded-circle me-2"
                                    src="{{ asset('/images/' . ($message->user?->avatar ?? 'default.png')) }}">
                                <span class="fw-bold">
                                    {{ $message->user?->name ?? __('Deleted User') }}
                                </span>
                            </a>
                            <span class="ms-2">
                                {{ $message->created_at->format('M d, h:i') }}
                            </span>
                        </span>
                    </div>
                    <p class="m-0">
                        {{ $message->body }}
                    </p>
                </div>
            @endif
        @endforeach
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
                    <button id="emojiTrigger" class="btn btn-circle me-2 btn-primary text-secondary">
                        <span class="far fa-smile-beam"></span>
                    </button>
                    <button id="sendMessage" wire:click="saveMessage" class="btn btn-secondary text-dark">
                        <span class="fas fa-paper-plane me-2"></span>
                        {{ __('Send') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/textarea.js') }}"></script>
</div>
