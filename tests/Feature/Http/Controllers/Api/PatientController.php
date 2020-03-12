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
            'phone' => '842122036',
            'email' => 'pamossecuambe@gmail.com',
            'address' => 'Kumbeza',
            'password' => 'qwertyuiop',
            'job_title' => 'programmer',
        ]);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function can_read_all_the_students()
    {
        $response = $this->get('/api/patients');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_read_a_specific_student()
    {
        $response = $this->json('GET', '/api/patients/5');
        $response->assertStatus(200);
    }

}
