<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-32/100 min-w-[350px] mb-5 flex flex-col gap-5">
        <div>
            <div class="flex flex-row justify-between items-center w-full">
                <div class="flex flex-row justify-between gap-2">
                    <div class="bg-gray-200 rounded-full h-16 w-16">
                        <!-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> -->
                        <!-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> -->
                        <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route("users.show", $user) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $user->name }}</a>
                    </div>
                </div>
                @if($user->is_active)
                    <div class="w-16 border-1 p-1 text-center bg-green-200 text-green-600 border-green-600 rounded-lg">
                        Actiu
                    </div>
                @else
                    <div class="w-16 border-1 p-1 text-center bg-red-200 text-red-600 border-red-600 rounded-lg">
                        Inactiu
                    </div>
                @endif
            </div>
            
            <div class="mt-3 ml-5 space-y-5 ">
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                    <span class="ml-2">{{ $user->centerRelation->name }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-role"></use>
                    </svg>
                    <span class="ml-2">{{ $user->role_label }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                    <span class="ml-2">{{ $user->phone ?? '+34 000 000 000' }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    <span class="ml-2">{{ $user->email }}</span>
                </div>
                <div class="flex items-center text-[#011020]">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-calendar"></use>
                    </svg>
                    <span class="ml-2">
                        @if($user->created_at)
                            {{ $user->created_at->format('d \\d\\e F \\d\\e Y') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <div class="flex flex-row gap-5 justify-end">
            <a href="{{ route('users.edit', $user) }}" 
                class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-1/2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>
            @if($user->is_active)
                <form action="{{ route('users.deactivate', $user) }}" method="POST" class="inline w-1/2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="confirmable text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all w-full flex justify-center gap-3"
                            data-confirm-message="Estàs segur que vols desactivar aquest usuari?">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-power"></use>
                        </svg>
                        Desactivar
                    </button>
                </form>
            @else
                <form action="{{ route('users.activate', $user) }}" method="POST" class="inline w-1/2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="confirmable text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all w-full flex justify-center gap-3"
                            data-confirm-message="Estàs segur que vols activar aquest usuari?">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-power"></use>
                        </svg>
                        Activar
                    </button>
                </form>
            @endif
        </div>
</div>