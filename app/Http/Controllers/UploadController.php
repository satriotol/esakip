<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->image;
            $filename = date('Ymd_His') . '-' . $image->getClientOriginalName();
            $data['image'] = $image->storeAs('file', $filename, 'public_uploads');
            return $data['image'];
        };
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $file_name = date('mdYHis') . '-' . Str::random(8) . '.' . $extension;
            $file = $file->storeAs('file', $file_name, 'public_uploads');
            return $file;
        };
        return 'success';
    }
    public function revert(Request $request)
    {
    }
}
