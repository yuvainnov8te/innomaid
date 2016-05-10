@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function () {
CKEDITOR.replace('content');
}); 
function showfield() {
   
}
</script>
<h3 style='margin-left:10px;'>Edit Agreement form</h3>
<hr/>
	<div class="panel-body" style="">
      {!! Form::model($agreementform,array('route' => array('sentinel.agreementform.update', $agreementform->id),'enctype'=>'multipart/form-data')) !!}
			<?php // print_r($agreementform); exit; ?>
      <input type="hidden" name="form_type" value="{{$agreementform->form_type}}">
      	<div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
				
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Agreement Title: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                        {!! Form::text('title', $agreementform->title, ['class'=> 'form-control','readonly']) !!}
                        {!! ($errors->has('title') ? $errors->first('title', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Agreement Content: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-7">
                       <textarea rows="10" cols="10" id='content' name="content" style="width: 645px; height: 150px;" placeholder="Write your content.." >{{$agreementform->content}}</textarea>
                      {!! ($errors->has('content') ? $errors->first('content', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <br />
               <div style="margin-top:20px;"class="row">
                  <div class="small-10 margin-left columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save</button>
                       <button onclick="window.location='{{ url('agreementform') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
                  </div>
              </div>

    </form>
</div>
@stop