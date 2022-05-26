@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center gy-3">
            <div class="col-12">
                <div class="border p-3 shadow rounded">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="bi bi-house-fill"></i>
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="bi bi-list-ul"></i>
                                Item List
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Photo</td>
                            <td>Category</td>
                            <td>Action</td>
                            <td>Create At</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="align-middle">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <img src="{{ asset('storage/item-photo/' . $item->photo) }}"
                                        class="rounded item-small-photo">
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary">
                                        <i class="bi bi-pen"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('item.destroy', $item->id) }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div>
                                        <i class="me-3 bi bi-clock"></i>
                                        {{ $item->created_at->format('h:i a') }}
                                    </div>
                                    <div>
                                        <i class="me-3 bi bi-calendar"></i>
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
