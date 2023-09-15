<style>
    .user_profile_section .profile_img img {
        height: 110px !important;
    }

    .fa-user-circle:before {
        content: "\f2bd";
        font-family: 'Font Awesome 5 Free';
    }

    .user_profile_section {
        text-align: center;
        border-bottom: 2px solid #28a745;
        padding: 10px 0;
    }

    .user_management_box .user_icon_left i {
        font-size: 20px;
        color: #fff;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        /* background: #28a74578; */
        text-align: center;
        line-height: 30px;
    }

    .profile_information a {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
    }

    .profile_information {
        padding-top: 10px;
    }

    .user_management_box .user_icon_right i {
        font-size: 20px;
        color: #fff;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        /* background: #28a74578; */
        text-align: center;
        line-height: 30px;
    }

    .user_management_box .user_icon_right {
        float: right;
        clear: both;
        background: transparent;
    }

    .user_management_box .user_icon_left {
        background: transparent;
    }

    div#main_admin_sidebar_section {
        padding-top: 20px;
    }

    .layout-fixed .main-sidebar {
        bottom: 0;
        float: none;
        left: 0;
        position: fixed;
        top: 0;
        background: #0f172a !important;
    }

    div#main_admin_sidebar_section nav ul li a {
        font-size: 18px;
        color: #fff !important;
        padding: 10px;
        border: 0;
    }

    .small-box {
        border-radius: .25rem;
        box-shadow: 0 0 1px rgb(158 134 134 / 13%), 0 1px 3px rgb(97 85 85 / 20%);
        display: block;
        margin-bottom: 20px;
        position: relative;
        background: #fff;
    }

    div#main_admin_sidebar_section nav ul li:hover {
        background: #2c2b48;
    }

    div#main_admin_sidebar_section nav ul li a i {
        margin-right: 5px;
    }

    ul.nav.nav-treeview li a p:before {
        content: '';
        width: 25px;
        height: 2px;
        background: #fff;
        position: absolute;
        left: 0;
        top: 45%;
    }

    ul.nav.nav-treeview li a p {
        margin-left: 16px;
        font-size: 18px;
    }

    div#main_admin_sidebar_section nav ul li a :hover {
        margin-left: 10px;
        transition: all .3s linear;
    }

    div#main_admin_sidebar_section ul.nav.nav-treeview {
        padding: 0 13px;
    }

    div#main_admin_sidebar_section ul.nav.nav-treeview li a.nav-link:hover {
        background: #373651 !important;
    }

    div#main_admin_sidebar_section ul.nav ul.nav.nav-treeview li {
        border-left: 2px solid #fff;
    }

    div#main_admin_sidebar_section ul.nav.nav-treeview li a:hover p {
        margin-left: 28px !important;
        transition: all .3s linear;
    }
</style>

<aside class=" elevation-4    main-sidebar elevation-4 sidebar-light-danger">


    <div class="sidebar_top_profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="user_management_box">
                        <a href="#" class="btn btn-sm user_icon_left"> <i class="far fa-bell"></i></a>
                        <a href="#" class="btn btn-sm user_icon_right"> <i class="fal fa-user-circle"></i></a>

                    </div>
                </div>
            </div>
            <div class="user_profile_section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile_img">

                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('/backend/logo.png') }}" style="" alt="">
                            </a>

                        </div>
                        <div class="profile_information">
                            <a href="#"> {{ Auth()->user()->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="sidebar" id="main_admin_sidebar_section">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i style="color: rgb(9, 250, 101)" class="fas fa-border-all"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                    <a href="#" class="nav-link">
                        <!-- <i class="fas fa-bowling-ball"></i> -->
                        <i style="color: rgb(9, 250, 101)" class=" fa fa-cog "></i>
                        <p>
                            Setup
                            <i style="color: rgb(9, 250, 101)" class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('addUnit') }}" class="nav-link ">
                                <p>Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('addDepartment') }}" class="nav-link ">
                                <p>Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link ">
                                <p>Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link ">
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link ">
                                <p>Product</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i style="color: rgb(9, 250, 101)" class="fa fa-upload"></i>
                        <p>
                            Inventory
                            <i style="color: rgb(9, 250, 101)" class="right fas fa-angle-left"></i>
                        </p>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <p>Add Stock</p>
                                </a>
                            </li>
                        </ul>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i style="color: rgb(9, 250, 101)" class="fa fa-shopping-cart"></i>
                        <p>
                            Sale
                            <i style="color: rgb(9, 250, 101)" class="right fas fa-angle-left"></i>
                        </p>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <p>New Sale</p>
                                </a>
                            </li>
                        </ul>
                    </a>
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
<script></script>
