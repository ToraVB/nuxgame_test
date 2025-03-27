<?php

namespace Tests\Feature\User;

use App\Models\ImfeelingluckyHistory;
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

    public function test_imfeelinglucky(): void
    {
        $response = $this->post(route('userLink.imfeelinglucky', [
            'userLink' => $this->userLink,
        ]))
            ->assertSuccessful();

        $this->assertDatabaseHas('imfeelinglucky_histories', [
            'user_id' => $this->userLink->user->id,
        ]);

        /** @var ImfeelingluckyHistory $result */
        $result = $this->userLink->user->imfeelingLuckyHistories()->first();

        if ($result->result > 0) {
            $response->assertSeeText('Win.');
            $response->assertDontSeeText('Lose.');
            $response->assertSeeText("Sum: {$result->result}");
            return;
        }
        $response->assertSeeText('Lose.');
        $response->assertDontSeeText('Win.');
        $response->assertSeeText("Sum: 0");
    }

    public function test_history(): void
    {
        $history = ImfeelingluckyHistory::factory(3)->create();

        $this->assertDatabaseCount('imfeelinglucky_histories', 3);

        $response = $this->get(route('userLink.history', [
            'userLink' => $this->userLink,
        ]))
            ->assertSuccessful()
            ->assertSeeText('Your latest results:');

        foreach ($history as $historyItem) {
            $response->assertSeeText("Sum: {$historyItem->result}");
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userLink = UserLink::factory()->create();
    }
}
