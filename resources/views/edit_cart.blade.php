@extends('layouts.app')

@section('content')
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
         </div>
      </div>
   </div>
</section>
<section class="cart-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-body cart-table shop-detail-right">
                     <div class="table-responsive">
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product">Product</th>
                                 <th>Description</th>
                                 <th></th>
                                 <th>Unit price</th>
                                 <th>Qty</th>
                                 <th>Total</th>
                                 <th class="action"></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td class="cart_product"><a href="#"><img class="img-fluid" src="{{ asset('client/images/1.jpg') }}"  alt=""></a></td>
                                 <td class="cart_description">
                                    <h2>Haldiram's Gulab Jamun 1kg</h2>
                                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 1 kg</h6>
                                    <h6 class="fresh">Reliance Fresh</h6>
                                    <h6><strong> CODE : </strong> 562</h6>
                                 </td>
                                 <td class="availability in-stock">
                                    <div class="product_detail">
                                       <div class="form-group">
                                        <label>Weight:</label>
                                        <select class="form-control">
                                          <option>1 kg</option>
                                          <option>2 kg</option>
                                          <option>3 kg</option>
                                        </select>
                                       </div>
                                       <div>
                                        <label>Variants:</label>
                                        <select class="form-control">
                                          <option>10</option>
                                          <option>6</option>
                                          <option>5</option>
                                        </select>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="price"><span>S$49.88</span></td>
                                 <td class="qty">
                                   <div id="field1">
                                       <button type="button" id="sub" class="sub">-</button>
                                       <input type="text" id="1" value="1" min="1" max="3" />
                                       <button type="button" id="add" class="add">+</button>
                                   </div>
                                 </td>
                                 <td class="price color_red"><span>$49.88</span></td>
                                 <td class="action">
                                    <a class="" data-original-title="Delete" href="#" title="" data-placement="top" data-toggle="tooltip"><img src="{{ asset('client/images/bin.png') }}"> </a>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="cart_product"><a href="#"><img class="img-fluid" src="{{ asset('client/images/2.jpg') }}"  alt=""></a></td>
                                 <td class="cart_description">
                                    <h2>Kueh Dahlia (Nutella)</h2>
                                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 1 kg</h6>
                                    <h6 class="fresh">Vegetable Vendors</h6>
                                    <h6><strong> CODE : </strong> 562</h6>
                                 </td>
                                 <td class="availability in-stock">
                                    <div class="product_detail">
                                       <div class="form-group">
                                        <label>Weight:</label>
                                        <select class="form-control">
                                          <option>1 kg</option>
                                          <option>2 kg</option>
                                          <option>3 kg</option>
                                        </select>
                                       </div>
                                       <div>
                                        <label>Variants:</label>
                                        <select class="form-control">
                                          <option>10</option>
                                          <option>6</option>
                                          <option>5</option>
                                        </select>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="price"><span>S$49.88</span></td>
                                 <td class="qty">
                                   <div id="field1">
                                       <button type="button" id="sub" class="sub">-</button>
                                       <input type="text" id="1" value="1" min="1" max="3" />
                                       <button type="button" id="add" class="add">+</button>
                                   </div>
                                 </td>
                                 <td class="price color_red"><span>$49.88</span></td>
                                 <td class="action">
                                    <a class="" data-original-title="Delete" href="#" title="" data-placement="top" data-toggle="tooltip"><img src="{{ asset('client/images/bin.png') }}"> </a>
                                 </td>
                              </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td class="text-right total_price" colspan="7"><strong>Total: <span class="text-danger">$337.88</span></strong></td>
                              </tr>
                              <tr>
                                 <td colspan="5">
                                    <form class="float-right">
                                       <p class="promo mb-0">Have a Promo Code</p>
                                       <div class="form-group">
                                          <div class="row no-gutters">
                                             <div class="col-md-9">
                                                <input type="text" placeholder="Enter discount code" class="form-control border-form-control form-control-sm">
                                             </div>
                                             <div class="col-md-3">
                                                <button class="btn btn-success float-left btn-sm" type="submit">Apply</button>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </td>
                                 <td colspan="2" class="text-right total_price" colspan="7"><strong>Discount:</strong> <span>$10.88</span>
                                    <p class="mb-0">20% OFF has been applied</p>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-right total_price" colspan="7"><strong>Shipping Fee:</strong> <span>$10.88</span></td>
                              </tr>
                              <tr>
                                 <td class="text-right total_price" colspan="7"><strong>Concierge Fee:</strong> <span>$00.00</span></td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
                  <div class="text-right">
                     <a href="#" class="btn btn-secondary btn-lg text-left"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>$1200.69</strong> <span class="mdi mdi-chevron-right"></span></span></a>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection
