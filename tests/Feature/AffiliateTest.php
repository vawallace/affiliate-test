<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Affiliate;


class AffiliateTest extends TestCase
{
    use RefreshDatabase;

    public function test_parse_returns_a_successful_response()
    {
        
        $affiliate = new Affiliate;

        $affiliate->affiliate_name = 'Test';
        $affiliate->affiliate_id = 2;
        $affiliate->latitude = '45.3';
        $affiliate->longitude = '-5';
        $affiliate->save();

        $this->assertDatabaseHas('affiliates', [
            'affiliate_name' => 'Test',
        ]);
    }

    public function test_filter_returns_a_successful_response()
    {
        $response = $this->get('/filter');
 
        $response->assertStatus(200);
    }
}
