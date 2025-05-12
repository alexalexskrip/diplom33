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
        $projectNews = ProjectNews::whereHas('project.users', function ($q) {
            $q->where('id', auth()->id());
        })->with('project')->latest()->paginate(10);
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
            'id_project' => 'required|exists:projects,id',
            'date_projectnews' => 'required|date',
            'name_projectnews' => 'required|string|max:255',
            'discription_projectnews' => 'nullable|string|max:255',
        ]);

        $project = auth()->user()->projects()->findOrFail($validated['id_project']);

        $project->news()->create([
            'date_projectnews' => $validated['date_projectnews'],
            'name_projectnews' => $validated['name_projectnews'],
            'discription_projectnews' => $validated['discription_projectnews'] ?? null,
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
            'id_project' => 'required|exists:projects,id',
            'date_projectnews' => 'required|date',
            'name_projectnews' => 'required|string|max:255',
            'discription_projectnews' => 'nullable|string|max:255',
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
