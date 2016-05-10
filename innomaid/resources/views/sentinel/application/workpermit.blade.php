@extends('sentinel.layouts.default')
@section('content')
 <script type="text/javascript">
	$(function () { $('.datetimepicker').datepicker({changeYear: true, yearRange : '1950:2010' , format: 'yyyy-mm-dd'  , autoclose: true,
    });
	first=$("[name='marital_status_1'] option:selected").text();
	second=$("[name='marital_status_2'] option:selected").text();
	
	if(first!='Married'&&second!='Married')
   { 
   $("#spouse").hide();
   $('.one').prop('disabled', true);
      $('.one').val('');
	  $('.two').prop('disabled', true);
      $('.two').val('');
    } 
   else if(first=='Married'&&second=='Married')
	{ $("#spouse").show();
	 $('.spouse').prop('disabled', false); 
	}
	else if(first!='Married'&& second=='Married'){ 
	$("#spouse").show();
	 $('.two').prop('disabled', false); 
	$('.one').prop('disabled', true);
      $('.one').val('');
	}
	else if(second!='Married' && first=='Married'){ 
	$("#spouse").show();
	  $('.one').prop('disabled', false); 
	 $('.two').prop('disabled', true);
      $('.two').val('');
	}
    else{
	$("#spouse").hide();
      $('.spouse').prop('disabled', true);
      $('.spouse').val('');
    }
  
	first=$("[name='residential_status_1'] option:selected").text();
   second=$("[name='residential_status_2'] option:selected").text();
   if(first!='Other'&&second!='Other')
   {
	$("#other").hide();
   	$("#other").show();
	  $('.status1').prop('disabled', false); 
	 $('.status2').prop('disabled', true);
      $('.status2').val('');
   
   } 
   else if(first=='Other'&&second=='Other')
	{ $("#other").show();
	 $('.other').prop('disabled', false); 
	}
	else if(first!='Other'&& second=='Other'){ 
		$("#other").show();
	 $('.status2').prop('disabled', false); 
	$('.status1').prop('disabled', true);
      $('.status1').val('');
	}
	else if(second!='Other' && first=='Other'){ 
		$("#other").show();
	  $('.status1').prop('disabled', false); 
	 $('.status2').prop('disabled', true);
      $('.status2').val('');
	}
    else{
		$("#other").hide();
      $('.other').prop('disabled', true);
      $('.other').val('');
    }
 $( "#tabs" ).tabs({active:11});
	});
	
	 function spousehide(status){
   first=$("[name='marital_status_1'] option:selected").text();
   second=$("[name='marital_status_2'] option:selected").text();
   if(first!='Married'&&second!='Married')
   {
   $("#spouse").hide();
    $('#spouse').find('input[type=text]:value').removeAttr('');
   
   }
    if(status.value =='Married'){
	$("#spouse").show();
	if(first=='Married'&&second=='Married')
	{ 
	 $('.spouse').prop('disabled', false); 
	}
	else if(first!='Married'&& second=='Married'){ 
	 $('.two').prop('disabled', false); 
	$('.one').prop('disabled', true);
      $('.one').val('');
	}
	else if(second!='Married' && first=='Married'){ 
	  $('.one').prop('disabled', false); 
	 $('.two').prop('disabled', true);
      $('.two').val('');
	}
    else{
      $('.spouse').prop('disabled', true);
      $('.spouse').val('');
    }
  }
  else if(first!='Married'&& second=='Married'){
   $('.two').prop('disabled', false); 
	$('.one').prop('disabled', true);
      $('.one').val('');
	}
	else if(second!='Married' && first=='Married'){ 
	  $('.one').prop('disabled', false); 
	 $('.two').prop('disabled', true);
      $('.two').val('');
	}
	else{
      $('.spouse').prop('disabled', true);
      $('.spouse').val('');
    }
  }
   function otherresidential(status){
   
   first=$("[name='residential_status_1'] option:selected").text();
   second=$("[name='residential_status_2'] option:selected").text();
   if(first!='Other'&&second!='Other')
   {
	$("#other").hide();
    $('#other').find('input[type=text]:value').removeAttr('');
   
   }
    if(status.value =='Other'){
	$("#other").show();
	if(first=='Other'&&second=='Other')
	{ 
	 $('.other').prop('disabled', false); 
	}
	else if(first!='Other'&& second=='Other'){ 
	 $('.status2').prop('disabled', false); 
	$('.status1').prop('disabled', true);
      $('.status1').val('');
	}
	else if(second!='Other' && first=='Other'){ 
	  $('.status1').prop('disabled', false); 
	 $('.status2').prop('disabled', true);
      $('.status2').val('');
	}
    else{
      $('.other').prop('disabled', true);
      $('.other').val('');
    }
  }
  else if(first!='Other'&& second=='Other'){
   $('.status2').prop('disabled', false); 
	$('.status1').prop('disabled', true);
      $('.status1').val('');
	}
	else if(second!='Other' && first=='Other'){ 
	  $('.status1').prop('disabled', false); 
	 $('.status2').prop('disabled', true);
      $('.status2').val('');
	}
	else{
      $('.other').prop('disabled', true);
      $('.other').val('');
    }
  }

  function getagreementform() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab4') }}";
  }
  function getfdwagreementform() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab5') }}";
  }
  function getemployermaid() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab0') }}";
  }
  function getservicefee() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab1') }}";
  }
  function getrestday() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab2') }}";
  }
  function getloanpayment() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab3') }}";
  }
  function gethandling() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab6') }}";
  }
  function getjob() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab7') }}";
  }
  function getsecuritybond() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/securitybond') }}";
  }
  function getauthorisation() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/authorisationworkpass') }}";
  }
  function getsafety() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/safetyagreement') }}";
  }
  function getincometax() { 
     window.location = "{{ url('/application/'.$maid_employer->id.'/incometaxdeclaration') }}";
  }
   function getgiro() { 
     window.location = "{{ url('/application/'.$maid_employer->id.'/giro') }}";
  }
   function getinsurance(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/insurance') }}";
  
  }
   function getwp_renewal(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/wp_renewal') }}";
  
  }
   function getfdwcontractform() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab16') }}";
  }
   function getfdwdeclaration(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/fdwdeclaration') }}";
  
  }
  function getemployerchangedeclaration(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/employerchangedeclaration') }}";
  
  }
function getemploymentcontract(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/employmentcontract') }}";
  
  }
function getpassportrenewal(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/passportrenewal') }}";
  
  }
function getfdwvacation(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/fdwvacation') }}";
  
  }
function getdischarge(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/dischargedform') }}";
  
  }
</script> 
<div id="tabs">
    <ul>
      <li><a onclick="return getemployermaid()" href="#tabs-1" style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Employer & Maid</span></a></li>
      <li><a onclick="return getservicefee()" href="#tabs-2"  style=" padding: 0.3em 0.6em;" ><span style="font-size:0.8em">Service & fees</span></a></li>
      <li><a onclick="return getrestday()" href="#tabs-8"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Rest Days</span></a></li>
    <li><a onclick="return getloanpayment()" href="#tabs-3"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Loan & payment</span></a></li>  
      <li><a onclick="return getagreementform('Service_Employer_and_Agency')" href="#tabs-4"  style=" padding:0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w employer & agency</span></a></li>
      <li><a onclick="return getfdwagreementform('Service_Employer_and_Fdw')" href="#tabs-5"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w FDW & Employer</span></a></li>
      <li><a onclick="return gethandling()"href="#tabs-6"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Handling & Take Over</span></a></li>
      <li><a onclick="return getjob()"href="#tabs-7"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Job Scope</span></a></li>
    <li> <a onclick="return getauthorisation()" href="#tabs-9"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Authorisation Work Pass Transaction</span></a></li>  
     <li><a onclick="return getsecuritybond()" href="#tabs-10"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Security Bond </span></a></li>  
      <li><a onclick="return getsafety()" href="#tabs-11"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Safety Agreement B/w FDW & Employer</span></a></li>
    <li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Sponsorship Form</span></a></li>  
    <li><a  href="#tabs-13" onclick="return getgiro()" style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
    <li><a onclick="return getincometax()" href="#tabs-14"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
    <li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance Form</span></a></li>  
	<li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li>  
		<li><a onclick="return getfdwcontractform('Contract_Fdw_and_Agency')" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Standard Contract B/w FDW & Employment Agency</span></a></li>		
		<li><a onclick="return getfdwdeclaration()()" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration Form For FDW</span></a></li>  
		<li><a onclick="return getemployerchangedeclaration()" href="#tabs-19"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration For Change of Employer</span></a></li> 
<li><a onclick="return getemploymentcontract()" href="#tabs-20"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Standard Employment Contract </span></a></li>
  
<li><a onclick="return getpassportrenewal()" href="#tabs-21"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Passport Renewal Form </span></a></li>  
<li><a onclick="return getfdwvacation()" href="#tabs-22"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> FDW Vacation Forms </span></a></li>    
<li><a onclick="return getdischarge()" href="#tabs-23"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Discharged Form </span></a></li>  
	 </ul>
<div class="panel-body" style="">
  <div id="tabs-1">
    <div class="authorisation agreementdiv"> 
    </div>
  </div>
  <div id="tabs-2">
    <div class="bond"> 
    </div>
  </div>
  <div id="tabs-3">
    <div class="safety"> 
    </div>
  </div>
  <div id="tabs-4">
    <div class="workpermit"> 
    <</div>
  </div>
  <div id="tabs-5">
    <div class="workpermit"> 
    </div>
  </div>
  <div id="tabs-6">
    <div class="incometax"> 
    </div>
  </div>
    <div id="tabs-7">
    <div class="authorisation agreementdiv"> 
    </div>
  </div>
  <div id="tabs-8">
    <div class="bond"> 
    </div>
  </div>
  <div id="tabs-9">
    <div class="bond"> 
    </div>
  </div>
  <div id="tabs-10">
    <div class="safety"> 
    </div>
  </div>
  <div id="tabs-11">
    <div class="workpermit"> 
    </div>
  </div>
<div id="tabs-12">
<?php $interviewed_by=""; ?>
{!! Form::model($workpermit,array('route' => array('sentinel.application.workpermitupdate', $maid_employer->id))) !!}
@if($workpermit)
		<div class="small-1 columns" style="float:right">
        <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_workpermit/yes')}}"></a>
		</div>
		@endif
<div class="small-11 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
 <div class="row"  style="max-width: 100%;">
    <div class="col-xs-3 text_wrap">
    </div>
    <div class="col-xs-3 ">
      <p><strong> Detail of Sponsor 1 </strong>  </p> 
    </div>
    <div class="col-xs-3 ">
       <p><strong> Detail of Sponsor 2 </strong>  </p>
    </div>
  </div>
 <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Name of Sponsor">Sponsor Name :<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('sponsor_name_1')) ? 'error' : '' }}">
        {!! Form::text('sponsor_name_1', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('sponsor_name_1') ? $errors->first('sponsor_name_1', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="col-xs-3 {{ ($errors->has('sponsor_name_2')) ? 'error' : '' }}">
        {!! Form::text('sponsor_name_2', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('sponsor_name_2') ? $errors->first('sponsor_name_2', '<small class="error">:message</small>') : '') !!}
    </div>
	
  </div>
<div class="row"  style="max-width: 100%;">
    <div class="col-xs-3 text_wrap">
      <label for="Gender"> Gender : <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3">
      @if($interviewed_by == 'Male')
      <label class="radio-inline"> {!! Form::radio('gender_1', 'Male', true) !!} Male</label>
      @else
      <label class="radio-inline"> {!! Form::radio('gender_1', 'Male', true) !!} Male</label>
      @endif
      @if($interviewed_by == 'Female')
      <label class="radio-inline">{!! Form::radio('gender_1', ' Female', true) !!} Female </label>
      @else
      <label class="radio-inline">{!! Form::radio('gender_1', 'Female') !!} Female </label>
      @endif
    </div>
	<div class="col-xs-3">
      @if($interviewed_by == 'Male')
      <label class="radio-inline"> {!! Form::radio('gender_2', 'Male', true) !!} Male</label>
      @else
      <label class="radio-inline"> {!! Form::radio('gender_2', 'Male', true) !!} Male</label>
      @endif
      @if($interviewed_by == ' Female')
      <label class="radio-inline">{!! Form::radio('gender_2', 'Female', true) !!} Female</label>
      @else
      <label class="radio-inline">{!! Form::radio('gender_2', 'Female') !!} Female </label>
      @endif
    </div>
  </div>

  <div class="row">
  <div class="col-xs-3 text_wrap">
      <label for="Date of birth"> Date of birth:<span class="mandatory">*</span> </label>
  </div>
  <div class="col-xs-3 ">
		{!! Form::text('dob_1',null, ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'date_of_bond' ]) !!}
         {!! ($errors->has('dob_1') ? $errors->first('dob_1', '<small class="error">:message</small>') : '') !!}
    </div>
   
   <div class="col-xs-3 "> 
		<?php $date=""; ?>
		@if($workpermit)
		@if($workpermit->dob_2=='0000-00-00')
		<?php $date=""; ?>
		@else
		<?php $date=$workpermit->dob_2; ?>
		@endif
		@endif
		{!! Form::text('dob_2',$date , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'date_of_bond1' ]) !!}
         {!! ($errors->has('dob_2') ? $errors->first('dob_2', '<small class="error">:message</small>') : '') !!}
    </div>
</div>
<div class="row">
<div class="col-xs-3 text_wrap">
    <label for="Nationality">Nationality: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-3 " {{ ($errors->has('nationality_1')) ? 'error' : '' }}">
    {!! Form::select('nationality_1', [''=>'Select nationality'] + $nationality,null, ['class' => 'form-control']) !!}
    {!! ($errors->has('nationality_1') ? $errors->first('nationality_2', '<small class="error">:message</small>') : '') !!}
	</div>
	<div class="col-xs-3 " {{ ($errors->has('nationality_2')) ? 'error' : '' }}">
    {!! Form::select('nationality_2', [''=>'Select nationality'] + $nationality, null, ['class' => 'form-control']) !!}
    {!! ($errors->has('nationality_2') ? $errors->first('nationality_2', '<small class="error">:message</small>') : '') !!}
	</div>
</div>

 <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Marital Status">Marital Status: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('marital_status_1')) ? 'error' : '' }}">
        {!! Form::select('marital_status_1', array('' => 'Select marital status', 
        'Married' => 'Married','Un-Married' => 'Un-Married','Divorced' => 'Divorced','Separated' => 'Separated','Widowed' => 'Widowed'), Input::old('religion'),
        array('class' => 'form-control','id'=>'marital_status_1','onchange'=> 'return spousehide(this)')) !!}
        {!! ($errors->has('marital_status_1') ? $errors->first('marital_status_1', '<small class="error">:message</small>') : '') !!}
    </div>
	 <div class="col-xs-3 {{ ($errors->has('marital_status_2')) ? 'error' : '' }}">
        {!! Form::select('marital_status_2', array('' => 'Select marital status', 
        'Married' => 'Married','Un-Married' => 'Un-Married','Divorced' => 'Divorced','Separated' => 'Separated','Widowed' => 'Widowed'), Input::old('religion'),
        array('class' => 'form-control','id'=>'marital_status_2','onchange'=> 'return spousehide(this)')) !!}
        {!! ($errors->has('marital_status_2') ? $errors->first('marital_status_2', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Relationship">Sponsor's Relationship with Employer: <span class="mandatory">*</span> </label>
    </div> 
	<div class="col-xs-3 {{ ($errors->has('relation_with_1')) ? 'error' : '' }}">
        {!! Form::text('relation_with_1', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('relation_with_1') ? $errors->first('relation_with_1', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="col-xs-3 {{ ($errors->has('relation_with_2')) ? 'error' : '' }}">
        {!! Form::text('relation_with_2', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('relation_with_2') ? $errors->first('relation_with_2', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  
 <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Residential status"> Residential Status: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('residential_status_1')) ? 'error' : '' }}">
        {!! Form::select('residential_status_1', array('' => 'Select Residential status', 
        'Singapore Citizen' => 'Singapore Citizen','Singapore Permanent Resident' => 'Singapore Permanent Resident','Employment Pass Holder' => 'Employment Pass Holder','Other' => 'Other'), Input::old('religion'),
        array('class' => 'form-control','id'=>'residential_status_1','onchange'=> 'return otherresidential(this)')) !!}
        {!! ($errors->has('residential_status_1') ? $errors->first('residential_status_1', '<small class="error">:message</small>') : '') !!}
    </div>
	 <div class="col-xs-3 {{ ($errors->has('residential_status_2')) ? 'error' : '' }}">
        {!! Form::select('residential_status_2', array('' => 'Select Residential status', 
        'Singapore Citizen' => 'Singapore Citizen','Singapore Permanent Resident' => 'Singapore Permanent Resident','Employment Pass Holder' => 'Employment Pass Holder','Other' => 'Other'), Input::old('religion'),
        array('class' => 'form-control','id'=>'residential_status_2','onchange'=> 'return otherresidential(this)')) !!}
        {!! ($errors->has('residential_status_2') ? $errors->first('residential_status_2', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <div class="row" id="other">
    <div class="col-xs-3 text_wrap">
        <label for="Name of Sponsor"> Other Residential Status :</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('other_residential_status_1')) ? 'error' : '' }}">
        {!! Form::text('other_residential_status_1', null, ['class'=> 'form-control other status1']) !!}
        {!! ($errors->has('other_residential_status_1') ? $errors->first('other_residential_status_1', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="col-xs-3 {{ ($errors->has('other_residential_status_2')) ? 'error' : '' }}">
        {!! Form::text('other_residential_status_2', null, ['class'=> 'form-control other status2' ]) !!}
        {!! ($errors->has('other_residential_status_2') ? $errors->first('other_residential_status_2', '<small class="error">:message</small>') : '') !!}
    </div>
	
  </div>
  <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Sponsor Identity Card/ Passport Number/FIN">Sponsor Identity Card/ Passport Number/FIN :<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('passport_number_1')) ? 'error' : '' }}">
        {!! Form::text('passport_number_1', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('passport_number_1') ? $errors->first('passport_number_1', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="col-xs-3 {{ ($errors->has('passport_number_2')) ? 'error' : '' }}">
        {!! Form::text('passport_number_2', null, ['class'=> 'form-control']) !!}
        {!! ($errors->has('passport_number_2') ? $errors->first('passport_number_2', '<small class="error">:message</small>') : '') !!}
    </div>
	
  </div>
  
  <div class="row">
<div class="col-xs-3 text_wrap">
    <label for="Occupation">Sponsor's Occupation: </label>
      </div>
    <div class="col-xs-3 {{ ($errors->has('occupation_1')) ? 'error' : '' }}">
    {!! Form::text('occupation_1', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('occupation_1') ? $errors->first('occupation_1', '<small class="error">:message</small>') : '') !!}
</div>
<div class="col-xs-3 {{ ($errors->has('occupation_2')) ? 'error' : '' }}">
    {!! Form::text('occupation_2', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('occupation_2') ? $errors->first('occupation_2', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="col-xs-3 text_wrap">
    <label for="Name of Company">Name of Company : </label>
      </div>
    <div class="col-xs-3 {{ ($errors->has('company_name_1')) ? 'error' : '' }}">
    {!! Form::text('company_name_1', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('company_name_1') ? $errors->first('company_name_1', '<small class="error">:message</small>') : '') !!}
</div>
<div class="col-xs-3 {{ ($errors->has('company_name_2')) ? 'error' : '' }}">
    {!! Form::text('company_name_2', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('company_name_2') ? $errors->first('company_name_2', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div class="row">
<div class="col-xs-3 text_wrap">
    <label for="Contact number"> Contact Number : </label>
      </div>
    <div class="col-xs-3 {{ ($errors->has('contact_number_1')) ? 'error' : '' }}">
    {!! Form::text('contact_number_1', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('contact_number_1') ? $errors->first('contact_number_1', '<small class="error">:message</small>') : '') !!}
</div>
<div class="col-xs-3 {{ ($errors->has('contact_number_2')) ? 'error' : '' }}">
    {!! Form::text('contact_number_2', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('contact_number_2') ? $errors->first('contact_number_2', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div class="row">
<div class="col-xs-3 text_wrap">
    <label for="Email Address"> Email Address : </label>
      </div>
    <div class="col-xs-3 {{ ($errors->has('email_address_1')) ? 'error' : '' }}">
    {!! Form::text('email_address_1', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('email_address_1') ? $errors->first('email_address_1', '<small class="error">:message</small>') : '') !!}
</div>
<div class="col-xs-3 {{ ($errors->has('email_address_2')) ? 'error' : '' }}">
    {!! Form::text('email_address_2', null, ['class'=> 'form-control']) !!}
    {!! ($errors->has('email_address_2') ? $errors->first('email_address_2', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row" style="max-width: 100%;">
    <div class="col-xs-3 text_wrap">
      {!! Form::label('Address different from the Employer\'s Address ', 'Address different from the Employer\'s Address:') !!}
    </div>
    <div class="col-xs-3">
      @if($interviewed_by == 'Yes')
      <label class="radio-inline"> {!! Form::radio('address_difference_1', 'Yes', true) !!} Yes</label>
      @else
      <label class="radio-inline"> {!! Form::radio('address_difference_1', 'Yes') !!} Yes</label>
      @endif
      @if($interviewed_by == ' No')
      <label class="radio-inline">{!! Form::radio('address_difference_1', ' No', true) !!} No </label>
      @else
      <label class="radio-inline">{!! Form::radio('address_difference_1', ' No') !!}  No </label>
      @endif
    </div>
	<div class="col-xs-3">
      @if($interviewed_by == 'Yes')
      <label class="radio-inline"> {!! Form::radio('address_difference_2', 'Yes', true) !!} Yes</label>
      @else
      <label class="radio-inline"> {!! Form::radio('address_difference_2', 'Yes') !!} Yes</label>
      @endif
      @if($interviewed_by == ' No')
      <label class="radio-inline">{!! Form::radio('address_difference_2', ' No', true) !!}  No </label>
      @else
      <label class="radio-inline">{!! Form::radio('address_difference_2', ' No') !!}  No </label>
      @endif
    </div>
  </div>
  <div >
 <div class="row"  style="max-width: 100%;">
    <div class="col-xs-3 text_wrap">
    </div>
    <div class="col-xs-3 ">
      <p><strong> Detail of Sponsor 1's Spouse </strong>  </p> 
    </div>
    <div class="col-xs-3 ">
       <p><strong> Detail of Sponsor 2's Spouse </strong>  </p>
    </div>
  </div>
   <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Name of Sponsor"> Name of Sponsor's Spouse :<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('sponsor_spouse_name_1')) ? 'error' : '' }}">
        {!! Form::text('sponsor_spouse_name_1', null, ['class'=> 'form-control spouse one']) !!}
        {!! ($errors->has('sponsor_spouse_name_1') ? $errors->first('sponsor_spouse_name_1', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="col-xs-3 {{ ($errors->has('sponsor_spouse_name_2')) ? 'error' : '' }}">
        {!! Form::text('sponsor_spouse_name_2', null, ['class'=> 'form-control spouse two']) !!}
        {!! ($errors->has('sponsor_spouse_name_2') ? $errors->first('sponsor_spouse_name_2', '<small class="error">:message</small>') : '') !!}
    </div>
	</div>
   <div class="row">
    <div class="col-xs-3 text_wrap">
        <label for="Sponsor Identity Card/ Passport Number/FIN">Spouse's Identity Card/ Passport Number/FIN :<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('passport_spouse_number_1')) ? 'error' : '' }}">
        {!! Form::text('passport_spouse_number_1', null, ['class'=> 'form-control spouse one']) !!}
        {!! ($errors->has('passport_spouse_number_1') ? $errors->first('passport_spouse_number_1', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="col-xs-3 {{ ($errors->has('passport_spouse_number_2')) ? 'error' : '' }}">
        {!! Form::text('passport_spouse_number_2', null, ['class'=> 'form-control spouse two']) !!}
        {!! ($errors->has('passport_spouse_number_2') ? $errors->first('passport_spouse_number_2', '<small class="error">:message</small>') : '') !!}
    </div>
	
  </div>
  </div>
  <div class="row" style="margin-top:20px">
		<div class="small-10 small-offset-3 columns">
		<input class="button small" value="Update" type="submit">
		{!! Form::reset('Reset', array('class' => 'button small')) !!}
		<button  class="button small" onclick="window.location='{{ url('application') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
		</div>
	</div>
	</form>
</div>
<div id="tabs-13">
    <div class="incometax"> 
    </div>
  </div>
  <div id="tabs-14">
    <div class="incometax"> 
    </div>
  </div>
</div>
</div>
@stop
