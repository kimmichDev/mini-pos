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
                        <div class="mb-3 d-flex justify-content-center">
                            <div selectPhotoContainer class="d-flex w-75 justify-content-center position-relative">
                                <p class="p-3 mb-0 border-1 border text-center rounded shadow" style="cursor: pointer"
                                    onclick="openInput()">Click
                                    to upload image</p>
                            </div>
                            @error('photo')
                                <small class="small text-danger">{{ $message }}</small>
                            @enderror
                        </div>
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
    <script>
        let openInput = () => document.querySelector(".photoInput").click();

        let photoInput = document.querySelector(".photoInput").addEventListener("change", (e) => {
            if (e.target.files.length > 0) {
                let photo = e.target.files[0];
                let fileReader = new FileReader();
                fileReader.onload = (e) => {
                    document.querySelector("[selectPhotoContainer]").innerHTML = `
                <img src="${e.target.result}" class="w-100 text-center rounded">
                    <div editIcon style="width:50px;height:50px;border-radius:50%;top: 50%;right:-5%;transform: translateY(-50%);" class="border text-center position-absolute bg-light">
                        <i class="bi bi-pen-fill text-success" style="line-height:50px;"></i>
                    </div>
                `;
                };
                fileReader.readAsDataURL(photo);
            }
        });

        $("[selectPhotoContainer]").delegate("[editIcon]", "click", () => openInput());
    </script>
    @if (session('status'))
        <x-swal />
    @endif
@endsection
