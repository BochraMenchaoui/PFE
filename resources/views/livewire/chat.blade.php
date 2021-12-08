<div>
    <!-- TODO: debounce the message so it does not spam the server-->
    <textarea wire:model="message" cols="30" rows="10"></textarea>
    <button wire:click="saveMessage">send</button>
</div>
