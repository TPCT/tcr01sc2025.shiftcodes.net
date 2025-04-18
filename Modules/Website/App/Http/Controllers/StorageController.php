<?php

namespace Modules\Website\App\Http\Controllers;

use App\Helpers\WebpImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StorageController extends Controller
{
    public function show($path){
        $path = storage_path('app/public/' . $path);
        $extension = \request('extension');
        $path = str_replace('.webp', '.' . $extension, $path);

        if (!file_exists($path))
            abort(404);

        if ($cache_path = Cache::get($path))
            return response()->download($cache_path);

        if (@is_array(getimagesize($path))){
            $image_data = WebpImage::convert($path);
            if ($image_data->status) {
                \Cache::put($path, $image_data->fullPath, 60 * 60 * 24 * 30 * 365);
                $path = implode("/", $image_data->fullPath);
            }
        }

        return response()->download($path);
    }
}
