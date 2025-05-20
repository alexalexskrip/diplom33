<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectMediaController extends Controller
{
    public function destroy(Media $media): RedirectResponse
    {
        $media->delete();

        return redirect()->back()->with('success', 'Файл удалён');
    }
}
