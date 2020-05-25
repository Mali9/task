<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">

            @auth



            <li class="nav-item active">
                <a class="nav-item-hold" href="{{ route('home') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Home</span>
                </a>
                <div class="triangle"></div>
            </li>

            @endauth

            @if(!auth()->check())

            <li class="nav-item active">
                <a class="nav-item-hold" href="{{ url('/login') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Login</span>
                </a>
                <div class="triangle"></div>
            </li>



            @endif



            <li class="nav-item active">
                <a class="nav-item-hold" href="{{ route('contact_us') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Contact Us</span>
                </a>
                <div class="triangle"></div>
            </li>


        </ul>
    </div>


    <div class="sidebar-overlay"></div>
</div>