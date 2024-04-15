<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */


    public function test_halaman(): void
    {
        $response = $this->get('/artikel');
        $response->assertStatus(200);
    }
        
    
}
