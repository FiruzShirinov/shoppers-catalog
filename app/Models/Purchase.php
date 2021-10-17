<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'shopper_id',
        'total',
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
     * Get the product's total to decimal.
     *
     * @param  string  $value
     * @return string
     */
    public function getTotalAttribute($value)
    {
        return $value/100;
    }

    /**
     * The products that belong to the purchase.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
