<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="row">
    @forelse ($category->pictures as $picture)
        <div class="col-2 me-4 mb-1">
            <img src="{{ asset('storage/images/'. $picture->image) }}" alt="{{ $picture->name }}" class="img-md border border-2 border-secondary">
        </div>
    @empty
        <div class="row">
            <p class="">There is no image.</p>
        </div>
    @endforelse 
</div>
</body>
</html>