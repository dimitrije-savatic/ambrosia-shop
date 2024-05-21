@extends('layouts.layout')

@section('title')
    Ambrosia - Cart
@endsection
@section('keywords')
    fruits, vegetables, e-commerce, site
@endsection
@section('description')
    Cart page of Ambrosia e-commerce website.
@endsection

@section('singlePage')
@show
@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5 my-5">
            @if(session('success'))
                <div class="alert alert-success">
                    <p>{{session('success')}}</p>
                </div>
            @endif
            @if($errors->any())
                <ul class="alert alert-danger">
                   @foreach($errors->all() as $error)
                       <li>{{$error}}</li>
                   @endforeach
                </ul>
            @endif
            <div class="row g-4 justify-content-end mt-1">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @foreach($cartItems as $cartItem)
                                    @if($cartItem->product_id == $product->id)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{asset('assets/img/products/'. $product->image)}}"
                                                         class="img-fluid me-5 rounded-circle"
                                                         style="width: 80px; height: 80px;" alt="">
                                                </div>
                                            </th>
                                            <td>
                                                <p class="mb-0 mt-4">{{$product->name}}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">${{$product->price}}</p>
                                            </td>
                                            <td>
                                                <div class="input-group quantity mt-4" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <form
                                                            action="{{route('products.update.cartItem', [$cartItem->id])}}"
                                                            method="post" id="minusCartItem">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" value="{{$cartItem->quantity-1}}"
                                                                   name="quantity">
                                                            <button type="submit" id="quantity-minus{{$cartItem->id}}"
                                                                    class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <input type="text"
                                                           class="form-control form-control-sm text-center border-0"
                                                           value="{{$cartItem->quantity}}" id="quantity"
                                                    >
                                                    <div class="input-group-btn">

                                                        <form
                                                            action="{{route('products.update.cartItem', [$cartItem->id])}}"
                                                            method="post" id="plusCartItem">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" value="{{$cartItem->quantity+1}}"
                                                                   name="quantity">
                                                            <button type="submit" id="quantity-minus{{$cartItem->id}}"
                                                                    class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">${{number_format($product->price * $cartItem->quantity, 2)}}</p>
                                            </td>
                                            <td>
                                                <form action="{{route('products.delete.cartItem', $cartItem->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-md rounded-circle bg-light border mt-4">
                                                        <i class="fa fa-times text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endif

                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">${{number_format($subtotal, 2)}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">$3.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">${{number_format($subtotal+3,2)}}</p>
                        </div>
                        <form action="{{route('products.order', [\Illuminate\Support\Facades\Auth::user()->id])}}" method="post">
                            @csrf
                        <button
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="submit">Order
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection

