<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use \App\Ator;
use \App\Nacionalidade;
use \App\Filme;

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
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('ATORES');
            $event->menu->add([
                'text'        => 'Listagem',
                'url'         => 'atores',
                'icon'        => 'fas fa-fw fa-users',
                'label'       => Ator::count(),
                'label_color' => 'success',
            ]);
            //$event->menu->add('NACIONALIDADES');
            $event->menu->add([
                'text'        => 'Listagem',
                'url'         => 'nacionalidades',
                'icon'        => 'fas fa-fw fa-flag',
                'label'       => Nacionalidade::count(),
                'label_color' => 'success',
            ]);
            $event->menu->add([
                'text'        => 'Listagem',
                'url'         => 'filmes',
                'icon'        => 'fas fa-fw fa-film',
                'label'       => Filme::count(),
                'label_color' => 'success',
            ]);
        });
    }
}
