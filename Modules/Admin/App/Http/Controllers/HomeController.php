<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Helpers\Utilities;
use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function switchLang(Request $request): RedirectResponse
    {
        \Cookie::queue(\Cookie::make('admin_lang', app()->getLocale(), 60*24*30));
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->middleware(['permission:home']);

        if (auth()->user()->type == "admin") {
            $total_phone = $this->getActionsByType('phone', request()->get('period'));
            $total_whatsapp = $this->getActionsByType('whatsapp', request()->get('period'));
            $total_email = $this->getActionsByType('email', request()->get('period'));
            $actions = \App\Models\Action::with("company", "car")->orderBy('id', 'desc')->paginate(10);
            $companies = \App\Models\Company::withCount('actions')->orderBy('actions_count', 'desc')->paginate(10);
            return view('admin::home.index')->with([
                'total_phone' => $total_phone,
                'total_whatsapp' => $total_whatsapp,
                'total_email' => $total_email,
                'actions' => $actions,
                "companies" => $companies
            ]);
        }

        $company = auth()->user()->company;
        $period = \request('period');
        $data['cars_count'] = $company->getCarsCount() . " / " . $company->getCarsLimit();
        $data['refresh_count'] = $company->getRefreshCarsCount() . " / " . $company->getRefreshLimit();
        $data['visits'] = $company->getViewsCount($period);
        $data['phone'] = $company->getActionsByType('phone', $period);
        $data['whatsapp'] = $company->getActionsByType('whatsapp', $period);
        $data['email'] = $company->getActionsByType('email', $period);
        $data['actions'] = $company->
        actions()->selectRaw("
              DATE(created_at) as date,
              COUNT(CASE WHEN type = 'phone' THEN 1 END) AS phone,
              COUNT(CASE WHEN type = 'email' THEN 1 END) AS email,
              COUNT(CASE WHEN type = 'whatsapp' THEN 1 END) AS whatsapp
            ")
            ->groupBy(DB::raw("DATE(created_at)"))
            ->orderBy('date', 'desc');

        if ($period){
            [$start_date, $end_date] = Utilities::parsePeriod($period);
            $data['actions'] = $data['actions']
            ->whereBetween('created_at', [$start_date, $end_date]);
        }

        $data['actions'] = $data['actions']->paginate();

        return view('admin::home.index', $data);
    }

    public static function getActionsByType($type, $period) {
        if($period != null) {
            [$start_date, $end_date] = Utilities::parsePeriod($period);
            return \App\Models\Action::where('type', $type)->whereBetween('created_at', [$start_date, $end_date])->count();
        }else {
            return \App\Models\Action::where('type', $type)->count();
        }
    }

}
