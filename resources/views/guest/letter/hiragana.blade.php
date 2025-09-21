@extends('layouts.app')

@section('title', 'ひらがな')
    
@section('content')
<div class="row">
    @foreach ($categories as $category)
        <div class="col-3 mb-1">
            <a href="{{ route('letter.hiragana.show', $category->id) }}" class="text-decoration-none text-secondary">
                <h4 class="card card-body text-center">{{ $category->category }}</h4>
            </a>
        </div>
    @endforeach
</div>
@endsection