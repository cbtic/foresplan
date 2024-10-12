@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <p>{{ $post->title }}</p>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                       Delete
                                    </a>

                                    <form id="delete-form" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
