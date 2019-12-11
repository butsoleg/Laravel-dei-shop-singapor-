
<div class="my_address">
  @if(!empty($addresses))
      @foreach($addresses as $key=> $address)
     <div  class="box_body {{ ($key == 0)? 'selected_address':''}}">
        <h3> {{$address->profile_name}} @if($page)<span class="float-right check_circle"><i class="fas fa-check-circle"></i></span>@endif</h3>
        <p>{{@$address->firstname}} {{@$address->lastname}} {{ @$address->contact}}</p>
        <p>{{@$address->street}},&nbsp;&nbsp;#{{@$address->floor}}-{{@$address->unit}}</p>
        <p>{{@$address->country}} {{@$address->postal_code}}</p>
         <!-- {{@$address->building_type}}  {{@$address->building_name}} {{@$address->lobby_name}}  {{@$address->address-2}} {{@$address->city}}  {{@$address->state}}     -->
         @if($page && $editable)
        <a  class="editAddressModal" data-addressId="{{ $address->id}}">Edit </a> <span class="line">|</span> <a href="{{ url('/delete_address') }}/{{ $address->id}}"> Delete</a>
        @endif
        <!-- <input type="hidden" name="address_id" value="{{ @$address->id }}"> -->

     </div>
     @endforeach
     @else
    <div  class="box_body selected_address">
        <h3><span class="text-center">No Data Found</span> </h3>
     </div>
     @endif
   @if($page)
   <div class="text-right mt-4">
      <button type="button" class="@if($editable)btn btn-success btn-lg @else btn btn-danger btn-lg @endif"  data-toggle="modal" data-target="#add_address"> Add New Address </button>
   </div>
   @else
   <div class="text-right" id="address_btn">
      <button type="button" class="btn btn-lg" data-toggle="modal" id="change_address_modal"> Change Address </button>
  </div>
  @endif
</div>

