<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $name = "Users OPD";
        view()->share('name', $name);
    }
    public function index()
    {
        $users = User::where('email', '!=', 'satriotol69@gmail.com')->has('opd')->get();
        return view('userOpd.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        return view('userOpd.create', compact('opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'opd_id' => 'required',
        ]);
        $data['password'] = Hash::make('esakipsemarang987');
        $user = User::create($data);
        $role = Role::where('name', 'OPD')->first()->id;
        $user->assignRole($role);
        session()->flash('success');
        return redirect(route('userOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $userOpd)
    {
        $opds = Opd::getOpd();
        return view('userOpd.create', compact('userOpd', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $userOpd)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $userOpd->email,
            'opd_id' => 'required',
        ]);
        $userOpd->update($data);
        session()->flash('success');
        return redirect(route('userOpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
