@extends('layouts.app')

@section('content')

<!-- @include('breadcrumbs', $data = ["Checkout" => false]) -->

<section class="success-checkout">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="icon"><i class="fas fa-check-circle"></i></span>
                <h1>Thank You For Your Order!</h1>
                <p>The order confirmation email with details of your order and a link to track its progress has been sent to your email </p>
                <input type="text" class="form-control" value="Your Order No : #00000000001" disabled>
                <span class="date">Order Date {{ date('d M Y')}}</span>
            </div>
        </div>
    </div>
</section>
<section class="checkout-page success">
    <form method="POST" action="{{ url('/checkout/run') }}" id="checkoutForm">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xl-6">
                    <div class="checkout-step">
                        <div class="card checkout-step-one">
                            <input type="hidden" name="address_id" value="{{ @$orderDetail->address->id }}"/>
                              @if(!empty(@$orderDetail->address))
                                <div class="box_body selected_address" id="choose_address">
                                    <h3 class="capitalize">{{ @$orderDetail->address->profile_name }}</h3>
                                    <p>{{ @$orderDetail->address->firstname }} {{ @$orderDetail->address->lastname }} <br>
                                    <p>{{ @$orderDetail->address->building_type }}  <br>
                                    @if(!empty(@$orderDetail->address->unit) && $addresses[0]->unit != '0' ) <p>{{ @$orderDetail->address->unit }}  <br>@endif
                                    @if(!empty(@$orderDetail->address->floor) && $addresses[0]->floor != '0' ) <p>{{ @$orderDetail->address->floor }}  <br>@endif
                                    @if(!empty(@$orderDetail->address->building_name))<p>{{ @$orderDetail->address->building_name }}  <br>@endif
                                    @if(!empty(@$orderDetail->address->lobby_name))<p>{{ @$orderDetail->address->lobby_name }}  <br>@endif
                                    <p>{{ @$orderDetail->address->street }} <br>
                                    {{ @$orderDetail->address->city }} <br>
                                        {{ @$orderDetail->address->state }} , {{ @$orderDetail->address->postal_code }}<br> 
                                        {{ @$orderDetail->address->country }}</p>
                                        <p class="addressName" style="display:none;">{{ @$orderDetail->address->firstname }} {{ @$orderDetail->address->lastname }}</p>

                                </div>
                                <div class="text-right" id="address_btn">
                                    <button type="button" class="btn btn-lg" data-toggle="modal" id="change_address_modal"> Change Address </button>
                                </div>
                            @else
                            <div  class="box_body selected_address" id="choose_address">
                                <h3><span class="text-center">No Default Address</span> </h3>
                            </div>
                            <div class="text-right" id="address_btn">
                                <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add_address"> Add New Address </button>
                            </div>
                            @endif
                           
                        </div>
                        <div class="card checkout-step-two">
                            <h3>Delivery time</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="delivery_title">Date</h4>
                                    <span>{{ date('l, Y - m -d',  strtotime(@$orderDetail->estimated_delivery)) }}</span>
                                    <span></span>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="delivery_title">Time</h4>
                                    <span> {{@$orderDetail->sptime }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card payment">
                            <h3>Payment</h3>
                            @if(!empty(@$orderDetail->card))
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 centerFlex">
                                        <div class="tick d-inline-block">
                                            <input type="hidden" name="card_id" value="{{@$cards[0]->id}}"/>

                                            <!-- <img src="{{ asset('client/images/card.png') }}" width="80"> -->
                                            @if(@$orderDetail->card->brand == 'Visa')
                                                <img src="{{asset('client/images/visa.png')}}">
                                            @else
                                                <img src="{{asset('client/images/master_card.png')}}">
                                            @endif
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                            <h5>{{ @$orderDetail->card->brand  }} <span>**** **** **** {{ @$orderDetail->card->last4 }}</span></h5>
                                            <p class="cardAddressname">{{ @$orderDetail->address->firstname }} {{ @$orderDetail->address->lastname }}</p>
                                            <p>{{ @$orderDetail->card->exp_year }}/{{ @$orderDetail->card->exp_month }}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            @endif
                           
                        </div> 
                    </div>
                </div>
                <div class="col-md-7 col-xl-6">
                    <div class="card right">
                        <input type="hidden" name="cart_id" value="{{ @$launch_cart->id }}"/>
                        <div class="card-body pt-0 pr-0 pl-0 pb-0">
                            <div class="cart-table shop-detail-right my_cart">
                                <h3>Order Summary</h3>
                                <div class="table-responsive">
                                    <table class="table cart_summary">
                                        <tbody>
                                            @if (empty($orderDetail->products))
                                            <tr>
                                                <td class="text-center total_price" colspan="7"><strong>Empty Cart</strong></td>
                                            </tr>
                                            @else
                                            <?php // echo var_dump($launch_cart) ?>
                                            @if(!empty(@$orderDetail))
                                                @foreach ($orderDetail->products as $key=>  $product_item)
                                                <tr class="product_checkout" id="checkout-product-{{$key}}">
                                                    <input type="hidden" id="checkout-cart_id-{{$key}}" value="{{$launch_cart->id}}">
                                                    <input type="hidden" id="checkout-cart_product_id-{{$key}}" value="{{$product_item->cart_product_id}}">
                                                    <input type="hidden" id="checkout-product_id-{{$key}}" value="{{$product_item->id}}">
                                                    <input type="hidden" id="checkout-product_options-{{$key}}" value="{{$product_item->product_options}}">
                                                    <td class="cart_product">
                                                        <a href="{{url('/product/' . @$product_item->id) }}">
                                                            <img class="img-fluid" src="{{ $product_item->image }}"  alt="">
                                                        </a>
                                                    </td>
                                                    <td class="cart_description">
                                                        <h2>{{$product_item->name}}</h2>
                                                        
                                                        <table class="info">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Weight:</td>
                                                                    <td>1 Kg </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Variants:</td>
                                                                    <td>10 Pcs</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Quantity:</td>
                                                                    <td>{{ $product_item->quantity }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                    </td>
                                                    <td class="price">
                                                        <div class="price_block my_price">
                                                            <p class="offer-price"><span class="text-success">S$ {{ $product_item->cart_price }}</span></p>
                                                            @if ($product_item->cart_price < $product_item->price)
                                                            <p class="regular-price">S$ {{ $product_item->price }} </p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="cart-sidebar-footer">
                                <div class="table-responsive">
                                    <table class="table-inline">
                                        <tfoot>
                                            <tr>
                                                <td class="text-right total_price"><strong>Total: </strong></td>
                                                <td><strong><span class="text-danger" id="total" >S$ {{ empty(@$launch_cart->total) ? '0.00' : number_format($orderDetail->total, 2) }}</span></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right total_price"><strong>Shipping Fee:</strong> </td>
                                                <td>S$ {{ number_format(@$orderDetail->delivery_fee->value, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right total_price"><strong>Concierge Fee:</strong> </td>
                                                <td>S$ {{ number_format(@$orderDetail->concierge_fee->value, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right grandTotal"><strong>Grand Total: </strong></td>
                                                <td><span class="text-danger grandTotal" id="totalAll" >S$ {{ empty(@$launch_cart->total) ? '0.00' : number_format($orderDetail->total, 2) }}</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>


@include('about_footer')
<!-- change address Modal -->

<!-- add address Modal -->
 <div class="add_address">
     <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title text-danger" id="exampleModalLabel"> Add New Address </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert">x—</button> 
                <strong id="add_success-message">error message</strong>
            </div>
            <div class="alert alert-danger alert-block modal-error-alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert">x—</button> 
                    <strong id="add_error-message"></strong>
            </div>
             <form method="POST" id="createaddressform">

                @csrf
                <input type="hidden" name="profile_name" value="home" id="edit_profilename">
                <div class="row">
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Choose nick name for this address <span class="required">*</span></label>
                          <p>
                             <span class="nick_name selected_name" data-value="home">Home</span>
                             <span class="nick_name" data-value="work">Work</span>
                             <span class="nick_name" data-value="other">Other</span>
                          </p>
                      </div>
                   </div>

                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">First Name <span class="required">*</span></label>
                          <input class="form-control border-form-control" name="firstname" id="add_firstname" placeholder="John" type="text">
                          <div><span id="add_firstname-error" class="error"></span></div>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Last Name <span class="required">*</span></label>
                          <input class="form-control border-form-control" name="lastname" id="add_lastname"  placeholder="Jakson" type="text">
                          <div><span id="add_lastname-error" class="error"></span></div>
                      </div>
                   </div>
                   <div  class="clearfix"></div>
                </div>
                <div class="row">
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Phone Number <span class="required">*</span></label>
                          <input class="form-control border-form-control" placeholder="+65 20 3027 7900" type="text"  name="contact" id="add_contact">
                          <div><span id="add_contact-error" class="error"></span></div>       

                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Building Type <span class="required">*</span></label>
                            <input class="form-control border-form-control" placeholder="Building Type" type="text"  name="building_type" id="add_building_type">
                          <div><span id="add_building_type-error" class="error"></span></div>
                      </div>
                   </div> 
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Condo Name</label>
                          <input class="form-control border-form-control" placeholder="120 Eunos Ave 7" type="text" name="building_name" id="add_building_name">
                          <div><span id="add_building_name-error" class="error"></span></div>

                      </div>
                   </div>
                   <div  class="clearfix"></div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Tower/Lobby Name </label>
                          <input class="form-control border-form-control" placeholder="Hougang" type="text" name="lobby_name" id="add_lobby_name">
                          <div><span id="add_lobby_name-error" class="error"></span></div>

                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Street Address <span class="required">*</span></label>
                          <input class="form-control border-form-control" placeholder="John Jakson 180 B, 10th Block, 120 Eunos Ave 7, Richfield " type="text"  name="street" id="add_street">
                          <div><span id="add_street-error" class="error"></span></div>

                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Floor No. </label>
                          <input class="form-control border-form-control" placeholder="180 B" type="text"  name="floor" id="add_floor" value="0">
                          <div><span id="add_floor-error" class="error"></span></div>

                      </div>
                   </div>
                   <div  class="clearfix"></div>
                </div>
                <div class="row">
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Unit No. <span class="required">*</span></label>
                          <input class="form-control border-form-control" placeholder="10th Block" type="text" name="unit" id="add_unit" value="0">
                          <div><span id="add_unit-error" class="error"></span></div>

                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Address Line 2 </label>
                          <input class="form-control border-form-control" placeholder="120 Eunos Ave 7, Richfield, Singapore " type="text" name="address-2" id="add_address-2">
                          <div><span id="add_address-2-error" class="error"></span></div>  

                      </div>
                   </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">City <span class="required">*</span></label>
                           <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="city" id="add_city" required>
                          <div><span id="add_city-error" class="error"></span></div> 
                      </div>
                   </div>
                   <div  class="clearfix"></div>
                </div>
                <div class="row">
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">State <span class="required">*</span></label>
                         <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="state" id="add_state" required>
                          <div><span id="add_state-error" class="error"></span></div>  

                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Country <span class="required">*</span></label>
                          <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="country" id="add_country">
                          <div><span id="add_country-error" class="error"></span></div>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label">Postal Code <span class="required">*</span></label>
                          <input class="form-control border-form-control" placeholder="35366" type="text" name="postal_code" id="add_postal_code">
                          <div><span id="add_postal_code-error" class="error"></span></div>

                      </div>
                   </div>
                   <div  class="clearfix"></div>
                </div> 
                <div class="row">
                   <div class="col-md-12">
                      <div class="form-group">
                          <div class="address_checkbox">
                             <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_default" class="custom-control-input" id="customCheck1" >
                                <label class="custom-control-label" for="customCheck1">Set this as my default delivery address </label> 
                             </div>
                          </div>
                       </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save Address</button>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                </div>
            </form>
           </div>
       
         </div>
       </div>
     </div>
  </div>
<!-- change card Modal -->

<!-- add new card Modal -->
<div class="add_address">
    <div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel"> Add New Card </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">x—</button> 
                    <strong id="card_success-message">error message</strong>
                </div>
                <div class="alert alert-danger alert-block modal-error-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">x—</button> 
                    <strong id="card_error-message"></strong>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{asset('client/images/add_card.png')}}">
                        </div>
                        <div class="col-md-6">
                            <form method="POST" class="pt-4" id="addcardform" >
                                @csrf
                                <input type="hidden" value="{{ @$user->first_name }}" name="description">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Cardholder's name <span class="required">*</span></label>
                                            <input class="form-control border-form-control" name="name" id="cardholder_name"  placeholder="John Jakson" type="text">
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Card Number <span class="required">*</span></label>
                                            <input class="form-control border-form-control" name="number" id="card_number" placeholder="1587 8962 5845 7776" type="text" onkeypress="if (isNaN(this.value + String.fromCharCode(event.keyCode)))
                                                      return false;"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Month <span class="required">*</span></label>
                                            <select  class="select2 form-control border-form-control" name="expiration_month" id="expiration_month"  required>
                                                <option value="1">Jan</option>
                                                <option value="2">Feb</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Year <span class="required">*</span></label>
                                            <select  class="select2 form-control border-form-control" name="expiration_year" id="expiration_year" required>
                                                @for($year = 2019; $year<=2050; $year++)
                                                <option value="{{$year}}">{{@$year}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">CVV</label>
                                            <input class="form-control border-form-control" maxlength="3" placeholder="678" name="cvv" type="text" id="security_code" onkeypress="if (isNaN(this.value + String.fromCharCode(event.keyCode)))
                                                      return false;" required>
                                        </div>
                                    </div>
                                    <div  class="clearfix"></div>
                                </div>
                                <div class="pt-3">
                                    <button type="submit" class="btn btn-danger">Save Card</button>
                                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection