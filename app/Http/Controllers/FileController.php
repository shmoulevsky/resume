<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class FileController extends Controller
{
    public function publicUploadPhoto(Request $request){

		$input = $request->all();

		$rules = array(
		    'file' => 'image|max:8000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return response()->make($validation->errors->first(), 400);
		}
		
		$url = '/upload/images/resume';
		$file = $request->file('file');
		$extension = $file->extension();
		$fileName = sha1(time().time()).".{$extension}";

		$img = Image::make($file->path());
        $img->resize(300, 300, function ($const) {
            $const->aspectRatio();
        })->save(public_path($url).'/'.$fileName);
   
        return response()->json(['success'=> 'Y', 'name' => $fileName, 'url' => $url]);

	}
}
