@extends('layouts.admin-layout')

@section('title') Ambrosia - Admin Panel @endsection
@section('keywords') admin, panel, edit, delete, update, create @endsection
@section('description') Admin page for Ambrosia e-commerce site @endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            @if(Session::get('success'))
                <p class="alert alert-success">{{Session::get('success')}}</p>
            @endif
            @if(Session::get('error'))
                <p class="alert alert-danger">{{Session::get('error')}}</p>
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Log content -->
                        <div class="card">
                            <div class="card-header border-0 row">
                                <div class="col">
                                <h3 class="card-title">Reports</h3>
                                </div>
                                <div  class="col">
                                </div>
                                <div class="col-3">
                                    <div class="rounded d-flex justify-content-between mb-4">
                                        <label for="logs">Sort logs:</label>
                                        <select id="logs" name="logList" class="border rounded form-select-sm bg-light me-3"
                                                form="logForm">
                                            <option value="default">Default</option>
                                            <option value="new">Newest</option>
                                            <option value="old">Oldest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                        <thead class="container">
                                    <tr class="row mx-0">
                                        <th class="col text-left">Name</th>
                                        <th class="col text-center">Messages</th>
                                        <th class="col text-right">Time</th>
                                    </tr>
                                    </thead>
                                    <tbody id="content" style="display:none; height:250px; overflow-y:auto; overflow-x: hidden" tabindex="0"></tbody>
                                    <tbody class="container" style="display:block; height:250px; overflow-y:auto; overflow-x: hidden" tabindex="0" id="messages">
                                    @foreach($logs as $log)
                                    <tr class="row">
                                        <td class="col">
                                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                            {{$log->first_name .' '. $log->last_name}}
                                        </td>
                                        <td class="col">
                                                <p>{{$log->message}}</p>
                                        </td>
                                        <td>{{$log->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- Categories content -->
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Categories</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead class="container">
                                    <tr class="row mx-0">
                                        <th class="col text-left">Name</th>
                                        <th class="col text-center">Time</th>
                                        <th class="col text-right">More</th>
                                    </tr>
                                    </thead>
                                    <tbody class="container" style="display:block; height:250px; overflow-y:auto; overflow-x: hidden" tabindex="0">
                                    @foreach($categories as $category)
                                        <tr class="row">
                                            <td class="col text-left">
                                                <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                                {{$category->name}}
                                            </td>
                                            <td class="col text-left">
                                                <p>{{$category->updated_at}}</p>
                                            </td>
                                            <td class="row text-right">
                                                <a href="{{route('admin.category', [$category->id])}}" class="text-muted col">
                                                    <i class="fa-solid fa-pen mx-2"></i>
                                                </a>
                                                <form action="{{route('category.delete', [$category->id])}}" method="post" class="col">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Contact content -->
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Messages</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead class="container">
                                    <tr class="row mx-0">
                                        <th class="col text-left">Name</th>
                                        <th class="col text-center">Email</th>
                                        <th class="col text-right">Message</th>
                                        <th class="col text-right">More</th>
                                    </tr>
                                    </thead>
                                    <tbody class="container" style="display:block; height:250px; overflow-y:auto; overflow-x: hidden" tabindex="0">
                                    @foreach($contacts as $contact)
                                        <tr class="row">
                                            <td class="col text-left">
                                                {{$contact->name}}
                                            </td>
                                            <td class="col text-center">
                                                <p>{{$contact->email}}</p>
                                            </td>
                                            <td class="col text-right">
                                                <p>{{$contact->message}}</p>
                                            </td>
                                            <td class="col text-right">
                                                <form action="{{route('contact.delete', ['id' => $contact->id])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <!-- Products content -->
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Products</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead class="container">
                                    <tr class="row mx-0">
                                        <th class="col text-left">Name</th>
                                        <th class="col text-center">Price</th>
                                        <th class="col text-right">More</th>
                                    </tr>
                                    </thead>
                                    <tbody class="container" style="display:block; height:250px; overflow-y:auto; overflow-x: hidden" tabindex="0">
                                    @foreach($products as $product)
                                        <tr class="row">
                                            <td class="col text-left">
                                                <img src="{{asset('/assets/img/products/'. $product->image)}}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                                {{$product->name}}
                                            </td>
                                            <td class="col">
                                                <p>${{$product->price}} USD</p>
                                            </td>
                                            <td class="row text-right">
                                                <a href="{{route('admin.product', [$product->id])}}" class="text-muted col">
                                                    <i class="fa-solid fa-pen mx-2"></i>
                                                </a>
                                                <form action="{{route('product.delete', ['id' => $product->id])}}" method="post" class="col">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Sales content -->
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Users</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead class="container">
                                    <tr class="row mx-0">
                                        <th class="col text-left">Name</th>
                                        <th class="col text-center">Email</th>
                                        <th class="col text-right">Role</th>
                                        <th class="col text-right">More</th>
                                    </tr>
                                    </thead>
                                    <tbody class="container" style="display:block; height:250px; overflow-y:auto; overflow-x: hidden" tabindex="0">
                                    @foreach($users as $user)
                                        <tr class="row">
                                            <td class="col text-left">
                                                <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                                {{$user->first_name . ' ' . $user->last_name}}
                                            </td>
                                            <td class="col text-left">
                                                <p>{{$user->email}}</p>
                                            </td>
                                            <td class="col text-center">
                                                    {{$user->role}}
                                            </td>
                                            <td class="row text-right">
                                                <a href="{{route('admin.user', [$user->id])}}" class="text-muted col">
                                                    <i class="fa-solid fa-pen mx-2"></i>
                                                </a>
                                                <form action="{{route('admin.user.delete', [$user->id])}}" method="post" class="col">
                                                    @csrf
                                                    @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('admin.scripts')
   <script type="text/javascript">
       $('#logs').click(function (){
           let value = $('#logs').val();
           if(value != 'default'){
               $('#messages').hide();
               $('#content').css('display', 'block');
           }else{
               $('#messages').show();
               $('#content').css('display', 'none');
           }
           $.ajax({
               type: 'get',
               url: '{{\Illuminate\Support\Facades\URL::to('/admin/sorting')}}',
               data: {value: value},
               success: function (data){
                   console.log(data);
                   $('#content').html(data);
               }
           })
       })
   </script>
@endsection
