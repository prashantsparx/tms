<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$pname=$_POST['packagename'];
$catid=$_POST['categoryid'];
$ptype=$_POST['packagetype'];	
$plocation=$_POST['packagelocation'];
$pprice=$_POST['packageprice'];	
$pfeatures=$_POST['packagefeatures'];
$pdetails=$_POST['packagedetails'];	
$pimage=$_FILES["packageimage"]["name"];
move_uploaded_file($_FILES["packageimage"]["tmp_name"],"pacakgeimages/".$_FILES["packageimage"]["name"]);
$sql="INSERT INTO tbltourpackages(PackageName,PackageType,PackageLocation,PackagePrice,PackageFetures,PackageDetails,PackageImage,categoryId) VALUES('$pname','$ptype','$plocation','$pprice','$pfeatures','$pdetails','$pimage','$catid')";
$mysqli->query($sql);
$lastInsertId = $mysqli->insert_id;
if($lastInsertId)
{

$file_array = reArrayFiles($_FILES['bannerImage']);
foreach($file_array as $item){
	$image_name=$item["name"];
	move_uploaded_file($item["tmp_name"],"pacakgeimages/".$item["name"]);
	$sql="INSERT INTO tblbannerimages(packageId,image) VALUES('$lastInsertId','$image_name')";
	$mysqli->query($sql);
}

$msg="Package Created Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

$query = $mysqli->query("select * from tblcategories");
$result_category = fetchResult($query);
$query->close();

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Package Creation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<script src="ckeditor/ckeditor.js"></script>
<!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- piexif.min.js is only needed for restoring exif data in resized images and when you 
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/locales/(lang).js"></script>

<script>
	$("#input-id").fileinput();
</script>

  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Update Package </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Create Package</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagename" id="packagename" placeholder="Create Package" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Select Category</label>
									<div class="col-sm-8">
										<select class="form-control1" name="categoryid" id="categoryid" required>
									<?php	foreach($result_category as $cat){ ?>
												<option value="<?= $cat["id"] ?>"><?= $cat["name"] ?></option>
									<?php	} ?>
										</select>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Type</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagetype" id="packagetype" placeholder=" Package Type eg- Family Package / Couple Package" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Location</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagelocation" id="packagelocation" placeholder=" Package Location" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Price in USD</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packageprice" id="packageprice" placeholder=" Package Price is USD" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Features</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="packagefeatures" id="packagefeatures" placeholder="Package Features Eg-free Pickup-drop facility" required>
									</div>
								</div>		


<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Details</label>
									<div class="col-sm-8">
										<textarea class="form-control ckeditor" rows="5" cols="50" name="packagedetails" id="packagedetails" placeholder="Package Details" required></textarea> 
									</div>
								</div>															
<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Package Image</label>
									<div class="col-sm-8">
										<input type="file" name="packageimage" id="packageimage" required>
									</div>
								</div>	

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Gallery Images <br>(1600px X 600px)</label>
									<div class="col-sm-8">
										<input id="input-id" name="bannerImage[]" type="file" class="file" data-preview-file-type="text" multiple required >
									</div>
								</div>

								

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Create</button>

				<button type="reset" class="btn-inverse btn">Reset</button>
			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } 
$mysqli->close();
?>