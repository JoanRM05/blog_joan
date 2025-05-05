<x-layouts.app :title="__('Blog')">
    <div class="container my-5">
        @if ($blog == null)
            <div class="col-12">
                <h1 class="text-center text-2xl font-bold">No blog available.
                    <a href="{{ route('dashboard') }}" class="text-blue-600"> Return to Dashboard </a>
                </h1>
            </div>
        @else
            <div name="Blog" class="border rounded-2xl p-10">
                <h1 class="text-center my-5 text-4xl font-bold">{{ $blog->title }}</h1>
                <div class="rounded-2xl grid gap-8">
                    <div class="flex items-end justify-end">
                        <b>Category: {{ $blog->category }}</b>
                    </div>
                    <div class="flex gap-10 flex-col 2xl:flex-row">
                        <div class="text-justify w-full 2xl:w-3/5">{!! nl2br(e($blog->content)) !!}</div>
                        @if ($blog->image_base64)
                            <img src="data:image/jpeg;base64,{{ $blog->image_base64 }}"
                                class="rounded-2xl w-full 2xl:w-2/5 max-h-120">
                        @else
                            <div
                                class="max-h-120 w-full 2xl:w-3/5 flex-1 overflow-hidden rounded-2xl border border-neutral-200 dark:border-neutral-700">
                                <x-placeholder-pattern
                                    class="inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-end">
                            <b>Published by: {{ $blog->user->name }}</b>
                        </div>
                        <div class="flex flex-col items-end">
                            <b>Created at: {{ $blog->created_at }} </b>
                            <b>Update at: {{ $blog->updated_at }} </b>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
