@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <h5 class="card-header">Edit item</h5>
                    <div class="card-body">
                        <img src="{{ asset('storage/item-photo/' . $item->photo) }}" class="w-100" alt="">
                        <form action="{{ route('item.update', $item->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $item->name) }}">
                                @error('name')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price"
                                    value="{{ old('price', $item->price) }}">
                                @error('price')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo">
                                @error('photo')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Create Now</button>
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
