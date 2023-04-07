<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class UpdateProfileController extends Controller
{
    public function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:10'],
        ];
        if ($data['password'] === null && $data['password_confirmation'] === null) {
            $validate = Validator::make($data, $rules);
        } else {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $validate = Validator::make($data, $rules);
        }
        return $validate;
    }
    public function update(Request $request, $id)
    {
        $validate = $this->validator($request->all());
        if ($validate->fails()) {
            return redirect('/profile')->withErrors($validate->errors());
        } else {
            $check = User::where('id', $id)
                ->update(
                    [
                        'name' => $request->name,
                        'phone_number' => $request->phoneNumber,
                        'address' => $request->address,
                        'password' => $request->password === null ? Auth::user()->password : Hash::make($request->password)
                    ]
                );
            if ($check) {
                return redirect('/home');
            } else {
                return redirect('/profile');
            }
        }
    }
}
