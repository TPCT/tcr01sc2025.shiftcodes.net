<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Page;
use App\Models\Section;
use App\Models\Car;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $content =  \App\Models\Content::where('type',$type)->first();
        $seo     = \App\Models\SEO::where('type',$type)->first();
        if(!$content) {
            $content = new \App\Models\Content();
            $content->type = $type;
            $content->save();
        }
        if(!$seo) {
            $seo = new \App\Models\SEO();
            $seo->type = $type;
            $seo->save();
        }
        $faq = \App\Models\Faq::where('type',$type)->get();
        return view('admin::content.index',[
            'content' => $content,
            'seo'     => $seo,
            'faq'     => $faq
        ]);
    }

    public function update(Request $request, $type): RedirectResponse
    {
        $content = new \Modules\Admin\App\Services\ContentService();
        $content->update($request,
        \App\Models\Content::where('type',$type)->first(),
        \App\Models\SEO::where('type',$type)->first()
        );
        $content->updateFaq($request, $type, 0);
        return redirect()->back()->withSuccess("تم حفظ التغييرات بنجاح");
    }

    public function destroyImage($id,$number): RedirectResponse
    {
        $content = \App\Models\Content::find($id);
        if($content) {
            if($number == 1) {
                $content->update([
                    'image' => null
                ]);
            }else {
                $content->update([
                    'image_' . $number => null
                ]);
            }
        }
        return redirect()->back()->withSuccess("تم حذف الصورة بنجاح");
    }

    public function generateSitemap() {
        Sitemap::create()
        ->add(Url::create('/')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Type::all())
        ->add(Brand::all())
        ->add(Url::create('/d/cars')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Url::create('/yacht')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Company::all())
        ->add(Page::all())
        ->add(Section::all())
        ->add(Url::create('/search')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Url::create('/blog')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Url::create('/faq')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Url::create('/contact')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Url::create('/listyourcar')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1))
        ->add(Car::all())
        ->writeToFile(public_path('sitemap.xml'));
        // dd('done');
        return redirect()->back()->withSuccess("تم إنشاء خريطة الموقع بنجاح");
    }

}
