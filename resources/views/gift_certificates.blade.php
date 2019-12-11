@extends('layouts.app')

@section('content')

<section class="gift-certificates">

    @include('breadcrumbs', $data = ["Gift Certificates" => false])
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <h2 class="color-purple">Purchase Gift Certificate</h2><br/>

                <form class="gift-certificates-form" action="{{ route('email_send') }}" method="post" target="_self" name="gift_certificates_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="from_page" value="gift_certificates">
                    <div class="dei-control-group">
                        <label for="gift_cert_recipient" class="dei-control-group-title">To</label>
                        <input type="text" id="gift_cert_recipient" name="gift_cert_data[recipient]" class="dei-input-text-full cm-focus" size="50" maxlength="255" value="">
                    </div>
                    <div class="dei-control-group">
                        <label for="gift_cert_sender" class="dei-control-group-title">From</label>
                        <input type="text" id="gift_cert_sender" name="gift_cert_data[sender]" class="dei-input-text-full" size="50" maxlength="255" value="">
                    </div>
                    <div class="dei-control-group dei-gift-certificate-amount">
                        <label for="gift_cert_amount" class="dei-control-group-title cm-gc-validate-amount">Amount</label>
                        
                        <input type="text" id="gift_cert_amount" name="gift_cert_data[amount]" class="dei-gift-certificate-amount-input cm-numeric" data-p-sign="s" data-a-sep="" data-a-dec="." size="5" value="50.00">
                        <span class="dei-gift-certificate-currency">S$</span>
                        <div class="dei-gift-certificate-amount-alert form-field-desc">Amount should be between S$<span>50.00</span> and S$<span>1,500.00</span></div>
                    </div>
                    <div class="dei-control-group">
                        <label for="gift_cert_message" class="dei-control-group-title">Message</label>
                        <textarea id="gift_cert_message" name="gift_cert_data[message]" cols="72" rows="4" class=""></textarea>
                    </div>
                    <div class="dei-gift-certificate-products dei-control-group">

                        <p id="free_products_no_item" class="dei-no-items">No products defined</p>
                        <table id="free_products" class="dei-table hidden cm-picker-options">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody><tr class="cm-js-item cm-clone hidden">
                                <td><div class="dei-table__responsive-header">Name</div><div class="dei-table__responsive-content">
                                    <ul>
                                        <li>{product}
                                            <a href="javascript: Tygh.$.cePicker('delete_js_item', 'free_products', '{delete_id}', 'p');" class="dei-delete-big" title="Remove"><i class="dei-delete-big__icon dei-icon-cancel-circle"></i></a>
                                        </li>
                                        <li>{options}</li>
                                    </ul>
                                </div></td>
                                <td class="dei-center"><div class="dei-table__responsive-header">Qty</div><div class="dei-table__responsive-content">
                                    <input type="text" name="gift_cert_data[products][{product_id}][amount]" value="1" size="3" class="short" disabled="disabled">
                                </div></td>
                            </tr>
                        </tbody></table>
                        <div class="dei-mt-m">
                            <a class="dei-btn dei-btn-secondary cm-dialog-opener text-button" id="opener_picker_free_products" href="#" rel="nofollow" data-ca-target-id="content_free_products">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                            Add products for a gift</a>
                        </div>

                    </div>
                    <div class="dei-gift-certificate-switch clearfix">
                        <div class="dei-gift-certificate-switch-label gift-send-right">How to send?</div>
                        <div class="dei-gift-certificate-switch-mail">
                            <div class="dei-gift-certificate-send">
                                <input type="radio" name="gift_cert_data[send_via]" value="E" checked="checked" class="radio" id="sw_gc_switcher_suffix_e"><label for="sw_gc_switcher_suffix_e" class="dei-valign">Send via email</label>
                            </div>
                            <div class="dei-gift-certificate-send">
                                <input type="radio" name="gift_cert_data[send_via]" value="P" class="radio" id="sw_gc_switcher_suffix_p"><label for="sw_gc_switcher_suffix_p" class="dei-valign">Send via postal mail</label>
                            </div>
                        </div>
                    </div>
                    <div id="gc_switcher">
                        <div class="dei-gift-certificate-block" id="email_block">
                            <div class="dei-control-group">
                                <label for="gift_cert_email" class="cm-required cm-email dei-control-group-title">Email</label>
                                <input type="text" id="gift_cert_email" name="gift_cert_data[email]" class="dei-input-text-full" size="40" maxlength="128" value="">
                            </div>
                            <div class="dei-control-group">
                                <input id="gift_cert_template" type="hidden" name="gift_cert_data[template]" value="default.tpl">
                            </div>
                        </div>
                        <div class="dei-gift-certificate-block hidden" id="post_block" style="display: none;">
                            <div class="dei-control-group">
                                <label for="gift_cert_phone" class="dei-control-group-title">Phone</label>
                                <input type="text" id="gift_cert_phone" name="gift_cert_data[phone]" class="dei-input-text-full disabled" size="50" value="" disabled="">
                            </div>
                            <div class="dei-control-group">
                                <label for="gift_cert_address" class="dei-control-group-title">Address</label>
                                <input type="text" id="gift_cert_address" name="gift_cert_data[address]" class="dei-input-text-full disabled" size="50" value="" disabled="">
                            </div>
                            <div class="dei-control-group">
                                <input type="text" id="gift_cert_address_2" name="gift_cert_data[address_2]" class="dei-input-text-full disabled" size="50" value="" disabled="">
                            </div>
                            <div class="dei-control-group">
                                <label for="gift_cert_city" class="dei-control-group-title">City</label>
                                <input type="text" id="gift_cert_city" name="gift_cert_data[city]" class="dei-input-text-full disabled" size="50" value="" disabled="">
                            </div>
                            <div class="dei-control-group dei-float-left dei-gift-certificate-country country">
                                <label for="gift_cert_country" class="dei-control-group-title">Country</label>
                                <select id="gift_cert_country" name="gift_cert_data[country]" class="dei-gift-certificate-select cm-country cm-location-billing disabled" disabled="">
                                    <option value="">- Select country -</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AP">Asia-Pacific</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia</option>
                                    <option value="BA">Bosnia and Herzegowina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="VG">British Virgin Islands</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Cote D'ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="TL">East Timor</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="EU">Europe</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="FX">France, Metropolitan</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard and McDonald Islands</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IR">Islamic Republic of Iran</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Laos</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libyan Arab Jamahiriya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macau</option>
                                    <option value="MK">Macedonia</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestine Authority</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RS">Republic of Serbia</option>
                                    <option value="RE">Reunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="CS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option selected="selected" value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SH">St. Helena</option>
                                    <option value="KN">St. Kitts and Nevis</option>
                                    <option value="PM">St. Pierre and Miquelon</option>
                                    <option value="VC">St. Vincent and the Grenadines</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom (Great Britain)</option>
                                    <option value="US">United States</option>
                                    <option value="VI">United States Virgin Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VA">Vatican City State</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="WF">Wallis And Futuna Islands</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZR">Zaire</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                            </div>
                            <div class="dei-control-group dei-float-right dei-gift-certificate-state state">
                                <label for="gift_cert_state" class="dei-control-group-title">State/Province</label>
                                <select class="dei-gift-certificate-select cm-state cm-location-billing hidden cm-skip-avail-switch" id="gift_cert_state_d" name="gift_cert_data[state]" disabled="">
                                    <option value="">- Select state -</option>
                                </select>
                                <input type="text" id="gift_cert_state" name="gift_cert_data[state]" class="cm-state cm-location-billing dei-input-text disabled" size="50" maxlength="64" value="" disabled="">
                            </div>
                            <div class="dei-control-group zipcode">
                                <label for="gift_cert_zipcode" class="dei-control-group-title cm-zipcode cm-location-billing">Zip/postal code</label>
                                <input type="text" id="gift_cert_zipcode" name="gift_cert_data[zipcode]" class="dei-input-text-short disabled" size="50" value="" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="dei-gift-certificate-buttons buttons-container">
                        <input type="hidden" name="result_ids" value="cart_status*,wish_list*,account_info*">
                        <input type="hidden" name="redirect_url" value="index.php?dispatch=gift_certificates.add">
                        <button class="dei-btn-primary dei-btn-big dei-btn-add-to-cart cm-form-dialog-closer dei-btn dei-gift-cert-btn" type="submit" name="dispatch[gift_certificates.add]">Add to cart</button>
                        <span class="vs-button-spacer">&nbsp;&nbsp;&nbsp;</span>
                        <input type="hidden" name="result_ids" value="cart_status*,wishlist*,account_info*">
                        <div class="dei-float-right dei-gift-certificate-preview-btn">
                            <button class="dei-btn-tertiary cm-new-window dei-btn dei-gift-cert-btn" type="submit" name="dispatch[gift_certificates.preview]">Preview</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section> 




@endsection
