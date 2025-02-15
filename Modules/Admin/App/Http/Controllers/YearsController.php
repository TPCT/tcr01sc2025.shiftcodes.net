<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Year;

class YearsController extends Controller
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
        $data = Year::orderBy("title","asc")->paginate(10);
        return view('admin::years.index')->with('data', $data);
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

        Year::create($data);
        return redirect("/admin/years")->withSuccess("تم حفظ التغييرات بنجاح");
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
        $item = Year::find($id);
        return view('admin::years.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->all();

        $item = Year::find($id);
        $item->update($data);

        return redirect("/admin/years")->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Year::find($id);
        $item->delete();

        return redirect("/admin/years")->withSuccess("تم حذف العنصر بنجاح");
    }
}
