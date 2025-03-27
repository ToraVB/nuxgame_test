<?php

namespace App\Services;

use App\Dtos\RegisterData;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;
use App\Services\Contracts\LinkService as LinkService;
use App\Services\Contracts\RegisterService as RegisterServiceContract;

class RegisterService implements RegisterServiceContract
{
    public function __construct(
        protected readonly LinkService $linkService,
        protected readonly UserRepository $userRepository,
    )
    {
    }

    /**
     * @param RegisterData $data
     * @return User
     */
    public function register(Data $data): User
    {
        if ($user = $this->userRepository->findByUsername($data->username)) {
            $user->setRelation('userLink', $this->linkService->generateLink($user));
            return $user;
        }

        return DB::transaction(function () use ($data) {
            $user = $this->userRepository->create($data->toArray());
            $user->setRelation('userLink', $this->linkService->generateLink($user));

            return $user;
        });
    }
}
