<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * Class UsersController.
 */
class UsersController extends Controller
{
    protected $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function userInfo(): JsonResponse
    {
        try {
            return $this->successCreatedResponse($this->service->userInfo());
        } catch (\Exception $exception) {
            return $this->undefinedErrorResponse($exception);
        }
    }
}
