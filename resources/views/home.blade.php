@extends('layouts.app')
@section('content')



<!--=============== Left side End ================-->

<!-- ============ Body content start ============= -->
<div class="main-content-wrap sidenav-open d-flex flex-column">
    <br>
    <br>
    <div class="separator-breadcrumb border-top">
        <br>
        <br>
        <div class="row">
            <!-- ICON BG -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{url('/email/contents')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Support"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Email Contents</p>

                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{route('contact_info')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Mail"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Contact Info</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ url('/logout') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Library"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Logout</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <br>
    <br>
    {{-- <h1 style="text-align: center">مشروع أحاديث الأحكام </h1> --}}

    @if (Session::has('success'))

    <div class="alert alert-success" role="alert" style="text-align: center">
        <h4 style="justify-content: center"> {{Session::get('success')}} </h4>
    </div>

    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger" role="alert" style="text-align: center">
        <h4 style="justify-content: center">{{Session::get('error')}}</h4>
    </div>

    @endif



    <!-- Footer Start -->

    <!-- fotter end -->
</div>
<!-- ============ Body content End ============= -->
</div>


@endsection