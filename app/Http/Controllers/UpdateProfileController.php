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
    private $userObject = null;
    public function __construct()
    {
        $this->userObject = $this->getInstance();
    }

    public function getInstance()
    {
        if ($this->userObject === null) {
            $userObject = new User();
            return $userObject;
        }
        return $this->userObject;
    }
    public function update(Request $request, $id)
    {
        $validate = $this->userObject->validator($request->all());
        if ($validate->fails()) {
            return redirect()->route('profile-form')->withErrors($validate->errors());
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
            return redirect()->route('profile-form')->with('updateStatus', $check);
        }
    }
}
