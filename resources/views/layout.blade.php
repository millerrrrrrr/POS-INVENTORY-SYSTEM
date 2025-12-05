<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col md:flex-row bg-gray-100">
    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-base-200 p-6 flex flex-col justify-between">
        <!-- Top Links -->
        <div>
            <h1 class="text-2xl font-bold mb-8">Rhaw Moto Shop</h1>
            <ul class="menu space-y-2 w-full">
                <li>
                    <a href=" {{ route('home') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href=" {{ route('categoryIndex') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Category
                    </a>
                </li>
                <li>
                    <a href=" {{ route('addProduct') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Add Product
                    </a>
                </li>
                <li>
                    <a href=" {{ route('productList') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Product List
                    </a>
                </li>
                <li>
                    <a href=" {{ route('stockIndex') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Stock Management
                    </a>
                </li>
                <li>
                    <a href=" {{ route('utilityIndex') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Utility
                    </a>
                </li>
            </ul>
        </div>

        <!-- Bottom Dropdown -->
        <div class="mt-8">
            <div class="dropdown dropdown-top w-full">
                <label tabindex="0"
                    class="block w-full px-4 py-2 rounded-lg font-medium bg-base-100 cursor-pointer transition
                hover:bg-base-300">
                    Account
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-full">
                    <li>
                        <a href=" {{ route('AccountSettings') }} "
                            class="block w-full px-3 py-2 rounded-lg transition hover:bg-base-200">
                            Account Settings
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('changePasswordIndex') }} "
                            class="block w-full px-3 py-2 rounded-lg transition hover:bg-base-200">
                            Change Password
                        </a>
                    </li> --}}
                    <li>
                        <form method="POST" action=" {{ route('logout') }} ">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-3 py-2 rounded-lg transition hover:bg-base-200">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col p-4 md:p-10">
        <!-- Wrapper with rounded corners -->
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <!-- Title Bar -->
            <div class="bg-base-200 px-6 py-3 md:px-8 md:py-4">
                <h1 class="text-xl md:text-2xl font-bold">@yield('pagetitle')</h1>
            </div>

            <!-- Blank Content -->
            <div class="p-4 md:p-8  text-black">
                @yield('main')
            </div>
        </div>
    </div>




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
