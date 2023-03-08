<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages', [
            'title_bar' => 'Halaman',
            'pages'     => Page::with('user')->latest()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pagecreate', [
            'title_bar' => 'Halaman Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:255', 'unique:pages'],
            'image' => ['image', 'file', 'max:2048'],
            'body'  => ['required']
        ]);
        $data['slug'] = SlugService::createSlug(Page::class, 'slug', $request->title);
        $data['image'] = $request->hasFile('image') ? $request->image->store('uploads') : NULL;
        $data['user_id'] = auth()->user()->id;
        $data['status'] = true;

        Page::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return response()->json($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $user = auth()->user();
        if (($user->id !== $page->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        return view('dashboard.pageedit', [
            'title_bar' => 'Perbarui Halaman',
            'page'      => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $user = auth()->user();
        if (($user->id !== $page->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        $data = $request->validate([
            'title' => $request->title !== $page->title ? ['required', 'min:5', 'max:255', 'unique:pages'] : ['required', 'min:5', 'max:255'],
            'image' => ['image', 'file', 'max:2048'],
            'body'  => ['required']
        ]);
        $data['slug'] = $request->title !== $page->title ? SlugService::createSlug(Page::class, 'slug', $request->title) : $page->slug;
        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::delete($page->image);
            }
            $data['image'] = $request->image->store('uploads');
        }

        Page::where('id', $page->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $user = auth()->user();
        if (($user->id !== $page->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        // if ($page->image) {
        //     Storage::delete($page->image);
        // }
        Page::destroy($page->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'image|file|max:2048']);
        if ($request->hasFile('file')) {
            $filenamewithextension = $request->file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $request->file->storeAs('attachments', $filenametostore);
            $path = asset('storage/attachments/' . $filenametostore);
            return $path;
        } else {
            abort(403);
        }
    }
}
