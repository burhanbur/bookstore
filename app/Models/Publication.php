<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $guarded = [];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'ref_type_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'publication_id');
    }

    public function pubCat()
    {
        return $this->hasMany(PubCat::class, 'publication_id');
    }
}
