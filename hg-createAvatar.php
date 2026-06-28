<?php
ob_start();
	session_start();

	// Create and return the avatar image
			$herd = $_SESSION['herd'];
	// A fix to get a function like imagecopymerge WITH ALPHA SUPPORT
	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		if(!isset($pct)){
			return false;
		}
		$pct /= 100;
		// Get image width and height
		$w = imagesx( $src_im );
		$h = imagesy( $src_im );
		// Turn alpha blending off
		imagealphablending( $src_im, false );
		// Find the most opaque pixel in the image (the one with the smallest alpha value)
		$minalpha = 127;
		for( $x = 0; $x < $w; $x++ )
		for( $y = 0; $y < $h; $y++ ){
			$alpha = ( imagecolorat( $src_im, $x, $y ) >> 24 ) & 0xFF;
			if( $alpha < $minalpha ){
				$minalpha = $alpha;
			}
		}
		//loop through image pixels and modify alpha for each
		for( $x = 0; $x < $w; $x++ ){
			for( $y = 0; $y < $h; $y++ ){
				//get current alpha value (represents the TANSPARENCY!)
				$colorxy = imagecolorat( $src_im, $x, $y );
				$alpha = ( $colorxy >> 24 ) & 0xFF;
				//calculate new alpha
				if( $minalpha !== 127 ){
					$alpha = 127 + 127 * $pct * ( $alpha - 127 ) / ( 127 - $minalpha );
				} else {
					$alpha += 127 * $pct;
				}
				//get the color index with new alpha
				$alphacolorxy = imagecolorallocatealpha( $src_im, ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha );
				//set pixel with the new color + opacity
				if( !imagesetpixel( $src_im, $x, $y, $alphacolorxy ) ){
					return false;
				}
			}
		}
		// The image copy
		imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
	}
	
	// Create an image instance based on the uploaded file type
	function imagecreatefromfile($filename, $filetype) {
		if (!file_exists($filename)) {
			throw new InvalidArgumentException('File "'.$filename.'" not found.');
		}
		switch ($filetype) {
			case 'image/jpeg':
			case 'image/jpg':
				return imagecreatefromjpeg($filename);
				case 'image/png':
				return imagecreatefrompng($filename);
				case 'image/gif':
				return imagecreatefromgif($filename);			
				default:
				throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
		}
	}
	
	// The meat of this file. Return a new graphic image from the uploaded avatar and overlay the selected stripe
	function mergestripe($backgroundFileName, $backgroundFileType, $herd) {
		$stripeFileName = 'stripes/BS_HonorGuard.png';

		if (!file_exists($stripeFileName)) {
			return false;
		} 
		list($widthStripe, $heightStripe) = getimagesize($stripeFileName);
		$stripeImage = imagecreatefrompng($stripeFileName);

		// Create the background image instance
		// The final image is resized to match the dimensions of the stripe image
		list($widthD, $heightD) = getimagesize($backgroundFileName);
		$backgroundImage = imagecreatefromfile($backgroundFileName, $backgroundFileType);
		$finalImage = imagecreatetruecolor($widthStripe, $heightStripe);
		imagecopyresized($finalImage, $backgroundImage, 0, 0, 0, 0, $widthStripe, $heightStripe, $widthD, $heightD);
		
		imagecopymerge_alpha($finalImage, $stripeImage, 0, 0, 0, 0, $widthStripe, $heightStripe, 100);
		
		// Free the memory used in the temporary images and return the final image
		imagedestroy($backgroundImage);
		imagedestroy($stripeImage);
		return $finalImage;
	}
	
	$avatar = mergestripe($_SESSION['filename'], $_SESSION['filetype'], $_SESSION['herd']);
	header('Content-Type: image/jpg');
	header('Content-Disposition: inline; filename="myBlackSheepAvatar.jpg"'); // set a sensible name for the browsers 'Save/Save as' 
	imagepng($avatar);
	//unlink($_SESSION['filename']); // Delete the user uploaded file now we are finished with it.
	ob_flush();
?>