<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

use App\Session;
use App\Player;

class LifeCounter extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lifeView');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = new Session;

        $session->email = $request->email;
        $session->password = $request->pass;
        $session->salt = Hash::make($request->pass);
      
        $session->save();

        for($numPlayer = 0; $numPlayer < $request->playerNum; $numPlayer++){
            $player = new Player;

            $player->playerName = "player" . (1+$numPlayer);
            $player->playerLife = 20;
            $player->sessionID = $session->sessionID;

            $player->save();
         }

         session_start();
         $_SESSION['session'] = $session->sessionID;

         return url('life');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        switch($id){
            case 0:
                return view('lifeView');
            case 1:
                return view('life');
        }
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
        $player = Player::find($request->player["playerID"]);
        
        switch($request->change){
            case 0: // Change Name
                $player->playerName = $request->player["playerName"];
                $player->save();
                break;
            case 1: // Change Life
                $player->playerLife = $request->player["playerLife"];
                $player->save();
                break;
            case 2: break; // all life
            case 3: // add player
                $player = new Player;

                $player->playerName = "player" . (1+$numPlayer);
                $player->playerLife = 20;
                $player->sessionID = $session->sessionID;

                $player->save();
                break;
            case 4: // remove player
                $player->delete();
                break;

        }
        return 'yay';
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
