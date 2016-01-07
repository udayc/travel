<?php
namespace App;

class FileUploadUtilities {
	public static function getAbsoluteVideoUploadPath(){
		return public_path(). DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR .'videos'. DIRECTORY_SEPARATOR;
	}
	
	public static function generateRandomFileName($ext){
		return time(). '.' . $ext;
	}
}