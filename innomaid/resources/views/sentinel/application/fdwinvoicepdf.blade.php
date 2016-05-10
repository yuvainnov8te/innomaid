<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Innomaid</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<?php  
$path = public_path();
$root_path = $_SERVER['DOCUMENT_ROOT'];
?>
<style type="text/css">
body {
    color: #333;
    font-size: 10px;
	font-family:"Arial",Helvetica Neue,Helvetica,sans-serif;
	clear:both;
	}
.h3, h3 {
    font-size: 20px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
    padding-top: 15px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: black;
    font-family: "helvetica";
    font-weight: bold;
    height: 0;
}
.fkm-heading {
    float: left;
}

.personal-info-2 label {
    width: 100%;
}
label {
    display: inline-block;
    margin-bottom: 5px;
 
}

.notbold {
    font-weight: 100;
}
.table-bordered1 {
    border:1px solid #000;
	text-align:center;
	font-size:10px;
	}
.table {
    margin-bottom: 10px;
	margin-top:20px;
    max-width: 100%;
    width: 100%;
	font-size:10px;
	border-collapse: collapse
}
table {
    background-color: transparent;
}
table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    border: 1px solid #000;
	line-height:1.25;
}

.per_skill > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.79;
	}
	.per_food > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.79;
	}
.table > thead > tr > th
{
	font-size:11px;
}
.table > thead > tr > th > p
{
	font-weight:500px;
}
.per_info tr td:first-child
{
	font-size:11px;
	font-weight: bold;
	width:2%;
}
.per_info tr td:nth-child(2)
{
	width:40%;
}
.per_info tr td:nth-child(3)
{
	
	width:15%
}
.skf 
{
	line-height:1.4;
}
/* bootstrap class added for icon right or cross */
ul li
{
	font-size:10px;
	list-style-type: none;
}
p{
	font-size:10px;
}
.maid_info tr td:first-child
{
	font-size:10px;
	widht:20%;
}
.ft2 {
    font: 35px/40px "Arial";
}
.p0 {
    margin-bottom: 0;
    margin-top: 0;
    text-align: left;
    white-space: nowrap;
}
.invoicenum{
	color: grey;
    font-size: 14px;
    font-weight: bold;
    text-align: right;
}
.baldueprice{
	 font-size: 18px;
    font-weight: bold;
    text-align: right;
}
.font_14{
	font-size: 14px;
}
.color_grey{
	color: grey;
}
.color_red{
	color: red;
}
.textrightwidth15{
	text-align: right;
	width: 19%;
}
.tr_line_height{
	line-height: 20px; 
}
.bold{
	font-weight: bold;
}


</style>
<body style="background:white;">
 <?php $maid_details[0] = json_decode($maid_employer->maid_json_data); ?>
  	<div class="container-fluid">
			<table width='100%' border='0'>
				<tr>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style="text-align:right; width:15%">
					<span class="p0 ft2">INVOICE</span>
					</td>
				</tr>
				<tr>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style="text-align:right;"><span class="invoicenum"># {{$invoice->invoice_number}}</span></td>
				</tr>
				<tr>
					<td colspan="6" height="5"></td>
				</tr>

				<tr>
					<td ><span class="font_14 color_grey">Bill to </span><br><span > {{$maid_details[0]->name}}</span></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
			</div>	
			<br>
         </div>
       <div class="row">
    <strong>Placement Fee</strong>
  </div>
      <table   class="table table-bordered1 skf" style='width:100%' border='1'>
          <thead>
            <tr>
              <th style="width:80%">Name of Service</th>
              <th style="width:20%">Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td> {!!'Service fee charged on the FDW by the Agency'!!}</td>
                <td>{{$servicefees->placement_fee_service_charge}}
                    {!! ($errors->has('placement_fee_service_charge') ? $errors->first('placement_fee_service_charge', '<small class="error">:message</small>') : '') !!}   
                </td>
              </tr>
              <tr>
                <td> {!!'Personal loan incurred by FDW overseas'!!}</td>
                <td>{{$servicefees->placement_fee_personal_loan}}
                    {!! ($errors->has('placement_fee_personal_loan') ? $errors->first('placement_fee_personal_loan', '<small class="error">:message</small>') : '') !!}   
                </td>
              </tr><?php $checked = ''; 
                      $service ='no';
                      $totalplacprice =0; ?>
          @if($agencyservice)
              <?php  
            $array= array();
                ?>    
                  @foreach($agencyservice as $agencyservice_id => $agencyservice_value)
                    @if($agencyservice_value->type == 'P')
                      <?php 
                            $checked = '';
                            $price = $agencyservice_value->price;
                        ?>
                        @foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value)
                          @if($agencyservice_value->id == $agencymaidservice_value->service_id&& $agencyservice_value->price != '0.00')
                            <?php
                                $service ='yes';
                                $checked = 'checked';
                                $price = $agencymaidservice_value->service_cost;
                                $totalplacprice =  $agencymaidservice_value->service_cost + $totalplacprice;
                
                            ?>
                            <tr>
                          <td>{{ ucfirst($agencyservice_value->title) }}</td>
                          <td>{{$price}}</td>
                        </tr>
                          @endif
                        @endforeach 
                         
                        <?php $checked = '';
                            $price = $agencyservice_value->price;
                        ?>
                    @endif
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
        
        <?php $subtotal=$totalplacprice + $servicefees->placement_fee_service_charge + $servicefees->placement_fee_personal_loan; 
              $final_payment = $subtotal-$loan_amount[0]->loan_amount;
          ?>

        <table style="width:100%" id='servicetable'>
            <tbody>
              <tr class="tr_line_height">
	              <td class="font_14" style="text-align:right">Sub Total :</td>
	              <td class="font_14 textrightwidth15" >S$ {{number_format($subtotal, 2)}}</td>
              </tr>
              <tr class="tr_line_height">
	              <td class="font_14" style="text-align:right">Toatal Loan Amount :</td>
	              <td class="font_14 textrightwidth15" >@if($loan_amount[0]->loan_amount !='')(-) S$ {{number_format($loan_amount[0]->loan_amount, 2)}}@else{{'-'}}@endif</td>
              </tr>
              <tr class="tr_line_height">
	              <td class="font_14 bold" style="text-align:right">Final Payment :</td>
	              <td class="font_14 textrightwidth15 bold" id="final_payment">S$ {{number_format($final_payment, 2)}}</td>
              </tr>
            </tbody>
        </table>
	</div>
</body>
</html>
