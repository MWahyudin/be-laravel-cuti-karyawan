<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        $role = $user->role->role;
        return $role == 'superadmin' || $role == 'staff hr';
    }

    public function addAnnualLeaveEmployee(User $user)
    {
        $role = $user->role->role;
        return $role == 'superadmin' || $role == 'staff hr';
    }

    public function accAnnualLeaveEmployee(User $user)
    {
        $role = $user->role->role;
        return $role == 'superadmin' || $role == 'staff hr';
    }

    public function readRemainingLeave(User $user)
    {
        $role = $user->role->role;
        return $role == 'superadmin' || $role == 'staff hr';
    }

    public function readRemainingLeaveEmployee(User $user)
    {
        $role = $user->role->role;
        return $role == 'superadmin' || $role == 'staff hr' || $role == 'karyawan';
    }



    public function leaveApplication(User $user)
    {
        $role = $user->role->role;
        return $role == 'superadmin' || $role == 'staff hr' || $role == 'karyawan';
    }

    /**
     *
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
