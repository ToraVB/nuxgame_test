<?php

namespace Tests\Feature\UserLink;

use App\Models\UserLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class UserLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_link_expires(): void
    {
        $link = UserLink::factory()->create();

        $link->expires_at = Carbon::now();
        $link->save();

        $this->assertEquals(true, $link->isExpired());

        $link->expires_at = Carbon::now()->subDay();
        $link->save();

        $this->assertEquals(true, $link->isExpired());

        $link->expires_at = Carbon::now()->addDay();
        $link->save();

        $this->assertEquals(false, $link->isExpired());
    }
}
