<?php

namespace App\Policies\Forum;

use Riari\Forum\Models\Category;

class CategoryPolicy extends \Riari\Forum\Policies\CategoryPolicy
{

    private function formatAccessString($string)
    {
        $check_permission_string  = 'access-';
        $check_permission_string .= str_replace(' ', '-', $string);
        $check_permission_string = strtolower($check_permission_string);

        return $check_permission_string;
    }

    public function createThreads($user, Category $category)
    {
        //return $user->isActive;
        return true;
    }

    public function deleteThreads($user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function enableThreads($user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function moveThreadsFrom($user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function moveThreadsTo($user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function lockThreads($user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function pinThreads($user, Category $category)
    {
        return $user->hasRole('admin');
    }

    public function view($user, Category $category)
    {
        // Format category string
        $permission_string = $this->formatAccessString($category->title);

        if($user->hasPermission($permission_string)) {
            return true;
        } else {
            // Check if they have access to the category above if it exists
            // This presumes top level categories always allow access to sub cateogories
            if($category->category_id != 0) {
                // Grab the category
                $parent = Category::find($category->category_id);

                if($parent) {
                    // Check if they have access to parent
                    $parent_permission = $this->formatAccessString($parent->title);

                    if($user->hasPermission($parent_permission)) {
                        return true;
                    } else {
                        return false;
                    }


                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function delete($user, Category $category)
    {
        return $user->hasRole('admin');
    }
}
