<x-layouts.app :title="__('Blogs')">
    <div class="container my-5">
        <h1 class="text-center mb-4 text-4xl font-bold">All Blogs</h1>
        <div class="row">

            @if (empty($blogs))
                <div class="col-12">
                    <h1 class="text-center text-2xl font-bold">No blogs available.</p>
                </div>
            @else
                <div class="grid grid-cols-4 gap-3 mt-20 justify-center">
                    @foreach ($blogs as $blog)
                        <div class="col-md-4 mb-4">
                            <div class="card h-50">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog['title'] }}</h5>
                                    <p class="card-text">{{ $blog['content'] }}</p>
                                    <p class="card-text"><small class="font-bold">Genre: {{ $blog['genre'] }}</small>
                                    </p>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
