@extends('layouts.app')

@section('content')

@include('breadcrumbs', $data = [$search => false])
    
    @if(isset($category) && $category)
    <section class="store-header">
        <div class="store-header-bg d-none d-md-block" style="height: 350px; display: block; background: url('{{ $category->banner_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+header+Compressed.png' }}') no-repeat center center; background-size: cover;">
        </div>
        <img src="{{ $category->banner_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+header+Compressed.png' }}" alt="" class="d-md-none">
        <div class="container">
            <div class="row">
                
            <div class="col-md-12">
                    <div class="block">
                        <h2>{{ $category->name }}</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @endif

    @if(isset($brand) && $brand)
    <section class="store-header">
        <div class="store-header-bg d-none d-md-block" style="height: 350px; display: block; background: url('{{ $brand->banner_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+header+Compressed.png' }}') no-repeat center center; background-size: cover;">
        </div>
        <img src="{{ $brand->banner_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+header+Compressed.png' }}" alt="" class="d-md-none">
        <div class="container">
            <div class="row">
                
            <div class="col-md-12">
                    <div class="block">
                        <h2>{{ $brand->name }}</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @endif

    <div class="search_bar searchAnchor searchBlock">
        <div class="container">
            <div class="row">
                <div class="col-12 search-block">
                    <form id="searchForm" class="form" autocomplete="off" action="{{ url('search') }}" method="get">
                        <input name="search" class="form-control inputChange search_product" value="{{!isset($category)&&!isset($merchant)&&!isset($brand)&&\Request::get('search')?\Request::get('search'):'' }}" placeholder="SEARCH FOR {{isset($category)&&$category?$category->name:(isset($merchant)&&$merchant?$merchant->name:'')}} PRODUCTS" aria-label="Search products in Your City" type="text">
                        <a class="search_btn">
                            <button class="btn" type="button"><i class="fas fa-search"></i></button>
                        </a>
                    </form>
                    <!-- dropdown -->
                    <div id="search-content-block" class="search-content">
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
                                        <td class="cart_product">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ asset('client/images/1.jpg') }}" alt="">
                                            </a>
                                        </td>
                                        <td class="cart_description">
                                            <h2>Jeyas premium foxtail millet (thinai) 500gm</h2>
                                            <div class="price_block my_price">
                                                <p class="offer-price"><span class="text-success">S$ 3.20</span></p>
                                            </div>
                                        </td>
                                        <td class="availability in-stock">
                                            <div class="product_detail">
                                                <label>Quantity:</label>
                                                <div id="field1">
                                                    <button type="button" id="sub" class="sub">-</button>
                                                    <input type="text" id="1" value="1" min="1" max="20">
                                                    <button type="button" id="add" class="add">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="action">
                                            <a class="" data-original-title="Add to cart" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="fas fa-shopping-cart"></i> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_product">
                                            <a href="#">
                                            <img class="img-fluid" src="{{ asset('client/images/1.jpg') }}" alt="">
                                            </a>
                                        </td>
                                        <td class="cart_description">
                                            <h2>Jeyas premium turmeric powder 200gm</h2>
                                            <div class="price_block my_price">
                                                <p class="offer-price"><span class="text-success">S$ 1.50</span></p>
                                            </div>
                                        </td>
                                        <td class="availability in-stock">
                                            <div class="product_detail">
                                                <label>Quantity:</label>
                                                <div id="field1">
                                                    <button type="button" id="sub" class="sub">-</button>
                                                    <input type="text" id="1" value="1" min="1" max="20">
                                                    <button type="button" id="add" class="add">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="action">
                                            <a class="" data-original-title="Add to cart" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="fas fa-shopping-cart"></i> </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </span>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shop-info">Showing {{ number_format($headers->total) }} products for <span>{{ isset($category)&&$category?$category->name:(isset($brand)&&$brand?$brand->name:"$search") }}</span></div>
                    <div class="shop-head">
                        <h5 class="title_search"><span>SEARCH RESULT </span></h5>
                        <div class="form-group">
                            <div class="options">
                                <label>Sort by</label>
                                <select class="form-control sortBy" >
                                    <option value="">sort By</option>
                                    <option value="relevancy">Relevancy</option>
                                    <option value="product">Product</option>
                                    <option value ="price">Price</option>
                                    <option value ="code">Code</option>
                                </select>
                            </div>
                        </div>
                    </div>
                
                <section class="cats-list">
                    <div class="section-header"> 
                        <h5 class="heading-design-h5">CATEGORIES
                            @php
                                $main_categories =  App\Http\Controllers\Controller::getMainCategories($category_ids);
                            @endphp  
                        </h5>
                    </div>
                    <div class="row items">
                    @foreach($main_categories as $mc)
                        @php
                            $link = App\Http\Controllers\Controller::setCategoryToURL(url()->full(), 'category_id='.$mc->id);
                        @endphp
                        <div class="col-6 col-md-6 col-lg-2 col-xl-2">
                            <a href="{{ url()->full() . '?category_id='.$mc->id }}" class="item">
                                <div class="cat_image">
                                    <img class="img-fluid" src="{{ $mc->image_url }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h5>{{ $mc->name }}</h5>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </section>

                    <div class="row" id="product-data">
                        @foreach($products as $product)
                            @include('productitem', $data=['value' => $product])
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


        <div class="ajax-load text-center" style="display:none">
            <p>Loading More Products</p>
        </div>


    </section>

    @include('about_footer')
@endsection
