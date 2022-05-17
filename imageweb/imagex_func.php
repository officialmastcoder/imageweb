<?php 
//#####################################################
// CARLOS SANTOS DE AZEVEDO
// Software: Imagex - Website Image Upload & Managment 
// Website Images Managment without database
// CopyRight: Litos Media - Carlos Santos de Azevedo
// Contact: info@litos.top
// 10-2017
//#####################################################
define('DEBUG', false);
include_once ("imagex_config.php");
if(file_exists('imagex_install.php') && basename($_SERVER['PHP_SELF']) !='imagex_install.php'){
     header('Location: imagex_install.php');die();
}

function is_https() {
    return isset($_SERVER['HTTPS']) ||
        ($visitor = json_decode($_SERVER['HTTP_CF_VISITOR'])) &&
            $visitor->scheme == 'https';
}
 


$DIR_PRINCIPAL= $_SERVER['DOCUMENT_ROOT']."/".$USER_TYPED_TOP_FOLDER_PATH.'/'; //Top Folder path

 
	 
if (isset($_GET['selected_folder']) !=''){
$subfolder= htmlspecialchars($_GET["selected_folder"]);
$IMAGEX_MEDIA_DIR= $DIR_PRINCIPAL.$subfolder.'/';
$DIR_PRINCIPAL_NAME= str_replace($_SERVER['DOCUMENT_ROOT'], '', $DIR_PRINCIPAL.$subfolder.'/' );
$IMAGEX_MEDIA_URL= ( is_https()=='1' ? "https" : "http") ."://".$_SERVER['SERVER_NAME'].$DIR_PRINCIPAL_NAME;
}
  
 

function imagex_show_dropdown_folders_list(){ 
global $DIR_PRINCIPAL;
$dir = $DIR_PRINCIPAL;
echo '<option disabled selected>'._('-- Please Select a Category --').'</option>'; 
$files =  scandir($dir); 
foreach ($files as $file){
if(@$_POST['selected_folder'] == $file) {$selected='selected';} else {$selected='';}
 
	
if ( is_dir($dir. $file) && 
	 isset($UPLOADS_DIRECTORY) != $file && 
    $file !='..'&&
    $file !='.'){ echo '<option value="'.$file.'" '.$selected.'> '.$file.'</option>';}}
} 

 
class imagex_imagem{
function imagex_is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
} 




function imagex_resize($newWidth, $targetFile, $originalFile) {
 
    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;
			
			  case 'image/jpg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;
			
			 case 'image/pjpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;
 
			
			 case 'image/x-png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
					 
                    break;
			
			
			

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
					 break;
					
					
                    

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

 
		
	
	
	
    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
	
	
	 /* Para que o bg fique da mesma cor*/
    $background = imagecolorallocate($tmp, 0, 0, 0);
    imagecolortransparent($tmp, $background);
    imagealphablending($tmp, false);
    imagesavealpha($tmp, true);
	/* Para que o bg fique da mesma cor*/
	
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile.$new_image_ext");
}
 
	
function imagex_get_image_ext($originalFile) {
 
 
    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;
			
			  case 'image/jpg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;
			
			 case 'image/pjpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;
 
			
			 case 'image/x-png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
					 
                    break;
			
			
			

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
					 break;
					
					
                    

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

 
return '.'.$new_image_ext;
}	


 
	
function imagex_rotateImage($sourceFile,$destImageName,$degreeOfRotation)
{
  $imageinfo=getimagesize($sourceFile);
  switch($imageinfo['mime'])
  {
  
 
   case "image/jpg":
   case "image/jpeg":
   case "image/pjpeg":  
  
  $src_img=imagecreatefromjpeg("$sourceFile");
  $image_save_func = 'imagejpeg';
                break;
    
	
	case "image/gif":
        $src_img = imagecreatefromgif("$sourceFile");
		$image_save_func = 'imagegif';
                break;
    
	case "image/png":
    case "image/x-png": //for IE
        $src_img = imagecreatefrompng("$sourceFile");
		$image_save_func = 'imagepng';
                break;
  }
  
 
    $background = imagecolorallocate($src_img, 0, 0, 0);
    imagecolortransparent($src_img, $background);
    imagealphablending($src_img, false);
    imagesavealpha($src_img, true);
 
 
  $src_img = imagerotate($src_img, $degreeOfRotation, 0);
	
	
 
  $image_save_func ($src_img,$destImageName);
}



 
} 
 
class imagex_limpar_nome{
	
public  function imagex_limpar( $string, $separator = '-' )
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}
}

 function imagex_apagar_pasta($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir(htmlspecialchars($dir)); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object); 
       } 
     }
     rmdir($dir); 
   } 
 }




class imagex_form_token{
	
public  function new_token($name){	
if(empty($_SESSION[$name])){$_SESSION[$name] = bin2hex(random_bytes(64));}
}	
	
	
public  function get_session_token($name){
return($_SESSION[$name]);
}	
	 
public  function reset_all_sessions(){	
// Unset all of the session variables.
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
}		
	
	
	
 
	
}//	class imagex_form_token	




 
 

 
     
  
function ImageX_Download_Pasta($source, $destination){
$rootPath = realpath($source);

$zip = new ZipArchive();
$zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE);

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    if (!$file->isDir())
    {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        $zip->addFile($filePath, $relativePath);
    }
}

 
$zip->close();	
 
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename='.basename($destination));
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($destination));
  ignore_user_abort(true);	
  ob_clean();
  flush();
  if (readfile($destination)) 
  {
     unlink($destination);
  }
 
	
}
 
 

 
 
if(DEBUG == true){
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
}else{
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
}



//#####################################################
// TOKENS
//#####################################################
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

$imagex_form_token= new imagex_form_token();
//$imagex_form_token->reset_all_sessions();

//add server token session
$imagex_form_token->new_token('show_images_token');
$imagex_form_token->new_token('upload_images_token');
$imagex_form_token->new_token('rotate_image_left_token');
$imagex_form_token->new_token('rotate_image_right_token');
$imagex_form_token->new_token('delete_image_token');
$imagex_form_token->new_token('show_all_folders_token');
$imagex_form_token->new_token('create_folder_token');
$imagex_form_token->new_token('edit_folder_name_token');
$imagex_form_token->new_token('delete_folder_token');
$imagex_form_token->new_token('download_folder_token');
$imagex_form_token->new_token('download_all_folder_token');
$imagex_form_token->new_token('login_token');
$imagex_form_token->new_token('reset_pw_token');


//get server Token session
$show_images_token= $imagex_form_token->get_session_token('show_images_token');
$upload_images_token= $imagex_form_token->get_session_token('upload_images_token');
$rotate_image_left_token= $imagex_form_token->get_session_token('rotate_image_left_token');
$rotate_image_right_token= $imagex_form_token->get_session_token('rotate_image_right_token');
$delete_image_token= $imagex_form_token->get_session_token('delete_image_token');
$show_all_folders_token= $imagex_form_token->get_session_token('show_all_folders_token');
$create_folder_token= $imagex_form_token->get_session_token('create_folder_token');
$edit_folder_name_token= $imagex_form_token->get_session_token('edit_folder_name_token');
$delete_folder_token= $imagex_form_token->get_session_token('delete_folder_token');
$download_folder_token= $imagex_form_token->get_session_token('download_folder_token');
$download_all_folder_token= $imagex_form_token->get_session_token('download_all_folder_token');
$login_token= $imagex_form_token->get_session_token('login_token');
$reset_pw_token= $imagex_form_token->get_session_token('reset_pw_token');



if($LOGIN_ACTIVE==1 && $_SERVER['REQUEST_URI'] != 'imagex-login.php'){
 if (!isset($_SESSION['ImageX_PW']) || $_SESSION['ImageX_PW'] !=  $ImageX_PW) {
		 $imagex_form_token->reset_all_sessions();
		 header('Location: imagex-login.php');
         exit; 
	}
}
 
 
?>