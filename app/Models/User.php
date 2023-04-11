<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'password',
        'is_admin',
        'is_disable'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function getAll()
    {
        return User::where('is_admin', false);
    }

    public function disable($request)
    {
        $check = false;
        if (User::where('id', $request['userId'])->exists()) {
            User::where('id', $request['userId'])->update([
                'is_disable' => true
            ]);
            $check = true;
        }
        return $check;
    }

    public function updateUser($request)
    {
        $check = false;
        $validate = $this->validator($request);
        if ($validate->fails()) {
            return ['error' => $validate->errors()];
        } else {
            if (User::where('id', $request['id_update'])->exists()) {
                $data = [
                    'name' => $request['name'],
                    'phone_number' => $request['phoneNumber'],
                    'address' => $request['address'],
                    'is_disable' => isset($request['is_disable'])
                ];
                if (isset($request['password'])) {
                    $data['password'] = Hash::make($request['password']);
                }
                User::where('id', $request['id_update'])->update($data);
                $check = true;
            }
        }
        return $check;
    }

    public function searchUser($toggleSession, $search)
    {
        if ($toggleSession === 'true') {
            return $this->getAll()->where('name', 'like', '%' . $search . '%')
            ->orWhere('phone_number', 'like', '%' . $search . '%');
        }else{
            return $this->getAll()->where('is_disable', false)->where('name', 'like', '%' . $search . '%')
            ->orWhere('phone_number', 'like', '%' . $search . '%');
        }
    }

    public function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:10', 'min: 10'],
        ];
        if ($data['password'] !== null && $data['password_confirmation'] !== null) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } else if ($data['password'] !== null && $data['password_confirmation'] === null) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        $validate = Validator::make($data, $rules);
        return $validate;
    }
}
