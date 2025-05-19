<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectNewsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $projectNews = ProjectNews::with('project')->latest()->paginate(10);
        } else {
            $projectNews = ProjectNews::whereHas('project.users', function ($q) {
                $q->where('users.id', auth()->id());
            })->with('project')->latest()->paginate(10);
        }

        return view('cabinet.projectnews.index', compact('projectNews'));
    }

    public function create()
    {
        $this->authorize('create', ProjectNews::class);

        $projects = Auth::user()->projects()->get();
        return view('cabinet.projectnews.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', ProjectNews::class);

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $project = auth()->user()->projects()->findOrFail($validated['project_id']);

        $project->news()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('cabinet.projectnews.index')->with('success', 'Новость успешно добавлена.');
    }

    public function show(ProjectNews $projectnews)
    {
        $this->authorize('view', $projectnews);
        return view('cabinet.projectnews.show', compact('projectnews'));
    }

    public function edit(ProjectNews $projectnews)
    {
        $this->authorize('update', $projectnews);
        $projects = auth()->user()->projects;
        return view('cabinet.projectnews.edit', compact('projectnews', 'projects'));
    }

    public function update(Request $request, ProjectNews $projectnews)
    {
        $this->authorize('update', $projectnews);

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $projectnews->update($validated);

        return redirect()->route('cabinet.projectnews.index')->with('success', 'Новость успешно обновлена.');
    }

    public function destroy(ProjectNews $projectnews)
    {
        $this->authorize('delete', $projectnews);
        $projectnews->delete();

        return redirect()->route('cabinet.projectnews.index')->with('success', 'Новость удалена.');
    }
}
