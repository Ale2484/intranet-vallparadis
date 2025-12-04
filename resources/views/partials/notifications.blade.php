<div id="notification" class="flex items-center gap-5 notification hidden z-20 max-w-96"
    data-message="{{ session('success') ?? session('error') }}"
    data-type="{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}">

    
    <svg class="w-8 h-8">
        <use id="notification-icon" xlink:href="#icon-check-circle"></use>
    </svg>
    
    <p id="notification-message"></p>

    <svg id="notification-close" class="w-6 h-6 text-gray-400 cursor-pointer hover:text-gray-600">
        <use xlink:href="#icon-cross"></use>
    </svg>
</div>
