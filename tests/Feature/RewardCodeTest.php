<?php

namespace Tests\Feature;

use App\Models\Reward;
use App\Models\RewardCode;
use Database\Seeders\RewardSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RewardCodeTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_get_amount_of_reward_code()
    {
        $reward = new Reward();
        $reward->name = "New Testing Reward";
        $reward->detail = "Reward for Testing";
        $reward->total_amount = 10 ;
        $reward->is_active = true;
        $reward->save();
        for ($i = 0; $i < $reward->total_amount; $i++) {
            $rewardCode = new RewardCode();
            $rewardCode->code = fake()->lexify("?????");
            $reward->rewardCodes()->save($rewardCode);
        }   

        $this->assertEquals(10,RewardCode::count());
    }

    // 4 rewards * reward ละ 10 codes = 40 codes
    public function test_get_amount_of_reward_code_from_many_rewards()
    {
        for ($i = 1 ; $i <= 4 ; ++$i) {
            $reward = new Reward();
            $reward->name = "New Testing Reward {$i}";
            $reward->detail = "Reward {$i} for Testing";
            $reward->total_amount = 10 ;
            $reward->is_active = true;
            $reward->save();
            for ($i = 0; $i < $reward->total_amount; $i++) {
                $rewardCode = new RewardCode();
                $rewardCode->code = fake()->lexify("?????");
                $reward->rewardCodes()->save($rewardCode);
            }
        }   

        $this->assertEquals(40,RewardCode::count());
    }
}
