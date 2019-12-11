@extends('layouts.app')

@section('content')

<section class="vendor-register">

    @include('breadcrumbs', $data = ["Apply for a vendor account" => false])

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">

                <h2 class="color-purple">Apply for a vendor account</h2><br/>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">

                        <form action="{{ route('email_send') }}" method="post" name="apply_for_vendor_form" class="cm-processed-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="from_page" value="vendor_register">
                            <div class="dei-control-group clearfix">
                                <label for="company_description_company" class="dei-control-group-title cm-required">Company</label>
                                <input type="text" name="company_data[company]" id="company_description_company" size="32" value="" class="dei-input-text cm-focus">
                            </div>
                            <div class="dei-control-group clearfix">
                                <label class="dei-control-group-title" for="company_description">Description</label>
                                <textarea id="company_description" name="company_data[company_description]" cols="55" rows="5" class="dei-input-textarea-long"></textarea>
                            </div>
                            <input type="hidden" name="company_data[lang_code]" value="en">

                            <div class="dei-control-group clearfix" id="company_description_admin_firstname">
                                <label for="company_admin_firstname" class="dei-control-group-title cm-required">First name</label>
                                <input type="text" name="company_data[admin_firstname]" id="company_admin_firstname" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix" id="company_description_admin_lastname">
                                <label for="company_admin_lastname" class="dei-control-group-title cm-required">Last name</label>
                                <input type="text" name="company_data[admin_lastname]" id="company_admin_lastname" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix">
                                <label for="company_description_email" class="dei-control-group-title cm-required cm-email cm-trim">Email</label>
                                <input type="text" name="company_data[email]" id="company_description_email" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix">
                                <label for="company_description_phone" class="dei-control-group-title cm-required">Phone</label>
                                <input type="text" name="company_data[phone]" id="company_description_phone" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix">
                                <label class="dei-control-group-title" for="company_description_url">URL</label>
                                <input type="text" name="company_data[url]" id="company_description_url" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix">
                                <label class="dei-control-group-title" for="company_description_fax">Fax</label>
                                <input type="text" name="company_data[fax]" id="company_description_fax" size="32" value="" class="dei-input-text">
                            </div>
                            <input type="hidden" name="ship_to_another" value="1">
                            <div class="clearfix">
                                <h4 class="dei-subheader ">
                                    Shipping address
                                </h4>
                                
                            </div>

                            <div class="dei-control-group clearfix">
                                <label for="elm_42" class="dei-control-group-title cm-profile-field cm-required">Unit No <span style="color:#FF0000;">*</span></label>
                                <input type="text" id="company_user_data" name="company_data[user_data]" size="32" value="" class="dei-input-text   cm-focus">
                            </div>

                            <div class="dei-control-group clearfix">
                                <label class="dei-control-group-title cm-required" for="company_address_address">Address</label>
                                <input type="text" name="company_data[address]" id="company_address_address" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix">
                                <label class="dei-control-group-title cm-required" for="company_address_city">City</label>
                                <input type="text" name="company_data[city]" id="company_address_city" size="32" value="" class="dei-input-text">
                            </div>
                            <div class="dei-control-group clearfix shipping-country">
                                <label for="company_address_country" class="dei-control-group-title cm-required">Country</label>
                                <select class="cm-country cm-location-shipping" id="company_address_country" name="company_data[country]">
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
                            <div class="dei-control-group shipping-state clearfix">
                                <label for="company_address_state" class="dei-control-group-title cm-required">State/Province</label>
                                
                                <input type="text" id="company_address_state" name="company_data[state]" size="32" maxlength="64" value="" class="cm-state cm-location-shipping dei-input-text">
                            </div>
                            <div class="dei-control-group shipping-zip-code clearfix">
                                <label for="company_address_zipcode" class="dei-control-group-title cm-required cm-zipcode">Zip/postal code</label>
                                <input type="text" name="company_data[zipcode]" id="company_address_zipcode" size="32" value="" class="dei-input-text">
                            </div>
                            
                            <div class="buttons-container clearfix">
                                <button id="but_apply_for_vendor" class="dei-btn-primary dei-btn dei-btn-big" type="submit" name="dispatch[companies.apply_for_vendor]">Submit</button>
                            </div>
                        </form>


                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">

                        <div class="dei-company-info">
                            <h4>Become a vendor</h4>
                            <br/>
                            <ul>
                                <li> - Access your personal administrator area</li>
                                <li> - Use the common storefront to sell your goods</li>
                                <li> - Get your profit share</li>
                            </ul>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</section> 




@endsection
