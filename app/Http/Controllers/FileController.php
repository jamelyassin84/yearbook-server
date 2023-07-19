<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Url;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');

        $maxSize = 2048;

        if ($file->getSize() > $maxSize * 1024) {
            return response()->json(['error' => 'File size exceeds the maximum allowed size.'], 400);
        }

        $fileName = uniqid()  . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('public/files', $fileName);

        $uploadedFile = new File();
        $uploadedFile->name = $fileName;
        $uploadedFile->path = $storedPath;
        $uploadedFile->url = url(Storage::url($storedPath));
        $uploadedFile->extension = $file->getClientOriginalExtension();
        $uploadedFile->mime_type = $file->getClientMimeType();
        $uploadedFile->size = $file->getSize();
        $uploadedFile->save();

        return response()->json($uploadedFile);
    }
}
