<?php 
include_once("include/config.php");

if(isset($_COOKIE['LOGIN_ATMOSPHERE']))
            header('Location: index.php');
else{
	
	if (isset($_GET['status'])){
		$Request=login($_POST['user'],$_POST['pass']);
        if($Request == "SUCCESS") header("location:index.php");
      }

	
	?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/signin.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>

<title>Atmosphere</title>
</head>

<body>


<div class="container">

      <form class="form-signin" method="post" action="login.php?status=1">
        <h2 class="form-signin-heading">Atmosphere Login</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input name="user" type="text" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Accedi</button>
         
      </form>
          <center><a href="recover.php">Hai dimenticato la password?</a></center><br>
     <center> <h2>oppure</h2><br>
       <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">Registrati</button></center>
      
       </div> <!-- /container -->
        
		<?php if(isset($_GET['status'])){ 
	  if($Request == "NOT_ACTIVATED") echo "<center><h1>L' account non è attivo, controlla la casella email.<h1></center>";
	  else echo "<center><h1>username e/o password sbagliati<h1></center>";
	  }
	  ?>
       
       <br><br><br>
       
  
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#9a9a9a;font-family:Mailpile-Normal;">Registrazione</h4>
            </div>
            <div class="modal-body" style="text-align:left;">
                <form role="form" id="signup" action="registrazione.php" method="post">
                    <div class ="form-group">
                        <p class="text-muted"></p>
                        <div class="right-inner-addon ">
                          <button style="display:none" class="success btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                          <button style="display:none" class="fail btn btn-warning"><span class="glyphicon glyphicon-flash"></span></button>
                          <input size="35" id="user_name" name="user[username]" type="text" class="form-control"placeholder="username" />
                        </div>
                    </div>
                    
                    <div class ="form-group">
                        <p class="text-muted"></p>
                        <div class="right-inner-addon ">
                            <button style="display:none" class="success btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                            <button style="display:none" class="fail btn btn-warning"><span class="glyphicon glyphicon-flash"></span></button>
                            <input size="35" id="user_email" name="user[email]" type="email" class="form-control"placeholder="email" />
                          </div>
                      </div>
  
                      <div class ="form-group">
                          <p class="text-muted"></p>
                          <div class="right-inner-addon ">
                              <button style="display:none" class="success btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                              <button style="display:none" class="fail btn btn-warning"><span class="glyphicon glyphicon-flash"></span></button>
                             <input size="35" id="user_password" name="user[password]" type="password" class="form-control"placeholder="password" />
                          </div>
                      </div>

                      <div class ="form-group">
                          <p class="text-muted"></p>
                          <div class="right-inner-addon ">
                              <button style="display:none" class="success btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                              <button style="display:none" class="fail btn btn-warning"><span class="glyphicon glyphicon-flash"></span></button>        
                              <input size="35" id="user_password_confirmation" name="user[password_confirmation]" type="password" class="form-control"placeholder="conferma password" />
                            </div>
                      </div>
                      
                      <div class ="form-group">
                        <p class="text-muted"></p>
                        <div class="right-inner-addon ">
                            <button style="display:none" class="success btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                            <button style="display:none" class="fail btn btn-warning"><span class="glyphicon glyphicon-flash"></span></button>
                            <input size="35" id="user_mac" name="user[mac]" type="text" class="form-control"placeholder="MAC del tuo Atmosphere" />
                          </div>
                      </div>
                      <button class="btn btn-success btn-lg">Registrati</button>
                  </form>
                </div><!--end of modal body-->
            </div><!--end of modal content-->
        </div><!--end of model dialog-->
    </div><!--end of moal-->
       
  
  <script type='text/javascript'>//<![CDATA[
$(window).load(function(){
$(function(){

    //add custom validator for jquery validator
    jQuery.validator.addMethod('passwordMatch', function(value, element) {
        
    // The two password inputs
   	var password = $("#user_password").val();
    var confirmPassword = $("#user_password_confirmation").val();
 
    // Check for equality with the password inputs
    if (password != confirmPassword ) {
    	return false;
    } else {
        return true;
    }
}, "Le password non corrispondono");


$("#signup").validate({

  errorClass:'error',  
  errorPlacement:function(error,element){
  	element.parent().prev().html(error);
  },
  
  success: function(label) {
    label.parent().next().find('button.success').show();
    label.parent().next().find('button.fail').hide();
    label.parent().html(get_string_from_for(label.attr('for')));
    console.log(label.parent().next());
  },
  
  highlight: function(element, errorClass) {
  	$(element).prev().show();
  },
  
  rules: {
    'user[username]': "required",
	'user[mac]': "required",
    'user[email]': "required",
    'user[password]': {
    	required:true,
    	minlength:9
    },
    'user[password_confirmation]': {
    	required:true,
    	passwordMatch:true
    }
   },
   messages:{
   		'user[username]':{
   			required:'campo obbligatorio'
   		},
		'user[mac]':{
   			required:'campo obbligatorio'
   		},
   		'user[email]':{
   			required:'campo obbligatorio',
   			email:'email non valida'
   		},
        'user[password]': {
   			required:'campo obbligatorio',
            minlength: "la password deve essere di almeno 9 caratteri"
        },
        'user[password_confirmation]': {
   			required:'campo obbligatorio',
            passwordMatch: "le password non corrispondono" // custom message for mismatched passwords
        }

   }
});//end of validate()

$('#user_name').on('change',function(){
  $('#signup').validate();
  console.log('here');
});

    
 function get_string_from_for(for_text){
 	switch(for_text) {
    case 'user_name':
        return '';
        break;
		case 'mac':
        return '';
        break;
    case 'user_email':
        return ''
        break;
    case 'user_password':
        return ''
        break;
    case 'user_password_confirmation':
        return '';
        break;
    default:
        return '';
	}
}

 });
});//]]> 

</script>

  
</body>

</html>

<?php } ?>






