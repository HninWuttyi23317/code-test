@extends('layouts.main')
@section('content')
<main>
    <div class="container mt-5">
        <h1 class="mt-3 mb-3">Edit Product</h1>
        <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{$product->name}}" name="name" id="">
                @error('name')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" value="{{$product->description}}" name="description" id="">
                @error('description')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" value="{{$product->price}}" name="price" id="">
                @error('price')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" min="1" max="100" value="{{$product->quantity}}" name="quantity" id="">
                @error('quantity')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category['name']}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" value="" name="image" id="" accept="image/jpg,image/png,image/jpeg">
                @error('image')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>
</main>
@endsection
