<div class="lang">
    @if (App::getLocale() == 'en')
        <a wire:click="changeLang('fr')">
            <img
                src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/Flag_of_France.svg/1280px-Flag_of_France.svg.png">
        </a>
    @else
        <a wire:click="changeLang('en')">
            <img
                src="https://upload.wikimedia.org/wikipedia/en/thumb/a/ae/Flag_of_the_United_Kingdom.svg/1200px-Flag_of_the_United_Kingdom.svg.png">
        </a>

    @endif
</div>
