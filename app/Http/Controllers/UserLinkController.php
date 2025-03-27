<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLinkResource;
use App\Models\UserLink;
use App\Services\Contracts\LinkService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class UserLinkController extends Controller
{
    public function show(UserLink $userLink)
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

    public function deactivateLink(UserLink $userLink, LinkService $linkService)
    {
        $linkService->deactivateLink($userLink);
        return redirect()->route('welcome');
    }

    public function imfeelinglucky(UserLink $userLink)
    {

    }

    public function history(UserLink $userLink)
    {

    }
}
