@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
	var $ = jQuery.noConflict();
$(function () {
	$( "#tabs" ).tabs({active:13});
	});
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
  function getworkpermit() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/workpermit') }}";
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
	<?php $employer_details[] = json_decode($maid_employer->employer_json_data); ?>
	<?php $maid_details[] = json_decode($maid_employer->maid_json_data);  ?>
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
		<li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Sponsorship Form</span></a></li>  
		<li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a href="#tabs-14"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
		<li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance Form</span></a></li>  
		<li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li>
		<li><a onclick="return getfdwcontractform('Contract_Fdw_and_Agency')" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Standard Contract B/w FDW & Employment Agency</span></a></li>		
		<li><a onclick="return getfdwdeclaration()()" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration Form For FDW</span></a></li>  
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
		</div>
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
		<div class="workpermit"> 
		</div>
	</div>
	<div id="tabs-13">
		<div class="incometax"> 
		</div>
	</div>
<div id="tabs-14">
	{!! Form::model($incometaxdeclaration,array('route' => array('sentinel.application.incometaxdeclarationupdate', $maid_employer->id))) !!}
		@if($incometaxdeclaration)
		<div class="small-1 columns" style="float:right">
        <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_incometaxdeclaration/yes')}}"></a>
		</div>
		@endif
		<div class="small-8 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
				
		<div class="left small-10 columns" >
		<p><strong> Part I - Monthly Combined Income of Employer and Spouse </strong>  </p>
		</div>
		<div class="row">
		<div class="col-md-4 columns">
		<label for="Combined Income Between">Combined Income Between: <span class="mandatory">*</span> </label>
		</div>
		<div class="col-xs-4" >
		{!! Form::select('combined_income', array(""=>" Select Range... ",
				'Below $2,000' => 'Below $2,000', 
				'$2,000 to $2,499' => '$2,000 to $2,499',
				'$2,500 to $2,999' => '$2,500 to $2,999', 
				'$3,000 to $3,499' => '$3,000 to $3,499',
				'$3,500 to $3,999' => '$3,500 to $3,999',
				'$4,000 to $4,499' => '$4,000 to $4,499',
				'$4,500 to $4,999' => '$4,500 to $4,999',
				'$5,000 to $5,499' => '$5,000 to $5,499',
				'$5,500 to $5,999' => '$5,500 to $5,999',
				'$6,000 to $7,999' => '$6,000 to $7,999',
				'$8,000 to $9,999' => '$8,000 to $9,999',
				'$10,000 to $12,499' => '$10,000 to $12,499',
				'$12,500 to $14,999' => '$12,500 to $14,999',
				'$15,000 to $19,999' => '$15,000 to $19,999',
				'$20,000 to $24,999' => '$20,000 to $24,999',
				'$25,000 and above' => '$25,000 and above'
				), Input::old('native_language')
				,array('class' => 'combined_income')) !!}
				{!! ($errors->has('combined_income') ? $errors->first('combined_income', '<small class="error">:message</small>') : '') !!}
				</div>
		</div>
	<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
		<br>
	<div class="left small-10 columns" style="margin-top:10px"  >
		<p><strong> Part II  - Authorisation by Employer and His/Her Spouse </strong>  </p>
		</div>
	<div class="row">
		<div class="col-md-6 columns">
		<label for="Employer Income Tax Notice of Assessment No">Employer Income Tax Notice of Assessment No:  </label>
		</div>
		<div class="col-xs-3" >
		{!! Form::text('employer_assessment_no',$employer_details[0]->employer_nric_no , ['class'=> 'form-control','id'=>'employer_assessment_no','readonly']) !!}
        {!! ($errors->has('employer_assessment_no') ? $errors->first('employer_assessment_no', '<small class="error">:message</small>') : '') !!}
		</div>
        </div>
	<div class="row">
		<div class="col-md-6 columns">
		<label for="Employer\'s Spouse Income Tax Notice of Assessment No">Employer\'s Spouse Income Tax Notice of Assessment No: </label>
		</div>
		<div class="col-xs-3" >
		{!! Form::text('spouse_assessment_no', $employer_details[0]->spouse_nric_no, ['class'=> 'form-control','id'=>'spouse_assessment_no','readonly']) !!}
        {!! ($errors->has('spouse_assessment_no') ? $errors->first('spouse_assessment_no', '<small class="error">:message</small>') : '') !!}
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
</div>
</div>
@stop
