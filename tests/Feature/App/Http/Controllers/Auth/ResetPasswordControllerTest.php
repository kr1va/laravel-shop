<?php

namespace Tests\Feature\App\Http\Controllers\Auth\Auth;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $token;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        $this->token = Password::createToken($this->user);
    }


    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([ResetPasswordController::class, 'page'], ['token' => $this->token]))
            ->assertOk()
            ->assertSee('Восстановление пароля')
            ->assertViewIs('auth.reset-password')
            ->assertViewHas(['token' => $this->token]);
    }

    public function it_reset_password_success()
    {
        Notification::fake();
        Event::fake();

//        $token = str()->random('12');
        $password = '123456789';
        $password_confirmation = '123456789';

        Password::shouldReceive('reset')
            ->once()
            ->withSomeOfArgs([
                'email' => $this->user->email,
                'password' => $password,
                'password_confirmation' => $password_confirmation,
                'token' => $this->token
            ])
            ->andReturn(Password::PASSWORD_RESET);

        $response = $this->post(
            action(ResetPasswordController::class, 'handle'),
            [
                'email' => $this->user->email,
                'password' => $password,
                'password_confirmation' => $password_confirmation,
                'token' => $this->token
            ]
        );

        $response->assertRedirect(action([SignInController::class, 'page']));
    }
}
