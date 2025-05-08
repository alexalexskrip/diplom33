<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\ProjectMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Storage;

class ProjectMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMedia $projectMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectMedia $projectMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectMedia $projectMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return RedirectResponse
     */
    public function destroy(ProjectMedia $project_medium)
    {
        Storage::disk('public')->delete('projectmedia/' . $project_medium->File_ProjectMedia);

        $project_medium->delete();

        return redirect()->back()->with('success', 'Изображение удалено');
    }
}
