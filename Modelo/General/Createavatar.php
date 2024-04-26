<?php

function createAvatarImage($string,$string1)
{
  
    header("Content-type: image/png");
    $imageFilePath = "../../Assets/imagenes/Iconos/A1/".$string.$string1 . ".png";
    $stringf = $string.$string1;

    //base avatar image that we use to center our text string on top of it.
    $avatar = imagecreatetruecolor(100,100);
   
    $bg_color = imagecolorallocate($avatar, 135, 206, 235);

    imagefill($avatar,0,0,$bg_color);
    $avatar_text_color = imagecolorallocate($avatar, 0, 0, 0);
	// Load the gd font and write 
    $font = imageloadfont('../../Assets/herramientas/gd-files/Ambient.gdf');
    imagestring($avatar, $font, 20, 30, $stringf, $avatar_text_color);  
   
    imagepng($avatar, $imageFilePath);
  
    imagedestroy($avatar);
   
    return $imageFilePath;
}


?>