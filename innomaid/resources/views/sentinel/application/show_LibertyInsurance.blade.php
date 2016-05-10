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
?>
<style type="text/css">

body {
    color: #4d4d4d;
    font-family: "Arial",Helvetica Neue,Helvetica,sans-serif;
    font-size: 10px;
    line-height: 1.42857;
}
.h3, h3 {
    font-size: 14px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color:#4d4d4d;
    line-height: 1.1;
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
    font-weight: 700;
    margin-bottom: 5px;
    max-width: 100%;
}

.notbold {
    font-weight: 100;
}
.table-bordered {
    border: 1px solid #cccccc;
	border-collapse:collapse;

}
.table {
	margin-top:20px;
    margin-bottom: 20px;
	width:100%;
	
}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #cccccc;
	border-right:1px solid #cccccc;
}
#mytst
{
	width:26%;
}
.align
{
width:33.33px;
}
</style>
<body style="background:white;">
	<div>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
			$from = new DateTime($employer_details[0]->employer_date_of_birth);
			$to   = new DateTime('today');
			 $age = $from->diff($to)->y;
		?>	
		<table class = "table" style="margin:0px !important;">
					<tr>
					<td style="padding-left:5px;vertical-align: top;">
							<span ><img  width = '100px' height= '40px'src="<?php echo $root_path."/img/liberty_logo1.png";?>"/></span>
							<img  width = '100px'  height= '40px'src="<?php echo $root_path."/img/liberty_logo2.png";?>"style="margin-left:80px;"/></span>
						</td>
					</tr>
			</table>
		<p>www.libertyinsurance.com.sg <span style = "padding-left:30px;">  www.insuredunited.com.sg</span></p>
		<p>Please complete all sections to facilitate the processing of your application.</p>
		<p>Statement pursuant to Section25(5) Cap. 142 of the Insurance Act or any subsequent amendments thereof You are to disclose in the proposal form fully and faithfully all facts which you know or ought to know. otherwise the Policy issued hereunder may be void.</p>
		<table class = "table table-bordered " style="margin:0px !important;">
					<tr>
					<td style="height:25px;width:0.5%;">
					</td>
						<td style="padding-left:5px;vertical-align: bottom;">
						<span style="font-weight:bold;white-space:nowrap;">Name of Producer & Producer Code:</span> <span>INSURED UNITED AGENCY PTE LTD (A1254)</span>
						</td>
					</tr>
			</table>
			<h1 style="font-size:13px;font-weight:bold;">Particulars of Proposer</h1>
				<table class = "table table-bordered" style="margin-top:5px !important;margin-bottom:0px !important;">
					<tbody class="employer_detail"><tr>
					<td style="width:1%;"></td>
						<td style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Name of Proposer:</span>
							<span style="white-space:nowrap;padding-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
						</td>
						<td style="padding-left:5px;vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;">Gender:</span><br/> 
							<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"/></span><span style="padding-left:5px;">Female</span><br/>
							<span><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"/></span><span style="padding-left:5px;">Male</span>
						</td>
						<td style="vertical-align: top;">
						<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Age:</span>
						<span style="white-space:nowrap;padding-left:5px;">{{$age}}</span>
						</td>
					</tr>
					<tr>
					<td style="width:1%;"></td>
						<td colspan = '3'style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Mailing Address:</span><br/>
							<span style="white-space:nowrap;padding-left:500px;">Postal Code:<span style="padding-left:20px;">(<span style = "padding-left:70px;">&nbsp;</span>)</span></span>
						</td>
					</tr>
					</tbody>
					<tbody >
					<tr>
					<td style="width:1%;"></td>
						<td style="height:34.3px;vertical-align: top;" class="align">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">NRIC No.:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Contact No.:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_mobile_phone}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Nationality:</span>
						</td>
					</tr>
					</tbody>
					<tbody>
					<tr>
					<td style="width:1%;"></td>
						<td colspan='2'style="height:34.3px;vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Email:</span>
						</td>
						<td style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">SB Transmission No.:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$insurance_data[0]->SB_transmission_number }}</span>
						</td>
					</tr>
					</tbody>
			</table>
			<h1 style="font-size:13px;font-weight:bold;margin-top:5px !important;">Particulars of Maid</h1>
					<table class = "table table-bordered" style="margin-top:5px !important;">
					<tr>
					<td style="width:0.5%;"></td>
						<td colspan='2' style="height:34.3px;vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Name of Maid:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($maid_details[0]->name)}}</span>
						</td>
						<td style="vertical-align: top;" >
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Passport No.:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$maid_details[0]->passport_number}}</span>
						</td>
					</tr>
					<tr>
						<td style="width:0.5%;"> </td>
						<td style="height:34.3px;vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Date of Birth:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$maid_details[0]->date_of_birth}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Nationality:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($nationality[0]->nationality_name)}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Work Permit No.:</span>
							<span  style="white-space:nowrap;padding-left:5px;">
							@if($maid_details[0]->work_permit_no)
							{{$maid_details[0]->work_permit_no}}
							@else
							{{'-'}}
							@endif
							</span>
						</td>
					</tr>
					<tr>
					<td style="width:0.5%;"></td>
						<td colspan='3'style="height:25px;vertical-align: bottom;">
							<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Effective Date</span><span>(DD/MM/YYYY):</span>
							<span style="white-space:nowrap;padding-left:45px;">
							@if($insurance_data[0]->effective_date == '14 months')
							<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="white-space:nowrap;padding-left:5px;"> 14 months</span>
							@else
							<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"/> <span style="white-space:nowrap;padding-left:5px;">14 months</span>
							@endif
							</span>
							<span style="white-space:nowrap;padding-left:50px;">
							@if($insurance_data[0]->effective_date == '26 months')
							<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="white-space:nowrap;padding-left:5px;">26 months</span>
							@else
							<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="white-space:nowrap;padding-left:5px;">26 months</span>
							@endif
							</span>
							<span style="white-space:nowrap;padding-left:50px;">From <span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->start_date));?></span></span>
						</td>
					</tr>
			</table>
			<table class = "table table-bordered " style="margin-top:0px !important;margin-bottom:0px !important;">
				<tr>
					<td style="width:0.5%;">
					</td>
					<td style="white-space:nowrap;padding-left:5px;width:33.33%;vertical-align: top;">
						<span style="font-weight:bold;white-space:nowrap;">Choice of Insurance Coverage:</span><br/>
						@if($insurance_data[0]->plan == 'PLAN 1')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan 1 </span>
						@else
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan 1 </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN 2')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan 2 </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan 2 </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN 3')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan 3 </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan 3 </span>
						@endif
					</td>
					<td style="white-space:nowrap;padding-left:5px;vertical-align: top;">
						<span style="font-weight:bold;white-space:nowrap;">Reimbursement of Idemnity paid to Insurer:</span><br/>
						@if($insurance_data[0]->reimbursement == 'Yes')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Yes</span>
						@else
						<span  style="padding-top:10px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Yes</span>
						@endif
						@if($insurance_data[0]->reimbursement == 'No')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>" style="white-space:nowrap;padding-left:65px;padding-top:10px;"/><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">No</span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:65px;padding-top:10px;"/><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">No</span>
						@endif
					</td>
					<td style="white-space:nowrap;padding-left:5px;vertical-align: top;">
						<span style="font-weight:bold;white-space:nowrap;">Philippines Embassy Bond:</span><br/>
						@if($insurance_data[0]->embassy_bond == '$2,000')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"/></span><span style="white-space:nowrap;padding-left:5px;">Bond amount:S$2,000</span><br/>
						<span style="white-space:nowrap;padding-left:22px;">Premium:S$42.80*</span></span><br/>
						@else
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="white-space:nowrap;padding-left:5px;">Bond amount:S$2,000</span><br/>
						<span style="white-space:nowrap;padding-left:22px;">Premium:S$42.80*</span></span><br/>
						@endif
						@if($insurance_data[0]->embassy_bond == '$7,000')
						<span style="white-space:nowrap;padding-left:5px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="white-space:nowrap;padding-left:5px;">Bond amount:S$7,000</span><br/>
						<span style="white-space:nowrap;padding-left:22px;">Premium:S$74.90*</span></span><br/>
						@else
						<span style="white-space:nowrap;padding-left:5px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="white-space:nowrap;padding-left:5px;">Bond amount:S$7,000</span><br/>
						<span style="white-space:nowrap;padding-left:22px;">Premium:S$74.90*</span></span><br/>
						
						@endif
						*Premiums above include prevailing GST
						
					</td>
				</tr>
			</table>
			<h1 style="font-size:11px;margin-top:5px;margin-bottom:5px;">Remarks:</h1>
			<p>The Proposer will need to idemnity Liberty Insurance Pte Ltd for all sums that they may incur arising out of the Letter of Guarantee and/or Embassy Bond.</p>
			<h1 style="font-size:11px;margin-top:5px;margin-bottom:5px;">PAYMENT BEFORE COVER WARRANTY(INDIVIDUAL)</h1>
			<p>Please note that the total premium must be paid and actually received in full by the Company(or the intermediary through whom this Policy wass effected) on or before the inception date of the coverage, failing which the Policy shall be deemed to be automatically canceled and no benefits whatsoever shall be payable by the Company.</p>
			<h1 style="font-size:11px;margin-top:5px;margin-bottom:5px;">PERSONAL DATA PROTECTION</h1>
			<p>I give to Liberty Insurance Pte Ltd and third-parties including related entities, employees, agents , other insurers, contractors & service-providers (collectively, "Appointees") to collect , use and disclose all personal data relating to myself or other individuals that I have furnished in the past, present & in the future, for one or more of the purposes described in Liberty's Data Protection Policy, including but not limited to considering whether to provide insurance, carrying out due diligence, pricing, administering and servicing my policies, communicating with me, renewals, reinsurance, collections claims, accounting, audit, legal, compliance, research, analysis, information sharing, surveys, data storage 
			& backups. I have read and agreed to the full Policy at <span style="border-bottom:1px solid #000;">www/libertyinsurance.com.sg/data-protection-policy/</span></p>

			<table class = "table" style="margin:0px !important;font-size:10px;" >
					<tr>
					<td>
					<span style="font-weight:bold">Underwritten by:Liberty Insurance Pte Ltd</span><br/>
					<span style="">(Registration No.: 199002791D) | GST Registraion No M2-0093571-3</span><br/>
					<br/>
					51 Club Street #03-00 Liberty House Singapore 069428<br/>
					Tel: 1800-LIBERTY (542-3789) | Fax: (+65)6223 6434
					</td>
					<td style="padding-left:10px;">
					<span style="font-weight:bold;padding-left:80px;">Distributed by: Insured United Agency Pte Ltd</span><br/>
					<span style="padding-left:180px;">(Registration No.: 19980275M) </span><br/>
					<br/>
						<span style="padding-left:100px;">38M Penjuru Road #03-00 Singapore 609148</span><br/>
						<span style="padding-left:115px;">Tel(+65) 6744 1339 | Fax: (+65)6744 7469</span>
					
					</td>
						
					</tr>
			</table>
			</div>	
</body>
</html>
