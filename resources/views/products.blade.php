@foreach($products as $product)

<div class="col-6 col-md-6 col-lg-4 col-xl-3">

        <form method="POST" action="{{url('/cart/add') }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}"/>
            <div class="item">
                <div class="product">
                    <a href="{{url('/product/' . $product->id) }}">
                        <div class="product-header">
                        @if ($product->price < $product->list_price && $product->list_price>0)                    
                            <span class="badge badge-success">{{ round(($product->list_price - $product->price)/$product->list_price, 2)*100 }}%</span>
                        @endif
                            <img class="img-fluid" src="{{ $product->thumb_url?:($product->image_square_url?:$product->image_url) }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <a href="{{url('/product/' . $product->id) }}"><span class="title"> {{$product->name}} </span></a>
                            <span class="text">{{$product->merchant_name}}</span>
                            @if ($product->price < $product->list_price)
                            <p class="offer-price"><span class="regular-price">S$ {{$product->list_price}}</span> S$ {{ $product->price }} </p>
                            @else
                            <p class="offer-price">S$ {{ $product->price }} </p>
                            @endif
                        </div>
                        @if ($product->price < $product->list_price)
                         <div class="options">
                            <label>Weight</label>
                            <select class="form-control">
                                <option>1 kg</option>
                                <option>3 kg</option>
                                <option>6 kg</option>
                            </select>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        @if (!empty($product->product_options))
                        <a href="{{url('/product/' . $product->id) }}"><button type="button" class="btn btn-secondary btn-sm float-right">Select Options</button></a>
                        @else
                            @if (isset($launch_cart->products))
                                @foreach($launch_cart->products as $launchproduct)
                                    @if($launchproduct->id == $product->id)
                                    @php
                                        $quantity = $launchproduct->quantity;
                                    @endphp
                                    @endif
                                @endforeach
                            @endif
                            <a class="add_to_cart" @if(!empty($user)) href="{{url('/cart/add') }}" @else href="#" data-target="#bd-example-modal" data-toggle="modal" onclick="showlogin(0)" @endif>
                                <button type="button" class="btn btn-secondary btn-sm float-right">Add <i class="last">+</i></button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
</div>
        
@endforeach



                        