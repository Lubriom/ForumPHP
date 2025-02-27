<?php

namespace App\Http\Controllers;

use App\Http\Requests\HiloRequest;
use App\Models\Hilo;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class HiloController extends Controller
{
    public function index()
    {
        $hilo = Hilo::with('user')->withCount('post as post_total')->orderBy('created_at', 'desc')->get();
        return view('main')->with('hilos', $hilo);
    }  

    public function addHilo()
    {
        return view('control.formhilo');
    } 
     
    public function createHilo(HiloRequest $request) {  
        Hilo::create([
            'titulo' => $request->input('hiloname'), 
            'mensaje' => $request->input('hilomsg'), 
            'user_id' => auth()->guard('web')->user()->id,
        ]);

        return redirect(route('home'));
    }
}
