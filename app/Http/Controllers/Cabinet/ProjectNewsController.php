<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectNews;
use Illuminate\Http\Request;

class ProjectNewsController extends Controller
{
    public function index()
    {
        $projectNews = ProjectNews::with('project')->latest()->paginate(10);
        return view('cabinet.projectnews.index', compact('projectNews'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('cabinet.projectnews.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_project' => 'required|exists:projects,id',
            'date_projectnews' => 'required|date',
            'name_projectnews' => 'required|string|max:255',
            'discription_projectnews' => 'nullable|string|max:255',
        ]);

        ProjectNews::create($validated);

        return redirect()->route('cabinet.projectnews.index')->with('success', 'Новость успешно добавлена.');
    }

    public function show(ProjectNews $projectnews)
    {
        return view('cabinet.projectnews.show', compact('projectnews'));
    }

    public function edit(ProjectNews $projectnews)
    {
        $projects = Project::all();
        return view('cabinet.projectnews.edit', compact('projectnews', 'projects'));
    }

    public function update(Request $request, ProjectNews $projectnews)
    {
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
        $projectnews->delete();

        return redirect()->route('cabinet.projectnews.index')->with('success', 'Новость удалена.');
    }
}
