<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class SignUpController extends Controller
{
    public function page(): Factory|View|Application|RedirectResponse
    {
        return view('auth.sign-up');
    }

    public function handle(SignUpFormRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        //TODO make Exception control
        $action(NewUserDTO::fromRequest($request));
//        $action(NewUserDTO::make($request->only(['name', 'email', 'password'])));
        return redirect()
            ->intended(route('home'));
    }


}
