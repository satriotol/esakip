<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapaianKinerja\CreateLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\CapaianKinerja\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:link-list|link-create|link-edit|link-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:link-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:link-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:link-delete', ['only' => ['destroy']]);
        $name = "Link Terkait Capaian Kinerja";
        view()->share('name', $name);
    }
    public function index()
    {
        $links = Link::all();
        return view('capaian_kinerja.link.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Link::TYPES;
        return view('capaian_kinerja.link.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLinkRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->image;
        Link::create($data);
        session()->flash('success');
        return redirect(route('link.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CapaianKinerja\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CapaianKinerja\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        $types = Link::TYPES;

        return view('capaian_kinerja.link.create', compact('link', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CapaianKinerja\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $data = $request->all();
        if ($request->image) {
            $data['image'] = $request->image;
            $link->deleteFile();
        };
        $link->update($data);
        session()->flash('success');
        return redirect(route('link.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CapaianKinerja\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        $link->deleteFile();
        session()->flash('success');
        return redirect(route('link.index'));
    }
    public function store_file(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->image;
            $filename = date('Ymd_His') . '-' . $image->getClientOriginalName();
            $data['image'] = $image->storeAs('file', $filename, 'public_uploads');
            return $data['image'];
        };
        return 'success';
    }
}
