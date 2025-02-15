<?php

namespace Modules\API\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pages()
    {
        $pages = \App\Models\Page::get();
        return response()->json($pages);
    }

    public function showPage($id)
    {
        $page = \App\Models\Page::findOrfail($id);
        return response()->json($page);
    }

    public function settings()
    {
        $settings = \App\Models\Setting::first();
        return response()->json($settings);
    }

    public function blog()
    {
        $blog = \App\Models\Blog::get();
        return response()->json($blog);
    }

    public function contact(Request $request) {

        $data = $request->all();
        \App\Models\Message::create($data);
        return response()->json([ 'status' => 'success' , 'message' => 'Message sent successfully']);

    }

    public function listYourCar() {
        $content = \App\Models\Content::where('type','listcar')->first();
        $faq     = \App\Models\Faq::where('type','listcar')->get();
        return response()->json([ 'content' => $content , 'faq' => $faq ]);
    }

    public function countries() {
        $countries = \App\Models\Country::get();
        return response()->json($countries);
    }

    public function cities($id) {
        $cities = \App\Models\City::where('country_id',$id)->get();
        return response()->json($cities);
    }

    public function currencies() {
        $currencies = \App\Models\Currency::get();
        return response()->json($currencies);
    }

}
