@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
var $ = jQuery.noConflict();
$(function () {
$("#p_fee").hide();
$("#s_fee").show();
$('input[type="checkbox"]').click(function(){
        if($("#package_fee").is(':checked')){
   // $('.fee').val('');
    $(".fee").attr("disabled","");
    $(".package").removeAttr("disabled"); 
    $('#package_fee').val('1');
    $("#s_fee").hide();
    $("#p_fee").show();
    }
    else{
    $(".package").attr("disabled","");
   // $('.package').val('');
    $(".fee").removeAttr("disabled"); 
    $('#package_fee').val('0');
    $("#p_fee").hide();
    $("#s_fee").show();
    }
    }); 
});


</script>
<h3 style='margin-left:10px;'>Add @if($_REQUEST['mode'] == 'newtransfer') {{'New/Transfer'}} @else {{'Replacement'}} @endif Service</h3>
<hr/>
<div class="panel-body" style="">
    {!! Form::open(array('route' => 'service.create' ,'enctype'=>'multipart/form-data')) !!}
    <Input type="hidden" name="mode" value="{{$_REQUEST['mode']}}">
                <div class="small-10 columns">
                    <p><span class="mandatory" style="padding-left:10px;">*</span> Fields are required</p>
                </div>
               <div class="row">
                    <div class="small-width18 columns"><label for="Name of FDW" >Service Title: <span class="mandatory">*</span> </label>
          </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
          {!! Form::text('title', null, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('title') ? $errors->first('title', '<small class="error">:message</small>') : '') !!} 
            </div>
                </div>
                 <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Fee According to Package?</label>
                    </div>
                    @if($packageList->count() === 0)
                   <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                      <input name="according_package" type="checkbox" id="package_fee" disabled> No Package Available.
                    </div>
                    @else
                     <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                      <input name="according_package" type="checkbox" id="package_fee">
                    </div>
                     
                    @endif
                </div>
         <div class="row" style="max-width: 100%;" id="s_fee">
                    <div class="small-width18 columns">
                    <label for="Name of FDW"  >Service Fee:<span class="mandatory">*</span> </label>
          </div>                  
           <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                      {!! Form::text('price', null, ['class'=> 'form-control fee','placeholder' => 'S$']) !!}
                      {!! ($errors->has('price') ? $errors->first('price', '<small class="error">:message</small>') : '') !!}
          </div>
                </div>
         <div class="row" style="max-width: 100%;" id="p_fee">
                    <div class="small-width18 columns">
                    <label for="Name of FDW"  >Package Service Fee:<span class="mandatory">*</span> </label>
          </div>                  
           <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
           <table style="border:none;"><tbody>
           @if ($packageList->count() === 0)
                    <tr>
                        <td colspan="11" style="padding:0px;"><center> <b>No Package Found.</b></center></td>
                    </tr>
          @else
           @foreach ($packageList as $plan)
          <input type="hidden" name="package_id[]" value="<?php echo $plan->id; ?>">
           <tr><td style="padding:0px;"> <input type="text" name='package[]' value="<?php echo $plan->package_name; ?>" class= 'form-control ' readonly> </td>
           <td style="padding:0px 0px 0px 9px; ">
                     <input type="text" name='package_price[]' class='form-control' placeholder='S$'>
            </td>
            </tr>
             @endforeach
          @endif
          </tbody>
            </table>{!! ($errors->has('package_price') ? $errors->first('package_price', '<small class="error">:message</small>') : '') !!}
          </div>
                </div>
        
                <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Fee Type:<span class="mandatory">*</span> </label>
                    </div>                  
           <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                       {!! Form::select('type', array('' => 'Select Fee Type', 
                        'S' => 'Service Fee', 'P' => 'Placement Fee'), Input::old('type'),
                        array('class' => 'form-control')) !!}
                        {!! ($errors->has('type') ? $errors->first('type', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>
		 <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Selected by default. </label>
                    </div>
                     <div class="col-xs-5 ">
                      <input name="default_selected" type="checkbox" value='Y'>
                    </div>
                 </div>
                 <div style="margin-top:20px;"class="row">
                  <div class="small-10 margin-left columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list"  style="padding-left:10px;">Save</button>
                       @if($_REQUEST['mode'] == 'newtransfer') 
             <?php $url='service/?mode=newtransfer'?> @else <?php $url='service/?mode=replacement' ?> @endif
             <button onclick="window.location='{{ url($url) }}' " class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>
    </form>
  </div>
<script type="text/javascript">

</script>
@stop
