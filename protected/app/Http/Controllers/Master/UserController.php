<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parse['data'] = $this->user->latest()->get();
        return view('admin.page.master.user.default',$parse);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parse['data'] = [];
        $parse['action'] = route('admin.user.store');
        return view('admin.page.master.user.add',$parse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $post = $request->input();

        $user = $this->user;
        $post['password'] = \Hash::make($post['password']);
        $user->fill($post);
        $user->save();

        return redirect(route('admin.user.index'))
                    ->withMessage('Success save data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $parse['row'] = $this->user->whereSlug($slug)->firstOrFail();
        $parse['action'] = route('admin.user.update',$slug);
        return view('admin.page.master.user.add',$parse);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $parse['row'] = $this->user->whereSlug($slug)->firstOrFail();
        $parse['action'] = route('admin.user.update',$slug);
        return view('admin.page.master.user.add',$parse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $slug)
    {
        $post = $request->input();

        $user = $this->user->whereSlug($slug)->firstOrFail();
        if(!empty($post['password'])):
            $post['password'] = \Hash::make($post['password']);
        else:
            array_pull($post,'password');
        endif;
        $user->fill($post);
        $user->save();

        return redirect(route('admin.user.index'))
                    ->withMessage('Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = $this->user->whereSlug($slug)->firstOrFail();
        $deleted = $user->delete();

        return redirect(route('admin.user.index'))
                    ->withMessage('Success delete data');
    }
}
