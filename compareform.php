
<div class="upload-form">

	<div class="heading">Upload Your File </div>

	<form method="POST" action="afterupload.php"  enctype="multipart/form-data">

		<label><span> Input method </span> : &nbsp; &nbsp; <input type="radio" name="input_method" value="file" onclick="fileinput()" checked >&nbsp; File &nbsp; <input type="radio" name="input_method" value="url" onclick="urlinput()" >&nbsp; Url </label><br>

		<label id="show-data"><span> Input File (Data Set) </span> : &nbsp; &nbsp; <input type="file" name="data" class="btn btn-default"></label>

		<label id="show-url" style="display:none"><span> Input for C program ( url )</span> : &nbsp; &nbsp;<input type="url" name="url" ></label>
		
		<label><span>&nbsp;</span>&nbsp; &nbsp; &nbsp; &nbsp;<input type="submit" class="btn btn-info" value="Submit" /></label>

	</form>

</div>
