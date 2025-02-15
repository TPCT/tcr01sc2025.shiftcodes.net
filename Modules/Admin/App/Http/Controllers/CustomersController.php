<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\User;

class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:customers']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where("type","customer")->orderBy("id","desc")->paginate(10);
        return view('admin::customers.index')->with("data",$data);
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
        //
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
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = User::find($id);
        $customer->delete();
        return redirect()->back()->withSuccess("تم حذف العميل بنجاح");
    }
}
