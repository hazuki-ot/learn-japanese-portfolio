@extends('layouts.app')

@section('title', 'Category')
    
@section('content')
    <div class="card card-body border border-2">
        <form action="{{ route('admin.category.store') }}" method="post">
            @csrf

            <label for="category" class="form-label">Add Category</label>

            <div class="input-group">
                <input type="text" name="category" id="category" class="form-control">
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
                        <td>Category</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category }}</td>
                            <form action="{{ route('admin.category.delete', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <td class="text-end">
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                    
                                        <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                                
                                    </td>
                            </form>
                        </tr>
                    @empty
                        <P>Category is not found.</P>
                    @endforelse
                </tbody>
            </table>
            {{ $all_categories->links() }}
        </div>
    </div>
@endsection