<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use mysql_xdevapi\Exception;
use Support\SessionRegenerator;


class SocialAuthController extends Controller
{
    public function redirect(string $driver): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver($driver)
            ->redirect();
    }

    public function callback(string $driver): RedirectResponse
    {
        if ($driver !== "github") {
            throw new Exception("Driver not supported!");
        }

        $driverUser = Socialite::driver($driver)->user();

        $user = User::query()->updateOrCreate([
            $driver . '_id' => $driverUser->getId(),
        ], [
            'name' => $driverUser->getName() ?? $driverUser->getEmail(),
            'email' => $driverUser->getEmail(),
            'password' => bcrypt(str()->random(20))
        ]);

//        auth()->login($user);
        SessionRegenerator::run(fn() => auth()->login($user));

        return redirect()->intended(route('home'));
    }
}
