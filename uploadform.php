
<div class="upload-form">

	<div class="heading">Upload Your File </div>

	<form method="POST" action="afterupload.php"  enctype="multipart/form-data">

		<label><span> Input method </span> : &nbsp; &nbsp; <input type="radio" name="input_method" value="file" onclick="fileinput()" checked >&nbsp; File &nbsp; <input type="radio" name="input_method" value="url" onclick="urlinput()" >&nbsp; Url &nbsp;
		<input type="radio" name="input_method" value="text" onclick="textinput()">&nbsp; Text &nbsp;</label><br>

		<label id="show-data"><span> Input File(Data Set) </span> : &nbsp; &nbsp; <input type="file" name="data" class="btn btn-default"></label>

		<label id="show-url" style="display:none"><span> Insert URL Link</span> : &nbsp; &nbsp;<input type="url" name="url" ></label>

		<label id="show-text" style="display:none"><span> Insert Input graph</span> : &nbsp; &nbsp;<textarea class="form-control" id="input_text" name="input_text" placeholder="Insert input graph" style="width: 100%;" rows="10"></textarea> <br>
			&nbsp; &nbsp; <input type="button" value="Example 1" style="width: 30%;" onclick="example1()" > &nbsp; &nbsp;
			<input type="button" value="Example 2" style="width: 30%;" onclick="example2()" > &nbsp; &nbsp;
			<input type="button" value="Example 3" style="width: 30%;" onclick="example3()" >
		</label>


		<label><span>Choose Clustering Algorithm </span> :   &nbsp; &nbsp;
								<select name="cprogram" required class="btn btn-success">
									<option value="">Choose one</option>
									<option value="1">spici 1</option>
									<option value="2">spici 2</option>
									<option value="3">spici 12</option>
									<option value="4">Cluster One</option>
									<option value="5">MGclus</option>
									<option value="6">WPNCA</option>
									<option value="7">spici</option>
							    </select></label><br>

		<label><span>Visualization Tool </span> : &nbsp; &nbsp;
								<select name="view" required class="btn btn-warning">
									<option value="">Choose one</option>
									<option value="alchemy">alchemy</option>
									<option value="vis">vis</option>
								</select></label><br>

		<label><span>&nbsp;</span>&nbsp; &nbsp; &nbsp; &nbsp;<input type="submit" class="btn btn-info" value="Submit" /></label>

	</form>

</div>
