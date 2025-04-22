<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LICT Ecommerce</title>
    <link rel="icon" href="{{asset('images/lictlogo.png')}}" type="image/x-icon">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/>
</head>
<body>
    @include('layouts.alert')
    <div class="flex justify-between items-center px-16 py-2 bg-blue-900 text-white">
        <p>F|T|I|Y</p>
        <p>Call Us: 9876543210</p>
    </div>
    <nav class="shadow bg-white px-16 py-4 flex justify-between items-center mb-10 sticky top-0 z-40">
        <img src="{{asset('images/lictlogo.png')}}" alt="" class="h-16">
        <form action="{{route('search')}}" method="GET">
            <input type="search" class="border border-gray-300 rounded-lg px-3 py-2" placeholder="Search" name="search" value="{{request()->query('search')}}">
            <button type="submit" class="bg-blue-900 text-white rounded-lg px-4 py-2">Search</button>
        </form>
        <div class="flex gap-4 items-center">
            <a href="{{route('home')}}" class="hover:text-blue-900">Home</a>
            @php
                $categories = App\Models\Category::orderBy('priority')->get();
            @endphp
            @foreach($categories as $category)
            <a href="{{route('categoryproduct',$category->id)}}" class="hover:text-blue-900">{{$category->name}}</a>
            @endforeach

            @auth
            <div class="group relative">
                <i class="ri-user-3-line text-xl bg-gray-200 p-2 rounded-full cursor-pointer"></i>
                <div class="absolute hidden group-hover:block top-8 -right-10 bg-white shadow w-32 rounded-md border">
                    <a href="{{route('mycart')}}" class="block py-2 hover:bg-gray-200 p-4 rounded-md">My Cart</a>
                    <a href="" class="block py-2 hover:bg-gray-200 p-4 rounded-md">My Orders</a>
                    <a href="" class="block py-2 hover:bg-gray-200 p-4 rounded-md">My Profile</a>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="block py-2 hover:bg-gray-200 p-4 rounded-md w-full text-left">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{route('login')}}" class="hover:text-blue-900">Login</a>
            @endauth
        </div>
    </nav>
    @yield('content')
    <footer class="bg-blue-900 text-white px-16 py-4 mt-10">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <h1 class="text-2xl">LICT Ecommerce</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
            </div>
            <div>
                <h1 class="text-2xl">Quick Links</h1>
                <ul>
                    <a href="{{route('home')}}"">Home</a>
                    <li>Electronics</li>
                    <li>Groceries</li>
                    <li>Fashion</li>
                    <li>Accessories</li>
                </ul>
            </div>
            <div>
                <h1 class="text-2xl">Contact Us</h1>
                <p>Address: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                <p>Phone: 9876543210</p>
                <p>Email: info@info.com</p>
            </div>
        </div>
    </footer>
</body>
</html>
