<x-layouts.app :title="__('Create Blog')">
    <div class="container my-5">
        <h1 class="text-center text-4xl font-bold">Blog Creation</h1>
        <div name="CreateBlog">
            <div class="border rounded-2xl p-10 mt-20 ">
                <form action="{{ route('createBlog') }}" method="POST" enctype="multipart/form-data" class="grid gap-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-10">
                        <div class="w-full grid grid-cols-1 gap-5">
                            <div class="mt-2">
                                <label class="text-xl font-bold">Blog Title:</label>
                                <input type="text"
                                    class="w-full px-3 py-2 mt-5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    name="title" placeholder="Add title here..." required>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-xl font-bold">Blog Category:</label>
                                <select name="category"
                                    class="w-1/4 px-3 py-2 mt-5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                    <option value="Technology" class="text-black">Technology</option>
                                    <option value="Entertainment" class="text-black">Entertainment</option>
                                    <option value="Lifestyle" class="text-black">Lifestyle</option>
                                    <option value="Science" class="text-black">Science</option>
                                    <option value="Gaming" class="text-black">Gaming</option>
                                    <option value="Literature" class="text-black">Literature</option>
                                    <option value="Health" class="text-black">Health</option>
                                </select>
                            </div>
                            <div class="col-span-full">
                                <label class="text-xl font-bold">Blog Image:</label>
                                <div
                                    class="mt-5 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10">
                                    <div class="text-center">
                                        <div id="image-preview">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
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
                                                class="mt-2 hidden text-sm font-semibold text-red-600 hover:text-red-500 cursor-pointer">
                                                Remove Image
                                            </button>
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
                                    rows="16" placeholder="Write your blog content here..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <input type="submit"
                            class="bg-cyan-500 text-white px-5 py-2 rounded-2xl text-xl hover:bg-cyan-600 transition cursor-pointer font-bold"
                            value="Create Blog"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>

<script>
    const fileInput = document.getElementById('file-upload');
    const previewContainer = document.getElementById('image-preview');
    const removeButton = document.getElementById('remove-image');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" alt="Image Preview" class="mx-auto max-w-full h-auto rounded-md">
                `;
                removeButton.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = `
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
            `;
            removeButton.classList.add('hidden');
        }
    });

    removeButton.addEventListener('click', function() {
        fileInput.value = '';
        previewContainer.innerHTML = `
            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
        `;
        removeButton.classList.add('hidden');
    });
</script>
