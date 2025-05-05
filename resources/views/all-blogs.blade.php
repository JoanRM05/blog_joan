<x-layouts.app :title="__('All Blogs')">
    <div class="container my-5 mx-5">
        <h1 class="text-center mb-4 text-4xl font-bold">All Blogs</h1>
        <div name="AllBlogs">
            @if ($blogs->isEmpty())
                <div class="col-12">
                    <h1 class="text-center text-2xl font-bold">No blogs available.</p>
                </div>
            @else
                <div
                    class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 mt-20 justify-center">
                    @foreach ($blogs as $blog)
                        <div class="col-md-4 border rounded-2xl cursor-pointer">
                            <a href="{{ route('showBlog', $blog->id) }}">
                                <div name="card">
                                    <div class="img text-center">
                                        @if ($blog->image_base64)
                                            <img src="data:image/jpeg;base64,{{ $blog->image_base64 }}"
                                                class="rounded-t-2xl">
                                        @else
                                            <div
                                                class= "flex-1 overflow-hidden rounded-t-2xl border border-neutral-200 dark:border-neutral-700">
                                                <x-placeholder-pattern
                                                    class=" min-h-61 inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card p-5">
                                        <div class="card-body grid grid-cols-1 gap-5">
                                            <h5 class="card-title font-bold">{{ $blog->title }}</h5>
                                            <p class="card-text break-words line-clamp-2 min-h-12">{{ $blog->content }}
                                            </p>
                                            <div class="flex justify-between">
                                                <p class="card-text flex flex-col">
                                                    <small class="font-bold">
                                                        Category: {{ $blog->category }}
                                                    </small>
                                                    <small class="font-bold">
                                                        Published by: {{ $blog->user->name }}
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
