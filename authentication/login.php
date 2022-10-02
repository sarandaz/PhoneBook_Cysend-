<form style="width: 22rem;" method="POST">
  <!-- Email input -->
  <div class="form-outline mb-4">
  <span id="username-info"></span><input name="username" id="username" class="form-control" />
    <label class="form-label" for="username">Username</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
  <span id="password-info"></span><input type="password" name="password" id="password" class="form-control" />
    <label class="form-label" for="password">Password</label>
  </div>
  <div class="errors"></div>
  <!-- Submit button -->
  <button type="button" onclick="ajaxLogin()" name="login" value="login" class="btn btn-primary btn-block mb-4">Sign in</button>
</form>

<script>

function ajaxLogin() {
	$(".error").text("");
	$('#email-info').removeClass("error");
	$('#password-info').removeClass("error");

	var username = $('#username').val();
	var password = $('#password').val();
	var actionString = 'login';

	if (username == "") {
		$('#username-info').addClass("error");
		$(".error").text("required");
	} else if (password == "") {
		$('#password-info').addClass("error");
		$(".error").text("required");
	} else {
		$.ajax({
			url : 'authentication/submit_login.php',
			type : 'POST',
			data : {
				username : username,
				password : password,
				action : actionString
			},
			success : function(response) {
        console.log(response);
        if(response !== "OK") {
          $('.errors').html('');
          $('.errors').append(response)
        } else {
          document.location.href="index.php";
        }
				// if (response.trim() == 'error') {
				// 	$('#login-success-message').hide();
				// 	$('#ajaxloader').hide();
				// 	$('#login-error-message').html(
				// 			"Invalid Attempt. Try Again.");
				// 	$('#login-error-message').show();
				// } else {
				// 	$('.demo-container').html(response);
				// 	//register_window.dialog("close");
				// 	$("#login-dialog").dialog("close");
				// }
			}
		});
		this.close();
	}// endif
}

</script>
