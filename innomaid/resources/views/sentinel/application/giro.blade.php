@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
	var $ = jQuery.noConflict();
$(function () {
	$( "#tabs" ).tabs({active:12});
	if($('#reject_other').is(':checked')) {
    $('#other_rejected_by').show();
    } else { 
		$('#other_rejected_by').val('');
      $('#other_rejected_by').hide();
    }
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
function getdischarge(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/dischargedform') }}";
  
  }
  function showotherbox() {
 
	if($('#reject_other').is(':checked')) {
    $('#other_rejected_by').show();
    } else { 
		$('#other_rejected_by').val('');
      $('#other_rejected_by').hide();
    }
	}
</script>
	<?php $employer_details[] = json_decode($maid_employer->employer_json_data); ?>
	<?php $maid_details[] = json_decode($maid_employer->maid_json_data);$number=$employer_details[0]->employer_mobile_phone; ?>
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
		<li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Sponsorship</span></a></li>  
		<li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a href="#tabs-14" onclick="return getincometax()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
		<li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance </span></a></li>  
		<li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li>  
		<li><a onclick="return getworkpermit()" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">FDW Declaration</span></a></li>  
		<li><a onclick="return getfdwagreementform('Service_Employer_and_Fdw')" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w FDW & Employment Agency</span></a></li>
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
	<div id="tabs-15">
		<div class="insurance"> 
		</div>
	</div>
<div id="tabs-13" class=" agreementdiv">
	{!! Form::model($giroform,array('route' => array('sentinel.application.giroupdate', $maid_employer->id))) !!}
		
		<div class="small-8 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
		@if($giroform)
		<div class="small-1 columns" style="float:right">
			   <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_giro_form/yes')}}"></a>
			</div>	
				@endif
		<div class="left small-10 columns" >
		<p><strong> For Application's Completion </strong>  </p>
		</div>
		
		
		<div class="row">
		<div class="col-md-4 columns">
		<label for="Name of Bank and Branch">Name of Bank and Branch: <span class="mandatory">*</span> </label>
		</div>
		<div class="col-xs-3" >
		{!! Form::text('bank_name', null, ['class'=> 'form-control','id'=>'bank_name']) !!}
        {!! ($errors->has('bank_name') ? $errors->first('bank_name', '<small class="error">:message</small>') : '') !!}
		</div>
        </div>
		<div class="row">
		<div class="col-md-4 columns">
		<label for="Name (as in Bank Account)">Name (as in Bank Account): <span class="mandatory">*</span> </label>
		</div>
		<div class="col-xs-3" >
		{!! Form::text('name_in_bank_acc', null, ['class'=> 'form-control','id'=>'name_in_bank_acc']) !!}
        {!! ($errors->has('name_in_bank_acc') ? $errors->first('name_in_bank_acc', '<small class="error">:message</small>') : '') !!}
		</div>
        </div>
		<div class="row">
		<div class="col-md-4 columns">
		<label for="Bank Account Number">Bank Account Number: <span class="mandatory">*</span> </label> </div>
		<div class="col-xs-3" >
		{!! Form::text('account_no', null, ['class'=> 'form-control','id'=>'account_no']) !!}
        {!! ($errors->has('account_no') ? $errors->first('account_no', '<small class="error">:message</small>') : '') !!}
		</div>
        </div>
		<div class="row">
		<div class="col-md-4 columns">
		{!! Form::label('Contact Number/E-mail address', 'Contact Number/E-mail address:') !!}
		</div>
		<div class="col-xs-3" >
		{!! Form::text('contact_no_or_email',$number , ['class'=> 'form-control','id'=>'contact_no_or_email','readonly']) !!}
        {!! ($errors->has('contact_no_or_email') ? $errors->first('contact_no_or_email', '<small class="error">:message</small>') : '') !!}
		</div>
        </div>
	
	<div class="left small-10 columns" style="margin-top:10px"  >
		<p><strong> For Bank Completion </strong>  </p>
		</div>
		<div class="col-xs-7">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			<?php
				if($giroform){
			$rejected_by = explode(';', $giroform->rejected_by);
			}
			else{$rejected_by=array();
				} ?>
			@if(in_array('Signature/Thumbprint# deffers from banks records',$rejected_by))
				<input type="checkbox" value="Signature/Thumbprint# deffers from banks records" name="rejected_by[]" checked="checked"> Signature/Thumbprint# deffers from bank's records
			@else
				<input type="checkbox" value="Signature/Thumbprint# deffers from banks records" name="rejected_by[]"> Signature/Thumbprint# deffers from bank's records
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Signature/Thumbprint# incomplete/unclear#',$rejected_by))
				<input type="checkbox" value="Signature/Thumbprint# incomplete/unclear#" name="rejected_by[]" checked="checked"> Signature/Thumbprint# incomplete/unclear#
			@else
				<input type="checkbox" value="Signature/Thumbprint# incomplete/unclear#" name="rejected_by[]"> Signature/Thumbprint# incomplete/unclear#
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Account operated by Signature/Thumbprint#',$rejected_by))
				<input type="checkbox" value="Account operated by Signature/Thumbprint#" name="rejected_by[]" checked="checked"> Account operated by Signature/Thumbprint#
			@else
				<input type="checkbox" value="Account operated by Signature/Thumbprint#" name="rejected_by[]"> Account operated by Signature/Thumbprint#
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Wrong account number',$rejected_by))
				<input type="checkbox" value="Wrong account number" name="rejected_by[]" checked="checked" > Wrong account number
			@else
				<input type="checkbox" value="Wrong account number" name="rejected_by[]" > Wrong account number
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Amendment not countersigned by Bank Account Holder',$rejected_by))
				<input type="checkbox" value="Amendment not countersigned by Bank Account Holder" name="rejected_by[]" checked="checked" > Amendment not countersigned by Bank Account Holder
			@else
				<input type="checkbox" value="Amendment not countersigned by Bank Account Holder" name="rejected_by[]" > Amendment not countersigned by Bank Account Holder
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Others', $rejected_by))
				<input type="checkbox" value="Others" name="rejected_by[]" onchange="showotherbox()" id="reject_other" checked="checked">  Others (if any)
			@else
				<input type="checkbox" value="Others" name="rejected_by[]" onchange="showotherbox()" id="reject_other"> Others (if any)
			@endif  
			</label>
			{!! Form::text('other_rejected_by',null, ['class'=> 'form-control','id'=>'other_rejected_by']) !!}
			{!! ($errors->has('other_rejected_by') ? $errors->first('other_rejected_by', '<small class="error">:message</small>') : '') !!}
      </div>
		{!! ($errors->has('rejected_by') ? $errors->first('rejected_by', '<small class="error">:message</small>') : '') !!}
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
