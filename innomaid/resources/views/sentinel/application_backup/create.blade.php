@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function () {
    $( "#tabs" ).tabs();
    $( "#tabs" ).tabs( "disable", 1 );
    $( "#tabs" ).tabs( "disable", 2 );
    $( "#tabs" ).tabs( "disable", 3 );
    $( "#tabs" ).tabs( "disable", 4 );
    $( "#tabs" ).tabs( "disable", 5 );
    $( "#tabs" ).tabs( "disable", 6 );
    $('#refer_code').keyup(function() {
      getfdwdata();
    });
}); 
function getemployerdata(employer_id) {

      var dataString='employer_id='+ employer_id;
         $.ajax({
            type:"POST",
            url:"/employer/employerinfo",
            data:dataString,
            success:function(data){
              var result = data;
              if(result !=''){
                $('#type').val(result[0].purpose_to_hire);
                var date = new Date(result[0].employer_date_of_birth);
                var dob = date.getDate() + '-' + (date.getMonth() + 1) + '-' +  date.getFullYear();
                $('.employerdetail').html('<table class="table table-bordered"><thead><tr><th class="text-center" colspan="2">Employer Details</th></tr></thead><tbody><tr><td>Name</td><td>'+result[0].employer_name+'</td></tr><tr> <td>Date of Birth</td><td>'+dob+'</td></tr><tr><td>Contact Number</td><td>'+result[0].employer_mobile_phone+'</td></tr><tr><td>Marital Status</td><td>'+result[0].marital_status+'</td></tr> <tr><td>Address</td><td>'+result[0].address+'</td></tr></tbody></table>');
            }
            else{
                $('#maid_name').val('');
                $('#nationality').val('');  
                $('#maid_id').val('');  
                $('.employerdetail').html('');          
            }
            }
      });  
}

function getfdwdata(maid_id) {
  //$('.refrence_code').text('');
   if(maid_id == ''){
    $('#refer_code').val('');
    $('.maiddetail').html('');
  }else{
  var id = $('#maid').val();  
  if(id!=''){
    var refer_code = '';
  }else{
    var refer_code = $('#refer_code').val(); 
        maid_id = '';
  }
      var dataString='refer_code='+ refer_code +'&maid_id='+ maid_id;
         $.ajax({
            type:"POST",
            url:"/fdws/fdwinfo",
            data:dataString,
            success:function(data){
              var result = data;
              if(result !=''){
                $('#maid').val(result[0].id);
                if(result[0].maid_reference_code){
                  $('#refer_code').val(result[0].maid_reference_code);
                  var date = new Date(result[0].date_of_birth);
                    var dob = date.getDate() + '-' + (date.getMonth() + 1) + '-' +  date.getFullYear();
                    $('.maiddetail').html('<table class="table table-bordered"><thead><tr><th class="text-center" colspan="2">Maid Details</th></tr></thead><tbody><tr><td>Name</td><td>'+result[0].name+'</td></tr><tr> <td>Date of Birth</td><td>'+dob+'</td></tr><tr><td>Contact Number</td><td>'+result[0].contact_number+'</td></tr><tr><td>Marital Status</td><td>'+result[0].marital_status+'</td></tr> <tr><td>Address</td><td>'+result[0].address+'</td></tr></tbody></table>');       
                }
                if(result[0].maid_reference_code == null){
                  $('#refer_code').val('');
                   $('.maiddetail').html('');
                }
              }
              else{
                 $('#maid').val('');     
                  $('.maiddetail').html('');
              }
            }
      });  
  }
}

</script>
<h3 style='margin-left:10px;'>Maid Application</h3>
<hr/>
<div id="tabs">
    <ul>
      <li><a href="#tabs-1"><span style="font-size:0.8em">Employer & Maid</span></a></li>
      <li><a href="#tabs-2"><span style="font-size:0.8em">Service & fees</span></a></li>
      <li><a href="#tabs-3"><span style="font-size:0.8em">Loan & payment</span></a></li>  
      <li><a href="#tabs-4"><span style="font-size:0.8em">Service employer & agency</span></a></li>
      <li><a href="#tabs-5"><span style="font-size:0.8em">Service employer & fdw</span></a></li>
      <li><a href="#tabs-5"><span style="font-size:0.8em">Handling & take over form</span></a></li>
      <li><a href="#tabs-5"><span style="font-size:0.8em">Job Scope</span></a></li>
    </ul>
<div class="panel-body" style="background-color:#f0f2f7;">

 
<div id="tabs-1"> 
{!! Form::open(array('route' => 'application.create' ,'enctype'=>'multipart/form-data')) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Employer: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                        {!! Form::select('employer_id', 
                            (['' => 'Select a Employer'] + $employer), 
                                'roles',
                                ['class' => ' class = "am-dropdown"  Data-am-dropdown','id' => 'employer','onchange'=>'getemployerdata(this.value)']) !!}
                        {!! ($errors->has('employer_id') ? $errors->first('employer_id', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>
                <div class="row">
                <div class="small-width18 columns">
                    <label for="Name of FDW">&nbsp</label>
                    </div>
                <div class="employerdetail col-md-6">
                </div>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Type of application: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                       {!! Form::select('type', array('' => 'Select Type', 
                        'A New FDW' => 'A New FDW', 'A Replacement' => 'A Replacement'), Input::old('type'),
                        array('class' => 'form-control')) !!}
                      {!! ($errors->has('type') ? $errors->first('type', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>

                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Maid: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                       {!! Form::select('maid_id', 
                            (['' => 'Select a Maid'] + $fdw), 
                                'roles',
                                ['class' => ' class = "am-dropdown"  Data-am-dropdown','id' => 'maid','onchange'=>'getfdwdata(this.value)']) !!}
                        {!! ($errors->has('maid_id') ? $errors->first('maid_id', '<small class="error">:message</small>') : '') !!}
                    </div>   
                    <div class="col-xs-3">
                        {!! Form::text('maid_reference_code', null, ['class'=> 'form-control','id'=>'refer_code','placeholder'=>'Maid Refrence Code']) !!}
                        <!--<small class="error refrence_code"></small>-->
                    </div>    
                </div>
                <div class="row">
                <div class="small-width18 columns">
                    <label for="Name of FDW">&nbsp</label>
                    </div>
                <div class="maiddetail col-md-6">
                </div>
                </div>
               <div style="margin-top:20px;"class="row">
                  <div class="small-10 small-offset-2 columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
                       <button onclick="window.location='{{ url('application') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>
           </form>

</div>
<div id="tabs-2"> 
</div>
<div id="tabs-3"> 
</div>
<div id="tabs-4"> 
</div>
<div id="tabs-5"> 
</div>

</div>
      
    
</div>
@stop