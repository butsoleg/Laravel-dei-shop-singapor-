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
                                       <button class="upload_profile_btn"><i class="fas fa-camera"></i></button>
                                       <input type="file" name="myfile" class="previewImage">
                                    </div>
                                 </div>
                                 <h5 class="mb-1 text-secondary"><strong>Hi </strong> {{ @$userDetail['first_name']}} {{ @$userDetail['last_name']}}</h5>
                                 <p>{{ @$userDetail['mobile']}}</p>
                              </div>
                              <div class="list-group">
                                 <a href="{{ url('get_profile')}}" class="list-group-item list-group-item-action active"><i class="fas fa-user"></i>  My Profile</a>
                                 <a href="{{ url('/change_password')}}" class="list-group-item list-group-item-action"><i class="fas fa-lock"></i>  Change Password</a>
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
                                       My Profile
                                    </h5>
                                 </div>
                              <form id="updateprofileform" method="POST">

                                 @csrf
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">First Name <span class="required">*</span></label>
                                          <input class="form-control border-form-control" id="update_firstname" name="first_name" value="{{ @$userDetail['first_name']}}" placeholder="John" type="text" required>
                                             <div><span id="update_firstname-error" class="error"></span></div>

                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Last Name <span class="required">*</span></label>
                                          <input class="form-control border-for{{ @$userDetail['last_name']}}" value="{{ @$userDetail['last_name']}}" placeholder="Jakson" name="last_name" id="update_lastname" type="text" required>
                                             <div><span id="update_lastname-error" class="error"></span></div>

                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                  <!--   <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Phone </label>
                                          <input class="form-control border-form-control" id="update_mobile" name="mobile" value="{{ @$userDetail['mobile']}}" placeholder="+65 20 3027 7900" type="number">
                                             <div><span id="update_mobile-error" class="error"></span></div>

                                       </div>
                                    </div> -->
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Email Address <span class="required">*</span></label>
                                          <input class="form-control border-form-control " id="update_email" value="{{ @$userDetail['email']}}" placeholder="johnjacksonn@gmail.com" name="email" type="email" readonly>
                                             <div><span id="update_email-error" class="error"></span></div>

                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Date of Birth </label>
                                          <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                              <input class="form-control" name="birthday" value="@if(!empty($userDetail['birthday'])){{ date('Y-m-d', strtotime(@$userDetail['birthday'] ))}} @endif" type="text" readonly />
                                              <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                                             <div><span id="update_birthday-error" class="error"></span></div>

                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Gender</label>
                                          <select  class="select2 form-control border-form-control" name="gender" id="update_gender">
                                             <option value="">Select Gender</option>
                                             <option value="male" {{ ($userDetail['gender'] == 'male')?'selected' :'' }}>Male</option>
                                             <option value="female" {{ ($userDetail['gender'] == 'female')?'selected' :'' }}>Female</option>
                                          </select>
                                           <div><span id="update_gender-error" class="error"></span></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row mt-4">
                                    <div class="col-sm-12 text-right">
                                       <button type="button" class="btn btn-danger btn-lg"> Cancel </button>
                                       <button type="submit" class="btn btn-success btn-lg"> Save Changes </button>
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
