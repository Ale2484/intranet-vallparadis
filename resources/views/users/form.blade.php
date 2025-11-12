<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Información Básica -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-semibold text-[#012F4A] mb-4">Informació bàsica</h2>
        </div>

        <!-- Nombre -->
        <div>
            <label for="name" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-user"></use>
                </svg>
                Nom complet *
            </label>
            <input type="text" name="name" id="name" placeholder="Nom complet de l'usuari" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                Email *
            </label>
            <input type="email" name="email" id="email" placeholder="Email de l'usuari" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Teléfono -->
        <div>
            <label for="phone" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                Telèfon
            </label>
            <input type="text" name="phone" id="phone" placeholder="Telefon de l'usuari" value="{{ old('phone', $user->phone) }}"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror" maxlength="9">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-key"></use>
                </svg>
                Contrasenya *
            </label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="Contrasenya de l'usuari"
                        class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        required minlength="8">
                <svg class=" absolute top-2 right-3 w-6 h-6 text-gray-700 cursor-pointer hover:text-[#FF7E13] transition-all">
                    <use data-id-input="password" class="togglePassword" xlink:href="#icon-eye"></use>
                </svg>
            </div>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Información del Centro -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-xl font-semibold text-[#012F4A] mb-4">Informació del centre</h2>
        </div>

        <!-- Rol -->
        <div>
            <label for="role" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-role"></use>
                </svg>
                Rol *
            </label>
            <select name="role" id="role" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                    required>
                <option value="">Selecciona un rol</option>
                <option value="technical_team" {{ old('role', $user->role) == 'technical_team' ? 'selected' : '' }}>Equip Tècnic</option>
                <option value="management_team" {{ old('role', $user->role) == 'management_team' ? 'selected' : '' }}>Equip Directiu</option>
                <option value="administration" {{ old('role', $user->role) == 'administration' ? 'selected' : '' }}>Administració</option>
                <option value="professional" {{ old('role', $user->role) == 'professional' ? 'selected' : '' }}>Professional</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="status" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-block"></use>
                </svg>
                Estat *
            </label>
            <select name="status" id="status" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                    required>
                <option value="">Selecciona un estat</option>
                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Actiu</option>
                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactiu</option>
                <option value="substitute" {{ old('status', $user->status) == 'substitute' ? 'selected' : '' }}>Substituït</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Taquilla -->
        <div>
            <label for="locker" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-wallet"></use>
                </svg>
                Taquilla *
            </label>
            <input type="text" name="locker" id="locker" value="{{ old('locker', $user->locker) }}" placeholder="Nombre de taquilla"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('locker') border-red-500 @enderror"
                    required>
            @error('locker')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña de taquilla -->
        <div>
            <label for="locker_password" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-key"></use>
                </svg>
                Contrasenya taquilla *
            </label>
            <input type="text" name="locker_password" id="locker_password" value="{{ old('locker_password', $user->locker_password) }}" placeholder="Contrasenya taquilla"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('locker_password') border-red-500 @enderror"
                    required>
            @error('locker_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    @if ($method == "PATCH")
        <a href="{{ route('user.uniformity.edit', $user) }}" class="mt-5 bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
            Editar uniformes

        </a>
    @endif

    <!-- Botones -->
    <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
        <a href="{{ route('users.index') }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
            Cancel·lar
        </a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>