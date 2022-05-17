<?php 
//#####################################################
// CARLOS SANTOS DE AZEVEDO
// Software: Imagex - Website Image Upload & Managment 
// Website Images Managment without database
// CopyRight: Litos Media - Carlos Santos de Azevedo
// Contact: info@litos.top
// 10-2017
//#####################################################
include_once ("imagex_func.php");
  
//######################################
// Mostrar imagens
//###################################### 
 

if(isset($_GET['show_images_token'])){
if( $_GET['show_images_token'] == $show_images_token){
$user_show_images_token= htmlspecialchars($_GET['show_images_token']);
if(isset( $_GET['s'])){$s= htmlspecialchars($_GET['s']);}else {$s="";}
 
 
 
 
/*============  Paginacao em cima ==============*/
$start=0;
$limit=18;
if(isset($_GET['pagina'])){$pagina=htmlspecialchars($_GET['pagina']);$start=($pagina-1)*$limit;}else{$pagina=1;}
/*============  Paginacao em cima ==============*/


 
	

$offset = (isset($start)) ? $start : 0;
$file =  preg_grep('~\.(jpeg|jpg|png|gif|JPG|JPEG|PNG|GIF)$~', scandir($IMAGEX_MEDIA_DIR,1));
$ficheiro_nr=0;
	
	
$num_results = 0;	
/*============  loop ==============*/
for ($i = $offset; $i < $offset+$limit; $i++) {

if(isset($file[$i])){$file_name= $file[$i];}else {$file_name= null;}

	
if (@ file_exists($IMAGEX_MEDIA_DIR.$file)) {$file_date= date('F d Y H:i:s',filemtime($IMAGEX_MEDIA_DIR.$file));}
	
	
 
	
/*============  content ==============*/
	
 
$img_preview = '<div class="gallery animated zoomInDown" style="animation-duration: 1.1s">
 				<figure class="item">
 				<div class="img-wrap" data-toggle="modal" data-target="#modal'.$i.'"><div  img_name="'.$file_name.'" class="imagemdiv" style="background: url('.$IMAGEX_MEDIA_URL.$file_name.'?t='.time().') center center; background-size: cover;height: 120px; width: 120px;"></div></div> 
 				</figure> 
  				</div>
				
				
 
<!-- Modal -->
<div id="modal'.$i.'"  class="modal fade modal-abrir-img" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
	  
         <img img_name_modal="'.$file_name.'" src=" '.$IMAGEX_MEDIA_URL.$file_name.'?t='.time().'" class="img-responsive">
			
      </div>
 
    </div>

  </div>
</div>
';

	
	
 

$del_link ='<div class="media-img-option">
        	<a href="#" id="'.$file_name.'" row="'.$i.'" delete_image_token="'.$delete_image_token.'" class="del-library-file btn btn-xs btn-default" data-toggle="confirm" data-title="'._("Delete this File?").'" data-btn-ok-label="'._("Yes").'" data-btn-cancel-label="'._("No!").'"><i class="fa fa-times"></i></a>
			</div>';
	
$download_link= '<div class="media-img-option2">
	    		<a href="'.$IMAGEX_MEDIA_URL.$file_name.'" class="btn btn-xs btn-default" title="'._("Download").'" download><i class="fa fa-cloud-download"></i></a>
     			</div>';
	
	
	
$link_open_in_new_tab ='<a href="'.$IMAGEX_MEDIA_URL.$file_name.'" class="btn btn-default  btn-xs" target="_new"><i class="fa fa-external-link"></i> '._('Open Image').'</a>';
	
	
$copy_link = '<div class="media-img-option3" data-toggle="modal" data-target="#mod_'.$i.'">  <a href="#" class="btn btn-xs btn-default" title="'._("File URL").'"><i class="fa fa-link"></i></a> </div>
			
     		

<!-- Modal -->
<div id="mod_'.$i.'" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
	  
        	<!-- Copy -->
			<!--Close button-->
	  		<span class="media-file-url-to-copy "> <span class="copy-close-buttom " data-dismiss="modal"><i class="fa fa-times"></i> </span>
	  		   
			<!--  File URL -->
			<div class="copy-button-container">
			<span class="copied">'._('Copied!').'</span> 
			<button class="btn btn-default  btn-xs copy-clip" data-clipboard-text="'.$IMAGEX_MEDIA_URL.$file_name.'"><i class="fa fa-clipboard"></i> '._('Copy').' </button> '.$link_open_in_new_tab.'
			</div>
	  		<code><div class="copy-link-title"><i class="fa fa-link copy-clip"></i> '._("File URL").'</div>  '.$IMAGEX_MEDIA_URL.$file_name.'</code>
			
			<hr>
			<!--  Image Html code -->
			<div class="copy-button-container">
			<span class="copied">'._('Copied!').'</span> 
			<button class="btn btn-default  btn-xs copy-clip" data-clipboard-text="&lt;img src=&quot;'.$IMAGEX_MEDIA_URL.$file_name.'&quot;&gt;"><i class="fa fa-clipboard"></i> '._('Copy').'</button>
			</div>
	  		<code>
			<div class="copy-img-html-title"><i class="fa fa-code color-skin-dark"></i> '._("Image Html code").'</div> &lt;img src="'.$IMAGEX_MEDIA_URL.$file_name.'"&gt;
			</code>	  
	  		</span>
			<!-- END Copy -->
			
			
      </div>
 
    </div>

  </div>
</div> ';
	
 
$rotate_links='<div class="media-img-left"><a href="#" class="rotate_left btn btn-default btn-xs bg-skin-dark" filename="'.$file_name.'" rotate_image_left_token="'.$rotate_image_left_token.'"><i class="fa fa-undo"></i></a></div>';
$rotate_rechts='<div class="media-img-right"><a href="#" class="rotate_right btn btn-default btn-xs bg-skin-dark" filename="'.$file_name.'"  rotate_image_right_token="'.$rotate_image_right_token.'"><i class="fa fa-repeat"></i></a></div>';
 
if($s)$procura= $file_name != "" && $s && strpos($file_name, $s); //With search
if(!$s)$procura= $file_name != "";//Without search
	
if ($procura):  
//output
	
if(!isset($file_list)){$file_list="";}
$file_list .='
<div id="row_'.$i.'"  class="media_file_container">

     <!-- Image -->
     '.$img_preview.'
	 <!-- Delete file -->
	 <!-- '.$del_link.' -->
     <!-- Download file -->
     '.$download_link.'
	 <!-- Copy link -->
	 '.$copy_link.'
	 
	 '.$rotate_links.$rotate_rechts.'
	 
</div>';
$num_results++;
endif;// END if ($procura)
	
 
/*============  End content ==============*/
	
 
 

}// ENd loop
 	
echo'<div class="imagen_redonda_container animated fadeIn">'. @ $file_list.'</div>';
echo '<script src="assets/js/bootstrap-confirmation.min.js"></script>';	
echo '<script src="assets/js/clipboard.min.js"></script>
   <script>
    var clipboard = new Clipboard(".copy-clip");

    clipboard.on("success", function(e) {
        console.log(e);
    });

    clipboard.on("error", function(e) {
        console.log(e);
    });
	 
	 /*Fazer o container deslizar para o tamahno do content*/
	var el = $("#imagex_list_container");
    curHeight = el.height();
    autoHeight = el.css("height", "auto").height();
el.height(curHeight).animate({height: autoHeight}, 600);
    </script>
 
';	
	 
 
/*============  Paginacao em baixo ==============*/
//contar os resultados da base de dados
$rows= count(scandir($IMAGEX_MEDIA_DIR))-2;
if($s){$rows= $num_results;}	
	
	
	
if($rows=='0') echo '<div  style="color:#BFBFBF; text-align:center"><h1><br>'._('No results found!').'</h1></div>';
$total=ceil($rows/$limit);//Calcular o numero de paginas
	
	
$selected_folder= htmlspecialchars($_GET['selected_folder']);	
 
	
echo'<div class="row"></div><br><ul class="paginacao">'; 
if($pagina>1){
	
echo '<li><a href="'.$_SERVER['PHP_SELF'].'?pagina='.($pagina-1).'&s='.$s.'&selected_folder='.$selected_folder.'&show_images_token='.$user_show_images_token.'">&laquo;</a></li>';} // recuar uma pagina

//Mostar as paginas todas.  
for($i=1;$i<=$total;$i++){
	
if($i==$pagina) { echo '<li><a href="'.$_SERVER['PHP_SELF'].'?pagina='.$pagina.'&s='.$s.'&selected_folder='.$selected_folder.'&show_images_token='.$user_show_images_token.'" class="active">'.$i.'</a></li>'; } /*pagina activa*/

else { echo '<li><a href="'.$_SERVER['PHP_SELF'].'?pagina='.$i.'&s='.$s.'&selected_folder='.$selected_folder.'&show_images_token='.$user_show_images_token.'">'.$i.'</a></li>';}
}

if($pagina!=$total){echo '<li><a href="'.$_SERVER['PHP_SELF'].'?pagina='.($pagina+1).'&s='.$s.'&selected_folder='.$selected_folder.'&show_images_token='.$user_show_images_token.'">&raquo;</a></li>';} // avancar uma pagina 
echo '</ul>';
/*============ FIM Paginacao em baixo ==============*/ 

}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
} 

 
// End get media list












 
//######################################
// Rodar imagem para a Esquerda
//######################################
 if (isset($_GET['rotate_image_left_token'])) {
 if ($_GET['rotate_image_left_token'] == $rotate_image_left_token) {
$imagex_imagem= new imagex_imagem();
$file_to_rotate= htmlspecialchars($IMAGEX_MEDIA_DIR.$_GET['filename']);
//rotate
$imagex_imagem->imagex_rotateImage($file_to_rotate,$file_to_rotate,90);
echo htmlspecialchars($IMAGEX_MEDIA_URL.$_GET['filename']);
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
}

//######################################
// Rodar imagem para a Direita
//######################################
 if (isset($_GET['rotate_image_right_token'])) {
 if ( $_GET['rotate_image_right_token'] == $rotate_image_right_token) {
$imagex_imagem= new imagex_imagem();
$file_to_rotate= htmlspecialchars($IMAGEX_MEDIA_DIR.$_GET['filename']);
//rotate
$imagex_imagem->imagex_rotateImage($file_to_rotate,$file_to_rotate,-90);
echo htmlspecialchars($IMAGEX_MEDIA_URL.$_GET['filename']);
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
}


//######################################
// Apagar Imagem
//###################################### 
 if (isset($_GET['delete_image_token'])) {
 if ($_GET['delete_image_token'] == $delete_image_token) {
    if (is_writable($IMAGEX_MEDIA_DIR.$_GET['file'])) {
        unlink($IMAGEX_MEDIA_DIR.$_GET['file']);
        die(_('File Sucessfully Deleted.'));
    } else {
        die('<i class="fa fa-exclamation-triangle"></i> '._('The file could not be deleted. pleach check if the files or the folder are writable'));
    }
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
} 


 
 


//############################################
// Carregar novo ficheiro para o Servidor 
//############################################
 if (isset($_POST['upload_images_token'])) {
	if($_POST['upload_images_token'] == $upload_images_token){ 
 
     if (!empty($_FILES)) {
		 
		 $imagex_imagem= new imagex_imagem();
		 $imagex_limpar_nome= new imagex_limpar_nome(); 
		 
		 
		 if(!@is_array($_FILES)){
         die('<i class="fa fa-exclamation-triangle"></i> '._('This file is not permited. Please upload only Image files.'));
 		 } 
		 
		 
		 if(!@$imagex_imagem->imagex_is_image($_FILES['file']['tmp_name'])){
         die('<i class="fa fa-exclamation-triangle"></i> '._('This file is not permited. Please upload only Image files.'));
 		 }	 
		 
 
 
		 $ext = $imagex_imagem->imagex_get_image_ext($_FILES['file']['tmp_name']);
		 
		 
         if($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png' && $ext != '.gif'  && $ext != '.JPG' && $ext != '.JPEG' && $ext != '.PNG' && $ext != '.GIF' ){
             die('<i class="fa fa-exclamation-triangle"></i> '._('This file is not permited. Please upload only Jpg, Png or Gif files.'));
         } 

	 
         // File Data
		 
		 $filename = htmlspecialchars($_FILES['file']['name']);
		 $arr = explode(".", $filename);  
         $filename_sem_ext = $imagex_limpar_nome->imagex_limpar(array_shift($arr));
		 if (strlen($filename_sem_ext) > 25) $filename_sem_ext = substr($filename_sem_ext, 0, 25); 
		 
         $newFileName = date("YmdHis").'-'.$filename_sem_ext.$ext;
 
         $tempFile =    htmlspecialchars($_FILES['file']['tmp_name']);
         $targetFile =  $IMAGEX_MEDIA_DIR.$newFileName;

         if (move_uploaded_file($tempFile, $targetFile)) {
             die(_('File sucessfuly uploaded.'));
         } else {
             die('<i class="fa fa-exclamation-triangle"></i> '._('Something went wrong uploading your file. Please increase the post_max_size and upload_max_filesize on your server and try again'));
         }

     } else die('<i class="fa fa-exclamation-triangle"></i> '._('Please select a Image File to upload.'));

 }else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
 }



 




//######################################
//  Mostrar pastas
//###################################### 
if (isset($_GET['show_all_folders_token'])) {
if ($_GET['show_all_folders_token'] == $show_all_folders_token) {

	
	
$dir = $DIR_PRINCIPAL;
 
$files =  scandir($dir); 
$i="0";
foreach ($files as $file){// LOOP
	
if(isset($_POST['selected_folder']) == $file) {$selected='selected';} else {$selected='';}
	
 
	
if ( is_dir($dir. $file)  &&  $file !='..' && $file !='.'){ 
	 

$nr= count(scandir($DIR_PRINCIPAL.$file))-2;
	
	
// $folder_del_link='<a href="#" id="'.$file.'" delete_folder_token="'.$delete_folder_token.'" class="delete-folder btn btn-xs btn-default" data-toggle="confirm" data-title="'._('Delete this Category and all Files inside? This can not be undone!').'" data-btn-ok-label="'._('Yes').'" data-btn-cancel-label="'._('No!').'"><i class="fa fa-times"></i></a>';
	

$folder_download_link='<form action="imagex.php" method="post" class="pull-left download_link_form">
<input type="hidden" name="folder_name" value="'.$file.'">
<input type="hidden" name="download_folder_token"   value="'.$download_folder_token.'">
<button class="btn btn-xs btn-default"><i class="fa fa-cloud-download"></i></button></form> ';	
	
$folder_rename_link='<a href="#" id="'.$file.'" class="btn btn-xs btn-default pull-left" data-toggle="modal" data-target="#rename-folder-'.$file.'" ><i class="fa fa-pencil-square-o"></i></a>





<!-- Modal -->
<div id="rename-folder-'.$file.'" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">'._('Rename the Category ').' '.$file.'</h4>
      </div>
      <div class="modal-body">
	  <form class="rename-folder">
       <div class="input-group input-group-lg">   
        <input type="text" name="new_foldername" class="form-control rename-folder" placeholder="'.$file.'" value="'.$file.'" >
		<input type="hidden" name="edit_folder_name_token" value="'.$edit_folder_name_token.'">
		<input type="hidden" name="folder_to_rename" value="'.$file.'">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-lg bg-color-active"><i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
			</form>
      </div>
 
    </div>

  </div>
</div>
';
	
if(!isset($tabela_inside)){$tabela_inside= null;}	
$tabela_inside .='
<tr id="row_'.$i.'">
<td><i class="fa fa-folder-o"></i> '.$file.' ('.$nr.')</td>
<td> <div class="input-group-btn">'.$folder_del_link.$folder_rename_link.$folder_download_link.'</div></td> 
 
</tr>
';
$i++;
}
	
}//END LOOP
 
	
echo $tabela_header= '<table class="table table-hover">
                  <tr> 
				  <th>'._('Category').'</th>
				  <th>'._('Options').'</th>
                  </tr>';
if(!isset($tabela_inside)){$tabela_inside= null;}	
echo  $tabela_inside.'</table>';
echo '<script src="assets/js/bootstrap-confirmation.min.js"></script>';	
echo '<script src="assets/js/ajaxForm.js"></script>';		
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
}





//######################################
//  Criar pasta
//###################################### 
if (isset($_POST['create_folder_token'])) {
if ($_POST['create_folder_token'] == $create_folder_token) {

if(!$_POST['new_folder_name']){die('<i class="fa fa-exclamation-triangle"></i> '._('Please type a name for the Category!'));}

$dir = htmlspecialchars($_POST['new_folder_name']);	
	
$imagex_limpar_nome= new imagex_limpar_nome(); 
$new_dir= $imagex_limpar_nome->imagex_limpar($dir);
	
if (!file_exists($DIR_PRINCIPAL.$new_dir)) {
    mkdir($DIR_PRINCIPAL.$new_dir, 0755, true);
	die(_('Category sucessfuly Created.')); 
} else {die('<i class="fa fa-exclamation-triangle"></i> '._('You already have a Category with this name. Please Type a new name.'));}
	
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}
}




//######################################
//  Mudar nome da pasta
//###################################### 
if (isset($_POST['edit_folder_name_token'])) {
if ($_POST['edit_folder_name_token'] == $edit_folder_name_token) {
$dir = $DIR_PRINCIPAL;	
	
$folder_to_rename= $dir.htmlspecialchars($_POST['folder_to_rename']);
$imagex_limpar_nome= new imagex_limpar_nome(); 
$new_foldername= $dir.$imagex_limpar_nome->imagex_limpar(htmlspecialchars($_POST['new_foldername']));
	

if (!file_exists($new_foldername)) {
    rename($folder_to_rename, $new_foldername);
	die(_('Category sucessfuly renamed.')); 
} else {die('<i class="fa fa-exclamation-triangle"></i> '._('You already have a Category with this name. Please Type a new name.'));}	
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}	
}



//######################################
//  Apagar Pasta
//###################################### 
if (isset($_POST['delete_folder_token'])) {
if ($_POST['delete_folder_token'] == $delete_folder_token) {	
if (isset($demo_on) == '1') {die('<i class="fa fa-exclamation-triangle"></i> '._('This function is diseabled on the demo.'));}	
 
$dir = $DIR_PRINCIPAL;
$folder_to_delete= $dir.htmlspecialchars($_POST['folder_to_delete']);
imagex_apagar_pasta($folder_to_delete);
 
	if(is_dir($folder_to_delete)) {
    die('<i class="fa fa-exclamation-triangle"></i> '._('The Category could not be deleted!'));
    } else { die(_('Folder sucessfuly deleted.'));}
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}		
}


 

 
//######################################
//  mudar pw
//###################################### 
if (isset($_POST['reset_pw_token']) && isset($_POST['imagex_new_pw'])) {
if ($_POST['reset_pw_token'] == $reset_pw_token) {
if (isset($demo_on) && $demo_on == '1') {die('<i class="fa fa-exclamation-triangle"></i> '._('This function is diseabled on the demo.'));}	
	
$nova_pw= md5($_POST['imagex_new_pw']);

if(strlen(trim($_POST['imagex_new_pw'])) >1 ){ 	
$str=file_get_contents('imagex_config.php');
$str=str_replace($ImageX_PW, $nova_pw,$str);
file_put_contents('imagex_config.php', $str);
die(_('Your Password was sucessfuly changed. You will be redirected to the login page!'));	
} else {die('<i class="fa fa-exclamation-triangle"></i> '._('please type your new Password'));}
	
}else{die('<i class="fa fa-exclamation-triangle"></i> '._('The Session is expired. Please reload your Browser'));}		
}



?>