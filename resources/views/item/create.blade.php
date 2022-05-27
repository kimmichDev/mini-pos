@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-6">
                <div class="border p-3 shadow rounded">
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
                                <i class="bi bi-plus-circle-fill"></i>
                                Create
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <h5 class="card-header">Create item</h5>
                    <div class="card-body">
                        <x-photo-upload />
                        <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <small class="small text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
