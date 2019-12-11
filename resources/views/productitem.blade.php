@if(!isset($data['source']) || $data['source'] !== 'home')
<div class="col-6 col-md-4 col-lg-3 col-xl-2">
@endif
    <form method="POST" action="{{url('/cart/add') }}">
        <input type="hidden" name="product_id" value="{{ $data['value']->id }}"/>

        <div class="item">
            <div class="product">
                <a href="{{url('/product/' . $data['value']->id) }}">
                    <div class="product-header">
                    @if ($data['value']->price < $data['value']->list_price && $data['value']->list_price>0)
                        <span class="badge badge-success">{{ round(($data['value']->list_price - $data['value']->price)/$data['value']->list_price, 2)*100 }}%</span>
                    @endif
                        <img class="img-fluid" src="{{ $data['value']->thumb_url?:($data['value']->image_square_url?:$data['value']->image_url) }}" alt="">
                    </div>
                </a>
                <div class="product-body">
                    <div class="float-left">
                        <a href="{{url('/product/' . $data['value']->id) }}"><span class="title"> {{$data['value']->name}} </span></a>
                        <span class="text">{{$data['value']->merchant_name}}</span>
                        @if ($data['value']->price < $data['value']->list_price)
                        <p class="offer-price"><span class="regular-price">S$ {{$data['value']->list_price}}</span> S$ {{ $data['value']->price }} </p>
                        @else
                        <p class="offer-price">S$ {{ $data['value']->price }} </p>
                        @endif
                    </div>
                    @if(!empty($data['value']->product_options) && count($data['value']->product_options)==1)
                        <div class="options">
                            <label>Weight</label>
                            <select class="form-control variants">
                                @foreach($data['value']->product_options as $product_option)
                                    @foreach($product_option->variants as $product_variants)
                                        <option data-value="{{$product_variants->id}}" class="variants-options" value="{{$product_variants->id}}">{{$product_variants->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="product-footer">
                    @if(!empty($data['value']->product_options) && count($data['value']->product_options)>1)
                    <a href="{{url('/product/' . $data['value']->id) }}"><button type="button" class="btn btn-secondary btn-sm float-right">Select Options</button></a>
                    @else
                        @if (isset($launch_cart->products))
                            @foreach($launch_cart->products as $launchproduct)
                                @if($launchproduct->id == $data['value']->id)
                                @php
                                    $quantity = $launchproduct->quantity;
                                    $product_item = $launchproduct;
                                @endphp
                                @endif
                            @endforeach
                        @endif
                        <div class="product-item-action-btn-{{$data['value']->id}}">
                        @if(!empty($quantity) && $quantity>0)
                            @include('productitem_addbtn')
                        @endif
                        <a data-productid="{{$data['value']->id}}" {{ (!empty($quantity) && $quantity > 0) ? "style=display:none;" : '' }} class="add_to_cart add-to-cart-{{$data['value']->id}}" @if(!empty($user)) href="{{url('/cart/add') }}" @else href="#" data-target="#bd-example-modal" data-toggle="modal" onclick="showlogin(0)" @endif>
                            <button type="button" class="btn btn-secondary btn-sm float-right">Add <i class="last">+</i></button>
                        </a>
                        </div>
                    @endif
                        @if(!empty($data['value']->product_options) && count($data['value']->product_options)==1)
                            @foreach($data['value']->product_options as $product_option)
                                <input type="hidden" data-value="{{$product_option->id}}" class="options-product" value="{{$product_option->id}}"/>
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
    </form>
@if(!isset($data['source']) || $data['source'] !== 'home')
</div>
@endif


                        