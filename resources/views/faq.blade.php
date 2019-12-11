@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => false])

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <div class="row">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="faq-leftpanel">
                            <ul>
                                <li><a href="{{ route('faq.registration') }}">Registration</a></li>
                                <li><a href="{{ route('faq.account_related') }}">Account Related</a></li>
                                <li><a href="{{ route('faq.payment') }}">Payment</a></li>
                                <li><a href="{{ route('faq.delivery_related') }}">Delivery Related</a></li>
                                <li><a href="{{ route('faq.order_related') }}">Order Related</a></li>
                                <li><a href="{{ route('faq.customer_related') }}">Customer related</a></li>
                                <li><a href="{{ route('faq.how_does_it_work') }}">How Does It Work</a></li>
                                <li><a href="{{ route('faq.others') }}">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">Faq</h2><br/>

                        <div class="faq-container">
                            <ul>
                                <li>
                                    <a href="{{ route('faq.delivery_related') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq1.png?1505120177915"></span></span>
                                        <span class="faq-linkcontent">When will I receive my order?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.delivery_related') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq2.png?1505120998309"></span></span>
                                        <span class="faq-linkcontent">How will the delivery be done?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.order_related') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq3.png?1505122954814"></span></span>
                                        <span class="faq-linkcontent">How do I check the current status of my order? </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.order_related') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq4.png?1505123653811"></span></span>
                                        <span class="faq-linkcontent">When and how can I cancel an order?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.order_related') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq5.png?1505124524128"></span></span>
                                        <span class="faq-linkcontent">Return &amp; Refund</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.payment') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq6.png?1505133456912"></span></span>
                                        <span class="faq-linkcontent">What are the modes of payment?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.payment') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq7.png?1505124679972"></span></span>
                                        <span class="faq-linkcontent">Is GST added to the invoice?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('faq.payment') }}" class="faq-linkblock">
                                        <span class="faq-img-outer"><span class="faq-img"><img src="https://dei.com.sg/images/faq8.png?1505124770469"></span></span>
                                        <span class="faq-linkcontent">How do I get the amount back for items not delivered?</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

</div>
</section> 




@endsection
