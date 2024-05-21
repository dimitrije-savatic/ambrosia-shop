@extends('layouts.admin-layout')

@section('title') Ambrosia - Admin Panel @endsection
@section('keywords') admin, panel, edit, delete, update, create @endsection
@section('description') Admin page for Ambrosia e-commerce site @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">category-update</li>
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

            <form action="{{route('admin.category.edit', [$category->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
