<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $faculties = Faculty::with('university')->latest()->paginate(10);
        return view('admin.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        $universities = University::all();
        return view('admin.faculties.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_university' => 'required|exists:universities,id',
            'name_faculty' => 'required|string|max:255',
        ]);

        Faculty::create($request->only(['id_university', 'name_faculty']));

        return redirect()->route('faculties.index')->with('success', 'Факультет создан');
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
    public function edit(Faculty $faculty)
    {
        $universities = University::all();
        return view('admin.faculties.edit', compact('faculty', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'id_university' => 'required|exists:universities,id',
            'name_faculty' => 'required|string|max:255',
        ]);

        $faculty->update($request->only(['id_university', 'name_faculty']));

        return redirect()->route('faculties.index')->with('success', 'Факультет обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Faculty  $faculty
     * @return RedirectResponse
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Факультет удалён');
    }
}
