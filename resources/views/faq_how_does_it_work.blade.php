@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "How Does It Work" => false])

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
                                <li><a href="#" class="faq-active">How Does It Work</a></li>
                                <li><a href="{{ route('faq.others') }}">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">How Does It Work</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper it_work">
                                <h4 class="padT0">Where do the products come from?</h4>
                                <p>All orders are processed from your local trusted Little India stores and delivered to you by the DEI team. If you are not happy with any product, we have a No-Questions-Asked Return Policy and you can return them to our executive. We would also love feedback on the stores listed so that we can bring to you quality products from good stores only. Please note that DEI.COM.SG is only facilitating the purchase of your favourite product from your local storeDEI.COM.SG is NOT responsible for the quality of the product.
                                </p>
                                <h4>How is my order processed?</h4>
                                <p>As soon as you place an order, the following actions take place:
                                </p>
                                <ol class="faq_listnumb">
                                    <li>You will get a notification through EMAIL of the confirmed order along with the expected delivery time.</li>
                                    <li>The stores are notified of the order and the delivery slot. The Store then prepares your order, packs it and generates their bill for the same. They will also notify us if any of the products you had purchased is out of stock.</li>
                                    <li>Meanwhile, after the order is accepted by the store, an executive is deployed by dei.com.sg to pick up the order and deliver the same to you.</li>
                                    <li>After the order is delivered to you successfully, you will receive an Email confirming the delivery. You may also receive a call for feedback.</li>
                                </ol>
                                <p>Throughout the above stages, our Order Fulfilment Team continuously monitors the process so that you get the desired product within the time committed to you. In case the order cannot be processed for any reason whatsoever, the same will be informed to you at the earliest.
                                </p>
                                <h4>How will I know if any item in my order is unavailable?</h4>
                                <p>We try to make sure the inventory at the store is always updated so that your order can be fulfilled always. However, in case an item you ordered is unavailable at the store you selected, our order fulfilment team will notify you of the same in quick time. They will also suggest possible alternatives for the out of stock product should you desire to change the order.
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
