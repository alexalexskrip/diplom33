<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Network;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class NetworklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $networklists = Network::query()->orderBy('name_networkList')->paginate(20);
        return view('cabinet.networklists.index', compact('networklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        return view('cabinet.networklists.create');
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
            'name_networkList' => 'required|string|max:50',
            'site_netWWorklist' => 'required|url|max:50',
        ]);

        Network::create($request->only(['name_networkList', 'site_netWWorklist']));

        return redirect()->route('cabinet.networklists.index')->with('success', 'Сеть добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  Network  $networklist
     * @return Response
     */
    public function show(Network $networklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Network  $networklist
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Network $networklist)
    {
        return view('cabinet.networklists.edit', compact('networklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Network  $networklist
     * @return RedirectResponse
     */
    public function update(Request $request, Network $networklist)
    {
        $request->validate([
            'name_networkList' => 'required|string|max:50',
            'site_netWWorklist' => 'required|url|max:50',
        ]);

        $networklist->update($request->only(['name_networkList', 'site_netWWorklist']));

        return redirect()->route('cabinet.networklists.index')->with('success', 'Сеть обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Network  $networklist
     * @return RedirectResponse
     */
    public function destroy(Network $networklist)
    {
        $networklist->delete();
        return redirect()->route('cabinet.networklists.index')->with('success', 'Сеть удалена');
    }
}
