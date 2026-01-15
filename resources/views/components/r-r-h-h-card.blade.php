<!-- Contenedor -->
<div data-clickable-element="true" class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col gap-5 dark:bg-neutral-800 dark:border-neutral-600 cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-700">
    <div class="flex justify-between items-center border-b-1 border-b-[#AFAFAF] pb-5">
        <div class="flex flex-row items-center gap-5">
            <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-group-user"></use>
            </svg>
            </div>
            <a href="{{ route("rrhh.show", $rrhh) }}" class="text-[#012F4A] font-bold text-[20px] dark:text-white main-link">{{ $rrhh->topic }}</a>
        </div>

        <p class="w-20 border-1 p-1 text-center {{ $rrhh->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$rrhh->is_active ? "Actiu" : "Inactiu"}}</p>
    </div>
    <!-- Especificaciones -->
    <div class="flex flex-col gap-3 text-[#0F172A] dark:text-white">
        <div class="flex gap-4 border-b-1 border-b-[#AFAFAF] pb-5 pt-2">
            <div class="flex flex-col gap-4 w-full">
                <h2 class="text-[#012F4A] dark:text-white font-bold text-[20px]">Professional afectat</h2>
                <div class="flex gap-10 items-center">
                    <div class="bg-gray-200 rounded-full h-16 w-16 aspect-square dark:text-white">
                        @if (!$rrhh->userAffectedRelation->profile_photo_path)
                            <minidenticon-svg username="{{ md5($rrhh->userAffectedRelation->id) }}"></minidenticon-svg>
                        @else
                            <img src="{{ asset('storage/' . $rrhh->userAffectedRelation->profile_photo_path) }}" alt="{{ $rrhh->userAffectedRelation->name }}" class="w-16 h-16 bg-gray-200 rounded-full object-cover">
                        @endif
                    </div>
                    {{ $rrhh->userAffectedRelation->name }}
                </div>
                <div class="flex items-center text-[#011020] dark:text-white gap-15 pl-5">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                    <span class="dark:text-white">{{ $rrhh->userAffectedRelation->phone ?? '+34 000 000 000' }}</span>
                </div>
                <div class="flex items-center text-[#011020] dark:text-white gap-15 pl-5">
                    <div>
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-mail"></use>
                        </svg>
                    </div>
                    <span class="dark:text-white">{{ $rrhh->userAffectedRelation->email }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4 border-b-1 border-b-[#AFAFAF] pb-5 pt-2">
            <div class="flex items-center gap-4">
                <svg class="w-6 h-6 dark:text-white">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <h2 class="text-[#012F4A] dark:text-white font-bold text-[20px]">Descripció</h2>
            </div>
            <div class="overflow-hidden break-words whitespace-normal break-all">
                {{ Str::limit($rrhh->description, 500) }}
            </div>
        </div>
    </div>
    
    <!-- Activar/Desactivar -->
    <div class="flex flex-row gap-5 justify-end">
        <div class="w-full items-center flex gap-5 justify-between flex-col md:flex-row">            
            
            <p class="text-sm dark:text-white">Creat: {{ $rrhh->created_at->format("d/m/Y") }} | Actualitzat: {{ $rrhh->updated_at->format("d/m/Y") }}</p>
            <form action="{{ $rrhh->is_active ? route("rrhh.deactivate", $rrhh) : route("rrhh.activate", $rrhh) }}" method="post">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-max sm:w-max md:w-max lg:w-max flex justify-center gap-3  {{ $rrhh->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $rrhh->is_active ? "Estàs segur que vols desactivar aquest Tema pendent?" : "Estàs segur que vols activar aquest Tema pendent?" }}">
                    <div>
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-power"></use>
                        </svg>
                    </div>
                    {{ $rrhh->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>
    </div>

</div>