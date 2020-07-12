@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans('site.Employees')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{trans('site.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('site.Employees')}}</li>
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
                    <a href="{{url('create/employee')}}" class="btn btn-success">{{trans('site.Add_Employees')}}</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('site.Employees')}}</h3>
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
                                        <th>first_name</th>
                                        <th>last_name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>company</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($employees)
                                    @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{$employee->first_name}}</td>
                                        <td>{{$employee->last_name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->phone}}</td>
                                        <td>{{$employee->company->name}}</td>
                                        <td>
                                            <a href="{{url('edit/employee',$employee->id)}}"
                                                class="btn btn-primary">{{trans('site.edit')}}
                                            </a>
                                            <a href="{{url('delete/employee',$employee->id)}}"
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
                        {{$employees->links()}}
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