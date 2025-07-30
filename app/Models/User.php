<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable{
    use HasApiTokens, HasFactory, Billable, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'display_name',
        'email',
        'password',
        'mobile',
        'address_status',
        'status',
        'username',
        'type',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $append = ["full_name"];

    public function getFullNameAttribute($query) 
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token){
        // $this->notify(new PasswordReset($token));
        $data = [ $this->email ];

        Mail::send('email/password-reset', [
            'fullname' => $this->first_name,
            'reset_url' => route('password.reset', ['token' => $token, 'email' => $this->email]),
        ], function($message) use($data){
            $message->subject('Reset Password Request');
            $message->to($data[0]);
        });
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class,'user_id')->where('type','customer');
    }

}