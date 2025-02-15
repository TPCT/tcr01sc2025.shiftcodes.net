<?php

namespace Modules\Admin\App\Services;

use App\Models\Content;

class ContentService
{
    public function createEmpty($type,$resource_id)
    {
        $data = [
            "type" => $type,
            "resource_id" => $resource_id
        ];
        \App\Models\Content::create($data);

        $data_seo['type'] = $type;
        $data_seo['resource_id'] = $resource_id;
        \App\Models\SEO::create($data_seo);

        return true;
    }

    public function create($request,$type,$resource_id)
    {
        $data = [
            "type" => $type,
            "resource_id" => $resource_id
        ];
        $data['title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("content_title_" . $key);
        }
        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description'][$key] = $request->get("content_description_" . $key);
        }
        if($request->has('content_image')){
            $data['image'] = $request->file('content_image')->store('contents', 'public');
        }
        $data['title_2'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title_2'][$key] = $request->get("content_title_2_" . $key);
        }
        $data['description_2'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description_2'][$key] = $request->get("content_description_2_" . $key);
        }
        if($request->has('content_image_2')){
            $data['image_2'] = $request->file('content_image_2')->store('contents', 'public');
        }
        $data['title_3'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title_3'][$key] = $request->get("content_title_3_" . $key);
        }
        $data['description_3'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description_3'][$key] = $request->get("content_description_3_" . $key);
        }
        if($request->has('content_image_3')){
            $data['image_3'] = $request->file('content_image_3')->store('contents', 'public');
        }
        \App\Models\Content::create($data);

        $data_seo = [];
        $data_seo['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data_seo['description'][$key] = $request->get("seo_description_" . $key);
        }
        $data_seo['keywords'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data_seo['keywords'][$key] = $request->get("seo_keywords_" . $key);
        }
        $data_seo['meta_title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data_seo['meta_title'][$key] = $request->get("seo_meta_title_" . $key);
        }
        $data_seo['type'] = $type;
        $data_seo['resource_id'] = $resource_id;
        \App\Models\SEO::create($data_seo);


        return true;
    }

    public function update($request,$content,$seo)
    {
        if($content) {
            $data['title'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data['title'][$key] = $request->get("content_title_" . $key);
            }
            $data['description'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data['description'][$key] = $request->get("content_description_" . $key);
            }
            if($request->has('content_image')){
                $data['image'] = $request->file('content_image')->store('contents', 'public');
            }
            $data['title_2'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data['title_2'][$key] = $request->get("content_title_2_" . $key);
            }
            $data['description_2'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data['description_2'][$key] = $request->get("content_description_2_" . $key);
            }
            if($request->has('content_image_2')){
                $data['image_2'] = $request->file('content_image_2')->store('contents', 'public');
            }
            $data['title_3'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data['title_3'][$key] = $request->get("content_title_3_" . $key);
            }
            $data['description_3'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data['description_3'][$key] = $request->get("content_description_3_" . $key);
            }
            if($request->has('content_image_3')){
                $data['image_3'] = $request->file('content_image_3')->store('contents', 'public');
            }
            $content->update($data);
        }
        if($seo) {
            $data_seo['description'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data_seo['description'][$key] = $request->get("seo_description_" . $key);
            }
            $data_seo['keywords'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data_seo['keywords'][$key] = $request->get("seo_keywords_" . $key);
            }
            $data_seo['meta_title'] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data_seo['meta_title'][$key] = $request->get("seo_meta_title_" . $key);
            }
            $seo->update($data_seo);
        }
        return true;
    }

    public function updateFaq($request,$type,$resource_id) {
        if($resource_id == 0) {
            $faq = \App\Models\Faq::where('type',$type)->delete();
        }else {
            $faq = \App\Models\Faq::where('type',$type)->where('resource_id',$resource_id)->delete();
        }
        if($request->has('faq_question_ar')) {
            foreach($request->get('faq_question_ar') as $k => $question) {
                $faq_data = [];
                $faq_data['type'] = $type;
                $faq_data['resource_id'] = $resource_id ? $resource_id : null;
                $faq_data['question'] = [];

                foreach(\Config::get("app.languages") as $key => $lang) {

                    $faq_data['question'][$key] = $request['faq_question_' .$key][$k];
                }
                $faq_data['answer'] = [];
                foreach(\Config::get("app.languages") as $key => $lang) {
                    $faq_data['answer'][$key] = $request['faq_answer_' .$key][$k];
                }

                \App\Models\Faq::create($faq_data);
            }
        }
        return true;
    }

}
