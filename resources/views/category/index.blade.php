@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                            <td>Create At</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="align-middle">
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">
                                        <i class="bi bi-pen"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="post"
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
                                        {{ $category->created_at->format('h:i a') }}
                                    </div>
                                    <div>
                                        <i class="me-3 bi bi-calendar"></i>
                                        {{ $category->created_at->format('d-m-Y') }}
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
