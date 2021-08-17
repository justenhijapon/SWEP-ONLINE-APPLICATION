<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\SidenavComposer');

        // USERMENU
        View::composer('layouts.admin-master', 'App\Core\ViewComposers\SidenavComposer');

        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');
        

        // MILLS
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit',
                        'dashboard.sugar_analysis.report',
                        'printables.sugar_analysis.summary_of_raw_sugar_analyses'], 'App\Core\ViewComposers\MillComposer');
        

        // SUGAR SERVICES
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit',
                        'dashboard.sugar_sample.create',
                        'dashboard.sugar_sample.edit'], 'App\Core\ViewComposers\SugarServiceComposer');
        

        // SUGAR SAMPLE
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit',
                        'dashboard.sugar_order_of_payment.index',
                        'dashboard.sugar_analysis.index',
                        'dashboard.sugar_analysis.report'], 'App\Core\ViewComposers\SugarSampleComposer');
        

        // SUGAR SAMPLE PARAMETER
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit'], 'App\Core\ViewComposers\SugarSampleParameterComposer');
        

        // SUGAR CLIENT PARAMETER
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit'], 'App\Core\ViewComposers\SugarClientComposer');

        
    }

    



    public function register(){

    
    }





}
