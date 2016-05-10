@extends('sentinel.layouts.default')
@section('content')
<?php 
$value = \Session::get('trmp_frm');
$employer_name='';
if(isset($value['employer_name'])){ $employer_name=$value['employer_name']; }
if(isset($value['employer_id'])){ $employer_id=$value['employer_id'];}else{$employer_id='';}
if(session()->has('employer_id_app')){$e_id=session('employer_id_app'); $employer_id = $e_id[0];
	$e_name=session('employer_name'); $employer_name = $e_name[0];  }
$maid_name='';
if(isset($value['maid_name'])){ $maid_name=$value['maid_name']; }
if(isset($value['maid_id'])){ $maid_id=$value['maid_id'];}else{$maid_id='';}
if(session()->has('maid_id_app')){ $m_id=session('maid_id_app'); $maid_id = $m_id[0]; 
	$m_name=session('maid_name'); $maid_name = $m_name[0]; 
	}

if(isset($value['type'])){ $type=$value['type'];}else{$type='';}
if(isset($value['maid_app_reference_number'])){ $maid_app_reference_number=$value['maid_app_reference_number']; }else{$maid_app_reference_number='';}
if(isset($value['maid_reference_code'])){ $maid_reference_code=$value['maid_reference_code']; }else{$maid_reference_code='';}
if(isset($value['previous_loan'])){ $previous_loan=$value['previous_loan']; }else{$previous_loan='';}
?>
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
           if(result[0].status==""){$('#type')
    .find('option')
    .remove(); $('select[id="type"]').append('<option value="">Select Type</option><option value="A Replacement" selected>A Replacement</option><option value="An Additional FDW">An Additional FDW</option>');}
		else{$('#type')
    .find('option')
    .remove(); $('select[id="type"]').append('<option value="">Select Type</option><option value="A New FDW" selected >A New FDW</option>');}
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
                  $('#maid').val(result[0][0].id);
                  if(result[0][0].maid_reference_code){
                    $('#refer_code').val(result[0][0].maid_reference_code);
                    var date = new Date(result[0][0].date_of_birth);
                    var dob = date.getDate() + '-' + (date.getMonth() + 1) + '-' +  date.getFullYear();
                    $('.maiddetail').html('<table class="table table-bordered"><thead><tr><th class="text-center" colspan="2">Maid Details</th></tr></thead><tbody><tr><td>Name</td><td>'+result[0][0].name+'</td></tr><tr> <td>Date of Birth</td><td>'+dob+'</td></tr><tr><td>Contact Number</td><td>'+result[0][0].contact_number+'</td></tr><tr><td>Marital Status</td><td>'+result[0][0].marital_status+'</td></tr> <tr><td>Address</td><td>'+result[0][0].address+'</td></tr></tbody></table>');       
                  }
                  if(result[0][0].maid_reference_code == null){
                    $('#refer_code').val('');
                    $('.maiddetail').html('');
                  }
                  if(result[1].carry_forward_loan){ $('#loan').val(result[1].carry_forward_loan);   } else {$('#loan').val('');   }

                }
                else{
                   $('#maid').val('');   
                   $('.maiddetail').html('');  
                    $('#loan').val('');   
                }
              }
        });  
  }
}
//Used Select2 helper to get data
$(function(){ 
    $('#employer_id').select2({
		width: '100%',
		placeholder: "Enter Employer Name",
		triggerChange: true,
		
       
	ajax: {
            type: "POST",
            url: "{{url('/application/autocompleteemployer')}}",
            data: function (employer_id) {
            return {
                word: employer_id,
            };
        },
           // async: true,
           results:  function(data){ 
		var results = [];
		
			 	
			  $.each(data.result, function(key, value){ 
						
				results.push({
					id: value.id,
					text: value.employer_name, 
				}); });
		return {
              results: results,
			
          };
		
            } 
        },initSelection: function(element, callback){ callback({id: element.val(), text:'<?php echo $employer_name; ?>'}) }, 
    }).select2('val', []);
 $('#maid_id').select2({
		width: '100%',
		placeholder: "Enter Maid Name",
		 allowClear: true,
        
	ajax: {
            type: "POST",
            url: "{{url('/application/autocompletemaid')}}",
            data: function (maid_id) {
            return {
                word: maid_id,
            };
        },
           // async: true,
           results:  function(data){ 
		var results = [];
		
			 	
			  $.each(data.result, function(key, value){ 
				results.push({
					id: value.id,
					text: value.name, 
				}); });
		return {
              results: results,
			
          };
		
            }
        },
	initSelection: function(element, callback){ callback({id: element.val(), text:'<?php echo $maid_name; ?>'}) }, 
    }).select2('val', []);

$("#employer_id").val('<?php echo $employer_id; ?>').trigger('change.select2');
$("#maid_id").val('<?php echo $maid_id; ?>' ).trigger('change.select2');
});
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
<div class="panel-body" style="">

 
<div id="tabs-1"> 
{!! Form::open(array('route' => 'application.create' ,'enctype'=>'multipart/form-data')) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Employer: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-4">
                       <!-- {!! Form::select('employer_id', 
                            (['' => 'Select a Employer'] + $employer), 
                                'roles',
                                ['class' => ' class = "am-dropdown"  Data-am-dropdown','id' => 'employer','onchange'=>'getemployerdata(this.value)']) !!} -->
			<input  name="employer_id" id="employer_id" onchange='getemployerdata(this.value)' >
                        {!! ($errors->has('employer_id') ? $errors->first('employer_id', '<small class="error">:message</small>') : '') !!}
                    </div>
                    <div class="col-xs-1">
                      <a class="fa fa-plus-square" id='employer_app' data-toggle="tooltip" title="Create new employer"></a>
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
                    <div class="col-xs-4">
                       <select id="type" name="type" ><option value="">Select Type</option></select>
                      {!! ($errors->has('type') ? $errors->first('type', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Reference number: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-4">
                       {!! Form::text('maid_app_reference_number', $maid_app_reference_number, ['class'=> 'form-control','id'=>'maid_app_reference_number']) !!}
                      {!! ($errors->has('maid_app_reference_number') ? $errors->first('maid_app_reference_number', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Maid: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-4">
                     <!--  {!! Form::select('maid_id', 
                            (['' => 'Select a Maid'] + $fdw), 
                                'roles',
                                ['class' => ' class = "am-dropdown"  Data-am-dropdown','id' => 'maid','onchange'=>'getfdwdata(this.value)']) !!} -->
			<input  name="maid_id" id="maid_id" onchange='getfdwdata(this.value)'> 
                        {!! ($errors->has('maid_id') ? $errors->first('maid_id', '<small class="error">:message</small>') : '') !!}
                    </div>   
                    <div class="col-xs-1">
                           <a class="fa fa-plus-square" id='maid_app'  data-toggle="tooltip" title="Create new maid biodata"></a>
                    </div>
                     <div class="col-xs-2" style="padding-right:0px">
                        {!! Form::text('maid_reference_code', null, ['class'=> 'form-control','id'=>'refer_code','placeholder'=>'Maid Reference Code']) !!}
                        <!--<small class="error refrence_code"></small>-->
                    </div> 
                    <div class="col-xs-2" style="padding-right:0px">
                        {!! Form::text('previous_loan', null, ['class'=> 'form-control','id'=>'loan','placeholder'=>'Previous application loan amount ','readonly']) !!}
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
                  <div class="small-10 margin-left columns">
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
<script type="text/javascript">
$('#maid_app').click(function(){
$('#tabs-1 form').attr('action','<?php echo url('/fdws/create/app'); ?>');
$('#tabs-1 form').attr('method','get');
$('#tabs-1 form').submit();
});

$('#employer_app').click(function(){
$('#tabs-1 form').attr('action','<?php echo url('/employer/create/app'); ?>');
$('#tabs-1 form').attr('method','get');
$('#tabs-1 form').submit();
});
</script>
<?php  \Session::put('trmp_frm', null); ?>
@stop
