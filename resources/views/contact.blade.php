@extends('layouts.app')

@section('title', 'EadesMTG Contact Us')

@section('content')
    <form class="form-horizontal">
        <fieldset>
          <legend>Contact Form</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Name: </label>
            <div class="col-sm-10">
              <input type="text" name="subject" id="input-name" class="form-control" placeholder="Your Name" />
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">Email: </label>
            <div class="col-sm-10">
              <input type="text" name="email" placeholder="Your Email" id="input-email" class="form-control" />

             
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-enquiry">Message: </label>
            <div class="col-sm-10">
              <textarea name="body" rows="10" id="input-enquiry" class="form-control" placeholder="Your Message"></textarea>
              <div class="text-danger"></div>
             
            </div>
          </div>
        </fieldset>
        <div class="buttons">
          <div class="pull-right">
            <input class="btn btn-color" type="submit" value="Submit" />
          </div>
        </div>
      </form>
@endsection