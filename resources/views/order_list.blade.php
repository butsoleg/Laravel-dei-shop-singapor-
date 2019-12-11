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
                              @if(!empty(@$user->photo_url))
                                <img alt="profile" src="{{@$user->photo_url}}" class="previewSource">                             
                              @else
                                <img alt="profile" src="{{asset('client/images/user.jpg')}}" class="previewSource">
                                @endif
                                <div class="upload-btn-wrapper">
                                   <button class="upload_profile_btn"><i class="mdi mdi-camera"></i></button>
                                   <input type="file" name="myfile" class="previewImage">
                                </div>
                             </div>
                             <h5 class="mb-1 text-secondary"><strong>Hi </strong> {{ @$user->first_name}} {{ @$user->last_name}}</h5>
                             <p>{{ @$user->mobile}}</p>
                          </div>
                          <div class="list-group">
                              <a href="{{url('get_profile')}}" class="list-group-item list-group-item-action"><i class="fas fa-user"></i>  My Profile</a>
                              <a href="{{url('/change_password')}}" class="list-group-item list-group-item-action"><i class="fas fa-lock"></i>  Change Password</a>
                              <a href="{{url('/my_address') }}" class="list-group-item list-group-item-action"><i class="fas fa-map-marker-alt"></i>  My Address</a>
                              <a href="{{url('/saved_cards') }}" class="list-group-item list-group-item-action"><i class="fas fa-credit-card"></i>  My Saved Cards </a>
                              <a href="{{url('/order_list') }}" class="list-group-item list-group-item-action active"><i class="fas fa-list"></i>  Order List</a> 
                              <a href="{{url ('/logout')}}" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i>  Logout</a> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                   Order List
                                 </h5>
                              </div>
                              
                              <div class="order-list-tabel-main table-responsive">
                                 <table class="datatabel table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th>Order No</th>
                                          <th>Delivery Date-Delivery Time</th>
                                          <th>Status</th>
                                          <th>Order Date</th>
                                          <th>Total</th>
                                          <th></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($orders as $order)
                                       <tr>
                                          <td><b>#{{ $order->card->order_id}}</b></td>
                                          <td width="100px">{{ $order->delivery_date}}</td>
                                          <td width="140px"><span class="badge badge-danger">{{ $order->order_status }}</span></td>
                                          <td>{{ $order->delivery_date}}</td>
                                          <td>{{ $order->total }}</td>
                                          <td width="100px"><a class="actions">More Details</a></td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection
