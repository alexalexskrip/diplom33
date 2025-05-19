<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->users->contains($user);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('student');
    }

    public function update(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->users->contains($user);
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->users->contains($user);
    }
}
