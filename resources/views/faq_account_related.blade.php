@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Account Related" => false])
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <div class="row">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="faq-leftpanel">
                            <ul>
                                <li><a href="{{ route('faq.registration') }}">Registration</a></li>
                                <li><a href="#" class="faq-active">Account Related</a></li>
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

                        <h2 class="color-purple">Account Related</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper account">
                                <h4 class="padT0">What is My Account?</h4>
                                <p>My Account is the section you reach after you log in at dei.com.sg. My Account allows you to track your active orders, credit note details as well as see your order history and update your contact details.
                                </p>
                                <h4>How do I reset my password?</h4>
                                <p>You need to enter your email address on the Login page and click on forgot password. An email with a reset password will be sent to your email address. With this, you can change your password. In case of any further issues please contact our customer support team.
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
