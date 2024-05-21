@extends('layouts.admin-layout')

@section('title') Ambrosia - Admin Panel @endsection
@section('keywords') admin, panel, edit, delete, update, create @endsection
@section('description') Users create page for Ambrosia e-commerce site @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">product-create</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container mt-4 min-vh-100">
            @if (session('success'))
                <div class="alert alert-success">
                    <p>{{session('success')}}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <p>{{session('error')}}</p>
                </div>
            @endif

            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" />
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}" />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" cols="30" rows="10" class="form-control" name="description">{{old('description')}}</textarea>
                </div>
                <div class="mb-3 row">
                    @foreach($categories as $category)
                    <div class="col-md-2">
                        <input type="radio" id="rb-{{$category->name}}" value="{{$category->id}}" name="category_id" @if(old('category_id') == $category->id  ) checked @endif/>
                        <label for="rb-{{$category->name}}">{{$category->name}}</label>
                    </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image"/>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
