@extends('layouts.main')
@section('title', 'Edit Company')
@section('content')
<main>
    <div class="container mt-5 ">
        <h2 class="text-center">Edit Company</h2>
        <form action="{{route('companies.update',['company'=>$company->id])}}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-3 mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{$company->name}}" name="name" id="">
                @error('name')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Email</label>
                <input class=" form-control" type="email" value="{{$company->email}}" name="email" id="">
                @error('email')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Website link</label>
                <input class=" form-control" type="url" value="{{$company->website}}" name="website" id="">
                @error('website')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label>Company Logo</label>
                <input class=" form-control" type="file" value="{{$company->logo}}" name="logo" accept="image/jpg,image/png,image/jpeg">
                @error('logo')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</main>
@endsection
