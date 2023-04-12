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

    /*
     * Get user object only once
     *
     *
     * @return Object: User
     */
    public function getInstance()
    {
        if ($this->userObject === null) {
            $userObject = new User();
            return $userObject;
        }
        return $this->userObject;
    }

    /*
     * Get list of users (all or not have user disable)
     *
     * @param bool $request->session()->get('toggle')
     *
     * @return resources/views/admin/user-list.blade.php
     */
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

    /*
     * Disable user
     *
     * @param Integer $request->userId
     *
     * @return resources/views/admin/user-list.blade.php
     */
    public function disableUser(Request $request)
    {
        $check = $this->userObject->disable($request->all());
        if ($check) {
            return Redirect::back()->with('disableNotify', $check);
        } else {
            return Redirect::back()->with('disableFail', true);
        }
    }

    /*
     * Set status show list of user with (user disable or not)
     *
     * @param bool $request->toggle
     *
     * @return resources/views/admin/user-list.blade.php
     */
    public function toggleDisableUser(Request $request)
    {
        $request->session()->put('toggle', $request->toggle);
        return redirect()->route('user-list');
    }

    /*
     * Update user
     *
     * @param array $request: id_update, name, number phone, address, is_disable, password
     *
     * @return resources/views/admin/user-list.blade.php
     */

    public function updateUser(Request $request)
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

    /*
     * Search user by name and phone number
     *
     * @param String $request: text search
     *
     * @return resources/views/admin/user-list.blade.php
     */
    public function searchUser(Request $request)
    {
        $request->flash();
        return view('admin.user-list', [
            'users' => $this->userObject->searchUser($request->session()->get('toggle'), $request->search)->paginate($this::PAGE)
        ]);
    }
}
