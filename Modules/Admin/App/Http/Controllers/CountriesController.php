<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Country;

class CountriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:areas']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Country::paginate(10);
        return view('admin::countries.index')->with('data', $data);
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
        if($request->has('image')){
            $data['flag'] = $request->file('image')->store('countries', 'public');
        }
        Country::create($data);
        return redirect("/admin/countries")->withSuccess("تم حفظ التغييرات بنجاح");
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
        $item = Country::find($id);
        return view('admin::countries.edit')->with('item', $item);
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
        if($request->has('image')){
            $data['flag'] = $request->file('image')->store('types', 'public');
        }
        $item = Country::find($id);
        $item->update($data);

        return redirect("/admin/countries")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Country::find($id);
        $item->delete();

        return redirect("/admin/countries")->withSuccess("تم حذف العنصر بنجاح");
    }
}
