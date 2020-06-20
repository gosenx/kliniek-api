<?php

namespace Tests\Feature\Patient;

use App\Models\Authentication\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ScheduleAppointmentTest extends TestCase
{

    public function test_shedule_appointment()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $response = $this->postJson('api/schedule', ['doctor_id'=>1, 'specialty']);
        $response->assertStatus(422);
    }
}
