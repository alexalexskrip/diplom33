<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $statuslists = Status::query()->orderBy('name')->paginate(20);
        return view('cabinet.statuslists.index', compact('statuslists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        return view('cabinet.statuslists.create');
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

        Status::query()->create($request->only('name'));

        return redirect()->route('cabinet.statuslists.index')->with('success', 'Статус добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  Status  $statusList
     * @return Response
     */
    public function show(Status $statuslist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Status  $statuslist
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Status $statuslist)
    {
        return view('cabinet.statuslists.edit', compact('statuslist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Status  $statuslist
     * @return RedirectResponse
     */
    public function update(Request $request, Status $statuslist)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $statuslist->update($request->only('name'));

        return redirect()->route('cabinet.statuslists.index')->with('success', 'Статус обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Status  $statuslist
     * @return RedirectResponse
     */
    public function destroy(Status $statuslist)
    {
        $statuslist->delete();
        return redirect()->route('cabinet.statuslists.index')->with('success', 'Статус удалён');
    }
}
