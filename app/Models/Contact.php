<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

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
        'person_id',
        'country_code',
        'number',
    ];

    /**
     * Boot para gerar UUID automaticamente ao criar o contato.
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
     * Relacionamento: O contato pertence a uma pessoa.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
