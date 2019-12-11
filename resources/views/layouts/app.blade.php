<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dei-daily everything') }}</title>
    <link rel="shortcut icon" href="{{asset('client/images/favicon.png')}}" type="image/x-icon">
    <!-- Scripts -->

    <!-- Fonts -->
    <!-- <link rel="icon" type="image/png" href="img/favicon.png"> -->
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('client/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Icons -->
    <link href="{{ asset('client/css/materialdesignicons.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <!-- Select2 CSS -->
    <link href="{{ asset('client/css/select2-bootstrap.css') }}"/>
    <link href="{{ asset('client/css/select2.min.css') }}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{ asset('client/css/osahan.css') }}" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/custom.css') }}">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('client/css/fontawesome.min.css') }}">

    <!-- Styles -->
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5dd171b2086b20001272742d&product=inline-share-buttons&cms=sop' async='async'></script>
    <script src="{{ asset('client/js/jquery.min.js') }}"></script>
</head>
<body class="explore-{{ $launch_current_explore->id}}">

<div class="overlay_loader" id="loading-image" style="display:none;">
    <div class="loader_center">
        <div class="spinner-border text-secondary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<input type="hidden" id="base_url" value="{{url('/')}}">
<input type="hidden" id="routeName" value="{{\Request::route()->getName()}}">
<input type="hidden" id="request_url" value="{{ collect(request()->segments())->last() }}">
<input type="hidden" id="image_url" value="{{asset('client/images/visa.png')}}">


<nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded osahan-menu">
    <div class="container">
        <a class="navbar-brand" href="{{url('/') }}"> <img width="54"
                src="{{ asset('client/images/logo_explore-'.$launch_current_explore->id.'.png') }}" alt="logo"> </a>


        <ul class="menu d-none d-md-flex">
            <li>
                <a class="btn fill" href="" role="button" id="dropdownMenuLink" data-target="#explore-modal"
                   data-toggle="modal">
                    <i class="fas fa-map-marker-alt"></i> {{ $launch_current_explore->name }}
                </a>
                <div class="sub-menu" style="opacity: 0; visibility: hidden; position: absolute;">
                    <div class="container">
                        <ul class="menu-images">
                            @if(!empty($launch_explore))
                                @foreach($launch_explore as $e)
                                    <li>
                                        <a href="#{{$e->id}}">
                                            <figure>
                                                <img src="{{ $e->image_url }}" alt="">
                                            </figure>
                                            <span>{{$e->name}} </span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a class="btn fill" href="" role="button" id="dropdownMenuLink" data-target="#experience-modal"
                   data-toggle="modal">
                    <i class="fas fa-user-check"></i> {{ $launch_current_experience->name }}
                </a>
                <div class="sub-menu" style="opacity: 0; visibility: hidden; position: absolute;">
                    <div class="container">
                        <ul class="menu-images">
                            @if(!empty($launch_current_explore))
                                @foreach ($launch_current_explore->experience as $ex)
                                    <li>
                                        <a href="{{url('select/experience/'.$ex->id)}}">
                                            <figure>
                                                <img src="{{ $ex->image_url }}" alt="">
                                            </figure>
                                            <span>{{$ex->name}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a class="btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                   <i class="fas fa-shapes"></i> 
                   Categories 
                    <i class="fas fa-chevron-down last"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="display: none !important;"></div>
                <div class="sub-menu" style="opacity: 0; visibility: hidden; position: absolute;">
                    <div class="container">
                        <ul class="menu-images">
                            @if(!empty($launch_categories))
                                @foreach ($launch_categories as $cat)
                                    <li class="rounded">
                                        <a href="{{url('category/'.$cat->id)}}">
                                            <figure style="background: url({{ $cat->image_url }}) no-repeat center center; background-size:cover;">
                                                <!-- <img src="{{ $cat->image_url }}" alt=""> -->
                                            </figure>
                                            <span>{{ $cat->name }}</span>
                                        </a>
                                    </li>
                            @endforeach
                        @endif
                        <!--                                    <li>
                                        <a href="#">View all</a>
                                    </li>-->
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <!-- <div class="dropdown first">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-map-marker-alt"></i> Little India
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
             <a class="dropdown-item" href="#">Item 1</a>
             <a class="dropdown-item" href="#">Item 2</a>
             <a class="dropdown-item" href="#">Item 3</a>
          </div>
       </div> -->

        <!-- <div class="dropdown">
           <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-check"></i> Retail
           </a>

           <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Item 1</a>
              <a class="dropdown-item" href="#">Item 2</a>
              <a class="dropdown-item" href="#">Item 3</a>
           </div>
        </div>

        <div class="dropdown">
           <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
           </a>

           <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a href="#" class="dropdown-item">Grocery & Staples</a>
              <a href="#" class="dropdown-item">Health & Beauty</a>
              <a class="dropdown-item" href="#">Organic Store</a>
              <a class="dropdown-item" href="#">Household</a>
              <a href="#" class="dropdown-item">Prayer Items </a>
              <a href="#" class="dropdown-item">Deepavali Sweets</a>
              <a class="dropdown-item" href="#">Festive Special</a>
              <a class="dropdown-item" href="#">Shop By Store</a>
           </div>
        </div> -->
    <!-- <a class="location-top" href="#" data-target="#explore" data-toggle="modal"><img src="{{asset('client/images/explore.png')}}">  Explore</a>
                 <a class="location-top" href="#" data-target="#experience" data-toggle="modal"><img src="{{asset('client/images/exp.png')}}">  Experience</a> -->
        <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapsed collapse" id="navbarNavDropdown">
            <!-- mobile menu -->
            <ul class="menu d-md-none" style="display: flex">
                <li>
                    <a class="btn fill" href="" role="button" id="dropdownMenuLink" data-target="#explore-modal"
                       data-toggle="modal">
                        <i class="fas fa-map-marker-alt" style="width:20px"></i> {{ $launch_current_explore->name }} <i
                            class="fas fa-chevron-down last"></i>
                    </a>
                    <div class="sub-menu" style="opacity: 0; visibility: hidden; position: absolute;">
                        <div class="container">
                            <ul class="menu-images">
                                @if(!empty($launch_explore))
                                    @foreach($launch_explore as $e)
                                        <li>
                                            <a href="#{{$e->id}}">
                                                <figure>
                                                    <img src="{{ $e->image_url }}" alt="">
                                                </figure>
                                                <span>{{$e->name}} </span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="btn fill" href="" role="button" id="dropdownMenuLink" data-target="#experience-modal"
                       data-toggle="modal">
                        <i class="fas fa-user-check" style="width:20px"></i> {{ $launch_current_experience->name }} <i
                            class="fas fa-chevron-down last"></i>
                    </a>
                    <div class="sub-menu" style="opacity: 0; visibility: hidden; position: absolute;">
                        <div class="container">
                            <ul class="menu-images">
                                @if(!empty($launch_current_explore))
                                    @foreach ($launch_current_explore->experience as $ex)
                                        <li>
                                            <a href="{{url('select/experience/'.$ex->id)}}">
                                                <figure>
                                                    <img src="{{ $ex->image_url }}" alt="">
                                                </figure>
                                                <span>{{$ex->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="menu d-md-none">
                <li>
                    <a class="btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-shapes" style="width:20px"></i>
                        Categories <i class="fas fa-chevron-down last"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                         style="display: none !important;"></div>
                    <div class="sub-menu" style="opacity: 0; visibility: hidden; position: absolute;">
                        <div class="container">
                            <ul class="menu-images">
                                @if(!empty($launch_categories))
                                    @foreach ($launch_categories as $cat)
                                    <li class="rounded">
                                        <a href="{{url('category/'.$cat->id)}}">
                                            <figure style="background: url({{ $cat->image_url }}) no-repeat center center; background-size:cover;">
                                                <!-- <img src="{{ $cat->image_url }}" alt=""> -->
                                                </figure>
                                                <span>{{ $cat->name }}</span>
                                            </a>
                                        </li>
                                @endforeach
                            @endif
                            <!--                                    <li>
                                        <a href="#">View all</a>
                                    </li>-->
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- mobile menu end -->

            <!-- Search block -->
            <div class="search-block searchBlock">
                <form id="searchFormHeader" class="form" autocomplete="off" action="{{ url('search') }}" method="get">
                    <div class="input-group">
                        <input name="search" class="form-control inputChange" placeholder="SEARCH"
                               aria-label="Search products in Your City" type="text">
                        <span class="input-group-btn">
                                    <a href="#" class="search_btn">
                                        <button class="btn" type="button"><i class="fas fa-search"></i></button>
                                    </a>
                                </span>
                    </div>
                </form>
                <!-- dropdown -->
                <div id="search-content-header-block" class="search-content">
                    <div class="block">
                        <span class="title">Brands</span>
                        <span class="result">
                                    <a href="#">Brand 1</a>
                                </span>
                        <span class="result">
                                    <a href="#">Brand 2</a>
                                </span>
                        <span class="result">
                                    <a href="#">Brand 3</a>
                                </span>
                    </div>

                    <div class="block">
                        <span class="title">Categories</span>
                        <span class="result">
                                    <a href="#">Category 1</a>
                                </span>
                        <span class="result">
                                    <a href="#">Category 2</a>
                                </span>
                        <span class="result">
                                    <a href="#">Category 3</a>
                                </span>
                    </div>

                    <div class="block">
                        <span class="title">Merchants</span>
                        <span class="result">
                                    <a href="#">Merchant 1</a>
                                </span>
                        <span class="result">
                                    <a href="#">Merchant 2</a>
                                </span>
                        <span class="result">
                                    <a href="#">Merchant 3</a>
                                </span>
                    </div>

                    <div class="block">
                        <span class="title">Products</span>

                        <span class="result">
                                <table class="table cart_summary">
                                        <tbody>
                                         <tr>
                                            <td class="cart_description">
                                                <h2>Jeyas premium foxtail millet (thinai) 500gm</h2>
                                                <div class="price_block my_price">
                                                    <p class="offer-price"><span class="text-success">S$ 3.20</span></p>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a class="" data-original-title="Add to cart" href="#" title=""
                                                   data-placement="top" data-toggle="tooltip"><i
                                                        class="fas fa-shopping-cart"></i> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_description">
                                                <h2>Jeyas premium turmeric powder 200gm</h2>
                                                <div class="price_block my_price">
                                                    <p class="offer-price"><span class="text-success">S$ 1.50</span></p>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a class="" data-original-title="Add to cart" href="#" title=""
                                                   data-placement="top" data-toggle="tooltip"><i
                                                        class="fas fa-shopping-cart"></i> </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </span>
                    </div>

                </div>
            </div>
            <!-- Search block end -->
            <ul class="list-inline main-nav-right">
                <li class="list-inline-item">
                    <a href="#" class="btn btn-link border-none basket" @if(!empty($user)) data-toggle="offcanvas"
                       @else href="#" data-target="#bd-example-modal" data-toggle="modal" onclick="showlogin(0)" @endif>
                        <i class="fas fa-shopping-cart"></i>
                        <span class="count">
                            <span class="cart-items-count">{{ $launch_cart_product_count }}</span>
                            <span> Item</span><span class="cart-items-count-plural" style="{{ $launch_cart_product_count>1?'':'display:none' }}">s</span>
                        </span>
                    </a>
                </li>
                @if (empty($user))
                    <li class="list-inline-item">
                        <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link border-none"
                           onclick="showlogin(0)">
                            Login
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link border"
                           onclick="showlogin(1)">
                            Register
                        </a>
                    </li>
                @else
                    <li class="list-inline-item dropdown osahan-top-dropdown">
                        <a class="btn btn-theme-round dropdown-toggle dropdown-toggle-top-user" href="#"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">  @if(!empty($user->photo_url))
                                <img src="{{ $user->photo_url }}">
                            @else
                                <img src="{{asset('client/images/login.png')}}">
                            @endif
                            <strong>Hi</strong> {{ $user->first_name }} {{ $user->last_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-list-design">
                            <a href="{{url('/get_profile') }}" class="dropdown-item"><i aria-hidden="true"
                                                                                        class="mdi mdi-account-outline"></i>
                                My Profile</a>
                            <a href="{{ url('my_address') }}" class="dropdown-item"><i aria-hidden="true"
                                                                                       class="mdi mdi-map-marker-circle"></i>
                                My Address</a>
                            <a href="{{url('/saved_cards') }}" class="dropdown-item"><i aria-hidden="true"
                                                                                        class="mdi mdi-credit-card"></i>
                                Saved Cards </a>
                            <a href="{{ url('order_list') }}" class="dropdown-item"><i aria-hidden="true"
                                                                                       class="mdi mdi-format-list-bulleted"></i>
                                Order List</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/logoutuser') }}"><i class="mdi mdi-lock"></i> Logout</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- <nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile page-info">
 <div class="container">
    <div class="collapse navbar-collapse" id="navbarText">
       <ul class="navbar-nav">
          <li class="nav-item"><a href="#" class="nav-link">Grocery & Staples</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Health & Beauty</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Organic Store</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Household</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Prayer Items </a></li>
          <li class="nav-item"><a href="#" class="nav-link">Deepavali Sweets</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Festive Special</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Shop By Store</a></li>
       </ul>
    </div>
 </div>
</nav> -->
@include('flash-message')
<!-- <main class="py-4"> -->
@yield('content')
<!-- </main> -->
<div class="modal fade login-modal-main" id="bd-example-modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong id="success-message">error message</strong>
                </div>
                <div class="alert alert-danger alert-block modal-error-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong id="error-message"></strong>
                </div>
                <div class="login-modal">
                    <div class="row">
                        <div class="col-lg-5 pad-right-0">
                            <div class="login-modal-left text-center">
                                <img src="{{ asset('client/images/login.jpg') }}" alt="login" class="main">
                                <span class="title">COMING <b>SOON</b></span>

                                <!-- <div class="buttons">
                                    <a href="#">
                                        <img src="{{ asset('client/images/android.png') }}" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="{{ asset('client/images/appstore.png') }}" alt="">
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-7 pad-left-0">
                            <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                <span class="sr-only">Close</span>
                            </button>
                            <div class="login-modal-right">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="login" role="tabpanel">
                                        <div id="loginformshow">
                                            <form id="loginform" method="POST" action="{{ url('/login') }}">
                                                @csrf
                                                <h5 class="heading-design-h5">Login to your account</h5>
                                                <fieldset class="form-group">
                                                    <label>Email<span class="mandatory"><sup>*</sup></span></label>
                                                    <input type="email" name="email" id="login_email"
                                                           value="{{  !empty($_COOKIE['email'])? $_COOKIE['email'] : ''  }}"
                                                           class="form-control" placeholder="johnsmith@email.com"
                                                           required>
                                                    <div><span id="login_email-error" class="error"></span></div>

                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>Password<span class="mandatory"><sup>*</sup></span></label>
                                                    <input type="password" name="password" id="login_password"
                                                           value="{{  !empty($_COOKIE['password'])? $_COOKIE['password']  : '' }}"
                                                           class="form-control" placeholder="********" required>
                                                    <div><span id="login_password-error" class="error"></span></div>

                                                </fieldset>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="remember"
                                                                       class="custom-control-input"
                                                                       id="customCheck1" {{ !empty($_COOKIE['password'])? 'checked' : old('remember') ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="customCheck1">Remember
                                                                    me</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <a class="forgot" data-toggle="tab" id="forgotpasswordbtn"
                                                               role="tab"> Forgot Password</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <span class="text-right">Forgot Password</span> -->

                                                <fieldset class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-secondary btn-block">
                                                        Login
                                                    </button>
                                                </fieldset>
                                            </form>
                                            <div class="login-with-sites text-center">
                                                <p>Or login with your social profile:</p>
                                                <a href="{{url('/login/facebook')}}">
                                                    <button class="btn-facebook login-icons btn-lg">
                                                        <i class="fab fa-facebook"></i>
                                                    </button>
                                                </a>
                                                <a href="{{url('/login/google')}}">
                                                    <button class="btn-google login-icons btn-lg">
                                                        <i class="fab fa-google"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>

                                        <div id="forgot" style="display:none;">


                                            <div id="forgotSection">
                                                <form id="forgotpasswordform" method="POST"
                                                      action="{{url('/password/email') }}">
                                                    @csrf
                                                    <h5 class="heading-design-h5">Forgot Password</h5>
                                                    <p class="forgot_text">If you have forgotten your password, enter
                                                        your email address in the field and click Reset password.</p>
                                                    <p class="forgot_text">You will receive a new password and a link to
                                                        sign in. You will be able to change the password later.</p>
                                                    <div class="form-group">
                                                        <label>Email<span class="mandatory"><sup>*</sup></span></label>

                                                        <input type="text" name="email" class="form-control"
                                                               id="forgot_email" value=""
                                                               placeholder="johnsmith@email.com">
                                                        <div><span id="forgot_email-error" class="error"></span></div>
                                                    </div>
                                                    <fieldset class="form-group">
                                                        <button type="submit"
                                                                class="btn btn-lg btn-secondary btn-block">Submit
                                                        </button>
                                                    </fieldset>
                                                </form>
                                            </div>
                                            <div id="resetSection" style="display:none;">
                                                <form id="resetpasswordform" method="POST"
                                                      action="{{url('/password/reset') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email<span class="mandatory"><sup>*</sup></span></label>

                                                        <input type="text" name="email" class="form-control"
                                                               id="reset_email" readonly value=""
                                                               placeholder="example@example.com" readonly="">
                                                        <div><span id="reset_email-error" class="error"></span></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Code<span class="mandatory"><sup>*</sup></span></label>

                                                        <input type="text" name="code" class="form-control"
                                                               id="reset_code" value="" placeholder="Enter the code">
                                                        <div><span id="reset_code-error" class="error"></span></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password<span
                                                                class="mandatory"><sup>*</sup></span></label>

                                                        <input type="password" name="password" class="form-control"
                                                               id="reset_password" value="" placeholder="******">
                                                        <div><span id="reset_password-error" class="error"></span></div>
                                                    </div>
                                                    <fieldset class="form-group">
                                                        <button type="submit"
                                                                class="btn btn-lg btn-secondary btn-block">Reset
                                                            Password
                                                        </button>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="register" role="tabpanel">
                                        <form id="registerform" method="POST" action="{{url('/register') }}">
                                            @csrf
                                            <h5 class="heading-design-h5">Register Now!</h5>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label>First Name<span
                                                                class="mandatory"><sup>*</sup></span></label>

                                                        <input type="text" name="first_name" id="register_firstname"
                                                               value="" class="form-control" placeholder="John">
                                                        <div><span id="first_name-error" class="error"></span></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name<span
                                                                class="mandatory"><sup>*</sup></span></label>

                                                        <input type="text" name="last_name" id="register_lastname"
                                                               value="" class="form-control" placeholder="Smith">
                                                        <div><span id="last_name-error" class="error"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email<span class="mandatory"><sup>*</sup></span></label>

                                                <input type="text" name="email" class="form-control" id="register_email"
                                                       value="" placeholder="johnsmith@email.com">
                                                <div><span id="email-error" class="error"></span></div>
                                            </div>
                                            <div class="form-group" style="display:none;">
                                                <label>Mobile<span class="mandatory"><sup>*</sup></label>

                                                <input type="hidden" name="mobile" value="111111111"
                                                       class="form-control" placeholder="+91 123 456 7890" required>
                                            </div>
                                            <fieldset class="form-group">
                                                <label>Password<span class="mandatory"><sup>*</sup></span></label>
                                                <input type="password" class="form-control" id="register_password"
                                                       name="password" placeholder="********">
                                                <div><span id="password-error" class="error"></span></div>

                                            </fieldset>
                                            <!--  <fieldset class="form-group">
                                                <label>Enter Confirm Password </label>
                                                <input type="password" class="form-control" name="password_confirmation" id="register_confirm-password" placeholder="********" required>
                                             </fieldset> -->

                                            <div class="form-group term_conditions">
                                                <label>By creating an account, you agree to the Dei <br><a href="{{url('terms-and-conditions')}}">Terms and Conditions
                                                        of Use</a> and <a href="{{url('privacy-policy')}}"> Privacy Policy</a></label>
                                            </div>
                                            <fieldset class="form-group">
                                                <button type="submit" id="registerSubmit"
                                                        class="btn btn-lg btn-secondary btn-block">Register
                                                </button>
                                            </fieldset>
                                        </form>
                                        <div class="login-with-sites text-center">
                                            <p>Or login with your social profile:</p>
                                            <a href="{{url('/login/facebook')}}">
                                                <button class="btn-facebook login-icons btn-lg">
                                                    <i class="fab fa-facebook"></i>
                                                </button>
                                            </a>

                                            <a href="{{url('/login/google')}}">
                                                <button class="btn-google login-icons btn-lg">
                                                    <i class="fab fa-google"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center login-footer-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" data-target="#bd-example-modal"  data-toggle="modal" href="#" onclick="showlogin(0)">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-target="#bd-example-modal"  data-toggle="modal" href="#" onclick="showlogin(1)">Register</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="header_explore">
    <div class="modal fade exploreModal" id="explore-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center"> Where would you like to Explore today? </h4>
                    <p>We are happy to provide one-stop solution to your non-stop requirements on goods, services and products! Choose where you would like to shop now.</p>
                </div>
                <div class="lines">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div class="modal-body">
                    <div class="explore_block">
                        <div class="row justify-content-center" id="explore_data">
                            @if(!empty($launch_explore))
                                @foreach($launch_explore as $e)
                                    @if(count($e->experience) > 1)
                                        <div class="col-md text-center">
                                            <a href="" class="explore_img explore-item" id="dropdownMenuLink_{{ $e->id }}" data-target="#experience-modal-{{ $e->id }}"
                                                data-toggle="modal">
                                                <div class="poster">
                                                    <img src="{{ $e->image_url }}">
                                                </div>
                                                <h5>{{$e->name}}</h5>
                                            </a>
                                        </div>
                                    @elseif(count($e->experience) == 1)
                                        <div class="col-md text-center">
                                            <a href="{{url('select/experience/'.$e->experience[0]->id)}}" class="explore_img explore-item" id="dropdownMenuLink_{{ $e->id }}">
                                                <div class="poster">
                                                    <img src="{{ $e->image_url }}">
                                                </div>
                                                <h5>{{$e->name}}</h5>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($launch_explore))
        @foreach($launch_explore as $e)
            @if(count($e->experience) > 1)
                <div class="modal fade exploreModal" id="experience-modal-{{ $e->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="text-center"> What would you like to Experience? </h4>
                                <p>Please choose where you would like to proceed to explore in {{ $e->name }}.</p>
                            </div>
                            <div class="lines">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <div class="modal-body">
                                <div class="explore_block">
                                    <div class="row justify-content-center" id="experience_data_{{ $e->id }}">
                                        @if(!empty($e->experience))
                                            @foreach($e->experience as $ex)
                                                <div class="col-md-4 text-center">
                                                    <a href="{{url('select/experience/'.$ex->id)}}" class="experience_img" id="experience_img_{{ $ex->id }}">
                                                        <div class="poster">
                                                            <img src="{{ $ex->image_url }}">
                                                        </div>
                                                        <h5>{{$ex->name}}</h5>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
<div class="header_explore">
    <div class="modal fade exploreModal" id="experience-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center"> What would you like to Experience? </h4>
                    <p>Please choose where you would like to proceed to explore in {{ $e->name }}.</p>
                </div>
                <div class="lines">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div class="modal-body">
                    <div class="explore_block">
                        <div class="row">
                            @if(!empty($launch_current_explore))
                                @foreach ($launch_current_explore->experience as $ex)
                                    <div class="col-md-4 text-center">
                                        <a href="{{url('select/experience/'.$ex->id)}}" class="explore_img">
                                            <div class="poster">
                                                <img src="{{ $ex->image_url }}">
                                            </div>
                                            <h5>{{$ex->name}}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--  -->

<!-- <section class="section-padding bg-white border-top">
    <div class="container">
       <div class="row">
          <div class="col-lg-4 col-sm-6">
             <div class="feature-box">
                <i class="mdi mdi-truck-fast"></i>
                <h6>Free & Next Day Delivery</h6>
                <p>Lorem ipsum dolor sit amet, cons...</p>
             </div>
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="feature-box">
                <i class="mdi mdi-basket"></i>
                <h6>100% Satisfaction Guarantee</h6>
                <p>Rorem Ipsum Dolor sit amet, cons...</p>
             </div>
          </div>
          <div class="col-lg-4 col-sm-6">
             <div class="feature-box">
                <i class="mdi mdi-tag-heart"></i>
                <h6>Great Daily Deals Discount</h6>
                <p>Sorem Ipsum Dolor sit amet, Cons...</p>
             </div>
          </div>
       </div>
    </div>
 </section> -->
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-4 col-lg">
                <span class="title">Buyer central</span>

                <ul class="list">
                    @if(!empty($user))
                        <li><a href="{{url('/get_profile') }}">My Account</a></li>
                        <li><a href="{{ url('my_address') }}">My Address</a></li>
                        <li><a href="{{url('/saved_cards') }}">Saved Cards</a></li>
                        <li><a href="{{ url('order_list') }}">Order List</a></li>
                    @else
                        <li><a href="#" data-target="#bd-example-modal" data-toggle="modal" onclick="showlogin(0)">Login</a></li>
                        <li><a href="#" data-target="#bd-example-modal" data-toggle="modal" onclick="showlogin(1)">Register</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-12 col-md-4 col-lg">
                <span class="title">QUICK LINKS</span>

                <ul class="list">
                    <li><a href="{{ route('about_us') }}">About us</a></li>
                    <li><a href="{{ route('contact_us') }}">Contact us</a></li>
                    <li><a href="{{ route('gift_certificates') }}">Gift certificates</a></li>
                    <!-- <li><a href="#">Sitemap</a></li> -->
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 col-lg">
                <span class="title">VENDOR CENTRAL</span>

                <ul class="list">
                    <li><a href="{{ route('vendor_register') }}">Vendor Register</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 col-lg">
                <span class="title">CONTACT  US</span>

                <span class="icon"><i class="fas fa-map-marker-alt"></i> Dei Holdings Pte Ltd<br>
                            120 Lower Delta Road,<br>
                            Cendex Centre,<br>
                            #10-14, Singapore <br>
                            169208</span>
                <a class="icon" href="tel:+6563526033"><i class="fas fa-phone"></i> +65 6352 6033</a>
                <a class="icon" href="mailto:contactus@dei.com.sg"><i class="fas fa-envelope"></i> contactus@dei.com.sg</a>
            </div>
            <div class="col-12 col-md-8 col-lg">
                <span class="title">SUBSCRIBE US</span>
                <span>Sign up to receive more interesting offers</span>
                <span>Don't miss out! Subscribe to the Dei Newsletter</span>

                <form action="{{ route('newsletter_signup') }}" method="post" name="" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="email" class="form-control" placeholder="Email" name="subscribe_email" id="subscribe_email">
                    <button id="subsribe_btn">Subscribe</button>
                </form>

                <span class="title">Connect with us</span>

                <ul class="social">
                    <li>
                        <a href="https://www.facebook.com/shopdei" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/dei_sg" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/dei_sg/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="copy">&copy; 2016-2019 Dei.com.sg.</span>
                </div>
            </div>
        </footer>
        @if(!empty($user))
        <div class="cart-sidebar">
            <div class="cart-sidebar-header">
                <h5>
                    MY CART <span>[<span class="cart-items-count">{{ $launch_cart_product_count }}</span> item(s)]</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="fas fa-times"></i></a>
                </h5>
            </div>
            <div class="cart-sidebar-body">
                <div class="card card-body cart-table shop-detail-right">
                    <div class="table-responsive">
                        <table class="table cart_summary">
                            <tbody>
                                @if (empty($launch_cart->products))
                                    <tr>
                                        <td class="text-center total_price" colspan="7"><strong>Empty Cart</strong></td>
                                    </tr>
                                @else
                                @if(!empty($launch_cart))
                                    @foreach ($launch_cart->products as $key=>  $product_item)
                                        @include('cart_productitem')
                                    @endforeach
                                    @endif
                                @endif
                    <!--                                <tr>
                                    <td class="cart_product"><a href="#"><img class="img-fluid" src="{{ asset('client/images/1.jpg') }}"  alt=""></a></td>
                                    <td class="cart_description">
                                        <h2>Haldiram's Gulab Jamun 1kg</h2>
                                        <span class="available"><strong> Available in</strong> - 1 kg</span>
                                        <h6 class="fresh">Reliance Fresh</h6>
                                        <h6><strong> CODE : </strong> 0212 0333 9990</h6>
                                        <div class="price_block my_price">
                                            <p class="offer-price"><span class="text-success">S$40.99</span></p>
                                            <p class="regular-price">S$80.99</p>
                                        </div>
                                    </td>
                                    <td class="availability in-stock">
                                        <div class="product_detail">
                                            <div class="form-group">
                                                <label>Weight:</label>
                                                <select class="form-control">
                                                    <option>1 kg</option>
                                                    <option>2 kg</option>
                                                    <option>3 kg</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Variants:</label>
                                                <select class="form-control">
                                                    <option>10</option>
                                                    <option>6</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <label>Qunatity:</label>
                                            <div id="field1">
                                                <button type="button" id="sub" class="sub">-</button>
                                                <input type="text" id="1" value="1" min="1" max="3" />
                                                <button type="button" id="add" class="add">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="action">
                                        <a class="" data-original-title="Delete" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_product"><a href="#"><img class="img-fluid" src="{{ asset('client/images/1.jpg') }}"  alt=""></a></td>
                                    <td class="cart_description">
                                        <h2>Haldiram's Gulab Jamun 1kg</h2>
                                        <span class="available"><strong> Available in</strong> - 1 kg</span>
                                        <h6 class="fresh">Reliance Fresh</h6>
                                        <h6><strong> CODE : </strong> 0212 0333 9990</h6>
                                        <div class="price_block my_price">
                                            <p class="offer-price"><span class="text-success">S$40.99</span></p>
                                            <p class="regular-price">S$80.99</p>
                                        </div>
                                    </td>
                                    <td class="availability in-stock">
                                        <div class="product_detail">
                                            <div class="form-group">
                                                <label>Weight:</label>
                                                <select class="form-control">
                                                    <option>1 kg</option>
                                                    <option>2 kg</option>
                                                    <option>3 kg</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Variants:</label>
                                                <select class="form-control">
                                                    <option>10</option>
                                                    <option>6</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <label>Qunatity:</label>
                                            <div id="field1">
                                                <button type="button" id="sub" class="sub">-</button>
                                                <input type="text" id="1" value="1" min="1" max="3" />
                                                <button type="button" id="add" class="add">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="action">
                                        <a class="" data-original-title="Delete" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_product"><a href="#"><img class="img-fluid" src="{{ asset('client/images/1.jpg') }}"  alt=""></a></td>
                                    <td class="cart_description">
                                        <h2>Haldiram's Gulab Jamun 1kg</h2>
                                        <span class="available"><strong> Available in</strong> - 1 kg</span>
                                        <h6 class="fresh">Reliance Fresh</h6>
                                        <h6><strong> CODE : </strong> 0212 0333 9990</h6>
                                        <div class="price_block my_price">
                                            <p class="offer-price"><span class="text-success">S$40.99</span></p>
                                            <p class="regular-price">S$80.99</p>
                                        </div>
                                    </td>
                                    <td class="availability in-stock">
                                        <div class="product_detail">
                                            <div class="form-group">
                                                <label>Weight:</label>
                                                <select class="form-control">
                                                    <option>1 kg</option>
                                                    <option>2 kg</option>
                                                    <option>3 kg</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Variants:</label>
                                                <select class="form-control">
                                                    <option>10</option>
                                                    <option>6</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <label>Qunatity:</label>
                                            <div id="field1">
                                                <button type="button" id="sub" class="sub">-</button>
                                                <input type="text" id="1" value="1" min="1" max="3" />
                                                <button type="button" id="add" class="add">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="action">
                                        <a class="" data-original-title="Delete" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <div class="cart-sidebar-footer">
            @if(!empty($user))
        <div class="card card-body cart-table shop-detail-right">
            <div class="table-responsive">
                <table class="table cart_summary">
                    <tfoot>
                    <tr>
                        <td class="text-right total_price" colspan="7"><strong>Total: <span class="text-danger">S$ <span class="cart-total-price">{{ number_format($launch_cart->total_price, 2) }}</span></span></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right total_price" colspan="7"><strong>Delivery Fee: </strong>
                            <span class="cart-delivery-fee">{{ $launch_cart->delivery_fee->display }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right total_price" colspan="7"><strong>Concierge Fee: </strong>
                            <span class="cart-concierge-fee">{{ $launch_cart->concierge_fee->display }}</span>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <a href="{{url('/checkout') }}">
            <button class="btn btn-lg btn-block text-left" type="button"><span
                    class="float-left">Proceed to Checkout </span><span
                    class="float-right"><strong>S$ <span class="cart-total">{{ number_format($launch_cart->total, 2) }}</span></strong></span>
            </button>
        </a>
            @endif
    </div>
</div>



<script src="{{ asset('client/js/bootstrap.bundle.min.js') }}"></script>
<!-- select2 Js -->
<script src="{{ asset('client/js/select2.min.js') }}"></script>
<!-- Owl Carousel -->
<script src="{{ asset('client/js/owl.carousel.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>

<script src="{{ asset('client/js/datatables.min.js') }}"></script>

<script src="{{ asset('client/js/custom-form-validation.js') }}"></script>

<script src="{{ asset('client/js/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('client/js/OverlayScrollbars.min.js') }}"></script>

<!-- Custom -->
<script src="{{ asset('client/js/custom.js') }}"></script>
<script type="text/javascript" src="https://cdn.omise.co/omise.js"></script>

<script src="{{ asset('client/js/common.js') }}"></script>
<script>
    @if($new_visitor)
    // Trigger JS functions if new visitor
    $(window).on('load', function () {
        $('#explore-modal').modal('show');
    });

    @endif

    function showlogin(index) {
        e1 = document.getElementById("login");
        e2 = document.getElementById("register");
        if (index) {
            e1.classList.remove('active');
            e2.classList.add('active')
        } else {
            e2.classList.remove('active');
            e1.classList.add('active');
        }
    }
</script>
<script>
    var route = '{{\Request::route()->getName()}}';
    var url =  '/product/pagination';
    
    if (route == 'search' || route == 'merchant') {
        $('body').removeClass('stop-scrolling');
        curr_page = 2;
        isloading = false;
        nomore = false;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $("#product-data").height()-200) {
                loadMoreData(curr_page);

                function loadMoreData(page, route) {
                    if (isloading) return;
                    if (nomore) return;
                    var brands =[];
                    var categories =[];
                    
                    $('div.search_brand input[type="checkbox"]:checked').each(function(){
                        if(jQuery.inArray($(this).val(),brands) === -1){
                            brands.push($(this).val());
                        }
                    });
                    $('li a.list-group-item--last.selected').each(function(){
                        if(jQuery.inArray($(this).attr('data-id'),categories) === -1){
                            categories.push($(this).attr('data-id'));
                        }
                    });
                    var category_ids = categories.join();
                    var sort_by = '';
                    if($('select.sortBy').length > 0){
                        var sort_by = $('select.sortBy').val();

                    }

                    var brand_ids = brands.join();
                    var price_min = $('#price_min').val();
                    var price_max = $('#price_max').val();
                     
                    $.ajax(
                        {
                            url: url,
                            type: 'POST',
                            data: {page: page, _token: '{{ csrf_token() }}', search:"{{ \Request::get('search') }}", merchant_id:'{{$merchant_details->id??""}}', category_id:'{{$category->id??""}}',price_min:price_min, price_max:price_max, sort_by:sort_by, category_ids:category_ids, brand_ids: brand_ids, route: '{{\Request::route()->getName()}}'},
                            dataType: "JSON",
                            beforeSend: function () {
                                isloading = true;
                                $('.ajax-load').show();
                            },
                            complete: function() {

                            $('.ajax-load').hide();
                           
                            }
                        })
                        .done(function (data) {
                            isloading = false;
                            var products = data.html;
                            $('.ajax-load').hide();
                            if (data.html == "" || data.html == " ") {
                                nomore = true;
                                return; // We don't want to show anything if there is no records
                            }
                            curr_page++; // Only increment the page if the earlier page has finished loading.

                            $.each(products, function (index, value) {
                                $("#product-data").append(value);
                            });
                        })
                        .fail(function (jqXHR, ajaxOptions, thrownError) {
                            $('.ajax-load').hide();
                            isloading = false;
                            console.log('server not responding...');
                        });
                }


            }

        });

    }
</script>
<script>
    $(document).ready(function(){
        var count = 0, id=0;
        $(".first").click(function(){
            spanid = id.split("-")[1];
            count = $("."+spanid).text();
            count--;
            if(count < 1)
            {
                $("."+spanid).text("Add");
                $("#first-"+spanid).hide();
            } 
            else
            {
                $("."+spanid).text(count);
            }
        });

        $(".last").click(function(){
            id = $(this).attr("id");
            spanid = id.split("-")[1];
            count = $("."+spanid).text();
            if(count == "Add")
            {
                $("#first-"+spanid).show();
                count = 1;
            } else {
                count++;
            }
            $("."+spanid).text(count);
        });
    });
</script>


</body>
</html>
