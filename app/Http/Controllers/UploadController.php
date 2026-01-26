<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Generate a signed URL for direct upload to DigitalOcean Spaces.
     */
    public function signedUrl(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'content_type' => 'required|string|in:image/jpeg,image/png,image/gif,image/webp',
        ]);

        $folder = config('filesystems.disks.do.folder', 'poduzetnici');
        $extension = pathinfo($request->filename, PATHINFO_EXTENSION);
        $filename = $folder.'/ads/'.date('Y/m').'/'.Str::uuid().'.'.$extension;

        $disk = Storage::disk('do');
        $client = $disk->getClient();
        $bucket = config('filesystems.disks.do.bucket');

        $command = $client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $filename,
            'ContentType' => $request->content_type,
            'ACL' => 'public-read',
        ]);

        $signedRequest = $client->createPresignedRequest($command, '+10 minutes');

        return response()->json([
            'url' => (string) $signedRequest->getUri(),
            'public_url' => config('filesystems.disks.do.url').'/'.$filename,
        ]);
    }
}
