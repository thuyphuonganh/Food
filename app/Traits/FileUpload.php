<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use File;

trait FileUpload {
    public function uploadFile(UploadedFile $file, string $directory = "images") : string {
        $filename = "phone_".uniqid().'.'.$file->getClientOriginalExtension();

        $file->move(public_path($directory), $filename);
        return '/'.$directory.'/'.$filename;
    }

    public function deleteFile(string $path) {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
            return true;
        }
        return false;
    }
}
