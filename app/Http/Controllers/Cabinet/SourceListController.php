<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\SourceList;
use Illuminate\Http\Request;

class SourceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index()
    {
        $sourcelists = SourceList::query()->orderBy('name_sourcelist')->paginate(20);
        return view('cabinet.sourcelists.index', compact('sourcelists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create()
    {
        return view('cabinet.sourcelists.create');
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
            'name_sourcelist' => 'required|string|max:50',
        ]);

        SourceList::query()->create($request->only('name_sourcelist'));

        return redirect()->route('cabinet.sourcelists.index')->with('success', 'Источник добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceList  $sourceList
     * @return \Illuminate\Http\Response
     */
    public function show(SourceList $sourcelist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SourceList  $sourceList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit(SourceList $sourcelist)
    {
        return view('cabinet.sourcelists.edit', compact('sourcelist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SourceList  $sourceList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SourceList $sourcelist)
    {
        $request->validate([
            'name_sourcelist' => 'required|string|max:50',
        ]);

        $sourcelist->update($request->only('name_sourcelist'));

        return redirect()->route('cabinet.sourcelists.index')->with('success', 'Источник обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourceList  $sourceList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SourceList $sourcelist)
    {
        $sourcelist->delete();
        return redirect()->route('cabinet.sourcelists.index')->with('success', 'Источник удалён');
    }
}
