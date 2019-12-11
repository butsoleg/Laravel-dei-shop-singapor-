@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Registration" => false])

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <div class="row">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="faq-leftpanel">
                            <ul>
                                <li><a href="#" class="faq-active">Registration</a></li>
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

                        <h2 class="color-purple">Registration</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper registration">
                                <h4 class="padT0">How do I register?</h4>
                                <p>You can register by clicking on the "Sign Up" link at the top right corner of the homepage. Please provide the information in the form that appears. You can review the terms and conditions, provide your address details and submit the registration information.
                                </p>
                                <h4>Are there any charges for registration?</h4>
                                <p>No. Registration on dei.com.sg is absolutely free.
                                </p>
                                <h4>Do I have to register to shop on dei.com.sg?</h4>
                                <p>You can surf and add products to the cart without registration but only registered shoppers will be able to checkout and place orders. Registered members should be logged in at the time of checking out the cart, they will be prompted to do so if they are not logged in.
                                </p>
                                <h4>Can I have multiple registrations?</h4>
                                <p>Each email address and contact phone number can only be associated with one dei.com.sg account.
                                </p>
                                <h4>Can I add more than one delivery address in an account?</h4>
                                <p>Yes, you can add multiple delivery addresses in your dei.com.sg account. However, remember that all items placed in a single order can only be delivered to one address. If you want different products delivered to different address you need to place them as separate orders.
                                </p>
                                <h4>Can I have multiple accounts with same mobile number and email id?</h4>
                                <p>Each email address and phone number can be associated with one dei.com.sg account only.
                                </p>
                                <h4>Can I have multiple accounts for members in my family with different mobile number and email address but same or common delivery address?</h4>
                                <p>Yes, we do understand the importance of time and the toil involved in shopping groceries. Up to three members in a family can have the same address provided the email address and phone number associated with the accounts are unique.
                                </p>
                                <h4>Can I have different city addresses under one account and still place orders for multiple cities?</h4>
                                <p>We only deliver within Singapore now.
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
