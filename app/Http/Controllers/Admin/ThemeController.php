<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use ZipArchive;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = [];
        $themeDirectories = File::directories(resource_path('views/themes'));

        foreach ($themeDirectories as $themedir) {
            $themeName = basename($themedir);
            $jsonFile = $themedir . '/' . $themeName . '.json';

            if (File::exists($jsonFile)) {
                $themeData = json_decode(File::get($jsonFile), true);
                $themeData['directory'] = $themeName;

                // Set the thumbnail URL
                if (isset($themeData['thumbnail'])) {
                    $themeData['thumbnail_url'] = asset('themes/' . $themeName . '/' . $themeData['thumbnail']);
                } else {
                    $themeData['thumbnail_url'] = asset('images/default-thumbnail.png');
                }

                $themes[] = $themeData;
            }
        }

        return view('dashboard.pages.theme.theme')->with(['themes' => $themes]);
    }

    public function preview($slug)
    {
        $view = "theme::$slug.demo.index";

        $this->copyHtmlToBladeIfNotExists($slug);

        if (view()->exists($view)) {
            return view($view);
        } else {
            return redirect()->back()->with(
                [
                    'error' => 'Check Theme Installation: Ensure that the theme is correctly installed',
                    'slug' => $slug,
                ]
            );
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'theme_zip' => 'required|file|mimes:zip|max:20480', // 20MB max file size
        ]);

        // Define the path to store and extract the uploaded theme ZIP
        $destinationPath = resource_path('views/themes');

        // Handle the uploaded file
        if ($request->hasFile('theme_zip')) {
            $file = $request->file('theme_zip');
            $filename = $file->getClientOriginalName();
            $filePath = $destinationPath . '/' . $filename;

            // Move the uploaded file to the destination folder
            $file->move($destinationPath, $filename);

            // Initialize ZipArchive to extract the ZIP file
            $zip = new ZipArchive;
            if ($zip->open($filePath) === TRUE) {
                // Extract the zip file into the destination path
                $zip->extractTo($destinationPath);
                $zip->close();

                // Optionally, delete the uploaded ZIP file after extraction
                unlink($filePath);

                Artisan::call('theme:publish-assets');

                return response()->json(['success' => true, 'message' => 'File uploaded and extracted successfully!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to open ZIP file!'], 500);
            }
        }

        return response()->json(['success' => false, 'message' => 'File upload failed!'], 500);
    }

    private function copyHtmlToBladeIfNotExists($slug)
    {
        $viewPath = resource_path('views/theme/' . $slug . '/demo/');

        if (is_dir($viewPath)) {
            if (!file_exists($viewPath . 'index.blade.php')) {
                if (file_exists($viewPath . 'index.html')) {
                    copy($viewPath . 'index.html', $viewPath . 'index.blade.php');
                }
            }
        } else {
            return;
        }
    }
}
