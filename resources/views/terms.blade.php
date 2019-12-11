@extends('layouts.app')
@section('content')

    <section class="terms">
    
        @include('breadcrumbs', $data = ["Terms and Conditions" => false])

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xl-12">

                    <h2 class="color-purple">Terms and Conditions</h2>

                    <p>We like to keep it simple; the following points cover our general T&Cs. By ordering products on this site, you agree to be bound by these Terms & Conditions:</p>

                    <p><strong>General:</strong></p>
                    <ul>
                        <li>1. You must be at least 16 years of age in order to make a purchase on our site.</li>
                        <li>2. Our vouchers are non-refundable & non-exchangeable.</li>
                        <li>3. You authorize us to use, store, share & process information in order to provide a service to you; this
                            information may be utilized to send you invoices and other communications (*we don’t hold financially
                            sensitive information like credit card / bank accounts on our servers).</li>
                        <li>4. The company reserves the right to cancel, change and/or refund all purchases made on the website; any
                            decision made by the company in this regard is considered final and binding.</li>
                        <li>5. Replacement and/or extension of expired voucher is not permitted.</li>
                        <li>6. All bookings and/or reservations are subject to availability.</li>
                        <li>7. Splitting of bills is not allowed unless stated otherwise.</li>
                        <li>8. Vouchers cannot be used in combination with other offers.</li>
                        <li>9. In addition to these Terms & Conditions each voucher has product / offer specific conditions listed (in
                            case of any conflicting terms, the company’s decision is considered final).</li>
                    </ul>

                </div>
            </div>
            
        </div>
    </section>

@endsection