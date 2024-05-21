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
                        <h1 class="m-0">Update User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">user-update</li>
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

            <form action="{{route('admin.user.edit', [$user->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}" />
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}" />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="mb-3">
                    <label for="passwordConfirm" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm"/>
                </div>
                <div class="mb-3 row">
                    @foreach($roles as $role)
                        <div class="col-md-2">
                            <input type="radio" id="rb-{{$role->role}}" value="{{$role->id}}" name="role_id" @if($user->role_id == $role->id  ) checked @endif/>
                            <label for="rb-{{$role->role}}">{{$role->role}}</label>
                        </div>
                    @endforeach
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
