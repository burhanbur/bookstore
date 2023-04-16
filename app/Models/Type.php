<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';
    protected $guarded = [];    

    public function publication()
    {
        return $this->hasMany(Publication::class, 'ref_type_id');
    }
}
