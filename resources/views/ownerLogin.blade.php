<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rhaw Moto Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-base-200">

  <form class="w-full max-w-sm p-6 bg-base-100 shadow-xl rounded-2xl" method="POST" action="{{ route('loginPost') }}"   >
    @csrf
    <fieldset class="fieldset">
      <legend class="fieldset-legend text-xl font-bold mb-4 text-center">Login</legend>

      <!-- Username -->
      <label class="form-control w-full mb-4 floating-label">
        <input type="text" placeholder="Username" name="username" class="input input-bordered w-full peer focus:outline-none"  />
        <span class="label">Username</span>
      </label>

      <!-- Password -->
      <label class="form-control w-full mb-6 floating-label">
        <input type="password" placeholder="Password" name="password" class="input input-bordered w-full peer focus:outline-none"  />
        <span class="label">Password</span>
      </label>

      <button type="submit" class="btn btn-primary w-full">Login</button>
    </fieldset>
  </form>


     <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: @json(session('success'))
                })
            @endif

            @if (session('error'))
                Toast.fire({
                    icon: 'error',
                    title: @json(session('error'))
                })
            @endif

            @if (session('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: @json(session('warning'))
                })
            @endif

            @if (session('info'))
                Toast.fire({
                    icon: 'info',
                    title: @json(session('info'))
                })
            @endif

            @if (session('question'))
                Toast.fire({
                    icon: 'question',
                    title: @json(session('question'))
                })
            @endif
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'warning',
                    title: @json($error)
                })
                
            @endforeach
        });
    </script>
</body>
</html>