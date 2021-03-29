<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rate'];

    public function __construct(array $attributes = [])
    {
        $this->table = 'currency';

        parent::__construct($attributes);
    }
}
