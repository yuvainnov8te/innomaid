@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function () {
    if($('#house_type_other_check').is(':checked')) {
      $('#house_type_other_input').show();
    } else {  
      $('#house_type_other_input').val('');
      $('#house_type_other_input').hide();
    }
    if($('#purpose_to_hire_replce_check').is(':checked')) {
      $('#permit_no').show();
    } else {  
      $('#purpose_to_hire_work_permit_no').val('');
      $('#permit_no').hide();
    }
    if(!($('#is_house_hold_income').is(':checked'))) {
      $('#annual_house_hold_income').val('');
    }
    if($('#income_tax_check').is(':checked')) {
      $('#job_title').show();
      $('#starting_date').show();
      $('#monthly_income').show();
    } else {  
      $('#job_title').val('');
      $('#job_title').hide();
      $('#starting_date_text').val('');
      $('#starting_date').hide();
      $('#monthly_income_text').val('');
      $('#monthly_income').hide();
    }
    if($('#marital_status').val() !='Married'){
      $('.spouse').prop('disabled', true);
      $('.spouse').val('');
      $('.spouse').attr('checked', false);

    }
    else{
      $('.spouse').prop('disabled', false);
    }
    $( "#tabs" ).tabs();
    $( "#tabs" ).tabs( "disable", 1 );
   $('.datetimepicker').datepicker({changeYear: true, yearRange : '1950:2020' , format: 'yyyy-mm-dd'  , autoclose: true,
    });
}); 
  function showfield() {
   var housetype=$("select#housetype").val();
   count=housetype[housetype.length-1];
		if(count=='8')
		{
			 $('#house_type_other_input').show();
		}
		else{
			$('#house_type_other_input').val('');
     			 $('#house_type_other_input').hide();
		}
    if($('#purpose_to_hire_replce_check').is(':checked')) {
      $('#permit_no').show();
    } else {  
      $('#purpose_to_hire_work_permit_no').val('');
      $('#permit_no').hide();
    }
    if($('#income_tax_check').is(':checked')) {
      $('#job_title').show();
      $('#starting_date').show();
      $('#monthly_income').show();
    } else {  
      $('#job_title_text').val('');
      $('#job_title').hide();
      $('#starting_date_text').val('');
      $('#starting_date').hide();
      $('#monthly_income_text').val('');
      $('#monthly_income').hide();
    }
   if(!($('#is_house_hold_income').is(':checked'))) {
      $('#annual_house_hold_income').val('');
    }
  }
  function spousehide(status){
    if(status !='Married'){
      $('.spouse').prop('disabled', true);
      $('.spouse').val('');
      $('.spouse').attr('checked', false);
    }
    else{
      $('.spouse').prop('disabled', false);
    }
  }
 
 function isFutureDate(id){
   // alert();
    var today = new Date().getTime();
    var day = $('#'+id+'_day').val();
    var month = $('#'+id+'_month').val();
    var year = $('#'+id+'_year').val();
    if(day && month && year){
      idate = new Date(year, month - 1, day).getTime();
      if((today - idate) < 0){
        alert('You can not select future date.');
        $("#"+id+"_day").val($("#"+id+"_day option:first").val());
        $("#"+id+"_month").val($("#"+id+"_month option:first").val());
        $("#"+id+"_year").val($("#"+id+"_year option:first").val());
        return false;
      } 
      else{
        var m = parseInt(month, 10);
        var d = parseInt(day, 10);
        var y = parseInt(year, 10);
        var date = new Date(y,m-1,d);
        if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
            return true;
        } else {
            alert('Please select valid date.');
            $("#"+id+"_day").val($("#"+id+"_day option:first").val());
            $("#"+id+"_month").val($("#"+id+"_month option:first").val());
            $("#"+id+"_year").val($("#"+id+"_year option:first").val());
            return false;
        }
      }
     } 
}
function validateNRIC(str,id) {

 if (str.length != 9) {
        alert("Please enter correct NRIC no ");
  $("#"+id).val("");
  return false;
  }
    str = str.toUpperCase();

    var i, 
        icArray = [];
    for(i = 0; i < 9; i++) {
        icArray[i] = str.charAt(i);
    }

    icArray[1] = parseInt(icArray[1], 10) * 2;
    icArray[2] = parseInt(icArray[2], 10) * 7;
    icArray[3] = parseInt(icArray[3], 10) * 6;
    icArray[4] = parseInt(icArray[4], 10) * 5;
    icArray[5] = parseInt(icArray[5], 10) * 4;
    icArray[6] = parseInt(icArray[6], 10) * 3;
    icArray[7] = parseInt(icArray[7], 10) * 2;

    var weight = 0;
    for(i = 1; i < 8; i++) {
        weight += icArray[i];
    }

    var offset = (icArray[0] == "T" || icArray[0] == "G") ? 4:0;
    var temp = (offset + weight) % 11;

    var st = ["J","Z","I","H","G","F","E","D","C","B","A"];
    var fg = ["X","W","U","T","R","Q","P","N","M","L","K"];

    var theAlpha;
    if (icArray[0] == "S" || icArray[0] == "T") { theAlpha = st[temp]; }
    else if (icArray[0] == "F" || icArray[0] == "G") { theAlpha = fg[temp]; }

    if(icArray[8] === theAlpha)
  {
  }
  else{ alert("Please enter correct NRIC no ");$("#"+id).val(""); return false;}
}
</script>
<h3>Add Employer data</h3>
<hr/>
<div id="tabs">
    <ul>
      <li><a href="#tabs-1"><strong>Part A.</strong> <span style="font-size:0.7em">PROFILE</span></a></li>
      <li><a href="#tabs-2"><strong>Part B.</strong> <span style="font-size:0.7em">UPLOAD DOCUMENT</span></a></li>
    </ul>
<div class="panel-body" style="">
{!! Form::open(array('route' => 'employer.create' ,'enctype'=>'multipart/form-data')) !!}
    <!-- include is used for render partial view errors/form_error.blade.php and books/form.blade.php -->
  <div class="col-xs-12">
   <p><span class="mandatory">*</span> Fields are required</p>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Marital Status: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('marital_status')) ? 'error' : '' }}">
        {!! Form::select('marital_status', array('' => 'Select marital status', 
         'Married' => 'Married','Un-Married' => 'Un-Married','Divorced' => 'Divorced','Separated' => 'Separated','Widowed' => 'Widowed'), Input::old('religion'),
        array('class' => 'form-control','id'=>'marital_status','onchange'=> 'return spousehide(this.value)')) !!}
        {!! ($errors->has('marital_status') ? $errors->first('marital_status', '<small class="error">:message</small>') : '') !!}
    </div>
    
    @if(Auth::user()->hasRole(['admin']))
    <div class="small-width18 columns">
        <label for="Name of FDW">Agency:<span class="mandatory">*</span></label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('users_agents_id')) ? 'error' : '' }}">
        {!! Form::select('users_agents_id', [''=>'Select agency'] + $agencies,null, ['class' => 'form-control']) !!}
        {!! ($errors->has('users_agents_id') ? $errors->first('users_agents_id', '<small class="error">:message</small>') : '') !!}
    </div>
     @endif

  </div>

   <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Name:<span class="mandatory">*</span> </label>
    </div>
   <div class="col-xs-1 " style="padding-right:0px">
	{!! Form::select('name_title', array('' => 'Please Select','Mr' => 'Mr','Mrs'=>'Mrs', 'Miss' => 'Miss','Madam' => 'Madam','Sir'=>'Sir','Dr'=>'Dr'), null,array('class' => 'form-control')) !!}
	{!! ($errors->has('name_title') ? $errors->first('name_title', '<small class="error">:message</small>') : '') !!}</div>
       <div class="col-xs-2 {{ ($errors->has('employer_name')) ? 'error' : '' }}" style="padding-left:0px"> {!! Form::text('employer_name', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('employer_name') ? $errors->first('employer_name', '<small class="error">:message</small>') : '') !!}</div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Name:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('spouse_name', null, ['class'=> 'form-control spouse']) !!}
        {!! ($errors->has('spouse_name') ? $errors->first('spouse_name', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>

  <div class="row">
    <div class="small-width18 columns">
        <label for="Date of birth">Employer Date of birth: <span class="mandatory">*</span> </label>
    </div>
     <div class="col-xs-3 {{ ($errors->has('employer_date_of_birth')) ? 'error' : '' }}">
     <div class="col-xs-4 {{ ($errors->has('employer_date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
      {!! Form::select('employer_date_of_birth_day', ['' => 'Day'] + array_combine(range(1, 31), range(1, 31)),null,['onchange'=> 'return isFutureDate("employer")','id'=>'employer_day']) !!}
     </div>
     <div class="col-xs-4 {{ ($errors->has('employer_date_of_birth')) ? 'error' : '' }}" style="padding-left: 2px;padding-right: 2px;">
     {!! Form::select('employer_date_of_birth_month', array('' => 'Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field','onchange'=> 'return isFutureDate("employer")','id'=>'employer_month']) !!}
     </div>
     
     <div class="col-xs-4 {{ ($errors->has('employer_date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
     {!! Form::select('employer_date_of_birth_year', ['' => 'Year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),null,['onchange'=> 'return isFutureDate("employer")','id'=>'employer_year']) !!}
     </div>
      {!! ($errors->has('employer_date_of_birth_day') ? $errors->first('employer_date_of_birth_day', '<small class="error">:message</small>') : '') !!}
       {!! ($errors->has('employer_date_of_birth_month') ? $errors->first('employer_date_of_birth_month', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('employer_date_of_birth_year') ? $errors->first('employer_date_of_birth_year', '<small class="error">:message</small>') : '') !!}
      </div>
      <div class="small-width18 columns">
        <label for="Date of birth">Spouse Date of birth: <span class="mandatory">*</span> </label>
    </div>
     <div class="col-xs-3 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}">
     <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
      {!! Form::select('spouse_date_of_birth_day', ['' => 'Day'] + array_combine(range(1, 31), range(1, 31)),null,['class' => 'field spouse', 'onchange'=> 'return isFutureDate("sponse")','id'=>'sponse_day']) !!}
     </div>
     <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 2px;padding-right: 2px;">
     {!! Form::select('spouse_date_of_birth_month', array('' => 'Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field spouse','onchange'=> 'return isFutureDate("sponse")','id'=>'sponse_month']) !!}
     </div>
     
     <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
     {!! Form::select('spouse_date_of_birth_year', ['' => 'Year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),null,['class' => 'field spouse', 'onchange'=> 'return isFutureDate("sponse")','id'=>'sponse_year']) !!}
     </div>
      {!! ($errors->has('spouse_date_of_birth_day') ? $errors->first('spouse_date_of_birth_day', '<small class="error">:message</small>') : '') !!}
       {!! ($errors->has('spouse_date_of_birth_month') ? $errors->first('spouse_date_of_birth_month', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('spouse_date_of_birth_year') ? $errors->first('spouse_date_of_birth_year', '<small class="error">:message</small>') : '') !!}
      </div>
  </div>

  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer NRIC Number:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }}">
        {!! Form::text('employer_nric_no', null, ['class'=> 'form-control', 'onblur' =>'validateNRIC(this.value,this.id)','id'=>'employer']) !!}
        {!! ($errors->has('employer_nric_no') ? $errors->first('employer_nric_no', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse NRIC Number:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_nric_no')) ? 'error' : '' }}">
        {!! Form::text('spouse_nric_no', null, ['class'=> 'form-control spouse', 'onblur' =>'validateNRIC(this.value,this.id)','id'=>'spouse']) !!}
        {!! ($errors->has('spouse_nric_no') ? $errors->first('spouse_nric_no', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>

  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Passport:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_passport')) ? 'error' : '' }}">
        {!! Form::text('employer_passport', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('employer_passport') ? $errors->first('employer_passport', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Passport:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_passport')) ? 'error' : '' }}">
        {!! Form::text('spouse_passport', null, ['class'=> 'form-control spouse']) !!}
        {!! ($errors->has('spouse_passport') ? $errors->first('spouse_passport', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
<div class="row">
    <div class="small-width18 columns">
        <label for="Employer Passport Expiry Date">Employer Passport Expiry Date:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_passport_expiry_date')) ? 'error' : '' }}">
        {!! Form::text('employer_passport_expiry_date', null, ['class'=> 'form-control datetimepicker']) !!}
        {!! ($errors->has('employer_passport_expiry_date') ? $errors->first('employer_passport_expiry_date', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Spouse Passport Expiry Date">Spouse Passport Expiry Date:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_passport_expiry_date')) ? 'error' : '' }}">
        {!! Form::text('spouse_passport_expiry_date', null, ['class'=> 'form-control spouse datetimepicker']) !!}
        {!! ($errors->has('spouse_passport_expiry_date') ? $errors->first('spouse_passport_expiry_date', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Residential Status:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3">
      <div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> 
      {!! Form::checkbox('employer_residential_status[]', "S'porean or PR") !!} S'porean or PR </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> {!! Form::checkbox('employer_residential_status[]', 'EP') !!} EP </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;">{!! Form::checkbox('employer_residential_status[]', "Retriee") !!} Retriee </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> {!! Form::checkbox('employer_residential_status[]', 'DP') !!} DP </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important; white-space: nowrap;">{!! Form::checkbox('employer_residential_status[]', "Foreign Armed Forces Personnel") !!} Foreign Armed Forces Personnel </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> {!! Form::checkbox('employer_residential_status[]', 'Diplomat') !!} Diplomat </label>
      </div>
      {!! ($errors->has('employer_residential_status') ? $errors->first('employer_residential_status', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Residential Status:<span class="mandatory">*</span> </label>
    </div>
     <div class="col-xs-3">
     <div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> 
      {!! Form::checkbox('spouse_residential_status[]', "S'porean or PR", null, ['class' => 'field spouse']) !!} S'porean or PR </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> {!! Form::checkbox('spouse_residential_status[]', 'EP', null, ['class' => 'field spouse']) !!} EP </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;">{!! Form::checkbox('spouse_residential_status[]', "Retriee", null, ['class' => 'field spouse']) !!} Retriee </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> {!! Form::checkbox('spouse_residential_status[]', 'DP', null, ['class' => 'field spouse']) !!} DP </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;white-space: nowrap;">{!! Form::checkbox('spouse_residential_status[]', "Foreign Armed Forces Personnel", null, ['class' => 'field spouse']) !!} Foreign Armed Forces Personnel </label>
      </div><div class="row">
      <label class="checkbox-inline" style="padding-left: 7px ! important;"> {!! Form::checkbox('spouse_residential_status[]', 'Diplomat', null, ['class' => 'field spouse']) !!} Diplomat </label>
      </div>
       {!! ($errors->has('spouse_residential_status') ? $errors->first('spouse_residential_status', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Profession:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_profession')) ? 'error' : '' }}">
        {!! Form::text('employer_profession', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('employer_profession') ? $errors->first('employer_profession', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Profession:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_profession')) ? 'error' : '' }}">
        {!! Form::text('spouse_profession', null, ['class'=> 'form-control spouse']) !!}
        {!! ($errors->has('spouse_profession') ? $errors->first('spouse_profession', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Company:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_company')) ? 'error' : '' }}">
        {!! Form::text('employer_company', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('employer_company') ? $errors->first('employer_company', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Company:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_company')) ? 'error' : '' }}">
        {!! Form::text('spouse_company', null, ['class'=> 'form-control spouse']) !!}
        {!! ($errors->has('spouse_company') ? $errors->first('spouse_company', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Office Phone:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_office_phone')) ? 'error' : '' }}">
        {!! Form::text('employer_office_phone', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('employer_office_phone') ? $errors->first('employer_office_phone', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Office Phone:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_office_phone')) ? 'error' : '' }}">
        {!! Form::text('spouse_office_phone', null, ['class'=> 'form-control spouse']) !!}
        {!! ($errors->has('spouse_office_phone') ? $errors->first('spouse_office_phone', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Employer Mobile Phone:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_mobile_phone')) ? 'error' : '' }}">
        {!! Form::text('employer_mobile_phone', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('employer_mobile_phone') ? $errors->first('employer_mobile_phone', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Spouse Mobile Phone:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_mobile_phone')) ? 'error' : '' }}">
        {!! Form::text('spouse_mobile_phone', null, ['class'=> 'form-control spouse']) !!}
        {!! ($errors->has('spouse_mobile_phone') ? $errors->first('spouse_mobile_phone', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Address:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('address')) ? 'error' : '' }}">
        {!! Form::text('address', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('address') ? $errors->first('address', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Home Phone:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('home_phone')) ? 'error' : '' }}">
        {!! Form::text('home_phone', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('home_phone') ? $errors->first('home_phone', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
 <div class="row">
  <div class="small-width18 columns">
  <label for="House type">Type Of House:  </label>
   </div>
       <div class="col-xs-3 ">{!! Form::select('house_type_id[]', ['' => 'Select House Type']+ $house_type,null,array('class' => 'form-control','multiple'=>'true', 'onchange' => 'showfield()','id'=>'housetype')) !!}
       {!! Form::text('house_type_other', null, ['class'=> 'form-control','id'=>'house_type_other_input']) !!}</div>
  </div>
  </br>
  <div class="row">
                <div class="small-12 large-centered columns">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="contactcontent" width="100%">
                              <thead>
                                <tr id='addcontact0'>
                                  <th style="width:10%">Name of Family Members</th>
                                  <th style="width:10%">Relationship</th>
                                  <th style="width:10%">BC/NRIC,DP or PP No.</th>
                                  <th style="width:15%">Date Of Birth</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php $radiocounter = 0; ?>
                                        <tr>
                                            <td><input placeholder="" name="family_member_name[]" type="text" value="" id="contact_name"></td>
                                            <td><input placeholder="" name="relationship[]" type="text" value=""></td>
                                            <td><input placeholder="" name="bc_nric_dd_pp_no[]" type="text" value="" onblur ='validateNRIC(this.value,this.id)' id='first'></td>
                                            <td>
                                                 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
                                                  {!! Form::select('family_dob_day[]', ['' => 'Day'] + array_combine(range(1, 31), range(1, 31)),null,['onchange'=> 'return isFutureDate("first")','id'=>'first_day']) !!}
                                                 </div>
                                                 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 2px;padding-right: 2px;">
                                                 {!! Form::select('family_dob_month[]', array('' => 'Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field','onchange'=> 'return isFutureDate("first")','id'=>'first_month']) !!}

                         </div>
                                                 
                                                 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
                                                 {!! Form::select('family_dob_year[]', ['' => 'Year'] + array_combine(range(1900, date('Y')), range(1900, date('Y'))),null,['onchange'=> 'return isFutureDate("first")','id'=>'first_year']) !!}
                                                 </div>
                                              </td>
                                        </tr>
                                        <tr id='addcontact1'></tr>
                              </tbody>
                        </table>
                        <a id="add_row_contact" class="btn btn-default pull-left">Add Member</a><a id='delete_row_contact' class="pull-right btn btn-default">Remove</a>
                    </div>    
                </div>
            </div>
            <br />
            <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Purpose of this application is to hire:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3">
      <div class="row">
      <label class="checkbox-inline"> 
      {!! Form::checkbox('purpose_to_hire[]', "A New FDW") !!} A New FDW </label>
      </div><div class="row">
      <label class="checkbox-inline"> {!! Form::checkbox('purpose_to_hire[]', 'A Replacement',null,[ 'onChange' => 'showfield()']) !!} A Replacement </label>
      </div>
      <div class="row">
      <label class="checkbox-inline">{!! Form::checkbox('purpose_to_hire[]', "An Additional FDW") !!} An Additional FDW </label>
      </div>
      {!! ($errors->has('purpose_to_hire') ? $errors->first('purpose_to_hire', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
 <!-- <div class="row" id='permit_no'>
    <div class="small-width18 columns">
        <label for="Work Permit No. of FDW to be replaced">Work Permit No. of FDW to be replaced:</label>
    </div>
    <div class="col-xs-3 ">
       {!! Form::text('purpose_to_hire_work_permit_no', null, ['class'=> 'form-control','id'=>'purpose_to_hire_work_permit_no']) !!}
    </div>
  </div>-->
  <br />
  <div class="row" style="border-bottom:1px solid #c2c2c2"></div>
  <br />
  <div class="row">
  <div class="small-10 columns">
    <p>If employer is an expatriate just arrived on Singapore or a citizen/SPR just returned after a protracted absence and therefore have not paid income tax or are currently not liable for income tax,Please check here <label class="checkbox-inline" style="margin-top:10px;">{!! Form::checkbox('is_income_tax_libal', "Yes",null,['id' => 'income_tax_check', 'onChange' => 'showfield()']) !!} :</label></p>
  </div>
</div>
<div class="row" id='job_title'>
<div class="small-width18 columns">
        <label for="Name of FDW">Job Tittle:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('job_title')) ? 'error' : '' }}">
        {!! Form::text('job_title', null, ['class'=> 'form-control','id'=>'job_title_text']) !!}
        {!! ($errors->has('job_title') ? $errors->first('job_title', '<small class="error">:message</small>') : '') !!}
    </div>
</div>
<div class="row" id='starting_date'>
<div class="small-width18 columns">
        <label for="Name of FDW">Starting Date:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('start_date')) ? 'error' : '' }}">
        {!! Form::text('start_date', null, ['class'=> 'form-control datetimepicker','id'=>'starting_date_text']) !!}
        {!! ($errors->has('start_date') ? $errors->first('start_date', '<small class="error">:message</small>') : '') !!}
    </div>
</div>
<div class="row" id='monthly_income'>
<div class="small-width18 columns">
        <label for="Name of FDW">Monthly Income in S$:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('monthly_income')) ? 'error' : '' }}">
        {!! Form::text('monthly_income', null, ['class'=> 'form-control','id'=>'monthly_income_text']) !!}
        {!! ($errors->has('monthly_income') ? $errors->first('monthly_income', '<small class="error">:message</small>') : '') !!}
    </div>
</div>
<div class="row">
  <div class="small-10 columns">
    <p>Furnish a letter from your employer (with official letterhead)</p>
  </div>
</div>
<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
<br />
<div class="row">
  <div class="small-10 columns">
    <p>If employer is Citizen or Permanent resident and have just return after an extended period and stay aboard please check box <label class="checkbox-inline" style="margin-top:10px;">{!! Form::checkbox('is_employer_permanent_resident', "Yes",null,['id' => 'income_tax_check']) !!} </label> and furnish:</p>
  </div>
</div>
<div class="row">
  <div class="small-10 columns">
    <p>1. A copy of a tax returns, with the income tax authority of the country where he/she last worked.</p>
  </div>
</div>
<div class="row">
  <div class="small-10 columns">
    <p>2. The latest copy of employer CPF statement showing the contribution made over the last 3 to 6 months.</p>
  </div>
</div>
<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
<br />
<div class="row">
  <div class="small-10 columns">
    <p>If employer is liable for income tax, please check against the following option:</p>
  </div>
</div>
<div class="row">
  <div class="small-10 columns">
    <p> <label class="checkbox-inline" style="margin-top:10px;">{!! Form::checkbox('is_house_hold_income', "Yes",null,['id' => 'is_house_hold_income', 'onChange' => 'showfield()']) !!} </label> &nbsp; To declare house hold income in the prescribed work permit application form. State of annual household income in S$ {!! Form::text('annual_house_hold_income', null, ['class'=> 'form-control','id'=>'annual_house_hold_income']) !!}{!! ($errors->has('annual_house_hold_income') ? $errors->first('annual_house_hold_income', '<small class="error">:message</small>') : '') !!}</p>
  </div>
</div>
<div class="row">
  <div class="small-10 columns">
    <p> <label class="checkbox-inline" style="margin-top:10px;">{!! Form::checkbox('is_iras_notice', "Yes",null,['id' => '']) !!}  </label>&nbsp; To attach latest IRAS Notice of Assessment of spouse and employer.</p>
  </div>
</div>

<input type='hidden' value=' <?php echo $isapp ?>' name='isapp'>
<div class="row">
<div class="small-10 margin-left columns">
    <input class="button small" value="Save" type="submit">
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
    <button  class="button small" onclick="window.location='{{ url('employer') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
</div>
</div>

 {!! Form::close() !!}
 </div>
  </div>
 <script type="text/javascript">
    $(document).ready(function(){
     // This section is used for history pannel add delete row
     var k=1;
        $("#add_row_contact").click(function(){
            $('#addcontact'+k).html('<td><input placeholder="" name="family_member_name[]" type="text" value="" id="contact_name"></td><td><input placeholder="" name="relationship[]" type="text" value=""></td><td><input placeholder="" name="bc_nric_dd_pp_no[]" type="text" value=""  onblur ="validateNRIC(this.value,this.id)" id='+k+'></td><td><div class="col-xs-4 {{ ($errors->has("date_of_birth")) ? "error" : '' }}" style="padding-left: 0px;padding-right: 0px;">{!! Form::select("family_dob_day[]", ["" => "Day"] + array_combine(range(1, 31), range(1, 31)),null,["onchange"=> "return isFutureDate('+k+')","id"=>"'+k+'_day"]) !!}</div><div class="col-xs-4 {{ ($errors->has("date_of_birth")) ? "error" : '' }}" style="padding-left: 2px;padding-right: 2px;">{!! Form::select("family_dob_month[]", array('' => 'Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field',"onchange"=> "return isFutureDate('+k+')","id"=>"'+k+'_month"]) !!}</div><div class="col-xs-4 {{ ($errors->has("date_of_birth")) ? "error" : '' }}" style="padding-left: 0px;padding-right: 0px;">{!! Form::select("family_dob_year[]", ["" => "Year"] + array_combine(range(1900, date('Y')), range(1900, date('Y'))),null,["onchange"=> "return isFutureDate('+k+')","id"=>"'+k+'_year"]) !!}</div></td>');

            $('#contactcontent').append('<tr id="addcontact'+(k+1)+'"></tr>');
            k++; 
        });
    $("#delete_row_contact").click(function(){
       if(k>1){
         $("#addcontact"+(k-1)).html('');
         k--;
       }
    });

});
</script>
@stop
