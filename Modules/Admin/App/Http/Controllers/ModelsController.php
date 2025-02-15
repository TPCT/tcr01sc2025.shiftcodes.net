<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Models;
use \App\Models\Brand;
use Maatwebsite\Excel\Facades\Excel;
use \App\Imports\ModelsContentImport;
class ModelsController extends Controller
{

    public function importExcel(Request $request) {
        Excel::import(new ModelsContentImport(), request()->file('file'));
        return redirect()->back()->withSuccess('Imported Successfully');
    }

    public function __construct()
    {
        $this->middleware(['permission:definitions']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Models::where(function($query) {
            $query->where('type', '=', request('type'));
            if(request()->get('search')){
                $query->where('title', 'like', '%' . request()->get('search') . '%');
            }
            if(request()->get('brand_id')){
                $query->where('brand_id', request()->get('brand_id'));
            }
        })->paginate(30);
        return view('admin::models.index', ['data' => $data]);
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
 
        $data['page_description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_description'][$key] = $request->get("page_description_" . $key);
        }

        $data['page_features'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_features'][$key] = $request->get("page_features_" . $key);
        }
        $create = Models::create($data);

        $resource = "model";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->create($request, $resource, $create->id);
        $content->updateFaq($request, $resource, $create->id);

        return redirect("/admin/models?type=". $create->type)->withSuccess("تم حفظ التغييرات بنجاح");
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
        $item = Models::find($id);
        return view('admin::models.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $model = Models::find($id);
        $data = $request->all();

        $data['title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
        }
        $data['page_title'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_title'][$key] = $request->get("page_title_" . $key);
        }
        $data['page_features'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['page_features'][$key] = $request->get("page_features_" . $key);
        }
        $model->update($data);

        $resource = "model";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request, 
        \App\Models\Content::where('type',$resource)->where('resource_id',$id)->first(),
        \App\Models\SEO::where('type',$resource)->where('resource_id',$id)->first()
        );
        $content->updateFaq($request, $resource, $id);
      
        return redirect($request->redirect_url)->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Models::find($id);
        $model->delete();
        return redirect()->back()->withSuccess("تم حذف العنصر بنجاح");
    }
}
