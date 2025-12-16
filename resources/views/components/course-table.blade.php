<tr class="mb-10 bg-white border-b border-[#AFAFAF] text-[#0F172A] hover:bg-[#eeeeee65] hover:transition-all dark:bg-neutral-800 dark:border-neutral-600 dark:text-white dark:hover:bg-neutral-700">
    <td class="flex items-center gap-2 p-3">
        <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-book"></use>
            </svg>
        </div>
        <a href="{{ route("courses.show", $course) }}" class="text-[#012F4A] font-bold text-[16px] dark:text-white">{{ $course->name }}</a>
    </td>

    <td class="text-center px-3">
        <p class="text-[#FF7E13] font-semibold">{{ $course->users->count() }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $course->type }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $course->modality ? ucfirst($course->modality) : "Aquest curs no te una modalitat electronic"}}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $course->start_date ? date("d/m/Y", strtotime($course->start_date)) : " Sense data d'inici"}}</p>
    </td>

    <td class="text-center px-3">
        <div class="flex items-center justify-center">
            <p class="w-20 border p-1 text-center {{ $course->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$course->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>
    </td>

    <td class="px-3">
        <div class="flex items-center justify-center gap-2 p-2">
            <a href="{{ route("courses.edit", $course) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border w-24 border-[#AFAFAF]">
                Editar
            </a>
            <form action="{{ $course->is_active ? route("courses.deactivate", $course) : route("courses.activate", $course) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-24 flex justify-center gap-3 {{ $course->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $course->is_active ? "Estàs segur que vols desactivar aquest curs?" : "Estàs segur que vols activar aquest curs?" }}">
                    {{ $course->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>
    </td>
</tr>