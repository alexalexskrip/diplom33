<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $universities  = University::latest()->paginate(20);
        return view('cabinet.universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create()
    {
        return view('cabinet.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_university' => 'required|string|max:255',
            'address_university' => 'required|string|max:255',
            'phone_university' => 'required|string|max:20',
            'mail_university' => 'required|email|max:255',
        ]);

        University::create($validated);

        return redirect()->route('cabinet.universities.index')
            ->with('success', 'Университет успешно создан');
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
    public function edit(University $university)
    {
        return view('cabinet.universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'name_university' => 'required|string|max:50',
            'address_university' => 'required|string|max:255',
            'phone_university' => 'required|string|max:20',
            'mail_university' => 'required|email|max:50',
        ]);

        $university->update($validated);

        return redirect()->route('cabinet.universities.index')
            ->with('success', 'Университет успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(University $university)
    {
        $university->delete();

        return redirect()->route('cabinet.universities.index')
            ->with('success', 'Университет успешно удалён');
    }
}
