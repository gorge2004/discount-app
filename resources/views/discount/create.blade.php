@extends('index')
@section('title', 'Create Discount ' )
@section('content')
    <div class="row pt-1  justify-content-center min-vh-75 align-items-center">
        <div class="col-10 col-md-6">
            <div class="card pt-5">
                <div class="d-flex pt-2  mb-2 justify-content-center h-50">
                    <h3 class="text-center">Create discount</h3>
                </div>
                <div class="card-body">


                    <form method="POST" action="{{ route('discount.store') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group  mb-2 row">
                            <div class="col-md-12 px-5 input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Title</span>
                                </div>
                                <input id="title" placeholder="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" style="background-color: red;
                                                               color: white;
                                                               margin-top: 0;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <div class="col-md-12 px-5 input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Code</span>
                                </div>
                                <input id="code" placeholder="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    value="{{ old('code') }}">
                                @error('code')
                                    <span class="invalid-feedback" style="background-color: red;
                                                               color: white;
                                                               margin-top: 0;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <div class="col-md-12 px-5 input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Description</span>
                                </div>
                                <input id="description" placeholder="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <span class="invalid-feedback" style="background-color: red;
                                                               color: white;
                                                               margin-top: 0;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <div class="col-md-12 px-5 input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Start at</span>
                                </div>
                                <input id="start_at" placeholder="Start at" type="date"
                                    class="form-control @error('start_at') is-invalid @enderror" name="start_at"
                                    value="{{ old('start_at') }}">
                                @error('start_at')
                                    <span class="invalid-feedback" style="background-color: red;
                                                               color: white;
                                                               margin-top: 0;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2 row">
                            <div class="col-md-12 px-5 input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">End at</span>
                                </div>
                                <input id="end_at" placeholder="End at" type="date"
                                    class="form-control @error('end_at') is-invalid @enderror" name="end_at"
                                    value="{{ old('end_at') }}">
                                @error('end_at')
                                    <span class="invalid-feedback" style="background-color: red;
                                                               color: white;
                                                               margin-top: 0;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 px-5 input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Image</span>
                                </div>
                                <input id="main_image" type="file"
                                    class="form-control @error('main_image') is-invalid @enderror" name="main_image"
                                    >
                                @error('main_image')
                                    <span class="invalid-feedback" style="background-color: red;
                    color: white;
                    margin-top: 0;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-8 offset-4">
                                <button type="submit" class="btn btn-success">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
