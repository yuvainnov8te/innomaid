@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
	var $ = jQuery.noConflict();
$(function () {
	$('.datetimepicker').datepicker({ minDate: '0',changeYear: true, yearRange : '2015:2050' , format: 'yyyy-mm-dd'  , autoclose: true
    }).datepicker("setDate", new Date());
	$( "#tabs" ).tabs({active:14});
	if($('#reject_other').is(':checked')) {
    $('#other_rejected_by').show();
    } else { 
		$('#other_rejected_by').val('');
      $('#other_rejected_by').hide();
    }
if($("[name=insurance_company_name] option:selected").val()=="Liberty Insurance Pte Ltd")
  {
  $(".company").hide();
   $(".liberty").show();
   $('.Reimbursement').show();
  }
  else if($("[name=insurance_company_name] option:selected").val()=="InsureAsia Agency Pte Ltd")
  { 
  $(".company").hide();
   $(".asia").show();
    $('.Reimbursement').show();
  }
 else if($("[name=insurance_company_name] option:selected").val()=="Tenet Sompo Insurance Pte Ltd")
  {
  $(".company").hide();
   $(".maid").show();
    $('.Reimbursement').hide();
  }
 else if($("[name=insurance_company_name] option:selected").val()=="AXA Insurance Singapore Pte Ltd")
  {
  $(".company").hide();
   $(".smart").show();
    $('.Reimbursement').hide();
  }
  else if($("[name=insurance_company_name] option:selected").val()=="Tokio Marine Insurance Singapore Ltd")
  {
  $(".company").hide();
   $(".tokio").show();
    $('.period').show();
    $('.Reimbursement').show();
  }
  else if($("[name=insurance_company_name] option:selected").val()=="Allied World Assurance Company Ltd")
  {
  $(".company").hide();
   $(".allied").show();
    $('.period').show();
    $('.Reimbursement').show();
  }
   else if($("[name=insurance_company_name] option:selected").val()=="Wah Hong Ensure Pte Ltd")
  {
  $(".company").hide();
   $(".etiqa").show();
    $('.Reimbursement').hide();
  }
   else if($("[name=insurance_company_name] option:selected").val()=="Vintage Insurance Agency")
  {
  $(".company").hide();
   $(".great").show();
    $('.Reimbursement').show();
  }
  else if($("[name=insurance_company_name] option:selected").val()=="Ecics Limited")
  {
  $(".company").hide();
   $(".ecics").show();
  }
  else
  {
   $(".company").hide();
    $('.Reimbursement').hide();
  }
  $('input[type="radio"]').change(function(){
    $('.' + this.className).prop('checked', this.checked);
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
  function getauthorisation() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/authorisationworkpass') }}";
  }
  function getsafety() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/safetyagreement') }}";
  }
  function getworkpermit() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/workpermit') }}";
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
  function showotherbox() {
 
	if($('#reject_other').is(':checked')) {
    $('#other_rejected_by').show();
    } else { 
		$('#other_rejected_by').val('');
      $('#other_rejected_by').hide();
    }
	}
 function selectinsurance(company)
 {
  insure=$("[name='insurance_company_name'] option:selected").text();
 $(".company").hide();
   $('.company').find('input[type=radio]:checked').removeAttr('checked');
    $('.company').find('input[type=text]').val('');
 if(company.value=="Liberty Insurance Pte Ltd")
  {
	$(".company").hide();
   $(".liberty").show();
    $('.Reimbursement').show();
  }
  else if(company.value=="InsureAsia Agency Pte Ltd")
  { 
  $(".company").hide();
   $(".asia").show();
    $('.Reimbursement').show();
  }
 else if(company.value=="Tenet Sompo Insurance Pte Ltd")
  {
  $(".company").hide();
   $(".maid").show();
    $('.Reimbursement').hide();
  }
 else if(company.value=="AXA Insurance Singapore Pte Ltd")
  {//alert(company.value);
  $(".company").hide();
   $(".smart").show();
    $('.Reimbursement').hide();
  }
  else if(company.value=="Tokio Marine Insurance Singapore Ltd")
  {
  $(".company").hide();
   $(".tokio").show();
    $('.period').show();
    $('.Reimbursement').show();
  }
  else if(company.value=="Allied World Assurance Company Ltd")
  {
  $(".company").hide();
   $(".allied").show(); 
   $('.period').show();
    $('.Reimbursement').show();
	
  }
   else if(company.value=="Wah Hong Ensure Pte Ltd")
  {
  $(".company").hide();
   $(".etiqa").show();
    $('.Reimbursement').hide();
  }
   else if(company.value=="Vintage Insurance Agency")
  {
  $(".company").hide();
   $(".great").show();
    $('.Reimbursement').show();
  }
   else if(company.value=="Ecics Limited")
  {
  $(".company").hide();
   $(".ecics").show();
  }
  else
  {
   $(".company").hide();
    $('.Reimbursement').hide();
  }
  }
  function monthcalculation()
  {
  
  }
  
</script>
	<?php  $employer_details[] = json_decode($maid_employer->employer_json_data); ?>
	<?php $maid_details[] = json_decode($maid_employer->maid_json_data);$number=$employer_details[0]->employer_mobile_phone; ?>
	 <?php if($insuranceform){$effective_date=$insuranceform->effective_date; 
	 $plan =$insuranceform->plan; 
	 $reimbursement=$insuranceform->reimbursement; 
	 $embassy_bond=$insuranceform->embassy_bond; 
	 $premium=$insuranceform->premium; 
	 $period_of_insurance=$insuranceform->period_of_insurance;
	 $plan_term=$insuranceform->plan_term;
	 $plan_renewal=$insuranceform->plan_renewal;
	 $insurance_company_name=$insuranceform->insurance_company_name; 
	 }else{
	 $plan =array();
	 $reimbursement=""; 
	 $embassy_bond=""; 
	 $premium=""; 
	 $period_of_insurance="";
	 $plan_term="";
	 $effective_date=""; 
	 $plan_renewal="";
	 $insurance_company_name="";} ?>
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
		<li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a href="#tabs-14" onclick="return getincometax()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
		<li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance Form</span></a></li> 
		<li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li>  
		<li><a onclick="return getworkpermit()" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">FDW Declaration</span></a></li>  
		<li><a onclick="return getfdwagreementform('Service_Employer_and_Fdw')" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w FDW & Employment Agency</span></a></li>
<li><a onclick="return getemployerchangedeclaration()" href="#tabs-19"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration For Change of Employer</span></a></li>  
	<li><a onclick="return getemploymentcontract()" href="#tabs-20"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Standard Employment Contract </span></a></li>  
  
<li><a onclick="return getpassportrenewal()" href="#tabs-21"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Passport Renewal Form </span></a></li>  
<li><a onclick="return getfdwvacation()" href="#tabs-22"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> FDW Vacation Forms </span></a></li>  
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
		<img style="margin-left:50%; margin-right:-50%; " src="{{ assetnew('img/input-spinner.gif') }}"/>
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
	
	<div id="tabs-14">
		<div class="incometax"> 
		</div>
	</div>
<div id="tabs-15" >
	{!! Form::model($insuranceform,array('route' => array('sentinel.application.insuranceupdate', $maid_employer->id))) !!}
	<div class="row">	
		<div class="small-8 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
        </div><div class="small-1 columns" style="float:right">
		@if($insuranceform)
				<a class="fa fa-download" title="Pdf"  href="{{url('/application/'.$maid_employer->id.'/show_Insurancedata/yes')}}"></a>
			@else
			
			
			@endif
</div>	
	</div>	
		<div class="row">
		<div class="col-md-4">
			{!! Form::label('Employer Name ', 'Employer Name :') !!}
		</div> 
		<div class="col-xs-4">
			{!! Form::text('employer_name', $employer_details[0]->employer_name, ['class'=> 'form-control disable','readonly' ]) !!}
			
		</div>
		</div>
		<div class="row">
		<div class="col-md-4">
			<label for="SB Transmission No">Employer SB Transmission No :</label>
		</div> 
		<div class="col-xs-4">
			{!! Form::text('SB_transmission_number',null, ['class'=> 'form-control']) !!}
			 {!! ($errors->has('SB_transmission_number') ? $errors->first('SB_transmission_number', '<small class="error">:message</small>') : '') !!}
		</div>
		</div>
		<div class="row">
                    <div class="col-md-4">
                    <label for="Name of FDW">Insurance Status: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-4"><select id="type" name="insurance_status" disabled > @if($maid_employer->status=='free')<option value="Canceled">Canceled</option> @else <option values="Active">Active</option> @endif</select>
                       
                      {!! ($errors->has('insurance_status') ? $errors->first('insurance_status', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
		<div class="row">
		<div class="col-md-4">
			{!! Form::label('Maid Name ', 'Maid Name :') !!}
		</div> 
		<div class="col-xs-4">
			{!! Form::text('maid_name', $maid_details[0]->name, ['class'=> 'form-control disable' ,'readonly']) !!}
		</div>
		</div>
		
		<div class="row">
		<div class="col-md-4 ">
			{!! Form::label('Start Date ', 'Start Date:') !!}
		</div> </td><td colspan="4">
		<div class="col-xs-4" >
			{!! Form::text('start_date',null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'start_date' ]) !!}
			 {!! ($errors->has('start_date') ? $errors->first('start_date', '<small class="error">:message</small>') : '') !!}
		</div></div></td>
		@if($maid_details[0]->nationality=='Philippine')		
		<div class="row"  style="max-width: 100%;">
		<div class="col-xs-4">
		
		  {!! Form::label('Philippine Embassy Bond', 'Philippine Embassy Bond:') !!}
		</div>
		<div class="col-xs-4">
		  @if($embassy_bond == '$2,000')
		  <label class="radio-inline"> {!! Form::radio('embassy_bond', '$2,000', true,['class'=>"bond2"]) !!} $2,000</label>
		  @else
		  <label class="radio-inline"> {!! Form::radio('embassy_bond', '$2,000',['class'=>"bond2"]) !!} $2,000</label>
		  @endif
		  @if($embassy_bond == '$7,000')
		  <label class="radio-inline">{!! Form::radio('embassy_bond', '$7,000', true,['class'=>"bond7"]) !!} $7,000 </label>
		  @else
		  <label class="radio-inline">{!! Form::radio('embassy_bond', '$7,000',['class'=>"bond7"]) !!} $7,000 </label>
		  @endif
		</div>
		</div>
		@endif
		<div class="row">
		<div class="col-md-4">
			<label for="Residential status"> Insurance Company Name: <span class="mandatory">*</span> </label>
		</div>
		
		<div class="col-xs-4 {{ ($errors->has('insurance_company_name')) ? 'error' : '' }}">
			{!! Form::select('insurance_company_name', [""=>"Select Company"] + $insurance_dropdown, $user_data[0]->insurance_company,
			array('class' => 'form-control disable','id'=>'insurance_company_name','onchange'=> 'return selectinsurance(this)')) !!}
		</div>
		
		</div><table style="margin-left:2% , margin-right:2%" width="100%">
	<div id="asia" class="company">
		<div class="row"> 
		</div>
		<div class="row"><tr class="company asia"><td>
		<div class="">
			{!! Form::label('End Date ', 'End Date:') !!}
		</div> </td><td>
		<div class="col-xs-6 ">
			{!! Form::text('end_date',null , ['class'=> 'form-control datetimepicker end_date','data-date-format'=>"yyyy/mm/dd",'id'=>'' ]) !!}
			 {!! ($errors->has('end_date') ? $errors->first('end_date', '<small class="error">:message</small>') : '') !!}
		</div></td></tr>
		</div>
		<div class="row"  style="max-width: 100%;"><tr class="company asia"><td>
			<div class="">
			
			  {!! Form::label('Choice of Medical Insurance Coverage', 'Choice of Medical Insurance Coverage:') !!}
			</div></td><td>
			<div class="">
			  @if($plan == 'PLAN A Insure Asia')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN A Insure Asia', true) !!} PLAN A</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN A Insure Asia') !!} PLAN A</label>
			  @endif
			  @if($plan == 'PLAN B Insure Asia')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN B Insure Asia', true) !!} PLAN B </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN B Insure Asia') !!} PLAN B </label>
			  @endif
			  @if($plan == 'PLAN C Insure Asia')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN C Insure Asia', true) !!} PLAN C</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN C Insure Asia') !!} PLAN C</label>
			  @endif
			  @if($plan == 'PLAN D Insure Asia')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D Insure Asia', true) !!} PLAN D </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D Insure Asia') !!} PLAN D </label>
			  @endif
			</div></td></tr>
		  </div>
		</div>
		
	</div>
	<div id="maid" class="company">
	<tr  class="company maid"><th width="32%"> Coverage Selection & Premium</th><th width="17%"> Basic</th> <th width="17%"> Standard </th><th width="17%"> Prestige </th><th width="17%"> Prestige Plus</th></tr>
	<tr class="company maid"><td> <label for="Guarantee"> (a) Insurance + Letter of Guarantee </label></td> 
			<div id="without"><td>
			@if($plan == 'S$246.10 MAIDEASE')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$246.10 MAIDEASE', true) !!} S$246.10</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$246.10 MAIDEASE') !!} S$246.10</label>
			  @endif
			  </td><td>
			  @if($plan == 'S$267.80 MAIDEASE')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$267.80 MAIDEASE', true) !!} S$267.80 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$267.80 MAIDEASE') !!} S$267.80 </label>
			  @endif</td><td>
			  @if($plan == 'S$301.00 MAIDEASE')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$301.00 MAIDEASE', true) !!} S$301.00</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$301.00 MAIDEASE') !!} S$301.00</label>
			  @endif</td><td>
			  @if($plan == 'S$320.00 MAIDEASE')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$320.00 MAIDEASE', true) !!} S$320.00 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$320.00 MAIDEASE') !!} S$320.00 </label>
			  @endif </td></div>
	 </tr>
	<tr class="company maid"><td> <label for="Guarantee"> (b) Insurance + Letter of Guarantee+ Waiver of Counter Indemnity</label></td> 
			<div id="with"><td> @if($plan == 'S$299.60 MAIDEASE')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$299.60 MAIDEASE', true) !!} S$299.60</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$299.60 MAIDEASE') !!} S$299.60</label>
			  @endif
			  </td><td>
			  @if($plan == 'S$321.30 MAIDEASE')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$321.30 MAIDEASE', true) !!} S$321.30 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$321.30 MAIDEASE') !!} S$321.30 </label>
			  @endif</td><td>
			  @if($plan == 'S$354.50 MAIDEASE')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$354.50 MAIDEASE', true) !!} S$354.50</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$354.50 MAIDEASE') !!} S$354.50</label>
			  @endif</td><td>
			  @if($plan == 'S$373.50 MAIDEASE')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$373.50 MAIDEASE', true) !!} S$373.50 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$373.50 MAIDEASE') !!} S$373.50 </label>
			  @endif </td>
	</tr>
			  <tr class="company maid"><th> Option Cover & Premium</th><th colspan='2'>S$2,000</th><th colspan='2'>S$7,000</th></tr>
			<tr class="company maid"><td> <label for="Guarantee"> Letter of Guarantee to the P.O.L.O.</label></td> 
			<td colspan="2"> @if($embassy_bond == '$2,000')
			  <label class="radio-inline"> {!! Form::radio('premium', 'S$35.31', true,['class'=>"bond2"]) !!} S$35.31</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('premium', 'S$35.31',null,['class'=>"bond2"]) !!} S$35.31</label>
			  @endif
			  </td><td colspan="2">
			  @if($embassy_bond == '$2,000')
			  <label class="radio-inline">{!! Form::radio('premium', 'S$74.90', true, ['class'=>"bond7"]) !!} S$74.90 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('premium', 'S$74.90',null,['class'=>"bond7"]) !!} S$74.90 </label>
			  @endif </td>
			  </tr>
		</div>
	</div>
	<div id="liberty" class="company">
	<tr class="company liberty"><td>
	<div class="row">
	<div class="">
		{!! Form::label('Effective Date ', 'Effective Date:') !!}
	</div> </td><td>
		<div class="" >
		@if('14 months'==$effective_date)
		<input type="radio" name='effective_date'  value='14 months' checked="checked"> 14 months
		@else
		<input type="radio" name='effective_date'  value='14 months' > 14 months
		@endif
		@if('26 months'==$effective_date)
		<input type="radio" name='effective_date' value='26 months' checked="checked"> 26 months
		@else
		<input type="radio" name='effective_date' value='26 months' > 26 months
		@endif</td></tr>
		</div></div>
	<tr class="company liberty"><td>
	<div class="row"  style="max-width: 100%;">
		<div class="">
		
		  {!! Form::label('Choice of Medical Insurance Coverage', 'Choice of Medical Insurance Coverage:') !!}
		</div></td> <td>
		<div class="">
		  @if($plan == 'PLAN 1')
		  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN 1', true) !!} PLAN 1</label>
		  @else
		  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN 1') !!} PLAN 1</label>
		  @endif
		  @if($plan == 'PLAN 2')
		  <label class="radio-inline">{!! Form::radio('plan', 'PLAN 2', true) !!} PLAN 2 </label>
		  @else
		  <label class="radio-inline">{!! Form::radio('plan', 'PLAN 2') !!} PLAN 2 </label>
		  @endif
		  @if($plan == 'PLAN 3')
		  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN 3', true) !!} PLAN 3</label>
		  @else
		  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN 3') !!} PLAN 3</label>
		  @endif
		</div></td></tr>
	  </div><tr class="company liberty"><td>
		<div class="row"  style="max-width: 100%;">
		<div class="">
		
		  {!! Form::label('Philippine Embassy Bond', 'Philippine Embassy Bond:') !!}
		</div></td><td>
		<div class="">
		  @if($embassy_bond == '$2,000')
		  <label class="radio-inline"> {!! Form::radio('bond_premiun', 'premium :S$42.80', true,['class'=>"bond2"]) !!} Bond amount: S$2,000 Premium: S$42.80* </label>
		  @else
		  <label class="radio-inline"> {!! Form::radio('bond_premiun', 'premium :S$42.80',null,['class'=>"bond2"]) !!} Bond amount: S$2,000 Premium: S$42.80*</label>
		  @endif 
		  @if($embassy_bond == '$7,000')
		  <label class="radio-inline">{!! Form::radio('bond_premiun', 'premium :S$74.90', true,['class'=>"bond7"]) !!} Bond amount: S$7,000 Premium: S$74.90* </label>
		  @else
		  <label class="radio-inline">{!! Form::radio('bond_premiun', 'premium :S$74.90',null,['class'=>"bond7"]) !!} Bond amount: S$7,000 Premium: S$74.90*  </label>
		  @endif
		</div></td></tr>
		</div>
	</div>
	<div id="allied" class="company">
	<tr class="company allied" > <td>
		<div class="row">
		<div class="col-md-4 ">
			{!! Form::label('End Date ', 'End Date:') !!}
		</div> </td><td>
		<div class="">
			{!! Form::text('end_date',null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'end_date' ]) !!}
			 {!! ($errors->has('end_date') ? $errors->first('end_date', '<small class="error">:message</small>') : '') !!}
		</div>
		</div></td></tr><tr class="company allied" > <td>
			
			<div class="row"  style="max-width: 100%;">
			<div class="">
			
			  {!! Form::label('Choice of Medical Insurance Coverage', 'Choice of Medical Insurance Coverage:') !!}
			</div></td><td>
			<div class="">
			  @if($plan == 'PLAN A Allied World')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN A Allied World', true) !!} PLAN A</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN A Allied World') !!} PLAN A</label>
			  @endif
			  @if($plan == 'PLAN B Allied World')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN B Allied World', true) !!} PLAN B </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN B Allied World') !!} PLAN B </label>
			  @endif
			  @if($plan == 'PLAN C Allied World')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN C Allied World', true) !!} PLAN C</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN C Allied World') !!} PLAN C</label>
			  @endif
			  @if($plan == 'PLAN D Allied World')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D Allied World', true) !!} PLAN D </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D Allied World') !!} PLAN D </label>
			  @endif
			</div>
		  </div></td></tr>
	</div>
	<div id="tokio" class="company">
	 <tr class="company tokio"> <td>
		<div class="row">
		<div class="col-md-4 ">
			{!! Form::label('End Date ', 'End Date:') !!}
		</div> </td><td>
		<div class="">
			{!! Form::text('end_date',null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'end_date' ]) !!}
			 {!! ($errors->has('end_date') ? $errors->first('end_date', '<small class="error">:message</small>') : '') !!}
		</div>
		</div></td></tr><tr class="company tokio"> <td>
			
			<div class="row"  style="max-width: 100%;">
			<div class="">
			
			  {!! Form::label('Choice of Medical Insurance Coverage', 'Choice of Medical Insurance Coverage:') !!}
			</div></td><td>
			<div class="">
			  @if($plan == 'PLAN A Tokio Marine')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN A Tokio Marine', true) !!} PLAN A</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN A Tokio Marine') !!} PLAN A</label>
			  @endif
			  @if($plan == 'PLAN B Tokio Marine')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN B Tokio Marine', true) !!} PLAN B </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN B Tokio Marine') !!} PLAN B </label>
			  @endif
			  @if($plan == 'PLAN C Tokio Marine')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN C Tokio Marine', true) !!} PLAN C</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN C Tokio Marine') !!} PLAN C</label>
			  @endif
			  @if($plan == 'PLAN D Tokio Marine')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D Tokio Marine', true) !!} PLAN D </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D Tokio Marine') !!} PLAN D </label>
			  @endif
			</div>
		  </div></td></tr>
	</div>
	<div id="smart" class="company">
	<tr  class="company smart"><td>
		<div class="row">
		<div class="">
			{!! Form::label('End Date ', 'End Date:') !!}
		</div></td> <td>
		<div class="col-xs-4 ">
			{!! Form::text('end_date',null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'end_date' ]) !!}
			 {!! ($errors->has('end_date') ? $errors->first('end_date', '<small class="error">:message</small>') : '') !!}
		</div>
		</div></td></tr> <tr class="company smart"><td >
			<div class="">
			
			  {!! Form::label('Plan','Plan:') !!}
			</div></td><td>
			<div class="row">
			  @if($plan == 'Letter of Guarantee Only')
			  <label class="radio-inline"> {!! Form::radio('plan', 'Letter of Guarantee Only', true) !!} Letter of Guarantee Only</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'Letter of Guarantee Only') !!} Letter of Guarantee Only</label>
			  @endif
			  @if($plan == 'Standard Package')
			  <label class="radio-inline">{!! Form::radio('plan', 'Standard Package', true) !!} Standard Package </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'Standard Package') !!} Standard Package </label>
			  @endif
			  @if($plan == 'Compre-Plus Package')
			  <label class="radio-inline"> {!! Form::radio('plan', 'Compre-Plus Package', true) !!} Compre-Plus Package</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'Compre-Plus Package') !!} Compre-Plus Package</label>
			  @endif
			  @if($plan == 'Ultimate Plus Package')
			  <label class="radio-inline">{!! Form::radio('plan', 'Ultimate Plus Package', true) !!} Ultimate Plus Package </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'Ultimate Plus Package') !!} Ultimate Plus Package</label>
			  @endif
			</div></td></tr><tr class="company smart"><td >
			<div class="">
			
			  {!! Form::label('Term of Plan','Term of Plan:') !!}
			</div></td><td>
			<div class="row">
			  @if($plan_term == 'With Guarantee')
			  <label class="radio-inline"> {!! Form::radio('plan_term', 'With Guarantee', true) !!} With Guarantee</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan_term', 'With Guarantee') !!} With Guarantee</label>
			  @endif
			  @if($plan == 'Without Guarantee')
			  <label class="radio-inline">{!! Form::radio('plan_term', 'Without Guarantee', true) !!} Without Guarantee </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan_term', 'Without Guarantee') !!} Without Guarantee </label>
			  @endif
			  @if($plan == 'With Security Bond Protector')
			  <label class="radio-inline"> {!! Form::radio('plan_term', 'With Security Bond Protector', true) !!} With Security Bond Protector</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan_term', 'With Security Bond Protector') !!} With Security Bond Protector</label>
			  @endif
			  @if($plan == 'With H&S Top-Up of $5,000/$10,000/$15,000/$20,0000')
			  <label class="radio-inline">{!! Form::radio('plan_term', 'With H&S Top-Up of $5,000/$10,000/$15,000/$20,0000', true) !!} With H&S Top-Up of $5,000/$10,000/$15,000/$20,0000 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan_term', 'With H&S Top-Up of $5,000/$10,000/$15,000/$20,0000') !!} With H&S Top-Up of $5,000/$10,000/$15,000/$20,0000</label>
			  @endif
			</div></td></tr>
	</div>
	<div id="etiqa" class="company">
	<div class="row">
	<tr class="company etiqa"><th width="32%"> Coverage Selection & Premium</th><th width="17%"> Basic</th> <th width="17%"> Standard </th><th width="17%"> Prestige </th><th width="17%"> Prestige Plus</th></tr>
	<tr class="company etiqa"><td> <label for="Guarantee"> (a) Insurance + Letter of Guarantee </label></td> 
			<td> @if($plan == 'S$246.10 eTiQa')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$246.10 eTiQa', true) !!} S$246.10</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$246.10 eTiQa') !!} S$246.10</label>
			  @endif
			  </td><td>
			  @if($plan == 'S$267.50 eTiQa')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$267.50 eTiQa', true) !!} S$267.50 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$267.50 eTiQa') !!} S$267.50 </label>
			  @endif</td><td>
			  @if($plan == 'S$299.60 eTiQa')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$299.60 eTiQa', true) !!} S$299.60</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$299.60 eTiQa') !!} S$299.60</label>
			  @endif</td><td>
			  @if($plan == 'S$376.50 eTiQa')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$376.50 eTiQa', true) !!} S$376.50 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$376.50 eTiQa') !!} S$376.50 </label>
			  @endif </td>
			  </tr>
			  <tr class="company etiqa"><td> <label for="Guarantee"> (b) Insurance + Letter of Guarantee+ Waiver of Counter Indemnity</label></td> 
			<td> @if($plan == '$299.60 eTiQa')
			  <label class="radio-inline"> {!! Form::radio('plan', '$299.60 eTiQa', true) !!} S$299.60</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', '$299.60 eTiQa') !!} S$299.60</label>
			  @endif
			  </td><td>
			  @if($plan == 'S$321.00 eTiQa')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$321.00 eTiQa', true) !!} S$321.00 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$321.00 eTiQa') !!} S$321.00 </label>
			  @endif</td><td>
			  @if($plan == 'S$353.10 eTiQa')
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$353.10 eTiQa', true) !!} S$353.10</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'S$353.10 eTiQa') !!} S$353.10</label>
			  @endif</td><td>
			  @if($plan == 'S$428.00 eTiQa')
			  <label class="radio-inline">{!! Form::radio('plan', 'S$428.00 eTiQa', true) !!} S$428.00 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'S$428.00 eTiQa') !!} S$428.00 </label>
			  @endif </td>
			  </tr>
			  <tr class="company etiqa"><th> Option Cover & Premium</th><th colspan='2'>S$2,000</th><th colspan='2'>S$7,000</th></tr>
			<tr class="company etiqa"><td> <label for="Guarantee"> Letter of Guarantee to the P.O.L.O.</label></td> 
			<td colspan="2"> @if($premium == 'S$48.15')
			  <label class="radio-inline"> {!! Form::radio('premium', 'S$48.15', true,['class'=>"bond2"]) !!} S$48.15</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('premium', 'S$48.15',['class'=>"bond2"]) !!} S$48.15</label>
			  @endif
			  </td><td colspan="2">
			  @if($premium == 'S$80.25')
			  <label class="radio-inline">{!! Form::radio('premium', 'S$80.25', true,['class'=>"bond7"]) !!} S$80.25 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('premium', 'S$80.25',['class'=>"bond7"]) !!} S$80.25 </label>
			  @endif </td>
			  </tr>
		</div>
	</div>
	<div id="great" class="company">
	<tr class="company great"><td>
		<div class="row">
		<div class=" ">
			{!! Form::label('End Date ', 'End Date:') !!}
		</div> </td><td>
		<div class="col-xs-6">
			{!! Form::text('end_date',null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'end_date' ]) !!}
			 {!! ($errors->has('end_date') ? $errors->first('end_date', '<small class="error">:message</small>') : '') !!}
		</div>
		</div></td></tr><tr class="company great"><td>
		<div class="row"  style="max-width: 100%;">
			<div class="">
			
			  {!! Form::label('Choice of Medical Insurance Coverage', 'Choice of Medical Insurance Coverage:') !!}
			</div></td><td>
			<div class="">
			  @if($plan == 'PLAN DB')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN DB', true) !!} PLAN DB</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN DB') !!} PLAN DB</label>
			  @endif
			  @if($plan == 'PLAN D1')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D1', true) !!} PLAN D1 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D1') !!} PLAN D1 </label>
			  @endif
			  @if($plan == 'PLAN D2')
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN D2', true) !!} PLAN D2</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', 'PLAN D2') !!} PLAN D2</label>
			  @endif
			  @if($plan == 'PLAN D3')
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D3', true) !!} PLAN D3 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', 'PLAN D3') !!} PLAN D3 </label>
			  @endif
			</div>
		  </div></td></tr>
		</div>
		<div id="ecics" class="company">
		<tr  class="company ecics"><td>
		<div class="row">
		<div class="">
			{!! Form::label('End Date ', 'End Date:') !!}
		</div></td> <td colspan="3">
		<div class="col-xs-4 ">
			{!! Form::text('end_date',null , ['class'=> 'form-control datetimepicker','data-date-format'=>"yyyy/mm/dd",'id'=>'end_date' ]) !!}
			 {!! ($errors->has('end_date') ? $errors->first('end_date', '<small class="error">:message</small>') : '') !!}
		</div>
		</div></td></tr>
	<div class="row">
	<tr class="company ecics"><th width="20%">COST OF PREMIUM</th><th width="16%"> Classic Plan </th><th width="16%"> Deluxe Plan </th> <th width="16%"> Exclusive Plan </th><th width="16%"> Waiver of Counter Indemnity </th><th width="16%"> 2 K Philippines Bond </th></tr>
	<tr class="company ecics"><td > <label for="Guarantee">COST OF PREMIUM - 26 Months Policy </label></td>
			<td> @if($plan == '$240.75 Ecics')
			  <label class="radio-inline"> {!! Form::radio('plan', '$240.75 Ecics', true) !!} $240.75</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', '$240.75 Ecics') !!} $240.75</label>
			  @endif
			  </td><td>
			  @if($plan == '$257.80 Ecics')
			  <label class="radio-inline">{!! Form::radio('plan', '$256.80 Ecics', true) !!} $256.80 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', '$256.80 Ecics') !!} $256.80 </label>
			  @endif</td><td>
			  @if($plan == '$294.25 Ecics')
			  <label class="radio-inline"> {!! Form::radio('plan', '$294.25 Ecics', true) !!} $294.25</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan', '$294.25 Ecics') !!} $294.25</label>
			  @endif</td><td>
			  @if($plan == '$53.50 Ecics')
			  <label class="radio-inline">{!! Form::radio('plan', '$53.50 Ecics', true) !!} $53.50 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', '$53.50 Ecics') !!} $53.50 </label>
			  @endif </td><td>
			   @if($plan == '$42.80 Ecics')
			  <label class="radio-inline">{!! Form::radio('plan', '$42.80 Ecics', true) !!} $42.80 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan', '$42.80 Ecics') !!} $42.80 </label>
			  @endif </td>
			  </tr>
			  <tr class="company ecics"><td> <label for="Guarantee">COST OF PREMIUM - 14 Months Policy ( For Renewal Only) </label></td> 
			<td> @if($plan_renewal == '$160.50 Ecics')
			  <label class="radio-inline"> {!! Form::radio('plan_renewal', '$160.50 Ecics', true) !!} $160.50</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan_renewal', '$160.50 Ecics') !!} $160.50</label>
			  @endif
			  </td><td>
			  @if($plan_renewal == '$165.85 Ecics')
			  <label class="radio-inline">{!! Form::radio('plan_renewal', '$165.85 Ecics', true) !!} $165.85 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan_renewal', '$165.85 Ecics') !!} $165.85 </label>
			  @endif</td><td>
			  @if($plan_renewal == '$192.60 Ecics')
			  <label class="radio-inline"> {!! Form::radio('plan_renewal', '$192.60 Ecics', true) !!} $192.60</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('plan_renewal', '$192.60 Ecics') !!} $192.60</label>
			  @endif</td><td>
			  @if($plan_renewal == '$32.10 Ecics')
			  <label class="radio-inline">{!! Form::radio('plan_renewal', '$32.10 Ecics', true) !!} $32.10 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan_renewal', '$32.10 Ecics') !!} $32.10 </label>
			  @endif </td><td>
			  @if($plan_renewal == '$42.80 Ecics')
			  <label class="radio-inline">{!! Form::radio('plan_renewal', '$42.80 Ecics', true) !!} $42.80 </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('plan_renewal', '$42.80 Ecics') !!} $42.80 </label>
			  @endif </td>
			  </tr>
			  </div>
		</div>
		<tr class="company period"> <td>
			<div class="row"  style="max-width: 100%;">
			<div class="">
			
			  {!! Form::label('Period of Insurance', 'Period of Insurance:') !!}
			</div></td><td>
			<div class="">
			  @if($period_of_insurance == '1-YEAR')
			  <label class="radio-inline"> {!! Form::radio('period_of_insurance', '1-YEAR', true) !!} 1-YEAR</label>
			  @else
			  <label class="radio-inline"> {!! Form::radio('period_of_insurance', '1-YEAR') !!} 1-YEAR</label>
			  @endif
			  @if($period_of_insurance == '2-YEAR')
			  <label class="radio-inline">{!! Form::radio('period_of_insurance', ' 2-YEAR', true) !!} 2-YEAR </label>
			  @else
			  <label class="radio-inline">{!! Form::radio('period_of_insurance', '2-YEAR') !!} 2-YEAR </label>
			  @endif
			</div>
		  </div></td></tr>
		<div id="Reimbursement">
		<tr class="company Reimbursement">
		  <div class="row"><td>
			<div class="">
			<label for="Reimbursement of Indemnity Paid to Insurer">Reimbursement of Indemnity Paid to Insurer</label>
			</div></td>
			<td>
			<div class="" >
			@if($reimbursement=='Yes')
			<input class="yesclass" type="radio" name='reimbursement'  value='Yes'  checked="checked" id="yescheck"> Yes
			@else
			<input class="yesclass" type="radio" name='reimbursement'  value='Yes' > Yes
			@endif
			@if($reimbursement=='No')
			<input class="noclass" type="radio" name='reimbursement' value='No'  checked="checked" id="nocheck"> No
			@else
			<input class="noclass" type="radio" name='reimbursement' value='No' > No
			@endif
			</div>
			</div></td></tr>
			
			</div></table>
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
