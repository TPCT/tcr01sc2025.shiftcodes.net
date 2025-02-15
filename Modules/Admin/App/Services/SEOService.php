<?php

namespace Modules\Admin\App\Services;

use App\Models\Content;

class SEOService
{
    public function createEmpty($type,$resource_id)
    {
        $data_seo['type'] = $type;
        $data_seo['resource_id'] = $resource_id;
        \App\Models\SEO::create($data_seo);

        return true;
    }

    public function create($request,$type,$blog)
    {
        $data_seo = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data_seo['meta_title'][$key] = $request->get("title_" . $key);
            $data_seo['description'][$key] = $request->get("description_" . $key);
            $data_seo['keywords'][$key] = $request->get("keywords_" . $key);
        }
        $data_seo['type'] = $type;
        $data_seo['resource_id'] = $blog->id;
        \App\Models\SEO::create($data_seo);
        return true;
    }

    public function update($request,$seo)
    {
        if($seo) {
            $data_seo = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data_seo['meta_title'][$key] = $request->get("title_" . $key);
                $data_seo['description'][$key] = $request->get("description_" . $key);
                $data_seo['keywords'][$key] = $request->get("keywords_" . $key);
            }

            $seo->update($data_seo);
        }
        return true;
    }
}
