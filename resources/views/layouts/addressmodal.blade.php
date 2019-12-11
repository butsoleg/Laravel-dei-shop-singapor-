<div class="modal fade" id="change_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel"> Change Address </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <div class="my_address">
                        @if(!empty(@$addresses))
                        @foreach(@$addresses as $addresskey=> $address)
                            <div class="box_body address_div @if($addresskey == 0) selected_address @endif">
                                <div class="hiddenAddress" style="display:none;">
                                     <h3 class="capitalize">{{ @$address->profile_name }}</h3>
                                    
                                    <p>{{ @$address->building_type }}  <br>
                                    @if(!empty($address->unit) && $address->unit != '0' ) <p>{{ @$address->unit }}  <br>@endif
                                    @if(!empty($address->floor) && $address->floor != '0' ) <p>{{ @$address->floor }}  <br>@endif
                                    @if(!empty($address->building_name))<p>{{ @$address->building_name }}  <br>@endif
                                    @if(!empty($address->lobby_name))<p>{{ @$address->lobby_name }}  <br>@endif
                                    <p>{{ @$address->street }} <br>
                                    {{ @$address->city }} <br>
                                        {{ @$address->state }} , {{ @$address->postal_code }}<br> 
                                        {{ @$address->country }}</p>
                                   
                                    <p class="addressName" style="display:none;">{{ @$address->firstname }} {{ @$address->lastname }}</p>
                                    <input type="hidden" name="address_id" value="{{ @$address->id }}">

                                </div>
                                <h3>{{$address->profile_name}} <span class="float-right check_circle"><i class="mdi mdi-check-circle"></i></span></h3>
                                <p>{{@$address->firstname}} {{@$address->lastname}} {{@$address->building_type}} {{@$address->unit}} {{@$address->floor}} {{@$address->building_name}} {{@$address->lobby_name}} {{@$address->street}} {{@$address->address-2}} {{@$address->city}}  {{@$address->state}}  {{@$address->country}} {{@$address->postal_code}}  {{ @$address->contact}}</p>
                            </div>
                        @endforeach
                        @else

                         <div  class="box_body selected_address">
                                      <h3><span class="text-center">No Data Found</span> </h3>
                                   </div>
                                   @endif
            
                        <div class="text-right">
                            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add_address"> Add New Address </button>
                        </div>
                    </div> -->
                     @include('ListAddress', ['addresses' => $addresses , 'page' => true, 'editable' => false])
                </div>
            </div>
        </div>
    </div>