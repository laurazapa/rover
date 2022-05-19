<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\Rover;
use App\Models\Direction;


class RoverController extends Controller
{
    public function index(){
        return view('rover');
    }
    
    public function execute(Request $request){

        // FER VALIDACIÓ AMB EXPRESSIONS REGULARS!!
        $validated = $request->validate([
            'starting_x' => 'required|integer|min:0|max:199',
            'starting_y' => 'required|integer|min:0|max:199',
            'starting_direction' => 'required|string|max:1',
            'commands' => 'required|string|min:1',
        ]);

        $result = Rover::execute($request->commands, $request->starting_direction, $request->starting_x, $request->starting_y);
        // dd($result);
        
        return redirect()->back()->with('result', $result)->withInput();

    }

    
}
