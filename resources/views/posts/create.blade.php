@extends('layouts.app')
@section('content')



<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Posts</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Posts</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <section class="content">
                        <div class="container-fluid">
                            @include('layouts.message')
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Quick Example</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        @if (isset($post))
                                        <form role="form" action="{{url('/update/post',$post->id)}}" method="POST">
                                            @else

                                            <form role="form" action="{{url('/store/post')}}" method="POST">
                                                @endif
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">title</label>
                                                        <input required @if (isset($post)) value="{{$post->title}}"
                                                            @endif name="title" type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">body</label>
                                                        <textarea required class="form-control" rows="10" cols="30"
                                                            name="post" placeholder="Enter ...">
                                                            @if (isset($post)) {{$post->post}} @endif
                                                        </textarea>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Select Category</label>
                                                        <select required class="form-control" name="category_id">
                                                            @if ($categories)
                                                            @foreach ($categories as $category)
                                                            <option value="{{$category->id}}" @if (isset($post))
                                                                {{$post->category_id == $category->id ? 'selected' : ''}}
                                                                @endif>
                                                                {{$category->category_name}}</option>
                                                            @endforeach

                                                            @endif

                                                        </select>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                    </div>


                                </div>

                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @endsection