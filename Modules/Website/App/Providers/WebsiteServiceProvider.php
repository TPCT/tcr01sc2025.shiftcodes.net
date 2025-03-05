<?php

namespace Modules\Website\App\Providers;

use App\Models\City;
use App\Models\Currency;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use \Modules\Website\App\Services\SettingsService;
use \Modules\Website\App\Services\CarsService;
use \Modules\Website\App\Services\CountryService;
use \Modules\Website\App\Http\Middleware\Language;
use \Modules\Website\App\Http\Middleware\CustomerAuth;
use \Modules\Website\App\Http\Middleware\Country;
use \Modules\Website\App\Http\Middleware\Currencies;
use \Modules\Website\App\Http\Middleware\CheckUrlClean;
use \Modules\Website\App\Services\CurrencyService;

class WebsiteServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Website';

    protected string $moduleNameLower = 'website';

    /**
     * Boot the application events.
     */
    public function boot(\Illuminate\Routing\Router $router): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $router->aliasMiddleware('language', Language::class);
        $router->aliasMiddleware('customer-auth', CustomerAuth::class);
        $router->aliasMiddleware('country', Country::class);
        $router->aliasMiddleware('currency', Currencies::class);

//        app('country')->setCountry(session('country_id', \App\Models\Country::whereDefault(true)->first()->id));
//        app('country')->setCity(session('city_id', City::whereDefault(true)->first()->id));
//        app('currencies')->setCurrency(session('currency_id', Currency::whereDefault(true)->first()->id));

//        URL::defaults(['country' => app('country')->getCountry()->slug, 'city' => app('country')->getCity()->slug]);

    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton("settings", function ($app) {
            $settings  = \App\Models\Setting::first();
            $countries = \App\Models\Country::all(); 
            return new SettingsService($settings, $countries);
        });
        $this->app->singleton("cars", function ($app) {
            return new CarsService();
        });
        $this->app->singleton("country", function ($app) {
            return new CountryService();
        });
        $this->app->singleton("currencies", function ($app) {
            return new CurrencyService();
        });
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
