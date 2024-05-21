@extends('layouts.layout')

@section('title') Ambrosia - Login @endsection
@section('keywords') fruits, vegetables, e-commerce, site @endsection
@section('description') Login page of Ambrosia e-commerce site @endsection

@section('singlePage')
@stop

@section('content')
    <div class="container-fluid my-4 py-4">
    <div class="container max- my-5 py-5 d-flex justify-content-center ">
        <div class="col-8 p-4 border border-secondary rounded">
            @if ($errors->any())
                <div class="alert alert-danger text">
                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <p>{{session('error')}}</p>
                </div>
            @endif
        <form action="{{route('loginPost')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="mt-2 d-flex">
                <p class="px-1">Still don't have an account?</p><a href="{{route('register')}}" class="text-decoration-none">Register here.</a>
            </div>
        </form>
        </div>
    </div>
    </div>
@endsection
