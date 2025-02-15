<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Section;

class SectionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:website_home_page']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Section::orderBy("id","desc")->paginate(10);
        return view('admin::sections.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['title'] = [];
        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
            $data['description'][$key] = $request->get("description_" . $key);
        }
        $section = Section::create($data);

        $content = new \Modules\Admin\App\Services\ContentService();
        $content->create($request, 'section', $section->id);
        $content->updateFaq($request, "section", $section->id);


        return redirect("/admin/sections")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Section::find($id);

        return view('admin::sections.edit')->with([
            'item' => $item,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->all();
        $data['title'] = [];
        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
            $data['description'][$key] = $request->get("description_" . $key);
        }
        $item = Section::find($id);
        $item->update($data);

        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request, 
        \App\Models\Content::where('type','section')->where('resource_id',$id)->first(),
        \App\Models\SEO::where('type','section')->where('resource_id',$id)->first()
        );
        $content->updateFaq($request, "section", $id);
        
        return redirect("/admin/sections")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Section::destroy($id);
        return redirect("/admin/sections")->withSuccess("تم حذف القسم بنجاح");
    }
}
