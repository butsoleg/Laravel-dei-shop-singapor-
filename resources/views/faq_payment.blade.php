@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Payment" => false])

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <div class="row">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="faq-leftpanel">
                            <ul>
                                <li><a href="{{ route('faq.registration') }}">Registration</a></li>
                                <li><a href="{{ route('faq.account_related') }}">Account Related</a></li>
                                <li><a href="#" class="faq-active">Payment</a></li>
                                <li><a href="{{ route('faq.delivery_related') }}">Delivery Related</a></li>
                                <li><a href="{{ route('faq.order_related') }}">Order Related</a></li>
                                <li><a href="{{ route('faq.customer_related') }}">Customer related</a></li>
                                <li><a href="{{ route('faq.how_does_it_work') }}">How Does It Work</a></li>
                                <li><a href="{{ route('faq.others') }}">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">Payment</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper payment">
                                <h4 id="payment_mode" class="padT0">What are the modes of payment?</h4>
                                <p>You can pay for your order on dei.com.sg using the following modes of payment:
                                </p>
                                <ol class="faq_listcount" type="a">
                                    <li>Cash on delivery</li>
                                    <li>Credit and debit cards (VISA / Mastercard/Amex)</li>
                                    <li>PayPal</li>
                                </ol>
                                <h4 id="gst_inv">Are there any other charges or taxes in addition to the price shown? Is GST added to the invoice?</h4>
                                <p>The GST is included in the MRP of products. There are no additional taxes added by DEI.COM.SG to your order.
                                </p>
                                <h4>Is it safe to use my credit/ debit card on DEI.COM.SG?</h4>
                                <p>Yes, it is absolutely safe to use your card on DEI.COM.SG. A recent directive from MAS makes it mandatory to have an additional authentication pass code verified by VISA (VBV) or MSC (Master Secure Code) which should be entered by online shoppers while paying online using visa or master credit card. It means extra security for customers, thus making online shopping safer
                                </p>
                                <h4>What is the meaning of cash on delivery?</h4>
                                <p>Cash on delivery means that you can pay for your order at the time of order delivery at your doorstep.
                                </p>
                                <h4 id="amount_back">If I pay by credit card how do I get the amount back for items not delivered?</h4>
                                <p>If we are not able to delivery all the products in your order and you have already paid for them online, the balance amount will be refunded to your bank account WITHIN 14 DAYS
                                </p>
                                <h4>Where do I enter the coupon code?</h4>
                                <p>Once you are done selecting your products and click on checkout you will be prompted to select delivery slot and payment method. On the payment method page, there is a box where you can enter any evoucher/ coupon code that you have. The amount will automatically be deducted from your invoice value.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
</section> 




@endsection
