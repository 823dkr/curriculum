<?php

namespace App\Policies;

use App\Creature;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreaturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any creatures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the creature.
     *
     * @param  \App\User  $user
     * @param  \App\Creature  $creature
     * @return mixed
     */
    public function view(User $user, Creature $creature)
    {
        return $user->id === $creature->user_id;
    }

    /**
     * Determine whether the user can create creatures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the creature.
     *
     * @param  \App\User  $user
     * @param  \App\Creature  $creature
     * @return mixed
     */
    public function update(User $user, Creature $creature)
    {
        //
    }

    /**
     * Determine whether the user can delete the creature.
     *
     * @param  \App\User  $user
     * @param  \App\Creature  $creature
     * @return mixed
     */
    public function delete(User $user, Creature $creature)
    {
        //
    }

    /**
     * Determine whether the user can restore the creature.
     *
     * @param  \App\User  $user
     * @param  \App\Creature  $creature
     * @return mixed
     */
    public function restore(User $user, Creature $creature)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the creature.
     *
     * @param  \App\User  $user
     * @param  \App\Creature  $creature
     * @return mixed
     */
    public function forceDelete(User $user, Creature $creature)
    {
        //
    }
}
