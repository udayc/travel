<?php namespace App\Handlers\Events;

use App\Events\FileAttachment;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ImageFileAttachment {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  FileAttachment  $event
	 * @return void
	 */
	public function handle(FileAttachment $event)
	{

			$file = $event->request->file($event->atrributes['input_file_tag']);
			$imageName = uniqid('project-', true) . '.' .  $file->getClientOriginalExtension();
			$handle_response = '';  
			$realPath = base_path() . '/public/images/file-attached-to-project/';
			$supported_image = array( 'gif','jpg','jpeg','png', 'bmp','GIF','JPG', 'JPEG','PNG', 'BMP');			
			$ext=$file->getClientOriginalExtension();


			if($event->request->file($event->atrributes['input_file_tag'])->move( $realPath, $imageName ))
			{
				if(in_array($ext, $supported_image)){
				$resizePath 			= base_path(). '/public/images/file-attached-to-project/resize/' 			. $imageName;
				$resizeMediumPath 		= base_path(). '/public/images/file-attached-to-project/resize/medium/' 	. $imageName;
				$openMakePath = $realPath . $imageName;	
				# Resize Small Image
				Image::make($openMakePath)->resize($event->atrributes['width'], $event->atrributes['height'])->save($resizePath);
				# Resize Medium Image
				Image::make($openMakePath)->resize($event->atrributes['mWidth'], $event->atrributes['mHeight'])->save($resizeMediumPath); 
				
				} 
				$handle_response = $imageName ; 
				return $handle_response;
			}
			else
			{
				return $handle_response;
			}
			
			
					
			
			
			
			
			
			/*
			if ( Storage::disk('local')->put( 'project/' . $imageName,  File::get($file)) )
			{
					$filePath = Storage::disk('local')->get('project/'.$imageName);					
					$resizePath  = storage_path('app') . '/project/resize/'.$imageName;
					Image::make($filePath)->resize($event->atrributes['width'], $event->atrributes['height'])->save($resizePath) ;
					$handle_response = $imageName ; 
					return $handle_response;
			}
			else 
				return $handle_response;
			*/

	}




}
