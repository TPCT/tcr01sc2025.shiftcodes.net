<?php

namespace Modules\Website\App\Http\Controllers;

use App\Helpers\WebpImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function show($path){
        $path = storage_path('app/public/' . $path);
        $extension = \request('extension');
        $path = str_replace('.webp', '.' . $extension, $path);

        if (!file_exists($path))
            abort(404);

        if (@is_array(getimagesize($path))){
            $image_data = WebpImage::convert($path);
            if ($image_data->status) {
                $path = implode("/", $image_data->fullPath);
                return response()->download($path);
            }
            return response()->download($path);
        }
        else
            return response()->download($path);
    }
}
