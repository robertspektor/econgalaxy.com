<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\multiselect;

class ExportChangedFiles extends Command
{
    protected $signature = 'export:changed-files
                            {--path=app : Basisverzeichnis}
                            {--since=1 day ago : Zeitfilter}
                            {--ext=php : Dateiendung}
                            {--all : Alle Dateien im Pfad (ignoriert --since)}
                            {--everything : Exportiere alle relevanten Projektdateien}';

    protected $description = 'Exportiert ausgewählte Dateien mit statischen und dynamischen Anweisungen.';

    public function handle()
    {
        $includeAll = $this->option('all');
        $includeEverything = $this->option('everything');
        $userPrompt = $this->ask('Optionaler Prompt (frei lassen für keinen)');

        $files = collect();

        if ($includeEverything) {
            $targets = [
                'app/Models',
                'app/Http/Livewire',
                'app/Services',
                'database/migrations',
            ];

            foreach ($targets as $dir) {
                if (is_dir(base_path($dir))) {
                    $finder = (new Finder())->files()->in(base_path($dir))->name('*.php');
                    $files = $files->merge(iterator_to_array($finder));
                }
            }

            $selected = $files
                ->map(fn ($file) => str_replace(base_path() . '/', '', $file->getRealPath()))
                ->unique()
                ->values()
                ->toArray();
        } else {
            $path = base_path($this->option('path'));
            $ext = $this->option('ext');

            $finder = (new Finder())
                ->files()
                ->in($path)
                ->name("*.$ext");

            if (!$includeAll) {
                $since = strtotime($this->option('since'));
                $finder->filter(fn ($file) => $file->getMTime() >= $since);
            }

            $files = collect(iterator_to_array($finder));

            if ($files->isEmpty()) {
                $this->info('Keine passenden Dateien gefunden.');
                return;
            }

            $choices = $files
                ->map(fn ($file) => str_replace(base_path() . '/', '', $file->getRealPath()))
                ->unique()
                ->values()
                ->toArray();

            $selected = multiselect(
                label: 'Wähle die Dateien, die exportiert werden sollen',
                options: $choices,
                required: true
            );
        }

        $timestamp = now()->format('Ymd_His');
        $exportPath = storage_path("exports/export_{$timestamp}.txt");
        File::ensureDirectoryExists(dirname($exportPath));

        $header = <<<EOT
/**
 * Instructions:
 * - Comments must be in English
 * - Focus only on relevant business logic
 * - Generate complete files
 * - Suggest improvements if applicable
EOT;

        if ($userPrompt) {
            $header .= "\n *\n * User prompt:\n * " . wordwrap($userPrompt, 75, "\n * ");
        }

        $header .= "\n */\n\n";

        $fileContent = collect($selected)->map(function ($relativePath) {
            $fullPath = base_path($relativePath);
            return "// $relativePath\n" . File::get($fullPath) . "\n";
        })->implode("\n");

        File::put($exportPath, $header . $fileContent);

        $this->info("Export abgeschlossen: {$exportPath}");
    }
}
