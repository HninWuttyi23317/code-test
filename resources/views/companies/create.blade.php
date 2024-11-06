@extends('layouts.main')
@section('title', 'Add Company')
@section('content')
<main>
    <div class="container mt-5">
        <h1>Add company</h1>
        <form action="{{route('companies.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-3 mb-3">
                <label for="">Company</label>
                <input class=" form-control" type="text" value="{{old('name')}}" name="name" id="">
                @error('name')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Email</label>
                <input class=" form-control" type="email" value="{{old('email')}}" name="email" id="">
                @error('email')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Website link</label>
                <input class=" form-control" type="url" value="{{old('website')}}" name="website" id="">
                @error('website')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Company Logo</label>
                <input class=" form-control" type="file" value="{{old('logo')}}" name="logo" accept="image/jpg,image/png,image/jpeg">
                @error('logo')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary col-6">Add</button>
            </div>
        </form>
    </div>
</main>
@endsection
