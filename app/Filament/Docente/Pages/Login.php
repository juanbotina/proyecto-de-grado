<?php

namespace App\Filament\Docente\Pages;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        $response = parent::authenticate();

        $user = auth()->user();

        if (!$user) {
            return $response;
        }

        if ($user->isAdmin()) {
            return redirect('/admin');
        }

        if ($user->isDirector()) {
            return redirect('/director');
        }

        if ($user->isDocente()) {
            return $response;
        }

        throw ValidationException::withMessages([
            'data.email' => 'No tienes permiso para acceder.',
        ]);
    }
}