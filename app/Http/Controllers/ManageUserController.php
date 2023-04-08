<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ManageUserController extends Controller
{
    private $userObject = null;
    private const PAGE = 10;
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
    public function index()
    {
        return view('overview');
    }

    public function listOfUser(Request $request)
    {
        if ($request->session()->get('toggle') === 'true') {
            return view('admin.user-list', [
                'users' => $this->userObject->getAll()->paginate($this::PAGE)
            ]);
        } else {
            return view('admin.user-list', [
                'users' => $this->userObject->getAll()->where('is_disable', false)->paginate($this::PAGE)
            ]);
        }
    }

    public function disableUser(Request $request)
    {
        $check = $this->userObject->disable($request->all());
        if ($check) {
            return Redirect::back()->with('disableNotify', $check);
        } else {
            return Redirect::back()->with('disableFail', true);
        }
    }

    public function toggleDisableUser(Request $request)
    {
        $request->session()->put('toggle', $request->toggle);
        return redirect()->route('user-list');
    }

    public function update(Request $request)
    {
        $check = $this->userObject->updateUser($request->all());
        if (isset($check['error'])) {
            return Redirect::back()->with('updateUserFail', true)->withErrors($check['error']);
        }
        if ($check) {
            return Redirect::back()->with('updateUser', $check);
        } else {
            return Redirect::back()->with('updateUserFail', true);
        }
    }

    public function search(Request $request)
    {
        $request->flash();
        return view('admin.user-list', [
            'users' => $this->userObject->searchUser($request->session()->get('toggle'), $request->search)->paginate($this::PAGE)
        ]);
    }
}
