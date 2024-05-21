@extends('layouts.layout')

@section('title')
    Ambrosia - Product details
@endsection
@section('keywords')
    fruits, vegetables, e-commerce, site
@endsection
@section('description')
    Product details page of Ambrosia e-commerce website.
@endsection

@section('currentPage')
    Product detail
@endsection

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid mt-5">
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
        <div class="container py-5" id="container">
            <div class="col">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="">
                            <img src="{{asset('assets/img/products/'. $product->image)}}" class="img-fluid rounded"
                                 alt="{{$product->name}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{$product->name}}</h4>
                        <p class="mb-3">Category: {{$product->c_name}}</p>
                        <h5 class="fw-bold mb-3">{{$product->price}} $/kg</h5>
                        <div class="d-flex mb-4">
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p class="mb-4">Crunch into the juiciest {{$product->name}}, bursting with flavor and freshness, straight
                            from our orchards to your table.</p>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <form action="{{route('products.addToCart', ["id" => $product->id])}}" method="post">
                                @csrf
                                @method('post')
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <a id="quantity-minus"
                                           class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                    </div>
                                    <input type="text" id="quantity"
                                           class="form-control form-control-sm text-center border-0"
                                           name="quantity" readonly value="1">
                                    <div class="input-group-btn">
                                        <a id="quantity-plus"
                                           class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description
                                </button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>Experience the essence of freshness since 1975 with Ambrosia's handpicked fruits and
                                    vegetables, delivering unparalleled quality and taste to your doorstep.</p>

                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div
                                                class="row bg-light align-items-center text-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">1 kg</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Country of Origin</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Italy</p>
                                                </div>
                                            </div>
                                            <div
                                                class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Quality</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Organic</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Сheck</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Healthy</p>
                                                </div>
                                            </div>
                                            <div
                                                class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Min Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">1 Kg</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            const quantity = $('#quantity');
            const quantityPlus = $('#quantity-plus');
            const quantityMinus = $('#quantity-minus');
            quantityPlus.click(function () {
                quantity.val(parseInt(quantity.val()) + 1);
            });
            quantityMinus.click(function () {
                quantity.val(parseInt(quantity.val()) - 1);
                if (parseInt(quantity.val()) === 0) {
                    quantity.val(1);
                }
            });
        });
    </script>
@endsection
