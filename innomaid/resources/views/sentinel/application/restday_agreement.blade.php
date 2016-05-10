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
$root_path = $_SERVER['DOCUMENT_ROOT'].'/public';
$root_path1 = $_SERVER['DOCUMENT_ROOT'];
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
    border:1px solid #000;
	font-size:11px;
	}
.table {
    margin-bottom: 10px;
	margin-top:40px;
    max-width: 100%;
    width: 100%;
	font-size:11px;
	}
.table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    border: 1px solid #000;
	line-height:1.7;
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
	width:30%;	
}
.per_info tr td:nth-child(2)
{
	width:30%;	
}
.per_info tr td:nth-child(3)
{
	width:30%;	
}
.page-break {
    page-break-after: always;
}
</style>
<body style="background:white;">
	<div class="container-fluid">
		@if($user_data[0]->image)
		<div style="width:100px; height:100px;">
				<img style = "height:100px; width:100px;"src='<?php echo $root_path1."/uploads/agency_logo/".$user_data[0]->image;?>' />
		</div>
		@endif
		<h1 style="text-align:center;font-size:12px;font-weight:bold;"><span style="border-bottom:1px solid #000;">AGREEMENT BETWEEN FOREIGN DOMESTIC WORKER (FDW) AND EMPLOYER ON <br/>FDW WEEKLY REST DAY ARRANGEMENT</span></h1>
		<table class="table table-bordered1 per_info" >
			<tbody>
				<tr style="background-color:#eee;">
				<th style="text-align: left;"><span style="padding-left:5px;">Parties Involved</span></th>
				<th style="text-align: left;"><span style="padding-left:5px;">FDW</span></th>
				<th style="text-align: left;"><span style="padding-left:5px;">Employer</span></th>
				</tr>
				<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
					  $employer_details[] =json_decode($maid_employer->employer_json_data);
				?>
				<tr>
				<td style="padding-left:5px;">Name</td>
				@if($maid_details[0]->name)
					<td style="padding-left:5px;">{{ucfirst($maid_details[0]->name)}}</td>
				@else
					<td style="padding-left:5px;">-</td>
				@endif	
				@if($employer_details[0]->employer_name)	
					<td style="padding-left:5px;">{{ucfirst($employer_details[0]->employer_name)}}</td>
				@else
					<td style="padding-left:5px;">-</td>
				@endif
				</tr>
				<tr>
					<td style="padding-left:5px;">NRIC/Work Permit No.
					
					</td>
					<td style="padding-left:5px;"><?php if(isset($maid_details[0]->work_permit_no)) 
		echo $maid_details[0]->work_permit_no;
		else
		echo "";
					?></td>
					@if($employer_details[0]->employer_nric_no)
					<td style="padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</td>
					@else
					<td style="padding-left:5px;">-</td>
					@endif
				</tr>
			</tbody>
		</table>
		<p style="margin-top:10px;">This agreement is made between (a) <span style="border-bottom:1px solid #000;">the FDW</span> and (b)<span style="border-bottom:1px solid #000;"> the Employer</span> in accordance with the Ministry of Manpower's regulations on the provision of a weekly rest day for FDWs. Please refer to Annex A on excerpt from the Employment of Foreign Manpower (Work Passes) Regulations.</p>
		<h1><span  style="font-size:11px;font-weight:bold;border-bottom:1px solid #000;">Terms of Agreement:</span></h1>
		<p style="margin-top:30px;">We, the FDW and the Employer, agree that the employer shall grant the FDW:</p>
		
		@if($maid_rest_day[0]->rest_days == 'Rest according week')
			<span><img  height="15px" width="15px"src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:20px;">One rest day for every week. The rest day shall be granted on @if($maid_rest_day[0]->rest_of_week)<span style = "border-bottom:1px solid #000;">{{ucfirst($maid_rest_day[0]->rest_of_week)}}@endif</span>
			(day of the week);</span></span><br/>
		@else
			<span><img  height="15px" width="15px"src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:20px;">One rest day for every week. The rest day shall be granted on <span style = "border-bottom:1px solid #000;padding-right:50px;">&nbsp;</span>
			(day of the week);</span></span><br/>
		@endif
		<p style="margin-top:10px;margin-left:40px;"><span style="font-weight:bold;border-bottom:1px solid #000;">OR</span></p>
		@if($maid_rest_day[0]->rest_days == 'Rest according month')
			<span><img  height="15px" width="15px"src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:20px;">@if($maid_rest_day[0]->no_of_restday)
				{{ucfirst($maid_rest_day[0]->no_of_restday)}}@endif 
			rest days in a month on 
			@if($maid_rest_day[0]->rest_of_month)
				{{ucfirst($maid_rest_day[0]->rest_of_month)}}@endif (day of the week) with compensation in lieu at $ @if($maid_rest_day[0]->compensation)
			{{$maid_rest_day[0]->compensation}}@endif for each rest day forgone.</span></span>
		@else
			<span><img  height="15px" width="15px"src="<?php echo $root_path."/img/blank.jpg";?>"/><span style = "border-bottom:1px solid #000;padding-right:50px;margin-left:20px;">&nbsp;</span>rest days in a month on 
			<span style = "border-bottom:1px solid #000;padding-right:50px;">&nbsp;</span>(day of the week) with compensation in lieu at $<span style = "border-bottom:1px solid #000;padding-right:50px;">&nbsp;</span>
		for each rest day forgone.</span>
		@endif	
		<table class="table table-bordered">
		<tr>
			<td style="text-align:left;">
			__________________________________________ <br />
			FDW's Signature <br/>Date:&nbsp;<?php echo date("d-m-Y");?>
			</td>
			<td>
			</td>
			<td style="padding-left:170px;">
			__________________________________________ <br />
			Employer's Signature <br/>Date:&nbsp;<?php echo date("d-m-Y");?>
			</td>
		</tr>
		</table>
		<div class='page-break'></div>
		<h1 style="font-size: 12px;margin-top:0px !important;margin-bottom:30px; !important"> Fourth Schedule, Employment of Foreign Manpower (Work Passes) Regulations 2012 </h1>
		<p>12. Subject to paragraph 13,  the employer shall grant the foreign employee a rest day without pay for every 7-day period
		(including Sunday and public holidays). The rest day must be any day within the 7-day period and must be mutually agreed between the employer and the foreign employee.
		</p>
		<p>13. Notwithstanding paragraph 12, the employer does not have to grant a rest day to the foreign employee if there is a prior written agreement mutually
		agreed between the employer and the foreign employee-<br>
		<span style="margin-left:35px;">a) <span style="padding-left:10px;">  for the foreign employee to work in lieu of the rest day;and</span></span><br>
			<span style="margin-left:35px;">b) <span style="padding-left:10px;">  for the foreign employee to be compensated for working in lieu of the rest day with either-</span></span><br>
				
					<span style="margin-left:58px;">	(i)  <span style="padding-left:10px;">  a replacement rest day without pay. The replacement rest day must be a day within the same month as the rest day to be <span style="padding-left:82px">taken and must be mutually agreed between the employer and the foreign employee;or</span></span></span><br/>
					<span style="margin-left:58px;">	(ii) <span style="padding-left:10px;">  a monetary compensation which shall not be less than the rate of pay for one day's work of the foreign employee,</span></span><br/>
					and the foreign employee is compensated in accordance with prior written agreement.<br/>
		<p>14.  For the purposes of paragraphs 12 and 13- </p>
		 <span style="padding-left:17px;">a)<span style="padding-left:10px;">a Sunday of public holiday shall be regarded as a rest day only if the employer and foreign employee mutually agree that the<span style="padding-left:39px;">  Sunday of public holiday is a rest day;</span></span></span><br/>
			 <span style="padding-left:17px;">b)<span style="padding-left:10px;">if a 7-day period referred to in paragraph 12 falls between 2 Months, the employer and foreign employee shall mutually agree <span style="padding-left:39px;"> on a day within either of the 2 months to be the replacement rest day;</span></span></span><br/>
		 <span style="padding-left:17px;">c)<span style="padding-left:10px;">the prior written agreement referred to in paragraph 13 must be mutually agreed between the employer and the foreign employee <span style="padding-left:39px;"> prior to the foreign employee working in lieu of the rest day;</span></span></span><br/>
			 <span style="padding-left:17px;">d)<span style="padding-left:10px;">in calculating the rate of pay for one day's work under paragraph 13 (b)(ii), the rate of pay for one day's work shall be the foreign  <span style="padding-left:39px;">employee's monthly rate of pay divided by 26;and</span></span></span><br/>
			 <span style="padding-left:17px;">e)<span style="padding-left:10px;">any monetary compensation provided in lieu of the rest day must be paid by the employer to the foreign employee together with <span style="padding-left:39px;"> the next earliest monthly salary due to the foreign employee</span></span></span>
		
		
		</p>
	</div>
</body>
</html>
