<!doctype html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>jQuery Image Crop - w3bees.com</title>
	<link rel="stylesheet" type="text/css" href="css/imgareaselect-animated.css" />
	 
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script> 
	 
	<script type="text/javascript">
		$( document ).ready(function() {
			$('#uploadbtn').on("click",function() {

				$('#myForm').ajaxForm({

								success : function(response){
										//$("#uploadPreview").hide();
										if(response == 0)
										{
											alert('file is too small or large');
										}
										else if(response == 1)
										{
											alert('Jpeg , Jpg , Png format are allowed');
										}
										else if(response == 2)
										{
											alert('file not set');
										}
										else 
										{
											$("#response").html('');
											$("#response").html(response);
										}
											
										$('#uploadImage').val('');	 
									},	
								error: function(){
										alert("Error ! Please try again");
										$('#uploadImage').val('');
									},
								beforeSend: function(){
									$('<div class="overlaydiv"><img src="images/ajax-loader.gif" width="10%" alt=""></div>').prependTo('body');
										  
									},
								complete: function(){
										$('.overlaydiv').hide();
										$('#uploadImage').val('');
										document.getElementById("uploadPreview").src = "";
										$('.wrap').nextAll('div').hide();


										//$('#myForm').attr('action', 'test.php');
									}
						});
						 
			}); 
		}); 
	</script>
	<style>
	a, a h1{
		font-family: Georgia, "Times New Roman", Times, serif;
		font-size: 1.2em;
		color: #645348;
		font-style: italic;
		text-decoration: none;
		font-weight: 100;
		padding: 10px;
	}
	body{
		font: 12px Arial,Tahoma,Helvetica,FreeSans,sans-serif;
		text-transform: inherit;
		color: #582A00;
		background: #E7EDEE;
		width: 100%;
		margin: 0;
		padding: 0;
	}
	.wrap{
		 
		margin: 10px auto;
		padding: 10px 15px;
		background: white;
		border: 2px solid #DBDBDB;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		text-align: center;
		overflow: hidden;
	}
	img#uploadPreview{
		border: 0;
		border-radius: 3px;
		-webkit-box-shadow: 0px 2px 7px 0px rgba(0, 0, 0, .27);
		box-shadow: 0px 2px 7px 0px rgba(0, 0, 0, .27);
		margin-bottom: 30px;
		overflow: hidden;
	}
	input[type="submit"]{
		border-radius: 10px;
		background-color: #61B3DE;
		border: 0;
		color: white;
		font-weight: bold;
		font-style: italic;
		padding: 6px 15px 5px;
		cursor: pointer;
	}
	.overlaydiv {
    background-color: #fff;
    height: 100%;
    left: 0;
    opacity: 0.9;
    padding-top: 100px;
    position: fixed;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 105;
	
	}
	</style>
</head>
<body>
<div class="wrap">
	<form id="myForm" action="upload.php" method="post" enctype="multipart/form-data">  
	<!-- image preview area-->
	<img id="uploadPreview" style="display:none;"/>

	<div id="response"> </div>  
 
	
	<!-- image uploading form -->
	
		<input id="uploadImage" type="file" accept="image/jpeg" name="image" />
		<input type="submit" id="uploadbtn" value="Upload">

		<!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />

		<br><br>
		Height : <input type="textbox" id="textheight" value="" style="width:40px">&nbsp;px

		<br><br>
		Width :  <input type="textbox" id="textwidth" value=""  style="width:40px">&nbsp;px

	</form>
	 
</div><!--wrap-->
</body>
</html>