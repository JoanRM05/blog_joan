<x-layouts.app :title="__('Edit Blog')">
    <div class="container my-5">
        <h1 class="text-center text-4xl font-bold">Edit Blog</h1>
        @if ($blog == null)
            <div class="col-12">
                <h1 class="text-center text-2xl font-bold">No blog available.
                    <a href="{{ route('dashboard') }}" class="text-blue-600"> Return to Dashboard </a>
                </h1>
            </div>
        @else
            <div name="CreateBlog">
                <div class="border rounded-2xl p-10 mt-20 ">
                    <form action="{{ route('updateBlog', ['id' => $blog->id]) }}" method="POST"
                        enctype="multipart/form-data" class="grid gap-5">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-10">
                            <div class="w-full grid grid-cols-1 gap-5">
                                <div class="mt-2">
                                    <label class="text-xl font-bold">Blog Title:</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 mt-5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="title" placeholder="Add title here..." value="{{ $blog->title }}"
                                        required>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-xl font-bold">Blog Category:</label>
                                    <select name="category"
                                        class="w-1/4 px-3 py-2 mt-5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                        <option value="Technology"
                                            {{ $blog->category == 'Technology' ? 'selected' : '' }} class="text-black">
                                            Technology</option>
                                        <option value="Entertainment"
                                            {{ $blog->category == 'Entertainment' ? 'selected' : '' }}
                                            class="text-black">Entertainment</option>
                                        <option value="Lifestyle" {{ $blog->category == 'Lifestyle' ? 'selected' : '' }}
                                            class="text-black">Lifestyle</option>
                                        <option value="Science" {{ $blog->category == 'Science' ? 'selected' : '' }}
                                            class="text-black">Science</option>
                                        <option value="Gaming" {{ $blog->category == 'Gaming' ? 'selected' : '' }}
                                            class="text-black">Gaming</option>
                                        <option value="Literature"
                                            {{ $blog->category == 'Literature' ? 'selected' : '' }} class="text-black">
                                            Literature</option>
                                        <option value="Health" {{ $blog->category == 'Health' ? 'selected' : '' }}
                                            class="text-black">Health</option>
                                    </select>
                                </div>
                                <div class="col-span-full">
                                    <label class="text-xl font-bold">Blog Image:</label>
                                    <div
                                        class="mt-5 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10">
                                        <div class="text-center">
                                            <div id="image-preview">
                                                @if ($blog->image_base64 ?? false)
                                                    <img src="data:image/jpeg;base64,{{ $blog->image_base64 }}"
                                                        alt="Blog Image" class="mx-auto max-w-full h-auto rounded-md">
                                                @else
                                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                @endif
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                                    <label for="file-upload"
                                                        class="relative cursor-pointer rounded-md font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                                                        <span>Upload a file</span>
                                                        <input id="file-upload" name="image" type="file"
                                                            class="sr-only" accept="image/png,image/jpeg,image/gif">
                                                    </label>
                                                </div>
                                                <p class="text-xs/5 text-gray-600">PNG, JPG</p>
                                                <button id="remove-image" type="button"
                                                    class="mt-2 {{ $blog->image_base64 ?? false ? '' : 'hidden' }} text-sm font-semibold text-red-600 hover:text-red-500 cursor-pointer">
                                                    Remove Image
                                                </button>
                                                <input type="hidden" name="image_removed" id="image-removed"
                                                    value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="mt-2">
                                    <label class="text-xl font-bold">Blog Content:</label>
                                    <textarea name="content"
                                        class="w-full px-3 py-2 mt-5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                        rows="16" placeholder="Write your blog content here..." required>{{ $blog->content }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <button onclick="window.location.href='{{ route('allBlogs') }}'"
                                class="bg-red-500 text-white px-5 py-2 rounded-2xl text-xl hover:bg-red-600 transition cursor-pointer font-bold">
                                Delete </button>
                            <input type="submit"
                                class="bg-cyan-500 text-white px-5 py-2 rounded-2xl text-xl hover:bg-cyan-600 transition cursor-pointer font-bold"
                                value="Edit Blog"></input>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>

<script>
    const fileInput = document.getElementById('file-upload');
    const previewContainer = document.getElementById('image-preview');
    const removeButton = document.getElementById('remove-image');
    const imageRemovedInput = document.getElementById('image-removed');

    let hasPreloadedImage = @json($blog->image_base64 ?? false);

    if (hasPreloadedImage) {
        removeButton.classList.remove('hidden');
    }

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" alt="Image Preview" class="mx-auto max-w-full h-auto rounded-md">
                `;
                removeButton.classList.remove('hidden');
                imageRemovedInput.value = '0'; 
            };

            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = `
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
            `;
            removeButton.classList.add('hidden');
            imageRemovedInput.value = hasPreloadedImage ? '1' :
            '0'; 
        }
    });

    removeButton.addEventListener('click', function() {
        fileInput.value = '';
        previewContainer.innerHTML = `
            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
        `;
        removeButton.classList.add('hidden');
        imageRemovedInput.value = '1';
    });
</script>
