<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use function request;

/**
 * Class Download
 * @package App\Http\Controllers\File
 */
class Download extends Controller
{
    /**
     * @var array
     */
    const HEADERS = [
        'pdf' => [
            'Content-Type' => 'application/pdf'
        ],
        'jpg' => [
            'Content-Type' => 'image/png'
        ],
        'jpeg' => [
            'Content-Type' => 'image/png'
        ],
        'png' => [
            'Content-Type' => 'image/png'
        ],
        'mp3' => [
            'Content-Type' => 'audio/mpeg'
        ],
        'mp4' => [
            'Content-Type' => 'video/mp4'
        ],
    ];

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param string $any
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($any)
    {
        $path = "statics/{$any}";
        try {
            $content = Storage::disk('minio')->get($path);
        } catch (FileNotFoundException $fileNotFoundException) {
            return response(null, 404);
        }

        $info = pathinfo($path);

        $static = static::HEADERS;

        $extension = $info['extension'] ?? '';
        $headers = $static[$extension] ?? ['Content-Type' => 'text/html'];

        if (request()->get('download')) {
            $name = request()->get('name');
            if (!$name) {
                $name = 'document' . '.' . $extension;
            }
            $filename = storage_path() . '/temp/';
            return response()->download($filename, $name, $headers)->deleteFileAfterSend();
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return Response::make($content, 200, $headers);
    }
}
