<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Type;

class TypesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:definitions']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Type::paginate(10);
        return view('admin::types.index')->with('data', $data);
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
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
        }
        $data['page_title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_title'][$key] = $request->get("page_title_" . $key);
        }
        $data['page_description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_description'][$key] = $request->get("page_description_" . $key);
        }
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('types', 'public');
        }
        $type = Type::create($data);

        $resource = "type";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->create($request, $resource, $type->id);
        $content->updateFaq($request, $resource, $type->id);

        return redirect("/admin/types")->withSuccess("تم حفظ التغييرات بنجاح");
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
        $item = Type::find($id);
        return view('admin::types.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $type = Type::find($id);
        $data = $request->all();

        $data['title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
        }
        $data['page_title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_title'][$key] = $request->get("page_title_" . $key);
        }
        $data['page_description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_description'][$key] = $request->get("page_description_" . $key);
        }
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('types', 'public');
        }
        $type->update($data);
        $resource = "type";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request,
        \App\Models\Content::where('type',$resource)->where('resource_id',$id)->first(),
        \App\Models\SEO::where('type',$resource)->where('resource_id',$id)->first()
        );
        $content->updateFaq($request, $resource, $id);
        return redirect("/admin/types")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();
        return redirect("/admin/types")->withSuccess("تم حذف العنصر بنجاح");
    }
}
