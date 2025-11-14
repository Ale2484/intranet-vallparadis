<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">

  @vite('resources/css/app.css')
  <title>Login - Vallparadis</title>
</head>
<body class="bg-[#FFF9F6]">
  @include('partials.icons')
  @include('partials.notifications')


  <div class="flex flex-col items-center justify-center h-screen">
    <form action="{{ route("login") }}" method="post" class="bg-white rounded-3xl border-1 border-[#AFAFAF] p-10 shadow-2xl w-[30%] min-w-[300px] max-w-[500px]">
      @csrf
      <div class="flex justify-center mb-5">
        <img src="{{ asset("images/vallparadis-logo.svg") }}" alt="vallparadis-logo" class="w-56 mr-10">
      </div>
      <h2 class="text-3xl font-bold mb-10 text-center text-[#012F4A]">Intranet Vallparadis<h2>
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-3">
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF7E13" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
              </svg>    
              <p class="font-bold text-[#012F4A]">Centre * </p>
            </div>
  
          <select name="center" id="center" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF]" required>
            <option value="" selected hidden>Selecciona un centre</option>
            @foreach ($centers as $center)
              <option value="{{ $center->id }}" {{ old("center") == $center->id ? "selected" : "" }}>{{ $center->name }}</option>
            @endforeach
          </select>
  
          </div>
  
          <div class="flex flex-col gap-3">
  
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF7E13" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
              </svg>
              <p class="font-bold text-[#012F4A]">Correu electronic * </p>
            </div>
  
            <input type="email" name="email" id="email" placeholder="Elteucorreu@gmail.com" required value="{{ old("email") }}" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF]">
          </div>
  
          <div class="flex flex-col gap-3">
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF7E13" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
              </svg>
  
              
              <p class="font-bold text-[#012F4A]">Contrasenya * </p>
            </div>
            <div class="relative">
              <input type="password" name="password" id="password" placeholder="La teva contrasenya" required class="w-full border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF]">
              
              <button type="button" data-id-input="password" class="absolute top-2 right-3 togglePassword">
                  <svg class=" w-6 h-6 text-gray-700 cursor-pointer hover:text-[#FF7E13] transition-all">
                      <use class="togglePassword" xlink:href="#icon-eye"></use>
                  </svg>
              </button>
            </div>
          </div>
  
          <button type="submit" name="submit" id="submit" class="mt-4 w-full font-bold bg-[#FF7E13] text-white rounded-lg p-2 flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
              </svg>
              Inicia sessió
          </button>
            
        </div>
    </form>
  </div>
</body>
@vite("resources/js/notifications.js")
@vite("resources/js/togglePassword.js")

</html>