<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImfeelingluckyHistoryResource;
use App\Http\Resources\UserLinkResource;
use App\Models\UserLink;
use App\Repositories\Contracts\ImfeelingluckyHistoryRepository;
use App\Services\Contracts\ImfeelingluckyService;
use App\Services\Contracts\LinkService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class UserLinkController extends Controller
{
    public function show(UserLink $userLink): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('hiddenPage', [
            'userLink' => UserLinkResource::make($userLink)->jsonSerialize(),
        ]);
    }

    public function generateLink(UserLink $userLink, LinkService $linkService): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('hiddenPage', [
            'userLink' => UserLinkResource::make($userLink)->jsonSerialize(),
            'newUserLink' => UserLinkResource::make($linkService->generateLink($userLink->user))->jsonSerialize(),
        ]);
    }

    public function deactivateLink(UserLink $userLink, LinkService $linkService): RedirectResponse
    {
        $linkService->deactivateLink($userLink);
        return redirect()->route('welcome');
    }

    public function imfeelinglucky(UserLink $userLink, ImfeelingluckyService $service): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('hiddenPage', [
            'userLink' => UserLinkResource::make($userLink)->jsonSerialize(),
            'imfeelinglucky' => ImfeelingluckyHistoryResource::make($service->imfeelinglucky($userLink->user))->jsonSerialize(),
        ]);
    }

    public function history(UserLink $userLink, ImfeelingluckyHistoryRepository $historyRepository): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('hiddenPage', [
            'userLink' => UserLinkResource::make($userLink)->jsonSerialize(),
            'imfeelingluckyHistory' => ImfeelingluckyHistoryResource::collection($historyRepository->latestForUser($userLink->user))->jsonSerialize(),
        ]);
    }
}
