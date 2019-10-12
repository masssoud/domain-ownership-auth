<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/3/2019
 * Time: 3:12 AM
 */

namespace App\Http\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    /**
     * userRepository constructor.
     * @param user $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get($id)
    {
        return $this->user::findOrFail($id);
    }

    public function all($request)
    {
        isset($request['columns']) && !empty($request['columns']) ?
            $user = $this->user::SelectFields($request['columns'])
            : $user = $this->user::query();
        return $user->sortable()->paginate(5);
    }
    public function create($request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return $user;
    }

    public function update($attr, $id)
    {
        $attr['password'] = $this->generatePassword($attr['password']);
        $this->user::findOrFail($id)->update($attr);
    }

    public function delete($id)
    {
        $this->user::findOrFail($id)->update(['is_deleted'=>'1']);
    }

    public function generatePassword($password){
        return bcrypt($password);
    }

    public function getAllItems()
    {
        // TODO: Implement getAllItems() method.
    }

    public function getItem($id)
    {
        // TODO: Implement getItem() method.
    }
}