<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postNotifications = auth()->user()->unreadNotifications;
        return view('postss.index', compact('postNotifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
      //Marca todas las notificaciones no lídas como leídas
      public function mark_as_read(){
        auth()->user()->unreadNotifications->markAsread();
        return redirect()->back();//te retorna a la misma vista
    }
    //Marca todas una notficacion no lída como leída
    public function markone_as_read($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsread();
        return redirect()->back();//te retorna a la misma vista
    }
    //Elimina todas las notificaciones leídas
    public function delet_full_notify_read(){
        auth()->user()->readNotifications->each->delete();
        return redirect()->back();//te retorna a la misma vista
    }
}
