@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
	$(function () {
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
              $('#addcontact'+k).html('<td>{!! Form::text("item_name[]",null, ["class"=> "form-control"]) !!}</td><td><textarea name="description[]"></textarea></td><td><input placeholder="$" name="amount[]" type="text" id=""></td>');

              $('#declarationitem').append('<tr id="addcontact'+(k+1)+'"></tr>');
              k++; 
          }
			
		});
		 $("#delete_row_contact").click(function(){
    if(k>1){
          $("#addcontact"+(k-1)).html('');
          k--;
       }
	   });
    $( "#tabs" ).tabs({active:17});
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
		<li><a onclick="return getfdwdeclaration()()" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Declaration Form For FDW </span></a></li>  
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
	<div id="tabs-9">
		<div class="bond"> 
		</div>
	</div>
<div id="tabs-18">
{!! Form::model(null,array('route' => array('sentinel.application.fdwdeclarationupdate', $maid_employer->id))) !!}
	<div class="small-8 columns">
                  
                </div>
	@if($fdwdeclarationitem)
	<div class="small-1 columns" style="float:right">
    <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/show_fdw_declaration/yes')}}"></a>
	</div>
	@endif
	 <div id="replacementcostdiv">
    <div class="row">
      Add Declaration Item
    </div>
    <div class="row">
      <div class="small-10 large-left columns">
        <div class="table-responsive">
          <table class="table table-bordered" id="declarationitem" width="100%">
            <thead>
              </thead>
              <tbody>
			  <tr>
			  <th> Item Name </th>
			  <th>Description</th>
			  <th>Amount</th>
			  <th>Delete</th>
			  </tr>
                  <?php $radiocounter = 0; ?>     
                   @if($fdwdeclarationitem)
                     @foreach ($fdwdeclarationitem as $declarationitem_id => $declarationitem_value)
                      <tr>
                        <td>{!! $declarationitem_value->item_name !!}</td>
                        <td>{!! $declarationitem_value->description !!}</td>
                        <td>{!! $declarationitem_value->amount !!}</td>
                        <td><a href="{{  url('/application/'.$maid_employer->id.'/fdwdeclarationitemdelete/'.$declarationitem_value->id)}}" onclick="return confirmdelete();">
                        <img src="{{ asset('uploads/delete.png') }}" title="Delete Image"   height="20px" width="20px"/></a></td>
                      </tr>
                    <?php $radiocounter++; ?>
                    @endforeach
                  @else 
                  <tr id='addcontact0'>
                    <td>{!! Form::text('item_name[]',null, ['class'=> 'form-control']) !!}</td>
                      <td><textarea name="description[]"></textarea></td>
                      <td><input placeholder="$" name="amount[]" type="text" id=""></td>
                  </tr>
                  @endif
                  <tr id='addcontact1'></tr>
              </tbody>
          </table>
          <input type="hidden" id='count_replacement_cost_row' value='{{ count($fdwdeclarationitem) }}'>
          <a id="add_row_contact" class="btn btn-default pull-left">Add Item</a><a id='delete_row_contact' class="pull-right btn btn-default">Remove</a>
         </div>    
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
