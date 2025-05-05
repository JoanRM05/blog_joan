<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-10 rounded-xl p-5">
        <h1 class="text-5xl font-bold"> Hello, {{ auth()->user()->name }} </h1>
        <h3 class="text-3xl font-bold"> Discover all the blogs <a href="{{ route('allBlogs') }}" class="text-blue-600"> here </a></h3>
    </div>
</x-layouts.app>
