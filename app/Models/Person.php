<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // Obrigatório para o requisito de deleção lógica
use Illuminate\Foundation\Auth\User as Authenticatable; // Permite que a model funcione para login
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Person extends Authenticatable // Note que agora estendemos Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Define que o ID não é um inteiro incremental.
     */
    public $incrementing = false;

    /**
     * Define que o tipo do ID é string (para o UUID).
     */
    protected $keyType = 'string';

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'name',
        'email',
        'password', // Necessário se for usar o requisito opcional de login
    ];

    /**
     * Ocultar campos sensíveis em listagens ou JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Evento de "boot" para gerar o UUID automaticamente ao criar uma nova pessoa.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Relacionamento: Uma pessoa possui muitos contatos.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
