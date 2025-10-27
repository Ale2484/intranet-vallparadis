<div id="confirmable-modal" class="w-screen h-screen bg-black/20 z-20 fixed inset-0 hidden">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <div class=" w-4/12 p-3 bg-white rounded-lg flex flex-col gap-3">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#fef5eb] rounded-full flex items-center justify-center text-[#FF7E13]">
                    <svg class="w-9 h-9">
                        <use xlink:href="#icon-warning"></use>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-[#011020]">Alerta!</p>
            </div>
            <p id="confirmable-message-container" class="ml-15 text-[#011020]"></p>

            <div class="mt-3 w-full flex items-center justify-end gap-3">
                <button id="close-confirmable-modal" class="w-24 bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
                    Cancel·lar
                </button>
                <button id="send-confirmable-modal" class="w-24 bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Acceptar
                </button>
            </div>
        </div>
    </div>
</div>