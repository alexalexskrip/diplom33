<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectNews;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::with(['users.group', 'medias'])
            ->latest()
            ->take(10)
            ->get();

        $formattedProjects = $projects
            ->filter(function ($p) {
                $user = $p->users->first();
                return $user && $user->firstname && $user->lastname && $user->group;
            })
            ->map(function ($p) {
                return [
                    'author' => $p->users->first()->fullname,
                    'group' => Str::limit($p->users->first()->group->name_group, 10),
                    'title' => $p->name_project,
                    'description' => Str::limit($p->discription_project, 120),
                    'image' => $p->getFirstImageUrl(),
                    'views' => 50,
                    'votes' => 29,
                    'bgClass' => 'bg-salad',
                    'link' => route('frontend.projects.show', $p),
                ];
            });

        $project_news = ProjectNews::with(['project'])->latest()->take(10)->get();

        return view('frontend.home', compact('formattedProjects', 'project_news'));
    }
}
