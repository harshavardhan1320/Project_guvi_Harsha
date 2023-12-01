
$('document').ready(function() {

    /* handle form validation */
    $("#login-form").validate({
    rules:
    {
    password: {
    required: true
    },
    email: {
    required: true,
    email: true
    }
    },
    messages:
    {
    password:{
    required: "please provide a password",
    minlength: "password should at least have 8 characters"
    },
    email: "please enter a valid email address"
    },
    submitHandler: submitForm
    });
    /* handle form submit */
    function submitForm() {
    var data = $("#login-form").serialize();
    $.ajax({
    type : 'POST',
    url : 'php/login.php',
    data : data,
    beforeSend: function(){
    $("#error").fadeOut();
    $("#login_button").html('<span class="glyphicon glyphicon-transfer"></span>  Signing In ...');
    },
    success : function(response){
    if(response==2){
    $("#error").fadeIn(1000, function(){
    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>email or password does not exist.</div>');
    $("#login_button").html('<span class="glyphicon glyphicon-log-in"></span>   Sign In');
    });
    }
        else{
            
            $("#login_button").html(' Signing In ...');
    setTimeout(' window.location.href = "profile.html"; ',3000);
        }
    }
    });
    return false;
    }
    
    
    });
    
    
    