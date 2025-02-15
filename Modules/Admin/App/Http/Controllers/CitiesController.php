<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\City;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:areas']);
    }

    public function getCities($id) {
        $cities = City::where('country_id', $id)->get();
        return response()->json($cities);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = City::paginate(10);
        return view('admin::cities.index')->with('data', $data);
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
        $city = City::create($data);

        $resource = "city";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->create($request, $resource, $city->id);
        $content->updateFaq($request, $resource, $city->id);

        return redirect("/admin/cities")->withSuccess("تم حفظ التغييرات بنجاح");
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
        $item = City::find($id);
        return view('admin::cities.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
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
        $city = City::find($id);
        $city->update($data);

        $resource = "city";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request, 
        \App\Models\Content::where('type',$resource)->where('resource_id',$id)->first(),
        \App\Models\SEO::where('type',$resource)->where('resource_id',$id)->first()
        );
        $content->updateFaq($request, $resource, $id);
        return redirect("/admin/cities")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        City::destroy($id);
        return redirect("/admin/cities")->withSuccess("تم حذف العنصر بنجاح");
    }
}
