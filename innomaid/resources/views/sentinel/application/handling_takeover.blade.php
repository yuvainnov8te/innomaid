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
    border:1px solid #000;
	font-size:11px;
	}
.table {
    margin-bottom: 10px;
	margin-top:30px;
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

p{
	font-size:11px;
}
.per_info tr td:first-child
{
	width:50%;	
}
.per_info tr td:nth-child(2)
{
	width:50%;	
}

</style>
<body style="background:white;">
<div class="container-fluid">
	@if($user_data[0]->image)
		<div style="width:100px; height:100px;">
				<img style = "height:100px; width:100px;"src='<?php echo $root_path."/uploads/agency_logo/".$user_data[0]->image;?>' />
		</div>
		@endif
<h1 style="text-align:center;font-size:12px;font-weight:bold;"><span style="border-bottom:1px solid #000;">
{{ucfirst($user_data[0]->company_name)}}
Employment Agency</span><br/><span style="font-size:10px;">Licence No:{{$user_data[0]->license_no}}</span></h1>
<h2 style="text-align:center;margin-top: 35px;font-size:12px;"><span style="border-bottom:1px solid #000;">HANDING & TAKE OVER FORM</span></h2>
<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
	$employer_details[] =json_decode($maid_employer->employer_json_data);

		?>
<table class="table table-bordered1 per_info" style="">
	<tbody>
		<tr>
			<th style="text-align: left;"><span style="padding-left:25px;">Information</span></th>
			<th style="text-align: left;"><span style="padding-left:25px;">Facilitation</span> <span style="padding-left:150px;">Date</span></th>
		</tr>
		<tr>
			<td style="width:40%;">
				<table class="table table-bordered per_info" style="margin-top:0px !important;border-collapse: collapse;" cellspacing='0' cellpadding='0'>
					<tbody>
						<tr>
							<td style="padding-left:25px;"><span style="font-weight:bold;">Reference No:</span>
							<span style="padding-left:5px;border-bottom:1px solid #000;">{{ucfirst($maid_employer->maid_reference_code)}}</span></td>
						</tr>
						<tr>
							<td style="padding-left:25px;"><span style="font-weight:bold;">Employer's Name:</span>
							@if($employer_details[0]->employer_name)	
							<span style="padding-left:5px;border-bottom:1px solid #000;">{{ucfirst($employer_details[0]->employer_name)}}</span>
							@endif
							</td>
						</tr>
						<tr>
							<td style="padding-left:25px;"><span style="font-weight:bold;">Address:</span>
							@if($employer_details[0]->address)	
							<span style="padding-left:5px;border-bottom:1px solid #000;">{{ucfirst($employer_details[0]->address)}}</span></td>
							@endif
						</tr>
						<tr>
							<td style="padding-left:25px;"><span style="font-weight:bold;">FDW's Name:</span>
							<span style="padding-left:5px;border-bottom:1px solid #000;">{{ucfirst($maid_details[0]->name)}}</span></td>
						</tr>
						<tr>
							<td style="padding-left:25px;"><span style="font-weight:bold;">Passport No:</span>
							<span style="padding-left:5px;border-bottom:1px solid #000;">{{ucfirst($maid_details[0]->passport_number)}}</span></td>
						</tr>
					</tbody>
				</table>
			</td>
			<td>
				<table class="table table-bordered per_info" style="margin-top:0px !important;border-collapse: collapse;"cellspacing='0' cellpadding='0' >
					<tbody>
						<tr>
						  <td>
							<ul>

									<li><span style="padding-left:15px;font-weight:bold;">Application of WP</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Approval of WP</span></li>	
									<li><span style="padding-left:15px;font-weight:bold;">Submission of BG/INS</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">ETA of FDW</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Medical Check-up</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Thumb printing</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Collection of Documents</span></li>
							</ul>
							</td>
							<td>
							<ul style="list-style-type:none;">
									@if($maid_handling_takeover[0]->application_of_wp != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->application_of_wp}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif	
									@if($maid_handling_takeover[0]->approval_of_wp != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->approval_of_wp}}</span></li>	
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->submission_of_bg != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->submission_of_bg}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->eta_of_fdw != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->eta_of_fdw}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->medical_checkup != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->medical_checkup}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->thumb_printing != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->thumb_printing}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->collection_of_document != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">{{$maid_handling_takeover[0]->collection_of_document}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:60px;">&nbsp;</span></li>
									@endif
							</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<th style="text-align: left;"><span style="padding-left:30px;">Documents to be handed to FDW personally</span></th>
			<th style="text-align: left;"><span style="padding-left:30px;">Handing over of FDW and Documents to Employer</span></th>
		</tr>
		<tr>
			<td>
				<table class="table table-bordered per_info" style="margin-top:0px !important;border-collapse: collapse;" cellspacing='0' cellpadding='0'>
					<tbody>
						<tr>
							<th style="text-align:left;padding-left:30px;">Description</th>
							<th style="text-align:left;padding-left:30px;">Date/Signature of FDW</th>
						</tr>
						<tr>
						  <td style="width:30%;white-space:nowrap;">
							  <ul style="line-height:2;">
									<li><span style="padding-left:15px;font-weight:bold;">Employment Contract</li>
									<li><span style="padding-left:15px;font-weight:bold;">Fdw's Passport</li>	
									<li><span style="padding-left:15px;font-weight:bold;">Work Permit</li>
									<li><span style="padding-left:15px;font-weight:bold;">FDW Handy Guidebook <br/><span style="padding-left:15px;">from MOM</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Medical report</li>
								</ul>
							</td>
							<td style="vertical-align:top;">
							<ul style="list-style-type:none;line-height:2;">
									@if($maid_handling_takeover[0]->employment_contract_fdw != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->employment_contract_fdw}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->fdw_passport != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->fdw_passport}}</span></li>	
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->work_permit != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->work_permit}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->fdw_handy_guide != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->fdw_handy_guide}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->medical_report_fdw != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->medical_report_fdw}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
							</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td style="vertical-align:top;">
				<table class="table table-bordered per_info" style="margin-top:0px !important;border-collapse: collapse;"cellspacing='0' cellpadding='0' >
					<tbody>
						<tr>
							<th style="text-align:left;padding-left:30px;">Description</th>
							<th style="text-align:left;padding-left:30px;">Date/Signature</th>
						</tr>
						<tr>
						  <td style="width:30%;white-space:nowrap;">
							  <ul style="line-height:2;">
									<li><span style="padding-left:15px;font-weight:bold;">Service Contract</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Employment Contract</span></li>	
									<li><span style="padding-left:15px;font-weight:bold;">B/Guarantee</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Insurance</span></li>
									<li><span style="padding-left:15px;font-weight:bold;">Medical report</span></li>
								</ul>
							</td>
							<td >
							<ul style="list-style-type:none;line-height:2;">
									@if($maid_handling_takeover[0]->service_contract != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->service_contract}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->employment_contract_employer != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->employment_contract_employer}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->b_guarantee != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->b_guarantee}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->insurance != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->insurance}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
									@if($maid_handling_takeover[0]->medical_report_employer != '0000-00-00')
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">{{$maid_handling_takeover[0]->medical_report_employer}}</span></li>
									@else
									<li><span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span></li>
									@endif
							</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<p>I,<span style="border-bottom:1px solid #000;margin-left:5px;">{{ucfirst($employer_details[0]->employer_name)}}</span>, NRIC/PassportNo:<span style="border-bottom:1px solid #000;margin-left:5px;">{{ucfirst($employer_details[0]->employer_nric_no)}}</span> hereby confirm that <span style="border-bottom:1px solid #000;margin-left:5px;">{{$maid_details[0]->name}}</span>   (Name of FDW), Passport No:<span style="border-bottom:1px solid #000;margin-left:5px;">{{$maid_details[0]->passport_number}}</span> is the FDW selected by me and I take custody and responsibility of the FDW with effect from <span style="border-bottom:1px solid #000;padding-right:150px;">&nbsp;</span>.</p>
<table class="table table-bordered">
		<tr>
			<td style="text-align:left;">
			<?php echo date("d-m-Y");?>
			__________________________________________ <br />
			Signature / Name of Employer / Date
			</td>
			
		</tr>
	</table>
</div>
</body>
</html>
