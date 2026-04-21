<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen flex flex-col md:flex-row bg-gray-100">
    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-base-200 p-6 flex flex-col justify-between">
        <!-- Top Links -->
        <div>
            <div class="flex items-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Rhaw Motor Shop Logo" class="h-15 w-15 mr-3">
                <h1 class="text-md font-bold">Rhaw Motor Shop</h1>
            </div>
            <ul class="menu space-y-2 w-full">
                <li>
                    <a href=" {{ route('home') }}"
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition border-2 border-transparent hover:bg-base-300 hover:border-2 hover:border-white ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>



                        Dashboard
                    </a>
                </li>
                <li>
                    <a href=" {{ route('categoryIndex') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>

                        Category
                    </a>
                </li>
                <li>
                    <a href=" {{ route('addProduct') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Add Product
                    </a>
                </li>
                <li>
                    <a href=" {{ route('productList') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>

                        Product List
                    </a>
                </li>
                <li>
                    <a href=" {{ route('stockIndex') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>


                        Stock Management
                    </a>
                </li>
                <li>
                    <a href=" {{ route('orderIndex') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>

                        Point of Sale
                    </a>
                </li>
                <li>
                    <a href=" {{ route('orderListIndex') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>

                        Order List
                    </a>
                </li>
                {{-- <li>
                    <a href=" {{ route('orderHistoryIndex') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Order History
                    </a>
                </li> --}}
                <li>
                    <a href=" {{ route('salesReport.index') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                        </svg>

                        Sales Report
                    </a>
                </li>
                <li>
                    <a href=" {{ route('salesAnalytics.index') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                        </svg>

                        Sales Analytics
                    </a>
                </li>
                <li>
                    <a href=" {{ route('utilityIndex') }} "
                        class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        Utilities
                    </a>
                </li>
                {{-- <li>
                    <a href=" {{ route('salesReportIndex') }} "
                        class="block w-full px-4 py-2 rounded-lg font-medium transition
              border-2 border-transparent
              hover:bg-base-300 hover:border-2 hover:border-white">
                        Sales Report
                    </a>
                </li> --}}

            </ul>
        </div>

        <!-- Bottom Dropdown -->
        <div class="mt-8">
            <div class="dropdown dropdown-top w-full">
                <label tabindex="0"
                    class="flex items-center gap-3 w-full px-4 py-2 rounded-lg font-medium bg-base-100 cursor-pointer transition
                hover:bg-base-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Account
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-full">
                    <li>
                        <a href=" {{ route('AccountSettings') }} "
                            class="flex items-center gap-3 w-full px-3 py-2 rounded-lg transition hover:bg-base-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

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
                                class="flex items-center gap-3 w-full text-left px-3 py-2 rounded-lg transition hover:bg-base-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>

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
        <div class="rounded-2xl overflow-hidden  shadow-lg">
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
