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
    font-size: 12px;
	font-family:"helvetica";
	line-height:1.5;
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
.fkm-heading h4, h5 {
    color: #f00;
    font-size: 20px;
    font-style: italic;
    font-weight: bold;
    text-align: center;
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
    border:.5px solid #000;
	font-size:11px;
	}
.table {
   
    max-width: 100%;
    width: 100%;
	font-size:11px;
	}
.table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    border: .5px solid #000;
	line-height:1;
	 text-align: center;
	
}

.table > thead > tr > th
{
	font-size:11px;
	 text-align: center;
}
.table > thead > tr > th > p
{
	font-weight:500px;
}

p{
	font-size:11px;
}
td{
height:20px;
}
.height >th
{
height :30px;
}

</style>
<body style="background:white;">
	<div class="container-fluid">
	@if($user_data[0]->image)
		<div style="width:100px; height:100px;">
				<img style = "height:100px; width:100px;"src='<?php echo $root_path."/uploads/agency_logo/".$user_data[0]->image;?>' />
		</div>
		@endif
		<h1 style="text-align:center;font-size:12px;font-weight:bold;"><span style="border-bottom:1px solid #000;">Schedules of Salary Payment And Load Repayment </span></h1>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
		?>
		<table class="table table-bordered1 per_info " style=" text-align:left;margin-bottom: 10px; margin-top:40px;">
		<tr><td style="text-align:left;"> Name Of Employer : <?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{$employer_details[0]->employer_name}} </td></tr>
		<tr><td style="text-align:left;"> Name Of FDW : {{$maid_details[0]->name}}</td></tr>
		<tr><td style="text-align:left;"> Monthly Salary Of  FDW : S$ {{$maid_details[0]->expected_salary}}</td></tr>
		<tr><td style="text-align:left;"> Total Amount Of Loan (including loan for placement fee) : S$ {{$salarypayment[0]->loan_amount}}</td></tr>
		</table>
		 @if($salarypayment&&$restday)
		 @if($salarypayment[0]->probation_period>=1)
		<?php $period= $salarypayment[0]->contract_period+$salarypayment[0]->probation_period; $halfless=0; $compensation=0;
					 
						$amount=$salarypayment[0]->loan_amount;
						
					$loan= $loanammont = $amount; 
					$probation=$salarypayment[0]->probation_period;
					?>
				@if($salarypayment[0]->payment_arrangement=='Pro-rated till month end')
			<table class="table table-bordered1 per_info">
					<tbody>
					<tr style="background-color:#eee;">
					<th rowspan='2' width="4%"></th>
					<th style="text-align: left;" colspan="3"><span style="padding-left:5px;">Schedule Of Payment</span></th><th></th>
					<th style="text-align: left;" colspan="4"> <span style="padding-left:5px;">Schedule of Loan(including loan for placement fee) Repayment</span></th>
					</tr>
					<tr> 
					<th  width="10%"> Month/Year</th>
					<th width="10%"> Salary Payment</th>
					<th width="10%"> Off Day Compensation</th>
					<th width="4%"></th>
					<th> Monthly Loan Repayment*</th>
					<th> Balance To Maid</th>
					<th width="10%"> Employer's Acknowledgement (Signature)</th>
					<th width="10%">  FDW's Acknowledgement (Signature)</th>
					</tr>
					<?php   
					$lastdate=explode('-', date("Y-m-t",strtotime($salarypayment[0]->date_of_commencement))); 
					$loandate=explode('-', date("Y-m-t",strtotime($salarypayment[0]->loan_repayment_start_date))); 
					$count=0; $date=explode('-',$salarypayment[0]->date_of_commencement); $loan_after=0;
					$day= $lastdate[2]-$date[2];  
						if($restday[0]->rest_days=='Rest according month') {
							//$compensation=$restday->no_of_restday*$restday->compensation;
							$TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
								$Counter = 0;
								for ($i = ($TotalDays-$day); $i <= $TotalDays; $i++) {
									if ($restday[0]->rest_of_month == date('l', mktime(0, 0, 0, $date[1], $i, $date[0]))){
									//add 1 to the counter
									$Counter++;
									}
									}
							if($salarypayment[0]->leave_on_offday=="No")
							{
							
									if($Counter>(4-$restday[0]->no_of_restday)) $Counter=4-$restday[0]->no_of_restday;
									$halfcompensation=$Counter*$restday[0]->compensation;$Counter=0;
							}
							else{
							if($Counter>(4-$restday[0]->no_of_restday)){$Counter=4-$restday[0]->no_of_restday;}
							$halfcompensation= 0;} }
							else {
								$TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
								$Counter = 0;
								for ($i = ($TotalDays-$day); $i <= $TotalDays; $i++) {
									if ($restday[0]->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0]))){
									//add 1 to the counter
									$Counter++;
									}
									} 
								  $halfcompensation= 0;//$Counter*$restday->compensation; 
					} 
					?>
					<tr><td>{{1}} </td><td ><?php $time=date("Y-m-t",strtotime(implode($date,'-'))); echo $time; if($date[1]<$loandate[1]||$date[0]<$loandate[0]) { $loan_after++;} ?></td>
						<td><?php  $halfsalary= round(($maid_details[0]->expected_salary)/26*($day+1)-$halfcompensation,2); echo '0';?></td>
						<td><?php 
								  echo '0';//$Counter*$restday->compensation; 
								 ?></td>
			<td></td>
					 @if($salarypayment[0]->deduction_arrangement=='Deduct Salary + Compensation')<?php  $halfless= $halfcompensation+$halfsalary; ?>
					@if($count>=$loan_after)
						@if($loan>=$halfless)<td>@if($halfless==0){{0}} @else{{ $halfless }}<?php  $loan=$loan-$halfless; ?>@endif</td>
						<td><?php echo $halfcompensation; ?></td>
						@else <td>{{$halfless}}</td><td> <?php print($halfcompensation); $loan=0; ?></td> 
						@endif
					@else <td>{{0}} </td>
						<td> {{0}}</td>
					@endif
					<td> </td>
					<td> </td>
					@endif
					
					@if($salarypayment[0]->deduction_arrangement=='Deduct Salary only')
					<?php $halfless=$halfsalary;  ?>
					@if($count>=$loan_after)
						 @if($loan>=$halfless)<td> @if($halfless==0) {{0}} @else {{ $halfless}} <?php  $loan=$loan-$halfless ?>@endif </td>
						<td>{{$halfcompensation}}</td>
						@else <td>{{$loan}}</td><td> <?php print($halfcompensation);  $loan=0; ?></td> 
						@endif
					@else <td>{{0}} </td>
						<td> {{$halfcompensation}}</td>
					@endif
					<td> </td>
					<td></td>
					@endif
					 @if($salarypayment[0]->deduction_arrangement=='Manual Allocation of Amount')<?php  $halfless= $halfcompensation+$halfsalary; ?>
					@if($count>=$loan_after)
						@if($loan>=$halfless)<td>@if($halfless==0){{0}} @else{{ $halfless }}<?php  $loan=$loan-$halfless; ?>@endif</td>
						<td><?php echo $halfcompensation; ?></td>
						@else <td>{{$halfless}}</td><td> <?php print($halfcompensation); $loan=0; ?></td> 
						@endif
					@else <td>{{0}} </td>
						<td> {{0}}</td>
					@endif
					<td>  </td>
					<td></td>
					@endif
					<?php $count++; //exit;?>
					</tr>
					<?php  while($count!= $period){ ?>
					<tr><td>{{$count+1}} </td>
					<td ><?php  if($date[1]=='12'){$date[1]=1; $date[0]=$date[0]+1;} else{$date[1]=$date[1]+1; $date[2]=1; /*echo $date[1]; exit;*/} /*print_r( $date); exit;*/ $time=date("Y-m-t",strtotime(implode($date,'-')));echo $time; if($date[1]<$loandate[1]||$date[0]<$loandate[0]) { $loan_after++;} ?>
					</td>
					<td>@if($probation>$count){{0}} @else{{ $maid_details[0]->expected_salary}} @endif</td>
					<td>
					@if($restday[0]->rest_days=='Rest according month')
					@if($probation>$count)<?php echo "0"; $compensation=(4)*$restday[0]->compensation ?> @else
					{{ $compensation=(4-$restday[0]->no_of_restday)*$restday[0]->compensation}}
					@endif
					@else 
					<?php $TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);

					$Counter = 0;
					for ($i = 1; $i <= $TotalDays; $i++) {
					if ($restday[0]->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0])))
					//add 1 to the counter
					$Counter++;
					}
					echo $compensation=0;  //$Counter*$restday->compensation; ?>
					@endif
					</td>
					<td></td>
					<?php if($salarypayment[0]->deduction_arrangement=='Deduct Salary + Compensation')
					{
					?><?php $less=$maid_details[0]->expected_salary+ $compensation; $halfless= $halfcompensation+$halfsalary?>
					  @if($probation>$count)
						@if($loanammont)
						@if($loan>= $less)
					<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?> @endif</td>
					<td>{{0}}</td>
					@else <td> <?php echo $loan;?></td>
						<td> {{0}} <?php $loan=0;?></td>
					@endif
					@else<td> {{0}}</td>
						<td>{{0}} </td>
					@endif
					@else
					<td> {{0}}</td>
					<td>{{$less}} </td>
						@endif
					
					<?php
					}
					?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Deduct Salary only')
					{
					?><?php $less=$maid_details[0]->expected_salary;?>
	
						@if($probation>$count)
						@if($loanammont)
						@if($loan>= $less)
						<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?>@endif</td>
						<td>{{$compensation}}</td>
						@else <td><?php echo $loan;?></td>
						<td><?php echo $compensation; $loan=0;?></td>
						@endif
						@else 
						<td>{{0}}</td>
						<td>{{$compensation}}</td>
						@endif
						@else
						<td> {{0}}</td>
						<td>{{$less+$compensation}} </td>
					@endif
					
					<?php
					}?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Manual Allocation of Amount')
					{
					?><?php $less=$maid_details[0]->expected_salary+ $compensation; $halfless= $halfcompensation+$halfsalary?>
					  @if($probation>$count)
						@if($loanammont)
						@if($loan>= $less)
					<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?> @endif</td>
					<td>{{0}}</td>
					@else <td> <?php echo $loan;?></td>
						<td> {{0}} <?php $loan=0;?></td>
					@endif
					@else<td> {{0}}</td>
						<td>{{0}} </td>
					@endif
					@else
					<td> {{0}}</td>
					<td>{{$less}} </td>
						@endif
					
					<?php
					}
					?>
					<td> </td>
					<td></td>
					</tr><?php $count++;} ?>
					<tr><td style="text-align:right;" colspan='4'> **Total Amount(S$) </td> <td> : </td><td>{{$loanammont-$loan}} </td><td> </td><td> </td><td> </td></tr> 
					</tbody>
					</table>
				@else
					<table class="table table-bordered1 per_info" style="cellpadding:30px">
					<tbody>
					<tr style="background-color:#eee;">
					<th rowspan='2' width="4%"></th>
					<th style="text-align: left;" colspan="3"><span style="padding-left:5px;">Schedule Of Payment</span></th>
					<th style="text-align: left;" colspan="4"> <span style="padding-left:5px;">Schedule of Loan(including loan for placement fee) Repayment</span></th>
					</tr>
					<tr> 
					<th  width="10%"> Month/Year</th>
					<th width="10%"> Salary Payment</th>
					<th width="10%"> Off Day Compensation</th>
					<th width="4%"></th>
					<th> Monthly Loan Repayment*</th>
					<th> Balance To Maid</th>
					<th width="10%"> Employer's Acknowledgement (Signature)</th>
					<th width="10%">  FDW's Acknowledgement (Signature)</th>
					</tr>
					<?php $count=0; $date=explode('-',$salarypayment[0]->date_of_commencement); $loandate=explode('-', date("Y-m-t",strtotime($salarypayment[0]->loan_repayment_start_date)));  $loan_after=0;?>
					<?php $initaldate=$date[2];
					while($count!= $period){ ?>
					<tr><td>{{$count+1}}</td>
					 <?php if($date[1]=='12'){$date[1]=1; $date[0]=$date[0]+1;} else{ $date[1]=$date[1]+1;$d=cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]); if($date[2]<$initaldate){$date[2]=$initaldate;}if($d<$initaldate){$date[2]=$d;} }$time=date(implode($date,'-')); $dates=$time;  
					$TotalDays = (date("t",strtotime($time))-$date[2])+$date[2];

					$Counter = 0;
					
					for ($i = 1; $i <= $TotalDays; $i++) {
					if ($restday[0]->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0])))
					//add 1 to the counter
					$Counter++;
					}
					?>
					<td ><?php  echo $time; if($date[1]<$loandate[1] ||$date[0]<$loandate[0]) {$loan_after++;} ?>
					</td>
					<td>@if($probation>$count){{0}} @else{{ $maid_details[0]->expected_salary}} @endif</td>
					<td>
					
					@if($restday[0]->rest_days=='Rest according month')
					@if($probation>$count)<?php echo "0"; $compensation=(4)*$restday[0]->compensation ?> @else
					{{ $compensation=(4-$restday[0]->no_of_restday)*$restday[0]->compensation}}
					@endif
					@else
					{{ $compensation=0}}
					
					@endif
					</td>
					<td></td>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Deduct Salary + Compensation')
					{
					?><?php $less=$maid_details[0]->expected_salary+ $compensation;?>
					@if($probation>$count)
					@if($loanammont)
					@if($loan>= $less)
						<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?> @endif</td>
						<td>{{0}}</td>
					@else <td> <?php echo $loan;?></td>
							<td> {{0}} <?php $loan=0;?></td>
					@endif
					@else<td> {{0}}</td>
						<td>{{0}} </td>
					@endif
					@else
					<td> {{0}}</td>
					<td>{{$less}} </td>
					@endif
					
					<?php
					}
					?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Deduct Salary only')
					{
					?><?php  $less=$maid_details[0]->expected_salary;?>
					@if($probation>$count)
					@if($loanammont)
					 @if($loan>= $less)
						<td>@if($less==0){{0}} @else<?php $loan=$loan-$less; echo $less; ?>@endif</td>
						<td>{{$compensation}}</td>
					@else <td><?php echo $loan;?></td>
							<td><?php echo $compensation; $loan=0;?></td>
					@endif
					@else 
					<td>{{0}}</td>
					<td>{{0}}</td>
					@endif
					@else
					<td> {{0}}</td>
						<td>{{$less+$compensation}} </td>
					@endif
					
					<?php
					}?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Manual Allocation of Amount')
					{
					?><?php $less=$maid_details[0]->expected_salary+ $compensation;?>
					@if($probation>$count)
					@if($loanammont)
					@if($loan>= $less)
						<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?> @endif</td>
						<td>{{0}}</td>
					@else <td> <?php echo $loan;?></td>
							<td> {{0}} <?php $loan=0;?></td>
					@endif
					@else<td> {{0}}</td>
						<td>{{0}} </td>
					@endif
					@else
					<td> {{0}}</td>
					<td>{{$less}} </td>
					@endif
					
					<?php
					}
					?>
					<td>  </td>
					<td> </td>
					</tr><?php $count++;} //echo $loan_after; exit?>
					<tr><td style="text-align:right;" colspan='4'> **Total Amount(S$) </td> <td> : </td><td>{{$loanammont-$loan}} </td><td> </td><td> </td><td> </td></tr> 
					</tbody>
					</table>
				@endif
				
			@else
				<?php $period= $salarypayment[0]->contract_period; $compensation=0;?>
				<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
					  $employer_details[] =json_decode($maid_employer->employer_json_data);
				?>
				
				<?php $period= $salarypayment[0]->contract_period; $halfless=0; $compensation=0;
					$loan= $loanammont = $salarypayment[0]->loan_amount;
					$less=0;?>
				
				@if($salarypayment[0]->payment_arrangement=='Pro-rated till month end')
					
					<table class="table table-bordered1 per_info" style=" margin-bottom: 10px; margin-top:20px;">
					<tbody>
					<tr style="background-color:#eee;">
					<th rowspan='2' width="4%"></th>
					<th style="text-align: left;" colspan="3"><span style="padding-left:5px;">Schedule Of Payment</span><th width="2%"></th>
					<th style="text-align: left;" colspan="4"> <span style="padding-left:5px;">Schedule of Loan(including loan for placement fee) Repayment</span></th>
					</tr>
					<tr> 
					<th  width="10%"> Month/Year</th>
					<th width="10%"> Salary Payment</th>
					<th width="10%"> Off Day Compensation</th>
					<th width="4%"></th>
					<th> Monthly Loan Repayment*</th>
					<th> Balance To Maid</th>
					<th width="10%"> Employer's Acknowledgement (Signature)</th>
					<th width="10%">  FDW's Acknowledgement (Signature)</th>
					</tr>
					<?php  
					$lastdate=explode('-', date("Y-m-t",strtotime($salarypayment[0]->date_of_commencement))); 
					$loandate=explode('-', date("Y-m-t",strtotime($salarypayment[0]->loan_repayment_start_date))); 
					$count=0; $date=explode('-',$salarypayment[0]->date_of_commencement); $loan_after=0;
					$day= $lastdate[2]-$date[2];  
					if($restday[0]->rest_days=='Rest according month') {
							//$compensation=$restday->no_of_restday*$restday->compensation;
							$TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
								$Counter = 0;
								for ($i = ($TotalDays-$day); $i <= $TotalDays; $i++) {
									if ($restday[0]->rest_of_month == date('l', mktime(0, 0, 0, $date[1], $i, $date[0]))){
									//add 1 to the counter
									$Counter++;
									}
									}
							if($salarypayment[0]->leave_on_offday=="No")
							{
							
									if($Counter>(4-$restday[0]->no_of_restday)) $Counter=4-$restday[0]->no_of_restday;
									$halfcompensation=$Counter*$restday[0]->compensation;$Counter=0;
							}
							else{
							if($Counter>(4-$restday[0]->no_of_restday)){$Counter=4-$restday[0]->no_of_restday;}
							$halfcompensation= 0;} }
							else {
								$TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
								$Counter = 0;
								for ($i = ($TotalDays-$day); $i <= $TotalDays; $i++) {
									if ($restday[0]->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0]))){
									//add 1 to the counter
									$Counter++;
									}
									} 
								  $halfcompensation= 0;//$Counter*$restday->compensation; 
					} 
					?>
					<tr><td>{{1}}
						<td ><?php  $time=date("Y-m-t",strtotime(implode($date,'-'))); echo $time; if($date[1]<$loandate[1]||$date[0]<$loandate[0]) { $loan_after++;} ?></td>
						<td><?php $halfsalary=round( ($maid_details[0]->expected_salary)/26*($day+1)-$halfcompensation,2); echo $halfsalary;?></td>
						<td><?php echo $halfcompensation;//$Counter*$restday[0]->compensation; ?></td>
					<td></td>
					 @if($salarypayment[0]->deduction_arrangement=='Deduct Salary + Compensation')<?php $halfless= $halfcompensation+$halfsalary; ?>
					@if($loan>=$halfless)<td>@if($halfless==0){{$loan}} @else{{ $halfless }}<?php  $loan=$loan-$halfless ?>@endif</td>
					<td>{{0}}</td>
					@else <td>{{$loan}}</td><td> <?php  print($halfless-$loan); $loan=0; ?></td> 
					@endif
					<td> </td>
					<td></td>
					@endif
					@if($salarypayment[0]->deduction_arrangement=='Deduct Salary only')
					<?php $halfless=$halfsalary; ?>
					 @if($loan>=$halfless)<td>@if($halfless==0){{$loan}} @else{{ $halfless}}<?php  $loan=$loan-$halfless ?>@endif </td>
					<td>{{$halfcompensation}}</td>
					@else <td>{{$loan}}</td><td> <?php print($halfless-$loan+$halfcompensation);  $loan=0; ?></td> 
					@endif
					<td> </td>
					<td> </td>
					@endif
					@if($salarypayment[0]->deduction_arrangement=='Manual Allocation of Amount' )
						<?php $halfless= $halfsalary+$halfcompensation; 		
					 if(($loanpayment->count()) && ($count !=( $loanpayment->count()+1))){	?>
					 <td>
						{{$loanpayment[$count]->loan_amount}} <?php $loan=$loan-$loanpayment[$count]->loan_amount;?></td>
					<td >{{$loanpayment[$count]->payment}}</td>
					 
					 <?php
					}
					else{ ?>
					@if($loan>= $halfless)<td>
					</td>
					<td></td>
					@else <td>{{0}}
					</td>
					<td>{{$halfless}}</td>
					@endif
					<?php } ?>
					<td> </td>
					<td></td>
					@endif
					<?php $count++; ?>
					</tr>
					
					
					<?php  while($count!= $period){ ?>
					
					<tr> <td> {{$count+1}}</td>
					<td><?php  if($date[1]=='12'){$date[1]=1; $date[0]=$date[0]+1;} else{$date[1]=$date[1]+1; $date[2]=1; /*echo $date[1]; exit;*/} /*print_r( $date); exit;*/ $time=date("Y-m-t",strtotime(implode($date,'-')));echo $time; if($date[1]<$loandate[1]||$date[0]<$loandate[0]) {$loan_after++;} ?>
					</td>
					<td>{{ $maid_details[0]->expected_salary}}</td>
					<td>
					@if($restday[0]->rest_days=='Rest according month')
					{{ $compensation=(4-$restday[0]->no_of_restday)*$restday[0]->compensation}}
					@else
					<?php $TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);

					$Counter = 0;
					for ($i = 1; $i <= $TotalDays; $i++) {
					if ($restday[0]->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0])))
					//add 1 to the counter
					$Counter++;
					}
					echo $compensation= 0;//$Counter*$restday[0]->compensation; ?>
					@endif
					</td>
					<td> </td>
					<?php if($salarypayment[0]->deduction_arrangement=='Deduct Salary + Compensation')
					{
					?><?php $less=$maid_details[0]->expected_salary+ $compensation; $halfless= $halfcompensation+$halfsalary?>
					  @if($count>=$loan_after)
						@if($loanammont)
						@if($loan>= $less)
					<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?> @endif</td>
					<td>{{0}}</td>
					@else <td> <?php echo $loan;?></td>
						<td> {{$less-$loan}} <?php $loan=0;?></td>
					@endif
					@else<td> {{0}}</td>
						<td>{{$less}} </td>
					@endif
					@else
					<td> {{0}}</td>
					<td>{{$less}} </td>
						@endif
					
					<?php
					}
					?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Deduct Salary only')
					{
					?><?php $less=$maid_details[0]->expected_salary;?>
	
						@if($count>=$loan_after)
						@if($loanammont)
						@if($loan>= $less)
						<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?>@endif</td>
						<td>{{$compensation}}</td>
						@else <td><?php echo $loan;?></td>
						<td><?php echo $less-$loan+$compensation; $loan=0;?></td>
						@endif
						@else 
						<td>{{0}}</td>
						<td>{{$less+$compensation-$loan}}</td>
						@endif
						@else
						<td> {{0}}</td>
						<td>{{$less+$compensation}} </td>
					@endif
					<?php
					}?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Manual Allocation of Amount'){ ?><?php $less=$maid_details[0]->expected_salary+$compensation;
					
					if(($loanpayment->count()) && ($count<$loanpayment->count())){  
					?>
					
					<td>
						{{$loanpayment[$count]->loan_amount}} <?php $loan=$loan-$loanpayment[$count]->loan_amount;?></td>
					<td >{{$loanpayment[$count]->payment}}</td>
					
					<?php
					}
					else{
					 ?> <?php $less=$maid_details[0]->expected_salary+$compensation; ?>
					
					@if($loanammont)
					<td></td>
					<td ></td>
					@else
					<td>{{0}}</td>
					<td>{{$less+$compensation-$loan}}</td>
					@endif
					<?php
					}}?>
					<td>  </td>
					<td></td>
					</tr><?php $count++; } ?>
					<tr><td style="text-align:right;" colspan='4'> **Total Amount(S$) </td> <td> : </td><td>{{$loanammont-$loan}} </td><td> </td><td> </td><td> </td></tr> 
					</tbody>
					</table>
				
				
				@else
					<table class="table table-bordered1 per_info"  style=" margin-bottom: 10px; margin-top:20px;">
					<tbody>
					<tr style="background-color:#eee;">
					 <th rowspan='2' width="4%"></th>
					<th style="text-align: left;" colspan="3"><span style="padding-left:5px;">Schedule Of Payment</span></th><th width="2%"></th>
					<th style="text-align: left;" colspan="4"> <span style="padding-left:5px;">Schedule of Loan(including loan for placement fee) Repayment</span></th>
					</tr>
					<tr> 
					 
					<th > Month/Year</th>
					<th > Salary Payment</th>
					<th> Off Day Compensation</th>
					<th width="4%"></th>
					<th> Monthly Loan Repayment*</th>
					<th> Balance To Maid</th>
					<th> Employer's Acknowledgement (Signature)</th>
					<th>  FDW's Acknowledgement (Signature)</th>
					</tr>
					<?php $count=0; $date=explode('-',$salarypayment[0]->date_of_commencement); $loandate=explode('-', date("Y-m-t",strtotime($salarypayment[0]->loan_repayment_start_date)));  $loan_after=0;?>
					<?php $initaldate=$date[2];
					while($count!= $period){ ?>
					<tr> <?php if($date[1]=='12'){$date[1]=1; $date[0]=$date[0]+1;} else{ $date[1]=$date[1]+1;$d=cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]); if($date[2]<$initaldate){$date[2]=$initaldate;}if($d<$initaldate){$date[2]=$d;} }$time=date(implode($date,'-')); $dates=$time;  
					$TotalDays = (date("t",strtotime($time))-$date[2])+$date[2];

					$Counter = 0;
					
					for ($i = 1; $i <= $TotalDays; $i++) {
					if ($restday[0]->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0])))
					//add 1 to the counter
					$Counter++;
					}
					?><td> {{$count+1}}
					<td ><?php  echo $time; if($date[1]<$loandate[1] ||$date[0]<$loandate[0]) {$loan_after++;} ?>
					</td>
					<td>{{ $maid_details[0]->expected_salary}}</td>
					<td>
					@if($restday[0]->rest_days=='Rest according month')
					{{ $compensation=(4-$restday[0]->no_of_restday)*$restday[0]->compensation}}
					@else
					<?php $compensation= 0;// $Counter*$restday[0]->compensation; ?>
					@endif
					</td>
					<td></td>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Deduct Salary + Compensation')
					{
					?><?php $less=$maid_details[0]->expected_salary+ $compensation;?>
					@if($loanammont)
					@if($loan>= $less)
						<td>@if($less==0){{$loan}} @else<?php $loan=$loan-$less; echo $less; ?> @endif</td>
						<td>{{0}}</td>
					@else <td> <?php echo $loan;?></td>
							<td> {{$less-$loan}} <?php $loan=0;?></td>
					@endif
					@else
					<td> {{0}}</td>
					<td>{{$less}} </td>
					@endif
					<?php
					}
					?>
					<?php
					if($salarypayment[0]->deduction_arrangement=='Deduct Salary only')
					{
					?><?php  $less=$maid_details[0]->expected_salary;?>
					@if($loanammont)
					 @if($loan>= $less)
						<td>@if($less==0){{0}} @else<?php $loan=$loan-$less; echo $less; ?>@endif</td>
						<td>{{$compensation}}</td>
					@else <td><?php echo $loan;?></td>
							<td><?php echo $less-$loan+$compensation; $loan=0;?></td>
					@endif
					@else
					<td> {{0}}</td>
						<td>{{$less+$compensation}} </td>
					@endif
					<?php
					}?>
					
					<?php
					if($salarypayment[0]->deduction_arrangement=='Manual Allocation of Amount')
					{  if(($loanpayment->count()) && ($period== $loanpayment->count())){ ?><?php  $less=$maid_details[0]->expected_salary+$compensation; ?>
					 
					
					
					<td>{{$loanpayment[$count]->loan_amount}} <?php $loan=$loan-$loanpayment[$count]->loan_amount;?></td>
					<td >{{$loanpayment[$count]->payment}}</td>
					<?php
					}
					else{
					 ?>@if($loanammont)
					<td></td>
					<td ></td>
					@else
					<td>{{0}}</td>
					<td>{{ $less+$compensation-$loan}}</td>
					@endif
					<?php
					}}?>
					<td>  </td>
					<td> </td>
					</tr><?php $count++;} //echo $loan_after; exit?>
					<tr><td style="text-align:right;" colspan='4'> **Total Amount(S$) </td> <td> : </td><td>{{$loanammont-$loan}} </td><td> </td><td> </td><td> </td></tr> 
					</tbody>
					</table>
				@endif
				@endif
				<table style="width:100%; line-height:1.25;" >
                        <tr> <td style="text-align:left;  padding-top: 15px"> <p>I hereby declare that I understand and agree with the Monthly salary and total amount of loan indicated above. </p>
						<tr>
                          <td style="text-align:left;  padding-top: 15px">
                          __________________________ <br />
                         Name/ Signature of FDW
                          </td>
                          <td style="text-align:left;  padding-top: 15px">
                          ______________________________ <br />
                         Name/ Signature of Employer
                          </td>
                        </tr>
						<tr>
						<td style="text-align:left;  padding-top: 15px"> Witnessed by EA representative : </td></tr>
						<tr><td style="text-align:left;  padding-top: 15px"> Name/ Signature ______________________________</td></tr>
						</table>
				@endif
	</div>
</body>
</html>
