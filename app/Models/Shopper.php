<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shopper extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'image',
        'admin_created_id',
        'admin_updated_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];

    /**
	 * The password attribute should be hashed
	 */
	public function setPasswordAttribute($password)
	{
		if ($password !== null && $password !== "")
		{
			$this->attributes['password'] = bcrypt($password);
		}
    }

    /**
     * The purchases that belong to the shopper.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
