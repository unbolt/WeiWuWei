<?php namespace App\Policies\Forum;

class ForumPolicy extends \Riari\Forum\Policies\ForumPolicy
{
    /**
     * Permission: Create categories.
     *
     * @param  object  $user
     * @return bool
     */
    public function createCategories($user)
    {
        return $user->hasRole('admin');
    }
    /**
     * Permission: Move categories.
     *
     * @param  object  $user
     * @return bool
     */
    public function moveCategories($user)
    {
        return $user->hasRole('admin');
    }
    /**
     * Permission: Rename categories.
     *
     * @param  object  $user
     * @return bool
     */
    public function renameCategories($user)
    {
        return $user->hasRole('admin');
    }
}
