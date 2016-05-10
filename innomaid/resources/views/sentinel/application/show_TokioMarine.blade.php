
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
    color: #000;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 8px;
	clear:both;
}
.h3, h3 {
    font-size: 14px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color:#000;
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
    border: 1px solid #000;
	border-collapse:collapse;

}
.table {
	margin-top:20px;
    margin-bottom: 20px;
	width:100%;

	
}
.table1 {
	width:100%;
	}
.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}
#mytst
// {
	width:26%;
}
.page-break {
    page-break-after: always;
}
</style>
<body style="background:white;">
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//print_r($employer_details);
			
		?>	
		<table class="table" style="margin-top:0px !important;margin-bottom:0px !important;">
								<tr>
								<td style="vertical-align:top;"width = '100px'>
								<img  width = '90px' src="<?php echo $root_path."/img/tokiomarine.jpg";?>"/></td>
								<td  style="vertical-align:top;"width='400px'>
								TOKIO MARINE INSURANVE SINGAPORE LTD<br/>
								20 McCallum Street #09-01<br/>Tokio Marine Centre Singapore 069046</td>
								<td style="vertical-align:top-right;"width = '90px'>
								<img  width = '90px'src="<?php echo $root_path."/img/alliedworld_logo2.png";?>"/></td>
								<td style="vertical-align:top-right;">
								<span style="color: red;">AVA INSURANCE AGENCY PTE LTD</span><br/>
								<span style="">91 Bencoolen Street #09-06</span><br/>
								<span style="">Sunshine Plaza Singapore 189652</span><br/>
								<span style="">Tel: +65 65356838 / 64638138</span><br/>
								<span style="">Fax: +65 65356828 / 64635021</span><br/>
								<span style="">Web: www.ava-ins-com.sg</span><br/>
								<span style="">Company Registration No. 20113230C</span>
								</td>
								</tr>
								</table>
		<hr/>
			<h3 style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 13px; text-align: center;margin-top:0px !important;margin-bottom: 10px !important; color:#4d4d4d;">Domestic Maid Aplication Form</h3><br/>
	<p style="text-align:center;"><span style="text-align:center;">The insurance Act: You are to disclose in the proposal form fully and faithfully all the facts which you know or </span><br/><span  style="text-align:center;">ought to know in respect of the risk that is being proposed; otherwise the policy issued hereunder may be void. </span></p>
	
		<table class="table"style="margin:0px 0px; !important;font-size:11px;">
		  <tr>
		   <th style="text-align:left;">A. PROPOSER'S / EMPLOYER'S PARTICULARS</th><th style="text-align:left;">B. MAID'S PARTICULARS</h4></tr>
		  <tr> <td width='50%'>
			<table class="table table-bordered" style="margin-top: 0px !important;margin-bottom:0px !important;">
				  <tr>
					<td colspan='2' style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Name of Proposer</span>
					<span style="white-space:nowrap;padding-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
					</td>
					<td style="vertical-align: top;"><span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Sex</span><br/>
					<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="margin-left:10px;"/><span style="padding-left:5px;font-weight:bold;">M</span>
					<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style=""/><span style="padding-left:5px;font-weight:bold;">F</span>
		
					</td>		
				  </tr>
				  <tr>
					<td colspan='3' style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Address</span>
					<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->address)}}</span>
					</td>
					
				  </tr>
				  <tr>
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Nationality</span>
					<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($nationality[0]->nationality_name)}}</span>
					</td>
					
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">SB Reference No</span>
					<span style="white-space:nowrap;padding-left:5px;">{{$insurance_data[0]->SB_transmission_number }}</span>
					</td>					
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Occupation</span></td>
				  </tr>
				  <tr>
					<td  colspan="2" style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Name of company</span>
					<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->employer_company)}}</span>
					</td>
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">NRIC/FIN No</span>
					<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</span>
					</td>
				  </tr>
				  <tr>
				  	<td colspan="3" style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Contact No</span>
					<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_mobile_phone}}</span>
					</td>
				  </tr>
			</table>
		 </td>
		
		<td  width='50%'>
			<table class="table table-bordered" style="margin-top: 0px !important;margin-bottom:0px !important;">
				  <tr>
					<td colspan='3' style="height:40px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Name of Maid</span>
					<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($maid_details[0]->name)}}</span>
					</td>
							
				  </tr>
				  <tr>
					<td colspan="2" style="height:40px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">*Date of Birth (dd/mm/yyyy)</span>
					<span style="white-space:nowrap;padding-left:5px;"><?php echo date('d/m/Y',strtotime($maid_details[0]->date_of_birth));?></span>
					</td>
					<td style="height:40px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Passport No<span>
					<span style="white-space:nowrap;padding-left:5px;">{{$maid_details[0]->passport_number}}</span>
					</td>
				  </tr>
				  <tr>
					<td colspan="2" style="height:40px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">WP No</span>
					@if($maid_details[0]->work_permit_no)
							{{$maid_details[0]->work_permit_no}}
							@else
							{{'-'}}
							@endif
					</td>
					<td style="height:40px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Nationality</span>
					<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($nationality[0]->nationality_name)}}</span>
					</td>					
				  </tr>
				  <tr>
					<td colspan="3"style="height:53.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">The period of Insurance(dd/mm/yyyy)</span><br/>
					<span style="padding-left:5px;">From	<span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->start_date));?></span></span> <span style="padding-left:5px;">To	<span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->end_date));?></span> </span>
					</td>
					
				  </tr>

			</table>
			</td></tr>
			</table>
			<!--<p style="text-align:right;color:#e67300;">*Age Limit: 69 years of age & below</p>-->
			<span style="text-align:left;color:#000; padding-left: 400px;font-weight:bold;">*Please tick only one</span>
			<span style="text-align:right;color:#000; padding-left:70px;color:#e67300; ">*Age Limit: 69 years of age & below</span>
			<table class="table" style="margin-top:0px !important;margin-bottom:0px !important;font-size:10px;">
			<tr><td class = "table"style="vertical-align: top;width:65%;">
			<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">C. PERIOD OF INSURANCE:</span><br/>
			@if($insurance_data[0]->period_of_insurance == '1-YEAR')
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;padding-top:3px;"/><span style="padding-top:3px;">1-YEAR</span>
			@else
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;padding-top:3px;"/><span style="padding-top:3px;">1-YEAR</span>
			@endif
			@if($insurance_data[0]->period_of_insurance == '2-YEAR')
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;padding-top:3px;"/><span style="padding-top:3px;">2-YEAR</span>
			@else
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;padding-top:3px;"/><span style="padding-top:3px;">2-YEAR</span>
			@endif
			</td> 
			<td style="vertical-align: top; border: 1px solid white;">
			<span style="white-space:nowrap;font-weight:bold;font-size: 10px;">F.POLO GUARANTEE:</span><br/>
			@if($insurance_data[0]->embassy_bond == '$2,000')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;padding-top:2px;"/><span style="padding-top:2px;">$2,000</span></span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;padding-top:2px;"/><span style="padding-top:2px;">$2,000</span></span>
			@endif
			@if($insurance_data[0]->embassy_bond == '$7,000')
			<span><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:15px;padding-top:2px;"/><span style="padding-top:2px;">$7,000</span></span>
			@else
			<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:15px;;padding-top:2px;"/><span style="padding-top:2px;">$7,000</span></span>
			@endif
			</td></tr>
			<tr><td style="height:34.3px;vertical-align: top; border: 1px solid white;"colspan='2'>
			<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">D. CHOICE OF MEDICAL INSURANCE COVERAGE:</span><br/>
				@if($insurance_data[0]->plan == 'PLAN A Tokio Marine')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN A </span>
						@else
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN A </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN B Tokio Marine')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN B </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN B </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN C Tokio Marine')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN C </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN C </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN D Tokio Marine')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN D </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN D </span>
						@endif
			</td>
			</tr> 
			<tr>
			<td>
			<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">E. REIMBURSEMENT OF INDEMNITY PAID TO INSURER:</span><br/>
			@if($insurance_data[0]->reimbursement == 'Yes')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/></span><span style="white-space:nowrap;padding-left:5px;">YES</span>
						@else
						<span  style=""><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/></span><span style="white-space:nowrap;padding-left:5px;">YES</span>
						@endif
						@if($insurance_data[0]->reimbursement == 'No')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>" style="white-space:nowrap;padding-left:65px;"/><span style="white-space:nowrap;padding-left:5px;">NO</span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:65px;"/><span style="white-space:nowrap;padding-left:5px;">NO</span>
						@endif
			<P style="font-size: 8px;">Provided always that if we pay the additional premium for the wavier of counter indemnity, my/our liablity to keep Tokio Marine Insurance Sinagapore Ltd. indemnified as stipulated above shall only arise 
			if the branch of the condition under the Security Bond was caused by or resulted from any deliberate act or omission of the employer. Where the branch of the condition under 
			the security bond was not caused by or resulted from the employer's deliberate act or omission , I/we will only be liable to pay Tokio Marine Insurance Sinagapore Ltd. a fixed sum of US$250.</P></td>
			<td style="height:34.3px;vertical-align: top; border: 1px solid white;"> 
			<span style="white-space:nowrap;font-weight:bold;font-size: 10px;">FOR OFFICE USE ONLY:</span><br/>
			<div style="border:1px solid #000;height:100px width:50px;"></div></td></tr>
			</table>
			<span style="color:#e67300;">By submitting this information:</span><br/>
			<span style="color:#e67300;padding-left:5px;">i)<span style="padding-left:3px;">I acknowledge and consent to This collecting, using, disclosing and /or processing my personal data for the purpose of processing/servicing my policy/claim and be disclosed to 
			third party service providers,or intermediaries, within or outside Singapore</span></span><br/>
			<span style="color:#e67300;padding-left:5pxi">ii)<span style="padding-left:3px;">I declare and confirm that I have obtained the consent of the proposer/employer name herein, where applicable, and that he/she has authorized me to disclose their personal data and consent on their
			behalf for the above collection, use, process and disclosure; and</span></span><br/>
			<span style="color:#e67300;padding-left:5px;">iii)<span style="padding-left:3px;">I acknowledge the detailed Privacy Policy Statement, governing the above, posted at www.tokiomarine.com.sg.</span></span><br/>
			
	  <span>Please Check this box to recieve information on AVA's innovative suite of insurance Products/Services via email and/or SMS.</span>
			<table class="table table-bordered" style="width:100%; border: 1px solid black; font-size: 6px;">
			<tr>
			<td colspan='2' style="padding-left:5px;">
			<h4 align ="center" style="margin:0px 0px; !important;">COUNTER-INDEMNITY FORM</h4><br/>
			<span style="color:#e67300;"><span style="font-weight:bold;">IMPORTANT NOTICE</span>: The Employer is hereby notified that by virtue of signing this Counter-Indemnity Form, it is hereby understood and agreed that a copy of it, either by way of fax or otherwise, shall be deemed binding and legally enforceable in a
			court of law and shall have the same legal effects as that of the original.</span>
			</td>
			</tr>
			<tr><td colspan='2' style="padding-left:5px;">
			<span>To:<span style="padding-left: 35px; font-weight: bold;">Tokio Marine Company Insurance Singapore Ltd.</span> </span><br/>
							    <span style="padding-left: 53px;">20 McCallum Street #09-01 Tokio Marine Center Singapore 069046</span><br/>
								<p>Dear Sir,</p>
								<p>RE:COUNTER-INDEMNITY FOR LETTER OF GUARANTEE NO______________________________</p>
								<p>In lied of the cash Deposite that I/we would otherwise have to provide as security. <span style="font-weight:bold">Tokio Marine Insurance Singapore Ltd</span>.("you")agrees to my/our request to provide the following 
								(whichever is selected to be covered under the insurance plan):</p>
								<p>A letter of Guarantee for $5,000 to the Ministry of Manpower of Singapore and/or Controller of immigration of Singapore, and/or</p>
								<p>An Insuranvce Bond for $2,000 or $7,000 (whichever amount is indicated in the insurance bond)to the Philippine Overseas Labour Office in Singapore,<br/> which guarantee(s) the payment on demand of any sum or sums not exceeding the amount stated in the Letter of Guarantee and/or Insurance Bond issued.</p>
								<p>In return , I/we agree and undertake as follows:</p>
								<p>1. I/We will, at all times unconditionally and irrevocably guarantee to jointly and severally compensate you for all claims,demands,actions,suits,
								proceedings,losses,liabilities,costs and expenses whatsoever(including legal costs and expenses determined on a solicitor or client basis) 
								which may be taken or made against you or which become payable by you under the letter of guarantee and/or Insurance Bond.</p>
								<p style="margin:0 !important; padding: 0;">2. You will have absolute discretion to compromise
								all claims,payments,demands, actions,suits,proceedings,losses and liabilities whatsoever which may be taken or made against you under the Letter of Guarantee and/or Insurance Bond.</p>
								<p>3. I/We will accept the receipts,vouchers,or any other evidence of all payments made by you or 
								all liabilities or obligations incurred by you because of the Letter of Guarantee and/or Insurance Bond  
							as conclusive evidence of my/our liability to you.</p>
							<p>4. This counter indemnity shall be a counting demand and you may at any time have absolute discretion without giving any notice to me/us extend the validity of the Letter of Guarantee and/or 
							Insurance Bond without discharging or impairing liability under the indemnity.</p>
							<p>IN WITNESS WHERE OF I/We have hereto subscribed my/our name(s)this&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;day of&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;year.</p>
							<table class="table" style="margin-top:5px !important;margin-bottom:0px !important;">
								<tr>
								<td width='50%'>
								<div style="border-top:1px solid #000;padding-top:3px;width:70%">Signature of Witness</div>
								Full Name:<br/>NRIC No.:<br/>Address:</td>
								<td width='50%'>
								<div style="border-top:1px solid #000;padding-top:3px;width:70%;padding-right:40px;">Signature of Employer</span></div>
								<span style="">Full Name:<span style="padding-left:5px;">{{$employer_details[0]->employer_name}}</span>
</span><br/><span style="">NRIC No.:<span style="padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</span>
</span></td>
								</tr>
								</table>
								</td></tr>
							
			</table>
			<div class="page-break"></div>
			<h3 style="color:#4d4d4d;">G. Letter of Guarantee $5,000</h3>
			<h3 style="color:#4d4d4d;">Schedule A: Domestic Maid Insurance and Bond Package</h3>
			<table class="table1 table-bordered" style="font-size:10px;margin-top:5px;">
		<tbody>
		<tr>
		<th  rowspan='10' style="width:10.5%;font-size:12px;vertical-align:top;border-top:1px solid #ffffff;border-bottom:1px solid #ffffff;border-left:1px solid #ffffff; color:#4d4d4d;">PLAN A</th>
		</tr>
		<tr>
		<th style="background-color:#ccc;">Section</th>
		<th style="background-color:#ccc;">Coverage</th>
		<th style="background-color:#ccc;">Limit</th>
		</tr>
			<tr>
				<td rowspan='4'> <span>1.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Death
				</td>
				<td>S$40,000</td>

			</tr>
			<tr>
				<td>
					(B) Premanent Disablement
				</td>
				<td>As per scale in Policy</td>

			</tr>
			<tr>
				<td>
					(C) Medical Expenses
				</td>
				<td>S$1,000</td>				

			</tr>
			<tr>
				<td>
					2
				</td>
				<td>Hospital & Surgical Expenses</td>
				<td>S$30,000(Annual Limit: S$15,000)(Worldwide)</td>			
			</tr>
			<tr>
				<td>
					4</td>
				<td>Repatriation Expenses</td>
				<td>Up to S$10,000</td>				

			</tr>
			<tr>
				<td rowspan='2'>
				Premium
				</td>
				<td>14-month</td>
				<td>S$171.20(incl GST)</td>			

			</tr>
			<tr>
			<td>26-month</td>
				<td>S$246.10(incl GST)</td>
			</tr>
		</tbody>
	</table>
	<table class="table1 table-bordered" style="font-size:10px;">
		<tbody>
			<tr>
		<th  rowspan='17' style="vertical-align:top;font-size:12px;border-top:1px solid #ffffff;border-bottom:1px solid #ffffff;border-left:1px solid #ffffff; color:#4d4d4d;">PLAN B</th>
		</tr>
		<tr>
		<th style="background-color:#ccc;">Section</th>
		<th style="background-color:#ccc;">Coverage</th>
		<th style="background-color:#ccc;">Limit</th>
		</tr>
			<tr>
				<td rowspan='4'> <span>1.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Death
				</td>
				<td>S$40,000</td>

			</tr>
			<tr>
				<td>
					(B) Premanent Disablement
				</td>
				<td>As per scale in Policy</td>

			</tr>
			<tr>
				<td>
					(C) Medical Expenses
				</td>
				<td>S$1,500</td>				

			</tr>
			<tr>
				<td>
					2
				</td>
				<td>Hospital & Surgical Expenses</td>
				<td>S$30,000(Annual Limit: S$15,000)(Worldwide)</td>			
			</tr>
			<tr>
				<td rowspan='3'> <span>3.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Recuperation Expenses
				</td>
				<td>S$10 per day (Max 60 days)</td>

			</tr>
			<tr>
				<td>
					(B) Temporary Help Benefit
				</td>
				<td>S$10 per day, up to 30 days & subject to a max. benefit limit of S$300 </td>

			</tr>
		
			<tr>
				<td>
					4</td>
				<td>Repatriation Expenses</td>
				<td>Up to S$10,000</td>				

			</tr>
			<tr>
				<td >
				5
				</td>
				<td>wAGES & lEVY Reimbursment</td>
				<td>Up to S$30 per day *(Max 60 days)</td>			

			</tr>
			<tr>
			<td>6</td>
			<td>Termination/Re-hiring Expenses</td>
				<td>S$250</td>
			</tr>
			<tr>
			<td>8</td>
			<td>Special Grant</td>
				<td>S$1,000</td>
			</tr>
			<tr>
			<td>9</td>
			<td>Maid & Household Liability</td>
				<td>S$50,000 AOA/Unlimited AOP</td>
			</tr>
			<tr>
				<td rowspan='2'>
				Premium
				</td>
				<td>14-month</td>
				<td>S$181.90(incl GST)</td>			

			</tr>
			<tr>
			<td>26-month</td>
				<td>S$267.50(incl GST)</td>
			</tr>
		</tbody>
	</table>
	<table class="table1 table-bordered" style="font-size:10px;">
		<tbody>
			<tr>
		<th  rowspan='19' style="vertical-align:top;font-size:12px;border-top:1px solid #ffffff;border-bottom:1px solid #ffffff;border-left:1px solid #ffffff; color:#4d4d4d;">	PLAN C
</th>
		</tr>
		<tr>
		<th style="background-color:#ccc;">Section</th>
		<th style="background-color:#ccc;">Coverage</th>
		<th style="background-color:#ccc;">Limit</th>
		</tr>
			<tr>
				<td rowspan='4'> <span>1.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Death
				</td>
				<td>S$40,000</td>

			</tr>
			<tr>
				<td>
					(B) Premanent Disablement
				</td>
				<td>As per scale in Policy</td>

			</tr>
			<tr>
				<td>
					(C) Medical Expenses
				</td>
				<td>S$2,500</td>				

			</tr>
			<tr>
				<td>
					2
				</td>
				<td>Hospital & Surgical Expenses</td>
				<td>S$40,000(Annual Limit: S$20,000)(Worldwide)</td>			
			</tr>
			<tr>
				<td rowspan='3'> <span>3.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Recuperation Expenses
				</td>
				<td>S$20 per day (Max 60 days)</td>

			</tr>
			<tr>
				<td>
					(B) Temporary Help Benefit
				</td>
				<td>S$15 per day, up to 30 days & subject to a max. benefit limit of S$450 </td>

			</tr>
		
			<tr>
				<td>
					4</td>
				<td>Repatriation Expenses</td>
				<td>Up to S$10,000</td>				

			</tr>
			<tr>
				<td >
				5
				</td>
				<td>Wages & Levy Reimbursment</td>
				<td>Up to S$35 per day (Max 60 days)</td>			

			</tr>
			<tr>
			<td>6</td>
			<td>Termination/Re-hiring Expenses</td>
				<td>S$350</td>
			</tr>
			<tr>
				<td>7</td>
			<td>Outpatient Kidney Dialysis/Cancer Treatment</td>
				<td>S$2,500(Policy Limit)</td>
			</tr>
			<tr>
			<td>8</td>
			<td>Special Grant</td>
				<td>S$2,000</td>
			</tr>
			<tr>
			<td>9</td>
			<td>Maid & Household Liability</td>
				<td>S$50,000 AOA/Unlimited AOP</td>
			</tr>
			<tr>
			<td>10</td>
			<td>Fidelity  Guarantee</td>
				<td>S$5,000</td>
			</tr>
			<tr>
				<td rowspan='2'>
				Premium
				</td>
				<td>14-month</td>
				<td>S$181.90(incl GST)</td>			

			</tr>
			<tr>
			<td>26-month</td>
				<td>S$267.50(incl GST)</td>
			</tr>
		</tbody>
	</table>
	<table class="table1 table-bordered" style="font-size:10px;">
		<tbody>
			<tr>
		<th  rowspan='19' style="border-top:1px solid #ffffff;font-size:12px;border-bottom:1px solid #ffffff;border-left:1px solid #ffffff; color:#4d4d4d;vertical-align:top;">		PLAN D

</th>
		</tr>
		<tr>
		<th style="background-color:#ccc;">Section</th>
		<th style="background-color:#ccc;">Coverage</th>
		<th style="background-color:#ccc;">Limit</th>
		</tr>
			<tr>
				<td rowspan='4'> <span>1.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Death
				</td>
				<td>S$40,000</td>

			</tr>
			<tr>
				<td>
					(B) Premanent Disablement
				</td>
				<td>As per scale in Policy</td>

			</tr>
			<tr>
				<td>
					(C) Medical Expenses
				</td>
				<td>S$4,000</td>				

			</tr>
			<tr>
				<td>
					2
				</td>
				<td>Hospital & Surgical Expenses</td>
				<td>S$60,000(Annual Limit: S$30,000)(Worldwide)</td>			
			</tr>
			<tr>
				<td rowspan='3'> <span>3.</span>
				</td>
				<td>
					Personal Accident
				</td>
				<td></td>
				
			</tr>
			<tr>
				<td>
					(A) Recuperation Expenses
				</td>
				<td>S$30 per day (Max 60 days)</td>

			</tr>
			<tr>
				<td>
					(B) Temporary Help Benefit
				</td>
				<td>S$20 per day, up to 30 days & subject to a max. benefit limit of S$600 </td>

			</tr>
		
			<tr>
				<td>
					4</td>
				<td>Repatriation Expenses</td>
				<td>Up to S$10,000</td>				

			</tr>
			<tr>
				<td >
				5
				</td>
				<td>Wages & Levy Reimbursment</td>
				<td>Up to S$35 per day (Max 60 days)</td>			

			</tr>
			<tr>
			<td>6</td>
			<td>Termination/Re-hiring Expenses</td>
				<td>S$500</td>
			</tr>
			<tr>
				<td>7</td>
			<td>Outpatient Kidney Dialysis/Cancer Treatment</td>
				<td>S$5,000(Policy Limit)</td>
			</tr>
			<tr>
			<td>8</td>
			<td>Special Grant</td>
				<td>S$3,000</td>
			</tr>
			<tr>
			<td>9</td>
			<td>Maid & Household Liability</td>
				<td>S$50,000 AOA/Unlimited AOP</td>
			</tr>
			<tr>
			<td>10</td>
			<td>Fidelity Guarantee</td>
				<td>S$5,000</td>
			</tr>
			<tr>
				<td rowspan='2'>
				Premium
				</td>
				<td>14-month</td>
				<td>S$214.00(incl GST)</td>			

			</tr>
			<tr>
			<td>26-month</td>
				<td>S$321.00(incl GST)</td>
			</tr>
		</tbody>
	</table>
	<h3 style="color:#4d4d4d;">Reimbursement of Indemnity(excess S$250)</h3>
	<table class="table1 table-bordered" style="font-size:10px;margin-top:5px;width:97%;margin-left:55px;">
		<tbody>
		<tr>
		<td>If purchased with policy</td>
		<td >S$53.50 (incl GST)</td>
		</tr>
			<tr>
				<td > If purchased subsequently
				</td>
				<td>
					S$85.60(incl GST)
				</td>
				
			</tr>
			</tbody>
		</table>
		<p style="font-size:10px;">This Policy is protected under the Policy Owner's Protection Scheme which is administered by the Sinagapore Deposit Insurance Corporation (SDIC), Coverage for your policy is
		automatic and no further action is required from you. For more information on the types of benefits that are covered under the scheme as well as the limits of coverage where applicable, please contact
		your insurer or visit the GIA / LIA or SDIC websites(www.gia.org.sg or www.sdic.org.sg)
		</p>
</body>
</html>
