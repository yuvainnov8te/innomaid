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
    
	text-align:center;
	font-size:11px;
	}
.table {
    margin-bottom: 10px;
	margin-top:20px;
    max-width: 100%;
    width: 100%;
	font-size:10px;
}
table {
    background-color: transparent;
}
table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    
	line-height:1.25;
}
.per_info > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.50;
	}
.table > thead > tr > th
{
	font-size:10px;
}
.table > thead > tr > th > p
{
	font-weight:500px;
}
.per_info tr td:first-child
{
	font-size:10px;
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
</style>
<body style="background:white;">
  <div class="container-fluid">
		@if($agency_detail[0]->image)
		<div style="width:100px; height:100px;">
				<img style = "height:100px; width:100px;"src='<?php echo $root_path."/uploads/agency_logo/".$agency_detail[0]->image;?>' />
		</div>
		@endif
		<h3 align="center" style="padding-top:0px !important; font-size:12px;margin-left:5px;"> {{strtoupper($agency_detail[0]->company_name)}} EMPLOYMENT AGENCY (License No: {{$agency_detail[0]->license_no}})<br />
		 Services and Fees Schedule
			  @if($maid_employer->form_type == 'New Transfer') 
				for New/transfer <br />
			  @else 
			  for Replacement FDW <br />
			  @endif 
		</h3><?php $employer_details[] = json_decode($maid_employer->employer_json_data);?>
		<h1 style="text-align:center;font-weight:500px;font-size:10px;margin-top:15px;">*delete where appropriate</h1>
		<br/>
		@if($maid_employer->form_type == 'New Transfer') 
			<h5><span style="font-weight:bold; border-bottom:1px solid #000; font-size:11px;">PART A: Particulars of FDW Selected</h5>
		@else 
		    <h5> <span style="font-weight:bold; border-bottom:1px solid #000; font-size:11px;">PART A: Particulars of Replacement FDW [Part A is to be completed only when a replacement FDW has been selected]</span></h5>
		@endif 
		<table class="table table-bordered maid_info" width="80%"> 
			<tbody>      
				<tr>
				  @if($maid_employer->form_type == 'New Transfer')
					<td>Name of FDW Selected:</td>
				  @else
					<td>Name of Replacement FDW Selected:</td>
				  @endif
				  @if($maid_details[0]->name)
					<td>{{ucfirst($maid_details[0]->name)}}</td>
				  @else
					 <td>-</td> 
				  @endif
					<td style="width:20%;padding-left:10px;">Date:</td>
					<td style="width:20%;">
					@if( $servicefees[0]->date =='0000-00-00')
					  {{ '-' }}
					@else
					 {{  date("d M Y", strtotime($servicefees[0]->date)) }}
					@endif</td>
			    </tr>
				<tr>
					<td>Nationality:</td>
					@if($maid_details[0]->nationality)
						<td>{{ucfirst($maid_details[0]->nationality)}}</td>
					@else
						<td>-</td>
					@endif
				</tr>
				<tr>
					<td>Passport No:</td>
					@if($maid_details[0]->passport_number)
					<td>{{ucfirst($maid_details[0]->passport_number)}}</td>
					@else
						<td>-</td>
					@endif
				</tr>
				<tr>
					<td>Salary:</td>
					@if($maid_details[0]->expected_salary)
					<td>S${{$maid_details[0]->expected_salary}}</td>
					@else
						<td>-</td>
					@endif
				</tr>
				@if($maid_employer->form_type != 'New Transfer')
				@if($replaced_maid_details)
				<?php 
					$replaced_maid[]= json_decode($replaced_maid_details[0]->maid_json_data);
				?>
				<tr>
					<td>Name of FDW Replaced:</td>
					@if( $replaced_maid[0]->name)
						<td>{{ucfirst( $replaced_maid[0]->name)}}</td>
					@else
						<td>-</td>
					@endif
				</tr>
				<tr>
					<td>Passport No of FDW Replaced:</td>
					@if( $replaced_maid[0]->passport_number)
					<td>{{ucfirst($replaced_maid[0]->passport_number)}}</td>
					@else
						<td>-</td>
					@endif
				</tr>
				@else
				<tr>
					<td>Name of FDW Replaced:</td><td>-</td>
				</tr>
				<tr>
					<td>Passport No of FDW Replaced:</td><td>-</td>
				</tr>
				@endif
				@endif
	
		</tbody>
</table> 
		 @if($maid_employer->form_type == 'New Transfer') 
		   <h5><span style="font-weight:bold; border-bottom:1px solid #000; font-size:11px;margin-top:15px;">PART B: Service Fee</span></h5>
		  @else 
		   <h5><span style="font-weight:bold; border-bottom:1px solid #000; font-size:11px;margin-top:15px;">PART B: Service Fee for Replacement FDW [Part B is to be completed at the point this service agreement is signed.]</span></h5>
		  @endif 
		  <h5  style="font-weight:bold;font-size:11px;margin-top:25px;"><span style=" border-bottom:1px solid #000;">PART B1: Administrative costs </span></h5>
<table class="table table-bordered per_info" style="margin-top:0px !important;">
	</tr>
			<tr><td>1</td> <td> Service Fee </td>
                           <td>S$ {{$servicefees[0]->service_fee}}</td>
			</tr>
			@if($servicefees)
			<?php $totalprice = 0; $totalprice =$servicefees[0]->service_fee; ?>
		@endif
	<?php $sno=2;
		  
		  $data = 'no';
		 ?>
		@foreach($agencymaidservice as $agency_maid_service_id => $agency_maid_service_value)           
		  @if($agency_maid_service_value->type == 'S')
		  <?php $data = 'yes'; ?>
			<tr>
			  <td>{{$sno}}
			  </td>
			  <td>{{ucfirst($agency_maid_service_value->title)}}
			  </td>
			  <td>S${{$agency_maid_service_value->service_cost}}
			  </td>
			</tr>
			<?php $sno++; $totalprice =  $agency_maid_service_value->service_cost + $totalprice;?>
		  @endif
		@endforeach
		@if($data == 'no')
			<tr>
				<td></td>
				<td>No service available.
				</td>
			</tr>
		@endif
	<?php
	
		$sno_1=$sno;
		$data = 'no';
		$totalprice3 = 0;
		?>
		@if($maid_employer->form_type == 'New Transfer')
			<tr>
			@if($servicefees[0]->month)
				<td>{{$sno_1}}</td>
			@endif
				<td><span>Cost for Replacement within the Maximum Replacement Period of<span style="border-bottom:1px solid #000;"> {{$servicefees[0]->month}} </span>*months/years</span> 
			@if(count($replacementcost) == 0) 
				<?php echo ''; ?> @endif
			<?php $sno_1++; ?>
			</td>
			</tr>
			@endif
		@if($maid_employer->form_type == 'New Transfer')
		@foreach($replacementcost as $replacement_cost_id => $replacement_cost_value)   
			<tr>
				<td></td>
				<td>					
					<span><span style="border-bottom:1px solid #000; margin-left:25px;">{{$replacement_cost_value->replacement_number}}</span>
							replacement within
						<span style="border-bottom:1px solid #000;">{{ucfirst($replacement_cost_value->replacement_month)}}</span>
							months
						<span style="border-bottom:1px solid #000;">S$ {{$replacement_cost_value->cost}}</span>
					 </span>
					<?php  $totalprice3 =  $replacement_cost_value->cost + $totalprice3;?>
				</td>
			</tr>
		@endforeach
		@endif
		<?php
		if($sno == $sno_1)
		{
			$sno_2=$sno;
		}
		else
		{
			$sno_2=$sno_1;
		}
		$totalprice1 = 0;
		$data = 'no';
		 ?>
	<tr>
		<td>{{$sno_2}}</td>
		<td>Other Services Provided (where applicable):</td>
	</tr>
	@if($agencyotherservice)
	@foreach ($agencyotherservice as $agencyotherservice_id => $agencyotherservice_value)
	<tr>
		<td></td>
		<td style="padding-left:25px;">{!! ucfirst($agencyotherservice_value->other_service_title) !!}</td>
		<td>S$ {!! $agencyotherservice_value->other_service_price !!}</td>
	</tr>
	  <?php $totalprice1 =  $agencyotherservice_value->other_service_price + $totalprice1; ?>
	@endforeach
	@endif

	<?php $total_package_fee = $totalprice1+$totalprice;?>
	<tr>
		<td></td>
		<td style="font-weight:bold; text-align:right; padding-right:10px;"><i>Total Package Service Fee:</i></td>
		<td  style="font-weight:bold;">S$ {{$total_package_fee}}</td>
	</tr>
</table>
	<h5 style="margin-top:15px;"><span style="font-size:11px;font-weight:500;">Payment of <i><span style="border-bottom:1px solid #000;">Service Fee</span></i> as agreed in this schedule shall be made as follows:</span></h5>
	<table class="table table-bordered" style="line-height:1.50;margin-top:0px;">
	  <tr>
		<td style="font-weight:bold;">1</td>
		<td><span>Deposit - On confirmation of  FDW through Bio data/ Others: </span>
		@if($servicefees[0]->deposite)
			<span style="border-bottom:1px solid #000;">S$ {{$servicefees[0]->deposite}}</span>
		@else 
			<span style="border-bottom:1px solid #000;padding-right:155px;">&nbsp;</span>
		@endif</td>
	  </tr>
	  <tr>
		<td style="font-weight:bold;">2</td>
		<td><span>Final Payment - When the FDW reports for work/ Others:</span>
		@if($servicefees[0]->final_payment)
			<span style="border-bottom:1px solid #000;">S$ {{$servicefees[0]->final_payment}}</span> 
		@else 
			<span style="border-bottom:1px solid #000;padding-right:155px;">&nbsp;</span> 
		@endif</td>
	  </tr>
	</table>
	<h5 style="margin-top:15px;">@if($maid_employer->form_type == 'New Transfer') 
		<span style="font-weight:bold; border-bottom:1px solid #000; font-size:11px;">PART C: Placement Fee</span>
	@else 
		<span style="font-weight:bold; border-bottom:1px solid #000; font-size:11px;">PART C: Placement Fee for Replacement FDW</span>
	@endif </h5>
	<table class="table table-bordered per_info" style="line-height:1.50;margin-top:0px !important;">
		<?php $sno=3;
		  $totalplacprice = 0; 
		  $data = 'no';
		  $totalplacprice1=0;
		  ?>
	
		<tr>
			 <td>
			 1
			</td>
			<td>Service fee charged on the FDW by the Agency</td>
			<td>S$ {{$servicefees[0]->placement_fee_service_charge}}</td>
		</tr>
		<tr>
			 <td>
			 2
			</td>
			<td>Personal loan incurred by FDW overseas</td>
			<td>S$ {{$servicefees[0]->placement_fee_personal_loan}}</td>
		</tr>
		@foreach($agencymaidservice as $agency_maid_service_id => $agency_maid_service_value)           
		  @if($agency_maid_service_value->type == 'P')
		  	  	<tr>
		  <?php $data = 'yes'; ?>
				  <td>{{$sno}}
				  </td>
			
				  <td>{{ucfirst($agency_maid_service_value->title)}}
				  </td>
				  <td>S$ {{$agency_maid_service_value->service_cost}}
				  </td>
			</tr>
			<?php $sno++; $totalplacprice =  $agency_maid_service_value->service_cost + $totalplacprice ?>
		  @endif
		@endforeach
		<?php $totalplacprice1 = $totalplacprice+$servicefees[0]->placement_fee_service_charge+$servicefees[0]->placement_fee_personal_loan;?>
		@if($data == 'no')
		  <tr>
				<td></td>
				<td>No service available.
				</td>
		  </tr>
		@endif
		<tr>
				<td></td>
				<td style="font-weight:bold; text-align:right; padding-right:10px;"><i>Total Placement Fee:</i> </td>
				<td style="font-weight:bold;">S$ {{$totalplacprice1}}</td>
		</tr>
		<!-- For Absolute Agency-->
	        @if($user_id=='88')
		<tr>
				<td></td>
				<td style="font-weight:bold; text-align:right; padding-right:10px;"><i>Total Fee:</i> </td>
				<td style="font-weight:bold;">S$ {{$totalplacprice1+$total_package_fee}}</td>
		</tr>
		@endif
	</table>
	<h5 style="margin-top:15px;"><span style="font-size:11px;font-weight:500;">Payment of <i><span style="border-bottom:1px solid #000;">Placement Fee</span></i> as agreed in this schedule shall be made as follows:(tick where applicable) </span></h5> 
	<table class="table table-bordered" style="margin-top:0px !important;">
		<tbody>
	
	@if($servicefees[0]->payment_placement_fee == 'Upfront Placement Fee')
	<tr>
	<td style="padding-top:5px;"><img  height="15px" width="15px"src="<?php echo $root_path."/public/img/cheked.jpg";?>">Upfront Placement Fee and post dated cheques</td></tr>
		 <tr> <td>
		 <span><span style="margin-left:35px;border-bottom:1px solid #000;">{{$servicefees[0]->upfront_month}} </span>months upfront Placement Fee<span style="border-bottom:1px solid #000;"> S$ {{$servicefees[0]->upfront_fee}}.</span>
		 </span>
		  </td></tr>
		  @foreach($placement_fee_schedule as $placement_fee_schedule_id => $placement_fee_schedule_value)  
			  <tr>
			  <td>
			  <span><span style="margin-left:35px;border-bottom:1px solid #000;">{{$placement_fee_schedule_value->post_dated_cheque_number}} </span>post-dated cheques of S$ <span style ="border-bottom:1px solid #000;">{{$placement_fee_schedule_value->post_dated_cheque_cost}}</span> each.</span>
			  </td>
			  </tr>
		   @endforeach
	
	@else
		<tr><td><img  height="15px" width="15px"src="<?php echo $root_path."/public/img/blank.jpg";?>">Upfront Placement Fee and post dated cheques</td></tr>
	@endif

	@if($servicefees[0]->payment_placement_fee == "Full sum payable")
		<tr><td><img  height="15px" width="15px"src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style ="padding-top:5px;">Full sum payable upon *handover / signing of contract / others: <span style="margin-left:5px;border-bottom:1px solid #000;">S$ {{$servicefees[0]->placement_full_sum}}</span></span></td></tr>
	@else
		<tr><td><img  height="15px" width="15px"src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style ="padding-top:5px;">Full sum payable upon *handover / signing of contract / others:</span><span style="border-bottom:1px solid #000;padding-right:155px;">&nbsp;</span></td></tr> 
	@endif
	@if($servicefees[0]->payment_placement_fee == "Others")
		<tr><td><span style ="padding-top:5px;"><img  height="15px" width="15px"src="<?php echo $root_path."/public/img/cheked.jpg";?>">Others:<span style ="margin-left:5px;border-bottom:1px solid #000;">{{ucfirst($servicefees[0]->placement_other)}}</span></span></td></tr>
	@else
		<tr><td><img  height="15px" width="15px"src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style ="padding-top:5px;">Others:</span><span style="border-bottom:1px solid #000;padding-right:155px;">&nbsp;</span></td></tr>
	@endif
	</tbody>
	</table>
	<div>
		@if($maid_employer->form_type != 'New Transfer')
			<p>I confirm that the replacement Foreign Domestic Worker named in Part A of this Schedule is selected by me and I agree to pay the various fees and schedule of payment stated in Parts B and C.</p>
		@endif
	<table class="table table-bordered">
		<tr>
			<td style="text-align:left;font-weight:bold;">
			_____________________ <span>@if($employer_details[0]->employer_name!= '')
					<?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}
					@else
					{{ '-' }}
					@endif</span><span> @if($employer_details[0]->employer_nric_no != '' || $employer_details[0]->employer_passport!= '')
					{{ucfirst($employer_details[0]->employer_nric_no)}}/{{ucfirst($employer_details[0]->employer_passport)}}
					@else
					{{ '-' }}
					@endif </span><br />
			Signature by Employer
			</td>
			<td style="text-align:right;font-weight:bold;">
			_____________________ <br />
			Signed for and on behalf of<br />
			{{strtoupper($agency_detail[0]->company_name)}} Emloyement Agency
			</td>
		</tr>
	</table>
	</div>
</div>
</body>
</html>
