 <!-- Modal -->
 <div id="map"></div>
      <div class="add_address">
         <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title text-danger" id="exampleModalLabel"> Add New Address </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong id="add_success-message">error message</strong>
                </div>
                <div class="alert alert-danger alert-block modal-error-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="add_error-message"></strong>
                </div>
                 <form method="POST" id="createaddressform">

                    @csrf
                    <!-- <input type="hidden" name="profile_name" value="home" id="edit_profilename"> -->
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Choose nick name for this address <span class="required">*</span></label>
                              <p>
                                 <span class="nick_name selected_name close-input"  data-value="home">Home</span>
                                 <span class="nick_name close-input" data-value="work" >Work</span>
                                 <span class="nick_name" data-value="other" id="nick_name">Other</span>
                              </p>
                          </div>
                          <div class="form-group" id="Other_nickname" style="display: none; position: absolute;top: 0;right: 15px;width: 150px;">
                                  <label class="control-label" >Other nickname<span class="required">*</span></label>
                                  <input class="form-control border-form-control"  name="profile_name" id="edit_profilename" type="text" onclick="$(this).val('');">
                                  <div><span id="add_firstname-error" class="error"></span></div>
                          </div>
                       </div>
                       <div class="col-md-8">
                         
                       </div>
                       
                       <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">First Name <span class="required">*</span></label>
                              <input class="form-control border-form-control" name="firstname" id="add_firstname" placeholder="John" type="text">
                              <div><span id="add_firstname-error" class="error"></span></div>
                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Last Name <span class="required">*</span></label>
                              <input class="form-control border-form-control" name="lastname" id="add_lastname"  placeholder="Jakson" type="text">
                              <div><span id="add_lastname-error" class="error"></span></div>
                          </div>
                       </div>

                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Phone Number <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="+65 20 3027 7900" type="text"  name="contact" id="add_contact"  maxlength="11">
                              <div><span id="add_contact-error" class="error"></span></div>       
                          </div>
                       </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Postal Code <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="35366" type="text" name="postal_code" id="add_postal_code" maxlength="7">
                              <div><span id="add_postal_code-error" class="error"></span></div>

                          </div>
                       </div>
                       
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                     

                        <div class="col-md-6" style="display: none;">
                          <div class="form-group">
                              <label class="control-label">Building Type <span class="required">*</span></label>
                                <select class="form-control border-form-control" name="building_type" id="add_building_type">
                                  <option value="HDB">HDB</option>
                                  <option value="Landed">Landed</option>
                                  <option value='Condo'>Condo</option>
                                </select>
                              <div><span id="add_building_type-error" class="error"></span></div>
                          </div>
                       </div> 

                       <!-- <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Condo Name</label>
                              <input class="form-control border-form-control" placeholder="120 Eunos Ave 7" type="text" name="building_name" id="add_building_name">
                              <div><span id="add_building_name-error" class="error"></span></div>
                          </div>
                       </div> -->
                      <div class="col-md-4" style="display: none;">
                          <div class="form-group">
                              <label class="control-label">Tower/Lobby Name </label>
                              <input class="form-control border-form-control" placeholder="Hougang" type="text" name="lobby_name" id="add_lobby_name">
                              <div><span id="add_lobby_name-error" class="error"></span></div>

                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group">
                              <label class="control-label">Street Address <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="John Jakson 180 B, 10th Block, 120 Eunos Ave 7, Richfield " type="text"  name="street1" id="add_street1" disabled>
                              <input type="hidden" name="street" id="add_street">
                              <div><span id="add_street-error" class="error"></span></div>

                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Floor No. </label>
                              <input class="form-control border-form-control" placeholder="180 B" type="text"  name="floor" id="add_floor" value="0">
                              <div><span id="add_floor-error" class="error"></span></div>

                          </div>
                       </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Unit No. <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="10th Block" type="text" name="unit" id="add_unit" value="0">
                              <div><span id="add_unit-error" class="error"></span></div>

                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                      
                       <!-- <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Address Line 2 </label>
                              <input class="form-control border-form-control" placeholder="120 Eunos Ave 7, Richfield, Singapore " type="hidden" value="" name="address-2" id="add_address-2">
                              <div><span id="add_address-2-error" class="error"></span></div>  
                          </div>
                       </div> -->
                        <input class="form-control border-form-control" placeholder="120 Eunos Ave 7, Richfield, Singapore " type="hidden" value="" name="address-2" id="add_address-2">
                        <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="hidden" name="city" id="add_city" required>
                        <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="hidden" name="state" id="add_state" required>
                         <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="hidden" name="country" id="add_country">
                     <!--  <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">City <span class="required">*</span></label>
                               <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="city" id="add_city" required>
                              <div><span id="add_city-error" class="error"></span></div> 
                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">State <span class="required">*</span></label>
                             <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="state" id="add_state" required>
                              <div><span id="add_state-error" class="error"></span></div>  

                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Country <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="country" id="add_country">
                              <div><span id="add_country-error" class="error"></span></div>
                          </div>
                       </div> -->
                      
                       <div  class="clearfix"></div>
                    </div> 
                    <div class="row">
                       <div class="col-md-12">
                          <div class="form-group">
                              <div class="address_checkbox">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_default" class="custom-control-input" id="customCheck1" >
                                    <label class="custom-control-label" for="customCheck1">Set this as my default delivery address </label> 
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Save Address</button>
                        <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
               </div>
             </div>
           </div>
         </div>
      </div>

      <!-- Modal --> 
      <div class="add_address">
         <div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title text-danger" id="exampleModalLabel"> Edit Address </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>

               <div class="modal-body">
                   <div class="alert alert-success alert-block modal-success-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong id="edit_success-message">error message</strong>
                </div>
                <div class="alert alert-danger alert-block modal-error-alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="edit_error-message"></strong>
                </div>
                 <form method="POST" id="editaddressform">

                    @csrf
                    <input type="hidden" name="profile_name" value="home" id="edit_profilename">
                    <input type="hidden" name="id" value="" id="edit_id">
                    <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Choose nick name for this address <span class="required">*</span></label>
                              <p>
                                 <span class="nick_name edit_nickname" data-value="home">Home</span>
                                 <span class="nick_name edit_nickname" data-value="work">Work</span>
                                 <span class="nick_name edit_nickname" data-value="other">Other</span>
                              </p>
                          </div>
                       </div>

                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">First Name <span class="required">*</span></label>
                              <input class="form-control border-form-control" name="firstname" id="edit_firstname" placeholder="John" type="text">
                              <div><span id="edit_firstname-error" class="error"></span></div>

                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Last Name <span class="required">*</span></label>
                              <input class="form-control border-form-control" name="lastname" id="edit_lastname"  placeholder="Jakson" type="text">
                              <div><span id="edit_lastname-error" class="error"></span></div>

                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Phone Number <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="+65 20 3027 7900" type="text"  name="contact" id="edit_contact">
                              <div><span id="edit_contact-error" class="error"></span></div>       



                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Building Type <span class="required">*</span></label>
                                <input class="form-control border-form-control" placeholder="Building Type" type="text"  name="building_type" id="edit_building_type">
                              <div><span id="edit_building_type-error" class="error"></span></div>
                          </div>
                       </div> 
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Condo Name</label>
                              <input class="form-control border-form-control" placeholder="120 Eunos Ave 7" type="text" name="building_name" id="edit_building_name">
                              <div><span id="edit_building_name-error" class="error"></span></div>

                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Tower/Lobby Name </label>
                              <input class="form-control border-form-control" placeholder="Hougang" type="text" name="lobby_name" id="edit_lobby_name">
                              <div><span id="edit_lobby_name-error" class="error"></span></div>

                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Street Address <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="John Jakson 180 B, 10th Block, 120 Eunos Ave 7, Richfield " type="text"  name="street" id="edit_street">
                              <div><span id="edit_street-error" class="error"></span></div>

                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Floor No. <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="180 B" type="text"  name="floor" id="edit_floor" value="0">
                              <div><span id="edit_floor-error" class="error"></span></div>

                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Unit No. <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="10th Block" type="text" name="unit" id="edit_unit" value="0">
                              <div><span id="edit_unit-error" class="error"></span></div>

                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Address Line 2 </label>
                              <input class="form-control border-form-control" placeholder="120 Eunos Ave 7, Richfield, Singapore " type="text" name="address-2" id="edit_address-2">
                              <div><span id="edit_address-2-error" class="error"></span></div>  
                          </div>
                       </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">City <span class="required">*</span></label>
                               <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="city" id="edit_city">
                              <div><span id="edit_city-error" class="error"></span></div> 
                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">State <span class="required">*</span></label>
                            <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="state" id="edit_state">
                            <div><span id="edit_state-error" class="error"></span></div>  
                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Country <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="Singapore"  value="Singapore" type="text" name="country" id="edit_country">
                              <div><span id="edit_country-error" class="error"></span></div>
                          </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">Postal Code <span class="required">*</span></label>
                              <input class="form-control border-form-control" placeholder="35366" type="text" name="postal_code" id="edit_postal_code">
                              <div><span id="edit_postal_code-error" class="error"></span></div>

                          </div>
                       </div>
                       <div  class="clearfix"></div>
                    </div> 
                    <div class="row">
                       <div class="col-md-12">
                          <div class="form-group">
                              <div class="address_checkbox">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_default" id="customCheck2" class="custom-control-input edit_is_default" >
                                    <label class="custom-control-label" for="customCheck2">Set this as my default delivery address </label> 
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Save Address</button>
                        <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
               
               </div>
            

             </div>
           </div>
         </div>
      </div>

<script type="text/javascript" language="javascript" src="http://www.streetdirectory.com/js/map_api/m.php"></script> 

<script type="text/javascript">
  var map, geocode, mm;

  function loadMap() {
        var opts = {
            zoom: 11,
            center: new GeoPoint(103.83050972046, 1.304787132947),
            enableDefaultLogo: false,
            showCopyright: false
        };  
        map = new SD.genmap.Map(
            document.getElementById('map'),
            opts
        );
        geocode = new SDGeocode(map);
    }
  function set_data(json) {
        if(mm != undefined) mm.clear();
        $("#add_street").val("");
        $("#add_lobby_name").val("");
        
        $("#add_building_name").val("");
        $("#add_street1").val("");
        if(json == null) return;
        if(json.length == 0) return;
  
        var no = 1;
        for (var i=0; i<json.length; i++) { 
             rec = json[i];
                mm = new SD.genmap.MarkerStaticManager({
                    map:map
                });         
                var geo = new GeoPoint(parseFloat(rec.x), parseFloat(rec.y));
                map.setCenter(geo, map.zoom);
                var marker = mm.add({
                    position: geo,
                    map: map,
                });             
                var full_address  = (rec.a == undefined) ? 'Null'      : rec.a;
                var title_name    = (rec.t == undefined) ? 'Null'      : rec.t;
                var Unit_no       = (rec.u_no == undefined) ? 'Null'   : rec.u_no;
                var block_no      = (rec.blk_no == undefined) ? 'Null' : rec.blk_no;
                var SD_address_id = (rec.aid == undefined) ? 'Null'    : rec.aid;
                var SD_place_ID   = (rec.pid == undefined) ? 'Null'    : rec.pid;
                var postal_code   = (rec.pc == undefined) ? 'Null'     : rec.pc;
                var data_type     = (rec.dt == undefined) ? 'Null'     : rec.dt;
                var place_name    = (rec.pcn == undefined) ? 'Null'    : rec.pcn;
                var street_name   = (rec.st_na == undefined) ? 'Null'  : rec.st_na;
                console.log(
                  "full_address :" + full_address + "\n",
                  "title_name :" + title_name + "\n",
                  "Unit_no :" + Unit_no + "\n",
                  "block_no :" + block_no + "\n",
                  "SD_address_id :" + SD_address_id + "\n",
                  "SD_place_ID :" + SD_place_ID + "\n",
                  "postal_code :" + postal_code + "\n",
                  "data_type :" + data_type + "\n",
                  "place_name :" + place_name + "\n",
                  "street_name :" + street_name + "\n", 
                  );

                $("#add_street").val(full_address);
                $("#add_lobby_name").val(title_name);
                
                $("#add_building_name").val(block_no);
                $("#add_street1").val(full_address);

                //768076
                no++;           
        }

    }
  function search(keyword) {
        gc = SDGeocode.SG;
        var searchOption = {
            "q": keyword, 
            "limit": 20,
            "d":1
        };
        geocode.requestData(gc, searchOption);
    }
    $(document).ready(function(){
        $('#add_postal_code').on('input',function(){
          if($(this).val().length >= 6){            
            search($(this).val()); 
            return false;
          }
        });
        loadMap();
        // $('#nickname').on("input",function(){
        //   $('#edit_profilename').val($(this).val());
        // });

        $("#nick_name").click(function(){
            $("#Other_nickname").fadeIn();
        });

        $(".close-input").click(function(){
            $("#Other_nickname").fadeOut();
        });
         
    });

</script>

