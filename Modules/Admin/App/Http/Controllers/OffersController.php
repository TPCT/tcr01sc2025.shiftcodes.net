<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OffersController extends Controller
{

    public function index()
    {
        return view('admin::offers.index');
    }


    public function update(Request $request): RedirectResponse
    {
        $company  = auth()->user()->company;
        $sections = $company->sections;
        
        foreach ($sections as $section) {
            $max = $section->pivot->max;
            if(isset($request->section[$section->id])) {
                $cars  = $request->get('section')[$section->id];

                if(count($cars) > $max) {
                    return redirect()->back()->withErrors(["لقد تجاوزت الحد الأقصى لعدد السيارات المسموحة في القسم " . $section->title]);
                }
                $section->cars()->wherePivot('company_id', $company->id)->detach();

                foreach ($cars as $car) {
                    $section->cars()->attach($car, ["company_id" => $company->id]);
                }
              
            }else {
                $section->cars()->wherePivot('company_id', $company->id)->detach();

            }

        }
        return redirect()->back()->with('success', 'تم تحديث العروض بنجاح');
    }

 
}
