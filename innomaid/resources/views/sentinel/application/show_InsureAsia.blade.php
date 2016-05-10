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
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 10px;
}
.h3, h3 {
    font-size: 14px;
	font-size: 10px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
	margin-top:20px;
	font-size: 10px;

}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color:#4d4d4d;
    line-height: 1.1;
    height: 0;
	font-size: 10px;
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
			<table class = "table" style="margin-top:0px !important;margin-bottom:0px !important;">
				<tr>
					<td>
					<span>Arranged by</span>
						<span>
							 <span style="font-weight:bold; font-size:15px;">insure<span style="font-weight:bold;color:#ccc; font-size:15px;">A</span>sia</span><br/>
							<span style="padding-left:60px;">InsureAsia Agency Pte Ltd</span><br/>
							<span style="padding-left:60px;">60 Eu Tong Sen Street #02-07</span><br/>
							<span style="padding-left:60px;">Furama Hotel Singapore 059804</span><br/>
							<span style="padding-left:60px;">Tel: 6533 6113  Fax: 6533 4002/3</span><br/>
							<span style="padding-left:60px;">www.insureasia.com.sg</span>
						</span>
					</td>
					<td style="vertical-align:top;">
						<span ><img  height= '50px' width = '100px'src="<?php echo $root_path."/img/ERGO_logo.png";?>"style="margin-left:60px;"/></span>
					</td>
				</tr>
			</table>			
		<h1 style="font-size:13px;font-weight:bold;margin-top:20px;text-align:center;">ERGO Domestic Maid Proposal Form</h1>
		<p style="padding-top:10px;">Statement Pursuant to Section 25(5) of the Insurance Act (Cap. 142): You are to disclose in the proposal form fully and faithfully all the facts which you know or ought to know in respect of the risk that is being proposed: otherwise the policy issued hereunder may be void. </p>
		<h1 style="font-size:10px;font-weight:bold;margin-top:5px !important;">1. EMPLOYER'S PARTICULARS</h1>
		<table class = "table table-bordered" style="margin-top:5px !important">
					<tbody>
					<tr>
						<td style="vertical-align: top;height:20px;"colspan='2'>
							<span style="padding-left:5px;">The Employer</span>
							<span style="white-space:nowrap;padding-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
						</td>
						
						<td style="vertical-align: top;">
							<span style="padding-left:5px;">Date of Birth:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_date_of_birth}}</span>
						</td>
						<td style="padding-left:5px;vertical-align: top;">
							<span style="white-space:nowrap;">Sex:</span><br/> 
					
						</td>
						<td style="vertical-align: top;">
						<span style="white-space:nowrap;padding-left:5px;">Marital Status:</span>
						<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->marital_status)}}</span>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;height:20px;"colspan='3'>
							<span style="white-space:nowrap;padding-left:5px;">Residential Address:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->address)}}</span>
						</td>
						<td style="vertical-align: top;" colspan='2'>
							<span style="white-space:nowrap;padding-left:5px;">Telephone No.</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_mobile_phone}}</span>
						</td>
						
					</tr>
					<tr>
			
						<td style="vertical-align: top;height:20px;">
							<span style="white-space:nowrap;padding-left:5px;">NRIC No.</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</span>
						</td>
						<td style="vertical-align: top;width:200px;">
							<span style="white-space:nowrap;padding-left:5px;">SB Transmission Ref No.</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$insurance_data[0]->SB_transmission_number }}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="white-space:nowrap;padding-left:5px;">Nationality</span>
						</td>
							<td style="vertical-align: top;">
							<span style="white-space:nowrap;padding-left:5px;">Occupation</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->employer_profession)}}</span>
						</td>
							<td style="vertical-align: top;">
							<span style="white-space:nowrap;padding-left:5px;">Name of Company</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->employer_company)}}</span>
						</td>
						
					</tr>
					</tbody>
					
			</table>
			<h1 style="font-size:10px;font-weight:bold;margin-top:1px;margin-bottom:0px !important;">2. MAID'S PARTICULARS</h1>
					<table class = "table table-bordered " style="margin-top:0px !important;">
					<tr>
						<td colspan='2' style="vertical-align: top;height:20px;">
							<span style="white-space:nowrap;padding-left:5px;">Name</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($maid_details[0]->name)}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="white-space:nowrap;padding-left:5px;">Date of Birth:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$maid_details[0]->date_of_birth}}</span>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top;height:20px;" >
							<span style="white-space:nowrap;padding-left:5px;">Passport No.</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$maid_details[0]->passport_number}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="white-space:nowrap;padding-left:5px;">Nationality:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($nationality[0]->nationality_name)}}</span>
						</td>
						<td style="vertical-align: top;">
							<span style="white-space:nowrap;padding-left:5px;">Work Permit No.:</span>
							<span  style="white-space:nowrap;padding-left:5px;">
							@if($maid_details[0]->work_permit_no)
							{{$maid_details[0]->work_permit_no}}
							@else
							{{'-'}}
							@endif
							</span>
						</td>
					</tr>
					</table>
				<h1 style="font-size:10px;font-weight:bold;margin-top:10px;"><span>3. PERIOD OF INSURANCE</span> <span style="padding-left:30px;font-weight:500;"> From:<span style="border-bottom:1px solid #000;padding-right:150px;margin-left:5px;">
				@if($insurance_data[0]->start_date!='' && $insurance_data[0]->start_date!='0000-00-00')
						{{ $insurance_data[0]->start_date }}
						@else
						&nbsp;
						@endif
				</span> <span style="padding-left:5px;font-weight:500;">To:<span style="border-bottom:1px solid #000;padding-right:90px;margin-left:5px;">
				@if($insurance_data[0]->end_date!='' && $insurance_data[0]->end_date!='0000-00-00')
						{{ $insurance_data[0]->end_date }}
						@else
						&nbsp;
						@endif
				</span></span></h1>
				<h1 style="font-size:10px;font-weight:bold;margin-top:20px;"><span>4. PLEASE TICK THE REQUIRED COVERAGE(For details, please see overleaf)</span> </h1>
				<table class = "table " style="margin-top:0px !important;">
					<tr>
						<td style="padding-left:5px;vertical-align: bottom;width:50%;">
						I ) Letter of Guarantee (S$5,000) and Insurance Coverage
						</td>
						<td style="padding-left:5px;vertical-align: bottom;">
						<span>
					@if($insurance_data[0]->plan == 'PLAN A Insure Asia')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan A </span>
						@else
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan A </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN B Insure Asia')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan B </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan B </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN C Insure Asia')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan C </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan C </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN D Insure Asia')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan D </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:25px;padding-top:10px;"/></span><span style="white-space:nowrap;padding-left:5px;padding-top:10px;">Plan D </span>
						@endif
						</span>
						</td>
						<tr>
							<td> II ) Reimbursement of Indemnity Paid to Insurers</td>
							<td>
						@if($insurance_data[0]->reimbursement == 'Yes')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-top:10px;padding-left:3px;"/></span>
						@else
						<span  style="padding-top:10px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-top:10px;padding-left:3px;"/></span>
						@endif
							</td>
						</tr>
					</tr>
				</table>					
				<table class = "table table-bordered print-friendly" style="margin-top:0px !important;font-size:10px !important;">
					<tr>
						<td style="padding-left:5px;">
							<h1 style="font-size:10px;font-weight:bold;text-align:center;margin-top:0px !important;">DECLARATION AND UNDERTAKING</h1>
							<h1 style="font-size:10px;font-weight:bold;margin-top:0px !important;">IMPORTANT NOTICE</h1>
							<p style="padding-top:5px;">The Proposer is hereby notified that by virue of signing this letter of declaration and undertaking. it is hereby understood and agreed that a company of it,either by way of fax or otherwise shall be deemed
							binding and legally enforceable in a count of law and shall have the same legal effects as that of the original</p>
						</td>
					</tr>
					<tr>
						<td style="padding-left:5px;"><p style="font-weight:bold;">To:  ERGO Insurance Pte. Ltd.</p>
						<p>I/We hereby declare that the answers and statements given above are true and complete, and that I/We have not withheld any material information.</p>
						<p>This Proposal and any Guarantee issued pursuant to this Proposal shall be the Counter Idemnity set forth below to which terms and conditions I/We agree</p>
							<table class = "table" style="margin-top:7px !important;margin-bottom:0px !important;font-size:10px;!important">
								<tr>
									<td>
										<span style="margin-left:20px;">
											<span style="border-top:1px solid #000;padding-right:100px;">Signature of Witness</span><br/>
											<span style="margin-left:20px;">Full Name:</span><br/>
											<span style="margin-left:20px;">NRIC No.:</span><br/>
											<span style="margin-left:20px;">Address</span><br/>
										</span>
									</td>
									<td style="vertical-align:top;">
										<span style="border-top:1px solid #000;padding-right:100px;">Signature of Employer</span><br/>

									</td>
								</tr>
							</table>	
						<p>TERMS AND CONDITIONS OF COUNTER INDEMNITY FOR LETTER OF GURANTEE NO.</p>
						<span>In consideration of ERGO Insurance Pte. Ltd.("the Insurer") agreeing at my/our request to issue a letter of Guarantee ("the Guarantee") in favor of the
						Ministry of Manpower ("the Controller") guaranteeing payment on demand of any sums not exceeding in total Singapore Dollars Five Thousand (S$5,000) in lieu of the cash deposit of Singapore Dollars Five Thousand (S$5,000) that the Employer would otherwise have to provide as 
						security under the Security Bond executed by the Employer in favour of the Controller, I/We hereby jointly and serveraly irrevocobly and unconditionally agree and undertake
						for myself ourselves and my/our heirs executors administrators assigns and successors that:
						</span><br/>
						<span>1.  As a continuing obligation I/We shall indemnity and keep 
						indemnified the Insurer from and against all claims,demands,payments,actions,suits,proceedings,
						losses,expenses including legal costs on an indemnity basis and all other liabilities of whatsoever
						nature or description which may be or taken against or incurred by the Insurer in relation to 
						or arising out of the Guarantee  and/or Counter Indemnity.</span><br/>
						<span>2.  Where any request is made upon the Insurer by the Controller for payment of any sum of money pursuant to the Guarantee,("such request")
							the Insurer shall at its absolute discretion be at liberty to contest at compromise or immediately pay upon such request and such request 
							shall be sufficient authority to the Insurer for making any payment thereon without requiring or obtaining any evidence or proof that the amount so 
							claimed or requested is due payable to the Controller and without any notice or reference to or further authority from me/us notwithstanding that I/We may
							dispute the validity at any such claim or request.
						</span><br/>
												<span>3.  I/We shall not at any time question or challenge the validity legality or otherwise of any payment made by the Insurer to the Controller pursuant to such
						request or deny any liability under this Counter-Indemnity on the ground that such payment or any part thereof made by the Insurer was not due or payable 
						given by the Controller or on any other ground whatsoever.
						</span><br/>
						<span>4.  I/We shall not be discharged or released from the Indemnity by any compromise, variation or arrangement made between the Controller and the Insurer in 
						relation to the obligations undertaken by the Insurer under the Guarantee or by any forbearance whether as to payment time performance or otherwise given by the Controller to the Insurer.</span><br/>
						<span>5. My/Our liability herein is irrevocable and shall remain in full force and effect until the Insurer's liability under the Guarantee is fully discharged to the Insurer's satisfaction.</span><br/>
						<span>6. This indemnity shall be governed by and constructed in accordance with the laws of Singapore.</span>
		
						</td>
					</tr>
				</table>	
				</div>	
</body>
</html>
