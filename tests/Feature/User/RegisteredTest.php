<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisteredTest extends TestCase
{
    use RefreshDatabase;

    protected UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = resolve(UserRepository::class);
    }

    /**
     * @dataProvider login_data_provider
     */
    public function test_register(string $username, string $phonenumber): void
    {
        $this->assertDatabaseMissing('users', [
            'username' => $username,
            'phonenumber' => $phonenumber,
        ]);

        $this->post(route('register'), [
            'username' => $username,
            'phonenumber' => $phonenumber,
        ])
            ->assertSuccessful()
            ->assertSeeText('Your link:');

        $this->assertDatabaseHas('users', [
            'username' => $username,
            'phonenumber' => $phonenumber,
        ]);

        $user = $this->userRepository->findByUsername($username);

        $this->assertDatabaseHas('user_links', [
            'user_id' => $user->id,
        ]);
    }

    /**
     * @depends test_register
     * @dataProvider login_data_provider
     */
    public function test_registered(string $username, string $phonenumber): void
    {
        $user = User::factory([
            'username' => $username,
            'phonenumber' => $phonenumber,
        ])->create();

        $this->assertDatabaseMissing('user_links', [
            'user_id' => $user->id,
        ]);

        $this->post(route('register'), [
            'username' => $username,
            'phonenumber' => $phonenumber,
        ])
            ->assertSuccessful()
            ->assertSeeText('Your link:');

        $this->assertDatabaseHas('user_links', [
            'user_id' => $user->id,
        ]);
    }

    public static function login_data_provider(): array
    {
        return [
            [
                'username' => 'test',
                'phonenumber' => '12345678900',
            ],
            [
                'username' => 'test1',
                'phonenumber' => '12345678901',
            ],
            [
                'username' => 'test2',
                'phonenumber' => '12345678902',
            ],
            [
                'username' => 'test3',
                'phonenumber' => '12345678903',
            ],
            [
                'username' => 'test4',
                'phonenumber' => '12345678904',
            ],
        ];
    }
}
