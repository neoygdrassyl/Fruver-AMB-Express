<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Productos extends Model
{
    use LaravelVueDatatableTrait;
    
    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'nombre' => [
            'searchable' => true,
        ],
        'precio' => [
            'searchable' => true,
        ],
        'unidad' => [
            'searchable' => true,
        ],
        'categoria' => [
            'searchable' => true,
        ],
        'imagen' => [
            'searchable' => false,
        ],
        'activo' => [
            'searchable' => false,
        ],
    ];

    protected $dataTableRelationships = [
        //
    ];

    protected $fillable = [
        'nombre', 'precio', 'unidad', 'categoria', 'imagen', 'activo'
    ];

}
