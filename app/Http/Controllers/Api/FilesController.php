<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileCreateRequest;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;

/**
 * Class FilesController.
 *
 * @package namespace App\Http\Controllers;
 */
class FilesController extends Controller
{
    protected $service;

    /**
     * @param FileService $service
     */

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function storeFile(FileCreateRequest $request): JsonResponse
    {
        try {
            return $this->successCreatedResponse($this->service->storeFile($request->validated()));
        } catch (\Exception $exception) {
            return $this->undefinedErrorResponse($exception);
        }
    }

}
