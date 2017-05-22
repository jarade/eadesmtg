@extends('layouts.app')

@section('title', 'EadesMTG')

@section('content')

@php
	use App\Player;
	use App\Providers\sResponse;
	session_start();
@endphp

	@include('includes.subnav')
		<script>
			function addPlayer(){
				event.preventDefault();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
					
            	$.ajax({
            		type: "PUT",
            		url: "life.update",
            		data: {
            			player: 0,
            			change: 3,
            			sessionID: {{ $_SESSION['session'] }}
            		},
            		success: function(data){
            			$(".mainContent").append(newPlayer(data));
            		}
            	});

            	
			}
			function newPlayer(player){
				return "<form id='player" +  player.playerID + "' class='form-horizontal playerDiv col-sm-4'>"
					+ "<input value='" + player.playerName + "' class='form-control' onchange='changeName(this.value, " + player + ")' />"
					+ "<input type='number' step='1' value='" + player.playerLife + "' class='form-control playerLife' onchange='changeLife(this.value, " + player + ")' />"
					+ "<input class='btn btn-color' type='submit' value='+' onclick='addLife(event, " + player + ")' />"
					+ "<input class='btn btn-color' type='submit' value='-' onclick='takeLife(event, " + player + ")' />"
					+ "<input class='btn btn-color' type='submit' value='Remove Player' onclick='removePlayer(event, " + player + ")' />"
				+ "</form>";
			}
			function removePlayer(event, player){
				event.preventDefault();

				$('#player' + player.playerID).remove();

				sendData(player, 4);
			}
			function addLife(event, player){
				event.preventDefault();
				editLife($('#lifeEdit').val(), player);
			}
			function takeLife(event, player){
				event.preventDefault();
				editLife(-$('#lifeEdit').val(), player);
			}
			function editLife(val, player){
				var currentLife = $('#player' + player.playerID + ' .playerLife').val();

				var newValue = parseInt(currentLife) + parseInt(val);

				$('#player' + player.playerID + ' .playerLife').val(newValue);

				changeLife(newValue, player);
			}
			function changeName(val, player){
				player.playerName = val;
				sendData(player, 0);
			}
			function changeLife(val, player){
				player.playerLife = val;
				sendData(player, 1);
			}
			function sendData(player, changeID){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
					
            	$.ajax({
            		type: "PUT",
            		url: "life.update",
            		data: {
            			player : player,
            			change: changeID
            		},
            		success: function(data){
            			console.log(data);
            		}
            	});
			}
		</script>

	<div class="homeWrap">
		<div class="sidebar">
			<label for='lifeEdit' class='control-label'>Life Edit Value</label>
			<input id='lifeEdit' type='number' value='1' min='-50' max='50' step='1' class='form-control'>


			<form class="form-horizontal">
				<label for='totalLife' class='control-label'>Total Life</label>

				<input id='totalLife' type='number' value='20' min='1' step='1' class='form-control'>
				<br>
				<input class="btn btn-color" type="submit" value="Apply Life" />
			</form>
			<br>
			<form class="form-horizontal">
				<input class="btn btn-color" type="submit" value="Add Player" onclick='addPlayer()' />

				<input class="btn btn-color" type="submit" value="Refresh" />
			</form>

			<h1>Instructions</h1>
			<p>The life edit value field is connected to the +/- buttons. The + button adds the value to the corrosponding life total while the - button takes the value away from the life total</p>
		</div>

		<div class='mainContent'>

			@php

				if(isset($_SESSION['session'])){

					$players = App\Player::all()->where('sessionID', '=', $_SESSION['session']);

					foreach($players as $player){
						echo "<form id='player" .  $player->playerID . "' class='form-horizontal playerDiv col-sm-4'>";

							echo "<input value='" . $player->playerName . "' class='form-control' onchange='changeName(this.value, ". $player . ")' />";

							echo "<input type='number' step='1' value='" . $player->playerLife . "' class='form-control playerLife' onchange='changeLife(this.value, ". $player . ")' />";

							echo "<input class='btn btn-color' type='submit' value='+' onclick='addLife(event, " . $player . ")' />";

							echo "<input class='btn btn-color' type='submit' value='-' onclick='takeLife(event, " . $player . ")' />";

							echo "<input class='btn btn-color' type='submit' value='Remove Player' onclick='removePlayer(event, " . $player . ")' />";
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