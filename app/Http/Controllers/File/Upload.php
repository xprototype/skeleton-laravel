<?php

namespace App\Http\Controllers\File;

use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\ApiController;
use App\Http\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function App\Helper\uuid;

/**
 * Class Upload
 * @package App\Http\Controllers\File
 */
class Upload extends ApiController
{
    /**
     * @param Request $request
     * @param string $any
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke(Request $request, string $any)
    {
        $document = $request->file('document');
        if (!$document) {
            throw new ErrorValidation(['document' => 'required']);
        }

        $extension = $document->getClientOriginalExtension();
        $reference = uuid();
        if ($request->get('reference')) {
            preg_match_all('/.*\/(.*)\..*/', $request->get('reference'), $matches, PREG_SET_ORDER, 0);
            if (isset($matches[0]) && isset($matches[0][1])) {
                $reference = $matches[0][1];
            }
        }
        $resource = "{$any}/{$reference}.{$extension}";
        $path = "statics/{$resource}";

        if (Storage::disk('minio')->put($path, File::get($document->getRealPath()))) {
            return $this->answerSuccess(['resource' => $resource], Status::CODE_200);
        }
        return $this->answerError("Can't save the path: '{$path}'");
    }
}
