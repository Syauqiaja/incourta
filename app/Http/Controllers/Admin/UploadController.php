<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Upload image file
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Generate unique filename
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                
                // Store in public/uploads/events directory
                $path = $file->storeAs('uploads/events', $filename, 'public');
                
                return response()->json([
                    'success' => true,
                    'message' => 'Image uploaded successfully',
                    'path' => $path,
                    'url' => Storage::url($path)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete uploaded image
     */
    public function deleteImage(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            if (Storage::disk('public')->exists($request->path)) {
                Storage::disk('public')->delete($request->path);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
