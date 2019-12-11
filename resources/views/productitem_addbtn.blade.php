
                        <a class="added_to_cart added-to-cart-{{$product_item->cart_product_id}}">
                            <button type="button" class="btn btn-secondary btn-sm float-right">
                            <i data-cartid="{{$launch_cart->id}}" data-cartproductid="{{$product_item->cart_product_id}}" data-productid="{{$product_item->id}}" data-productoptions="{{$product_item->product_options}}" class="first cart-product-row-item-sub">-</i> 
                                <span class="cart-product-cell-item-qty-{{$product_item->cart_product_id}}"> {{$quantity}} </span>
                            <i data-cartid="{{$launch_cart->id}}" data-cartproductid="{{$product_item->cart_product_id}}" data-productid="{{$product_item->id}}" data-productoptions="{{$product_item->product_options}}" class="last cart-product-row-item-add">+</i>
                            </button>
                        </a>