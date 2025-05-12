<?php

namespace App\Policies;

use App\Models\ProjectNews;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectNewsPolicy
{
    use HandlesAuthorization;

    public function view(User $user, ProjectNews $news): bool
    {
        return $user->hasRole('admin') || $news->project->users->contains($user);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('student');
    }

    public function update(User $user, ProjectNews $news): bool
    {
        return $user->hasRole('admin') || $news->project->users->contains($user);
    }

    public function delete(User $user, ProjectNews $news): bool
    {
        return $user->hasRole('admin') || $news->project->users->contains($user);
    }
}
