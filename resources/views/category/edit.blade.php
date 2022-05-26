@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <h5 class="card-header">Edit Category</h5>
                    <div class="card-body">

                        <form action="{{ route('category.update', $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Update Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @if (session('status'))
        <x-swal />
    @endif
@endsection
