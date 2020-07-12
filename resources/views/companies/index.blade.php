@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans('site.Companies')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{trans('site.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('site.Companies')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <a href="{{url('create/company')}}" class="btn btn-success">{{trans('site.add_company')}}</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('site.Companies')}}</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>logo</th>
                                        <th>website url</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($companies)
                                    @foreach ($companies as $Company)
                                    <tr>
                                        <td>{{$Company->name}}</td>
                                        <td>{{$Company->email}}</td>
                                        <td><img width="150" height="50" src="{{$Company->logo}}" alt=""></td>
                                        <td>{{$Company->url}}</td>
                                        <td>
                                            <a href="{{url('edit/company',$Company->id)}}"
                                                class="btn btn-primary">{{trans('site.edit')}}
                                            </a>
                                            <a href="{{url('delete/company',$Company->id)}}"
                                                class="btn btn-danger">{{trans('site.delete')}}
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach

                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <div style="text-align: center;">
                        {{$companies->links()}}
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection