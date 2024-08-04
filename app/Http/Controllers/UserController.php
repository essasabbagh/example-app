<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
// use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{

    public function profile(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        // Generate the full URL for the avatar
        $avatarUrl = $user->avatar ? Storage::url($user->avatar) : null;

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'avatar_url' => $avatarUrl, // Include the avatar URL
        ]);
    }

    public function getAvatar(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
    
        if ($user->avatar) {
            // Define the path to the user's avatar
            $filePath = $user->avatar;
    
            // Specify the disk you are using, e.g., 'public'
            $disk = 'public';
    
            // Debug: Log the file path and disk being used
            // Log::info('Checking file path: ' . $filePath . ' on disk: ' . $disk);
    
            // Check if the file exists on the specified disk
            if (Storage::disk($disk)->exists($filePath)) {
                // Get the full URL to the avatar
                $avatarUrl = Storage::disk($disk)->url($filePath);
    
                // Get the image content and convert it to base64
                $imageContent = Storage::disk($disk)->get($filePath);
                $base64Image = base64_encode($imageContent);
    
                return response()->json([
                    'avatar_url' => $avatarUrl,
                    'avatar_base64' => $base64Image,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Avatar file not found!',
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'User has No avatar image!',
            ], 404);
        }
    }

    public function uploadAvatar(Request $request){
     try {
        $request->validate([
            'avatar' => [
                'required',          
                'image',             
                'mimes:jpeg,png,jpg,gif', 
                'max:2048'           
            ],
        ]);

        $avatar = $request->file('avatar');

        if ($avatar){
            $manager = new ImageManager (new Driver());
            $img = $manager->read($avatar);
            $img->scaleDown(height: 250);
            $encoded = $img->toPng();   
            
            $name_gen = 'avatars/' . hexdec(uniqid()) . '.png';

            $path = Storage::disk('public')->put($name_gen, $encoded);

            // Get the authenticated user
            $user = $request->user(); 

            // Update user's avatar path in the database
            $user->avatar = $name_gen;

            $user->save();

            // Convert the encoded image to Base64
            $base64Image = base64_encode($encoded);

            return response()->json([
                'message' => 'Avatar uploaded successfully!', 
                'avatar' => $base64Image,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error no avatars were uploaded'
            ], 404);
        }

     } catch (\Throwable $th) {
        return response()->json([
            'message' => 'Error while uploading',
            'error' => $th->getMessage()
        ], 400);
     }
    }

}
