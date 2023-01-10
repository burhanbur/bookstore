<?php 

namespace App\Utilities;

class Dropdown
{
	public static function listCategories()
    {
        return [
            'buku' => 'Buku',
            'diktat_kuliah' => 'Diktat Kuliah',
        ];
    }

    public static function allowedCategories()
    {
        return array_keys(static::listCategories());
    }
}