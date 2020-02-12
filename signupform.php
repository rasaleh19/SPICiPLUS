<script type="text/javascript">
	function validatesignup(){
		var password=document.forms["signupform"]["password"].value;
		var retypepassword=document.forms["signupform"]["retypepassword"].value;
		if(password!=retypepassword){
			alert("password does not match");
			return false;
		}
	}
</script>

<?php include_once("header.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			
		<div class="form-style-3">
			<form name="signinform" method="POST" action="aftersignup.php" >

				<fieldset><legend>Sign up</legend>
					<label for="field4">
					<span>
					<?php
						if(isset($_GET["message"]))echo $_GET["message"];
					?>
					</span>
					</label><br>
					<label for="field1"><span>User Name <span class="required">*</span></span><input type="text" name="username" class="input-field" required /></label>
					
					<label for="field5"><span>Email <span class="required">*</span></span><input type="text" name="email" class="input-field" required /></label>

					<label for="field2"><span>Password <span class="required">*</span></span><input type="password" name="password" class="input-field" required /></label>

					<label for="field3"><span>Retype Password <span class="required">*</span></span><input type="password" name="retypepassword" class="input-field" required/></label>

					<small>&nbsp;</small><input type="submit" value="Sign up" class="btn btn-danger" />

				</fieldset>

			</form>
		</div>


		</div>
	</div>
</div>

<?php include_once("footer.php"); ?>
