@extends('layouts.app')

@section('content')



      <section class="home_banner">
          <div class="owl-carousel owl-demo">
            @foreach($launch_banners as $image)
              <div class="item">
                @if(in_array($image->object_type, ['category','merchant']) && $image->object_id)
                <a href="{{url($image->object_type.'/'.$image->object_id)}}">
                @elseif($image->object_type == 'url' && $image->object_url)
                <a href="{{$image->object_url}}">
                @else
                <a>
                @endif
                  <img src="{{ $image->image }}" class="d-none d-lg-block">
                  <!-- mobile banner -->
                  <img src="{{ $image->mobile_banner??$image->image }}" class="d-lg-none">
                </a>
              </div>
            @endforeach
          </div>
          <div class="banner_content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-4">
                  <!-- <h2>Welcome to <br><span>Little India</span></h2>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> -->
                </div>
              </div>
            </div>
          </div>
      </section>
      <section class="how">
         <div class="container">
            <h2>How Dei Works</h2>
            <div class="row items">
               <div class="col-4 text-left">
                  <div class="inner">
                     <div class="logo">
                        <img src="{{ asset('client/images/explore-'.$launch_current_explore->id.'/logo1.png') }}">
                     </div>
                     <span class="title">Collection</span>
                  </div>
               </div>
               <div class="col-4 text-center">
                  <div class="inner">
                     <div class="logo">
                        <img src="{{ asset('client/images/explore-'.$launch_current_explore->id.'/logo2.png') }}">
                     </div>
                     <span class="title">Consolidation</span>
                  </div>
               </div>
               <div class="col-4 text-right">
                  <div class="inner">
                     <div class="logo">
                        <img src="{{ asset('client/images/explore-'.$launch_current_explore->id.'/logo3.png') }}">
                     </div>
                     <span class="title">Delivery</span>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="search searchAnchor">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="search-block searchBlock">
                     <form id="searchForm" class="form" autocomplete="off" action="{{ url('search') }}" method="get">
                        <div class="input-group">
                           <input name="search" class="form-control inputChange" placeholder="SEARCH SHOP OR PRODUCT" aria-label="Search products in Your City" type="text">
                           <span class="input-group-btn">
                              <a href="#" class="search_btn">
                                 <button class="btn" type="button"><i class="fas fa-search"></i></button>
                              </a>
                           </span>
                        </div>
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
      </section>
      @foreach ($launch_sections as $section)
         @include('sectionitem', ['source'=>'home'])
      @endforeach

      @include('about_footer')

@endsection
