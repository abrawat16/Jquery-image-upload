<?php  

include_once 'class.image.transparency.php';

$transparency = new Image_Transparency;

$transparency->pct = 30;
 
$valid_exts = array('jpeg', 'jpg', 'png');
$max_file_size = 500 * 1024; #200kb

$nw =  935;
$nh = 430 ;  # image with # height

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ( isset($_FILES['image']) ) {
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
		if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
			
			
					$new_name = uniqid() ;
					$path = 'uploads/'.$new_name.'-reverse.'.$ext;
					$path_normal = 'uploads/'.$new_name.'-main.'.$ext;
					$size = getimagesize($_FILES['image']['tmp_name']);

					$x = (int) $_POST['x'];
					$y = (int) $_POST['y'];
					$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
					$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
		 
 
					$data_normal = file_get_contents($_FILES['image']['tmp_name']);
					$vImg_normal = imagecreatefromstring($data_normal);
					$dstImg_normal = imagecreatetruecolor($nw, $nh);
					imagecopyresampled($dstImg_normal, $vImg_normal, 0, 0, $x, $y, $nw, $nh, $w, $h);
					imagejpeg($dstImg_normal, $path_normal);
					imagedestroy($dstImg_normal);

 
					$data = file_get_contents($_FILES['image']['tmp_name']); 
					$vImg = imagecreatefromstring($data);
					$dstImg = imagecreatetruecolor($nw, $nh);
					imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
					imageflip($dstImg, IMG_FLIP_HORIZONTAL);
					imagejpeg($dstImg, $path); 
					imagedestroy($dstImg);

  
					$transparency->source_image =  $path ; 
					$transparency->new_image_name = $new_name."-transparent" ; 
					$transparency->save_to_folder = 'E:/xampp/htdocs/jquery-image-crop/uploads/';
					$process = $transparency->make_transparent();

					  
					echo "<img src='$path_normal' />";


				} else {
					echo 0;
					 
				} 
		} else {
			echo 1;
		 
		}
	} else {
		echo 2;
		 
	}
} else {
	echo 'bad request!';
}

