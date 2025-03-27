<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserLink;
use App\Repositories\Contracts\UserLinkRepository;
use App\Services\Contracts\LinkService as LinkServiceContract;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class LinkService implements LinkServiceContract
{
    public function __construct(
        protected UserLinkRepository $userLinkRepository
    )
    {
    }

    public function generateLink(User $user): UserLink
    {
        return $this->userLinkRepository->create([
            'user_id' => $user->id,
            'link' => $this->generateUniqueLink(),
            'expires_at' => $this->getExpiresAt(),
        ]);
    }

    protected function getExpiresAt(): Carbon
    {
        return Carbon::now()->addDays(config('link.expires_at_days'));
    }

    protected function generateUniqueLink(): string
    {
        do {
            $string = Str::random();
        } while ($this->userLinkRepository->findByLink($string));

        return $string;
    }
}
