<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminNewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_news()
    {
        $createNewsParams = [
            "newsCategory" => "Общество",
            "newsTitle" => "news title",
            "newsDescription" => "news description",
            "newsDateCreate" => "2021-04-03"
        ];
        $response = $this->post('/admin/news', $createNewsParams);

        $response->assertStatus(200);
    }
}
