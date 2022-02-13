<?php

namespace App\Providers\ViewServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AsideProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['components.dashboard.aside.list'], function ($view) {
            # Beranda
            $home = request()->routeIs('home') ?
                [
                    'link' => 'active'
                ] : [
                    'link' => ''
                ];

            # Postingan
            $blogMenu = request()->routeIs('blog.*') ? 'active' : '';
            $threadMenu = request()->routeIs('thread.*') ? 'active' : '';
            $researchMenu = request()->routeIs('research.*') ? 'active' : '';

            # Kegiatan
            $eventMenu = request()->routeIs('event.*') ? 'active' : '';
            $participantMenu = request()->routeIs('participant.*') ? 'active' : '';
            $recruitmentMenu = request()->routeIs('recruitment.*') ? 'active' : '';

            # Pengguna
            $memberMenu = request()->routeIs('member.*') ? 'active' : '';
            $divisionMenu = request()->routeIs('division.*') ? 'active' : '';
            $positionMenu = request()->routeIs('position.*') ? 'active' : '';
            $generalMenu = request()->routeIs('general.*') ? 'active' : '';

            # Pengaturan
            $administratorMenu = request()->routeIs('administrator.*') ? 'active' : '';
            $settingMenu = request()->routeIs('setting.*') ? 'active' : '';
            // $notificationMenu = request()->routeIs('notifikasi.*') ? 'active' : '';

            # Compact all data
            $view->with(compact(
                # Beranda
                'home',

                # Postingan
                'blogMenu',
                'threadMenu',
                'researchMenu',

                # Kegiatan
                'eventMenu',
                'participantMenu',
                'recruitmentMenu',

                # Pengguna
                'memberMenu',
                'divisionMenu',
                'positionMenu',
                'generalMenu',

                # Pengaturan
                'administratorMenu',
                'settingMenu'
            ));
        });
    }
}
