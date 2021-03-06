@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function () {
CKEDITOR.replace('content');
}); 
function showfield() {
   
}
</script>
<h3 style='margin-left:10px;'>Add Page</h3>
<hr/>
	<div class="panel-body" style="background-color:#f0f2f7;">
      {!! Form::model($pages,array('route' => array('sentinel.page.update', $pages->id),'enctype'=>'multipart/form-data')) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Page Title: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                        {!! Form::text('title', $pages->title, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('title') ? $errors->first('title', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Page Content: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-7">
                       <textarea rows="10" cols="10" id='content' name="content" style="width: 645px; height: 150px;" placeholder="Write your content.." >{{$pages->content}}</textarea>
                      {!! ($errors->has('content') ? $errors->first('content', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <br />
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Page Publish:</label>
                    </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                      @if($pages->is_published == 1)
                      <input name="is_published" type="checkbox" value="1" checked='checked'>
                      @else
                      <input name="is_published" type="checkbox" value="1">
                      @endif
                    </div>
                </div>

               <div style="margin-top:20px;"class="row">
                  <div class="small-10 margin-left columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save</button>
                       <button onclick="window.location='{{ url('page') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>

    </form>
</div>
@stop