@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Delivery Related" => false])
   
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
                                <li><a href="#" class="faq-active">Delivery Related</a></li>
                                <li><a href="{{ route('faq.order_related') }}">Order Related</a></li>
                                <li><a href="{{ route('faq.customer_related') }}">Customer related</a></li>
                                <li><a href="{{ route('faq.how_does_it_work') }}">How Does It Work</a></li>
                                <li><a href="{{ route('faq.others') }}">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">Delivery Related</h2><br/>

                        <div class="faq-container">
                            <div id="receive_order" class="faq_question_wrapper delivery">
                                <h4 class="padT0">When will I receive my order?</h4>
                                <p>Once you are done selecting your products and click on checkout you will be prompted to select delivery slot. Your order will be delivered to you on the day and slot selected by you. Orders before 10 AM can be delivered within the same day at the delivery slots 5pm to 8pm and 7pm to 10pm. Orders after 10 AM can only be delivered the following day. (No deliveries on Sundays &amp; Public Holidays).
                                </p>
                                <h4>How are the fruits and vegetables packaged?</h4>
                                <p>Fresh fruits and vegetables are handpicked and hand cleaned. We ensure hygienic and careful handling of all our products.</p>
                                <h4>How will the delivery be done?</h4>
                                <p>We have a dedicated team of delivery personnel and a fleet of vehicles operating across the city which ensures timely and accurate delivery to our customers.
                                </p>
                                <h4>How do I change the delivery info (address to which I want products delivered)?</h4>
                                <p>You can change your delivery address on our website once you log into your account. Click on “My Account” at the top right-hand corner and go to the “Update My Profile” section to change your delivery address.
                                </p>
                                <h4>How much are the delivery charges?</h4>
                                <p>First times get free delivery with a minimum purchase of $30
                                </p>
                                <p>For subsequent purchases, you will receive free delivery with a minimum purchase of $59</p>
                                <p>However, if you are unable to attain the minimum amount don’t worry, we will deliver anywhere in Singapore for only $5.99!</p>
                                <h4>Will someone inform me if my order delivery gets delayed?</h4>
                                <p>In case of a delay, our customer support team will keep you updated about your delivery.
                                </p>
                                <h4>Do you do same day delivery?</h4>
                                <p>We do same day delivery provided you place your order before 10 AM on the day you want delivery.
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
