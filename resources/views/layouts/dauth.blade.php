@extends('layouts.base')

@section('body')
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        @yield('content')

        @livewire('auth.dashboard.navbar')

        @livewire('auth.dashboard.aside')

        @isset($slot)
            <!-- Content Start -->
            {{ $slot }}
            <!-- Content End -->
        @endisset
    </div>
@endsection
