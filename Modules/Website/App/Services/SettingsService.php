<?php 
namespace Modules\Website\App\Services;

class SettingsService
{
    public $settings;
    public $countries = [];

    public function __construct($settings, $countries)
    {
        $this->settings = $settings;
        $this->countries = $countries;
    }

    public function get($key)
    {
        return $this->settings[$key] ?? null;
    }

    public function getHeaderPages() {
        $pages = \App\Models\Page::where('show_header', 1)->get();
        return $pages;
    }

    public function getRentCarPages() {
        $pages = \App\Models\Page::where('show_rent_car', 1)->get();
        return $pages;
    }


    public function getFooterPages() {
        $pages = \App\Models\Page::where('show_footer', 1)->get();
        return $pages;
    }
}
