<!DOCTYPE html>
<html lang="en">
<?php require "head_content.inc"; ?>

	<body>
	
		<div id="login_form_container">
		<?php 
			if (isset($_SESSION['login_failure'])) {
				echo $_SESSION['login_failure'];
				unset($_SESSION['login_failure']);
			}
			
			if (isset($_SESSION['pwd_success'])) {
				echo $_SESSION['pwd_success'];
				unset($_SESSION['pwd_success']);
			}
		?>
			<h3>User Login</h3>
			
			<form action="login_validate.php" method="post">
				<p>Username:<span class="input-icon"><i class="fa fa-user fa"></i></span>
					<input class="login-input" id="uname" type="text" name="username"/>
					<br/><span class="form-error" id="erroruname"></span>
				</p>
				
				<p>Password:<span class="input-icon"><i class="fa fa-key fa"></i></span>
					<input class="login-input" id="pword" type="password" name="password"/>
					<br/><span class="form-error" id="errorpword"></span>
				</p>
				
				<p><input type="submit" id="loginbtn" name="login" value="Login"/></p>
			</form>
		</div>	
		
	</body>
	
</html>