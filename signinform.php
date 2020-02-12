<?php include_once("header.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			
			<div class="form-style-3 form-style-2">
				<form name="signinform" method="POST" action="aftersignin.php" >

					<fieldset><legend>Sign in</legend>

						<label for="field1"><span>User Name <span class="required">*</span></span><input type="text" name="username" class="input-field" required /></label>

						<label for="field2"><span>Password <span class="required">*</span></span><input type="password" name="password" class="input-field" required /></label>

						<small>&nbsp;</small><input type="submit" value="Sign in" class="btn btn-success" />
						<input type="hidden" name="nextpage" value="<?php echo isset($nextpage)?$nextpage:"";?>">

					</fieldset>

				</form>
			</div>


		</div>
	</div>
</div>

<?php include_once("footer.php"); ?>