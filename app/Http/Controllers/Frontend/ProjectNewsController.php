<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProjectNews;
use Illuminate\Http\Request;

class ProjectNewsController extends Controller
{
    public function show(ProjectNews $news)
    {
        $news->load('project');
        return view('frontend.project-news.show', compact('news'));
    }
}
