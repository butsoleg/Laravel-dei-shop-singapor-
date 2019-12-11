@extends('layouts.app')

@section('content')

<section class="contact-us">

    @include('breadcrumbs', $data = ["Contact Us" => false])

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <h2 class="color-purple">Contact us</h2><br/>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <p class="color-black"><strong>Auberon I Pte Ltd</strong> </p>
                        <p>120Lower Delta Road, Cendex Centre, #10-14, Singapore 169208</p><br/>

                        <p class="color-black">Timing: <strong>9am to 6pm (Mon - Fri); closed on Weekends & Public Holidays</strong></p>
                        <p class="color-black">Customer Support Line: <strong> [+65 6352 6033 ] </strong> (Mondays to Fridays 9 am - 6 pm)</p>
                        <p class="color-black">Customer support email:  <strong>[ contactus@dei.com.sg]</strong></p>
                        <p class="color-black">Fax:  <strong>[654789120 ]</strong></p>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">

                        <div class="contact-right-form">
                            <form action="{{ route('email_send') }}" method="post" name="forms_form" enctype="multipart/form-data" class="cm-processed-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="fake" value="1">
                                <input type="hidden" name="from_page" value="contact_us">
                                <div class="contact-control-group">
                                    <label for="elm_2" class="contact-control-group-title cm-required cm-email ">Email</label>
                                    <input type="hidden" name="customer_email" value="2">
                                    <input id="contact_us_email" class="contact-input-text" size="50" type="text" name="form_values[email]" value="">
                                </div>
                                <div class="contact-control-group">
                                    <label for="elm_1" class="contact-control-group-title">Full name</label>
                                    <input id="contact_us_name" class="contact-input-text" size="50" type="text" name="form_values[name]" value="">
                                </div>
                                <div class="contact-control-group">
                                    <label for="elm_3" class="contact-control-group-title">Body</label>
                                    <textarea id="contact_us_content" class="contact-input-textarea" name="form_values[content]" cols="67" rows="10"></textarea>
                                </div>
                                
                                <div class="buttons-container">
                                    <button id="contact_us_btn" class="contact-submit-btn" type="submit" name="dispatch[pages.send_form]">Submit</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</section> 




@endsection
