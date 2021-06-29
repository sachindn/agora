<?php
namespace Codiant\Agora;

use Illuminate\Support\ServiceProvider;

class AgoraServiceProvider extends ServiceProvider
{
        
    /**
     * Method boot
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/config/agora.php' => config_path('agora.php'),
            ],
            'config'
        );
    }
    
    /**
     * Method register
     *
     * @return void
     */
    public function register()
    {
    }
}