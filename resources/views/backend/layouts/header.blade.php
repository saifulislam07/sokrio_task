<!-- Navbar -->

<style>
    nav.main-header ul li a {
        font-size: 18px;
        color: #333 !important;
        font-weight: 500 !important;
    }

    ul.quick_access_btn {
        list-style: none;
        margin: 0;
    }

    ul.quick_access_btn li {
        display: inline-block;
    }

    ul.quick_access_btn li .btn {
        font-size: 18px !important;
        font-weight: 500 !important;
        color: #333;
        text-transform: uppercase;
        border: 2px solid #28a745;
        background: #28a74529;
    }

    ul.quick_access_btn li {
        display: inline-block;
        margin: 0 10px;
    }

    ul.quick_access_btn li .btn:hover {
        background: #28a745;
        transition: all .3s linear;
        color: #fff !important;
    }

    .main-header .navbar-nav .nav-item a {
        font-weight: 500 !important;
        text-transform: uppercase;
        padding: 0 20px;
    }

    .main-header .navbar-nav .nav-item a .fas {
        font-size: 30px;
        color: #28a745;
    }

    .content-wrapper section.content .card.card-default .card-header h3 {
        font-size: 24px;
    }

    ol.breadcrumb li.breadcrumb-item a {
        font-size: 16px;
        font-weight: 500 !important;
    }

    table#systemDatatable tbody td a:hover .fa {
        color: #28a745;
        transition: all .3s linear;
    }

    section.content .card.card-default .card-header:before {
        width: 20px;
        height: 20px;
        content: '';
        position: absolute;
        background: #28a745;
        left: 0;
        top: 0;
        border-radius: 0 10px;
    }
</style>


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-border-all"></i></a>
        </li>
    </ul>

    <ul class="quick_access_btn">

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">

            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>



        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">




                <span class="hidden-xs"> {{ Auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header  bg-info">
                    <img width="10px" class="user-image" src="{{ asset('/backend/logo.png') }}" style=""
                        alt="">
                    <p>
                        {{ Auth()->user()->name }}
                        <small>Member since Nov. 2023</small>
                    </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">

                    <div class="pull-right">

                        <a class="btn btn-default btn-flat btn-block" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                      document.getElementById('admin-logout-form').submit();">Log
                            Out</a>
                        <form id="admin-logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </li>



        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
