<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Setting;
class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:settings']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();
        if(!$settings){
            $settings = new Setting();
            $settings->save();
        }
        return view('admin::settings.index', compact('settings'));
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
        $settings = Setting::find($id);
        $data     = $request->all();
        $data['title'] = [];
        $data['footer_description'] = [];
        $data['footer_address'] = [];
        $data['driver_title'] = [];
        $data['driver_description'] = [];
        $data['yacht_title'] = [];
        $data['yacht_description'] = [];
        $data['blog_title'] = [];
        $data['faq_title'] = [];
        $data['default_notes'] = [];
        $data['driver_notes'] = [];
        $data['yacht_notes'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
            $data['footer_description'][$key] = $request->get("footer_description_" . $key);
            $data['footer_address'][$key] = $request->get("footer_address_" . $key);
            $data['driver_title'][$key] = $request->get("driver_title_" . $key);
            $data['driver_description'][$key] = $request->get("driver_description_" . $key);
            $data['yacht_title'][$key] = $request->get("yacht_title_" . $key);
            $data['yacht_description'][$key] = $request->get("yacht_description_" . $key);
            $data['blog_title'][$key] = $request->get("blog_title_" . $key);
            $data['faq_title'][$key] = $request->get("faq_title_" . $key);
            $data['default_notes'][$key] = $request->get("default_notes_" . $key);
            $data['driver_notes'][$key] = $request->get("driver_notes_" . $key);
            $data['yacht_notes'][$key] = $request->get("yacht_notes_" . $key);


        }
        if($request->hasFile('header_logo')){
            $data['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }
        if($request->hasFile('footer_logo')){
            $data['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }


      
        $home = [
            "car_types_title",
            "car_types_description",
            "car_brands_title",
            "car_brands_description",
            "car_companies_title",
            "car_companies_description",
            "book_your_next_trip_left",
            "book_your_next_trip_right",
            "find_your_car_title",
            "find_your_car_description",
        ];  
        
        foreach($home as $h) {
            $data[$h] = [];
            foreach(\Config::get("app.languages") as $key => $lang) {
                $data[$h][$key] = $request->get($h . "_". $key);
            }
        }
  

        $settings->update($data);

        \App\Models\BlogCar::truncate();
        if($request->has('car_id')) {
        
            foreach($request->car_id as $car_id) {
                \App\Models\BlogCar::create([
                    'car_id' => $car_id
                ]);
            }
        }
        return redirect()->back()->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
