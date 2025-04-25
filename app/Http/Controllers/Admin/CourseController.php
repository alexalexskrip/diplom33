<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $courses = Course::with('faculty')->orderByDesc('created_at')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        $universities = University::all();
        $faculties = Faculty::select('id', 'id_university', 'name_faculty')->get();

        return view('admin.courses.create', compact('universities', 'faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_faculty' => 'required|exists:faculties,id',
            'name_course' => 'required|string|max:255',
        ]);

        Course::create($request->only(['id_faculty', 'name_course']));

        return redirect()->route('courses.index')->with('success', 'Курс создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Course $course)
    {
        $universities = University::all();
        $faculties = Faculty::select('id', 'id_university', 'name_faculty')->get();
        $course->load('faculty');
        return view('admin.courses.edit', compact('course', 'universities', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'id_faculty' => 'required|exists:faculties,id',
            'name_course' => 'required|string|max:255',
        ]);

        $course->update($request->only(['id_faculty', 'name_course']));

        return redirect()->route('courses.index')->with('success', 'Курс обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Курс удалён');
    }
}
