@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
	$(function () {
	var dateToday = new Date();
    var yrRange = dateToday.getFullYear() + ":" + (dateToday.getFullYear() + 15);
	$('.datetimepicker').datepicker({ dateFormat: 'yy-mm-dd',
            minDate: 0,
            changeMonth: true,changeYear: true, yearRange: yrRange, autoclose: true,
    });
    $( "#tabs" ).tabs({active:19});
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
  function getauthorisation() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/authorisationworkpass') }}";
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
	   <li><a href="#tabs-10"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Security Bond </span></a></li>  
	    <li><a onclick="return getsafety()" href="#tabs-11"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Safety Agreement B/w FDW & Employer</span></a></li>
		<li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Sponsorship Form</span></a></li>  
		<li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a onclick="return getincometax()" href="#tabs-14"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li> 
		<li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance Form</span></a></li>  	
		<li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li>  
		<li><a onclick="return getfdwcontractform('Contract_Fdw_and_Agency')" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Standard Contract B/w FDW & Employment Agency</span></a></li>		
		<li><a onclick="return getworkpermit()" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration Form For FDW </span></a></li>  
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
<div id="tabs-20">
<div class="small-6 columns">
                  <a title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_employment_contract/yes')}}">   <p>Click here to download Standard Employment Contract  </p> </a>
                </div>
	<div class="small-5 columns" style="float:left">
  
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
