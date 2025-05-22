<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProjectNews;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function memo(): Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('frontend.pages.memo');
    }

    public function about(): Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('frontend.pages.about');
    }

    public function news(): Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        $projectNews = ProjectNews::with('project')
            ->latest()
            ->paginate(10);

        return view('frontend.pages.news', compact('projectNews'));
    }

    public function howItWorks()
    {
        return view('frontend.pages.page_how_it_works_view');
    }

    public function faq()
    {
        return view('frontend.pages.page_faq_view');
    }
}
