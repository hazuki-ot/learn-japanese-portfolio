<div class="row">
    @foreach ($categories as $category)
        <div class="col-3 mb-1">
            <a href="{{ route('pictures. '.' '$category->category'', $category->id)}}" class="text-decoration-none">
                <h4 class="text-center">{{ $category->category }}</h4>
            </a>
        </div>
    @endforeach
</div>