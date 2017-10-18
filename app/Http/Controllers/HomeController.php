<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
     public function upload()
    {
         dd(\Request::all());
         $file = \Request::file('file');
         $userId = \Request::get('userid');
         $storagePath = storage_path().'/arquivos/'.$userId;
         $fileName = $file->getClientOriginalName();
         
         $fileModel = new \App\Arquivo();
         $fileModel->name = $fileName;
         
         $user = \App\User::find($userId);
         $user->arquivos()->save($fileModel);
         
         return $file->move($storagePath,$fileName);
    }
}
