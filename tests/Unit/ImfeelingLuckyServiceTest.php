<?php

namespace Tests\Unit;

use App\Repositories\Contracts\ImfeelingluckyHistoryRepository;
use App\Services\Contracts\ImfeelingluckyService;
use App\Services\ImfeelingluckyService as ImfeelingluckyServiceConcrete;
use Mockery;
use PHPUnit\Framework\TestCase;

class ImfeelingLuckyServiceTest extends TestCase
{
    protected ImfeelingluckyService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ImfeelingluckyServiceConcrete(Mockery::mock(ImfeelingluckyHistoryRepository::class));
    }

    public function test_check_is_win_number(): void
    {
        for ($i = 1; $i <= 1000; $i++) {
            $this->assertEquals($i % 2 == 0, $this->service->checkIsWinNumber($i));
        }
    }

    /**
     * @dataProvider calculate_win_amount_data_provider
     */
    public function test_calculate_win_amount(int $number): void
    {
        if ($number <= 300){
            $this->assertEquals($number * 0.1, $this->service->calculateWinAmount($number));
            return;
        }
        if ($number <= 600){
            $this->assertEquals($number * 0.3, $this->service->calculateWinAmount($number));
            return;
        }
        if ($number <= 900){
            $this->assertEquals($number * 0.5, $this->service->calculateWinAmount($number));
            return;
        }
        $this->assertEquals($number * 0.7, $this->service->calculateWinAmount($number));
    }

    public static function calculate_win_amount_data_provider(): array
    {
        return [
            [1],
            [299],
            [300],
            [301],
            [599],
            [600],
            [601],
            [899],
            [900],
            [901],
            [1000],
        ];
    }
}
