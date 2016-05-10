
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
    font-size: 10px;
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
	font-size:10px;

	
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
	<div>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//print_r($employer_details);
			
		?>	
		<table class="table" style="margin-top:0px !important;margin-bottom:0px !important;">
								<tr>
								<td  style="vertical-align:top;width:150px;">
							
					<img  width = '150px' src="<?php echo $root_path."/img/alliedworld_logo3.png";?>"/>
							</td>
								<td style="vertical-align:top;">
							<span>ALLIED WORLD ASSURANCE COMPANY,LTD(SINGAPORE BRANCH)</span><br/>
								<span>60 Anson Road #09-01</span><br/><span>Mapletree Anson Singapore 079914</span><br/><span>Company's Registration N0. T09FC0142D</span>
								</span>	
								</td>
								<td style="vertical-align:top-right;width:150px;">
								<span><img  width = '100px'src="<?php echo $root_path."/img/alliedworld_logo2.png";?>"style="margin-left:40px;"/></span></td>
								<td style="vertical-align:top-right;">
								AVA INSURANCE AGENCY PTE LTD</span><br/>
								<span style="">91 Bencoolen Street #09-06</span><br/><span style="">Sunshine Plaza Singapore 189652</span><br/>
								<span style="">Tel: +65 65356838 / 64638138</span><br/>
								<span style="">Fax: +65 65356828 / 64635021</span><br/>
								<span style="">Web: www.ava-ins-com.sg</span><br/>
								<span style="">Company Registration No. 20113230C</span>
								</td>
								</tr>
								</table>
		<hr/>
			<h3 style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 18px; text-align: center;margin-top:0px !important;margin-bottom: 10px !important;">Domestic Maid Aplication Form</h3><br/>
	<span style="text-align:center;padding-left:130px;">The insurance Act: You are to disclose in the proposal form fully and faithfully all the facts which you know or </span><br/><span  style="text-align:center;padding-left:126px;">ought to know in respect of the risk that is being proposed; otherwise the policy issued hereunder may be void. </span>
	
		<table class="table"style="margin:0px 0px; !important">
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
					<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style=""/><span style="padding-left:5px;font-weight:bold;">F</span></td>		
				  </tr>
				  <tr>
					<td colspan='3' style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Address</span>
					<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->address)}}</span>
					</td>
					
				  </tr>
				  <tr>
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Nationality</span></td>
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">SB Reference No</span>
					<span style="white-space:nowrap;padding-left:5px;">{{$insurance_data[0]->SB_transmission_number }}</span>
					</td>					
					<td style="height:34.3px;vertical-align: top; border: 1px solid black;">
					<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">Occupation</span> 
					<span style="white-space:nowrap;">{{ucfirst($employer_details[0]->employer_profession)}}</span></td>
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
						<span style="padding-left:5px;">From	<span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->start_date));?></span><span style="padding-left:5px;"> To	<span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->end_date));?></span> 
					</td>
					
				  </tr>

			</table>
			</td></tr>
			</table>
			<span style="text-align:left;color:#000; padding-left: 200px; margin-top: -3px;">*Please tick only one</span>
			<span style="text-align:right;color:#000; padding-left:200px; margin-top: -3px;">*Age Limit: 69 years of age & below</span>
			<table class="table" style="margin-top:0px !important;margin-bottom:0px !important;">
			<tr><td class = "table"style="vertical-align: top;width:65%;">
			<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">C. PERIOD OF INSURANCE:</span><br/>
			<p style="margin-bottom:-16px; padding-left: 16px;">*</p>
			@if($insurance_data[0]->period_of_insurance == '1-YEAR')
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>1-YEAR
			@else
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>1-YEAR
			@endif
			@if($insurance_data[0]->period_of_insurance == '2-YEAR')
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>2-YEAR
			@else
			<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>2-YEAR
			@endif
			</td> 
			<td style="vertical-align: top; border: 1px solid white;">
			<span style="white-space:nowrap;font-weight:bold;">F. POLO GUARANTEE:</span><br/>
			<p style="margin-bottom:-16px; padding-left: 16px;">*</p>
			@if($insurance_data[0]->embassy_bond == '$2,000')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>$2,000</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>$2,000</span>
			@endif
			@if($insurance_data[0]->embassy_bond == '$7,000')
			<span><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:15px;"/>$7,000</span>
			@else
			<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:15px;"/>$7,000</span>
			@endif
			</td></tr>
			<tr><td style="height:34.3px;vertical-align: top; border: 1px solid white;"colspan='2'>
			<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">D. CHOICE OF MEDICAL INSURANCE COVERAGE:</span><br/>
			<p style="margin-bottom:-27px; padding-left: 16px;">*</p>
				@if($insurance_data[0]->plan == 'PLAN A Allied World')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN A </span>
						@else
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN A </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN B Allied World')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN B </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN B </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN C Allied World')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN C </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN C </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN D Allied World')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN D </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">PLAN D </span>
						@endif
			</td>
			</tr> 
			<tr>
			<td>
			<span style="font-weight:bold;white-space:nowrap;padding-left:5px;">E. REIMBURSEMENT OF INDEMNITY PAID TO INSURER:</span><br/><p style="margin-bottom:-16px; padding-left: 16px;">*</p>
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
			<P style="font-size: 10px;">Provided always that if we pay the additional premium for the wavier of counter indemnity, my/our liablity to keep Alied World Assurance Company, Ltd (Singapore Branch) indemnified as stipulated above shall only arise 
			if the branch of the condition under the Security Bond was caused by or resulted from any deliberate act or omission of the employer. Where the branch of the condition under 
			the security bond was not caused by or resulted from the employer's deliberate act or omission , I/we will only be liable to pay Tokio Marine Insurance Sinagapore Ltd. a fixed sum of S$250.</P></td>
			<td style="height:34.3px;vertical-align: top; border: 1px solid white;"> 
			<span style="white-space:nowrap;font-weight:bold;">FOR OFFICE USE ONLY:</span><br/>
			<div style="border:1px solid #000;height:100px width:50px;"></div></td></tr>
			</table>			
	  <span style="margin-top: 0px">Please Check this box <img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:1px;padding-top:10px;"/> to recieve information on AVA's innovative suite of insurance Products/Services via email and/or SMS.</span>
			<table class="table table-bordered" style="width:100%; border: 1px solid black; font-size: 7px; margin-top: 1px;">
			<tr>
			<td colspan='2' style="padding-left:5px;">
			<h4 align ="center" style="margin:0px 0px; !important;">COUNTER-INDEMNITY FORM</h4><br/>
			<span style="font-weight:bold;">IMPORTANT NOTICE</span>: The Employer is hereby notified that by virtue of signing this Counter-Indemnity Form, it is hereby understood and agreed that a copy of it, either by way of fax or otherwise, shall be deemed binding and legally enforceable in a
			court of law and shall have the same legal effects as that of the original.
			</td>
			</tr>
			<tr><td colspan='2' style="padding-left:5px;">
			<span>To:<span style="padding-left: 35px; font-weight: bold;">Alied World Assurance Company, Ltd(Singapore Branch)</span> </span><br/>
							    <span style="padding-left: 53px;">60 Anson Road #09-01 Mapletree Anson Singapore 079914</span><br/>
								<p>Dear Sir,</p>
								<p>RE:COUNTER-INDEMNITY FOR LETTER OF GUARANTEE NO______________________________</p>
								<p>In lied of the cash Deposite that I/we would otherwise have to provide as security. <span style="font-weight:bold">Alied World Assurance Company, Ltd(Singapore Branch)</span>.("you")agrees to my/our request to provide the following 
								(whichever is selected to be covered under the insurance plan):</p>
								<p> <img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:1px;padding-top:0px;"/>A letter of Guarantee for $5,000 to the Ministry of Manpower of Singapore and/or Controller of immigration of Singapore, and/or</p>
								<p><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:1px;padding-top:0px;"/>An Insuranvce Bond for $2,000 or $7,000 (whichever amount is indicated in the insurance bond)to the Philippine Overseas Labour Office in Singapore,<br/> which guarantee(s) the payment on demand of any sum or sums not exceeding the amount stated in the Letter of Guarantee and/or Insurance Bond issued.</p>
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
							<p>IN WITNESS WHERE OF I/We have hereto subscribed my/our name(s)this_______day of_______year.</p>
							</table>
		</div>
</body>
</html>		
