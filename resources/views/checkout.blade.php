@extends('layouts.app')

@section('content')

@include('breadcrumbs', $data = ["Checkout" => false])

<section class="checkout-page section-padding">
    <form method="POST" action="{{ url('/checkout/run') }}" id="checkoutForm">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xl-6">
                    <div class="checkout-step">
                        <div class="card checkout-step-one">
                            <input type="hidden" name="address_id" value="{{ @$addresses[0]->id }}"/>
                            <span class="title"><span>1</span> Address</span>
                            @include('ListAddress', ['addresses' => $addresses , 'page' => false])
                            
                        </div>
                        <div class="card checkout-step-two">
                            <span class="title"><span>2</span> Delivery time</span>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="delivery_title">Date</h4>
                                    <div class="form-group">
                                        <label class="control-label">Select Date <span class="required">*</span></label>
                                        <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                            <input class="form-control border-form-control" id="delivery_date" name="delivery_date" value="{{ date('Y-m-d', strtotime('tomorrow'))}} " type="text" readonly="" placeholder="dd/mm/yyyy">
                                            <span class="input-group-addon"><i class="mdi mdi-calendar-text"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="delivery_title">Time</h4>
                                    <div class="form-group">
                                        <label class="control-label">Select  <span class="required">*</span></label>
                                        <div class="time-icon">
                                            <select name="delivery_timeslot" class="form-control">
                                                <option value="1" selected="selected">5pm to  8pm</option>
                                                <option value="2">7pm to 10pm</option>

                                            </select>
                                            <i class="mdi mdi-clock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <h4 class="delivery_title">Note</h4>
                                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <span class="title"><span>3</span> Payment</span>
                            @if(!empty(@$cards))
                                <div class="cards_box selected_card" id="choose_card">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 centerFlex">
                                            <div class="tick d-inline-block">
                                                <input type="hidden" name="card_id" value="{{@$cards[0]->id}}"/>

                                                <!-- <img src="{{ asset('client/images/card.png') }}" width="80"> -->
                                                @if(@$cards[0]->brand == 'Visa')
                                                    <img src="{{asset('client/images/visa.png')}}">
                                                @else
                                                    <img src="{{asset('client/images/master_card.png')}}">
                                                @endif
                                            </div>
                                            <div class="card_deatil d-inline-block align-top">
                                                <h5>{{ @$cards[0]->brand  }} <span>**** **** **** {{ @$cards[0]->last4 }}</span></h5>
                                                <p class="cardAddressname">{{ @$addresses[0]->firstname }} {{ @$addresses[0]->lastname }}</p>
                                                <p>{{ @$cards[0]->exp_year }}/{{ @$cards[0]->exp_month }}</p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="text-right" id="card_btn">
                                    <button type="button" class="btn btn-lg" data-toggle="modal" id="card_change_modal"> Change Card </button>
                                </div>
                            @else
                                <div  class="box_body selected_address" id="choose_card">
                                    <h3><span class="text-center">No Card Found</span> </h3>
                                </div>
                                <div class="text-right" id="card_btn">
                                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add_card"> Add New Card </button>
                                </div>
                            @endif
                           
                        </div> 

                        <div class="card">
                            <!-- <input type="hidden" name="card_id" value="1"/> -->
                            <span class="title"><span>4</span> Promo Code</span>
                            <div class="cards_box selected_card promo-form">
                                <div class="row">
                                    <table class="table cart_summary">
                                        <tr>
                                            <td colspan="4">
                                                <form class="form-inline float-right" id="promocodeform">
                                                    <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                                                        <button type="button" class="close" data-dismiss="alert">x—</button> 
                                                        <strong id="promocodesuccess-message">error message</strong>
                                                    </div>
                                                    <div class="alert alert-success delete_icon" style="display: none;">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <strong>success message</strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="cart_id" id="promocodecartid" value="{{ @$launch_cart->id }}"/>

                                                        <input type="text" name="promocode" placeholder="Enter discount code" id="promocodevalue"  class="form-control border-form-control form-control-sm">
                                                        <div><span id="promocodevalue-error" class="error"></span></div>
                                                    </div>
                                                    <button class="btn btn-success float-left btn-sm" id="applypromocode" type="button">Apply</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                           <!--  <div class="text-right">
                                <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#change_card"> Change Card </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-xl-6">
                    <div class="card right">
                        <input type="hidden" name="cart_id" value="{{ @$launch_cart->id }}"/>
                        <h5 class="card-header" >
                            <?php $cart_items = '' ?>
                            <?php if (!empty($launch_cart->products)) { ?>
                                <?php $cart_items = '(' . count($launch_cart->products) . ' items)' ?>
                            <?php } ?>
                            My Cart <span class="text-secondary">(<span class="cart-items-count">{{ $launch_cart_product_count }}</span> items)</span>
                        </h5>
                        <div class="card-body pt-0 pr-0 pl-0 pb-0">
                            <div class="cart-table shop-detail-right my_cart">
                                <div class="table-responsive">
                                    <table class="table cart_summary">
                                        <tbody class"cart-product-list">
                                            @if (empty($launch_cart->products))
                                            <tr>
                                                <td class="text-center total_price" colspan="7"><strong>Empty Cart</strong></td>
                                            </tr>
                                            @else
                                            @if(!empty(@$launch_cart))
                                                @foreach ($launch_cart->products as $key=>  $product_item)
                                                @include('cart_productitem')
                                                @endforeach
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="cart-sidebar-footer">
                                <div class="table-responsive">
                                    <table class="table cart_summary">
                                        <tfoot>
                                            <tr>
                                                <td class="text-right total_price"  colspan="7"><strong>Total: <span class="text-danger">S$ <span class="cart-total-price">{{ number_format($launch_cart->total_price, 2) }}</span></span></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right total_price" colspan="7"><strong>Delivery Fee: </strong><span class="cart-delivery-fee">{{ $launch_cart->delivery_fee->display }}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right total_price" colspan="7"><strong>Concierge Fee: </strong><span class="cart-concierge-fee">{{ $launch_cart->concierge_fee->display }}</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <a id="doCheckout" href="{{url('/checkout') }}"><button class="btn btn-lg btn-block text-left" type="button"><span class="float-left">Proceed to Checkout </span><span class="float-right"><strong>S$ <span class="cart-total">{{ number_format($launch_cart->total, 2) }}</span></strong></span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<!-- <section class="related-products">
    <div class="container">
        <div class="section-header">
            <h5 class="heading-design-h5"><span>Related Product</span></h5>
        </div>
        <div class="owl-carousel relatedSlider">
            <div class="item">
                <div class="product">
                    <a href="{{url('/product_detail') }}">
                        <div class="product-header">
                            <span class="badge badge-success">25%</span>
                            <img class="img-fluid" src="{{ asset('client/images/prod1.jpg') }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <a href="{{url('/product_detail') }}"><span class="title">Product Title Here</span></a>
                            <span class="text">Fairprice</span>
                            <p class="offer-price"><span class="regular-price">S$ 7.00</span> S$ 5.50 </p>
                        </div>
                        <div class="options">
                            <label>Weight</label>
                            <select class="form-control">
                                <option>1 kg</option>
                                <option>3 kg</option>
                                <option>6 kg</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        <a href="{{url('/cart') }}"><button type="button" class="btn btn-secondary btn-sm float-right">Add <i class="last">+</i></button></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <a href="{{url('/product_detail') }}">
                        <div class="product-header">
                            <img class="img-fluid" src="{{ asset('client/images/prod2.jpg') }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <a href="{{url('/product_detail') }}"><span class="title">Product Title Here</span></a>
                            <span class="text">Fairprice</span>
                            <p class="offer-price">S$ 5.50 </p>
                        </div>
                        <div class="options">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        <a href="{{url('/cart') }}"><button type="button" class="btn btn-secondary btn-sm float-right">Add <i class="last">+</i></button></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <a href="{{url('/product_detail') }}">
                        <div class="product-header">
                            <img class="img-fluid" src="{{ asset('client/images/prod3.jpg') }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <span class="title">Product Title Here</span>
                            <span class="text">Fairprice</span>          
                            <p class="offer-price">S$ 5.50 </p>
                        </div>
                        <div class="options">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        <a href="{{url('/cart') }}"><button type="button" class="btn btn-secondary btn-sm float-right">Select Options</button></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <a href="{{url('/product_detail') }}">
                        <div class="product-header">
                            <span class="badge badge-success">50%</span>
                            <img class="img-fluid" src="{{ asset('client/images/prod4.jpg') }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <a href="{{url('/product_detail') }}"><span class="title">Product Title Here</span></a>
                            <span class="text">Fairprice</span>
                            <p class="offer-price">S$ 5.50 </p>
                        </div>
                        <div class="options">
                            <label>Weight</label>
                            <select class="form-control">
                                <option>340 g</option>
                                <option>1 kg</option>
                                <option>2 kg</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        <a href="{{url('/cart') }}"><button type="button" class="btn btn-secondary btn-sm float-right"><i class="first">-</i>2 <i class="last">+</i></button></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <a href="{{url('/product_detail') }}">
                        <div class="product-header">
                            <span class="badge badge-success">50%</span>
                            <img class="img-fluid" src="{{ asset('client/images/prod2.jpg') }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <a href="{{url('/product_detail') }}"><span class="title">Product Title Here</span></a>
                            <span class="text">Fairprice</span>
                            <p class="offer-price"><span class="regular-price">S$ 7.00</span> S$ 5.50 </p>
                        </div>
                        <div class="options">
                            <label>Weight</label>
                            <select class="form-control">
                                <option>1 kg</option>
                                <option>3 kg</option>
                                <option>6 kg</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        <a href="{{url('/cart') }}"><button type="button" class="btn btn-secondary btn-sm float-right">Add <i class="last">+</i></button></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="product">
                    <a href="{{url('/product_detail') }}">
                        <div class="product-header">
                            <span class="badge badge-success">50%</span>
                            <img class="img-fluid" src="{{ asset('client/images/prod3.jpg') }}" alt="">
                        </div>
                    </a>
                    <div class="product-body">
                        <div class="float-left">
                            <span class="title">Product Title Here</span>
                            <span class="text">Fairprice</span>
                            <p class="offer-price"><span class="regular-price">S$ 7.00</span> S$ 60 </p>
                        </div>
                        <div class="options">
                            <label>Weight</label>
                            <select class="form-control">
                                <option>1 kg</option>
                                <option>3 kg</option>
                                <option>6 kg</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="product-footer">
                        <a href="{{url('/cart') }}"><button type="button" class="btn btn-secondary btn-sm float-right">Add <i class="last">+</i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

@include('about_footer')

<!-- change address Modal -->
<!-- <div class="add_address" id="address_modal_div"> -->
    
<!-- </div> -->

<div class="add_address" id="address_modal_div">
    @include('layouts.addressmodal')
</div>
<!-- add address Modal -->
@include('newaddress.modal')
 
<!-- change card Modal -->
<div class="add_address" id="card_modal_div">
    <!--  -->
    @include('layouts.modal')
</div>
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