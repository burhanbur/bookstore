<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubCat extends MultiplePrimaryKey
{
    use HasFactory;

    protected $table = 'pub_cat';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = [
        'publication_id', 
        'category_id',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
