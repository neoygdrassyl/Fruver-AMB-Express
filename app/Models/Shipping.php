<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Shipping extends Model
{
    use HasFactory, LaravelVueDatatableTrait;
        
    protected $dataTableColumns = [
        'product_id' => [
            'searchable' => false,
        ],
        'order_id' => [
            'searchable' => false,
        ],
        'quantity' => [
            'searchable' => false,
        ],
    ];

    protected $dataTableRelationships = [
        //
    ];
}
