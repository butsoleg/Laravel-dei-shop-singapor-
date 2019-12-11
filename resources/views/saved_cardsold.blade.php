@extends('layouts.app')

@section('content')

      <section class="account-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-9 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                        <div class="card account-left">
                         <div class="user-profile-header">
                             <div class="upload_profile">
                              @if(!empty(@$userDetail['photo_url']))
                                <img alt="profile" src="{{@$userDetail['photo_url']}}" class="previewSource">
                              
                              @else
                                <img alt="profile" src="{{asset('client/images/user.jpg')}}" class="previewSource">
                                @endif
                                <div class="upload-btn-wrapper">
                                   <button class="upload_profile_btn"><i class="mdi mdi-camera"></i></button>
                                   <input type="file" name="myfile" class="previewImage">
                                </div>
                             </div>
                             <h5 class="mb-1 text-secondary"><strong>Hi </strong> {{ @$userDetail['first_name']}} {{ @$userDetail['last_name']}}</h5>
                             <p>{{ @$userDetail['mobile'] }}</p>
                          </div>
                           <div class="list-group">
                              <a href="{{ url('/get_profile') }}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-account-outline"></i>  My Profile</a>
                              <a href="{{ url('/change_password') }}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock-outline"></i>  Change Password</a>
                              <a href="{{ url('/my_address') }}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i>  My Address</a>
                              <a href="{{ url('/saved_cards') }}" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-credit-card"></i>  My Saved Cards </a>
                              <a href="{{ url('/order_list') }}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i>  Order List</a> 
                              <a href="{{ url('/logout')}}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i>  Logout</a> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                   My Saved Cards
                                 </h5>
                              </div>
                              <div class="my_cards">
                                 <div class="cards_box selected_card">
                                    <div class="row">
                                      <div class="col-md-8 col-sm-8">
                                        <div class="tick d-inline-block">
                                          <i class="mdi mdi-check-circle"></i>
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                          <h5>Citibank</h5>
                                          <p>John jakson</p>
                                          <p>10/24</p>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-4 text-right">
                                        <img src="{{asset('client/images/master_card.png')}}">
                                        <p class="pt-3"><a class="text-danger" href="" data-toggle="modal" data-target="#edit_card">Edit </a> <span class="line text-danger">|</span> <a href="" class="text-danger"> Delete</a></p>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 <div class="cards_box">
                                    <div class="row">
                                      <div class="col-md-8 col-sm-8">
                                        <div class="tick d-inline-block">
                                          <i class="mdi mdi-check-circle"></i>
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                          <h5>HSBC</h5>
                                          <p>John jakson</p>
                                          <p>10/24</p>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-4 text-right">
                                        <img src="{{asset('client/images/visa.png')}}">
                                        <p class="pt-3"><a class="text-danger" href="" data-toggle="modal" data-target="#edit_card">Edit </a> <span class="line text-danger">|</span> <a href="" class="text-danger"> Delete</a></p>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 <div class="cards_box">
                                    <div class="row">
                                      <div class="col-md-8 col-sm-8">
                                        <div class="tick d-inline-block">
                                          <i class="mdi mdi-check-circle"></i>
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                          <h5>Citibank</h5>
                                          <p>John jakson</p>
                                          <p>10/24</p>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-4 text-right">
                                        <img src="{{asset('client/images/master_card.png')}}">
                                        <p class="pt-3"><a class="text-danger" href=""data-toggle="modal" data-target="#edit_card">Edit </a> <span class="line text-danger">|</span> <a href="" class="text-danger"> Delete</a></p>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 <div class="cards_box">
                                    <div class="row">
                                      <div class="col-md-8 col-sm-8">
                                        <div class="tick d-inline-block">
                                          <i class="mdi mdi-check-circle"></i>
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                          <h5>HSBC</h5>
                                          <p>John jakson</p>
                                          <p>10/24</p>
                                        </div>
                                      </div>
                                      <div class="col-md-4 col-sm-4 text-right">
                                        <img src="{{asset('client/images/visa.png')}}">
                                        <p class="pt-3"><a class="text-danger" href="" data-toggle="modal" data-target="#edit_card">Edit </a> <span class="line text-danger">|</span> <a href="" class="text-danger"> Delete</a></p>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 <div class="text-right">
                                    <button type="button" class="btn btn-danger btn-lg"  data-toggle="modal" data-target="#add_card"> Add New Card </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>


      <!-- Modal -->
      <div class="add_address">
         <div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title text-danger" id="exampleModalLabel"> Add New Card </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
                <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong id="card_success-message">error message</strong>
                </div>
                <div class="alert alert-danger alert-block modal-error-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="card_error-message"></strong>
                </div>
               <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="{{asset('client/images/add_card.png')}}">
                  </div>
                  <div class="col-md-6">
                    <form method="POST" class="pt-4" id="addcardform" >
                      @csrf
                      <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cardholder's name <span class="required">*</span></label>
                                <input class="form-control border-form-control" name="name" id="cardholder_name"  placeholder="John Jakson" type="text">
                            </div>
                         </div>
                      </div> 
                      <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Card Number <span class="required">*</span></label>
                                <input class="form-control border-form-control" name="number" id="card_number" placeholder="1587 8962 5845 7776" type="text" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  required>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Month <span class="required">*</span></label>
                                <select  class="select2 form-control border-form-control" name="expiration_month" id="expiration_month"  required>
                                   <option value="1">Jan</option>
                                   <option value="2">Feb</option>
                                   <option value="3">March</option>
                                   <option value="4">April</option>
                                   <option value="5">May</option>
                                   <option value="6">June</option>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Year <span class="required">*</span></label>
                                <select  class="select2 form-control border-form-control" name="expiration_year" id="expiration_year" required>
                                  @for($year = 2019; $year<=2050; $year++)
                                   <option value="{{$year}}">{{@$year}}</option>
                                  @endfor
                                </select>
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">CVV</label>
                                <input class="form-control border-form-control" maxlength="3" placeholder="678" name="cvv" type="text" id="security_code" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required>
                            </div>
                         </div>
                         <div  class="clearfix"></div>
                      </div>
                      <div class="pt-3">
                        <button type="submit" class="btn btn-danger">Save Card</button>
                        <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
               </div>
             </div>
           </div>
         </div>
      </div>

      <!-- Modal -->
      <div class="add_address">
         <div class="modal fade" id="edit_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title text-danger" id="exampleModalLabel"> Edit Card </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="{{asset('client/images/add_card.png')}}">
                  </div>
                  <div class="col-md-6">
                    <form method="POST" class="pt-4">
                      <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cardholder's name </label>
                                <input class="form-control border-form-control" placeholder="John Jakson" type="text">
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Card Number</label>
                                <input class="form-control border-form-control" placeholder="1587 8962 5845 7776" type="text">
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Month <span class="required">*</span></label>
                                <select  class="select2 form-control border-form-control">
                                   <option value="1">Jan</option>
                                   <option value="2">Feb</option>
                                   <option value="3">March</option>
                                   <option value="4">April</option>
                                   <option value="5">May</option>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Year <span class="required">*</span></label>
                                <select  class="select2 form-control border-form-control">
                                   <option value="1">2000</option>
                                   <option value="2">20001</option>
                                   <option value="3">2002</option>
                                </select>
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">CVV</label>
                                <input class="form-control border-form-control" placeholder="678" type="text">
                            </div>
                         </div>
                         <div  class="clearfix"></div>
                      </div>
                      <div class="pt-3">
                        <button type="button" class="btn btn-danger">Save Card</button>
                        <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
               </div>
             </div>
           </div>
         </div>
      </div>

@endsection

