<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeRoute extends Command
{
    protected $signature = 'make:route {name} {type=web}';
    protected $description = 'Generate a route file under routes/web or routes/api';

    public function handle(): void
    {
        $type = $this->argument('type');  // web or api
        $name = $this->argument('name');

        if (!in_array($type, ['web', 'admin', 'api'])) {
            $this->error("Route type must be 'web' or 'api'.");
            return;
        }

        $directory = base_path("routes/{$type}");
        $filePath = "{$directory}/" . Str::kebab($name) . '.php';

        // Ensure folder exists
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Check if file exists
        if (file_exists($filePath)) {
            $this->error("Route file already exists: {$filePath}");
            return;
        }

        // Default content
        $stub = <<<EOT
            <?php

            use Illuminate\Support\Facades\Route;

            /*
            |--------------------------------------------------------------------------
            | {$type} Routes - {$name}
            |--------------------------------------------------------------------------
            |
            | Here you can define {$type} routes for the {$name} module.
            |
            */
            Route::prefix('{$name}')->name('{$name}.')->group(function () {
            // type route here....
            });
            EOT;

        file_put_contents($filePath, $stub);

        $this->info("Route file created: {$filePath}");
    }
}
