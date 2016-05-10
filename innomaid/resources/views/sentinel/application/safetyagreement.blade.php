@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
	var $ = jQuery.noConflict();
$(function () {
	if($('#yes').is(':checked')) {
    $('#windowclean').show();
    } else {  
       $('#windowclean').hide();
	  $('#windowclean').find('input[type=checkbox]:checked').removeAttr('checked');
	  $('#windowclean').find('input[type=radio]:checked').removeAttr('checked');
    }
	if($('#other').is(':checked')) {
    $('#otherwindowclean').show();
    } else {  
       $('#otherwindowclean').hide();
	    $('#otherwindowclean').find('input[type=radio]:checked').removeAttr('checked');
    }
	if($('#otheryes').is(':checked')) {
    $('#otherwindowyes').show();
    } else {  
     $('#otherwindowyes').hide();
	   $('#otherwindowyes').find('input[type=radio]:checked').removeAttr('checked');
    }
	$('input[type="radio"]').change(function(){
    $('.' + this.className).prop('checked', this.checked);
});
	$( "#tabs" ).tabs({active:10});
if($("[name=native_language] option:selected").val()=="English")
 {
 $("#english").show();
 $("#indonesian").hide();
 $("#burmese").hide();
 $("#tagalog").hide();
 $("#tamil").hide();
 }
 if($("[name=native_language] option:selected").val()=="Burmese")
 {
 $("#english").hide();
 $("#indonesian").hide();
 $("#burmese").show();
 $("#tagalog").hide();
 $("#tamil").hide();
 }
 if($("[name=native_language] option:selected").val()=="Tagalog")
 {
 $("#english").hide();
 $("#indonesian").hide();
 $("#burmese").hide();
 $("#tagalog").show();
 $("#tamil").hide();
 }
 if($("[name=native_language] option:selected").val()=="Indonesian")
 {
 $("#english").hide();
 $("#indonesian").show();
 $("#burmese").hide();
 $("#tagalog").hide();
 $("#tamil").hide();
 }
if($("[name=native_language] option:selected").val()=="Tamil")
 {
 $("#english").hide();
 $("#indonesian").hide();
 $("#burmese").hide();
 $("#tagalog").hide();
 $("#tamil").show();
 }
 });
function showwindowclean()
{
if($('#yes').is(':checked')) {
    $('#windowclean').show();
    } else {  
      $('#windowclean').hide();
	  $('#windowclean').find('input[type=checkbox]:checked').removeAttr('checked');
	  $('#windowclean').find('input[type=radio]:checked').removeAttr('checked');
    }
	if($('#otheryes').is(':checked')) {
    $('#otherwindowyes').show();
    } else {  
      $('#otherwindowyes').hide();
	   $('#otherwindowyes').find('input[type=radio]:checked').removeAttr('checked');
    }
	if($('#other').is(':checked')) {
     $('#otherwindowclean').show();
    } else {  
       $('#otherwindowclean').hide();
	    $('#otherwindowclean').find('input[type=radio]:checked').removeAttr('checked');
	   
    }
	
} 
function showgrillesoption()
{
if($('#other').is(':checked')) {
     $('#otherwindowclean').show();
    } else {  
       $('#otherwindowclean').hide();
	    $('#otherwindowclean').find('input[type=radio]:checked').removeAttr('checked');
	   
    }
}

function getlangcondition(value)
{
 if(value=="English")
 {
 $("#english").show();
 $("#indonesian").hide();
 $("#burmese").hide();
 $("#tagalog").hide();
 $("#tamil").hide();
 }
 if(value=="Burmese")
 {
 $("#english").hide();
 $("#indonesian").hide();
 $("#burmese").show();
 $("#tagalog").hide();
 $("#tamil").hide();
 }
 if(value=="Tagalog")
 {
 $("#english").hide();
 $("#indonesian").hide();
 $("#burmese").hide();
 $("#tagalog").show();
 $("#tamil").hide();
 }
 if(value=="Indonesian")
 {
 $("#english").hide();
 $("#indonesian").show();
 $("#burmese").hide();
 $("#tagalog").hide();
 $("#tamil").hide();
 }
 if(value=="Tamil")
 {
 $("#english").hide();
 $("#indonesian").hide();
 $("#burmese").hide();
 $("#tagalog").hide();
 $("#tamil").show();
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
	<?php $employer_details[] = json_decode($maid_employer->employer_json_data);?>
	<?php $maid_details[] = json_decode($maid_employer->maid_json_data);$date=explode(' ' ,$maid_employer->created_at);  
	$bond_date=date('Y/m/d',strtotime($date[0])); ?>
	
	<?php
				if($safetyagreement){
				$clean_exterior_window = $safetyagreement->clean_exterior_window;
				$cleaning_grilles = $safetyagreement->cleaning_grilles;
				$adult_supervision = $safetyagreement->adult_supervision;
			$location_of_window=explode(';', $safetyagreement->location_of_window);
			$follow_employer_condition = $safetyagreement->follow_employer_condition;
			$follow_advisory_checklist =  $safetyagreement->follow_advisory_checklist;
			$employer_condition =$safetyagreement->employer_conditions;
			$fdw_conditions =$safetyagreement->fdw_conditions;
			$dwelling_type=explode(';', $safetyagreement->dwelling_type);
			}
			else{
				$follow_employer_condition="";
				$follow_advisory_checklist="";
				$employer_condition="";
				$fdw_conditions="";
				$clean_exterior_window="";
				$cleaning_grilles="";
				$adult_supervision="";
				$location_of_window=array();
				$dwelling_type=array();
				}
				
				?>
	<div id="tabs">
    <ul>
      <li><a onclick="return getemployermaid()" href="#tabs-1" style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Employer & Maid</span></a></li>
      <li><a onclick="return getservicefee()" href="#tabs-2"  style=" padding: 0.3em 0.6em;" ><span style="font-size:0.8em">Service & fees</span></a></li>
      <li><a onclick="return getrestday()" href="#tabs-8"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Rest Days</span></a></li>
	  <li><a onclick="return getloanpayment()" href="#tabs-3"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Loan & payment</span></a></li>  
      <li><a onclick="return getagreementform()" href="#tabs-4"  style=" padding:0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w employer & agency</span></a></li>
      <li><a onclick="return getfdwagreementform()" href="#tabs-5"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w FDW & Employer</span></a></li>
      <li><a onclick="return gethandling()"href="#tabs-6"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Handling & Take Over</span></a></li>
      <li><a onclick="return getjob()"href="#tabs-7"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Job Scope</span></a></li>
	  <li> <a onclick="return getauthorisation()" href="#tabs-9"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Authorisation Work Pass Transaction</span></a></li>  
	   <li><a onclick="return getsecuritybond()" href="#tabs-10"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Security Bond </span></a></li>  
	    <li><a href="#tabs-11"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Safety Agreement B/w FDW & Employer</span></a></li>
		<li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Sponsorship</span></a></li>  
		<li><a  href="#tabs-13" onclick="return getgiro()" style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a onclick="return getincometax()" href="#tabs-14"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
		<li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance </span></a></li>  
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
	{!! Form::model($safetyagreement,array('route' => array('sentinel.application.safetyagreementupdate', $maid_employer->id))) !!}
	@if($safetyagreement)
	<div class="small-1 columns" style="float:right">
    <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_safetyagreement/yes')}}"></a>
	</div>
	@endif
	<div class="small-8 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
				
		
		<div class="small-7 columns" style="margin-top:10px"  >
		<p><strong>Part A - Employer </strong>  </p>
		</div>
		<div class="small-3 columns" style="width: 17%;" style="margin-top:10px"  >
		<p><strong> Native language</strong>  </p>
		</div>
		<div class="small-2 columns">
				{!! Form::select('native_language', array(
				'English' => 'English', 'Burmese' => 'Burmese', 'Tamil' => 'Tamil', 'Indonesian' => 'Indonesian', 'Tagalog' => 'Tagalog'), Input::old('native_language')
				,array('class' => 'form-control','onchange'=>'getlangcondition(this.value)')) !!}
				{!! ($errors->has('native_language') ? $errors->first('native_language', '<small class="error">:message</small>') : '') !!}
				</div>
		<div class="row" style="padding:10px; float:left">
		<div class="col-md-4 columns">
		<label for="Location of Window Exterior">Residential Dwelling Type :</label>
		</div>
		<div class="col-xs-5">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			<?php
				?>
			@if(in_array('HDB Apartment',$dwelling_type))
				<input type="checkbox" value="HDB Apartment" name="dwelling_type[]" checked="checked"> HDB Apartment
			@else
				<input type="checkbox" value="HDB Apartment" name="dwelling_type[]"> HDB Apartment
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Private Apartment/Condominium',$dwelling_type))
				<input type="checkbox" value="Private Apartment/Condominium" name="dwelling_type[]" checked="checked"> Private Apartment/Condominium
			@else
				<input type="checkbox" value="Private Apartment/Condominium" name="dwelling_type[]"> Private Apartment/Condominium
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Landed Property', $dwelling_type))
				<input type="checkbox" value="Landed Property" name="dwelling_type[]" checked="checked"> Landed Property
			@else
				<input type="checkbox" value="Landed Property" name="dwelling_type[]"  > Landed Property
			@endif  
			</label>
			 </div>
		{!! ($errors->has('dwelling_type') ? $errors->first('dwelling_type', '<small class="error">:message</small>') : '') !!}
		</div>
		</div>
		<div  class="small-10 columns"><label>
		Do I require FDW need to clean windows exterior
		
		@if('Yes'==$clean_exterior_window)
		<input type="radio" name='clean_exterior_window' onclick="showwindowclean()" value='Yes' id = 'yes' checked="checked"> Yes
		@else
		<input type="radio" name='clean_exterior_window' onclick="showwindowclean()" value='Yes' id = 'yes'> Yes
		@endif
		@if('No'==$clean_exterior_window)
		<input type="radio" name='clean_exterior_window' onclick="showwindowclean()" value='No' id = 'no' checked="checked"> No
		@else
		<input type="radio" name='clean_exterior_window' onclick="showwindowclean()" value='No' id = 'no'> No
		@endif
		</label></div>
		<div id="windowclean">
		<div class="row" style="max-width: 100%; padding:10px;">
		<div class="col-md-4 columns">
		<label for="Location of Window Exterior">Location of Window Exterior :</label>
		</div>
		<div class="col-xs-5">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			<?php
				?>
			@if(in_array('On ground floor',$location_of_window))
				<input type="checkbox" value="On ground floor" name="location_of_window[]" checked="checked"> On ground floor
			@else
				<input type="checkbox" value="On ground floor" name="location_of_window[]"> On ground floor
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Facing common corridor',$location_of_window))
				<input type="checkbox" value="Facing common corridor" name="location_of_window[]" checked="checked"> Facing common corridor
			@else
				<input type="checkbox" value="Facing common corridor" name="location_of_window[]"> Facing common corridor
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if(in_array('Others', $location_of_window))
				<input type="checkbox" value="Others" name="location_of_window[]" onchange="showwindowclean()" id="other" checked="checked">  Others (if any)
			@else
				<input type="checkbox" value="Others" name="location_of_window[]" onchange="showwindowclean()" id="other"> Others (if any)
			@endif  
			</label>
			 </div>
		{!! ($errors->has('location_of_window') ? $errors->first('location_of_window', '<small class="error">:message</small>') : '') !!}
		</div>
		</div>
		<div id="otherwindowclean">
		<div class="row" style="max-width: 100%; padding:10px;">
		<div class="col-md-4 columns">
		<label for="Location of Window Exterior"> Grilles installed on windows required to be cleaned by FDW:</label>
		</div>
		<div class="col-xs-5" >
		@if('Yes'==$cleaning_grilles)
		<input type="radio" name='cleaning_grilles' onclick="showwindowclean()" value='Yes' id = 'otheryes'  checked="checked"> Yes
		@else
		<input type="radio" name='cleaning_grilles' onclick="showwindowclean()" value='Yes' id = 'otheryes'> Yes
		@endif
		@if('No'==$cleaning_grilles)
		<input type="radio" name='cleaning_grilles' onclick="showwindowclean()" value='No' id = 'otherno'  checked="checked"> No
		@else
		<input type="radio" name='cleaning_grilles' onclick="showwindowclean()" value='No' id = 'otherno' > No
		@endif
		</div>
		</div>
		<div id="otherwindowyes">
		<div class="row" style="max-width: 100%; padding:10px;">
		<div class="col-md-4 columns">
		<label for="Location of Window Exterior"> Adult supervision when cleaning window:</label>
		</div>
		<div class="col-xs-5" >
		@if('Yes'==$adult_supervision)
		<input type="radio" name='adult_supervision'  value='Yes' id = 'yesyes' checked="checked"> Yes
		@else
		<input type="radio" name='adult_supervision'  value='Yes' id = 'yesyes'> Yes
		@endif
		@if('No'==$adult_supervision)
		<input type="radio" name='adult_supervision' value='No' id = 'yesno' checked="checked"> No
		@else
		<input type="radio" name='adult_supervision' value='No' id = 'yesno'> No
		@endif
		</div>
		</div>
		</div>
		</div>
		</div>
		
		<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
		<br>
		<div class="row" style="margin-left:30px">
			<label class="checkbox-inline"> 
			@if('Yes'==$follow_advisory_checklist)
				<input type="checkbox" value="Yes" name="follow_advisory_checklist" checked="checked"> I have received the advisory letter and trainer assessment checklist from the Settling-In-Programme(for employer of firsttime FDWs).
			@else
				<input type="checkbox" value="Yes" name="follow_advisory_checklist"> I have received the advisory letter and trainer assessment checklist from the Settling-In-Programme(for employer of firsttime FDWs).
			@endif
			</label>
		</div>
		<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
		<br>
		<div class="row" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			
			@if('not require to clean exterior window'==$employer_condition)
				<input type="radio" value="not require to clean exterior window" name="employer_conditions" checked="checked"> I understand the Conditions and I will not require my FDW to clean the windows exterior of my home.
			@else
				<input type="radio" value="not require to clean exterior window" name="employer_conditions"> I understand the Conditions and I will not require my FDW to clean the windows exterior of my home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$employer_condition)
				<input type="radio" value="require to clean exterior window" name="employer_conditions" checked="checked">  I understand the Conditions and I will not require my FDW to clean only the window exterior on the ground floor of my home.
			@else
				<input type="radio" value="require to clean exterior window" name="employer_conditions"> I understand the Conditions and I will not require my FDW to clean only the window exterior on the ground floor of my home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$employer_condition)
				<input type="radio" value="require to clean exterior window with corridor" name="employer_conditions" checked="checked" > I understand the Conditions and I will not require my FDW to clean only the window exterior along the common corridor of my home.
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="employer_conditions" > I understand the Conditions and I will not require my FDW to clean only the window exterior along the common corridor of my home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$employer_condition)
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="employer_conditions" checked="checked" > I require my FDW to clean the window exterior of my home, and I shall ensure that the grilles are locked when cleaning the window exterior and cleaned only when supervised by myself or my adult representative. 
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="employer_conditions" > I require my FDW to clean the window exterior of my home, and I shall ensure that the grilles are locked when cleaning the window exterior and cleaned only when supervised by myself or my adult representative. 
			@endif
			</label>
			</div>
			
		</div>
	</div>
	<div class="row left" style="margin-top:10px"  >
		<p><strong> Part B - Employment Agency </strong>  </p>
		</div>
	<div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Name : <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                       {!! Form::text('user_name',$user_data[0]->company_name, ['class'=> 'form-control','readonly']) !!}
                    </div>      
      </div>
	  <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Registration No : <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5">
                      {!! Form::text('licence_no',$user_data[0]->registration_number, ['class'=> 'form-control','readonly']) !!} 
                    </div>      
                </div> 
	<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
		<br>
	<label>I have explained the Conditions to the Employer and advise the Employer the he *can/cannot require the FDW to clean the windows exterior of his home based on information presented in part A [* to delete accordingly]. </label>
	<div class="small-7 columns" style="margin-top:10px"  >
		<p><strong> Part C - Foreign Domestic Worker </strong>  </p>
		</div>
		
	<div class="row" style="margin-left:30px">
			<label class="checkbox-inline"> 
			@if('Yes'==$follow_employer_condition)
				<input type="checkbox" value="Yes" name="follow_employer_condition" checked="checked"> I shall abide by my Employer's instructions to clean the window exterior safely in compliance with condition.
			@else
				<input type="checkbox" value="Yes" name="follow_employer_condition"> I shall abide by my Employer's instructions to clean the window exterior safely in compliance with condition.
			@endif
			</label>
		</div>
		<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
		<br>
		<div class="row" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			
			@if('not require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions" checked="checked" class="op1"> I understand that I am not require to clean the windows exterior of my employer's home.
			@else
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions" class="op1">  I understand that I am not require to clean the windows exterior of my employer's home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window" name="fdw_conditions" checked="checked" class="op2">  I understand that I am require to clean only the window exterior on the ground floor of my employer's home.
			@else
				<input type="radio" value="require to clean exterior window" name="fdw_conditions" class="op2"> I understand that I am require to clean only the window exterior on the ground floor of my employer's home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions" checked="checked" class="op3" > I understand that I am require to clean  only the window exterior along the common corridor of my employer's home.
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions" class="op3"> I understand that I am require to clean  only the window exterior along the common corridor of my employer's home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$fdw_conditions) 
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions" class="op4" > I understand that I am require to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when grilles are locked and only when supervised by employer or his adult representative. 
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions" class="op4" > I understand that I am require to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when grilles are locked and only when supervised by employer or his adult representative. 
			@endif
			</label>
			</div>
			
		</div>
		</div>
		<div class="row" style="border-bottom:1px solid #c2c2c2"></div>
		<br>
		<div class="row" id="english" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			
			@if('not require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions1" checked="checked" class="op1"> I understand that I am not require to clean the windows exterior of my employer's home.
			@else
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions1" class="op1">  I understand that I am not require to clean the windows exterior of my employer's home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window" name="fdw_conditions1" checked="checked" class="op2">  I understand that I am require to clean only the window exterior on the ground floor of my employer's home.
			@else
				<input type="radio" value="require to clean exterior window" name="fdw_conditions1" class="op2"> I understand that I am require to clean only the window exterior on the ground floor of my employer's home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions1" checked="checked" class="op3" > I understand that I am require to clean  only the window exterior along the common corridor of my employer's home.
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions1" class="op3" > I understand that I am require to clean  only the window exterior along the common corridor of my employer's home.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions1" checked="checked" class="op4"> I understand that I am require to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when grilles are locked and only when supervised by employer or his adult representative. 
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions1"  class="op4"> I understand that I am require to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when grilles are locked and only when supervised by employer or his adult representative. 
			@endif
			</label>
			</div>
			
		</div>
		</div>
		<div class="row" id="indonesian" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			
			@if('not require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions2" checked="checked" class="op1"> Saya mengerti bahwa saya tidak perlu membersihkan jendela luar rumah majikan saya .
			@else
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions2" class="op1">  Saya mengerti bahwa saya tidak perlu membersihkan jendela luar rumah majikan saya .
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window" name="fdw_conditions2" checked="checked" class="op2">  Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior di lantai dasar rumah majikan saya .
			@else
				<input type="radio" value="require to clean exterior window" name="fdw_conditions2" class="op2"> Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior di lantai dasar rumah majikan saya .
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions2" checked="checked" class="op3" > Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior sepanjang koridor umum dari rumah majikan saya .
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions2" class="op3"> Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior sepanjang koridor umum dari rumah majikan saya .
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions2" checked="checked" class="op4"> Saya mengerti bahwa saya membutuhkan untuk membersihkan jendela luar rumah majikan saya , dan saya harus memastikan bahwa saya membersihkan jendela luar hanya bila kisi-kisi terkunci dan hanya jika diawasi oleh majikan atau perwakilan dewasanya .
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions2" class="op4" > Saya mengerti bahwa saya membutuhkan untuk membersihkan jendela luar rumah majikan saya , dan saya harus memastikan bahwa saya membersihkan jendela luar hanya bila kisi-kisi terkunci dan hanya jika diawasi oleh majikan atau perwakilan dewasanya .
			@endif
			</label>
			</div>
			</div>
		</div>
		
		<div class="row" id="tagalog" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id="">
			@if('not require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions3" checked="checked" class="op1"> Nauunawaan ko na hindo ako kinakailangang maglinis ng labas na parte ng bintana sa bahay ng amo ko.
			@else
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions3" class="op1"> Nauunawaan ko na hindo ako kinakailangang maglinis ng labas na parte ng bintana sa bahay ng amo ko.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window" name="fdw_conditions3" checked="checked" class="op2"> Nauunawaan ko na kinakailangang lamang akong maglinis sa labas na parte ng bintana sa unang palapag ng bahay ng amo ko.
			@else
				<input type="radio" value="require to clean exterior window" name="fdw_conditions3" class="op2"> Nauunawaan ko na kinakailangang lamang akong maglinis sa labas na parte ng bintana sa unang palapag ng bahay ng amo ko.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions3" checked="checked"class="op3" > Nauunawaan ko na kinakailangang lamang akong maglinis ng labas na parte ng bintana na nasa may pasilyo ng bahay ng amo ko.
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions3" class="op3"> Nauunawaan ko na kinakailangang lamang akong maglinis ng labas na parte ng bintana na nasa may pasilyo ng bahay ng amo ko.
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions3" checked="checked" class="op4"> Nauunawaan ko na kinakailangang akong maglinis ng labas na parte ng bintana sa bahay ng amo ko, at sisiguraduhin ko na lilinisan ko lamang ang labas na bahagi ng bintana kapag ang rehas ng bintana ay nakakandado at kapag pinangangasiwaan lamang ako ng aking amo o ng kanyang representateng tao na may tamang edad.
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions3" class="op4" > Nauunawaan ko na kinakailangang akong maglinis ng labas na parte ng bintana sa bahay ng amo ko, at sisiguraduhin ko na lilinisan ko lamang ang labas na bahagi ng bintana kapag ang rehas ng bintana ay nakakandado at kapag pinangangasiwaan lamang ako ng aking amo o ng kanyang representateng tao na may tamang edad.
			@endif
			</label>
			</div>
			</div>
		</div>
		<div class="row" id="burmese" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id=""> 
			
			@if('not require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions4" checked="checked" class="op1"> ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ဖို့ မလိုအပ် ပါ၏ နားလည်ပါသည်။
			@else
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions4" class="op1">  ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ဖို့ မလိုအပ် ပါ၏ နားလည်ပါသည်။
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window" name="fdw_conditions4" checked="checked" class="op2"> ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ မြေညီထပ် အပေါ် ကိုသာ ဒိုးကို အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။
			@else
				<input type="radio" value="require to clean exterior window" name="fdw_conditions4" class="op2">  ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ မြေညီထပ် အပေါ် ကိုသာ ဒိုးကို အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions4" checked="checked" class="op3" > ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ ဘုံ စင်္ကြံ တစ်လျှောက်မှာ သာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions4" class="op3" > ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ ဘုံ စင်္ကြံ တစ်လျှောက်မှာ သာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions4" checked="checked" class="op4"> ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် သူဖြစ်ကြောင်းကို နားလည် , ငါ ကင် သော့ခတ်ထား ကြသည် တဲ့အခါမှသာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ကြောင်း သေချာစေရန် နှင့် အလုပ်ရှင် သို့မဟုတ်သူ အရွယ်ရောက်ပြီးသူ ကိုယ်စားလှယ် များက ကြီးကြပ် တဲ့အခါမှသာ ရကြလိမ့်မည် ။
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions4" class="op4" > ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် သူဖြစ်ကြောင်းကို နားလည် , ငါ ကင် သော့ခတ်ထား ကြသည် တဲ့အခါမှသာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ကြောင်း သေချာစေရန် နှင့် အလုပ်ရှင် သို့မဟုတ်သူ အရွယ်ရောက်ပြီးသူ ကိုယ်စားလှယ် များက ကြီးကြပ် တဲ့အခါမှသာ ရကြလိမ့်မည် ။
			@endif
			</label>
			</div>
			</div>
		</div>
		<div class="row" id="tamil" >
		<div style="margin-left:30px">
			<div class="row">
			<label class="checkbox-inline" id="">
			@if('not require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions5" checked="checked" class="op1"> நான் என் முதலாளி வீட்டில் ஜன்னல்கள் வெளிப்புறம் சுத்தம் செய்ய தேவையில்லை என்று புரிந்துகொள்ளுங்கள் .
			@else
				<input type="radio" value="not require to clean exterior window" name="fdw_conditions5" class="op1">நான் என் முதலாளி வீட்டில் ஜன்னல்கள் வெளிப்புறம் சுத்தம் செய்ய தேவையில்லை என்று புரிந்துகொள்ளுங்கள் .
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window" name="fdw_conditions5" checked="checked" class="op2"> நான் என் முதலாளி வீட்டில் தரையில் மட்டுமே சாளரத்தில் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் .
			@else
				<input type="radio" value="require to clean exterior window" name="fdw_conditions5" class="op2"> நான் என் முதலாளி வீட்டில் தரையில் மட்டுமே சாளரத்தில் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் .
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions5" checked="checked"class="op3" > நான் என் முதலாளி வீட்டில் பொதுவான நடைபாதையில் சேர்த்து சாளர வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் 
			@else
				<input type="radio" value="require to clean exterior window with corridor" name="fdw_conditions5" class="op3">நான் என் முதலாளி வீட்டில் பொதுவான நடைபாதையில் சேர்த்து சாளர வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் 
			@endif
			</label>
			</div>
			<div class="row">
			<label class="checkbox-inline"> 
			@if('require to clean exterior window with corridor with supervision'==$fdw_conditions)
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions5" checked="checked" class="op4"> நான் என் முதலாளி வீட்டில் ஜன்னல் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் , மற்றும் நான் grilles பூட்டி முதலாளி அவரது நடுத்தர வயது பிரதிநிதி மூலம் கண்காணிக்கப்பட்டது போது மட்டும் போது நான் மட்டும் ஜன்னல் வெளிப்புறம் சுத்தம் என்று உறுதி செய்ய வேண்டும்.
			@else
				<input type="radio" value="require to clean exterior window with corridor with supervision" name="fdw_conditions5" class="op4" > நான் என் முதலாளி வீட்டில் ஜன்னல் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் , மற்றும் நான் grilles பூட்டி முதலாளி அவரது நடுத்தர வயது பிரதிநிதி மூலம் கண்காணிக்கப்பட்டது போது மட்டும் போது நான் மட்டும் ஜன்னல் வெளிப்புறம் சுத்தம் என்று உறுதி செய்ய வேண்டும்.
			@endif
			</label>
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
