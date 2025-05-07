<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\University;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $groups = Group::with('course.faculty.university')->latest()->paginate(10);
        return view('cabinet.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create()
    {
        $universities = University::all();
        $faculties = Faculty::select('id', 'id_university', 'name_faculty')->get();
        $courses = Course::select('id', 'id_faculty', 'name_course')->get();

        return view('cabinet.groups.create', compact('universities', 'faculties', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_course' => 'required|exists:courses,id',
            'name_group' => 'required|string|max:255',
        ]);

        Group::create($request->only(['id_course', 'name_group']));

        return redirect()->route('cabinet.groups.index')->with('success', 'Группа создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit(Group $group)
    {
        $universities = University::all();
        $faculties = Faculty::select('id', 'id_university', 'name_faculty')->get();
        $courses = Course::select('id', 'id_faculty', 'name_course')->get();

        $group->load('course.faculty');

        return view('cabinet.groups.edit', compact('group', 'universities', 'faculties', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'id_course' => 'required|exists:courses,id',
            'name_group' => 'required|string|max:255',
        ]);

        $group->update($request->only(['id_course', 'name_group']));

        return redirect()->route('cabinet.groups.index')->with('success', 'Группа обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('cabinet.groups.index')->with('success', 'Группа удалена');
    }
}
