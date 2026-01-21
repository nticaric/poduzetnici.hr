<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        View::share('appVersion', $this->getAppVersion());
    }

    /**
     * Get the application version from composer.json.
     */
    private function getAppVersion(): string
    {
        $composerPath = base_path('composer.json');

        if (file_exists($composerPath)) {
            $composer = json_decode(file_get_contents($composerPath), true);

            return $composer['version'] ?? '0.0.0';
        }

        return '0.0.0';
    }
}
