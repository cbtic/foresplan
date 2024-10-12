@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">All TablasMaestras</h1>
            </div>
        </div>

        <div class="list-group">
            @foreach($tablas_maestras as $tablas_maestras)
                <a href="{{ route('tablas_maestras.show', $tablas_maestras->id) }}"
                   class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $tablas_maestras->title }}</h5>
                        <small>{{ $tablas_maestras->created_at->diffForHumans() }}</small>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-2">
            <nav aria-label="Page navigation example">
                {{ $tablas_maestras->links() }}
            </nav>
        </div>
    </div>
@endsection