<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // Añadimos el rol para que Laravel permita guardarlo
        'programa', // Añadimos programa por si lo usas más adelante
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- FUNCIONES DE ROLES ---

    /**
     * Verifica si el usuario es Director
     */
    public function isDirector(): bool
    {
        return $this->role === 'director';
    }

    /**
     * Verifica si el usuario es Docente
     */
    public function isDocente(): bool
    {
        return $this->role === 'docente';
    }

    /**
     * Verifica si el usuario es Administrador (opcional)
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}