<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StatusListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $statuslists = StatusList::query()->orderBy('namesource_net')->paginate(20);
        return view('admin.statuslists.index', compact('statuslists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        return view('admin.statuslists.create');
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
            'namesource_net' => 'required|string|max:50',
        ]);

        StatusList::query()->create($request->only('namesource_net'));

        return redirect()->route('statuslists.index')->with('success', 'Статус добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  StatusList  $statusList
     * @return Response
     */
    public function show(StatusList $statuslist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  StatusList  $statuslist
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(StatusList $statuslist)
    {
        return view('admin.statuslists.edit', compact('statuslist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  StatusList  $statuslist
     * @return RedirectResponse
     */
    public function update(Request $request, StatusList $statuslist)
    {
        $request->validate([
            'namesource_net' => 'required|string|max:50',
        ]);

        $statuslist->update($request->only('namesource_net'));

        return redirect()->route('statuslists.index')->with('success', 'Статус обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StatusList  $statuslist
     * @return RedirectResponse
     */
    public function destroy(StatusList $statuslist)
    {
        $statuslist->delete();
        return redirect()->route('statuslists.index')->with('success', 'Статус удалён');
    }
}
