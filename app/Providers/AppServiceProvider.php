<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\VoterPolicy;
use Carbon\CarbonImmutable;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Gate::policy(User::class, VoterPolicy::class);

        $this->registerFilamentAssets();

        $this->configureDefaults();
    }

    /**
     * Register custom Filament assets compiled by Vite.
     */
    protected function registerFilamentAssets(): void
    {
        $entry = 'resources/css/filament/election-results.css';

        $manifestPath = public_path('build/manifest.json');

        if (is_file(public_path('hot'))) {
            // Vite dev server resolves entries without a build manifest.
            FilamentAsset::register([
                Css::make('election-results', Vite::asset($entry))
                    ->loadedOnRequest(),
            ]);

            return;
        }

        if (
            is_file($manifestPath) &&
            array_key_exists($entry, (array) json_decode((string) file_get_contents($manifestPath), true))
        ) {
            FilamentAsset::register([
                Css::make('election-results', Vite::asset($entry))
                    ->loadedOnRequest(),
            ]);
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
