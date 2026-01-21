<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    public $incrementing = false;  // no usar auto-increment
    protected $keyType = 'string'; // clave primaria es string
    protected $fillable = ['name', 'price']; // agregar 'category_id' si lo usas

    // Generar UUID automáticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    }
  //

