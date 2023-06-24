<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    public function __construct()
    {
        $this->attributes['exp_date'] = date('Y-m-d H:i:s');
    }
    protected $fillable = [
        'uuid',
        'domain',
        'email',
        'phone',
        'name',
        'key',
        'exp_date',
        'ban',
        'status',
    ];

    protected $attributes = [
        'ban' => 0,
        'status' => 0,
        'key' => null,
        'exp_date' => null,
    ];
    protected $hidden = [
        'id',
    ];
    protected $casts = [];
}
