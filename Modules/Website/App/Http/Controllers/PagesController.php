<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($country, $city, Page $page)
    {
        return view('website::page')->with([
            'page' => $page
        ]);
    }

    public function faq()
    {
        return view('website::faq');
    }

    public function contact() {
        if (\request()->method() == 'POST') {
            $data = $request->all();
            \App\Models\Message::create($data);
            return redirect()->back()->with('success', __("lang.contact-us-success-message"));
        }
        return view('website::contact');
    }

    public function list_your_car() {
        return view('website::list-your-car');
    }


}
