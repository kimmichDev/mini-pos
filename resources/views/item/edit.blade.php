@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="border p-3 shadow rounded mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="bi bi-house-fill"></i>
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('item.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    Item List
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="bi bi-pen"></i>
                                Edit
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <h5 class="card-header">Edit item</h5>
                    <div class="card-body">
                        <x-photo-upload photo="{{ asset('storage/item-photo/' . $item->photo) }}" />
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
                            <input type="file" class="form-control photoInput d-none" name="photo">
                            <button class="btn btn-primary">Create Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <x-photo-upload-script />
    @if (session('status'))
        <x-swal />
    @endif
@endsection
