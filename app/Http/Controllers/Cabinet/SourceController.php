<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $sourcelists = Source::query()->orderBy('name')->paginate(20);
        return view('cabinet.sourcelists.index', compact('sourcelists'));
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
            'name' => 'required|string|max:50',
        ]);

        Source::query()->create($request->only('name'));

        return redirect()->route('cabinet.sourcelists.index')->with('success', 'Источник добавлен');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        return view('cabinet.sourcelists.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Source  $sourceList
     * @return Response
     */
    public function show(Source $sourcelist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Source  $sourceList
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Source $sourcelist)
    {
        return view('cabinet.sourcelists.edit', compact('sourcelist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Source  $sourceList
     * @return RedirectResponse
     */
    public function update(Request $request, Source $sourcelist)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $sourcelist->update($request->only('name'));

        return redirect()->route('cabinet.sourcelists.index')->with('success', 'Источник обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Source  $sourceList
     * @return RedirectResponse
     */
    public function destroy(Source $sourcelist)
    {
        $sourcelist->delete();
        return redirect()->route('cabinet.sourcelists.index')->with('success', 'Источник удалён');
    }
}
