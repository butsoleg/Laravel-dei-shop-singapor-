@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Others" => false])

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
                                <li><a href="#" class="faq-active">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">Others</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper faq_other">
                                <h3>Operational Charges, Responsibilities and Service Guarantees</h3>
                                <h4>Who is responsible for my Order?</h4>
                                <p>At dei.com.sg, we believe in total customer satisfaction and hence, go to great lengths to make sure you get the product you want and at the time you want. Our marketplace is our new service to deliver products from Little India to you within the same day. These products can also be delivered at specified slots, as per your convenience. We understand that as a customer you have your preferences for specialty products and the stores you buy them from. This is our initiative to bring the same to you from the store of your preference.
                                </p>
                                <h4>I received an invoice from the Specialty Store. Shouldn’t dei.com.sg provide an invoice?</h4>
                                <p>Dei.com.sg is a marketplace where your favourite stores can sell their products to you. dei.com.sg only facilitates the entire process by providing the technology and logistics capabilities to enable the sale. As such, you are buying directly from the Specialty Store and hence will receive an invoice from the store or a consolidated invoice from the different vendors.
                                </p>
                                <h4>What guarantees does dei.com.sg give for Specialty Store products?</h4>
                                <p>The quality of the product you buy on dei.com.sg is guaranteed by the individual stores. dei.com.sg is not responsible for the same. dei.com.sg is only responsible for ensuring your order is correctly captured and transmitted to the store. As such, dei.com.sg only provides a delivery guarantee. That is, dei.com.sg guarantees to deliver products from your trusted neighbourhood store in the time committed to you. The time will be explicitly communicated to you when you place an order.
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
