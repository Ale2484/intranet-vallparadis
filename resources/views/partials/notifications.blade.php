<div id="notification" class="flex items-center gap-5 notification hidden"
    data-message="{{ session('success') ?? session('error') }}"
    data-type="{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}">

    
    <svg class="w-8 h-8">
        <use id="notification-icon" xlink:href="#icon-check-circle"></use>
    </svg>
    <p id="notification-message"></p>
</div>
