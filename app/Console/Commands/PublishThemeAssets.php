<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishThemeAssets extends Command
{
    protected $signature = 'theme:publish-assets';

    protected $description = 'Publish theme assets to the public directory';

    public function handle()
    {
        $themesDir = resource_path('views/themes');
        $publicThemesDir = public_path('themes');

        // Create the public/themes directory if it doesn't exist
        if (!File::exists($publicThemesDir)) {
            File::makeDirectory($publicThemesDir, 0755, true);
        }

        // Get the list of theme directories
        $themes = File::directories($themesDir);

        foreach ($themes as $themePath) {
            $themeName = basename($themePath);
            $sourcePath = $themePath;
            $destinationPath = $publicThemesDir . '/' . $themeName;

            // Create the destination theme directory if it doesn't exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Copy the thumbnail image
            $this->copyThumbnail($themePath, $destinationPath, $themeName);

            // Copy all files inside the 'assets' folder
            $this->copyAssets($themePath, $destinationPath, $themeName);
        }

        $this->info("Theme assets have been published successfully!");
    }

    private function copyThumbnail($sourcePath, $destinationPath, $themeName)
    {
        // Read the theme's JSON configuration
        $jsonFile = $sourcePath . '/' . $themeName . '.json';
        if (File::exists($jsonFile)) {
            $themeConfig = json_decode(File::get($jsonFile), true);

            // Get the thumbnail file name from the configuration
            if (isset($themeConfig['thumbnail'])) {
                $thumbnailFile = $themeConfig['thumbnail'];

                $sourceFile = $sourcePath . '/' . $thumbnailFile;
                $destinationFile = $destinationPath . '/' . basename($thumbnailFile);

                if (File::exists($sourceFile)) {
                    File::copy($sourceFile, $destinationFile);
                    $this->info("Copied thumbnail {$thumbnailFile} for theme: {$themeName}");
                } else {
                    $this->warn("Thumbnail {$thumbnailFile} not found for theme: {$themeName}");
                }
            } else {
                $this->warn("No thumbnail specified in configuration for theme: {$themeName}");
            }
        } else {
            $this->warn("Configuration file not found for theme: {$themeName}");
        }
    }

    private function copyAssets($sourcePath, $destinationPath, $themeName)
    {
        $assetsSourcePath = $sourcePath . '/assets';
        $assetsDestinationPath = $destinationPath;

        if (File::exists($assetsSourcePath)) {
            // Copy the entire assets directory
            File::copyDirectory($assetsSourcePath, $assetsDestinationPath);
            $this->info("Copied assets for theme: {$themeName}");
        } else {
            $this->warn("Assets directory not found for theme: {$themeName}");
        }
    }
}
