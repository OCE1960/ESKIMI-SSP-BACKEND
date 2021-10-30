<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdvertisingCampaignTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_for_advert_index()
    {
        $response = $this->getJson('/api/v1/campaign');

        $response->assertStatus(200)
                ->assertJson([
                    'campaigns' => [],
                    'campaignFiles' => []
                ]);
    }

    public function test_for_advert_store()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $response = $this->postJson('/api/v1/campaign', 
                                    ['name' => 'Iphone 13 Campaign',
                                    'from' => '2021-10-20',
                                    'to' => '2021-10-23',
                                    'total_budget' => 300,
                                    'daily_budget' => 20]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'success' => "Campaign Successfully Created",
            ]);
        $this->assertDatabaseHas('advertising_campaigns', [
                'name' => 'Iphone 13 Campaign',
            ]);
    }

    public function test_for_advert_update()
    {

        $response = $this->putJson('/api/v1/campaign/1', 
                                    ['name' => 'Iphone 13 Campaign updated',
                                    'from' => '2021-10-20',
                                    'to' => '2021-10-23',
                                    'total_budget' => 300,
                                    'daily_budget' => 20]);

        $response
            ->assertStatus(201)
            ->assertExactJson([
                'success' => true,
            ]);
        $this->assertDatabaseHas('advertising_campaigns', [
                'name' => 'Iphone 13 Campaign updated',
            ]);
    }

    public function test_for_advert_show()
    {

        $response = $this->getJson('/api/v1/campaign/1');

        $response->assertStatus(200)
                 ->assertJson([
                 'campaign' => true,
                ]);
    }

    public function test_for_advert_viewCampaign()
    {

        $response = $this->getJson('/api/v1/campaign/view/1');

        $response->assertStatus(200)
                 ->assertJson([
                 'campaign' => true,
                ]);
    }
}
