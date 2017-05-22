function lifeCounter(theaction){
	event.preventDefault();
	var login = $.confirm({
	    title: '<legend>Join Your Group!</legend>',
	    content: "<p>Already have a playgroup, then get the session id and password from a friend.</p>"
	    + "<p> These details can be found at the top of the page.</p>"	    
	    + "<p class='text-danger errortxt' style='display:none'></p>"
	    + "<label for='sesId' class='control-label'>Session Id:</label>"
	    + "<input id='sesId' type='number' min='1' class='form-control'>"
	    + "<p class='text-danger sessionIdtxt' style='display:none'></p><br> "
	    + "<label for='pass' class='control-label'> Password: </label>"
	    + "<input id='pass' type='password' class='form-control'>"
	    + "<p class='text-danger passtxt' style='display:none'></p>",
	    escapeKey: true,
	    backgroundDismiss: true,
	    useBootstrap: false,
	    closeIcon: true,
	    autoclose: false,
	    buttons: {
            Login: {
            	text: "Join Playgroup",
            	btnClass: "btn-warning jqueryconfirm",

            	action: function(){
	            	if(!checkFieldsLogin(this)){
	            		return false;
	            	}

	            	$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					
	            	var request = $.ajax({
	            		type: "POST",
	            		url: "checkSession",
	            		data: {
	            			id:this.$content.find('#sesId').val(), 
	            			pass: this.$content.find("#pass").val()
	            		}
	            	})
	            	
	            	request.done(function (data){
	            			if(data == 'incorrect'){
	            				var newIn = login;
	            				newIn.onContentReady =  (function(){
	            					$('.errortxt').html('Your session ID and password are incorrect.Please check your details and try again.');
	            					$('.errortxt').append("<br>");
	            					$('.errortxt').append('If you don\'t have a session then please create a new playgroup.').slideDown(100);
	            				});
	            				newIn.open();
	            			}else{
	            				window.location.href = data;
	            			}
	            		});
				}
            },
            Create: {
                text: 'Create a New Playgroup',
                btnClass: 'btn-warning jqueryconfirm',
                closeIcon: true,
                action: function () {
	                $.confirm({
					    title: '<legend>Create a session for you and your friends!</legend>',
					    content: "<label for='email' class='control-label'>Email:</label>"
					    + "<input id='email' name='email' type='email' class='form-control' regex=''/>"
					    + "<p class='text-danger emailtxt' style='display:none'></p><br>"
					    + "<label for='playerNum' class='control-label'>Number of Players:</label>"
					    + "<input id='playerNum' type='number' min='1' step='1' class='form-control'>"
					    + "<p class='text-danger playernumtxt' style='display:none'></p><br>"
					    + "<label for='newpass' class='control-label'>Password: (please note that this is needed to pass to people who wish to join the session)</label>"
					    + "<input id='newpass' type='password' class='form-control'>"
					    + "<p class='text-danger newpasstxt' style='display:none'></p>",
					    escapeKey: true,
					    backgroundDismiss: true,
					    useBootstrap: false,
					    closeIcon: true,
					    buttons: {
					    	Accept: {
						    	text: "Create",
				            	btnClass: "btn-warning jqueryconfirm",
				            	action: function(){
						    		if(!checkFieldsCreate(this)){
					            		return false;
					            	}

					            	$.ajaxSetup({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										}
									});
					            	$.ajax({
					            		type: "POST",
					            		url: "life",
					            		data: {
					            			email: this.$content.find("#email").val(),
					            			playerNum: this.$content.find("#playerNum").val(),
					            			pass: this.$content.find("#newpass").val()
					            		},
					            		success: function(data){
					            			window.location.href = data;
					            		}
					            	});
						    	}
						    }
					    }
					});
                }
            }
        },
	});
}

function checkFieldsLogin(obj){
	var err = false;

	// Check the session ID
	if(!checkNumber(obj, "sesId", "sessionIdtxt")){
		err = true;
	}

    if(!checkPassword(obj, "passtxt", "pass")){
    	err = true;
    }

    if(err){
    	return false;
    }
    return true;
}
function checkFieldsCreate(obj){
	var err = false;

	var str = obj.$content.find('#email');
	obj.$content.find('.emailtxt').html('').slideUp(100);
	// Check the email
	if(str.val().search(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/
		)){
		obj.$content.find('.emailtxt').html('Please enter a valid email!').slideDown(100);
		err = true;
	}

	// Check the playerNum
	if(!checkNumber(obj, "playerNum", "playernumtxt")){
		err = true;
	}

    if(!checkPassword(obj, "newpasstxt", "pass")){
    	err = true;
    }

    if(err){
    	return false;
    }
    return true;
}
function checkNumber(obj, numid, numtxt){
	var input = obj.$content.find('#' + numid);
    var errorText = obj.$content.find('.' + numtxt);
    errorText.html('').slideUp(100);

    if (input.val() == '') {
        errorText.html('Please don\'t keep the field empty!').slideDown(100);
       	return false;
    }else{
        if(!$.isNumeric(input.val())){
				errorText.html('Please enter a valid number!').slideDown(100);
           return false;
        }else{
        	if(!(input.val() > 0)){
        		errorText.html('Please enter a positive number!').slideDown(100);
            	return false;
        	}
        }
    }
    return true;
}
function checkPassword(obj, passtxt, passid){
	// Check password
    var input = obj.$content.find("#" + passid);
    var errorText = obj.$content.find('.' + passtxt);
	errorText.html('').slideUp(100);

     if (input.val() == '') {
        errorText.html('Please don\'t keep the password field empty!').slideDown(100);
        return false
    }

    return true;
}