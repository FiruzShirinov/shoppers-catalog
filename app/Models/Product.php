<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'SKU',
        'price',
        'image',
        'admin_created_id',
        'admin_updated_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];

    /**
     * Get the product's price to decimal.
     *
     * @param  string  $value
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return $value/100;
    }

    /**
     * Set the product's price to decimal.
     *
     * @param  string  $value
     * @return void
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value*100;
    }
}
