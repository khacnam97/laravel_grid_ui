<?php


namespace App\services;


use App\Models\AnalyzedFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{


    /**
     * @param $id
     * @return User|User[]|Collection|Model
     */
    public function findUser($id) {
        return User::findOrFail($id);
    }

    /**
     * @return Collection|Role[]
     */
    public function getRole(){
        return Role::all();
    }

    /**
     * @param $id
     * @return bool
     */
    public function trash($id): bool
    {
        $user = $this->findUser($id);
        return $user->delete();
    }

    /**
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        $user = $this->findUser($id);
        return $user->restore();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $user = $this->findUser($id);
        return $user->delete();
    }

    /**
     * @param $request
     * @return bool
     */
    public function store($request): bool
    {
        $user = new User($request->all());
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->assignRole([$request->role_id]);
        return $user->save();
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id): bool
    {
        $user = $this->findUser($id);
        $user->fill($request->all());
        if(auth()->id() !== $id) {
            $user->syncRoles([$request->role_id]);
        }
        return $user->save();
    }

    /**
     * @param $request
     * @return bool
     */
    public function updatePassword($request): bool
    {
       return $this->findUser(auth()->id())->update(['password'=> Hash::make($request->password)]);
    }

}
