<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Banner;

class BannersController extends Controller
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
        $data = Banner::orderBy("id","desc")->paginate(10);
        return view('admin::banners.index')->with('data', $data);
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
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }
        Banner::create($data);
        return redirect("/admin/banners")->withSuccess("تم حفظ التغييرات بنجاح");
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
        $banner = Banner::find($id);
        return view('admin::banners.edit')->with([
            'item' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $banner = Banner::find($id);
        $data = $request->all();
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }
        $banner->update($data);
        return redirect("/admin/banners")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Banner::find($id);
        $item->delete();
        return redirect("/admin/banners")->withSuccess("تم حذف البيانات بنجاح");
    }
}
