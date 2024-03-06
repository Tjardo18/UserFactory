<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            DateTimePicker::make('email_verified_at'),
            TextInput::make('password')
                ->password()
                ->required()
                ->maxLength(255),
            Actions::make([
                Action::make('star')
                    ->icon('heroicon-m-star')
                    ->label('Fill Form with Factory Data')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription('Het wachtwoord wordt ingesteld als "password"')
                    ->action(function ($livewire) {
                        $data = User::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ]),
        ];
    }
}
