<tr class="mb-10 bg-white border-b border-[#AFAFAF] text-[#0F172A] hover:bg-[#eeeeee65] hover:transition-all dark:bg-neutral-800 dark:border-neutral-600 dark:text-white dark:hover:bg-neutral-700">
    <td class="flex items-center gap-2 p-3">
        <div class="bg-gray-200 rounded-full h-10 w-10 flex items-center justify-center aspect-square">
            @if (!$user->profile_photo_path)
                <minidenticon-svg username="{{ md5($user->id) }}" class="w-10 h-10"></minidenticon-svg>
            @else
                <img src="{{ asset("storage/" . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="rounded-full w-10 h-10 object-cover">
            @endif
        </div>
        <a href="{{ route('users.show', $user) }}" class="text-[#012F4A] font-bold text-[16px] dark:text-white">{{ $user->name }}</a>
    </td>

    <td class="text-center px-3">
        <p>{{ $user->role_label ?? $user->role }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $user->phone ?? '-' }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $user->email }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '' }}</p>
    </td>

    <td class="text-center px-3">
        <div class="flex items-center justify-center">
            <p class="w-20 border p-1 text-center {{ $user->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $user->is_active ? "Actiu" : "Inactiu" }}</p>
        </div>
    </td>

    <td class="px-3">
        <div class="flex items-center justify-center gap-2 p-2">
            <a href="{{ route('users.edit', $user) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border w-24 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">Editar</a>
            <form action="{{ $user->is_active ? route('users.deactivate', $user) : route('users.activate', $user) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method('PATCH')
                <button type="submit" class="confirmable w-24 flex justify-center gap-3 {{ $user->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}" data-confirm-message="{{ $user->is_active ? 'Estàs segur que vols desactivar aquest usuari?' : 'Estàs segur que vols activar aquest usuari?' }}">
                    {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
        </div>
    </td>
</tr>
