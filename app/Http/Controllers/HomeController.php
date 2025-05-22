<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectNews;
use App\Models\Source;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $formattedVotesProjects = $this->getFormattedProjectsByStatus(1);
        $formattedReviewProjects = $this->getFormattedProjectsByStatus(2);
        $formattedAcceptedProjects = $this->getFormattedProjectsByStatus(3);

        $formattedNews = ProjectNews::with('project')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($news) {
                return [
                    'name' => Str::limit($news->name, 60),
                    'date' => $news->created_at->format('d.m.Y'),
                    'tags' => ['#Учёба', '#Каникулы'], // здесь можно динамику позже
                    'bgClass' => 'bg-salad', // или рандомный/по теме
                    'link' => route('frontend.project-news.show', $news),
                ];
            });

        $sources = Source::query()->orderBy('name')->get();

        return view('frontend.home', [
            'formattedVotesProjects' => $formattedVotesProjects,
            'formattedReviewProjects' => $formattedReviewProjects,
            'formattedAcceptedProjects' => $formattedAcceptedProjects,
            'formattedNews' => $formattedNews,
            'sources' => $sources
        ]);
    }

    private function getFormattedProjectsByStatus(int $statusId)
    {
        return Project::with(['users.group', 'media'])
            ->where('status_id', $statusId)
            ->latest()
            ->take(10)
            ->get()
            ->filter(function ($p) {
                $user = $p->users->first();
                return $user && $user->firstname && $user->lastname && $user->group;
            })
            ->map(function ($p) {
                $user = $p->users->first();
                return [
                    'author' => $user->firstname . ' ' . $user->lastname,
                    'group' => Str::limit($user->group->name, 10),
//                    'title' => Str::limit($p->name, 20),
                    'title' => $p->name,
                    'description' => $p->description,
                    'image' => $p->getFirstImageUrl(),
                    'views' => 50,
                    'votes' => 29,
                    'bgClass' => 'bg-salad',
                    'link' => route('frontend.projects.show', $p),
                ];
            });
    }
}
