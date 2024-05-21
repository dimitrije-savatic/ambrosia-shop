@extends('layouts.layout')

@section('title')
    Ambrosia - Contact
@endsection
@section('keywords')
    fruits, vegetables, e-commerce, site
@endsection
@section('description')
    Contact page of Ambrosia e-commerce site
@endsection

@section('currentPage')
    Contact
@endsection

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Get in touch</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100"
                                    style="height: 400px;"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd"
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger text">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('contact.store')}}" id="form" method="post">
                            @csrf
                            <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name" name="name">
                            <input type="email" class="w-100 form-control border-0 py-3 mb-4"
                                   placeholder="Enter Your Email" name="email">
                            <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10"
                                      placeholder="Your Message" name="message"></textarea>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                                    type="submit">Submit
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-2">23th Avenue, New York. USA</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Mail Us</h4>
                                <p class="mb-2">ambrosia@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-2">(+01) 2553 7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
