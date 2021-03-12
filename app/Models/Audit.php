<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Audit extends Model
{
    use HasFactory, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
        ],
        'user' => [
            'searchable' => true,
        ],
        'table' => [
            'searchable' => true,
        ],
        'action' => [
            'searchable' => true,
        ],
        'created_at' => [
            'searchable' => true,
        ],
    ];

    protected $dataTableRelationships = [
        //
    ];

    protected $fillable = [
        'id', 'user', 'table', 'action', 'created_at'
    ];
}
