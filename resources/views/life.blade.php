@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')
	@include('includes.subnav')

	<div class="homeWrap">
		<div class="sidebar">
			<form class="form-horizontal">
				<label for='lifeEdit' class='control-label'>Life Edit Value</label>

				<input id='lifeEdit' type='number' value='1' min='-50' max='50' step='1' class='form-control'>

				<label for='totalLife' class='control-label'>Total Life</label>

				<input id='totalLife' type='number' value='20' min='1' step='1' class='form-control'>

				<br>
				<input class="btn btn-color" type="submit" value="Add Player" />

				<input class="btn btn-color" type="submit" value="Refresh" />
			</form>

			<h1>Instructions</h1>
			<p>The life edit value field is connected to the +/- buttons. The + button adds the value to the corrosponding life total while the - button takes the value away from the life total</p>
		</div>

		<div class='mainContent'>
			@php
				use App\Player;
				use App\Providers\sResponse;
				session_start();

				if(isset($_SESSION['session'])){

					$players = App\Player::all()->where('sessionID', '=', $_SESSION['session']);

					foreach($players as $player){
						echo "<form class='form-horizontal playerDiv'>";

							echo "<input value='" . $player->playerName . "' class='form-control' />";

							echo "<input value='" . $player->playerLife . "' class='form-control' />";

							echo "<input class='btn btn-color' type='submit' value='+' />";

							echo "<input class='btn btn-color' type='submit' value='-' />";

							echo "<input class='btn btn-color' type='submit' value='Remove Player' />";
						echo "</form>";
					}
				}else{
					echo "You have not logged into a session. Redirecting to the home page...";
					header('Location:' . url('/'));
					exit();
				}
			@endphp
		</div>
	</div>
@endsection