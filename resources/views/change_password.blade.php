@extends('layouts.app')

@section('content')

      <section class="account-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-10 mx-auto">
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
                              <p>{{ @$userDetail['mobile']}}</p>
                           </div>
                           <div class="list-group">
                              <a href="{{ url('get_profile')}}" class="list-group-item list-group-item-action"><i class="fas fa-user"></i>  My Profile</a>
                              <a href="{{ url('/change_password')}}" class="list-group-item list-group-item-action active"><i class="fas fa-lock"></i>  Change Password</a>
                              <a href="{{ url('/my_address') }}" class="list-group-item list-group-item-action"><i class="fas fa-map-marker-alt"></i>  My Address</a>
                              <a href="{{ url('/saved_cards') }}" class="list-group-item list-group-item-action"><i class="fas fa-credit-card"></i>  My Saved Cards </a>
                              <a href="{{ url('/order_list') }}" class="list-group-item list-group-item-action"><i class="fas fa-list"></i>  Order List</a> 
                              <a href="{{url ('/logout')}}" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i>  Logout</a> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                   Change Password
                                 </h5>
                              </div>
                              <form id="updatepasswordform" method="POST" action="{{url('/change_password')}}">
                                 @csrf
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Old Password <span class="required">*</span></label>
                                          <input class="form-control border-form-control" id="current_password" name="current_password"  value="" placeholder="**********" type="password">
                                                   <div><span id="current_password-error" class="error"></span></div>
                                          
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">New Password <span class="required">*</span></label>
                                          <input class="form-control border-form-control" id="change_password" name="password" value="" placeholder="**********" type="password">
                                                   <div><span id="change_password-error" class="error"></span></div>

                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Confirm Password <span class="required">*</span></label>
                                          <input class="form-control border-form-control" id="change_passwordconfirm"  name="password_confirmation" value="" placeholder="**********" type="password" >
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row mt-4">
                                    <div class="col-sm-12 text-left">
                                       <button type="submit" class="btn btn-success btn-lg"> Change Password </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection
