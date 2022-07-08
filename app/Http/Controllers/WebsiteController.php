<?php

namespace App\Http\Controllers;

use App\Http\Requests\Website\CreateWebsiteRequest;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:website-list|website-create|website-edit|website-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:website-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:website-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:website-delete', ['only' => ['destroy']]);
        $name = "Website";
        view()->share('name', $name);
    }
    public function index()
    {
        $websites = Website::all();
        return view('website.index', compact('websites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Website::all()->count() != 0) {
            return redirect(route('website.index'));
        }
        return view('website.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWebsiteRequest $request)
    {
        $data = $request->all();
        Website::create($data);
        session()->flash('success');
        return redirect(route('website.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        return view('website.create', compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(CreateWebsiteRequest $request, Website $website)
    {
        $data = $request->all();
        $website->update($data);
        session()->flash('success');
        return redirect(route('website.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }
}
