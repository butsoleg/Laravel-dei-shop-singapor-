@extends('layouts.app')

@section('content')

<section class="faq">

    @include('breadcrumbs', $data = ["Faq" => route('faq'), "Customer related" => false])

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
                                <li><a href="#" class="faq-active">Customer related</a></li>
                                <li><a href="{{ route('faq.how_does_it_work') }}">How Does It Work</a></li>
                                <li><a href="{{ route('faq.others') }}">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-10">

                        <h2 class="color-purple">Customer related</h2><br/>

                        <div class="faq-container">
                            <div class="faq_question_wrapper cust_related">
                                <h4 class="padT0">How do I contact customer service?</h4>
                                <p>Our customer service number is 6352 6033
                                </p>
                                <p>Or you can reach us via email at <a href="mailto:contactus@dei.com.sg">contactus@dei.com.sg</a>
                                </p>
                                <h4>What are your timings to contact customer service?</h4>
                                <p>Customer service is available between 10am- 6pm Mondays to Saturdays (except public holidays)
                                </p>
                                <p>We normally reply to emails within an hour during operation hours.
                                </p>
                                <h4>How can I give feedback on the quality of customer service?</h4>
                                <p>Please email us at <a href="mailto:contactus@dei.com.sg.">contactus@dei.com.sg.</a> We love to hear your feedback so that we can constantly improve our services and our customer experiences.
                                </p>
                                <h4>How do I raise a claim with customer service for any of the Guarantees - Delivery Guarantee, Quality Guarantee?</h4>
                                <p>If you face any issues with price, quality or delivery of products we will take every measure to address the issue and make it up to you. Please contact our customer support team with details or your order as well as the issue you faced.
                                </p>
                                <h4>Return &amp; Refund</h4>
                                <p>We have a "no questions asked return and refund policy" which entitles all our members to return the product at the time of delivery if due to some reason they are not satisfied with the quality or freshness of the product. We will take the returned product back with us and issue a credit note for the value of the return products which will be credited to your account on the Site. This can be used to pay your subsequent shopping bills
                                </p>
                                <p>Return Policy - Time Limits:
                                </p>
                                <ol class="faq_listnumb">
                                    <li>Perishable goods: Within 24 hours from the delivery date.</li>
                                    <li>Other goods: Within 2 days from the delivery date.</li>
                                </ol>
                                <h4>Where can I find currently running offers/ promotions?</h4>
                                <p>There is a link called “DEI Promotions” on the top right-hand side of our website. All products with any discount or promotions are listed under this section.
                                </p>
                                <h4>What do I do if an item is defective (broken, leaking, expired)?</h4>
                                <p>We have a no questions asked return policy. In case you are not satisfied with a product received you can return it to the delivery personnel at time of delivery or you can contact our customer support team and we will do the needful.
                                </p>
                                <h4>How will I get my money back in case of a cancellation or return? What are the modes of refund?</h4>
                                <p>The amount will be refunded to your account to use as with 14 days. In case of credit card payments, we can also credit the money back to your credit card. Please contact customer support for any further assistance regarding this issue.
                                </p>
                                <h4>I am a corporate/ business. Can I place orders with dei.com.sg?</h4>
                                <p>Yes, we do bulk supply of products at special prices to institutions such as schools, restaurants and corporates. Please contact as at <a href="mailto:contactus@dei.com.sg">contactus@dei.com.sg</a> to know more.
                                </p>
                                <h4>I’d like to suggest some products. Who do I contact?</h4>
                                <p>If you are unable to find a product or brand that you would like to shop for, please write to us at contactus@dei.com.sg and we will try our best to make the product available to you.
                                </p>
                                <h4>There is a difference in the amount mentioned in the invoice sent by the store and the order value shown by dei.com.sg when placing the order. Why should I pay the extra amount?</h4>
                                <p>dei.com.sg has a standard policy of weight variance up to 10% on its orders. However, in the case of fresh products sold by the Specialty Stores, the final weight can only be determined at the time of preparing the order. For example, a fresh chicken may weigh 1.15 KG while the order would have been taken for 1 KG. The Specialty Store would not be able to provide the exact weight requested for and would only be able to sell the fresh chicken in its entirety. To this extent, dei.com.sg allows Specialty Stores to vary the weight of the product by up to 25%. This change in weight is reflected in the bill amount difference. You are requested to pay the amount in the bill provided by the retailer at the time of delivery along with the applicable delivery charges.
                                </p>
                                <p>Please note that dei.com.sg works with the Specialty Stores to limit the variance in weight to as low as possible.
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
