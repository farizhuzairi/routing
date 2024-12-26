<?php

namespace Hascha\Routing\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Hascha\BaseTheme\Support\ThemeClass;

class RouteDataServiceInstall extends Command
{
    protected $signature = 'routing:data-install';
    protected $description = 'Enumeration Router installed.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->addRouterClass();
        $this->addPageableDataClass();

        $this->info("The Route Data Service has been successfully installed in the App directory.");
        return Command::SUCCESS;
    }

    private function addRouterClass(): void
    {
        $className = "Router";
        $directory = base_path('app/Routing');
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $stubPath = base_path('vendor/farizhuzairi/routing/stubs/router.stub');
        if (!$stubPath || !File::exists($stubPath)) {
            $this->error("Stub file does not exist at path $stubPath.");
            return;
        }

        $stubContent = File::get($stubPath);
        $content = str_replace('{{ className }}', $className, $stubContent);

        $filePath = $directory . '/' . $className . '.php';
        File::put($filePath, $content);
    }

    private function addPageableDataClass(): void
    {
        $className = "PageableData";
        $directory = base_path('app/Routing');
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $stubPath = base_path('vendor/farizhuzairi/routing/stubs/pageable-data.stub');
        if (!$stubPath || !File::exists($stubPath)) {
            $this->error("Stub file does not exist at path $stubPath.");
            return;
        }

        $stubContent = File::get($stubPath);
        $content = str_replace('{{ className }}', $className, $stubContent);

        $filePath = $directory . '/' . $className . '.php';
        File::put($filePath, $content);
    }
}
