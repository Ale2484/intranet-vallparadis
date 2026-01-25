<div data-clickable-element="true" class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col gap-5 dark:bg-neutral-800 dark:border-neutral-600 cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-700">
        <div>
            <div class="flex justify-between items-center mb-5">
                <div class="flex flex-row justify-between gap-2">
                    <div class="bg-gray-200 rounded-full h-16 w-16 aspect-square">
                        @if (!$user->profile_photo_path)
                            <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                        @else
                            <img src="{{ asset("storage/" . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="rounded-full w-16 h-16 object-cover">
                        @endif
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route("users.show", $user) }}" class="text-[#012F4A] font-bold text-[20px] dark:text-white main-link">{{ $user->name }}</a>
                    </div>
                </div>
                @if($user->is_active)
                    <div class="w-16 border p-1 text-center bg-green-200 text-green-600 border-green-600 rounded-lg">
                        Actiu
                    </div>
                @else
                    <div class="w-16 border p-1 text-center bg-red-200 text-red-600 border-red-600 rounded-lg">
                        Inactiu
                    </div>
                @endif
            </div>
            
            <div class="mt-3 ml-5 space-y-5 ">
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6 dark:text-neutral-400">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                    <span class="ml-2 dark:text-white">{{ $user->centerRelation->name }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6 dark:text-neutral-400">
                        <use xlink:href="#icon-role"></use>
                    </svg>
                    <span class="ml-2 dark:text-white">{{ $user->role_label }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6 dark:text-neutral-400">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                    <span class="ml-2 dark:text-white">{{ $user->phone ?? '+34 000 000 000' }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <div class="aspect-square">
                        <svg class="w-6 h-6 dark:text-neutral-400">
                            <use xlink:href="#icon-mail"></use>
                        </svg>
                    </div>
                    <span class="ml-2 dark:text-white">{{ $user->email }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6 dark:text-neutral-400">
                        <use xlink:href="#icon-calendar"></use>
                    </svg>
                    <span class="ml-2 dark:text-white">
                        @if($user->created_at)
                            {{ $user->created_at->format('d \\d\\e F \\d\\e Y') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <div class="w-full flex gap-5 flex-col sm:flex-col justify-center md:flex-row">
            @if (auth()->user()->role != "responsable_equip_tecnic")
                <a href="{{ route('users.edit', $user) }}"
                    class="w-full sm:w-full md:w-[50%] flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF] transition-all dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>
                @if($user->is_active)
                    <form action="{{ route('users.deactivate', $user) }}" method="POST" class="w-full sm:w-full md:w-[50%] lg:w-[50%]">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="confirmable w-full text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all flex justify-center gap-3"
                                data-confirm-message="Estàs segur que vols desactivar aquest usuari?">
                                <div class="aspect-square">
                                    <svg class="w-6 h-6">
                                        <use xlink:href="#icon-power"></use>
                                    </svg>
                                </div>
                            <p>Desactivar</p>
                        </button>
                    </form>
                @else
                    <form action="{{ route('users.activate', $user) }}" method="POST" class="w-full sm:w-full md:w-[50%] lg:w-[50%]">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="confirmable w-full text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all flex justify-center gap-3"
                                data-confirm-message="Estàs segur que vols activar aquest usuari?">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-power"></use>
                            </svg>
                            Activar
                        </button>
                    </form>
                @endif
            @endif
        </div>
</div>