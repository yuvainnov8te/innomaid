@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function () {

	if($('#domestic_duties_other').is(':checked')) {
    $('#domestic_duty').show();
    } else {  
      $('#domestic_duty').hide();
    }
    if($('#work_place_other').is(':checked')) {
    $('#work_place').show();
    } else {  
      $('#work_place').hide();
    }
	if($("#rest_week").is(':checked')){
		$("#no_of_restday").attr("disabled","");
		$("#compensation").attr("disabled","");
		$("#rest_of_month").attr("disabled","");
		$('#no_of_restday').val('');
		$('#compensation').val('');
		$('#rest_of_month').val('');	
		}
		else{
		$("#rest_of_week").attr("disabled","");
		$('#rest_of_week').val('');
		 $("#no_of_restday").removeAttr("disabled"); 
		  $("#compensation").removeAttr("disabled"); 
		   $("#rest_of_month").removeAttr("disabled"); 
		}
		
        if($("#rest_month").is(':checked')){
		 $("#no_of_restday").removeAttr("disabled"); 
		  $("#compensation").removeAttr("disabled"); 
		   $("#rest_of_month").removeAttr("disabled"); 
        $("#rest_of_week").attr("disabled","");
		$('#rest_of_week').val('');

        }
		else
		{

		$("#no_of_restday").attr("disabled","");
		$("#compensation").attr("disabled","");
		$("#rest_of_month").attr("disabled","");
		$('#no_of_restday').val('');
		$('#compensation').val('');
		$('#rest_of_month').val('');	
	} 
	
    $( "#tabs" ).tabs();
    $('.disable').prop('disabled', true);
    $('#refer_code').keyup(function() {
      getfdwdata();
    });
    
	 $('.datetimepicker').datepicker({changeYear: true, yearRange : '1950:2020' , format: 'yyyy-mm-dd' 
    });
	
	$('input[type="radio"]').click(function(){

        if($(this).attr("id")=="rest_week"){
		  $("#rest_of_week").removeAttr("disabled"); 
		 $("#no_of_restday").attr("disabled","");
		 $("#compensation").attr("disabled","");
		 $("#rest_of_month").attr("disabled","");
		$('#no_of_restday').val('');
		$('#compensation').val('');
		$('#rest_of_month').val('');		
		}
		

        if($(this).attr("id")=="rest_month"){

          $("#rest_of_week").attr("disabled","");
		$('#rest_of_week').val('');
		 $("#no_of_restday").removeAttr("disabled"); 
		  $("#compensation").removeAttr("disabled"); 
		   $("#rest_of_month").removeAttr("disabled"); 
        }
		
		
		}); 
    <?php if($_GET['tab']=='tab1') {?>
  $( "#tabs" ).tabs({active:1});
<?php } else if($_GET['tab']=='tab0') { ?>
  $( "#tabs" ).tabs({active:0});
  <?php } else if($_GET['tab']=='tab2') { ?>
    $('#selecttab').val("tab2");
  $( "#tabs" ).tabs({active:2});
  <?php  } else if($_GET['tab']=='tab3') { ?>
    $('#selecttab').val("tab3");
  $( "#tabs" ).tabs({active:3}); 
  <?php } else if($_GET['tab']=='tab5') { ?>
    $('#selecttab').val("tab5");
  $( "#tabs" ).tabs({active:5}); 
   <?php } else if($_GET['tab']=='tab6') { ?>
   $('#selecttab').val("tab6");
  $( "#tabs" ).tabs({active:6}); 
	<?php } else if($_GET['tab']=='tab7') { ?>
   $('#selecttab').val("tab7");
  $( "#tabs" ).tabs({active:7}); 
  
  <?php } ?>
  
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
                //alert(data.name); return false;
                //
            }
            else{
                $('#maid_name').val('');
                $('#nationality').val('');  
                $('#maid_id').val('');            
            }
            }
      });  
}

function getfdwdata(maid_id) {
  //$('.refrence_code').text('');
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
                }
                if(result[0].maid_reference_code == null){
                  $('#refer_code').val('');
                }
              }
              else{
                 $('#maid').val('');     
              }
            }
      });  
}
 function radiofield() {
 
if($('#rest_week').is(':checked')) {
    $('#week').show();
	$("#month").hide();
	$('#no_of_restday').val('');
	$('#compensation').val('');
	$('#day_of_month').val('');
	
    }
    if($('#rest_month').is(':checked')) {
    $('#month').show();
	$("#week").hide();
	
    } 
	}
function showfield() {
 
if($('#domestic_duties_other').is(':checked')) {
    $('#domestic_duty').show();
    } else { 
		$('#domestic_duty').val('');
      $('#domestic_duty').hide();
    }
    if($('#work_place_other').is(':checked')) {
    $('#work_place').show();
    } else {  
		$('#work_place').val('');
      $('#work_place').hide();
    }
	}
  function show(servicecount) {
    if(servicecount > 0){
    }
    else{
      alert('Please add service(s) first.');
      $( "#tabs" ).tabs( "disable", 1 );
    }
  }
</script>
<h3 style='margin-left:1;0px;'>Maid Application</h3>
<hr/>
<div id="tabs">
    <ul>
      <li><a href="#tabs-1"><span style="font-size:0.8em">Employer & Maid</span></a></li>
      <li><a href="#tabs-2"  onclick="return show({{count($agencyservice)}})"><span style="font-size:0.8em">Service & fees</span></a></li>
      <li><a href="#tabs-3"><span style="font-size:0.8em">Loan & payment</span></a></li>  
      <li><a href="#tabs-4"><span style="font-size:0.8em">Service employer & agency</span></a></li>
      <li><a href="#tabs-5"><span style="font-size:0.8em">Service employer & fdw</span></a></li>
      <li><a href="#tabs-6"><span style="font-size:0.8em">Handling & Take Over</span></a></li>
      <li><a href="#tabs-7"><span style="font-size:0.8em">Job Scope</span></a></li>
	   <li><a href="#tabs-8"><span style="font-size:0.8em">Rest Day Agreement</span></a></li>
    </ul>
<div class="panel-body" style="background-color:#f0f2f7;">

 
<div id="tabs-1"> 
{!! Form::model($maid_employer,array('route' => array('sentinel.application.update', $maid_employer->id))) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Employer: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                        {!! Form::select('employer_id', 
                            ['' => 'Select a Employer'] + $employer, 
                                $maid_employer->employer_id,
                                ['class' => 'am-dropdown disable','id' => 'employer','onchange'=>'getemployerdata(this.value)']) !!}
                        {!! ($errors->has('employer_id') ? $errors->first('employer_id', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Type of application: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                       {!! Form::text('type', null, ['class'=> 'form-control disable','id'=>'type']) !!}
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
                                $maid_employer->maid_id,
                                ['class' => ' am-dropdown disable','id' => 'maid','onchange'=>'getfdwdata(this.value)']) !!}
                        {!! ($errors->has('maid_id') ? $errors->first('maid_id', '<small class="error">:message</small>') : '') !!}
                    </div>   
                    <div class="col-xs-3">
                        {!! Form::text('maid_reference_code', $maid_employer->maid_reference_code, ['class'=> 'form-control disable','id'=>'refer_code','placeholder'=>'Maid Refrence Code']) !!}
                        <!--<small class="error refrence_code"></small>-->
                    </div>    
                </div>

               <div style="margin-top:20px;"class="row">
                  <div class="small-10 margin-left columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save & Go to List</button>
                        <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
                       <button onclick="window.location='{{ url('page') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>
           </form>
<?php $employer_details[0] = json_decode($maid_employer->employer_json_data); ?>
<div class="col-md-6">
           <table class="table table-bordered">
             <thead>
                <tr>
                    <th class='text-center' colspan='2'>Employer Details</th>
                </tr>
             </thead>       
             <tbody>
                 <tr>
                    <td>Name
                    </td>
                    <td>{{$employer_details[0]->employer_name}}
                    </td>
                 </tr>
                 <tr>
                    <td>Date of Birth
                    </td>
                    @if( $employer_details[0]->employer_date_of_birth =='0000-00-00')
                      <td> {{ '' }}</td>
                    @else
                      <td> {{  date("d-m-Y", strtotime($employer_details[0]->employer_date_of_birth)) }}</td>
                    @endif     
                 </tr>
                 <tr>
                    <td>Contact Number
                    </td>
                    <td>{{$employer_details[0]->employer_mobile_phone}}
                    </td>
                 </tr>
                 <tr>
                    <td>Marital Status
                    </td>
                    <td>@if ($employer_details[0]->marital_status){{$employer_details[0]->marital_status}}@else{{''}}@endif
                    </td>
                 </tr>
                 <tr>
                    <td>Address
                    </td>
                    <td>{{$employer_details[0]->address}}
                    </td>
                 </tr>
             </tbody>
           </table>
           </div>           
<?php $maid_details[0] = json_decode($maid_employer->maid_json_data); ?>
<div class="col-md-6">
           <table class="table table-bordered">
             <thead>
                <tr>
                    <th class='text-center' colspan='2'>Maid Details</th>
                </tr>
             </thead>       
             <tbody>
                 <tr>
                    <td>Name
                    </td>
                    <td>{{$maid_details[0]->name}}
                    </td>
                 </tr>
                 <tr>
                    <td>Date of Birth
                    </td>
                    @if( $maid_details[0]->date_of_birth =='0000-00-00')
                      <td> {{ '' }}</td>
                    @else
                      <td> {{  date("d-m-Y", strtotime($maid_details[0]->date_of_birth)) }}</td>
                    @endif     
                 </tr>
                 <tr>
                    <td>Contact Number
                    </td>
                    <td>{{$maid_details[0]->contact_number}}
                    </td>
                 </tr>
                 <tr>
                    <td>Marital Status
                    </td>
                    <td>{{$maid_details[0]->marital_status}}
                    </td>
                 </tr>
                 <tr>
                    <td>Address
                    </td>
                    <td>{{$maid_details[0]->address}}
                    </td>
                 </tr>
             </tbody>
           </table>
</div>

</div>
<div id="tabs-2"> 
<script type="text/javascript">
$(function(){ // this will be called when the DOM is ready
  $('#maid_name').prop('disabled', true);
  $('#nationality').prop('disabled', true);
  $('#passport').prop('disabled', true);
  $('#salary').prop('disabled', true);
  //$('#date').prop('disabled', true);
  $('#replacement_fdw').prop('disabled', true);
  $('#replacement_fdw_passport').prop('disabled', true);
  $('#form_type').prop('disabled', true);
  $('#total_package_cost').prop('disabled', true);
  if($('#form_type').val()== 'Replacement'){
    $('.replacement').show();
  }else{
    $('.replacement').hide();
  }
  // call getreplacedfdw on load
  getreplacedfdw();
  // call loadservice on load
  loadservice();
  //
  $('#case_id').keyup(function() {
      getreplacedfdw();
  });
  var refer_code = $('#refer_code').val();
      var dataString='refer_code='+ refer_code;
         $.ajax({
            type:"POST",
            url:"/fdws/fdwinfo",
            data:dataString,
            success:function(data){
              var result = data;
              if(result !=''){
                $('#maid_name').val(result[0].name);
                $('#nationality').val(result[0].nationality);
                $('#maid_id').val(result[0].id);
                //alert(data.name); return false;
                //
            }
            else{
                $('#maid_name').val('');
                $('#nationality').val('');  
                $('#maid_id').val('');            
            }
            }
      });

    $('#refer_code').keyup(function() {
      //alert('');
      var refer_code = $('#refer_code').val();
      var dataString='refer_code='+ refer_code;
         $.ajax({
            type:"POST",
            url:"/fdws/fdwinfo",
            data:dataString,
            success:function(data){
              var result = data;
              if(result !=''){
                $('#maid_name').val(result[0].name);
                $('#nationality').val(result[0].nationality);
                $('#maid_id').val(result[0].id);
                //alert(data.name); return false;
                //
            }
            else{
                $('#maid_name').val('');
                $('#nationality').val('');  
                $('#maid_id').val('');            
            }
            }
      });
    });
    var payment_placement_fee = $('input[name=payment_placement_fee]:checked').val();
    if(payment_placement_fee == 'Upfront Placement Fee') {
            $('#placementdetails').show();           
       }

       else {
            $('#placementdetails').hide();   
       }
       if(payment_placement_fee == 'Full sum payable') {
            $('#fullsumtext').show();           
       }

       else {
            $('#fullsumtext').hide();   
       }
       if(payment_placement_fee == 'Others') {
            $('#othertext').show();           
       }

       else {
            $('#othertext').hide();   
       }
  $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'upfrontradio') {
            $('#placementdetails').show();           
       }

       else {
            $('#placementdetails').hide();   
       }
       if($(this).attr('id') == 'fullsumradio') {
            $('#fullsumtext').show();           
       }

       else {
            $('#fullsumtext').val('');
            $('#fullsumtext').hide();   
       }
       if($(this).attr('id') == 'otherradio') {
            $('#othertext').show();           
       }

       else {
            $('#othertext').val('');
            $('#othertext').hide();   
       }
   });
});
function getreplacedfdw(){
  var maid_id = $('#case_id').val();
  var dataString='maid_id='+ maid_id;
         $.ajax({
            type:"POST",
            url:"/fdws/fdwinfo",
            data:dataString,
            success:function(data){
              var result = data;
              if(result !=''){
                $('#replacement_fdw').val(result[0].name);
                $('#replacement_fdw_passport').val(result[0].passport_number);
              }
              else{
                $('#replacement_fdw').val('');
                $('#replacement_fdw_passport').val('');  
              }
            }
      });
}
function getprice(service_id){
  var dataString='service_id='+ service_id;
  $.ajax({
            type:"POST",
            url:"/servicefees/serviceprice",
            data:dataString,
            success:function(data){
              var result = data;
              if(result !=''){
                $('#price_1').val(result[0].price);
                //alert(data.name); return false;
                //
            }
            else{
                $('#maid_name').val('');
                $('#nationality').val('');              
            }
            }
      });
}
/////**** function used for load service according to form type (new transfer / replacement)*****/////
    function loadservice(){
    var type = $('#form_type').val();
    if(type == 'Replacement'){
      var dataString='mode=replacement';
    }else if(type == 'New Transfer'){
      var dataString='mode=newtransfer';
    }else{
      var dataString='mode=';
    }
      $.ajax({
            type:"POST",
            url:"/service/index",
            data:dataString,
            success:function(result){
              if(result !=''){
                  $(function () {
                    var servicerows = $('.servicetable').find('tr');
                    var placementrows = $('.placementtable').find('tr');
                    
                      servicerows.each(function(index, value) {
                        if (index > 0) {
                          $(value).remove();
                        }
                      });
                       placementrows.each(function(index, value) {
                        if (index > 0) {
                          $(value).remove();
                        }
                      });
                       if (result.data !='') {
                        var servicerow = 'no'; 
                        var placementrow = 'no';
                        $.each(result.data, function (i, item) {
                          if(item.type == 'S'){
                            servicerow = 'yes';
                            $('<tr>').append(
                            $('<td>').html('<td><input name="service_id['+item.id+']" type="checkbox" value="'+item.id+'" id = "service" onChange = "" class ="placementcheck"> '+item.title+'</td>'),
                            $('<td>').html('<td><input placeholder="$" name="price['+item.id+']" type="text" value="'+item.price+'" id="price_'+item.id+'"></td>')).appendTo('.servicetable');
                            // $('#records_table').append($tr);
                            //console.log($tr.wrap('<p>').html());
                          }
                          if(item.type == 'P'){
                            placementrow = 'yes';
                            $('<tr>').append(
                            $('<td>').html('<td><input name="service_id[]" type="checkbox" value="'+item.id+'" id = "service" onChange = "" class ="placementcheck"> '+item.title+'</td>'),
                            $('<td>').html('<td><input placeholder="$" name="price[]" type="text" value="'+item.price+'" id="price_'+item.id+'"></td>')).appendTo('.placementtable');
                          }
                        });
                        if(servicerow == 'no')
                        {
                          $('<tr>').append(
                            $('<td colspan="2" align="center">').text('No service found.')).appendTo('.servicetable');
                        }
                        if(placementrow == 'no')
                        {
                           $('<tr>').append(
                            $('<td colspan="2" align="center">').text('No service found.')).appendTo('.placementtable');
                        }
                      }else{
                        $('<tr>').append(
                            $('<td colspan="2" align="center">').text('Please select form type field first.')).appendTo('.servicetable');
                        $('<tr>').append(
                            $('<td colspan="2" align="center">').text('Please select form type field first.')).appendTo('.placementtable');
                      }
                  });
            }
              else{          
              }
            }
      });
    }
    /////**** end *****/////
 function confirmdelete()
    {
      var x;
        var r=confirm("Are you sure you want to delete this ?");
    if (r==true)
      {
     return true;
      }
    else
      {
      return false;
      }
    }
</script>
{!! Form::model($servicefees,array('route' => array('sentinel.application.servicefeesupdate', $maid_employer->id)))!!}
    <!-- include is used for render partial view errors/form_error.blade.php and books/form.blade.php -->
  <div class="small-11 columns">
   <p><span class="mandatory">*</span> Fields are required</p>
  </div>
  @if($servicefees)
    <div class="small-1 columns">
        <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_servicefees/yes')}}"></a>
	</div>
	@endif
  <div class="row left">
    <strong>PART A: Particulars of FDW Selected</strong>
  </div>
  <br />
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Form Type:<span class="mandatory">*</span> </label>
    </div>
    <?php //echo $maid_employer->form_type; exit;?>
    <div class="col-xs-3 {{ ($errors->has('form_type')) ? 'error' : '' }}">
        {!! Form::select('form_type', array('' => 'Select Form Type', 
      'New Transfer' => 'New Transfer', 'Replacement' => 'Replacement'), $maid_employer->form_type,
      array('class' => 'form-control','onchange'=>'loadservice()','id'=>'form_type')) !!}
      {!! ($errors->has('form_type') ? $errors->first('form_type', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Reference Code:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('maid_reference_code', $maid_details[0]->maid_reference_code, ['class'=> 'form-control disable','id'=>'refer_code']) !!}
        {!! ($errors->has('maid_reference_code') ? $errors->first('maid_reference_code', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('maid_id') ? $errors->first('maid_id', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
   <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Name of FDW Selected:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_name')) ? 'error' : '' }}">
        {!! Form::text('name', $maid_details[0]->name, ['class'=> 'form-control','id'=>'maid_name']) !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Nationality:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('nationality', $maid_details[0]->nationality, ['class'=> 'form-control','id'=>'nationality']) !!}
    </div>
  </div>
  <input type='hidden' id='maid_id' name ='maid_id'>
<div class="row">
  <div class="small-width18 columns">
      <label for="Date of birth">Passport No:</label>
  </div>
  <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('passport', $maid_details[0]->passport_number, ['class'=> 'form-control','id'=>'passport']) !!}
    </div>
  <div class="small-width18 columns">
      <label for="Date of birth">Salary:</label>
  </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('salary', $maid_details[0]->expected_salary, ['class'=> 'form-control','id'=>'salary']) !!}
    </div>
</div>
<div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Date:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }}">
        {!! Form::text('date', date('Y-m-d'), ['class'=> 'form-control datetimepicker','id'=>'date']) !!}
    </div>
    <div class="small-width18 columns replacement">
      <label for="Date of birth">Case id:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }} replacement">
        {!! Form::text('case_id',$maid_employer->case_id, ['class'=> 'form-control','id'=>'case_id']) !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns replacement">
        <label for="Name of FDW">Name of FDW Replaced:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }} replacement">
        {!! Form::text('replacement_fdw', null, ['class'=> 'form-control','id'=>'replacement_fdw']) !!}
    </div>
    <div class="small-width18 columns replacement">
      <label for="Date of birth">Passport No. of FDW Replaced:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }} replacement">
        {!! Form::text('replacement_fdw_passport',null, ['class'=> 'form-control','id'=>'replacement_fdw_passport']) !!}
    </div>
  </div>
<?php// print_r($agencymaidservice); exit;?>
<div class="row">
    <strong>PART B: Service Fee</strong>
  </div>
  <br />
  <div class="row">
    <div class="small-10 large-left columns">
      <div class="table-responsive">
        <table class="table table-bordered" id='servicetable' width="100%">
          <thead>
            <tr>
              <th style="width:10%">Name of Service</th>
              <th style="width:5%">Price</th>
            </tr>
          </thead>
          <tbody>
          @if($agencyservice)
                <?php $checked = ''; 
                      $service ='no';
                ?>
                  @foreach($agencyservice as $agencyservice_id => $agencyservice_value)
                    @if($agencyservice_value->type == 'S')
                      <?php 
                            $service ='yes';
                            $checked = '';
                            $price = $agencyservice_value->price;
                        ?>
                        @foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value)
                          @if($agencyservice_value->id == $agencymaidservice_value->service_id)
                            <?php $checked = 'checked';
                                $price = $agencymaidservice_value->service_cost;
                            ?>
                          @endif
                        @endforeach
                        <tr>
                          <td><input type="checkbox" value="{{$agencyservice_value->id}}" name="service_id[{{$agencyservice_value->id}}]" {{$checked}} id="service"> {{ ucfirst($agencyservice_value->title) }}</td>
                          <td><input placeholder="$" name="price[{{$agencyservice_value->id}}]" type="text" value="{{$price}}" id="price_<?php echo $agencyservice_value->id;?>" ></td>
                        </tr> 
                        <?php $checked = '';
                            $price = $agencyservice_value->price;
                        ?>
                    @endif
                  @endforeach
                  @if($service == 'no')
                    <tr>
                      <td colspan="2" class="text-center">No service available.</td>
                    </tr> 
                  @endif
            @else
                <tr>
                  <td colspan="2" class="text-center">No service available.</td>
                </tr>
            @endif
        </tbody>
      </table>
      </div>  
      {!! ($errors->has('service_id') ? $errors->first('service_id', '<small class="error">:message</small>') : '') !!}  
    </div>
  </div>
  @if($maid_employer->form_type != 'Replacement')
  <div id="replacementcostdiv">
    <div class="row">
      Cost for Replacement within the Maximum Replacement Period of  {!! Form::selectRange('month', 1, 12, null, ['class' => 'field','id'=>'replacement_month']) !!} *months/years
    </div>
    <div class="row">
      <div class="small-10 large-left columns">
        <div class="table-responsive">
          <table class="table table-bordered" id="replacementmonth" width="100%">
            <thead>
              </thead>
              <tbody>
                  <?php $radiocounter = 0; ?>     
                   @if($replacementcost)
                     @foreach ($replacementcost as $replacementcost_id => $replacementcost_value)
                      <tr>
                        <td>{!! $replacementcost_value->replacement_number !!}</td>
                        <td class="text-center">replacement within</td>
                        <td>{!! $replacementcost_value->replacement_month !!}</td>
                        <td class="text-center">months</td>
                        <td>{!! $replacementcost_value->cost !!}</td>
                        <td><a href="{{  url('/application/'.$replacementcost_value->service_schedule_id.'/replacementcostdelete/'.$replacementcost_value->id.'/'.$maid_employer->id)}}" onclick="return confirmdelete();">
                        <img src="{{ asset('uploads/delete.png') }}" title="Delete Image"   height="20px" width="20px"/></a></td>
                      </tr>
                    <?php $radiocounter++; ?>
                    @endforeach
                  @else
                  <tr id='addcontact0'>
                    <td>{!! Form::select('replacement_number[]', ['' => 'Select'] + array_combine(range(1, 5), range(1, 5))) !!}</td>
                      <td class="text-center">replacement within</td>
                      <td>{!! Form::select("replacement_month[]", ["" => "Select"] + array_combine(range(1, 12), range(1, 12))) !!} </td>
                      <td class="text-center">months</td>
                      <td><input placeholder="$" name="cost[]" type="text" id=""></td>
                  </tr>
                  @endif
                  <tr id='addcontact1'></tr>
              </tbody>
          </table>
          <input type="hidden" id='count_replacement_cost_row' value='{{ count($replacementcost) }}'>
          <a id="add_row_contact" class="btn btn-default pull-left">Add Cost</a><a id='delete_row_contact' class="pull-right btn btn-default">Remove</a>
         </div>    
      </div>
    </div>
  </div>
  @endif
  <br />
    <div class="row">
      Other Services Provided (where applicable)
  </div>
  <div class="row">
    <div class="small-10 large-left columns">
      <div class="table-responsive">
        <table class="table table-bordered" id="servicefeestable" width="100%">
          <thead>
            <tr>
              <th style=>Name of Service</th>
              <th style=>Price (S$)</th>
              <th style=>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $radiocounter = 0; ?> 
            @if($agencyotherservice)
              @foreach ($agencyotherservice as $agencyotherservice_id => $agencyotherservice_value)
                <tr>
                  <td>{!! $agencyotherservice_value->other_service_title !!}</td>
                  <td>{!! $agencyotherservice_value->other_service_price !!}</td>
                  <td><a href="{{  url('/application/'.$agencyotherservice_value->service_schedule_id.'/otherservicedelete/'.$agencyotherservice_value->id.'/'.$maid_employer->id)}}" onclick="return confirmdelete();">
                  <img src="{{ asset('uploads/delete.png') }}" title="Delete Image"   height="20px" width="20px"/></a></td>
                </tr>
              <?php $radiocounter++; ?>
              @endforeach
            @else
            <tr id='addservice0'>
              <td><input type="text" name="other_service_title[]"></td>
              <td><input placeholder="$" name="other_service_price[]" type="text" value="" id="" ></td>
            </tr>
            @endif
            <tr id='addservice1'></tr>
        </tbody>
      </table>
      <input type="hidden" id='count_other_service' value='{{ count($agencyotherservice) }}'>
       <a id="add_row_service" class="btn btn-default pull-left">Add service</a><a id='delete_row_service' class="pull-right btn btn-default">Remove</a>
      </div>    
    </div>
  </div>
  <br />
   <div class="row">
    Payment of Service Fee as agreed in this schedule shall be made as follows:
  </div>
  <br />
  <div class="row">
    <div class="col-xs-5">
        <label for="Name of FDW">Deposit - On confirmation of  FDW through Bio data/ Others:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }}">
        {!! Form::text('deposite', null, ['class'=> 'form-control','id'=>'']) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-xs-5">
        <label for="Name of FDW">Final Payment - When the FDW reports for work/ Others:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }}">
        {!! Form::text('final_payment', null, ['class'=> 'form-control','id'=>'']) !!}
    </div>
  </div>
  <br />
  <div class="row">
    <strong>PART C: Placement Fee</strong>
  </div>
  <br />
  <div id="placementcostdiv">
   <div class="row">
    <div class="small-10 large-left columns">
      <div class="table-responsive">
        <table class="table table-bordered" id="servicetable" width="100%">
          <thead>
            <tr>
              <th style="width:10%">Name of Service</th>
              <th style="width:5%">Price (S$)</th>
            </tr>
          </thead>
          <tbody>
          @if($agencyservice)
                <?php
                      $placement ='no';
                ?>
                  @foreach($agencyservice as $agencyservice_id => $agencyservice_value)
                    @if($agencyservice_value->type == 'P')
                      <?php $placement ='yes'; ?>
                    @foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value)
                      @if($agencyservice_value->id == $agencymaidservice_value->service_id)
                      <?php $checked = 'checked';
                          $price = $agencymaidservice_value->service_cost;
                      ?>
                      @endif
                      @endforeach
                      <tr>
                        <td><input type="checkbox" value="{{$agencyservice_value->id}}" name="service_id[{{$agencyservice_value->id}}]" {{$checked}} id="service"> {{ ucfirst($agencyservice_value->title) }}</td>
                        <td><input placeholder="$" name="price[{{$agencyservice_value->id}}]" type="text" value="{{$price}}" id="price_<?php echo $agencyservice_value->id;?>"></td>
                      </tr>
                      <?php $checked = '';
                          $price = $agencyservice_value->price;
                      ?>
                  @endif
                  @endforeach
                  @if($placement == 'no')
                    <tr>
                      <td colspan="2" class="text-center">No service available.</td>
                    </tr> 
                  @endif
          @else
              <tr>
                <td colspan="2" class="text-center">No service available.</td>
              </tr> 
          @endif
        </tbody>
      </table>
  
      </div> 
      {!! ($errors->has('service_id') ? $errors->first('service_id', '<small class="error">:message</small>') : '') !!}   
    </div>
  </div>
  </div>
  <div class="row">
    Payment of Placement Fee as agreed in this schedule shall be made as follows:
  </div>
  <div class="row">
    <label class="radio-inline"> {!! Form::radio('payment_placement_fee', 'Upfront Placement Fee', true, ['id' => 'upfrontradio']) !!} Upfront Placement Fee & post dated cheques</label>
  </div>
  <div class="row" id="placementdetails">
      <div class="small-10 large-left columns">
        <div class="table-responsive">
          <table class="table table-bordered" id="placementtable" width="100%">
            <thead>
              </thead>
              <tbody>
                  <?php $radiocounter = 0;
                  $contactnamestring = 'a';?>  
                  <tr>
                    <td>{!! Form::selectRange('upfront_month', 1, 12, null, ['class' => 'field','id'=>'']) !!}</td>
                    <td class="text-center">months upfront Placement Fee</td>
                    <td>{!! Form::text('upfront_fee',null , ['class'=> 'form-control','placeholder'=>'$']) !!}</td>
                  </tr>     
                  @if($placement_fee_schedule)
                  @foreach ($placement_fee_schedule as $placement_fee_schedule_id => $placement_fee_schedule_value)
                    <tr>
                      <td>{!! $placement_fee_schedule_value->post_dated_cheque_number !!}</td>
                      <td class="text-center">post-dated cheques of S$</td>
                      <td>{!! $placement_fee_schedule_value->post_dated_cheque_cost !!}</td>
                      <td class="text-center">each</td>
                      <td><a href="{{  url('/application/'.$placement_fee_schedule_value->service_schedule_id.'/placementdelete/'.$placement_fee_schedule_value->id.'/'.$maid_employer->id)}}" onclick="return confirmdelete();">
                      <img src="{{ asset('uploads/delete.png') }}" title="Delete Image"   height="20px" width="20px"/></a></td>
                    </tr>
                  <?php $radiocounter++; ?>
                  @endforeach
                @else 
                  <tr id='addplacementfee0'>
                    <td>{!! Form::select("post_dated_cheque_number[]", ["" => "Select"] + array_combine(range(1, 5), range(1, 5))) !!}</td>
                      <td class="text-center">post-dated cheques of S$</td>
                      <td><input placeholder="$" name="post_dated_cheque_cost[]" type="text" id=""></td>
                      <td class="text-center">each</td>
                  </tr>
                  @endif
                  <tr id='addplacementfee1'></tr>
              </tbody>
          </table>
          <a id="add_row_placement" class="btn btn-default pull-left">Add Information</a><a id='delete_row_placement' class="pull-right btn btn-default">Remove</a>
         </div>    
      </div>
    </div>
    <br />
  <div class="row">
    <label class="radio-inline"> {!! Form::radio('payment_placement_fee', 'Full sum payable', null, ['id' => 'fullsumradio']) !!} Full sum payable upon *handover / signing of contract / others (please specify) : </label>{!! Form::text('placement_full_sum', null, ['class'=> 'form-control placementradiotext','id'=>'fullsumtext']) !!}
  </div>  
  <div class="row">
    <label class="radio-inline"> {!! Form::radio('payment_placement_fee', 'Others', null, ['id' => 'otherradio']) !!} Others (please specify)</label>{!! Form::text('placement_other', null, ['class'=> 'form-control placementradiotext','id'=>'othertext']) !!}
  </div>   
  <br />
  <!--<div class="row">
    <div class="col-xs-7 text-right">
        <label for="Name of FDW"><strong>Total Package Service Fee: </strong></label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }}">
        {!! Form::text('toatal_cost',null , ['class'=> 'form-control','id'=>'total_package_cost']) !!}
    </div>
  </div>
  <br />-->
  <div class="row">
  <div class="small-10 small-offset-4 columns">
      <input class="button small" value="Update" type="submit">
      {!! Form::reset('Reset', array('class' => 'button small')) !!}
      <button  class="button small" onclick="window.location='{{ url('servicefees') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
  </div>
  </div>

 {!! Form::close() !!}
  <script type="text/javascript">
//********** add replacement cost row**************//
$(document).ready(function(){
    var replacement_cost_count = $('#count_replacement_cost_row').val();
    if(replacement_cost_count !='' && replacement_cost_count !=0)
    {
      var replacement_row=replacement_cost_count; 
    }else{
      var replacement_row=1;
    }
     var k=1;
        $("#add_row_contact").click(function(){
          if(5-replacement_row < k){
            alert('You reached the maximum number of selection.');
            return false;
          }else{
              $('#addcontact'+k).html('<td>{!! Form::select("replacement_number[]", ["" => "Select"] + array_combine(range(1, 5), range(1, 5))) !!}</td><td class="text-center">replacement within</td><td>{!! Form::select("replacement_month[]", ["" => "Select"] + array_combine(range(1, 12), range(1, 12))) !!} </td><td class="text-center">months</td><td><input placeholder="$" name="cost[]" type="text" id=""></td>');

              $('#replacementmonth').append('<tr id="addcontact'+(k+1)+'"></tr>');
              k++; 
          }
        });
    $("#delete_row_contact").click(function(){
    if(k>1){
          $("#addcontact"+(k-1)).html('');
          k--;
       }
    });
//********** add replacement cost row end**************//   

//********** add other service rows**************//
    var other_service = $('#count_other_service').val();
    if(other_service !='' && other_service !=0)
    {
      var otherrow=other_service; 
    }else{
      var otherrow=1;
    }

     var feecounter=1;
        $("#add_row_service").click(function(){
          if(10-otherrow < feecounter){
            alert('You reached the maximum number of selection.');
            return false;
          }else{
              $('#addservice'+feecounter).html('<td><input type="text" name="other_service_title[]"></td><td><input placeholder="$" name="other_service_price[]" type="text" value="" id="" ></td>');

              $('#servicefeestable').append('<tr id="addservice'+(feecounter+1)+'"></tr>');
              feecounter++; 
          }
        });
    $("#delete_row_service").click(function(){
    if(feecounter>1){
          $("#addservice"+(feecounter-1)).html('');
          feecounter--;
       }
    });
//********** add other service rows end**************//

//********** add placement rows**************//
     var placementcounter=1;
        $("#add_row_placement").click(function(){
          if(5 < placementcounter+1){
            alert('You reached the maximum number of selection.');
            return false;
          }else{
              $('#addplacementfee'+placementcounter).html('<td>{!! Form::select("post_dated_cheque_number[]", ["" => "Select"] + array_combine(range(1, 5), range(1, 5))) !!}</td><td class="text-center">post-dated cheques of S$</td><td><input placeholder="$" name="post_dated_cheque_cost[]" type="text" id=""></td><td class="text-center">each</td>');

              $('#placementtable').append('<tr id="addplacementfee'+(placementcounter+1)+'"></tr>');
              placementcounter++; 
          }
        });
    $("#delete_row_placement").click(function(){
    if(placementcounter>1){
          $("#addplacementfee"+(placementcounter-1)).html('');
          placementcounter--;
       }
    });
//********** add placement end**************//
});

//************Calculate total service fee************//
  var service = $('input[name="service_id[]"]'); 
  /// on load price total 
  var total = 0;
      service.each(function() {
          if (this.checked){
            var price = $('#price_'+this.value).val();
              total = parseInt(total) + parseInt(price);
          }
      });
      $("#total_package_cost").val(total);
  /// on checked function work    
  function calcUsage() {
      var total = 0;
      service.each(function() {
          if (this.checked){
            var price = $('#price_'+this.value).val();
              total = parseInt(total) + parseInt(price);
          }
      });
      $("#total_package_cost").val(total);
  }
  service.click(calcUsage);
//************Calculate total service fee End************//
var formtypedata = $('#form_type').val()
if(formtypedata == 'Replacment'){
    $('#replacementcostdiv').hide();
    $('#placementcostdiv').hide();
  }
  else{
    $('#replacementcostdiv').show();
    $('#placementcostdiv').show();
  }
</script>
</div>
<div id="tabs-3"> 
</div>
<div id="tabs-4"> 
</div>
<div id="tabs-5"> 
</div>
<div id="tabs-6"> 
{!! Form::model($handlingtakeover,array('route' => array('sentinel.application.handlingtakeover', $maid_employer->id))) !!}
	
	<?php if($handlingtakeover)
			{ 
			 if($handlingtakeover->work_permit== "0000-00-00")
			 $handlingtakeover->work_permit= "";
			  if($handlingtakeover->application_of_wp== "0000-00-00")
			 $handlingtakeover->application_of_wp= "";
			  if($handlingtakeover->approval_of_wp== "0000-00-00")
			 $handlingtakeover->approval_of_wp= "";
			  if($handlingtakeover->submission_of_bg== "0000-00-00")
			 $handlingtakeover->submission_of_bg= "";
			  if($handlingtakeover->eta_of_fdw== "0000-00-00")
			 $handlingtakeover->eta_of_fdw= "";
			  if($handlingtakeover->medical_checkup== "0000-00-00")
			 $handlingtakeover->medical_checkup= "";
			  if($handlingtakeover->thumb_printing== "0000-00-00")
			 $handlingtakeover->thumb_printing= "";
			  if($handlingtakeover->collection_of_document== "0000-00-00")
			 $handlingtakeover->collection_of_document= "";
			  if($handlingtakeover->employment_contract_fdw== "0000-00-00")
			 $handlingtakeover->employment_contract_fdw= "";
			  if($handlingtakeover->fdw_passport== "0000-00-00")
			 $handlingtakeover->fdw_passport= "";
			  if($handlingtakeover->fdw_handy_guide== "0000-00-00")
			 $handlingtakeover->fdw_handy_guide= "";
			  if($handlingtakeover->medical_report_fdw== "0000-00-00")
			 $handlingtakeover->medical_report_fdw= "";
			  if($handlingtakeover->service_contract== "0000-00-00")
			 $handlingtakeover->service_contract= "";
			  if($handlingtakeover->employment_contract_employer== "0000-00-00")
			 $handlingtakeover->employment_contract_employer= "";
			  if($handlingtakeover->b_guarantee== "0000-00-00")
			 $handlingtakeover->b_guarantee= "";
			  if($handlingtakeover->insurance== "0000-00-00")
			 $handlingtakeover->insurance= "";
			  if($handlingtakeover->medical_report_employer== "0000-00-00")
			 $handlingtakeover->medical_report_employer= "";
			 
			 
			 
			 }
			 
	?>
	<div class="small-10 columns">
        <p><span class="mandatory">*</span> Fields are required</p>
	</div>
	<div class="row small-10">
	<table width="600">
	<tr> <th> Facilitation </th> <th> Date </th> </tr>
	<tr> <td>
	<div class="col-md-10 columns">
		{!! Form::label('Application of WP', 'Application of WP:' ) !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		
         {!! Form::text('application_of_wp', null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy-mm-dd",'id'=>'application_of_wp' ]) !!}
         {!! ($errors->has('application_of_wp') ? $errors->first('application_of_wp', '<small class="error">:message</small>') : '') !!}
		 </div>
    </td> </tr>
							  
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Approval of WP', 'Approval of WP:') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
          {!! Form::text('approval_of_wp', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy-mm-dd",'id'=>'approval_of_wp' ]) !!}
         {!! ($errors->has('approval_of_wp') ? $errors->first('approval_of_wp', '<small class="error">:message</small>') : '') !!}
		</div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Submission of BG/INS ', 'Submission of BG/INS :') !!}
	</div></td> 
	<td><div class="col-md-10 col-xs-11">
		{!! Form::text('submission_of_bg', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'submission_of_bg' ]) !!}
         {!! ($errors->has('submission_of_bg') ? $errors->first('submission_of_bg', '<small class="error">:message</small>') : '') !!}
        </div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('ETA of FDW ', 'ETA of FDW :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('eta_of_fdw', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy-mm-dd",'id'=>'eta_of_fdw' ]) !!}
         {!! ($errors->has('eta_of_fdw') ? $errors->first('eta_of_fdw', '<small class="error">:message</small>') : '') !!}
        </div>
    </td> </tr>		
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Medical Check-up ', 'Medical Check-up :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('medical_checkup', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'medical_checkup' ]) !!}
         {!! ($errors->has('medical_checkup') ? $errors->first('medical_checkup', '<small class="error">:message</small>') : '') !!}
        </div>
	</td> </tr>	
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Thumb printing ', 'Thumb printing :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('thumb_printing', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'thumb_printing' ]) !!}
         {!! ($errors->has('thumb_printing') ? $errors->first('thumb_printing', '<small class="error">:message</small>') : '') !!}
         </div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-11 columns">
		{!! Form::label('Collection of Documents', 'Collection od Documents :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('collection_of_document', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'collection_of_document' ]) !!}
         {!! ($errors->has('collection_of_document') ? $errors->first('collection_of_document', '<small class="error">:message</small>') : '') !!}
         </div>
    </td> </tr>
	
	</table>
	</div>
	
	<div>
	<div class="col-md-6" width='50%'><div class="small-10 columns">
		<p>Document to be handed to FDW personally </p>
	</div>
	<table width="450">
	<tr> <th> Description </th> <th> Date/Signature of FDW </th> </tr>
	<tr> <td>
	<div class="col-md-10 columns">
		{!! Form::label('Employment Contract ', 'Employment Contract :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('employment_contract_fdw', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'employment_contract_fdw' ]) !!}
         {!! ($errors->has('employment_contract_fdw') ? $errors->first('employment_contract_fdw', '<small class="error">:message</small>') : '') !!}
         </div>
    </td> </tr>
							  
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label("FDW's Passport ", "FDW's Passport :") !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
           {!! Form::text('fdw_passport', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'fdw_passport' ]) !!}
         {!! ($errors->has('fdw_passport') ? $errors->first('fdw_passport', '<small class="error">:message</small>') : '') !!}
		</div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Work Permit ', 'Work Permit :') !!}
	</div></td> 
	<td><div class="col-md-10 col-xs-11">
		{!! Form::text('work_permit', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'work_permit' ]) !!}
         {!! ($errors->has('work_permit') ? $errors->first('work_permit', '<small class="error">:message</small>') : '') !!}
        </div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-10 columns">
		{!! Form::label('FDW Handy Guidebook from MOM ', 'FDW Handy Guidebook from MOM :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('fdw_handy_guide', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'fdw_handy_guide' ]) !!}
         {!! ($errors->has('fdw_handy_guide') ? $errors->first('fdw_handy_guide', '<small class="error">:message</small>') : '') !!}
        </div>
    </td> </tr>		
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Medical Report ', 'Medical Report  :') !!}
	</div></td> 
	<td> <div class="col-md-10 col-xs-11">
		{!! Form::text('medical_report_fdw', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'medical_report_fdw' ]) !!}
         {!! ($errors->has('medical_report_fdw') ? $errors->first('medical_report_fdw', '<small class="error">:message</small>') : '') !!}
        </div>
	</td> </tr>	
	</table>
	</div>
	
	
	
	
	<div class="col-md-6" width='50%'>
	<div class="small-12">
		<p>Handling over of FDW and Documents to Employer </p>
	</div>
	<table width="450">
	<tr> <th> Description </th> <th> Date/Signature </th> </tr>
	<tr> <td>
	<div class="col-md-9 columns">
		{!! Form::label('Service Contract ', 'Service Contract :') !!}
	</div></td> 
	<td> <div class="col-md-8 col-xs-11">
		{!! Form::text('service_contract', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'service_contract' ]) !!}
         {!! ($errors->has('service_contract') ? $errors->first('service_contract', '<small class="error">:message</small>') : '') !!}
         </div>
    </td> </tr>
							  
	<tr> <td>
	<div class="col-md-11">
		{!! Form::label('Employment Contract ', 'Employment Contract :') !!}
	</div></td> 
	<td> <div class="col-md-8 col-xs-11">
           {!! Form::text('employment_contract_employer', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'employment_contract_employer' ]) !!}
         {!! ($errors->has('employment_contract_employer') ? $errors->first('employment_contract_employer', '<small class="error">:message</small>') : '') !!}
		</div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-9 ">
		{!! Form::label('B/Guarantee ', 'B/Guarantee :') !!}
	</div></td> 
	<td><div class="col-md-8 col-xs-11">
		{!! Form::text('b_guarantee', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'b_guarantee' ]) !!}
         {!! ($errors->has('b_guarantee') ? $errors->first('b_guarantee', '<small class="error">:message</small>') : '') !!}
        </div>
    </td> </tr>
	<tr> <td>
	<div class="col-md-8 columns">
		{!! Form::label('Insurance ', 'Insurance :') !!}
	</div></td> 
	<td> <div class="col-md-8 col-xs-11">
		{!! Form::text('insurance', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'insurance' ]) !!}
         {!! ($errors->has('insurance') ? $errors->first('insurance', '<small class="error">:message</small>') : '') !!}
        </div>
    </td> </tr>		
	<tr> <td>
	<div class="col-md-9">
		{!! Form::label('Medical Report ', 'Medical Report :') !!}
	</div></td> 
	<td> <div class="col-md-8 col-xs-11">
		{!! Form::text('medical_report_employer', null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'medical_report_employer' ]) !!}
         {!! ($errors->has('medical_report_employer') ? $errors->first('medical_report_employer', '<small class="error">:message</small>') : '') !!}
        </div>
	</td> </tr>	
	
	</table>
	</div>
	</div>
	<div class="row">
		<div class="small-10 small-offset-4 columns">
		<input class="button small" value="Update" type="submit">
		{!! Form::reset('Reset', array('class' => 'button small')) !!}
		<button  class="button small" onclick="window.location='{{ url('application') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
		</div>
	</div>
		{!! Form::close() !!}
</div>
<div id="tabs-7"> 
<?php //print_r($jobscope); ?>

{!! Form::model($jobscope,array('route' => array('sentinel.application.jobscopeupdate', $maid_employer->id))) !!}

	<div class="small-10 columns">
        <p><span class="mandatory">*</span> Fields are required</p>
	</div>
	@if($jobscope)
	<div class="small-2 columns">
        <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_job_scope/yes')}}"></a>
	</div>
	@endif
	<div class="small-10 columns">
		<p>Persons in household of Employer's family </p>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of adults', 'No. of adults:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('adult')) ? 'error' : '' }}">
		{!! Form::select('adult', array('' => 'Select number of adults', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'), null,
		array('class' => 'form-control' ,'id'=>'adult') ) !!}
		{!! ($errors->has('adult') ? $errors->first('adult', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of adults aged 13 to 18', 'No. of adults aged 13 to 18:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('y_adult')) ? 'error' : '' }}">
		{!! Form::select('y_adult', array('' => 'Select number adults aged 13 to 18', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'), null,
		array('class' => 'form-control', 'id'=>'y_adult')) !!}
		{!! ($errors->has('') ? $errors->first('y_adult', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of children aged 5 to 12', 'No. of children aged 5 to 12:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('l_child')) ? 'error' : '' }}">
		{!! Form::select('l_child', array('' => 'Select number children aged 5 to 12', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'),null,
		array('class' => 'form-control' ,'id'=>'l_child')) !!}
		{!! ($errors->has('') ? $errors->first('l_child', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of children aged 3 to 5', 'No. of children aged 3 to 5:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('m_child')) ? 'error' : '' }}">
		{!! Form::select('m_child', array('' => 'Select number of children aged 3 to 5', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'), null,
		array('class' => 'form-control' ,'id'=>'m_child')) !!}
		{!! ($errors->has('') ? $errors->first('m_child', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of babies below 3', 'No. of babies below 3:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('babies')) ? 'error' : '' }}">
		{!! Form::select('babies', array('' => 'Select number babies below 3', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'), null,
		array('class' => 'form-control', 'id'=>'babies')) !!}
		{!! ($errors->has('') ? $errors->first('babies', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of member require constant care', 'No. of member require constant care:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('constant_care')) ? 'error' : '' }}">
		{!! Form::select('constant_care', array('' => 'Select number member require constant care', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'), null,
		array('class' => 'form-control' ,'id'=>'constant_care')) !!}
		{!! ($errors->has('') ? $errors->first('constant_care', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="small-10 columns">
		<p> Domestic duties require to perform   </p>
    </div> <table class="table-tab7">
	<div class="row" style="max-width: 100%;">
	<div class="col-md-3 columns">
		<tr><td rowspan="4" style="vertical-align:top;  padding: 1px 75px 5px 15px;"><label for="Place of Work">Select Duties:<span class="mandatory">*</span> </label></td>
		</div>
    
	<div class="col-xs-5> 
		
			<div class="row"><td class="am-avg-sm-4">
			<label class="checkbox-inline" id=""> 
			<?php if($jobscope){
			$domestic_duties = explode(';', $jobscope->domestic_duties);
			}
		else{$domestic_duties=array();
			}
			?>
			@if(in_array('Household chores',$domestic_duties))
				<input type="checkbox" value="Household chores" name="domestic_duties[]" checked="checked">Household chores
			@else
				<input type="checkbox" value="Household chores" name="domestic_duties[]"> Household chores
			@endif
			</label>
			</div>
		</td>
		<td class="am-avg-sm-4">
			<div class="row">
			<label > 
			@if(in_array('Cooking',$domestic_duties))
				<input type="checkbox" value="Cooking" name="domestic_duties[]" checked="checked"> Cooking
			@else
				<input type="checkbox" value="Cooking" name="domestic_duties[]"> Cooking
			@endif
			</label>
			</div>
		</td></tr><tr>
		<td class="am-avg-sm-4">
			<div class="row">
			<label > 
			@if(in_array('Looking after aged person',$domestic_duties))
				<input type="checkbox" value="Looking after aged person" name="domestic_duties[]" checked="checked" > Looking after aged person
			@else
				<input type="checkbox" value="Looking after aged person" name="domestic_duties[]" > Looking after aged person
			@endif
			</label>
			</div>
		</td>
		<td class="am-avg-sm-4">
			<div class="row">
			<label > 
			@if(in_array('Baby-sitting',$domestic_duties))
				<input type="checkbox" value="Baby-sitting" name="domestic_duties[]" checked="checked" > Baby-sitting
			@else
				<input type="checkbox" value="Baby-sitting" name="domestic_duties[]" > Baby-sitting
			@endif
			</label>
			</div>
		</td></tr> <tr>
		<td  rowspan="1" class="am-avg-sm-4">
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Child-minding',$domestic_duties))
				<input type="checkbox" value="Child-minding" name="domestic_duties[]" checked="checked" > Child-minding
			@else
				<input type="checkbox" value="Child-minding" name="domestic_duties[]" > Child-minding
			@endif
			</label>
			</div>
		</td>
		<td class="am-avg-sm-4">
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Others', $domestic_duties))
				<input type="checkbox" value="Others" name="domestic_duties[]" onchange="showfield()" id="domestic_duties_other" checked="checked">  Others (if any)
			@else
				<input type="checkbox" value="Others" name="domestic_duties[]" onchange="showfield()" id="domestic_duties_other">Others (if any)
			@endif  
			</label></td> </tr> <tr> <td colspan="2" class="am-avg-sm-4" >
			{!! Form::text('other_duty', null, ['class'=> 'form-control','id'=>'domestic_duty']) !!}
			</div> 
		</td>
       {!! ($errors->has('domestic_duties') ? $errors->first('domestic_duties', '<small class="error">:message</small>') : '') !!}
    </div> </tr >
	</table>
	<div class="small-10 columns" style="width: 100%;">
		 <p>Place of Work </p>
	</div>
	<div class="row" style="max-width: 100%; padding:10px;">
		<div class="col-md-3 columns">
		<label for="Place of Work">House Type:<span class="mandatory">*</span> </label>
		</div>
		<div class="col-xs-5">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			<?php
				if($jobscope){
			$place_of_work = explode(';', $jobscope->place_of_work);
			}
			else{$place_of_work=array();
				} ?>
			@if(in_array('Landed Property',$place_of_work))
				<input type="checkbox" value="Landed Property" name="place_of_work[]" checked="checked"> Landed Property
			@else
				<input type="checkbox" value="Landed Property" name="place_of_work[]"> Landed Property
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Condominium/Private Apartment',$place_of_work))
				<input type="checkbox" value="Condominium/Private Apartment" name="place_of_work[]" checked="checked"> Condominium/Private Apartment
			@else
				<input type="checkbox" value="Condominium/Private Apartment" name="place_of_work[]"> Condominium/Private Apartment
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('HDB 5-rooms or larger',$place_of_work))
				<input type="checkbox" value="HDB 5-rooms or larger" name="place_of_work[]" checked="checked" > HDB 5-rooms or larger
			@else
				<input type="checkbox" value="HDB 5-rooms or larger" name="place_of_work[]" > HDB 5-rooms or larger
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Others', $place_of_work))
				<input type="checkbox" value="Others" name="place_of_work[]" onchange="showfield()" id="work_place_other" checked="checked">  Others (if any)
			@else
				<input type="checkbox" value="Others" name="place_of_work[]" onchange="showfield()" id="work_place_other">Others (if any)
			@endif  
			</label>
			{!! Form::text('other_work_place',null, ['class'=> 'form-control','id'=>'work_place']) !!}
			</div>
		{!! ($errors->has('place_of_work') ? $errors->first('place_of_work', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
   
   <div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of Rooms', 'No. of Rooms:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('no_room')) ? 'error' : '' }}">
		{!! Form::select('no_rooms', array('' => 'Select number of Rooms', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'),null,
		array('class' => 'form-control'  ,'id'=>'no_rooms')) !!}
		{!! ($errors->has('') ? $errors->first('no_rooms', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 columns">
		{!! Form::label('No. of Bedrooms', 'No. of Bedrooms:') !!}
		</div>
		<div class="col-xs-5 {{ ($errors->has('adults')) ? 'error' : '' }}">
		{!! Form::select('bedrooms', array('' => 'Select number of Bedrooms', 
		'1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6','7' => '7', '8' => '8'), null,
		array('class' => 'form-control'  ,'id'=>'bedrooms')) !!}
		{!! ($errors->has('bedrooms') ? $errors->first('bedrooms', '<small class="error">:message</small>') : '') !!}
		</div>
	</div>
	<div class="row">
		<div class="small-10 small-offset-3 columns">
		<input class="button small" value="Update" type="submit">
		{!! Form::reset('Reset', array('class' => 'button small')) !!}
		<button  class="button small" onclick="window.location='{{ url('application') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
		</div>
	</div>
	{!! Form::close() !!}
</div>
	<div id="tabs-8"> 
 {!! Form::model($restday,array('route' => array('sentinel.application.dayofrest', $maid_employer->id))) !!}
  <div class="small-10 columns">
        <p><span class="mandatory">*</span> Fields are required</p>
	</div>
	<div class="row padding-none" style ="padding: 30px 10px 20px 10px;">
		<div class="col-xs-7" style="width:49%;">
		<strong><label class ='label-padding'> {!! Form::radio('rest_days', 'Rest according week', null,['id' => 'rest_week'] ) !!} One rest day for every week. The rest day shall be granted on  
		</label></div>
		<div class="col-xs-3" style="width:20%">
		{!! Form::select('rest_of_week', array('' => 'Select day of week', 
		'Monday' => 'Monday', 'Tuesday' => 'Tuesday','Wednesday ' => 'Wednesday', 'Thursday' => 'Thursday','Friday' => 'Friday', 'Saturday' => 'Saturday','Sunday' => 'Sunday'), null,
		array('class' => 'form-control' ,'id'=>'rest_of_week')) !!}
		{!! ($errors->has('') ? $errors->first('rest_of_week', '<small class="error">:message</small>') : '') !!}
		</div>
		<div  class="col-xs-2"><label class ='label-padding'>(day of week). </label></div></strong>
	</div>	
	<div class="row padding-none" style ="padding: 30px 10px 20px 10px;">
		<div class="col-xs-1" style= "width: 2%;">
		<strong>{!! Form::radio('rest_days', 'Rest according month', null,['id' => 'rest_month', 'class'=> 'input-sm'] ) !!}
		</div>
		<div class="col-xs-1" style= "width: 5%" >
		{!! Form::text('no_of_restday', null, ['class'=> 'form-control','id'=>'no_of_restday']) !!}
		{!! ($errors->has('no_of_restday') ? $errors->first('no_of_restday', '<small class="error">:message</small>') : '') !!} 
		</div>
        <div  class="col-xs-3" style= "width: 19%;"><label class ='label-padding'> rest days in a month on</label></div>
		<div class="col-xs-3" style= "width: 19%;" >{!! Form::select('rest_of_month', array('' => 'Select day of week', 
		'Monday' => 'Monday', 'Tuesday' => 'Tuesday','Wednesday ' => 'Wednesday', 'Thursday' => 'Thursday','Friday' => 'Friday', 'Saturday' => 'Saturday','Sunday' => 'Sunday'), null,
		array('class' => 'form-control' ,'id'=>'rest_of_month')) !!}
		{!! ($errors->has('') ? $errors->first('rest_of_month', '<small class="error">:message</small>') : '') !!}
		</div>
		<div  class="col-xs-5" style= "width: 36%;"><label class ='label-padding'>(day of week) with compensation in lieu at $</label></div>
		<div class="col-xs-1" style= "width: 5%">
		{!! Form::text('compensation', null, ['class'=> 'form-control','id'=>'compensation']) !!}
        {!! ($errors->has('compensation') ? $errors->first('compensation', '<small class="error">:message</small>') : '') !!}
		</div>
         <div  class="row" style= "width: 27%"><label class ='label-padding'> for each rest day forgone. </label></div></strong>
         </div>
	
		
		<div class="row">
		<div class="small-10 small-offset-3 columns">
		<input class="button small" value="Update" type="submit">
		{!! Form::reset('Reset', array('class' => 'button small')) !!}
		<button  class="button small" onclick="window.location='{{ url('application') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
		</div>
		</div>
	{!! Form::close() !!}
	
	</div> 
	
</div>
</div>
@stop