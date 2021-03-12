<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Order extends Model
{
    use HasFactory, LaravelVueDatatableTrait;
    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'order_public_id' => [
            'searchable' => true,
        ],
        'created_at' => [
            'searchable' => true,
        ],
        'subtotal' => [
            'searchable' => true,
        ],
        'total' => [
            'searchable' => true,
        ],        
    ];

    protected $dataTableRelationships = [
        //
    ];
}
