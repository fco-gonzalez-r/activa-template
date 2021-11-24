<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //Ver un listado
        return $user->can('list programs');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Program $program)
    {
        //Puede ver el detalle del modelo
        if ($user->can('show programs')) return true;
        return $user->id === $program->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //Puede Crear un programa
        return $user->can('create programs');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Program $program)
    {
        //Puede actualizar
        if ($user->can('update own programs')) {
            return $user->id === $program->user_id;
        }
        return $user->can('update programs');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Program $program)
    {
        //Puede eliminar un programa
        if ($user->can('delete own programs')) {
            return $user->id === $program->user_id;
        }
        return $user->can('delete programs');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Program $program)
    {
        //Restaura programa
        if ($user->can('restore own programs')) {
            return $user->id === $program->user_id;
        }
        return $user->can('restore programs');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Program $program)
    {
        //Puede eliminar de forma definitiva
    }
}
