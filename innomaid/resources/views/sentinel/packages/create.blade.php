@extends('sentinel.layouts.default')
@section('content')

<script type="text/javascript">
$(function () {
  initSample();
}); 
function showfield() {
   
}
</script>
<h3 style='margin-left:10px;'>Add Package</h3>
<hr/>
<div class="panel-body" style="">
      {!! Form::open(array('route' => 'package.create' ,'enctype'=>'multipart/form-data')) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Package Name: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                        {!! Form::text('package_name', null, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('package_name') ? $errors->first('package_name', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Package Description: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-7">
                       <textarea rows="10" cols="10" id='content' name="package_description" style="width: 645px; height: 150px;" placeholder="Write your content.." ></textarea>
                      {!! ($errors->has('package_description') ? $errors->first('package_description', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <br />
               <div style="margin-top:20px;"class="row">
                  <div class="small-10 margin-left columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save</button>
                       <button onclick="window.location='{{ url('package') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>

    </form>
</div>
@stop