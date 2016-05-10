@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">

function showfield() {
   
}
</script>
<h3 style='margin-left:10px;'>Preview template</h3>
<hr/>
	<div class="panel-body" style="">
      {!! Form::model($templates,array('route' => array('sentinel.template.update', $templates->id),'enctype'=>'multipart/form-data')) !!}

                <div class="row agreementdiv" style="max-width: 100%;">
                    
                    {!!$templates->content!!}
                      {!! ($errors->has('content') ? $errors->first('content', '<small class="error">:message</small>') : '') !!}
                       
                </div>
                <br />
               
               <div style="margin-top:20px;"class="row">
                  <div class="small-10 margin-left columns">
                       <button onclick="window.location='{{ url('template') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>

    </form>
</div>
@stop