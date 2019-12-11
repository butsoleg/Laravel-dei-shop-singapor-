<tr class="product_checkout cart-product-row-{{$product_item->cart_product_id}}">
    <input type="hidden" id="checkout-cart_id-{{$key}}" value="{{$launch_cart->id}}">
    <input type="hidden" id="checkout-cart_product_id-{{$key}}" value="{{$product_item->cart_product_id}}">
    <input type="hidden" id="checkout-product_id-{{$key}}" value="{{$product_item->id}}">
    <input type="hidden" id="checkout-product_options-{{$key}}" value="{{$product_item->product_options}}">
    <td class="cart_product">
        <a href="{{url('/product/' . $product_item->id) }}">
            <img class="img-fluid" src="{{ $product_item->image }}"  alt="">
        </a>
    </td>
    <td class="cart_description">
        <a href="{{url('/product/' . $product_item->id) }}">
        <h2>{{$product_item->name}}</h2>
        </a>
        @if($product_item->product_options)
        <!-- <span class="available"><strong> Available in</strong> - 1 kg</span> -->
        @endif

        <a href="{{url('/merchant/' . $product_item->merchant_id) }}">
        <h6 class="fresh">{{$product_item->merchant_name??$product_item->merchant_id}}</h6>
        </a>
        <h6><strong> CODE : </strong> {{ $product_item->code }}</h6>
        <div class="price_block my_price">
            <p class="offer-price"><span class="text-success">S$ {{ $product_item->cart_price }}</span></p>
            @if ($product_item->cart_price < $product_item->price)
            <p class="regular-price">S$ {{ $product_item->price }} </p>
            @endif
        </div>
    </td>
    <td class="availability in-stock">
        <div class="product_detail">
            @foreach($product_item->options as $op)
            <div class="form-group">
                <label>Weight:</label>
                <select class="form-control">
                    <option>1 kg</option>
                    <option>2 kg</option>
                    <option>3 kg</option>
                </select>
            </div>
            @endforeach
            <div class="form-group">
                <label>Quantity:</label>
                <div id="field1">
                    <button type="button" data-cartid="{{$launch_cart->id}}" data-cartproductid="{{$product_item->cart_product_id}}" data-productid="{{$product_item->id}}" data-productoptions="{{$product_item->product_options}}" class="sub cart-product-row-item-sub">-</button>
                    <input type="text" class="cart-product-row-item-qty-{{$product_item->cart_product_id}}" value="{{ $product_item->quantity }}" min="1" max="20" readonly="readonly" />
                    <button type="button" data-cartid="{{$launch_cart->id}}" data-cartproductid="{{$product_item->cart_product_id}}" data-productid="{{$product_item->id}}" data-productoptions="{{$product_item->product_options}}" class="add cart-product-row-item-add">+</button>
                    <div><span class="error cart-product-row-item-error-{{$product_item->cart_product_id}}"></span></div>
                </div>
            </div>
        </div>
    </td>
    <td class="action">
        <a class="cartproductdelete cart-product-row-item-remove" data-original-title="Delete"  data-cartid="{{$launch_cart->id}}" data-cartproductid="{{$product_item->cart_product_id}}" data-productid="{{$product_item->id}}" data-placement="top" data-toggle="tooltip"><img src="{{ asset('client/images/bin.png') }}"> </a>
    </td>
</tr>