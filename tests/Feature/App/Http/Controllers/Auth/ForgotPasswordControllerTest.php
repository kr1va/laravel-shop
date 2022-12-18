<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Database\Factories\UserFactory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */

    private function testingCredentials(): array
    {
        return [
            'email' => 'testing@mail.ru'
        ];
    }

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertSee('Забыли пароль')
            ->assertViewIs('auth.forgot-password');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success()
    {
        $user = UserFactory::new()->create($this->testingCredentials());

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertRedirect();
        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_fail(): void
    {
        $this->assertDatabaseMissing('users', $this->testingCredentials());

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertInvalid(['email']);

        Notification::assertNothingSent();
    }
}
