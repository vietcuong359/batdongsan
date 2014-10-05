<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir )) ) {
  	
  	if ( $fname != "." & $fname != "..")
  	{
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    
    $ext = strtolower($info['extension']);
    
    // continue only if this is a JPEG image
    if ( $ext == 'gif' )
    {
    	$img = imagecreatefromgif( "{$pathToImages}/{$fname}" );
    }
    else if ( $ext == 'png' )
    {
    	$img = imagecreatefrompng( "{$pathToImages}/{$fname}" );
    }
    else if ( $ext == 'jpg' | $ext == 'jpeg' )
    {
    	$img = imagecreatefromjpeg( "{$pathToImages}/{$fname}" );
    }
   
      // load image and get image size
      
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      if ( $ext == 'gif' )
      {
      	imagegif( $tmp_img, "{$pathToThumbs}/{$fname}" );
      }
      else if ( $ext == 'png' )
      {
      	imagepng( $tmp_img, "{$pathToThumbs}/{$fname}" );
      }
      else if ( $ext == 'jpg' | $ext == 'jpeg' )
      {
      	imagejpeg( $tmp_img, "{$pathToThumbs}/{$fname}" );
      }
      
    
  }
  // close the directory
 
  }
  closedir( $dir );
}

?>
