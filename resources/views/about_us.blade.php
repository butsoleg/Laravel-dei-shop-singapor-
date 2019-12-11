@extends('layouts.app')

@section('content')

<section class="about-us">

    @include('breadcrumbs', $data = ["About Us" => false])
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <h2 class="color-purple">About Us</h2>

                <p class="color-black"><strong>Dei is a online portal that fulfills the daily needs of the Asian community in Singapore. We focus on sourcing for specialty products for the local community. A one-stop shopping portal to fulfil your daily essentials, we go the distance to ensure unparalleled customer service and convenience for our customers.</strong> </p>

                <p class="color-black"><strong>Hosting over 10,000 products and the widest range and variety of Indian goods, we are constantly increasing our product range to ensure everyone gets their shopping done from any store and have it delivered at a go straight to your homes at one delivery charge.</strong></p>

            </div>
        </div>

    </div>
</section> 




@endsection
