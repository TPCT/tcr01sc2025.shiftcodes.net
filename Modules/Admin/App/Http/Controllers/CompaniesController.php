<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company;
use App\Models\User;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:offices'])->except(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = request()->get('type') ? request()->get('type') : 'default';

        $data = Company::where(function($query) use ($type) {
            if(request()->has('search')) {
                $query->where('name', 'like', '%' . request()->search . '%');
            }
            $query->where('type', $type);
        })->orderBy('id', 'desc')->paginate(10);
        return view('admin::companies.index')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!request()->get('type')) {
            abort(404);
        }
        return view('admin::companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            "owner_username" => "required|unique:users,username",
            "password" => "required",
            "owner_name"     => "required",
        ],[
            "owner_username.required" => "اسم المستخدم مطلوب",
            "owner_username.unique"   => "اسم المستخدم موجود مسبقا",
            "owner_password.required" => "كلمة المرور مطلوبة",
            "owner_name.required"     => "اسم صاحب المكتب مطلوب",
        ]);

        $data = $request->all();

        $user = new User;
        $user->name = $data['owner_name'];
        $user->username = $data['owner_username'];
        $user->password = bcrypt($data['password']);
        $user->email    = $data['owner_email'];
        $user->type     = "user";
        $user->save();

        $user->givePermissionTo("home");
        $user->givePermissionTo("cars");

        $data['name'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
        }

        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description'][$key] = $request->get("description_" . $key);
        }

        if($request->has('image')){
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        $data['user_id'] = $user->id;

        $company = Company::create($data);

        $company->cities()->sync($request->city_id);
        if($company->type == "default") {
            $company->types()->sync($request->type_id);
        }
        
      

        foreach(\App\Models\Section::all() as $section) {
            if($request->get("section_max_" . $section->id , 0) >= 0 ) {
                $company->sections()->sync([$section->id => ["max" => $request->get("section_max_" . $section->id , 0)] ], false);
            }
        }

        // $content = new \Modules\Admin\App\Services\ContentService();
        // $content->create($request, 'company', $company->id);
        // $content->updateFaq($request, "company", $company->id);

        return redirect("/admin/companies?type=" . $data['type'])->withSuccess("تم حفظ التغييرات بنجاح");
    

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
        $company = Company::find($id);
        if(!$company) {
            abort(404);
        }
        if(auth()->user()->type == "user" && auth()->user()->company->id != $company->id) {
            abort(403);
        }

        return view('admin::companies.edit')->with([
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $company = Company::find($id);
        if(!$company) {
            abort(404);
        }
        if(auth()->user()->type == "user" && auth()->user()->company->id != $company->id) {
            abort(403);
        }
        $request->validate([
            "owner_username" => "required",
            "password" => "required",
            "owner_name"     => "required",
        ],[
            "owner_username.required" => "اسم المستخدم مطلوب",
            "owner_username.unique"   => "اسم المستخدم موجود مسبقا",
            "owner_password.required" => "كلمة المرور مطلوبة",
            "owner_name.required"     => "اسم صاحب المكتب مطلوب",
        ]);

        $data = $request->all();

        $user = User::find($company->user_id);

        if($user->username != $data['owner_username']) {
            $request->validate([
                "owner_username" => "unique:users,username",
            ],[
                "owner_username.unique"   => "اسم المستخدم موجود مسبقا",
            ]);
        }
        $user->name = $data['owner_name'];
        $user->username = $data['owner_username'];
        $user->password = bcrypt($data['password']);
        $user->email    = $data['owner_email'];
        $user->save();

        $data['name'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
        }
        $data['description'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['description'][$key] = $request->get("description_" . $key);
        }
        $data['terms'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['terms'][$key] = $request->get("terms_" . $key);
        }
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        $company->update($data);

        $company->cities()->sync($request->city_id);
        $company->types()->sync($request->type_id);

        foreach(\App\Models\Section::all() as $section) {
            if($request->get("section_max_" . $section->id , 0) >= 0 ) {
                $company->sections()->sync([$section->id => ["max" => $request->get("section_max_" . $section->id , 0)] ], false);
            }
        }


        $days = \App\Models\Company::$days;
        foreach($days as $day) {
            $hour = $company->hours()->where('day', $day)->first();
            if($hour) {
                $hour->update([
                    'type' => $request->get("type_" . $day),
                    'time_from' => $request->get("time_from_" . $day),
                    'time_to' => $request->get("time_to_" . $day),
                ]);
            } else {
                $company->hours()->create([
                    'day' => $day,
                    'type' => $request->get("type_" . $day),
                    'time_from' => $request->get("time_from_" . $day),
                    'time_to' => $request->get("time_to_" . $day),
                ]);
            }

        }

        $payment_methods = $request->payment_methods;
        if($payment_methods) {
            $company->payment_methods = implode(",", $payment_methods);
            $company->save();
        }else {
            $company->payment_methods = "";
            $company->save();
        }

        // $content = new \Modules\Admin\App\Services\ContentService();
        // $content->update($request, 
        // \App\Models\Content::where('type','company')->where('resource_id',$id)->first(),
        // \App\Models\SEO::where('type','company')->where('resource_id',$id)->first()
        // );
        // $content->updateFaq($request, "company", $id);

        return redirect()->back()->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->user()->delete();
        $company->cars()->delete();
        $company->delete();
        return redirect("/admin/companies")->withSuccess("تم حذف العنصر بنجاح");
    }
}
