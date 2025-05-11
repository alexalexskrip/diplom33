<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SourceList;
use Illuminate\Http\RedirectResponse;

class ProjectSourceDetachController extends Controller
{
    public function detach(Project $project, SourceList $source): RedirectResponse
    {
        $project->sourceLists()->detach($source->id);
        return back();
    }
}
