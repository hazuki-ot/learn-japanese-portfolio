@extends('layouts.app')

@section('title', 'See All Sound')
    
@section('content')

<div class="row">
    <table class="table table-hover ms-3">
        <thead class="table-info small fw-bold">
            <tr>
                <th class="">ID</th>
                <th class="">NAME</th>
                <th class="">FILE_NAME</th>
                <th class="">LANGUAGE</th>
                <th class=""></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_sounds as $sound)
            <tr>
                <td class="text-muted">{{ $sound->id }}</td>
                <td class="text-truncate">{{ $sound->name }}</td>
                <td class="text-muted">{{ $sound->file_name }}</td>
                <td class="text-truncate">{{ $sound->language->language }}</td>
                <td class="">
                    <form action="{{ route('admin.sound.delete', $sound->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td class="col-6 text-muted text-center">No Sounds Found.</td>
            </tr>
            @endforelse

        </tbody>
        
    </table>
    {{ $all_sounds->links() }}
    {{-- @forelse ($all_sounds as $sound)
        <div class="row align-items-center mb-3">
            <div class="col-1 text-truncate">
                <p class="text-muted mb-0">{{ $sound->id }}</p>
            </div>
            <div class="col text-truncate">
                <p class="mb-0">{{ $sound->name }}</p>
            </div>
            <div class="col-auto text-truncate">
                <p class="text-muted mb-0">{{ $sound->file_name }}</p>
            </div>
            <div class="col-3 text-truncate">
                <p class="text-muted mb-0">{{ $sound->language->language }}</p>
            </div>
            <div class="col-1">
                <form action="{{ route('admin.sound.delete', $sound->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                </form>
            </div>
        </div>
    @empty
        <p class="lead text-muted text-center">No Sounds Found.</p>
    @endforelse --}}
    
</div>

    {{-- {{ $all_sounds->links() }} --}}
@endsection