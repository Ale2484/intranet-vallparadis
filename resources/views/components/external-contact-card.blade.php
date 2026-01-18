<div data-clickable-element="true" class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col gap-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-700">
    <div>
        <div class="flex justify-between items-center mb-5">
            <div class="flex flex-row justify-between gap-2">
                <div class="flex flex-row items-center gap-5">
                    <div class="bg-[#ffe7de] rounded-lg p-2">
                        <svg class="w-8 h-8 text-[#FF7E13]">
                            <use xlink:href="#icon-conctact"></use>
                        </svg>
                    </div>
                    <div class="flex flex-col items-start">
                        <p class="text-[#AFAFAF] text-xs md:text-sm font-semibold">{{ $externalContact->category ? Str::upper($externalContact->category) : ""}}</p>
                        <a href="{{ route("external-contacts.show", $externalContact) }}" class="text-[#012F4A] font-bold text-[20px] dark:text-white main-link">{{ $externalContact->contact_person }}</a>
                    </div>
                </div>
            </div>
            @if($externalContact->is_active)
                <div class="w-16 border p-1 text-center bg-green-200 text-green-600 border-green-600 rounded-lg">
                    Actiu
                </div>
            @else
                <div class="w-16 border p-1 text-center bg-red-200 text-red-600 border-red-600 rounded-lg">
                    Inactiu
                </div>
            @endif
        </div>
        
        <div class="mt-3 ml-3 space-y-3 ">
            <div class="flex items-center text-[#011020] dark:text-neutral-400">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-role"></use>
                </svg>
                <p class="ml-2 dark:text-white">{{ $externalContact->company_or_department }}</p>
            </div>

            <div class="flex items-center text-[#011020] dark:text-neutral-400">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <p class="ml-2 dark:text-white">{{ $externalContact->contact_person ?? 'No disponible' }}</p>
            </div>
            <div class="flex items-center text-[#011020] dark:text-neutral-400">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                <p class="ml-2 dark:text-white">{{ $externalContact->email }}</p>
            </div>
        </div>
    </div>
    
    <p class="text-sm">Creat: {{ $externalContact->created_at->format("d/m/Y") }} | Actualitzat: {{ $externalContact->updated_at->format("d/m/Y") }}</p>

    <div class="flex flex-row gap-5 justify-end">
        <a href="{{ route('external-contacts.edit', $externalContact) }}" 
            class="w-full sm:w-full md:w-[50%] flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-square-pen"></use>
            </svg>
            Editar
        </a>
        <form action="{{ $externalContact->is_active ? route("external-contacts.deactivate", $externalContact) : route("external-contacts.activate", $externalContact) }}" method="post" class="w-full sm:w-full md:w-[50%]">
            @csrf
            @method("PATCH")
            <button type="submit"
                class="confirmable w-full sm:w-full md:w-full flex justify-center gap-3 {{ $externalContact->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                data-confirm-message="{{ $externalContact->is_active ? "Estàs segur que vols desactivar aquest contacte?" : "Estàs segur que vols activar aquest contacte?" }}">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-power"></use>
                </svg>
                {{ $externalContact->is_active ? "Desactivar" : "Activar" }}
            </button>
        </form>
    </div>
</div>
