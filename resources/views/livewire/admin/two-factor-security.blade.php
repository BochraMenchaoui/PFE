<div class="col-12 col-xl-12">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row d-block d-md-flex align-items-center">
                <div class="col">
                    <h3 class="h5">
                        {{ __('2F Authentication') }}
                        @if ($enabled)
                            <span id="badge" class="badge bg-success">
                                <small id="badgeRole">
                                    {{ __('Enabled') }}
                                </small>
                            </span>
                        @else
                            <span id="badge" class="badge bg-danger">
                                <small id="badgeRole">
                                    {{ __('Disabled') }}
                                </small>
                            </span>
                        @endif
                    </h3>
                    <p class="small">
                        {{ __('Keep your account secure by enabling two-factor authentication.') }}
                    </p>
                </div>
                @if ($enabled)
                    <div class="col-auto">
                        <button wire:click="requestPassword(1, 0)" class="btn btn-dark">
                            {{ __('Disable') }}
                        </button>
                    </div>
                @else
                    <div class="col-auto">
                        <button wire:click="requestPassword(1, 1)" class="btn btn-dark">
                            {{ __('Enable') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
