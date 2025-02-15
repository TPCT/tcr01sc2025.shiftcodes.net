<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SEO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Blog;
use Modules\Admin\App\Services\SEOService;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::orderBy('id', 'desc')->paginate(10);
        return view('admin::blog.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SEOService $SEOService): RedirectResponse
    {
        $data = $request->all();
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
            $data['content'][$key] = $request->get("content_" . $key);
            $data['meta_description'][$key] = $request->get("meta_description_" . $key);
        }
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $blog = Blog::create($data);
        $SEOService->create($request, "blog", $blog);
        return redirect("/admin/blog")->with('success', 'تم اضافة المقالة بنجاح');
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
        $blog = \App\Models\Blog::with('seo')->findOrFail($id);
        return view('admin::blog.edit')->with('item', $blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, SEOService $SEOService): RedirectResponse
    {
        $data = $request->all();
        if($request->has('image')){
            $data['image'] = $request->file('image')->store('blog', 'public');
        }
        $data['title'] = [];
        $data['content'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['title'][$key] = $request->get("title_" . $key);
            $data['content'][$key] = $request->get("content_" . $key);
            $data['meta_description'][$key] = $request->get("meta_description_" . $key);

        }
        $blog = Blog::with('seo')->findOrFail($id);
        $blog->update($data);
        $SEOService->update($request, $blog->seo);

        return redirect("/admin/blog")->with('success', 'تم تعديل المقالة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect("/admin/blog")->with('success', 'تم حذف المقالة بنجاح');
    }
}
