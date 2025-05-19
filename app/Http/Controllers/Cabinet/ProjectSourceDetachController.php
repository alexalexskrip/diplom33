<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Source;
use Illuminate\Http\RedirectResponse;

class ProjectSourceDetachController extends Controller
{
    public function detach(Project $project, Source $source): RedirectResponse
    {
        $project->sources()->detach($source->id);
        return back();
    }
}
