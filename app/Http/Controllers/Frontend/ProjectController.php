<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return Application|Factory|ViewAlias|View
     */
    public function show(Project $project)
    {
        $project->load('users');
        return view('frontend.projects.show', compact('project'));
    }

    public function vote(Project $project): RedirectResponse
    {
        $userId = Auth::id();

        // Проверка: голосовал ли уже
        $alreadyVoted = DB::table('project_votes')
            ->where('project_id', $project->id)
            ->where('user_id', $userId)
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'Вы уже голосовали за этот проект.');
        }

        // Добавляем запись о голосовании
        DB::table('project_votes')->insert([
            'project_id' => $project->id,
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Увеличиваем счётчик голосов в проекте
        $project->increment('votes_count');

        return back()->with('success', 'Ваш голос учтён.');
    }
}
