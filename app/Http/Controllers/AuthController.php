<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Contracts\RegisterService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterService $registerService): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome', UserResource::make($registerService->register($request->getDto()))->jsonSerialize());
    }
}
