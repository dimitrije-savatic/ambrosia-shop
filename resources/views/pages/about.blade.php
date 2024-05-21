@extends('layouts.layout')
@section('title')
    Ambrosia - Home
@endsection
@section('keywords')
    fruits, vegetables, e-commerce, site
@endsection
@section('description')
    Home page of Ambrosia e-commerce site
@endsection

@section('singlePage')

@stop

@section('content')
    <div class="container-fluid mt-5 py-5">
        <div class="container py-5 mt-5" id="container">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="">
                            <img src="{{asset('assets/img/author.jpg')}}" class="img-thumbnail rounded"
                                 alt="author">
                        </div>
                    </div>
                    <div class="col">

                        <p class="mb-4">
                            Greetings! I'm Dimitrije, a passionate 26-year-old web developer hailing from the vibrant
                            city of Belgrade. With a keen eye for detail and a love for all things code-related, I
                            thrive in the digital realm, crafting innovative solutions and pushing the boundaries of web
                            development. When I'm not immersed in lines of code, you can find me exploring new
                            technologies, honing my skills, or simply enjoying the beauty of my city. Let's connect and
                            create something extraordinary together!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
