@extends('layouts.app')

@section('title', 'EadesMTG Contact Us')

@section('content')
    <div class='content container'>
      <form class="form-horizontal" action="mailto:jarrod.eades@hotmail.com" method="post" enctype="text/plain">
        {{ csrf_field() }}
        <fieldset>
          <legend><h1>Contact Form</h1></legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="name">Name: </label>
            <div class="col-sm-10">
              <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" />
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="mail">Email: </label>
            <div class="col-sm-10">
              <input type="email" name="mail" placeholder="Your Email" id="mail" class="form-control" />
  
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="comment">Message: </label>
            <div class="col-sm-10">
              <textarea name="comment" rows="10" id="comment" class="form-control" placeholder="Your Message"></textarea>
              <div class="text-danger"></div>
             
            </div>
          </div>
        </fieldset>
        <div class="buttons">
          <div class="pull-right">
            <input class="btn btn-color" type="submit" value="Send" />
          </div>
        </div>
      </form>
    </div>
@endsection