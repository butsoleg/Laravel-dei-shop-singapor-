@extends('layouts.app')

@section('content')

@include('breadcrumbs', $data = [$merchant_details->name => false])

<section class="store-header">
    <div class="store-header-bg d-none d-md-block" style="height: 350px; display: block; background: url('{{ $merchant_details->banner_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+header+Compressed.png' }}') no-repeat center center; background-size: cover;">

    </div>
    <img src="{{ $merchant_details->banner_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+header+Compressed.png' }}" alt="" class="d-md-none">
    <div class="bottom">  
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-4">
                    <div class="poster">
                        <img src="{{$merchant_details->logo_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+Shop+600px.png'}}" alt="">
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="block">
                        <h2>{{ $merchant_details->short_name??$merchant_details->name }}</h2>
                        <!--<span class="time"><i class="far fa-clock"></i> 10.00 - 21.00</span>-->
                        <ul class="rate">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                            <li class="last">Rating</li>
                        </ul>

                        <span class="address"><i class="fas fa-map-marker-alt"></i>
                            {{ $merchant_details->address }}
                        </span>

                        @if ($merchant_details->story)
                        <h4>Our Story</h4>
                        <div class="about">
                            <p class="short">{{ strlen($merchant_details->story)>250?substr($merchant_details->story, 0, 250).'...':$merchant_details->story }}</p>
                            <p class="full" style="display: none;">{!! nl2br($merchant_details->story) !!}
                              <a href="javascript:;" class="less">View less</a>
                            </p>
                            @if(strlen($merchant_details->story) >250)
                            <a href="javascript:;" class="more">Read more</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="search_bar searchAnchor searchBlock">
    <div class="container">
        <div class="row">
            <div class="col-12 search-block">
                <form id="searchForm" class="form" autocomplete="off" action="{{ url('search') }}" method="get">
                    <input name="search" class="form-control inputChange search_product" placeholder="SEARCH BY MERCHANT PRODUCT" aria-label="Search products in Your City" type="text">
                    <a href="#" class="search_btn">
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

<div class="store-content">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                
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
                

                @foreach ($merchant_sections as $section)
                   @include('sectionitem', ['source'=>'merchant'])
                @endforeach

                <section class="shop-list section-padding">
                    <div class="section-header">
                        <h5 class="heading-design-h5">PRODUCTS
                             <!-- <a class="float-right text-secondary" href="#">View All</a>  -->
                        </h5>
                    </div>
                    <div class="row no-gutters" id="product-data">
                        @foreach($merchant_products as $value)
                        @include('productitem', $data=['value' => $value])
                        @endforeach
                    </div>
                    <div class="ajax-load text-center" style="display:none">
                        <p>Loading More Products ...</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@include('about_footer')


@endsection
