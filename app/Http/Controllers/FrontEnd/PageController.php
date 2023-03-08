<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        Page::where('id', $page->id)->update(['views' => ($page->views + 1)]);
        return view('frontend.detailpage', [
            'title_bar' => $page->title,
            'page'      => $page
        ]);
    }
}
