<?php

namespace App\Helpers;

class WebpImage
{
    public static function convert(
        $fullPath,
        $outPutQuality = 100,
        $deleteOriginal=false){
        if(file_exists($fullPath)):

            $ext = pathinfo($fullPath, PATHINFO_EXTENSION);
            $extension = strtolower($ext);
            $newFileFullPath = str_replace('.'.$ext,'.webp',$fullPath);
            if (\Cache::get($newFileFullPath) && is_file($newFileFullPath)){
                $newPathInfo = explode('/', $newFileFullPath);
                $finalImage  = $newPathInfo[count($newPathInfo)-1];
                return (object) array(
                    "fullPath"=>$newPathInfo,
                    "file"=>$finalImage,
                    "status"=>1
                );
            }

            \Cache::put($newFileFullPath, 0, 24 * 3600);
            $isValidFormat = false;
            $img = null;

            // Create and save
            if($extension == 'png'){
                $img = imagecreatefrompng($fullPath);
                $isValidFormat = true;

            }
            else if(in_array($extension, ['jpg', 'jpeg'])) {
                $img = imagecreatefromjpeg($fullPath);
                $isValidFormat = true;
            }
            else if($extension == 'gif') {
                $img = imagecreatefromgif($fullPath);
                $isValidFormat = true;
            }

            if($isValidFormat){
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
                imagewebp($img, $newFileFullPath, $outPutQuality);
                imagedestroy($img);

                if($deleteOriginal){
                    unlink($fullPath);
                }

            }else{
                return (Object) array('error'=>__('site.Given file cannot be converted to webp'),'status'=>0);
            }

            $newPathInfo = explode('/', $newFileFullPath);
            $finalImage  = $newPathInfo[count($newPathInfo)-1];

            \Cache::put($newFileFullPath, 1, 24 * 3600);
            $result = array(
                "fullPath"=>$newPathInfo,
                "file"=>$finalImage,
                "status"=>1
            );

            return (Object) $result;

        else:
            return (Object) array('error'=>__('site.File does not exist'),'status'=>0);
        endif;

    }
}