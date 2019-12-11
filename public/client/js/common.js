$(document).ready(function() { 
	//show mobile dropdown
	if($(window).width() < 992) {
		$('footer span.title').on('click', function(e){
			e.preventDefault();
			$(this).parent().find('.mob-bottom').toggleClass('active');
		});
	}

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#forgotpasswordbtn').click(function(){
    	$('#forgot').show();
    	$('#loginformshow').hide();
    });    

    $('#logintab').click(function(){
    	$('#forgot').hide();
    	$('#loginformshow').show();
    });

    window.numberConverter=function(number){
    	// console.log('number======='+number);
        const formatter = new Intl.NumberFormat('en-US', {
              // style: 'currency',
              // currency: 'USD',
              minimumFractionDigits: 2
        });
        return formatter.format(number);
    }

    
});

function get_products(brand_ids, price_min, price_max,sort_by,category_ids){
			console.log('get_products');

	var csrf_token = $('meta[name=csrf-token]').attr('content');
	if(price_min != ''){
		price_min = parseInt(price_min);

	}if(price_max != ''){
		price_max = parseInt(price_max);
		
	}
	var routeName = $('#routeName').val();
	var search = $('.search_product').val();
	var id = $('#request_url').val();


	$.ajax({
		url: $('#base_url').val()+"/get_products",
		data: {brand_ids: brand_ids,price_min:price_min, price_max:price_max, sort_by:sort_by,category_ids:category_ids,search:search,routeName:routeName,id:id,_token: csrf_token},
		beforeSend: function() {
			$("#loading-image").show();
		},
		success: function (result) {
			console.log('success');
			$('.shop-info').html('showing '+ result.headers.total+' results');

			$('#product-data').html(result.html);
		
		},
		error: function(err){
		},

		complete: function() {
		$("#loading-image").hide();
		}
	});  
}
function get_data(){
			console.log('get_data');

	var brands =[];
	var categories =[];
	
	$('div.search_brand input[type="checkbox"]:checked').each(function(){
		if(jQuery.inArray($(this).val(),brands) === -1){
		    brands.push($(this).val());
		}
	});
	$('li a.list-group-item--last.selected').each(function(){
		if(jQuery.inArray($(this).attr('data-id'),categories) === -1){
		    categories.push($(this).attr('data-id'));
		}
	});
	var category_ids = categories.join();
	var sort_by = $('select.sortBy').val();

	var brand_ids = brands.join();
	var price_min = $('#price_min').val();
	var price_max = $('#price_max').val();
	get_products(brand_ids,price_min, price_max,sort_by,category_ids);

}
$(document).on('submit', '#registerform', function (e) {
	e.preventDefault();
	$.ajax({
	    type: 'post',
	    url: $('#base_url').val()+"/register",
        data: $('#registerform').serialize(),
        beforeSend: function() {
          $("#loading-image").show();
       },
	    success: function (result) {
	        $('#register_firstname').removeClass('form-control-danger');
			$('#first_name-error').html('');
	    	
	    	$('#register_lastname').removeClass('form-control-danger');
			$('#last_name-error').html('');
	    	
	    	$('#register_email').removeClass('form-control-danger');
			$('#email-error').html('');
	    	
	    	$('#register_password').removeClass('form-control-danger');
			$('#password-error').html('');
	    
	     	if(result.success == 400){
	     		if(result.user.validation){
	     			if(result.user.validation.first_name){
	     				$('#register_firstname').addClass('form-control-danger');
	     				$('#first_name-error').html(result.user.validation.first_name[0]);
	     			}
	     			if(result.user.validation.last_name){
	     				$('#register_lastname').addClass('form-control-danger');
	     				$('#last_name-error').html(result.user.validation.last_name[0]);
	     			}
	     			if(result.user.validation.email){
	     				$('#register_email').addClass('form-control-danger');
	     				$('#email-error').html(result.user.validation.email[0]);
	     			}
	     			if(result.user.validation.password){
	     				$('#register_password').addClass('form-control-danger');
	     				$('#password-error').html(result.user.validation.password[0]);
	     			}
	     		}
	     		else if(result.user.alert.message){
	     			$('#error-message').html(result.user.alert.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);
	     		}else
	     		{
	     			$('#error-message').html('Something went wrong, Please try again');

		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);
	     		}
	     	}else{
                setTimeout(function(){location.reload()} , 500); 



	     	}
	     
	    

	    },
	    error: function(err){
	    },
	    complete: function() {
          $("#loading-image").hide();
       }
	});  
});


$(document).on('submit', '#loginform', function (e) {
	e.preventDefault();
	$.ajax({
	    type: 'post',
	    url: $('#base_url').val()+"/login",
        data: $('#loginform').serialize(),
        beforeSend: function() {
          $("#loading-image").show();
       },

	    success: function (result) {
	    
			     	if(result.success == 400){
			     		if(result.user.validation){
			     			if(result.user.validation.email){
			     				$('#login_email').addClass('form-control-danger');
			     				$('#login_email-error').html(result.user.validation.email[0]);
			     			}
			     			if(result.user.validation.password){
			     				$('#login_password').addClass('form-control-danger');
			     				$('#login_password-error').html(result.user.validation.password[0]);
			     			}
			     	
			     		}
			     		else if(result.user.alert.message){
			     			$('#error-message').html(result.user.alert.message);
				     		$('.modal-error-alert').show();
				     		setTimeout(function(){ 
				     			$('.modal-error-alert').hide(); }, 3000);
			     		}else{
			     			$('#error-message').html('Something went wrong, Please try again');

			     			$('.modal-error-alert').show();
				     		setTimeout(function(){ 
				     			$('.modal-error-alert').hide(); }, 3000);
			     		}
			     	}else{
			     		$('#explore_data').html(result.html);
		 				$('#login_password').val('');
			     		$('#login_email').val('');
		                setTimeout(function(){location.reload()} , 500); 
		                
			     	}
	     
	    

	    },
	    error: function(err){
	    },
	    complete: function(){
          $("#loading-image").hide();

	    }
	});  
});

$(document).on('click', '#applypromocode', function (e) {
	e.preventDefault();	
	var cart_id = $('#promocodecartid').val();
	var promocode = $('#promocodevalue').val();
	if(promocode != ''){
		applyPromoCode(promocode,cart_id);
	}else{
		$('#promocodevalue').addClass('form-control-danger');
		$('#promocodevalue-error').html('Please enter a value');
	}  
});

$(document).on('click', '.cart_summary .delete_icon .fa-trash-alt', function (e) {
	e.preventDefault();	
	var cart_id = $('#promocodecartid').val();
	var promocode = '';
	applyPromoCode(promocode,cart_id);	
});

function applyPromoCode(promocode,cart_id){
	var csrf_token = $('meta[name=csrf-token]').attr('content');
	$.ajax({
	    type: 'post',
	    url: $('#base_url').val()+"/apply/promocode",
        data: { cart_id: cart_id, promocode:promocode,_token:csrf_token },
        beforeSend: function() {
          $("#loading-image").show();
       },

	    success: function (result) {	        
     		$('#promocodevalue-error').html('');	    	
	     	if(result.success == 400){
	     		if(result.promocode.error){			     		
     				$('#promocodevalue').addClass('form-control-danger');
     				$('#promocodevalue-error').html(result.promocode.error);
	     		}			     		
	     	}else{
	     		$('#promocodevalue').val('');
	     		$('#total').html('S$' +result.promocode.Cart.total);
	     		$('#final_total').html('S$' +result.promocode.Cart.total);
	     		$('.alert-success').show();
	     		var promotion = result.promocode.Cart.promotion;
	     		if(promotion != '' && typeof promotion.title != "undefined" && typeof promotion.description != "undefined"){
	     			$('#promocodesuccess-message').html(promotion.title+' - '+promotion.description);
	     		}else{
	     			$('.cart_summary .delete_icon').hide();
	     		}
	     	}
	    },
	    error: function(err){
	    },
	    complete: function(){
          $("#loading-image").hide();

	    }
	});
}

$(document).on('keyup', '.search-brand-text', function (e) {
	var val = $(this).val();
	val = val.toLowerCase();
	if(val != ''){
		$('.customScroll .search_brand').each(function(){
			var name = $(this).find('.custom-control-label').html();
			name = name.toLowerCase();
			if(name.indexOf(val) != -1){
				$(this).attr('style','display: block;');
			}else{
				$(this).attr('style','display: none;');
			}
		});
	}else{
		$('.customScroll .search_brand').each(function(){
			$(this).attr('style','display: block;');
		});
	}
});

$(document).on('submit', '#forgotpasswordform', function (e) {
		e.preventDefault();
		$.ajax({
		    type: 'post',
		    url: $('#base_url').val()+"/password/email",
	        data: $('#forgotpasswordform').serialize(),
	        beforeSend: function() {
              $("#loading-image").show();
           },

		    success: function (result) {
		    
		     	if(result.success == 300){
		     		if(result.user.validation){
		     			if(result.user.validation.email){
		     				$('#forgot_email').addClass('form-control-danger');
		     				$('#forgot_email-error').html(result.user.validation.email[0]);
		     			}
		     			
		     		}
		     		else if(result.user.alert.message){
		     			$('#error-message').html(result.user.alert.message);
			     		$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}else{
		     			$('#error-message').html('Something went wrong, Please try again');

		     			$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}
		     	}else if(result.success == 400){
		     		$('#error-message').html(result.user.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);

		     	}else{
		     		$('#success-message').html('Link has been sent to your mail');

		     		$('.modal-success-alert').show();
		     		setTimeout(function(){ 

	     			$('.modal-success-alert').hide(); }, 3000);

	 				$('#reset_email').val($('#forgot_email').val());
	 				$('#forgot_email').val('');
	 				$('#resetSection').show();
	 				$('#forgotSection').hide();

                	// setTimeout(function(){location.href="/home"} , 500); 
		     	
		     	}
		     
		    

		    },
		    error: function(err){
		    },
		    complete: function() {
              $("#loading-image").hide();
		        
		    }
		});  
	});
$(document).on('submit', '#resetpasswordform', function (e) {

		e.preventDefault();
		$.ajax({
		    type: 'post',
		    url: $('#base_url').val()+"/reset_password",
	        data: $('#resetpasswordform').serialize(),

		    success: function (result) {
		    
		     	if(result.success == 300){
		     		if(result.user.validation){
		     			if(result.user.validation.email){
		     				$('#reset_email').addClass('form-control-danger');
		     				$('#reset_email-error').html(result.user.validation.email[0]);
		     			}	
		     			if(result.user.validation.code){
		     				$('#reset_code').addClass('form-control-danger');
		     				$('#reset_code-error').html(result.user.validation.code[0]);
		     			}		
		     			if(result.user.validation.password){
		     				$('#reset_password').addClass('form-control-danger');
		     				$('#reset_password-error').html(result.user.validation.password[0]);
		     			}
		     		}
		     		else if(result.user.alert.message){
		     			$('#error-message').html(result.user.alert.message);
			     		$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}else{
		     			$('#error-message').html('Something went wrong, Please try again');

		     			$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}
		     	}else if(result.success == 400){
		     		('#error-message').html(result.user.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);

		     	}else{
		 			$('#reset_email').val('');
		     		$('#reset_code').val('');
		     		$('#reset_password').val('');
		     		$('#success-message').html('Password reset Successfully');
                	setTimeout(function(){location.reload()} , 500); 


		     		// $('.modal-success-alert').show();
		     		// setTimeout(function(){ 

		     		// 	$('.modal-success-alert').hide(); }, 3000);
		     	}
			     	
			     	
		     
		    

		    },
		    error: function(err){
		    }
		});  
	});

$(document).on('submit', '#updateprofileform', function (e) {
	e.preventDefault();
	$.ajax({
	    type: 'post',
	    url: $('#base_url').val()+"/update_profile",
        data: $('#updateprofileform').serialize(),
        beforeSend: function() {
          $("#loading-image").show();
       },
	    success: function (result) {
	    	$('#update_email').removeClass('form-control-danger');
				$('#update_email-error').html('');
				$('#update_firstname').removeClass('form-control-danger');
				$('#update_firstname-error').html('');
				$('#update_lastname').removeClass('form-control-danger');
				$('#update_lastname-error').html('');
	     	if(result.success == 300){
	     		if(result.user.validation){
	     			if(result.user.validation.email){
	     				$('#update_email').addClass('form-control-danger');
	     				$('#update_email-error').html(result.user.validation.email[0]);
	     			}
	     			if(result.user.validation.first_name){
	     				$('#update_firstname').addClass('form-control-danger');
	     				$('#update_firstname-error').html(result.user.validation.first_name[0]);
	     			}if(result.user.validation.last_name){
	     				$('#update_lastname').addClass('form-control-danger');
	     				$('#update_lastname-error').html(result.user.validation.last_name[0]);
	     			}

	     		}
	     		else if(result.user.alert.message){
	     			$('#error-message').html(result.user.alert.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);
	     		}else{
            		// setTimeout(function(){location.reload()} , 500); 

	     			$('#error-message').html('Something went wrong, Please try again');

	     			$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);
	     		}
	     	}else if(result.success == 400){
	     		('#error-message').html(result.user.message);
	     		$('.modal-error-alert').show();
	     		setTimeout(function(){ 
	     			$('.modal-error-alert').hide(); }, 3000);

	     	}else{
            		setTimeout(function(){location.reload()} , 500); 
           
	     		
	 			$('#reset_email').val('');
	     		$('#reset_code').val('');
	     		$('#reset_password').val('');
	     		$('#success-message').html('Profile updated Successfully');

	     	}
	    },
	    error: function(err){
	    },
	    complete: function() {
          $("#loading-image").hide();
       }
	});  
});
$(document).on('submit', '#updatepasswordform', function (e) {

		e.preventDefault();
		$.ajax({
		    type: 'post',
		    url: $('#base_url').val()+"/change_userpassword",
	        data: $('#updatepasswordform').serialize(),
			beforeSend: function() {
				$("#loading-image").show();
			},

		    success: function (result) {
		    	$('#current_password').removeClass('form-control-danger');
 				$('#current_password-error').html('');
 				$('#change_password').removeClass('form-control-danger');
 				$('#change_password-error').html('');
 			
		     	if(result.success == 300){
		     		if(result.user.validation){
		     			if(result.user.validation.current_password){
		     				$('#current_password').addClass('form-control-danger');
		     				$('#current_password-error').html(result.user.validation.current_password[0]);
		     			}if(result.user.validation.password){
		     				$('#change_password').addClass('form-control-danger');
		     				$('#change_password-error').html(result.user.validation.password[0]);
		     			}

		     		}
		     		else if(result.user.error){
		     			$('#image-errormsg').html(result.user.error);
			     		$('#image-error').show();
			     		setTimeout(function(){ 
			     			$('#image-error').hide(); }, 3000);
		     		}else if(result.user.alert.message){
		     			$('#image-errormsg').html(result.user.alert.message);
			     		$('#image-error').show();
			     		setTimeout(function(){ 
			     			$('#image-error').hide(); }, 3000);
		     		}else{
		     			$('#image-errormsg').html('Something went wrong, Please try again');

		     			$('#image-error').show();
			     		setTimeout(function(){ 
			     			$('#image-error').hide(); }, 3000);
		     		}
		     	}else if(result.success == 400){
		     		('#error-message').html(result.user.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);

		     	}else{
            		setTimeout(function(){location.reload()} , 500); 
		 		
		     	}
			     	
			     	
		     
		    

		    },
		    error: function(err){
		    },
		    complete: function(){
				$("#loading-image").hide();

			}
		});  
	});
$(document).on('submit', '#createaddressform', function (e) {

	
		var contact = $("#add_contact").val();
		var postal_code = $("#add_postal_code").val();
		if ( (!contact && !postal_code)  || ( (contact.length <= 5 || contact.length >= 12) || (postal_code.length <= 4 && postal_code.length >= 7) )){
			console.log('test');
			$('#add_contact').addClass('form-control-danger');
     		$('#add_contact-error').html("Minimum characters 6 maximum characters 11");
     		$("#add_postal_code").addClass('form-control-danger');
     		$('#add_postal_code-error').html("Minimum characters 5 maximum characters 7");
			return false;	
		}else if( (contact.length >= 5 && contact.length <= 12) && (postal_code.length >= 4 && postal_code.length <= 7) ){
			$('#add_contact').removeClass('form-control-danger');
     		$('#add_contact-error').html('');
     		$("#add_postal_code").removeClass('form-control-danger');
     		$('#add_postal_code-error').html('');
		}else if( (contact.length >= 5 && contact.length <= 12) && (postal_code.length <= 4 || postal_code.length >= 7) ){
			$("#add_postal_code").addClass('form-control-danger');
     		$('#add_postal_code-error').html("Minimum characters 5 maximum characters 7");
     		$('#add_contact').removeClass('form-control-danger');
     		$('#add_contact-error').html('');
     		return false;
		}else if( (contact.length <= 5 || contact.length >= 12) && (postal_code.length >= 4 && postal_code.length <= 7) ){
			$('#add_contact').addClass('form-control-danger');
     		$('#add_contact-error').html("Minimum characters 6 maximum characters 11");
     		$("#add_postal_code").removeClass('form-control-danger');
     		$('#add_postal_code-error').html('');
     		return false;
		}

		e.preventDefault();
		$.ajax({
		    type: 'post',
		    url: $('#base_url').val()+"/create_address",
	        data: $('#createaddressform').serialize(),
			beforeSend: function() {
				$("#loading-image").show();
			},

		    success: function (result) {
		    	$('#add_firstname').removeClass('form-control-danger');
 				$('#add_firstname-error').html('');
 				
 				$('#add_lastname').removeClass('form-control-danger');
 				$('#add_lastname-error').html('');
 				
 				$('#add_contact').removeClass('form-control-danger');
 				$('#add_contact-error').html('');
 				
 				$('#add_building_type').removeClass('form-control-danger');
 				$('#add_building_type-error').html('');

 				$('#add_lobby_name').removeClass('form-control-danger');
 				$('#add_lobby_name-error').html('');
 				
 				$('#add_street').removeClass('form-control-danger');
 				$('#add_street-error').html('');

 				$('#add_floor').removeClass('form-control-danger');
 				$('#add_floor-error').html('');
 				
 				$('#add_unit').removeClass('form-control-danger');
 				$('#add_unit-error').html('');	

 				$('#add_country').removeClass('form-control-danger');
 				$('#add_country-error').html('');
 				
 				$('#add_state').removeClass('form-control-danger');
 				$('#add_state-error').html('');

 				$('#add_city').removeClass('form-control-danger');
 				$('#add_city-error').html('');

 				$('#add_postal_code').removeClass('form-control-danger');
 				$('#add_postal_code-error').html('');
 			
		     	if(result.success == 300){
		     		if(result.user.validation){
		     			if(result.user.validation.firstname){
		     				$('#add_firstname').addClass('form-control-danger');
		     				$('#add_firstname-error').html(result.user.validation.firstname[0]);
		     			}
		     			if(result.user.validation.lastname){
		     				$('#add_lastname').addClass('form-control-danger');
		     				$('#add_lastname-error').html(result.user.validation.lastname[0]);
		     			}
		     			if(result.user.validation.contact){
		     				$('#add_contact').addClass('form-control-danger');
		     				$('#add_contact-error').html(result.user.validation.contact[0]);
		     			}
		     			if(result.user.validation.building_type){
		     				$('#add_building_type').addClass('form-control-danger');
		     				$('#add_building_type-error').html(result.user.validation.building_type[0]);
		     			}	
		     			if(result.user.validation.lobby_name){
		     				$('#add_lobby_name').addClass('form-control-danger');
		     				$('#add_lobby_name-error').html(result.user.validation.lobby_name[0]);
		     			}	
		     			if(result.user.validation.street){
		     				$('#add_street').addClass('form-control-danger');
		     				$('#add_street-error').html(result.user.validation.street[0]);
		     			}	
		     			if(result.user.validation.floor){
		     				$('#add_floor').addClass('form-control-danger');
		     				$('#add_floor-error').html(result.user.validation.floor[0]);
		     			}	
		     			if(result.user.validation.unit){
		     				$('#add_unit').addClass('form-control-danger');
		     				$('#add_unit-error').html(result.user.validation.unit[0]);
		     			}	
		     			if(result.user.validation.address){
		     				$('#address-2').addClass('form-control-danger');
		     				$('#add_address-2-error').html(result.user.validation.address[0]);
		     			}	
		     			if(result.user.validation.city){
		     				$('#add_city').addClass('form-control-danger');
		     				$('#add_city-error').html(result.user.validation.city[0]);
		     			}	
		     			if(result.user.validation.state){
		     				$('#add_state').addClass('form-control-danger');
		     				$('#add_state-error').html(result.user.validation.state[0]);
		     			}	
		     			if(result.user.validation.country){
		     				$('#add_country').addClass('form-control-danger');
		     				$('#add_country-error').html(result.user.validation.country[0]);
		     			}	
		     			if(result.user.validation.postal_code){
		     				$('#add_postal_code').addClass('form-control-danger');
		     				$('#add_postal_code-error').html(result.user.validation.postal_code[0]);
		     			}

		     		}
		     		else if(result.user.alert.message){
		     			$('#error-message').html(result.user.alert.message);
			     		$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}else{
		     			$('#error-message').html('Something went wrong, Please try again');

		     			$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}
		     	}else if(result.success == 400){
		     		('#error-message').html(result.user.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);

		     	}else{
		     		

		     	
		     		var last_segment = $('#request_url').val();
		     	
		     		if(last_segment == 'checkout'){
		     			$('#createaddressform input').each(function(){
		     			$(this).val('');
		     		});
		     			$('.nick_name').each(function(){
		     			$(this).removeClass('selected_name');
		     		});
		     			$("#createaddressform")[0].reset();
		     			$('.nick_name:first-child').addClass('selected_name');
		     			var building_name = '';
		     			var lobby_name = '';
		     			if(result.user.Address.building_name != '' && result.user.Address.building_name != null){

		     				var building_name = '<p>'+result.user.Address.building_name+' <br>';
		     			}if(result.user.Address.lobby_name != '' && result.user.Address.lobby_name != null){

		     				var lobby_name = '<p>'+result.user.Address.lobby_name+' <br>';
		     			}

		     			// $('#createaddressform').reset();
		     			$('#choose_address').html('<h3 class="capitalize">'+result.user.Address.profile_name+'</h3><p>'+result.user.Address.firstname+' '+result.user.Address.lastname+'<br><p>'+result.user.Address.street+' <br>'+building_name+''+lobby_name+'<p>'+result.user.Address.street+' <br>'+result.user.Address.city+' <br>'+ result.user.Address.state+' , '+  result.user.Address.postal_code +'<br>'+  result.user.Address.country+'</p><p class="addressName" style="display:none;">'+result.user.Address.firstname+' '+result.user.Address.lastname+'</p><input type="hidden" name="address_id" value="'+result.user.Address.id+'">');
		     			$('#address_btn').html('<button type="button" class="btn btn-lg" data-toggle="modal" id="change_address_modal"> Change Address </button>');
		     		

		     			$('#choose_card').find('.cardAddressname').html(result.user.Address.firstname+' '+result.user.Address.lastname);
		     			$('#add_address').modal('hide');
		     			$('#change_address').modal('hide');
		     		}else{
            		setTimeout(function(){location.reload()} , 500); 

		     		}
		     		
		 		
		     	}
		    },
		    error: function(err){
		    },
			complete: function(){
				$("#loading-image").hide();

			}
		});  
	});
$(document).on('submit', '#editaddressform', function (e) {

		e.preventDefault();
		$.ajax({
		    type: 'post',
		    url: $('#base_url').val()+"/update_address",
	        data: $('#editaddressform').serialize(),
			beforeSend: function() {
				$("#loading-image").show();
			},

		    success: function (result) {
		    	$('#edit_firstname').removeClass('form-control-danger');
 				$('#edit_firstname-error').html('');
 				
 				$('#edit_lastname').removeClass('form-control-danger');
 				$('#edit_lastname-error').html('');
 				
 				$('#edit_contact').removeClass('form-control-danger');
 				$('#edit_contact-error').html('');
 				
 				$('#edit_building_type').removeClass('form-control-danger');
 				$('#edit_building_type-error').html('');

 				$('#edit_lobby_name').removeClass('form-control-danger');
 				$('#edit_lobby_name-error').html('');
 				
 				$('#edit_street').removeClass('form-control-danger');
 				$('#edit_street-error').html('');

 				$('#edit_floor').removeClass('form-control-danger');
 				$('#edit_floor-error').html('');
 				
 				$('#edit_unit').removeClass('form-control-danger');
 				$('#edit_unit-error').html('');	

 				$('#edit_country').removeClass('form-control-danger');
 				$('#edit_country-error').html('');
 				
 				$('#edit_state').removeClass('form-control-danger');
 				$('#edit_state-error').html('');

 				$('#edit_city').removeClass('form-control-danger');
 				$('#edit_city-error').html('');

 				$('#edit_postal_code').removeClass('form-control-danger');
 				$('#edit_postal_code-error').html('');
 			
		     	if(result.success == 300){
		     		if(result.user.validation){
		     			if(result.user.validation.firstname){
		     				$('#edit_firstname').addClass('form-control-danger');
		     				$('#edit_firstname-error').html(result.user.validation.firstname[0]);
		     			}
		     			if(result.user.validation.lastname){
		     				$('#edit_lastname').addClass('form-control-danger');
		     				$('#edit_lastname-error').html(result.user.validation.lastname[0]);
		     			}
		     			if(result.user.validation.contact){
		     				$('#edit_contact').addClass('form-control-danger');
		     				$('#edit_contact-error').html(result.user.validation.contact[0]);
		     			}
		     			if(result.user.validation.building_type){
		     				$('#edit_building_type').addClass('form-control-danger');
		     				$('#edit_building_type-error').html(result.user.validation.building_type[0]);
		     			}	
		     			if(result.user.validation.lobby_name){
		     				$('#edit_lobby_name').addClass('form-control-danger');
		     				$('#edit_lobby_name-error').html(result.user.validation.lobby_name[0]);
		     			}	
		     			if(result.user.validation.street){
		     				$('#edit_street').addClass('form-control-danger');
		     				$('#edit_street-error').html(result.user.validation.street[0]);
		     			}	
		     			if(result.user.validation.floor){
		     				$('#edit_floor').addClass('form-control-danger');
		     				$('#edit_floor-error').html(result.user.validation.floor[0]);
		     			}	
		     			if(result.user.validation.unit){
		     				$('#edit_unit').addClass('form-control-danger');
		     				$('#edit_unit-error').html(result.user.validation.unit[0]);
		     			}	
		     			if(result.user.validation.address){
		     				$('#address-2').addClass('form-control-danger');
		     				$('#add_address-2-error').html(result.user.validation.address[0]);
		     			}	
		     			if(result.user.validation.city){
		     				$('#edit_city').addClass('form-control-danger');
		     				$('#edit_city-error').html(result.user.validation.city[0]);
		     			}	
		     			if(result.user.validation.state){
		     				$('#edit_state').addClass('form-control-danger');
		     				$('#edit_state-error').html(result.user.validation.state[0]);
		     			}	
		     			if(result.user.validation.country){
		     				$('#edit_country').addClass('form-control-danger');
		     				$('#edit_country-error').html(result.user.validation.country[0]);
		     			}	
		     			if(result.user.validation.postal_code){
		     				$('#edit_postal_code').addClass('form-control-danger');
		     				$('#edit_postal_code-error').html(result.user.validation.postal_code[0]);
		     			}

		     		}
		     		else if(result.user.alert.message){
		     			$('#edit_error-message').html(result.user.alert.message);
			     		$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}else{
		     			$('#edit_error-message').html('Something went wrong, Please try again');

		     			$('.modal-error-alert').show();
			     		setTimeout(function(){ 
			     			$('.modal-error-alert').hide(); }, 3000);
		     		}
		     	}else if(result.success == 400){
		     		('#edit_error-message').html(result.user.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);

		     	}else{
            		setTimeout(function(){location.reload()} , 500); 
		 		
		     	}
		    },
		    error: function(err){
		    },
			complete: function(){
				$("#loading-image").hide();

			}
		});  
	});
$(document).on('submit', '#checkoutForm', function (e) {

		e.preventDefault();
		$.ajax({
		    type: 'post',
		    url: $('#base_url').val()+"/checkout/run",
	        data: $('#checkoutForm').serialize(),
			beforeSend: function() {
				$("#loading-image").show();
			},

		    success: function (result) {

 			
		     	if(result.success == 300){
		     		 if(result.checkout.alert.message){
		     		 	$('#image-errormsg').html(result.checkout.alert.message);
			     		$('#image-error').show();
			     		setTimeout(function(){ 
			     			$('#image-error').hide(); }, 3000);
		     			
		     		}else{
		     			$('#image-errormsg').html('Something went wrong, Please try again');

		     			$('#image-error').show();
			     		setTimeout(function(){ 
			     			$('#image-error').hide(); }, 3000);
		     		}
		     	}else if(result.success == 400){
		     		('#edit_error-message').html(result.user.message);
		     		$('.modal-error-alert').show();
		     		setTimeout(function(){ 
		     			$('.modal-error-alert').hide(); }, 3000);

		     	}else{

            		setTimeout(function(){window.location.replace($('#base_url').val()+'/checkout/success')} , 500); 
		 		
		     	}
		    },
		    error: function(err){
		    },
			complete: function(){
				$("#loading-image").hide();

			}
		});  
	});

$(document).on('click', '.editAddressModal', function (e){
	var addressId = $(this).attr('data-addressId');
	$.ajax({
	    type: 'get',
	    url: $('#base_url').val()+"/edit_address/"+addressId,
	    // data: $('#createaddressform').serialize(),

	    success: function (result) {
	    	if(result.success == 200){
				$('.edit_nickname').each(function(){
					var value = $(this).attr('data-value');
					if(value == result.addressData.profile_name){
						$(this).addClass('selected_name');
						$('#edit_profilename').val(value);
					}
				});
				$('#edit_profilename').val(result.addressData.profile_name);

	    		$('#edit_id').val(result.addressData.id);
	    		$('#edit_firstname').val(result.addressData.firstname);
	    		$('#edit_lastname').val(result.addressData.lastname);
	    		$('#edit_contact').val(result.addressData.contact);
	    		$('#edit_building_type').val(result.addressData.building_type);
	    		$('#edit_building_name').val(result.addressData.building_name);
	    		$('#edit_lobby_name').val(result.addressData.lobby_name);
	    		$('#edit_street').val(result.addressData.street);
	    		$('#edit_floor').val(result.addressData.floor);
	    		$('#edit_unit').val(result.addressData.unit);
	    		$('#edit_address-2').val(result.addressData.address_2);
	    		$('#edit_city').val(result.addressData.city);
	    		$('#edit_state').val(result.addressData.state);
	    		$('#edit_postal_code').val(result.addressData.postal_code);
	    		if(result.addressData.is_default == '1'){
	    			$('.edit_is_default').attr('checked', true);

	    		}
                          $("#edit_address").modal('show');

	    	}else{
        		setTimeout(function(){location.reload()} , 500); 

	    	}


	    },
	    error: function(err){
	    }
	});


});

$(document).on('click', '#card_change_modal',function(){
	$.ajax({
	   
	   url: $('#base_url').val()+"/get_cards",
      data: {},
       beforeSend: function() {
          $("#loading-image").show();
       },
	   success: function (result) {
         if(result.success == 200){
         	$('#card_modal_div').html(result.html);
			$('#change_card').modal('show');

         }else{
         	$('#image-errormsg').html('Something went wrong, please try again');
     		$('#image-error').show();
     		setTimeout(function(){ 
     			$('#image-error').hide(); }, 3000);
         }
      },
	   error: function(err){
	   },
	   
	   complete: function() {
         $("#loading-image").hide();
      }
	});  

});
$(document).on('click', '#change_address_modal',function(){
	$.ajax({
	   
	   url: $('#base_url').val()+"/get_addresses",
      data: {},
       beforeSend: function() {
          $("#loading-image").show();
       },
	   success: function (result) {
         if(result.success == 200){
         	$('#address_modal_div').html(result.html);
			$('#change_address').modal('show');

         }else{
         	$('#image-errormsg').html('Something went wrong, please try again');
     		$('#image-error').show();
     		setTimeout(function(){ 
     			$('#image-error').hide(); }, 3000);
         }
      },
	   error: function(err){
	   },
	 
	   complete: function() {
         $("#loading-image").hide();
      }
	});  

});


$(document).on('submit', '#addcardform', function (e) {
		e.preventDefault();

	var expiration_month = $('#expiration_month').val();
	var expiration_year = $('#expiration_year').val();
	var name = $('#cardholder_name').val();
	var number = $('#card_number').val();
	var security_code = $('#security_code').val();
	var csrf_token = $('meta[name=csrf-token]').attr('content');
	var description = $('input[name=description]').val();

	




	if(expiration_month != '' && expiration_year != '' && name != '' && number != '' && security_code!= ''){
		Omise.setPublicKey("pkey_test_5g5dyttgllkyiho95ud");
		tokenParameters = {
			"city": "",
			"country": "",
			"expiration_month": expiration_month,
			"expiration_year": expiration_year,
			"name": name,
			"number": number,
			"phone_number": "",
			"postal_code": "",
			"security_code": security_code,
			"state": "",
			"street1": ""
		};

		Omise.createToken("card",
		tokenParameters,
		function(statusCode, response) {
			if(response.object == 'token'){

				var token = response.id;
				var card_token = response.card.id;
				var last4 = response.card.last_digits;
				var brand = response.card.brand;
				var country = response.card.country;
				
				

				if(token != '' && card_token != ''){
					$.ajax({
					    type: 'post',
					    url: $('#base_url').val()+"/create_card",
				        data: {token: token, card_token: card_token, brand: brand, country: country,exp_month:  expiration_month, exp_year:expiration_year,  last4: last4, _token : csrf_token, description: description},
						beforeSend: function() {
							$("#loading-image").show();
						},
					    success: function (result) {
					    	$('#cardholder_name').removeClass('form-control-danger');
			 				$('#cardholder_name-error').html('');
			 				$('#card_number').removeClass('form-control-danger');
			 				$('#security_code').removeClass('form-control-danger');
			 				$('#card_number-error').html('');
			 				$('#security_code-error').html('');
			 			
					     	if(result.success == 300){
					     		if(result.user.validation){
					     			if(result.user.validation.old_password){
					     				$('#change_oldpassword').addClass('form-control-danger');
					     				$('#change_oldpassword-error').html(result.user.validation.old_password[0]);
					     			}if(result.user.validation.password){
					     				$('#change_password').addClass('form-control-danger');
					     				$('#change_password-error').html(result.user.validation.password[0]);
					     			}

					     		}
					     		else if(result.user.alert.message){
					     			$('#card_error-message').html(result.user.alert.message);
						     		$('.modal-error-alert').show();
						     		setTimeout(function(){ 
						     			$('.modal-error-alert').hide(); }, 3000);

						  
					     		}else{
					     			$('#card_error-message').html('Something went wrong, Please try again');

					     			$('.modal-error-alert').show();
						     		setTimeout(function(){ 
						     			$('.modal-error-alert').hide(); }, 3000);
					     		}
					     	}else if(result.success == 400){
					     		('#card_error-message').html(result.user.message);
					     		$('.modal-error-alert').show();
					     		setTimeout(function(){ 
					     			$('.modal-error-alert').hide(); }, 3000);

					     	}else{
					     		var addressname = $('#choose_address').find('.addressName').html();
					     		var image_url = $('#image_url').val();
		     					var last_segment = $('#request_url').val();

								if(last_segment == 'checkout'){
		     			$("#addcardform")[0].reset();

									$('#choose_card').html(' <div class="row"><div class="col-md-12 col-sm-12 centerFlex"><div class="tick d-inline-block"><input type="hidden" name="card_id" value="'+result.user.Card.id+'"/><img src="'+image_url+'"></div><div class="card_deatil d-inline-block align-top"><h5>visa <span>**** **** **** '+result.user.Card.last4+'</span></h5><p class="cardAddressname">'+addressname+'</p><p>'+result.user.Card.exp_year+'/'+result.user.Card.exp_month+'</p></div></div><div class="clearfix"></div></div>');
								

									$('#card_btn').html('<button type="button" class="btn btn-lg" data-toggle="modal" id="card_change_modal"> Change Card </button>');
								
								$('#add_card').modal('hide');
								$('#change_card').modal('hide');
								}else{

								setTimeout(function(){location.reload()} , 500); 

								}
							}

					    },
					    error: function(err){
					    },
						complete: function() {
						$("#loading-image").hide();
						}
					});  
				}
			}else{
				console.log('else');
				$('#card_error-message').html(response.message);
				$('.modal-error-alert').show();
				setTimeout(function(){ 
				$('.modal-error-alert').hide(); }, 3000);
			}
		});
	}


		
	});

$(document).on('click', '.cart-product-row-item-add', function () {
	var cart_id = $(this).data('cartid');
	var cart_product_id = $(this).data('cartproductid');
	var product_id = $(this).data('productid');
	var product_options = $(this).data('productoptions');
	var amount = parseInt($('.cart-product-row-item-qty-'+cart_product_id).val())+1;

	var csrf_token = $('meta[name=csrf-token]').attr('content');

	$.ajax({
		type: 'post',
		url: $('#base_url').val()+"/cart/update",
		data: {cart_id: cart_id, cart_product_id: cart_product_id, product_id: product_id, amount: amount,product_options:  product_options, _token:csrf_token},
		beforeSend: function() {
			$(".cart-product-row-item-qty-"+cart_product_id).val(amount);
			$(".cart-product-cell-item-qty-"+cart_product_id).html(amount);
		},
		success: function (result) {
			if(result.success == 300){
				if(result.cart.validation){
					if(result.cart.validation.amount){
						showCartProductError(cart_product_id, result.cart.validation.amount[0]);
					}
				}
				else if(result.cart.alert.message){
					showCartProductError(cart_product_id, result.cart.alert.message);
				}else{
					showCartProductError(cart_product_id, 'Something went wrong, Please try again');
				}
			}else if(result.success == 400){
				showCartProductError(cart_product_id, result.cart.message);
			}else{
				removeCartProductError(cart_product_id);

				updateCartDetails(result.cart.Cart);
			}
		},
		error: function(err){
		},
		complete: function() {
		}
	});  
});
$(document).on('click', '.cart-product-row-item-sub', function () {
	var cart_id = $(this).data('cartid');
	var cart_product_id = $(this).data('cartproductid');
	var product_id = $(this).data('productid');
	var product_options = $(this).data('productoptions');
	var amount = parseInt($('.cart-product-row-item-qty-'+cart_product_id).val())-1;
	if (amount < 0) return;

	var csrf_token = $('meta[name=csrf-token]').attr('content');

	$.ajax({
		type: 'post',
		url: $('#base_url').val()+"/cart/update",
		data: {cart_id: cart_id, cart_product_id: cart_product_id, product_id: product_id, amount: amount,product_options:  product_options, _token:csrf_token},
		beforeSend: function() {
			$(".cart-product-row-item-qty-"+cart_product_id).val(amount);
			$(".cart-product-cell-item-qty-"+cart_product_id).html(amount);
		},
		success: function (result) {
			if(result.success == 300){
				if(result.cart.validation){
					if(result.cart.validation.amount){
						showCartProductError(cart_product_id, result.cart.validation.amount[0]);
					}
				}
				else if(result.cart.alert.message){
					showCartProductError(cart_product_id, result.cart.alert.message);
				}else{
					showCartProductError(cart_product_id, 'Something went wrong, Please try again');
				}
			}else if(result.success == 400){
				showCartProductError(cart_product_id, result.cart.message);
			}else{
				removeCartProductError(cart_product_id);
				if (amount == 0) {
					removeItemFromCart(cart_product_id, product_id);
				}

				updateCartDetails(result.cart.Cart);
			}
		},
		error: function(err){
		},
		complete: function() {
		}
	});  
});

$(document).on('click', '.cart-product-row-item-remove', function () {
		var cart_id = $(this).data('cartid');
		var cart_product_id = $(this).data('cartproductid');
		var product_id = $(this).data('productid');
	
		var csrf_token = $('meta[name=csrf-token]').attr('content');

	$.ajax({
			type: 'post',
			url: $('#base_url').val()+"/cart/delete",
			data: {cart_id: cart_id, cart_product_id: cart_product_id, _token:csrf_token},
			beforeSend: function() {
			},
			success: function (result) {
				if(result.success == 300){
					 if(result.cart.validation){
						 if(result.cart.validation.amount){
							 showCartProductError(cart_product_id, result.cart.validation.amount[0]);
						 }
					 }
					 else if(result.cart.alert.message){
						 showCartProductError(cart_product_id, result.cart.alert.message);
					 }else{
						 showCartProductError(cart_product_id, 'Something went wrong, Please try again');
					 }
				 }else if(result.success == 400){
					 showCartProductError(cart_product_id, result.cart.message);
				 }else{
					removeItemFromCart(cart_product_id, product_id);
					removeCartProductError(cart_product_id);
					updateCartDetails(result.cart.Cart);
				 }
			},
			error: function(err){
			},
			complete: function() {
			}
		});  
});


$(document).on('click', '.nick_name', function (e) {

	$('.nick_name').each(function(){
		$(this).removeClass('selected_name');
	});
	$(this).addClass('selected_name');
	$('input[name=profile_name]').val($(this).attr('data-value'));


});

$(document).on('click', '.search_btn', function (e) {
   e.preventDefault();
   console.log('clicked');
   $('#searchForm').submit();
});

$(document).on('click', '.address_div', function (e) {
	$('.address_div').each(function(){
		$(this).removeClass('selected_address');
	});
	$(this).addClass('selected_address');
	$('#choose_address').html($(this).find('.hiddenAddress').html());
	$('#choose_card').find('.cardAddressname').html($('#choose_address').find('.addressName').html());
	$('#change_address').modal('toggle');


});
$(document).on('click', '.card_div', function (e) {
	$('.card_div').each(function(){
		$(this).removeClass('selected_card');
	});
	$(this).addClass('selected_card');
	$('#choose_card').html($(this).find('.hiddenCard').html());
	$('#choose_card').find('.cardAddressname').html($('#choose_address').find('.addressName').html());
	$('#change_card').modal('toggle');

});

$(document).on('click', '.add_to_cart', function (e) {
   e.preventDefault();
	var csrf_token = $('meta[name=csrf-token]').attr('content');
	var form_data = $(this).closest('form').serialize();
	var productOptions = [];	
	var product_id = $(this).data('productid');
    var optionId;
    var variantsId;
    if( $(this).next('input').attr('data-value')){
        optionId= $(this).next('input').attr('data-value');
	}else if($(this).closest('form').find('option:selected', '.options-product').attr('data-value')){
        optionId= $(this).closest('form').find('.product_options option:selected', '.options-product').attr('data-value');
	}

    if(typeof optionId === "undefined" || optionId === null){
        optionId = '';
    }
    variantsId= $(this).closest('form').find('.variants option:selected', '.variants-options').attr('data-value');
    if(typeof variantsId === "undefined" || variantsId === null){
        variantsId = '';
    }


    if(optionId && variantsId){

        var key = optionId.toString();
        var obj = {};
        obj[key] = variantsId;
        productOptions.push(obj);

        productOptions = JSON.stringify(productOptions);
	}

	$.ajax({
	   type: 'post',
	   url: $('#base_url').val()+"/cart/add",
      data: {form_data: form_data,product_options:productOptions, _token : csrf_token},
	   success: function (result) {
         if (result.error !== undefined) {
            $('#card_error-message').html(result.error);
            $('.modal-error-alert').show();
            setTimeout(function(){ 
               $('.modal-error-alert').hide(); }, 3000);
		 }
		 else if (result.cart.Cart !== undefined) {
			updateCartDetails(result.cart.Cart);
			// Insert row on My Cart
			$('.cart-product-list').append(result.cart_row);
			// Switch current Add to - X + button
			$('.product-item-action-btn-'+product_id).append(result.add_btn);
			$('.add-to-cart-'+product_id).hide();
		 }
      },
	   error: function(err){
	   },
	   complete: function() {
         $("#loading-image").hide();
      }
	});  
});

function showCartProductError(cart_product_id, error_msg) {
	$('.cart-product-row-item-qty-'+cart_product_id).addClass('form-control-danger');
	$('.cart-product-row-item-qty-'+cart_product_id).html(error_msg);
}

function removeCartProductError(cart_product_id) {
	$('.cart-product-row-item-qty-'+cart_product_id).removeClass('form-control-danger');
	$('.cart-product-row-item-qty-'+cart_product_id).html("");
}

function updateCartDetails(cart) {
	// I have no cart here
	if (cart == 'undefined') {
		return;
	}

	updateCartItemsCount(cart); // Update the cart counts

	// Update all the amounts
	if (cart.total && cart.total_price && cart.delivery_fee && cart.concierge_fee) {
		$(".cart-total-price").html(numberConverter(cart.total_price));
		$(".cart-delivery-fee").html(cart.delivery_fee.display);
		$(".cart-concierge-fee").html(cart.concierge_fee.display);
		$(".cart-total").html(numberConverter(cart.total));
	}
}

function updateCartItemsCount(cart) {
	// I have no products in here or it is not array, nothing for me to do.
	if (cart == 'undefined' || cart.products == 'undefined' || !Array.isArray(cart.products)) {
		return;
	}

	var items_count = 0;
	cart.products.forEach(element => {
		items_count += element.quantity;
	});

	if (items_count > 1)
		$('.cart-items-count-plural').show();
	else
		$('.cart-items-count-plural').hide();
	
	$('.cart-items-count').html(items_count);

	return;
}

function removeItemFromCart(cart_product_id, product_id) {
	$('.cart-product-row-'+cart_product_id).fadeOut('fast');
	$('.added-to-cart-'+cart_product_id).remove();
	$('.add-to-cart-'+product_id).show();
}

$(document).on('click', '#doCheckout', function (e) {
   e.preventDefault();
	$(this).closest('form').submit();
});



$(document).on('click', 'span.clear_filters',function(){
	$('#price_min').val('');
	$('#price_max').val('');
	$('div.search_brand input[type="checkbox"]:checked').each(function(){
		$(this).prop('checked', false); 

	});
	$('li a.list-group-item--last.selected').each(function(){
		$(this).removeClass('selected');
	});
	if($('select.sortBy').length > 0){
	
    $('select.sortBy').val('').trigger('change');

		// $(".sortBy").select2({ placeholder: "Select SORT bY"});
		// $('.sortBy option:selected').removeAttr('selected');
	 // 	$(".sortBy").select2("val", "");
	}
	
	$('input[name=search]').val('');
	get_data();

});

var brands = [];

$(document).on('change', 'div.search_brand input[type="checkbox"]',function(){
console.log('data');
	
	get_data();
});
var categories = [];
$(document).on('click', 'li a.list-group-item--last',function(){

	if($(this).hasClass('selected') == true){
		$(this).removeClass('selected');
	}else{
		$(this).addClass('selected');
	}

	get_data();

});
$(document).on('change', 'select.sortBy',function(){
		get_data();
});

$(document).on('keyup', '#price_min, #price_max',function(){
	get_data();

});

// $(document).on('submit', '#searchForm', function (e) {
// 	console.log('submitted');
// 	e.preventDefault();
// 	get_data();

// });

