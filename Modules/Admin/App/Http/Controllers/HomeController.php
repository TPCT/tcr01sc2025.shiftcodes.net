<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['permission:home']);
    // }

    public function switchLang(Request $request): RedirectResponse
    {
        if(app()->getLocale() == 'ar'){
            \Cookie::queue(\Cookie::make('admin_lang', 'en', 60*24*30));
        }else {
            \Cookie::queue(\Cookie::make('admin_lang', 'ar', 60*24*30));
        }
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->middleware(['permission:home']);

        $total_phone = $this->getActionsByType('phone', request()->get('period'));
        $total_whatsapp = $this->getActionsByType('whatsapp', request()->get('period'));
        $total_email = $this->getActionsByType('email', request()->get('period'));
        $actions = \App\Models\Action::with("company","car")->orderBy('id', 'desc')->paginate(10);
        $companies = \App\Models\Company::withCount('actions')->orderBy('actions_count', 'desc')->paginate(10);
        return view('admin::home.index')->with([
            'total_phone' => $total_phone,
            'total_whatsapp' => $total_whatsapp,
            'total_email' => $total_email,
            'actions' => $actions,
            "companies" => $companies
        ]);
    }

    public static function getActionsByType($type, $period) {
        $start_date = null;
        $end_data   = null;
        if($period == "today") {
            $start_date = now()->startOfDay();
            $end_data   = now()->endOfDay();
        }else if($period == "yesterday") {
            $start_date = now()->subDay()->startOfDay();
            $end_data   = now()->subDay()->endOfDay();
        }else if($period == "week") {
            $start_date = now()->startOfWeek();
            $end_data   = now()->endOfWeek();
        }else if($period == "month") {
            $start_date = now()->startOfMonth();
            $end_data   = now()->endOfMonth();
        }else if($period == "year") {
            $start_date = now()->startOfYear();
            $end_data   = now()->endOfYear();
        }
        if($period != null) {
            return \App\Models\Action::where('type', $type)->whereBetween('created_at', [$start_date, $end_data])->count();
        }else {
            return \App\Models\Action::where('type', $type)->count();
        }
    }

}
