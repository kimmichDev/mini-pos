@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <h5 class="card-header">Create Category</h5>
                    <div class="card-body">

                        <form action="{{ route('category.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input required type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
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
