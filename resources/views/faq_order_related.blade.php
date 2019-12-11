@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Order Related" => false])

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
                                <li><a href="#" class="faq-active">Order Related</a></li>
                                <li><a href="{{ route('faq.customer_related') }}">Customer related</a></li>
                                <li><a href="{{ route('faq.how_does_it_work') }}">How Does It Work</a></li>
                                <li><a href="{{ route('faq.others') }}">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">Order Related</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper oreder_related">
                                <h4 class="padT0">What are delivery slots?</h4>
                                <p>Dei delivers Monday to Saturday except on public holidays. We deliver between 5pm to 8pm and 7pm to 10 AM.
                                </p>
                                <h4>What is a cut-off time and what are the corresponding cut-off timing for each slot?</h4>
                                <p>To receive same day delivery, cut-off time for orders to be placed is 10 AM.
                                </p>
                                <h4>Can I add products after the cut off time for a slot?</h4>
                                <p>No, you will not be able to make any changes to your order after the cut off time for your selected slot. However, if you do not wish to buy a product you may return it at the time of delivery and the amount will be credited to your account.
                                </p>
                                <h4>Can I change my order delivery slot after placing the order?</h4>
                                <p>Delivery slot cannot be changed once the order is placed. In case of an urgent requirement of change of slot please contact our customer support team and we will try our best to accommodate your request.
                                </p>
                                <h4>How do I add or remove products after placing my order?</h4>
                                <p>Once you have placed your order you will not be able to make modifications on the website. Please contact our customer support team for any modification of order.
                                </p>
                                <h4>Is it possible to order an item which is out of stock?</h4>
                                <p>No, you can only order products which are in stock. We try to ensure availability of all products on our website however due to supply chain issues sometimes this is not possible
                                </p>
                                <h4 id="cso">How do I check the current status of my order?</h4>
                                <p>The only way you can check the status of your order is by contacting our customer support team.
                                </p>
                                <h4>How do I check which items were not available from my order? Will someone inform me about the items unavailable in my order before delivery?</h4>
                                <p>You will receive a call as well as an SMS about unavailable items before the delivery of your order.
                                </p>
                                <h4 id="cancel_order">When and how can I cancel an order?</h4>
                                <p>You can cancel your order before 10 AM on the day of your order.
                                </p>
                                <h4>What You Receive Is What You Pay For</h4>
                                <p>At the time of delivery, we advise you to kindly check every item as in the invoice. Please report any missing item that is invoiced. As a benefit to our customers, if you are not available at the time of order delivery or you haven’t checked the list at the time of delivery we provide a window of 24hrs to report missing items. This is applicable only for items that are invoiced
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
