<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhaw Moto Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">

  <div class="w-full max-w-6xl bg-base-100 shadow-xl rounded-2xl overflow-hidden flex flex-col lg:flex-row">

    <!-- LEFT SIDE (LOGO / BRANDING) -->
    <div class="lg:w-1/2 w-full bg-gray-400 text-black flex flex-col justify-center items-center p-8 sm:p-10">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2 text-center">Rhaw Moto Shop</h1>
        <p class="text-sm sm:text-base opacity-80 text-center">Your trusted motorcycle parts & services</p>

        <!-- Optional Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 sm:w-32 mt-6">
    </div>

    <!-- RIGHT SIDE (LOGIN FORM) -->
    <div class="lg:w-1/2 w-full p-6 sm:p-8">
      <form method="POST" action="{{ route('loginPost') }}">
        @csrf

        <fieldset class="fieldset">
          <legend class="fieldset-legend text-xl sm:text-2xl font-bold mb-6 text-center">
            Login
          </legend>

          <!-- Username -->
          <label class="form-control w-full mb-4 floating-label">
            <input type="text" name="username"
              placeholder="Username"
              class="input input-bordered w-full peer focus:outline-none" />
            <span class="label">Username</span>
          </label>

          <!-- Password -->
          <label class="form-control w-full mb-6 floating-label">
            <input type="password" name="password"
              placeholder="Password"
              class="input input-bordered w-full peer focus:outline-none" />
            <span class="label">Password</span>
          </label>

          <button type="submit" class="btn btn-primary w-full">
            Login
          </button>

        </fieldset>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
        @if (session('success'))
            Toast.fire({ icon: 'success', title: @json(session('success')) })
        @endif

        @if (session('error'))
            Toast.fire({ icon: 'error', title: @json(session('error')) })
        @endif

        @if (session('warning'))
            Toast.fire({ icon: 'warning', title: @json(session('warning')) })
        @endif

        @if (session('info'))
            Toast.fire({ icon: 'info', title: @json(session('info')) })
        @endif

        @if (session('question'))
            Toast.fire({ icon: 'question', title: @json(session('question')) })
        @endif

        @foreach ($errors->all() as $error)
            Toast.fire({ icon: 'warning', title: @json($error) })
        @endforeach
    });
  </script>

</body>
</html>