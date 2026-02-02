<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application as IlluminateApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function show(
        Request $request,
        int $applicationId
    ): IlluminateApplication|Response|ResponseFactory {
        $application = Application::query()->firstWhere('id', $applicationId);

        $storagePath = storage_path('app')  . '/private/' . $application->document;
        $file = File::get($storagePath);
        $type = File::mimeType($storagePath);
        $response = response($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}
