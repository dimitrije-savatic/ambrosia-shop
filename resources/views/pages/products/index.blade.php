@extends('layouts.layout')

@section('title')
    Ambrosia - Products
@endsection
@section('keywords')
    fruits, vegetables, e-commerce, site
@endsection
@section('description')
    Products page of Ambrosia e-commerce website.
@endsection

@section('currentPage')
    Products
@endsection

@section('content')

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="text" id="search" name="search" class="form-control p-3"
                                       placeholder="Find product" aria-describedby="search-icon-1" autocomplete="off"
                                       style="border-radius: 0">
                                <span id="search-icon-1" class="input-group-text p-3" style="border-radius: 0"><i
                                        class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                        form="fruitform">
                                    <option value="default">Default</option>
                                    <option value="date">Newest</option>
                                    <option value="price-asc">Price: low to high</option>
                                    <option value="price-desc">Price: high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach($categories as $category)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#products" id="category{{$category->id}}" class="categories"><i
                                                                class="fas fa-apple-alt me-2"></i>{{$category->name}}
                                                        </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="mb-2">Price</h4>
                                        <input type="range" id="rangeInput" class="form-range w-100" id="rangeInput" name="rangeInput"
                                               min="0" max="5" value="0" oninput="amount.value=rangeInput.value">
                                        <output id="amount" name="amount" min-value="0" max-value="5" for="rangeInput">
                                            0
                                        </output>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Featured products</h4>
                                    @foreach($sales as $sale)
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="{{asset('assets/img/products/'.$sale->image)}}"
                                                     class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">{{$sale->name}}</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">{{$sale->price}} $</h5>
                                                    <h5 class="text-danger text-decoration-line-through">{{$sale->old_price}}
                                                        $</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center my-4">
                                        <a href="#"
                                           class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew
                                            More</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="assets/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute"
                                             style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div id="content"></div>
                            <div class="row g-4 justify-content-center" id="products">
                                @foreach($products as $product)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item  border border-secondary">
                                            <div class="fruite-img">
                                                <img src="{{asset('assets/img/products/' . $product->image)}}"
                                                     class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="p-4 rounded-bottom">
                                                <h4>{{$product->name}}</h4>
                                                <p>{{$product->description}}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">${{$product->price}} / kg</p>
                                                    <a href="{{route('product', $product->id)}}"
                                                       class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

@endsection
@section('scripts')
    <script type="text/javascript">
        $('#search').on('keyup', function () {
            $value = $(this).val();
            $('#products').hide();
            if ($value == ''){
                $('#products').show();
            }
            $.ajax({
                type: 'get',
                url: '{{URL::to('/search')}}',
                data: {'search': $value},
                success: function (data) {
                    console.log(data);
                    $('#content').html(data)
                }
            })
        })

        $('#category1').on('click', function () {
            $('#products').hide();
            $.ajax({
                type: 'get',
                url:'{{\Illuminate\Support\Facades\URL::to('products/links')}}',
                data: {id:1},
                success: function (data){
                    $('#content').html(data)
                }
            })
        })

        $('#category2').on('click', function () {
            $('#products').hide();
            $.ajax({
                type: 'get',
                url:'{{\Illuminate\Support\Facades\URL::to('products/links')}}',
                data: {id:2},
                success: function (data){
                    $('#content').html(data)
                }
            })
        })

        $('#category3').on('click', function () {
            $('#products').hide();
            $.ajax({
                type: 'get',
                url:'{{\Illuminate\Support\Facades\URL::to('products/links')}}',
                data: {id:3},
                success: function (data){
                    $('#content').html(data)
                }
            })
        })

        $('#rangeInput').click(function (){
            if(!$('#content').html() === ''){
                $('#content').hide();
            }
            let value = $('#rangeInput').val();
            if(value == 0){
                $('#products').show();
            }else {
                $('#products').hide();
            }
            $.ajax({
                type: 'get',
                url: '{{\Illuminate\Support\Facades\URL::to('/range')}}',
                data: {price: value},
                success: function (data){
                    $('#content').html(data);
                }
            })
        })

        $('#fruits').click(function (){
            let value = $('#fruits').val();
            if(value != 'default'){
                $('#products').hide();
            }
            $.ajax({
                type: 'get',
                url: '{{\Illuminate\Support\Facades\URL::to('/sorting')}}',
                data: {value: value},
                success: function (data){
                    console.log(data);
                    $('#content').html(data)
                }
            })
        })
    </script>
@endsection


