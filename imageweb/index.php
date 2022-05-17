<?php 
//#####################################################
// CARLOS SANTOS DE AZEVEDO
// Software: Imagex - Website Image Upload & Managment 
// Website Images Managment without database
// CopyRight: Litos Media - Carlos Santos de Azevedo
// Contact: info@litos.top
// 10-2017
//#####################################################
include ("imagex_func.php");

if (isset($_POST['download_folder_token'])) {
if ($_POST['download_folder_token'] == $download_folder_token) {
ImageX_Download_Pasta($DIR_PRINCIPAL.$_POST['folder_name'], $DIR_PRINCIPAL.$_POST['folder_name'].'.zip');
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}		
}

if (isset($_POST['download_all_folder_token'])) {
if ($_POST['download_all_folder_token'] == $download_all_folder_token) {
ImageX_Download_Pasta($DIR_PRINCIPAL,  $DIR_PRINCIPAL.$_POST['folder_name'].'-'.time().'.zip');
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}		
}




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AHK WEB SOLUTIONS  IMAGE STOCK WEBSITE - Its Publically Available">
    <meta name="keywords" content="AHK WEB SOLUTIONS  IMAGE STOCK WEBSITE - Its Publically Availabl">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">

    <title>AHK WEB SOLUTIONS  IMAGE STOCK WEBSITE - Its Publically Available</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/imagex-notificacoes.css" />
    <link rel="stylesheet" href="assets/css/efeitos.css" />
    <link rel="stylesheet" href="assets/css/core.css?a=<?php echo time();?>" />
  </head>


		
 <div class="container-fluid" style="background-color: rgb(236, 240, 245);">
	<div class="row"  >
		 <div class="col-md-2 hidden-md hidden-xs hidden-sm" style="background: #70838c; height:100%; padding-bottom: 100%;"></div> <!--Left column for demo porposes-->
		
		
		<div class="col-lg-10 col-xs-12 col-sm-12 col-md-12"> <!--Right column-->
		
		<img src="https://sourcecodes.in.net/home/wp-content/uploads/2021/10/preloader.gif" class="top10">
	<div class="container-fluid">
	<h1>AHK WEB SOLUTIONS  IMAGE STOCK WEBSITE - All Images Will be  Publically Available</h1>
	<h6>Very simple to Upload Your Image >>  Select  A Category And Upload Your Image here And get ShareAble Link And More.. </h6>
		
		
	
 
		
		<p class="pull-right"><a href="/home/all-software/" target="_blank" ><small class="label">If You Need This Website Source Code Then  Click here</small></a> </p>
  </div>
   
    
    
    
    
<div class="col-xs-12 top30">
      
   

      
            
                  
 <!-- *********************
  IMAGEX
************************-->                              
<!--   Tabs   -->
  <ul class="nav nav-tabs">
      <li class="active"><a href="imagex.php" id="tab-upload-button"><i class="fa fa-cloud-upload"></i> <?php echo _('Upload');?></a></li>
		  <!--<li><a class="tab-not-active" show_all_folders_token="<?php echo $show_all_folders_token;?>"  href="#" id="tab-folder-button"><i class="fa fa-folder-open"></i> <?php echo _('Manage Categorys');?></a></li>-->
    </ul>
    <div class="tab-content" >
<!--  End Tabs   -->
    
		
 
<!--   UPLOAD   -->
<div class="box" id="upload-place" >
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-picture-o" ></i> <?php echo _('Image Upload');?> <small>- <?php echo _('Upload your images to your server and manage them from here without Database');?></small></h3>

		
		
<!-- PW -->	
<?php if($LOGIN_ACTIVE==1):?>
<button class="btn btn-default btn-xs bg-color-active pull-right" style="margin-top: -20px;" onClick="$('#reset_pw_form').fadeToggle();"><i class="fa fa-lock"></i> <?php echo _('Password reset');?></button>
<div class="clearfix"></div>		
<form action="imagex_ajax.php" method="post" class="pull-right col-md-3" id="reset_pw_form" style="display: none;">
<div class="input-group input-group-lg">   
<input type="password" name="imagex_new_pw" class="form-control">
<div class="input-group-btn">
<button type="submit" class="btn btn-default btn-lg bg-color-active"><i class="fa fa-floppy-o"></i></button>
</div>
</div>
<input type="hidden" name="reset_pw_token" value="<?php echo $reset_pw_token;?>">
</form>	
<?php endif;?>		
<!-- END PW -->		
		
		
		
		
    </div>
    <!-- /.box-header -->

    <div class="box-body">

        <div class="col-sm-6 bottom40">
            
               
               
             
<!--   Drop down --> 
<form action="imagex.php" method="post">
<div class="input-group input-group-lg top20">   
<select class="form-control col-sm-12"  id="selected_folder" name="selected_folder">
<?php echo imagex_show_dropdown_folders_list();?>
</select>
<div class="input-group-btn">
<button type="submit" class="btn btn-default btn-lg bg-color-active"><i class="fa fa-folder-open"></i></button>
</div>
</div>
<div class="clearfix"></div>
<hr>
 <!--   END Drop down -->
<input type="hidden" name="show_images_token" value="<?php echo $show_images_token;?>">
</form>   			            
               
 
               
               
       
        <div class="input-group input-group-lg">   
        <input type="text" name="s" id="s" class="form-control" placeholder="<?php echo _('Search');?>" <?php if (!isset($_POST['selected_folder'])) echo 'disabled="disabled"';?>>
		
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-lg bg-color-active"><i class="fa fa-search"></i></button>

                </div>
            </div>
        </div>

       
       
       
       <!--Upload-->
       
       <?php if(isset($_POST['selected_folder'])){?>
        <div class="col-sm-6 upload-container">
            <form method="post" id="ImageXupload" class="dropzone" action="imagex_ajax.php?selected_folder=<?php  echo @htmlspecialchars($_POST['selected_folder']);?>"   enctype="multipart/form-data">
				<input type="hidden" name="upload_images_token" value="<?php echo $upload_images_token;?>">
				<div class="dz-default dz-message "> <img src="assets/img/upload.png?a=1" class="img-responsive pull-center"><p><?php echo _('Drag and drop or click here to upload your  Jpg, Png or Gif Files. <br>You can upload multiple images at once.');?></p></div>
			</form>
        </div>
        <?php }else{?>
        <div class="col-sm-6 upload-container imagex-disabled">
            <form method="post" class="dropzone" action=""   enctype="multipart/form-data">
			<div class="dz-default dz-message "> <img src="assets/img/upload.png?a=1" class="img-responsive pull-center"><p style="color:red;"><?php echo _('For Upload File Please Select Category First');?></p></div>
			</form>
        </div>
        
        <?php }?>
      <!-- Fim Upload-->
       
	      	 
       
       
        <div class="col-sm-12" id="imagex_list_container"></div>
 
 
   
   
   
    </div>
    <!-- end box body //-->
</div>
<!-- end box //-->
<!--   END UPLOAD   -->      
             
            
            
                        

	
	
            
            
<!--   Folders   -->          
<div class="box" id="folders-place" style="display: none">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-folder-open" ></i> <?php echo _('Manage the upload Categorys');?> <small>- <?php echo _('Create or delete Categorys to upload images');?></small></h3>

    </div>
    <!-- /.box-header -->

    <div class="box-body">
<form method="post" action="imagex_ajax.php" id="create_new_folder" enctype="multipart/form-data">
           <div class="input-group input-group-lg col-lg-6 col-xs-12 col-sm-12 col-md-6">   
               
                <input type="text" name="new_folder_name" class="form-control" placeholder="<?php echo _('Type a name to create a new Category');?>">
                <input type="hidden" name="create_folder_token" value="<?php echo $create_folder_token;?>">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-lg bg-color-active"><i class="fa fa-plus"></i></button>

                </div>
			   
            </div>
</form>
		
		
<form action="imagex.php" method="post" class="pull-right">
<input type="hidden" name="folder_name" value="<?php echo $USER_TYPED_TOP_FOLDER_PATH;?>">
<input type="hidden" name="download_all_folder_token" value="<?php echo $download_all_folder_token;?>">
<button class="btn btn-default btn-lg bg-color-active"><i class="fa fa-cloud-download"></i> <?php echo _('Download all Folders with all images');?></button>
</form>
		


		<div id="list-folders-container" class="top50"></div>

    </div>
    <!-- end box body //-->
</div>
<!-- end box //--> 
<!--   END Folders   -->                
            
            
</div> <!-- END tab-content -->            
            
            
 <!-- *********************
  IMAGEX END 
************************-->         
            



 
            
            
    
		
		
		
		
		</div>
	</div>
</div>
 </div>	



  
 
 
 
 <style>
     .asid {
    position: fixed; 
    bottom: 0;
    left: 0;
    right: 0;
    height: 50px;
}
 </style>
 
<!-- Main Footer -->
<footer class="main-footer container asid">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        DEVELOPED BY : AHK WEB SOLUTIONS

    </div>
    <!-- Default to the left -->

      Image and Fotos Upload & Management Script

</footer>
 



<!-- REQUIRED JS SCRIPTS  IMAGEX-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/js/ajaxForm.js"></script>
<script src="assets/js/imagex-notificacoes.js"></script>

<?php if(isset($_POST['selected_folder'])){?>
<script>
$(document).ready(function () {
 selected_folder= "<?php echo htmlspecialchars($_POST['selected_folder']);?>";
 show_images_token= "<?php echo htmlspecialchars($_POST['show_images_token']);?>";
$('#imagex_list_container').load('imagex_ajax.php?selected_folder='+selected_folder+'&show_images_token='+ show_images_token);
}); 	
</script><?php } ?>
<script src="assets/js/imagex.js?a=<?php echo time();?>"></script>
<!-- REQUIRED JS SCRIPTS  IMAGEX END-->

</body>
</html>