<?php

namespace Tests\Feature\User;

use App\Models\UserLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLinkTest extends TestCase
{
    use RefreshDatabase;

    protected UserLink $userLink;

    public function test_generate_link(): void
    {
        $this->post(route('userLink.generateLink', [
            'userLink' => $this->userLink,
        ]))
            ->assertSuccessful()
            ->assertSeeText('Your link:');

        $this->assertDatabaseCount('user_links', 2);
    }

    public function test_deactivate_link(): void
    {
        $this->post(route('userLink.deactivateLink', [
            'userLink' => $this->userLink,
        ]))
            ->assertRedirect(route('welcome'));

        $this->assertSoftDeleted('user_links', [
            'link' => $this->userLink->link,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLink = UserLink::factory()->create();
    }
}
