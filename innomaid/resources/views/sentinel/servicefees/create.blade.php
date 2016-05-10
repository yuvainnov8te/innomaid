@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
$(function(){ // this will be called when the DOM is ready
	$('#maid_name').prop('disabled', true);
	$('#nationality').prop('disabled', true);
	$('#passport').prop('disabled', true);
	$('#salary').prop('disabled', true);
	$('#date').prop('disabled', true);
	$('#total_package_cost').prop('disabled', true);

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
	  $('input[type="radio"]').prop('checked', false);
	  $('#placementdetails').hide();   
	  $('#fullsumtext').hide(); 
	  $('#othertext').hide(); 
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
function formtype(type){
	if(type == 'Replacment'){
		$('.placementcheck').prop('checked',false);
		$('#replacementcostdiv').hide();
		$('#placementcostdiv').hide();
	}
	else{
		$('#replacementcostdiv').show();
		$('#placementcostdiv').show();
	}
}

</script>
<h3 style='margin-left:10px;'>Service & Fees Schedule</h3>
<hr/>
<div class="panel-body" style="background-color:#f0f2f7;"> 
{!! Form::open(array('route' => 'servicefees.create' ,'enctype'=>'multipart/form-data')) !!}
    <!-- include is used for render partial view errors/form_error.blade.php and books/form.blade.php -->
  <div class="small-10 columns">
   <p><span class="mandatory">*</span> Fields are required</p>
  </div>
  <div class="row left">
    <strong>PART A: Particulars of FDW Selected</strong>
  </div>
  <br />
  <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Form Type:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('form_type')) ? 'error' : '' }}">
        {!! Form::select('form_type', array('' => 'Select Form Type', 
	    'New Transfer' => 'New Transfer', 'Replacment' => 'Replacment'), Input::old('form_type'),
	    array('class' => 'form-control','onchange'=>'formtype(this.value)','id'=>'form_type')) !!}
	    {!! ($errors->has('form_type') ? $errors->first('form_type', '<small class="error">:message</small>') : '') !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Reference Code:<span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('maid_reference_code', null, ['class'=> 'form-control','id'=>'refer_code']) !!}
        {!! ($errors->has('maid_reference_code') ? $errors->first('maid_reference_code', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('maid_id') ? $errors->first('maid_id', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
   <div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Name of FDW Selected:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_name')) ? 'error' : '' }}">
        {!! Form::text('name', null, ['class'=> 'form-control','id'=>'maid_name']) !!}
    </div>
    <div class="small-width18 columns">
        <label for="Name of FDW">Nationality:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('nationality', null, ['class'=> 'form-control','id'=>'nationality']) !!}
    </div>
  </div>
<input type='hidden' id='maid_id' name ='maid_id'>
<div class="row">
  <div class="small-width18 columns">
      <label for="Date of birth">Passport No:</label>
  </div>
  <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('passport', null, ['class'=> 'form-control','id'=>'passport']) !!}
    </div>
  <div class="small-width18 columns">
      <label for="Date of birth">Salary:</label>
  </div>
    <div class="col-xs-3 {{ ($errors->has('spouse_name')) ? 'error' : '' }}">
        {!! Form::text('salary', null, ['class'=> 'form-control','id'=>'salary']) !!}
    </div>
</div>
<div class="row">
    <div class="small-width18 columns">
        <label for="Name of FDW">Date:</label>
    </div>
    <div class="col-xs-3 {{ ($errors->has('employer_nric_no')) ? 'error' : '' }}">
        {!! Form::text('date', date('Y-m-d'), ['class'=> 'form-control','id'=>'date']) !!}
    </div>
  </div>

<div class="row">
    <strong>PART B: Service Fee</strong>
  </div>
  <br />
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
            @foreach($agencyservice as $agencyservice_id => $agencyservice_value)
            @if($agencyservice_value->type == 'S')
            <tr>
              <td>{!! Form::checkbox('service_id[]', $agencyservice_value->id,null,['id' => 'service', 'onChange' => '']) !!} {{ ucfirst($agencyservice_value->title) }}</td>
              <td><input placeholder="$" name="price[]" type="text" value="{{$agencyservice_value->price}}" id="price_<?php echo $agencyservice_value->id;?>" ></td>
            </tr>
            @endif
            @endforeach
        </tbody>
      </table>
      </div>  
      {!! ($errors->has('service_id') ? $errors->first('service_id', '<small class="error">:message</small>') : '') !!}  
    </div>
  </div>
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
	                <?php $radiocounter = 0;
	                $contactnamestring = 'a';?>        
	                <tr id='addcontact0'>
	                	<td>{!! Form::select('replacement_number[]', ['' => 'Select'] + array_combine(range(1, 5), range(1, 5))) !!}</td>
	                    <td class="text-center">replacement within</td>
	                    <td>{!! Form::select('replacement_month[]', ['' => 'Select'] + array_combine(range(1, 12), range(1, 12))) !!}</td>
	                    <td class="text-center">months</td>
	                    <td><input placeholder="$" name="cost[]" type="text" id=""></td>
	                </tr>
	                <tr id='addcontact1'></tr>
	            </tbody>
	        </table>
	        <a id="add_row_contact" class="btn btn-default pull-left">Add Contact</a><a id='delete_row_contact' class="pull-right btn btn-default">Remove</a>
	       </div>    
	    </div>
	  </div>
  </div>
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
              <th style="width:10%">Name of Service</th>
              <th style="width:5%">Price</th>
            </tr>
          </thead>
          <tbody>
            <tr id='addservice0'>
              <td><input type="text" name="other_service_title[]"></td>
              <td><input placeholder="$" name="other_service_price[]" type="text" value="" id="" ></td>
            </tr>
            <tr id='addservice1'></tr>
        </tbody>
      </table>
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
            @foreach($agencyservice as $agencyservice_id => $agencyservice_value)
            @if($agencyservice_value->type == 'P')
            <tr>
              <td>{!! Form::checkbox('service_id[]', $agencyservice_value->id,null,['id' => 'service', 'onChange' => '','class' =>'placementcheck']) !!} {{ ucfirst($agencyservice_value->title) }}</td>
              <td><input placeholder="$" name="price[]" type="text" value="{{$agencyservice_value->price}}" id="price_<?php echo $agencyservice_value->id;?>"></td>
            </tr>
            @endif
            @endforeach
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
	                	<td><input placeholder="$" name="upfront_fee" type="text" id=""></td>
	                </tr>      
	                <tr id='addplacementfee0'>
	                	<td>{!! Form::select("post_dated_cheque_number[]", ["" => "Select"] + array_combine(range(1, 5), range(1, 5))) !!}</td>
	                    <td class="text-center">post-dated cheques of S$</td>
	                    <td><input placeholder="$" name="post_dated_cheque_cost[]" type="text" id=""></td>
	                    <td class="text-center">each</td>
	                </tr>
	                <tr id='addplacementfee1'></tr>
	            </tbody>
	        </table>
	        <a id="add_row_placement" class="btn btn-default pull-left">Add Contact</a><a id='delete_row_placement' class="pull-right btn btn-default">Remove</a>
	       </div>    
	    </div>
	  </div>
	  <br />
  <div class="row">
  	<label class="radio-inline"> {!! Form::radio('payment_placement_fee', 'Full sum payable', null, ['id' => 'fullsumradio']) !!} Full sum payable upon *handover / signing of contract / others (please specify) : </label><input placeholder="" id="fullsumtext" name="placement_full_sum" type="text" class="placementradiotext">
  </div>	
  <div class="row">
  	<label class="radio-inline"> {!! Form::radio('payment_placement_fee', 'Others', null, ['id' => 'otherradio']) !!} Others (please specify)</label><input placeholder="" name="placement_other" type="text" id="othertext" class="placementradiotext">
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
      <input class="button small" value="Save" type="submit">
      {!! Form::reset('Reset', array('class' => 'button small')) !!}
      <button  class="button small" onclick="window.location='{{ url('servicefees') }}'" type="button" id="cancel" name="submit_next" value="next">Go To List</button>
  </div>
  </div>

 {!! Form::close() !!}
 </div>
 <script type="text/javascript">
//********** add replacement cost row**************//
    $(document).ready(function(){
     var k=1;
        $("#add_row_contact").click(function(){
        	if(10 < k+1){
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
     var feecounter=1;
        $("#add_row_service").click(function(){
        	if(5 < feecounter+1){
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
@stop