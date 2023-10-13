<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
      

            try {
                $language = Setting::where('slug', 'default_language')->first();
                if ($language) {
                    $locale = $language->value;

                    $lang = Language::where('locale', $locale)->first();
                    session(['APP_LOCALE' => $locale, 'lang_dir' => $lang->direction]);

                }
            } catch (\Exception $e) {
                //
            }

       

$tableName = 'menus'; // Replace with the actual table name

if (DB::connection()->getSchemaBuilder()->hasTable($tableName)) {
    $all_menus = Menu::where('is_static', INACTIVE)->with('submenus')->latest()->get();
    $allsettings = allsetting();
    view()->share(['all_menus' => $all_menus, 'allsettings' => $allsettings]);
}
        
    }
}
