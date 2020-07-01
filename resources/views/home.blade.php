<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- Static navbar -->
<nav class="navbar navbar-inverse  navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{-- <a class="navbar-brand" href="#">Blog Name</a> --}}
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                @if ($categories)
                @foreach ($categories as $category)
                <li class="active"><a href="{{url('category') .'/'. $category->id}}">{{$category->category_name}}</a>
                </li>
                @endforeach
                @endif

            </ul>
            <ul class="nav navbar-nav navbar-right">

                @guest
                <li class="active"><a href="{{route('register')}}">Register</a>
                </li>
                <li class="active"><a href="{{route('login')}}">Login</a>
                </li>
                @endguest
                @auth
                <li class="active"><a href="{{url('/logout')}}">Logout</a>
                </li>
                <li class="active"><a href="{{url('/dashboard')}}">dashboard</a>
                </li>
                @endauth

            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<section class="banner-section">
</section>
<section class="post-content-section">
    <div class="container">

        <div class="row">
            @if ($posts)
            @foreach ($posts as $post)
            <div class="col-lg-12 col-md-12 col-sm-12 post-title-block">

                <h1 class="text-center">{{$post->title}}</h1>
                <ul class="list-inline text-center">
                    <li>Author |{{$post->user->name ?? 'auther'}}</li>
                    <li>Category | {{$post->category->category_name}}</li>
                    <li>Date | {{$post->created_at->format('Y:M:D')}}</li>
                </ul>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                {{$post->post}}
            </div>
            @endforeach
            @endif

            <div style="text-align: center">
                {{$posts->links()}}
            </div>
            {{-- <div class="col-lg-3  col-md-3 col-sm-12">
                <div class="well">
                    <h2>Subscription Box</h2>
                    <p>Form Description Goes here</p>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
                <div class="well">
                    <h2>Share love</h2>
                    <ul class="list-inline">
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>

                    </ul>
                </div>
                <div class="well">
                    <h2>About Author</h2>
                    <img src="" class="img-rounded" />
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna</p>
                    <a href="#" class="btn btn-default">Read more</a>
                </div>
                <div class="list-group">
                    <a class="list-group-item active" href="#">
                        <h4 class="list-group-item-heading">List group item heading</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                            diam eget risus varius blandit.</p>
                    </a>
                    <a class="list-group-item" href="#">
                        <h4 class="list-group-item-heading">List group item heading</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                            diam eget risus varius blandit.</p>
                    </a>
                    <a class="list-group-item" href="#">
                        <h4 class="list-group-item-heading">List group item heading</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                            diam eget risus varius blandit.</p>
                    </a> </div>
                <div class="well">
                    <div class="media">
                        <div class="media-left"> <a href="#"> <img data-src="holder.js/64x64" class="media-object"
                                    alt="64x64" style="width: 64px; height: 64px;"
                                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTY5MjIxZTM1NSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NjkyMjFlMzU1Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="
                                    data-holder-rendered="true"> </a> </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4> Cras sit amet nibh libero, in gravida nulla.
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left"> <a href="#"> <img data-src="holder.js/64x64" class="media-object"
                                    alt="64x64" style="width: 64px; height: 64px;"
                                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTY5MjIxZTM1NSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NjkyMjFlMzU1Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="
                                    data-holder-rendered="true"> </a> </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4> Cras sit amet nibh libero, in gravida nulla.
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left"> <a href="#"> <img data-src="holder.js/64x64" class="media-object"
                                    alt="64x64" style="width: 64px; height: 64px;"
                                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTY5MjIxZTM1NSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NjkyMjFlMzU1Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="
                                    data-holder-rendered="true"> </a> </div>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading</h4> Cras sit amet nibh libero, in gravida nulla.
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>


    </div> <!-- /container -->
</section>

<section class="footer-link"><a href="http://bootsnipp.com/grafreez" target="_blank">View Our All Snnips</a></section>