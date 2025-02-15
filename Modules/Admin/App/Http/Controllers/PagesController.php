<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Page;
class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:pages']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Page::where(function($query) {
            
        })->orderBy("id","desc")->paginate(10);
        return view('admin::pages.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['name'] = [];
        $data['content'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
            $data['content'][$key] = $request->get("content_" . $key);
        }
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('pages', 'public');
        }
        $page = Page::create($data);

        $resource = "page";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->create($request, $resource, $page->id);
        $content->updateFaq($request, $resource, $page->id);
        return redirect("/admin/pages")->withSuccess("تم حفظ التغييرات بنجاح");
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
        $item = Page::find($id);
        return view('admin::pages.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->all();
        $data['name'] = [];
        $data['content'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
            $data['content'][$key] = $request->get("content_" . $key);
        }
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('pages', 'public');
        }
        $page = Page::find($id);
        $page->update($data);

        $resource = "page";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request, 
        \App\Models\Content::where('type',$resource)->where('resource_id',$id)->first(),
        \App\Models\SEO::where('type',$resource)->where('resource_id',$id)->first()
        );
        $content->updateFaq($request, $resource, $id);

        if($request->has('car_id')) {
        
            $page->cars()->sync($request->get('car_id'));
        }else {
            $page->cars()->detach();
        }
        return redirect("/admin/pages")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect("/admin/pages")->withSuccess("تم حذف الصفحة بنجاح");
    }
}
