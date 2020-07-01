@extends('layouts.app')
@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<style>
    .panel-heading {
        z-index: auto;
    }
</style>
@endsection
@section('content')


<div class="main-content-wrap sidenav-open d-flex flex-column">

    <div class="breadcrumb justify-content-between">
        <h1 style="text-align: center"> Contact Us</h1>

    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-address">
                    <div class="alert alert-success" id="success-alert" style="display: none" role="alert"
                        style="text-align: center">
                        <h4 style="text-align: center"> تمت العملية بنجاح </h4>
                    </div>
                    @include('layouts.message')

                    <form method="POST" action="{{route('update.contact_info')}}" id="support-form"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="HadithPart"> phone</label>

                                <input type="text" name="phone" class="form-control  form-group form-control-rounded"
                                    id="phone" value="{{$contact_info->phone ?? ''}}">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <p style="color: red"> @if ($errors->has('phone'))
                                    {{ $errors->first('phone') }} @endif</p>
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="HadithPart"> Email </label>

                                <input type="email" name="email" class="form-control  form-group form-control-rounded"
                                    id="email" value="{{$contact_info->email ?? ''}}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <p style="color: red"> @if ($errors->has('email'))
                                    {{ $errors->first('email') }} @endif</p>
                            </div>



                            <div class="col-md-12 form-group mb-3">
                                <label for="address"> address</label>

                                <textarea name="address" id="address"
                                    class="form-control  form-group form-control-rounded">
                                {{$contact_info->address ?? ''}}         
                                </textarea>

                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection