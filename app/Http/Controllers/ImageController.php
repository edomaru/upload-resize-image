<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreImageRequest;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function create()
    {
        return view('image.create');
    }

    public function store(StoreImageRequest $request)
    {
        $folder = "images/" . date("Y/m");

        foreach($request->file('images') as $imageFile) {
            $fielName = $this->makeUniqueFilename($imageFile);
            $image = $this->resizeImage($imageFile);
            Storage::disk('public')->put($path = $folder . '/' . $fielName, (string) $image->encode());

            Media::create([
                'file_name' => $imageFile->getClientOriginalName(),
                'mime_type' => $imageFile->getMimeType(),
                'size' => $imageFile->getSize(),
                'path' => $path
            ]);
        }

        return to_route('images.index');
    }

    protected function resizeImage(UploadedFile $imageFile)
    {
        $image = ImageManager::imagick()->read($imageFile->getRealPath());
        $image->scaleDown(320);
        return $image;
    }

    protected function makeUniqueFilename(UploadedFile $imageFile)
    {
        $originalName = $imageFile->getClientOriginalName();
        $info = pathinfo($originalName);

        return Str::slug($info['filename'])
            . "_" . time()
            . '.' . $info['extension'];
    }

    public function index()
    {
        $media = Media::all();
        return view('image.index', compact('media'));
    }
}
