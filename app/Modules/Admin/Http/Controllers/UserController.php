<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use App\Services\CacheService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redis;
use Modules\Admin\Http\Requests\SaveUserRequest;
use Modules\Admin\Services\UserService;
use Modules\Admin\Transformers\UserDetailResource;
use Modules\Admin\Transformers\UserListResource;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.users.list')->only(['index', 'getList']);

        // $this->middleware('permission:admin.users.show')->only(['show']);

        $this->middleware('permission:admin.users.create')->only(['create', 'save']);

        $this->middleware('permission:admin.users.update')->only(['edit', 'save']);

        $this->middleware('permission:admin.users.delete')->only(['delete']);
    }

    public function index()
    {
        return view('admin::users.index');
    }

    public function getList()
    {
        $users = UserService::getUsers();

        return UserListResource::collection($users);
    }

    public function create()
    {
        return view('admin::users.create');
    }

    public function edit(int $userId)
    {
        try {
            $user = UserService::getUserDetails($userId);

            return view('admin::users.update',[
                'user_json'=> new UserDetailResource($user),
                'user' => $user,
            ]);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function save(SaveUserRequest $request)
    {
        $user = UserService::saveUser($request);

        return new UserDetailResource($user);
    }

    public function delete(User $user)
    {
        UserService::deleteUser($user);

        return $this->getList();
    }
}
