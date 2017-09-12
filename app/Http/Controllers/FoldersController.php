<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Folder;
use App\Image;

use Auth;

use Response;
use File;

class FoldersController extends Controller
{

    public function AllFolders()
    {
        return [
            'folders' => Folder::all(),
        ];
    }

    public function CreateFolder(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3|unique:folders'
        ]);
        $folder = new Folder();
        $folder->name = $request->name;
        $folder->user_id = Auth::user()->id;
        $folder->save();
        if ($folder) {
            $path = public_path().'/folders/' . $request->name;
            File::makeDirectory($path, $mode = 0777, true, true);
            return [
                'folder' => $folder,
            ];
        }
        return Response::json(['message' => 'There Was Some Error'], 422);
    }


    public function UploadImages(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image',
            'folderid' => 'required|integer',
        ]);
        $folder = Folder::find($request->folderid);
        if (!$folder) {
            return redirect('/');
        }

        $image = new Image();
        $image->image = $this->upload($request->file, 'folders/' . $folder->name);
        $image->folder_id = $folder->id;
        $image->user_id = Auth::user()->id;
        $image->save();
        return Response::json($image, 200);
    }

    public function getFolderImages($id)
    {
        $folder = Folder::find($id);
        if (!$folder) {
            return redirect('/');
        }
        $images = Image::where('folder_id', $folder->id)->where('user_id', Auth::user()->id)->get();

        return [
            'images' => $images,
        ];
    }

    public function upload($file, $pathUpload) {
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha1.".".$extension;
        $path = public_path($pathUpload);
        $file->move($path, $filename);
        return $pathUpload.'/'.$filename;
    }


}
