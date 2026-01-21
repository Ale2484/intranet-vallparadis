<div id="filterContainer" data-element-type="{{ $type }}" class="w-screen h-screen bg-black/20 z-20 dark:bg-white/20 fixed inset-0 hidden">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <div class=" w-[40%] min-w-[450px] bg-white rounded-lg flex flex-col dark:bg-neutral-800 dark:border-neutral-600">
            <div class="flex items-center justify-between bg-orange-500 rounded-t-lg p-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-[#FF7E13] dark:bg-neutral-800 dark:border-neutral-600">
                        <svg class="w-8 h-8">
                            <use xlink:href="#icon-adjustments-horizontal"></use>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">Filtres</p>
                </div>
                <button class="close-modal-button cursor-pointer">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-cross"></use>
                    </svg>
                </button>
            </div>
            <hr class="border-orange-800 border-2">
            <div class="p-5">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-[#ffe7de] rounded-lg flex items-center justify-center text-[#FF7E13]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[18px] font-bold text-[#011020] dark:text-white">Ordenar per</p>
                        <p class="text-gray-500 text-sm dark:text-white">Selecciona com vols veure els elements</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="w-full flex flex-wrap gap-3 ">
                        <div class="w-[48%]">
                            <input type="radio" name="order" id="recent-first" class="hidden peer" checked>
                            <label for="recent-first" class="w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex flex-col items-start peer-checked:border-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-orange-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                                </svg>
                                <p class="text-gray-700 dark:text-white">Més recent primer</p>
                            </label>
                        </div>

                        <div class="w-[48%]">
                            <input type="radio" name="order" id="oldest-first" class="hidden peer">
                            <label for="oldest-first" class="w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex flex-col items-start peer-checked:border-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-orange-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" />
                                </svg>
                                <p class="text-gray-700 dark:text-white">Més antics primer</p>
                            </label>
                        </div>

                        <div class="w-[48%]">
                            <input type="radio" name="order" id="az" class="hidden peer">
                            <label for="az" class="w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex flex-col items-start peer-checked:border-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 32 32" class="text-orange-500"><path fill="currentColor" d="m8.188 5l-.22.656L6.032 11H6v.063l-.938 2.593l-.062.156V15h2v-.844L7.406 13h3.188L11 14.156V15h2v-1.188l-.063-.156L12 11.062V11h-.03l-1.94-5.344L9.814 5H8.185zM22 5v18.688l-2.594-2.594L18 22.5l4.28 4.313l.72.687l.72-.688L28 22.5l-1.406-1.406L24 23.687V5zM9 8.656L9.844 11H8.156zM5 17v2h5.563L5.28 24.28l-.28.314V27h8v-2H7.437l5.282-5.28l.28-.314V17z"/></svg>
                                <p class="text-gray-700 dark:text-white">A-Z (alfabètic)</p>
                            </label>
                        </div>
                        <div class="w-[48%]">
                            <input type="radio" name="order" id="za" class="hidden peer">
                            <label for="za" class="w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex flex-col items-start peer-checked:border-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 32 32" class="text-orange-500"><path fill="currentColor" d="M5 5v2h5.563L5.28 12.28l-.28.314V15h8v-2H7.437l5.282-5.28l.28-.314V5zm17 0v18.688l-2.594-2.594L18 22.5l4.28 4.313l.72.687l.72-.688L28 22.5l-1.406-1.406L24 23.687V5zM8.187 17l-.218.656L6.03 23H6v.063l-.938 2.593l-.062.157V27h2v-.844L7.406 25h3.188L11 26.156V27h2v-1.188l-.063-.156L12 23.063V23h-.03l-1.94-5.344L9.814 17H8.185zM9 20.656L9.844 23H8.156z"/></svg>
                                <p class="text-gray-700 dark:text-white">Z-A (invertit)</p>
                            </label>
                        </div>
                        <div class="w-[48%]">
                            <input type="radio" name="order" id="last-modified" class="hidden peer">
                            <label for="last-modified" class="w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex flex-col items-start peer-checked:border-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 15 15" class="text-orange-500"><path fill="currentColor" d="M7.5.85c3.164 0 4.794 2.219 5.5 3.46v.002V2.5a.5.5 0 1 1 1 0v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1h1.733l-.112-.208c-.64-1.126-2.01-2.942-4.62-2.942c-3.44 0-5.651 2.815-5.651 5.65s2.21 5.65 5.65 5.65c1.665 0 3.03-.654 4.001-1.643l.192-.204a5.8 5.8 0 0 0 1.024-1.642l.048-.09a.5.5 0 0 1 .877.47l-.13.296a6.8 6.8 0 0 1-1.072 1.631l-.226.24c-1.152 1.173-2.77 1.942-4.714 1.942c-4.062 0-6.65-3.335-6.65-6.65C.85 4.186 3.438.85 7.5.85"/></svg>
                                <p class="text-gray-700 dark:text-white">Últims modificats</p>
                            </label>
                        </div>

                        <div class="w-[48%]">
                            <input type="radio" name="order" id="first-modified" class="hidden peer">
                            <label for="first-modified" class="w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex flex-col items-start peer-checked:border-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 15 15" class="text-orange-500"><path fill="currentColor" transform="scale(-1,1) translate(-15,0)" d="M7.5.85c3.164 0 4.794 2.219 5.5 3.46v.002V2.5a.5.5 0 1 1 1 0v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1h1.733l-.112-.208c-.64-1.126-2.01-2.942-4.62-2.942c-3.44 0-5.651 2.815-5.651 5.65s2.21 5.65 5.65 5.65c1.665 0 3.03-.654 4.001-1.643l.192-.204a5.8 5.8 0 0 0 1.024-1.642l.048-.09a.5.5 0 0 1 .877.47l-.13.296a6.8 6.8 0 0 1-1.072 1.631l-.226.24c-1.152 1.173-2.77 1.942-4.714 1.942c-4.062 0-6.65-3.335-6.65-6.65C.85 4.186 3.438.85 7.5.85"/></svg>
                                <p class="text-gray-700 dark:text-white">Primers modificats</p>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-5 {{ request()->is('documents*') ? "hidden" : "" }}">
                    <div class="w-12 h-12 bg-[#ffe7de] rounded-lg flex items-center justify-center text-[#FF7E13]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-[18px] font-bold text-[#011020] dark:text-white">Estat</p>
                        <p class="text-gray-500 text-sm dark:text-white">Filtra per estat de l'element</p>
                    </div>
                </div>
                <div class="mt-4 {{ request()->is('documents*') ? "hidden" : "" }}">
                    <div class="w-full flex gap-3">
                        <div class="w-[32%]">
                            <input type="radio" name="status" id="all" class="hidden peer" checked>
                            <label for="all" data-status-type="all" class="status-option w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex justify-center text-gray-700 peer-checked:border-orange-500 dark:text-white">
                                Tots
                            </label>
                        </div>

                        <div class="w-[32%]">
                            <input type="radio" name="status" id="active" class="hidden peer">
                            <label for="active" data-status-type="active" class="status-option w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex justify-center text-gray-700 peer-checked:border-orange-500 dark:text-white">
                                Actius
                            </label>
                        </div>

                        <div class="w-[32%]">
                            <input type="radio" name="status" id="inactive" class="hidden peer">
                            <label for="inactive" data-status-type="inactive" class="status-option w-full cursor-pointer border-1 border-[#AFAFAF] p-2 rounded-lg flex justify-center text-gray-700 peer-checked:border-orange-500 dark:text-white">
                                Inactius
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>