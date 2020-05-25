@extends('layouts.app')
@section('content')
@section('styles')

@endsection
<!-- ============ Body content start ============= -->
<div class="main-content-wrap sidenav-open d-flex flex-column">
  
 
    <div class="separator-breadcrumb border-top"></div>

    <!-- end of row -->

    <div class="row mb-4">

        <div class="col-md-12 mb-4">
            <div style="text-align: center">
                @if (Session::has('success'))
                <div class="alert alert-card alert-success" role="alert">
                    <strong class="text-capitalize"></strong>
                    {{Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="card text-left">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class=" terms-form display table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Body</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(count($contents)>0 && !empty($contents))
                                @foreach($contents as $content)
                                <tr>
                                    <td>{{$content->email}}</td>
                                    <td>{{$content->subject}}</td>
                                    <td>{!!$content->body!!}</td>




                                </tr>
                                @endforeach
                                @endif
                            </tbody>

                        </table>

                    </div>
                    {{$contents->links()}}

                </div>
            </div>
        </div>
        <!-- end of col -->
    </div>
    <!-- end of row -->

    <!-- ============ Body content End ============= -->
    @endsection