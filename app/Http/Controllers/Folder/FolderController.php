<?php

namespace App\Http\Controllers\Folder;

use App\Services\FileService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\File\StoreFolderRequest;

use JWTAuth;

class FolderController extends Controller
{
    protected $s3Service;
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->s3Service = new FileService($this->user['access_key'], $this->user['secret_key']);
    }

    public function store(StoreFolderRequest $request)
    {
        $storeResponse = $this->s3Service->storeFolder($request->bucket, $request->prefix);
        if ($storeResponse) {
            return response()->json(['message' => $storeResponse], 403);
        }
        return response()->json(['message' => 'Create Folder Success'], 200);
    }

    public function destroy($bucket, $key)
    {
        $deleteFolder = $this->s3Service->deleteFolder($bucket, $key);
        if ($deleteFolder) {
            return response()->json(['message' => $deleteFolder], 403);
        }
        return response()->json(['message' => 'Delete File Success'], 200);
    }

    public function rename(Request $request)
    {
        $renameFolderResponse = $this->s3Service->renameFolder($request->bucket, $request->oldName, $request->newName);
        if (!$renameFolderResponse) {
            return response()->json(['message' => 'The folder is renamed']);
        } else {
            return response()->json(['message' => $renameFolderResponse], 403);
        }
    }

    public function move(Request $request)
    {
        $moveFolderResponse = $this->s3Service->moveFolder($request->sourceBucket, $request->sourceFolder, $request->goalBucket, $request->goalFolder);
        if (!$moveFolderResponse) {
            return response()->json(['message' => 'The Move is complete']);
        } else {
            return response()->json(['message' => $moveFolderResponse], 403);
        }
    }
}
