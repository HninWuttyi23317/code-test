@extends('layouts.main')
@section('content')
    <main>
        <div class="container mt-5">
            <h1>Add Employee</h1>
            <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" id="" class="form-control">
                    @error('name')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="">
                    @error('email')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="">
                    @error('phone')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="company_id" class="form-label">Category</label>
                    <select name="company_id" id="" class="form-control text-danger">
                        <option value="null">Choose Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company['name'] }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label>Profile</label>
                    <input class=" form-control" type="file" value="{{old('profile')}}" name="profile" accept="image/jpg,image/png,image/jpeg">
                    @error('profile')
                        <div class="form-error">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <button type="submit" class="btn btn-danger">Add Employee</button>
                </div>
            </form>
        </div>
    </main>
@endsection
