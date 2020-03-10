<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientController extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function can_create_a_patient()
    {

        $response = $this->post('/api/patients', [
            'name' => 'Paulo Amosse',
            'bi' => '11023456789A',
            'gender' => 'male',
            'birthday' => '1999-08-30',
            'phone' => '842022036',
            'email' => 'pamossecuambe@gmail.com',
            'address' => 'Kumbeza',
            'password' => 'qwertyuiop',
            'job_title' => 'programmer',
        ]);
        $response->assertStatus(201);
    }
}
