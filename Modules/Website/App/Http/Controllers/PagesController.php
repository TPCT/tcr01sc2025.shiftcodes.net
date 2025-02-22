<?php

namespace Modules\Website\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id,$slug)
    {
        $page = \App\Models\Page::findOrFail($id);
        return view('website::page')->with([
            'page' => $page
        ]);
    }

    public function faq()
    {
        return view('website::faq');
    }

    public function contact() {
        return view('website::contact');
    }

    public function saveContact(Request $request) {
        $data = $request->all();
        \App\Models\Message::create($data);
        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function listYourCar() {
        return view('website::list-your-car');
    }


}
