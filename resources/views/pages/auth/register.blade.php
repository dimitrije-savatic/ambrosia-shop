@extends('layouts.layout')

@section('title') Ambrosia - Register @endsection
@section('keywords') fruits, vegetables, e-commerce, site @endsection
@section('description') Register page of Ambrosia e-commerce site @endsection

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
                @if(session('success'))
                    <div class="alert alert-success">
                        <p>{{session('success')}}</p>
                    </div>
                @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <p>{{session('error')}}</p>
                        </div>
                    @endif
                <form action="{{route('registerPost')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{@old('first_name')}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{@old('last_name')}}" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{@old('email')}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{@old('password')}}"/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
