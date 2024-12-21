<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'account_name',
        'date_of_birth',
        'gender',
        'address',
        'phone',
        'email',
        'password',
        'type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public $timestamps = false;
    public function get_type() {
        return $this->belongsTo(TypeUser::class, 'type_id');
    }
    public function hasReservation() {
        return $this->hasMany(Cart::class, 'user_id');
    }
    public function hasOrder() {
        return $this->hasMany(Order::class, 'user_id');
    }
    public function hasFeedback() {
        return $this->hasMany(Feedback::class, 'user_id');
    }
    public function hasContact() {
        return $this->hasMany(Contact::class, 'user_id');
    }
    
}
