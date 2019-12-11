@extends('layouts.app')

@section('content')

    @include('breadcrumbs', $data = [$product->merchant_name => url('merchant/'.$product->merchant_id), $product->name => false])

    <section class="shop-single section-padding pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="shop-detail-left">
                        <div class="shop-detail-slider">
                            <div class="favourite-icon">
                                @if ($product->price < $product->list_price && $product->list_price>0)
                                    <span class="badge badge-success">{{ round(($product->list_price - $product->price)/$product->list_price, 2)*100 }}
                                        %</span>
                                @endif
                            </div>
                            <div id="sync1" class="owl-carousel">
                                <div class="item"><img alt=""
                                                       src="{{ $product->thumb_url?:($product->image_square_url?:$product->image_url) }}"
                                                       class="img-fluid img-center"></div>
                                @if ($product->images)
                                    @foreach ($product->images as $product_img)
                                        <div class="item"><img alt="" src="{{ $product_img->image_url }}"
                                                               class="img-fluid img-center"></div>
                                    @endforeach
                                @endif
                            </div>
                            @if ($product->images)
                                <div id="sync2" class="owl-carousel">
                                    <div class="item"><img alt="" src="{{ $product->image_url }}"
                                                           class="img-fluid img-center"></div>
                                    @foreach ($product->images as $product_img)
                                        <div class="item"><img alt="" src="{{ $product_img->image_url }}"
                                                               class="img-fluid img-center"></div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form method="POST" action="{{url('/cart/add') }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        <div class="shop-detail-right">
                            <h2>{{ $product->name }}</h2>

                            @if(count($product->product_options)>0)
                                <span class="available"><strong> Options available</strong></span>
                            @endif
                            <h6 class="fresh"><a class="merchant-link"
                                                 href="{{url('merchant/'.$product->merchant_id)}}">{{$product->merchant_name}}</a>
                            </h6>
                            <h6><strong> CODE : </strong>{{ $product->code }}</h6>

                            <span class="availability"><strong>Availability:</strong>
                                @if ($product->stock <1)
                                    <span class="out-off-stock">OUT OF STOCK</span>
                                @else
                                    <span>IN STOCK</span>
                                @endif
                        </span>

                            <div class="price_block">
                                @if ($product->price < $product->list_price)
                                    <p class="offer-price"><span class="text-success">S$ {{ $product->price }}</span>
                                    </p>
                                    <p class="regular-price">S$ {{$product->list_price}}</p>
                                @else
                                    <p class="offer-price"><span class="text-success">S$ {{ $product->price }}</span>
                                    </p>
                                @endif
                            </div>

                            <hr>

                            <div class="product_detail">
                                @if(!empty($product->product_options))
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                @foreach($product->product_options as $product_option)
                                                    <label>{{$product_option->option}}</label>
                                                    <select class="form-control variants">
                                                        @foreach($product_option->variants as $product_variants)
                                                            <option data-value="{{$product_variants->id}}"
                                                                    class="variants-options"
                                                                    value="{{$product_variants->id}}">{{$product_variants->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($product->stock >=1)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Quantity:</label>
                                                <div id="field1">
                                                    <button type="button" id="sub" class="sub">-</button>
                                                    <input type="text" id="1" value="1" min="1" max="3"/>
                                                    <button type="button" id="add" class="add">+</button>
                                                </div>
                                                <span class="count"> {{ $product->stock }} pieces available </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if ($product->stock >=1)
                                <a class="add_to_cart btn" href="{{url('/cart/add') }}"><i
                                            class="fas fa-shopping-cart"></i> Add To Cart </a>
                            @endif

                            <div class="share">
                                <div class="sharethis-inline-share-buttons"></div>
                                {{-- <ul>
                                     <li><a href="#"><i style="color: #4133ff;" class="fab fa-facebook"></i></a></li>
                                     <li><a href="#"><i style="color: #19b9ee;" class="fab fa-twitter"></i></a></li>
                                     <li><a href="#"><i style="color: #ffad4d;" class="fab fa-google"></i></a></li>
                                     <li><a href="#"><i style="color: #f40e0e;" class="fab fa-pinterest"></i></a></li>
                                 </ul>--}}
                            </div>
                            <hr>
                            <div class="short-description">
                                <h5>Description</h5>
                                @if($product->full_description)
                                    <p class="mb-0">{!! $product->full_description !!}</p>
                                @elseif(!$product->full_description && $product->short_description)
                                    <p>{!! $product->short_description !!}</p>
                                @else
                                    <p>No description available</p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="related-products" style="display:none">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5"><span>Related Product</span></h5>
            </div>
            <div class="owl-carousel relatedSlider">
                <?php $no = 0; ?>
                @foreach($suggested_products as $value)
                    @if ($no < 6)
                        <form method="POST" action="{{url('/cart/add') }}">
                            <input type="hidden" name="product_id" value="{{ $value->id }}"/>
                            <div class="item">
                                <div class="product">
                                    <a href="{{url('/product/' . $value->id) }}">
                                        <div class="product-header">
                                            @if ($value->price < $value->list_price && $value->list_price>0)
                                                <span class="badge badge-success">{{ round(($value->list_price - $value->price)/$value->list_price, 2)*100 }}
                                                    %</span>
                                            @endif
                                            <img class="img-fluid"
                                                 src="{{ $value->thumb_url?:($value->image_square_url?:$value->image_url) }}"
                                                 alt="">
                                        </div>
                                    </a>
                                    <div class="product-body">
                                        <div class="float-left">
                                            <a href="{{url('/product/' . $value->id) }}"><span
                                                        class="title">{{ $value->name }}</span></a>
                                            <span class="text">{{ $product->merchant_name }}</span>
                                            @if ($value->price < $value->list_price)
                                                <p class="offer-price"><span
                                                            class="regular-price">S$ {{ $value->list_price }}</span>
                                                    S$ {{ $value->price }}</p>
                                            @else
                                                <p class="offer-price">S$ {{ $value->price }}</p>
                                            @endif
                                        </div>
                                        @if(!empty($product->product_options))
                                            <div class="options">
                                                <label>Weight</label>
                                                <select class="form-control variants">
                                                    @foreach($product->product_options as $product_option)
                                                        <option data-value="{{$product_option->id}}"
                                                                class="variants-options"
                                                                value="{{$product_option->id}}">{{$product_option->option}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="product-footer">
                                        <a class="add_to_cart" href="{{url('/cart/add') }}">
                                            <button type="button" class="btn btn-secondary btn-sm float-right">Add <i
                                                        class="last">+</i></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <?php $no++; ?>
                @endforeach
            </div>
        </div>
    </section>


    @include('about_footer')
@endsection
