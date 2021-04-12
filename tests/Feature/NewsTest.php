<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_news_list()
    {
        $response = $this->get('/news');

        $response->assertStatus(200);

    }
    public function test_one_news_show()
    {
        $newsId = mt_rand(0,5);
        $response = $this->get('/news/show/' . $newsId);

        $response->assertStatus(200);

    }
}
