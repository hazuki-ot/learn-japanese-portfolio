@extends('layouts.app')

@section('title', 'Language')
    
@section('content')
    <div class="card card-body border border-2">
        <form action="{{ route('admin.language.store') }}" method="post">
            @csrf

            <label for="language" class="form-label">Add Language</label>

            <div class="input-group">
                <input type="text" name="language" id="language" class="form-control">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>

    
    <div class="row mt-5">
        <div class="col-8 mx-auto">
            <table class="table table-hover align-middle bg-white border table-sm text-secondary text-center">
                <thead class="table-primary small fw-bold">
                    <tr>
                        <td>#</td>
                        <td>Language</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($all_languages as $language)
                        <tr>
                            <td>{{ $language->id }}</td>
                            <td>{{ $language->language }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.language.delete', $language->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.language.edit', $language->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td class="h4">Language is not found.</td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection