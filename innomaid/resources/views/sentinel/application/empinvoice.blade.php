@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
  var $ = jQuery.noConflict();
$(function () {
  $( "#tabs" ).tabs({active:1});
  if($('#reject_other').is(':checked')) {
    $('#other_rejected_by').show();
    } else { 
    $('#other_rejected_by').val('');
      $('#other_rejected_by').hide();
    }
     $('.datetimepicker').datepicker({changeYear: true, yearRange : '1950:2020' , format: 'yyyy-mm-dd'  , autoclose: true,
    });
    <?php if(isset($_GET['record'])){?>
      $('#record_payment').show();
      $('#invoice').hide();
    <?php }else{ ?> 
    $('#record_payment').hide();
    <?php } ?>

     /*$("#invoice_date").datepicker({
            dateFormat: "dd-M-yy",
            minDate: 0,
            onSelect: function (date) {
                var date2 = $('#invoice_date').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                $('#due_date').datepicker('setDate', date2);
                //sets minDate to invoice_date date + 1
                $('#due_date').datepicker('option', 'minDate', date2);
            }
        });
        $('#due_date').datepicker({
            dateFormat: "dd-M-yy",
            onClose: function () {
                var invoice_date = $('#invoice_date').datepicker('getDate');
                console.log(invoice_date);
                var due_date = $('#due_date').datepicker('getDate');
                if (due_date <= invoice_date) {
                    var minDate = $('#due_date').datepicker('option', 'minDate');
                    $('#due_date').datepicker('setDate', minDate);
                }
            }
        });*/

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
  function getincometax() { 
     window.location = "{{ url('/application/'.$maid_employer->id.'/incometaxdeclaration') }}";
  }
  function getinsurance(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/insurance') }}";
  
  }
   function getwp_renewal(){
     window.location = "{{ url('/application/'.$maid_employer->id.'/wp_renewal') }}";
  
  }
  function toggelinvoice()
  {   
    $('#invoice').toggle();
    $('#record_payment').toggle();
  }
  function checkprice(payment)
  {   
    var amount_received = $('#amount_received').val();
    if(payment < amount_received){
      alert("It looks like you've have entered excess amount.");
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
     <li><a onclick="return getsecuritybond()" href="#tabs-10"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Security Bond </span></a></li>  
      <li><a onclick="return getsafety()" href="#tabs-11"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Safety Agreement B/w FDW & Employer</span></a></li>
    <li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Sponsorship</span></a></li>  
    <li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
    <li><a href="#tabs-14" onclick="return getincometax()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
    <li><a onclick="return getinsurance()" href="#tabs-15"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Insurance </span></a></li>  
    <li><a onclick="return getwp_renewal()" href="#tabs-16"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Work Permit Renewal</span></a></li>  
    <li><a onclick="return getworkpermit()" href="#tabs-17"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">FDW Declaration</span></a></li>  
    <li><a onclick="return getfdwagreementform('Service_Employer_and_Fdw')" href="#tabs-18"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w FDW & Employment Agency</span></a></li>
    </ul>
<div class="panel-body" style="">
  <div id="tabs-1">
    <div class="authorisation agreementdiv"> 

    </div>
  </div>
  <div id="tabs-2">
    <div class="bond" id="invoice">
      {!! Form::model($invoice, array('route' => array('sentinel.application.empinvoiceupdate', $maid_employer->id))) !!}
          <?php $employer_details[0] = json_decode($maid_employer->employer_json_data); ?>
          <div class="small-6 columns">
            <p><span class="mandatory">*</span> Fields are required</p>
          </div>
          @if($invoice)
            <div class="small-1 columns" style="float:right">
              <a class="fa fa-download" title="Pdf" href="{{url('/application/'.$maid_employer->id.'/empinvoicepdf/yes')}}"></a>
            </div>
            <div class="small-2 columns">
              <a onclick="toggelinvoice()">Record payment</a>
            </div>
          @endif   
          <div class="small-3 columns" style="float:right">
               <a class="fa fa-long-arrow-left" title="Pdf" onclick="return getservicefee()">Back to service & fee</a>
            </div>            
          <div class="left small-10 columns" >
            <p><strong> Employer Invoice </strong>  </p>
          </div>
          <div class="row">
            <div class="col-md-4 columns">
              <label for="Employer Name">Employer Name: <span class="mandatory">*</span> </label>
            </div>
            <div class="col-xs-3" >
              {!! Form::text('employer_name', $employer_details[0]->employer_name, ['class'=> 'form-control','id'=>'employer_name','readonly']) !!}
              {!! ($errors->has('employer_name') ? $errors->first('employer_name', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>
          <?php 
              if(count($autogeninvoicenum) == 0){
                  $invoice_num = 'INV-'. 0001;
              }else{
                  if(isset($invoice->invoice_number)){
                    $invoice_num = $invoice->invoice_number;
                  }
                  else{ 
                    $number = explode('-', $autogeninvoicenum[0]->invoice_number);
                    $invoice_num =$number[1]+1;
                    $invoice_num ='INV-'. $invoice_num;
                  }
              }
          ?>
          <div class="row">
            <div class="col-md-4 columns">
              <label for="Invoice Number">Invoice Number: <span class="mandatory">*</span> </label>
            </div>
            <div class="col-xs-3" >
              {!! Form::text('invoice_number', $invoice_num, ['class'=> 'form-control','id'=>'invoice_number','readonly']) !!}
              {!! ($errors->has('invoice_number') ? $errors->first('invoice_number', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 columns">
              <label for="Reference Number">Reference Number: <span class="mandatory">*</span> </label> </div>
            <div class="col-xs-3" >
              {!! Form::text('maid_app_reference_number', $maid_employer->maid_app_reference_number, ['class'=> 'form-control','id'=>'maid_app_reference_number','readonly']) !!}
              {!! ($errors->has('maid_app_reference_number') ? $errors->first('maid_app_reference_number', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 columns">
              <label for="Reference Number">Invoice Date: <span class="mandatory">*</span> </label> </div>
            <div class="col-xs-3" >
              {!! Form::text('invoice_date', null, ['class'=> 'form-control datetimepicker','id'=>'invoice_date']) !!}
              {!! ($errors->has('invoice_date') ? $errors->first('invoice_date', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 columns">
              <label for="Reference Number">Due Date: <span class="mandatory">*</span> </label> </div>
            <div class="col-xs-3" >
              {!! Form::text('due_date', null, ['class'=> 'form-control datetimepicker','id'=>'due_date']) !!}
              {!! ($errors->has('due_date') ? $errors->first('due_date', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>
          <div class="row">
            <strong>Service & Placement Fee</strong>
          </div>
          <table class="table table-bordered" id='servicetable' style='width:80%'>
            <thead>
              <tr>
                <th style="width:10%">Name of Service</th>
                <th style="width:5%; text-align:center">Price</th>
              </tr>
            </thead>
              <tbody>
                <tr>
                  <td > 
                    {!!'Service fee charged on the FDW by the Agency'!!}
                  </td>
                  <td  style="text-align:center">
                    {{$servicefees->placement_fee_service_charge}}
                  </td>
                </tr>
                <tr>
                  <td> 
                    {!!'Personal loan incurred by FDW overseas'!!}
                  </td>
                  <td  style="text-align:center">
                    {{$servicefees->placement_fee_personal_loan}}
                  </td>
                </tr>
                <?php $checked = ''; 
                          $service ='no';
                          $totalserprice =0;
                    ?> 
                @if($agencyservice)   
                      @foreach($agencyservice as $agencyservice_id => $agencyservice_value)                 
                            <?php 
                                $checked = '';
                                $price = $agencyservice_value->price;
                            ?>
                            @foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value)
                              @if($agencyservice_value->id == $agencymaidservice_value->service_id)
                                <?php
                                  $service ='yes';
                                  $checked = 'checked';
                                  $price = $agencymaidservice_value->service_cost;
                                  $totalserprice =  $agencymaidservice_value->service_cost + $totalserprice;
                                ?>
                                <tr>
                                  <td>{{ ucfirst($agencyservice_value->title) }}</td>
                                  <td style="text-align:center">{{$price}}</td>
                                </tr> 
                              @endif
                            @endforeach 
                            <?php $checked = '';
                              $price = $agencyservice_value->price;
                            ?>
                      @endforeach
                      @if($service == 'no')
                        <tr>
                          <td colspan="2" class="text-center">No service available.</td>
                        </tr> 
                      @endif
                @else
                    <tr>
                      <td colspan="2" class="text-center">No service available.</td>
                    </tr>
                @endif
              </tbody>
        </table>
        <?php $subtotal= $totalserprice + $servicefees->placement_fee_service_charge + $servicefees->placement_fee_personal_loan; 
              if($recordpayment){
                $final_payment = $subtotal-$servicefees->deposite-$recordpayment[0]->amount_received;
              }
              else{
                $final_payment = $subtotal-$servicefees->deposite;
              }
        ?>

        <table  style="border:0px;width:80%" id='servicetable'>
            <tbody>
              <tr><td style="text-align:right">Sub Total :</td><td style="text-align:center">{{number_format($subtotal, 2)}}</td></tr>
              <tr><td style="text-align:right">Deposite On confirmation of FDW :</td><td style="text-align:center">@if($servicefees->deposite)(-) {{$servicefees->deposite}}@else {{'-'}} @endif</td></tr>
              @if(!empty($recordpayment))
              <tr><td style="text-align:right">Payment Made :</td><td style="text-align:center"><span style="color:red">(-) {{$recordpayment[0]->amount_received}}</span></td></tr>
              <tr><td style="text-align:right">Final Payment :</td><td style="text-align:center">{{number_format($final_payment, 2)}}</td></tr>
              @else
              <tr><td style="text-align:right">Final Payment :</td><td style="text-align:center">{{number_format($final_payment, 2)}}</td></tr>
              @endif
            </tbody>
        </table>
          <div class="row" style="margin-top:20px">
            <div class="small-10 small-offset-7 columns">
            <input class="button small" value="Update" type="submit">
            </div>
          </div>
      </form>
    </div>
    <div id="record_payment">
    <?php if(isset($invoice)){  
        $invoiceid=$invoice->id;
      }else{
        $invoiceid='';
      }?>
    <form method="POST" action="{{ route('sentinel.application.recordpaymentadd',['id'=>$invoiceid]) }}" accept-charset="UTF-8">
          <input type="hidden" value="{{$maid_employer->id}}" name="employer_maid_id">
          <div class="small-10 columns">
            <p><span class="mandatory">*</span> Fields are required</p>
          </div>     
          <div class="small-2 columns">
            <a class="" title="Pdf" onclick="toggelinvoice()">Employer invoice</a>
          </div>        
          <div class="left small-10 columns" >
            <p><strong> Payment for @if(isset($invoice)) {{$invoice->invoice_number}} @endif </strong>  </p>
          </div>
          <div class="row">
            <div class="col-md-4 columns">
              <label for="Employer Name">Amount Received (GBP): <span class="mandatory">*</span> </label>
            </div>
            <div class="col-xs-3" >
              {!! Form::text('amount_received', $final_payment, ['class'=> 'form-control','id'=>'amount_received']) !!}
              {!! ($errors->has('amount_received') ? $errors->first('amount_received', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 columns">
              <label for="Invoice Number">Payment Date: <span class="mandatory">*</span> </label>
            </div>
            <div class="col-xs-3" >
              {!! Form::text('payment_date', null, ['class'=> 'form-control datetimepicker','id'=>'payment_date']) !!}
              {!! ($errors->has('payment_date') ? $errors->first('payment_date', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 columns">
              <label for="Reference Number">Payment Mode:</label> </div>
            <div class="col-xs-3" >
              {!! Form::select('payment_mode', array('' => 'Select payment mode', 
    'Bank Remittance' => 'Bank Remittance', 'Bank Transfer' => 'Bank Transfer', 'Cash'=>'Cash', 'Check'=>'Check', 'Credit Card'=>'Credit Card', 'PayPal'=>'PayPal'), Input::old('payment_mode'),
    array('class' => 'form-control')) !!}
              {!! ($errors->has('payment_mode') ? $errors->first('payment_mode', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 columns">
              <label for="Reference Number">Reference#:</label> </div>
            <div class="col-xs-7" >
              {!! Form::text('reference', null, ['class'=> 'form-control','id'=>'reference']) !!}
              {!! ($errors->has('reference') ? $errors->first('reference', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 columns">
              <label for="Reference Number">Notes:</label> </div>
            <div class="col-xs-7" >
              <textarea rows="10" cols="10" name="note" style="width: 645px; height: 150px;"></textarea>
              {!! ($errors->has('note') ? $errors->first('note', '<small class="error">:message</small>') : '') !!}
            </div>
          </div>
          <div class="row" style="margin-top:20px">
            <div class="small-10 small-offset-4 columns">
            <input class="button small" value="Submit" type="submit" onclick="return checkprice({{$final_payment}})">
            </div>
          </div>
      </form>
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
</div>
</div>
</div>
@stop