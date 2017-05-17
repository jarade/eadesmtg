@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')
	@php
		use App\Player;
		use App\Providers\sResponse;
		session_start();
	@endphp

	@include('includes.subnav')

	<div class='players row'>
	@php
		if(isset($_SESSION['session'])){
			$players = App\Player::all()->where('sessionID', '=', $_SESSION['session']);

			foreach($players as $player){
				echo "<div class='playerDiv text-center col-xs-12 col-sm-6 col-md-4 col-lg-3'>";

					echo "<h1 class='playerName'>" . $player->playerName . "</h1>"; 

					echo "<h2 class='playerLife' />" . $player->playerLife . "</h2>";

				echo "</div>";
			}
		}else{
			echo "You have not logged into a session. Redirecting to the home page...";
			header('Location:' . url('/'));
			exit();
		}
	@endphp
	</div>
@endsection