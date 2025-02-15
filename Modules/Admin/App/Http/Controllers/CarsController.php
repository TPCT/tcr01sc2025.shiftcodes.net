<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Car;

class CarsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:cars']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type  = request()->get('type') ? request()->get('type') : 'default';
        $data = Car::with("company","brand","model","types","features")->where(function($query) use ($type) {
            if (request()->has('search') && request()->search != '') {
                $query->where('name', 'like', '%' . request()->search . '%');
            }
            if(request()->get('status')) {
                $query->where('status',request()->get('status'));
            }
            if(request()->get('company_id')) {
                $query->where('company_id',request()->get('company_id'));
            }
            if(request()->get('brand_id')) {
                $query->where('brand_id',request()->get('brand_id'));
            }
            if(request()->get('type_id')) {
                $query->whereHas('types', function($q) {
                    $q->whereIn('car_types.type_id', [request()->get('type_id')]);
                });
            }
            if(auth()->user()->type == "user") {
                $query->where('company_id',auth()->user()->company->id);
            }
            $query->where('type',$type);
        })->orderBy("id","desc")->paginate(10);
        return view('admin::cars.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->type == "user") {
            if(auth()->user()->company->getAvailableCars() <= 0) {
                return redirect()->back()->withErrors(["لقد استنفذت عدد السيارات المتاحة للإضافة"]);
            }
        }
        return view('admin::cars.create');
    }

    public function getModels($brand_id)
    {
        $models = \App\Models\Models::where('brand_id', $brand_id)->get();
        foreach($models as $model) {
            $model->name = $model->getTranslation("title", \App::getLocale());
        }
        return response()->json($models);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
        }
        $data['customer_notes'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['customer_notes'][$key] = $request->get("customer_notes_" . $key);
        }
        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description'][$key] = $request->get("description_" . $key);
        }
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }
        if(auth()->user()->type == "admin") {
            $data['status'] = 'active';
            $data['is_publish'] = 1;
        }else {
            $data['status'] = 'pending';
            $data['is_publish'] = 0;
        }
        $data['type'] = $request->type;
        $car = Car::create($data);
        $car->features()->sync($request->get('feature_id'));
        $car->types()->sync($request->get('type_id'));
        if($request->hasFile('files')) {
            foreach($request->file('files') as $file) {
                $car->images()->create(['image' => $file->store('cars', 'public')]);
            }
        }

        if($car->type != "default") {
            $resource = "car";
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->create($request, $resource, $car->id);
            $content->updateFaq($request, $resource, $car->id);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $car = Car::with("company","brand","model","images","features","types")->find($id);
        return view('admin::cars.edit')->with([
            "car" => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        $data = $request->all();
        $data['name'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
        }
        $data['customer_notes'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['customer_notes'][$key] = $request->get("customer_notes_" . $key);
        }
        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description'][$key] = $request->get("description_" . $key);
        }
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }
        if (isset($request->is_day_offer) && $request->is_day_offer == "on") {
            $data['is_day_offer'] = "1";
        } else {
            $data['is_day_offer'] = "0";
        }

        if(auth()->user()->type == "user") {
            $data['status'] = 'pending';
        }

        $car->update($data);
        $car->features()->sync($request->get('feature_id'));
        $car->types()->sync($request->get('type_id'));
        if($request->hasFile('files')) {
            foreach($request->file('files') as $file) {
                $car->images()->create(['image' => $file->store('cars', 'public')]);
            }
        }
        if($car->type != "default") {
        $resource = "car";
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request,
        \App\Models\Content::where('type',$resource)->where('resource_id',$id)->first(),
        \App\Models\SEO::where('type',$resource)->where('resource_id',$id)->first()
        );
        $content->updateFaq($request, $resource, $id);
    }

        return response()->json(['status' => 'success']);
    }

    public function refreshCars(Request $request) {
        $car_ids = $request->get('cars');
        $cars    = Car::whereIn('id', $car_ids)->get();
        foreach($cars as $car) {
            if(auth()->user()->type == "user" && auth()->user()->company->id != $car->company_id) {
                abort(403);
            }
            if($car->company->getAvailableRefreshCars() <= 0) {
                return redirect()->back()->withErrors(["لقد استنفذت عدد السيارات المتاحة للتحديث"]);
            }
            $car->is_refresh = 1;
            $car->refreshed_at = now();
            $car->save();
            $car->company->refreshes()->create([
                'car_id' => $car->id
            ]);
        }
        return redirect()->back()->withSuccess("تم تحديث السيارات بنجاح");

    }

    public function refreshSingleCar($id) {
        $car = Car::find($id);
        if(auth()->user()->type == "user" && auth()->user()->company->id != $car->company_id) {
            abort(403);
        }
        if($car->company->getAvailableRefreshCars() <= 0) {
            return redirect()->back()->withErrors(["لقد استنفذت عدد السيارات المتاحة للتحديث"]);
        }
        $car->is_refresh = 1;
        $car->refreshed_at = now();
        $car->save();

        $car->company->refreshes()->create([
            'car_id' => $car->id
        ]);
        // if($car->refreshed_at == null) {
        //     $car->is_refresh = 1;
        //     $car->refreshed_at = now();
        //     $car->save();
        // }
        return redirect()->back()->withSuccess("تم تحديث السيارة بنجاح");
    }

    public function deleteImage($id)
    {
        $image = \App\Models\CarImage::find($id);
        $image->delete();
        return redirect()->back()->withSuccess("تم حذف الصورة بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        if(auth()->user()->type == "user" && auth()->user()->company->id != $car->company_id) {
            abort(403);
        }
        $car->features()->detach();
        $car->types()->detach();
        $car->images()->delete();
        $car->delete();
        return redirect()->back()->withSuccess("تم الحذف بنجاح");
    }

    public function toggleStatus($id)
    {
        if(auth()->user()->type != "admin") {
            abort(403);
        }
        $car = Car::find($id);
        if($car->status == "active") {
            $car->status = "pending";
        }else {
            $car->status = "active";
        }
        $car->save();
        return redirect()->back()->withSuccess("تم تغيير الحالة بنجاح");
    }

    public function toggleVisibility($id)
    {
        $car = Car::find($id);
        if($car->status != "active") {
            abort(403);
        }
        if($car->is_publish == 1) {
            $car->is_publish = 0;
        }else {
            $car->is_publish = 1;
        }
        $car->save();
        return redirect()->back()->withSuccess("تم تغيير حالة العرض");
    }
}
