@extends('layout')

@section('content')
<div class="min-h-screen min-w-screen bg-gradient-to-br from-white to-gray-100 dark:from-black dark:to-gray-900 p-6 flex flex-col items-center">

    {{-- Home Button --}}
    <div class="w-full max-w-7xl flex justify-between mb-6">
        <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow font-semibold transition">
            ← Home
        </a>
        <button
            id="darkModeToggle"
            class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded shadow font-semibold transition"
            onclick="
                if(document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            "
        >
            Toggle Dark Mode
        </button>
    </div>

    {{-- Page Title --}}
    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-8 text-center">
        Our Menu
    </h1>

    {{-- Menu Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 w-full max-w-7xl">
        @if(count($menuItems) === 0)
            <div class="col-span-full text-center text-gray-500 dark:text-gray-300 text-lg">
                No menu items available.
            </div>
        @else
            @foreach($menuItems as $item)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col hover:scale-105 transition-transform">
                    <div class="p-6 flex flex-col flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $item['name'] }}</h2>

                        <p class="text-gray-600 dark:text-gray-300 mb-4 flex-1">
                            @if($item['description'] && trim($item['description']) !== '')
                                {{ $item['description'] }}
                            @else
                                <span class="italic text-gray-400">No description provided.</span>
                            @endif
                        </p>

                        <div class="text-xl font-semibold text-green-600 dark:text-green-400">
                            ${{ number_format($item['price'], 2) }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    // On page load, set theme from localStorage
    if(localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>
@endsection
