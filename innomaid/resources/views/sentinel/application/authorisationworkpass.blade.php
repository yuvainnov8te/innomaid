@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function () {
	$( "#tabs" ).tabs({active:8});
	 $('.datetimepicker').datepicker({changeYear: true, yearRange : '1950:2020' , format: 'yyyy-mm-dd'  , autoclose: true,
    });
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
  function getsafety() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/safetyagreement') }}";
  }
  function getincometax() { 
     window.location = "{{ url('/application/'.$maid_employer->id.'/incometaxdeclaration') }}";
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
	<?php $employer_details[] = json_decode($maid_employer->employer_json_data);?>
	<?php $maid_details[] = json_decode($maid_employer->maid_json_data);$date=explode(' ' ,$maid_employer->created_at);  
	$bond_date=date('Y/m/d',strtotime($date[0])); ?>
	
	<?php
				if($authorisationworkpass){
			$declaration_by_ea = explode(';', $authorisationworkpass->declaration_by_ea);
			$is_agency_authorise_workpass =  $authorisationworkpass->is_agency_authorise_workpass;
			$is_emplyer_authoise_form_submit =$authorisationworkpass->is_emplyer_authoise_form_submit;
			}
			else{$declaration_by_ea=array();
				$is_agency_authorise_workpass ="";
				$is_emplyer_authoise_form_submit ="";
				}?>
<h3 style='margin-left:10px;'>Maid Application</h3>
<hr/>
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
	  <li> <a href="#tabs-9"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Authorisation Work Pass Transaction</span></a></li>  
	   <li><a onclick="return getsecuritybond()" href="#tabs-10"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Security Bond </span></a></li>  
	    <li><a onclick="return getsafety()" href="#tabs-11"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Safety Agreement B/w FDW & Employer</span></a></li>
		<li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Sponsorship Form</span></a></li>  
		<li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a onclick="return getincometax()" href="#tabs-14"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
		<li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance Form</span></a></li>  
		<li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li> 
		<li><a onclick="return getfdwcontractform('Contract_Fdw_and_Agency')" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Standard Contract B/w FDW & Employment Agency</span></a></li>
		<li><a onclick="return getfdwdeclaration()()" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration Form For FDW</span></a></li>  
		<li><a onclick="return getemployerchangedeclaration()" href="#tabs-19"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration For Change of Employer</span></a></li> 
  
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
<div id="tabs-9" >
		<div class=" agreementdiv" > 		
	{!! Form::model(null,array('route' => array('sentinel.application.authorisationworkpassupdate', $maid_employer->id))) !!}
			@if($authorisationworkpass)
			<div class="small-1 columns" style="float:right">
			   <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_authorisationworkpass/yes')}}"></a>
			</div>
			@endif
		<div class="row left" >
		<p><strong> Declaration by Employer : </strong>  </p>
		</div>
		<div style="margin-left:30px">
		<div class="row" style="padding-bottom:15px">
		<div >
		<strong> <label class ='label-padding'>
		@if('agency authorise workpass'== $is_agency_authorise_workpass)
		{!! Form::checkbox('is_agency_authorise_workpass', 'agency authorise workpass', null,['id' => 'is_agency_authorise_workpass','checked'] ) !!} 
		@else
		{!! Form::checkbox('is_agency_authorise_workpass', 'agency authorise workpass', null,['id' => 'is_agency_authorise_workpass'] ) !!} 
		@endif
		
			I hereby declare that I am authorising  
			{!! Form::text('user_name',$user_data[0]->company_name, ['class'=> 'form-control','readonly']) !!}
			(Name of employment agency )
			{!! Form::text('licence_no',$user_data[0]->license_no, ['class'=> 'form-control','readonly']) !!} 
			(Licence no. of employment agency ) to perform the above work pass transaction on my behalf.  
		 </label> </strong></div>
		 </div>
		<div class="row" >
		<div >
		<strong> <label class ='label-padding'>
		@if('emplyer authoise form submit'== $is_emplyer_authoise_form_submit)
		{!! Form::checkbox('is_emplyer_authoise_form_submit', 'emplyer authoise form submit', null,['id' => 'is_emplyer_authoise_form_submit','checked'] ) !!}
		@else
		{!! Form::checkbox('is_emplyer_authoise_form_submit', 'emplyer authoise form submit', null,['id' => 'is_emplyer_authoise_form_submit'] ) !!}
		@endif
		I hereby authorise {!! Form::text('employer_name',$employer_details[0]->employer_name, ['class'=> 'form-control','readonly']) !!} (Full name as in NRIC/Passport),{!! Form::text('employer_nric_no',$employer_details[0]->employer_nric_no, ['class'=> 'form-control','readonly']) !!}( NRIC/Passport No. ) to submit this authorisation form on my behalf.  A copy of the representative's  NRIC/Passport in enclosed with this authorisation form.
		 </label> </strong></div>
		 </div>
		 </div>
		<div class="row left" style="margin-top:20px">
		<p><strong> Declaration by EA : </strong> </p>
		</div>
		
		<div class="row" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			
			@if(in_array('Employer Authorisation',$declaration_by_ea))
				<input type="checkbox" value="Employer Authorisation" name="declaration_by_ea[]" checked="checked"> I have spoken to and verified with employer to confirm his/her authorisation.
			@else
				<input type="checkbox" value="Employer Authorisation" name="declaration_by_ea[]"> I have spoken to and verified with employer to confirm his/her authorisation.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Authorised person Submitting form',$declaration_by_ea))
				<input type="checkbox" value="Authorised person Submitting form" name="declaration_by_ea[]" checked="checked"> I have spoken to and verified with employer that the person submitting this form to the EA is authorised to do so on behalf of the employer.
			@else
				<input type="checkbox" value="Authorised person Submitting form" name="declaration_by_ea[]"> I have spoken to and verified with employer that the person submitting this form to the EA is authorised to do so on behalf of the employer.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('All necessary fields are filled',$declaration_by_ea))
				<input type="checkbox" value="All necessary fields are filled" name="declaration_by_ea[]" checked="checked" > I declare that I have ensured all necessary fields are filled in prior to making the abovementioned work pass.
			@else
				<input type="checkbox" value="All necessary fields are filled" name="declaration_by_ea[]" > I declare that I have ensured all necessary fields are filled in prior to making the abovementioned work pass.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Information provided is correct',$declaration_by_ea))
				<input type="checkbox" value="Information provided is correct" name="declaration_by_ea[]" checked="checked" > I declare that information provided on this form is true and correct.
			@else
				<input type="checkbox" value="Information provided is correct" name="declaration_by_ea[]" > I declare that information provided on this form is true and correct.
			@endif
			</label>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="small-10 small-offset-3 columns">
		<input class="button small" value="Update" type="submit">
		{!! Form::reset('Reset', array('class' => 'button small')) !!}
		<button  class="button small" onclick="window.location='{{ url('application') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
		</div>
	</div>
	</form></div>
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
		<div class="incometax"> 
		</div>
	</div>
	</div>
	</div>
	@stop
