<?php

namespace Tests\Feature;

use App\Models\Reward;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RewardApiTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_get_reward_from_api()
    {
        for ( $i=1 ; $i <=10 ; ++$i ){
            $reward = new Reward();
            $reward->name = "New Testing Reward {%i}";
            $reward->detail = "Reward {$i} for Testing";
            $reward->total_amount = 5 ;
            $reward->is_active = true;
            $reward->save();
        }
        $response = $this->get('/api/rewards');

        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(10,collect($responseList)->count());
    }
}
