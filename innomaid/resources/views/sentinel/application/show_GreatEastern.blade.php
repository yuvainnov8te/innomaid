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
    font-size: 8px;
}
.h3, h3 {
    font-size: 9px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 20px;
    margin-top: 30px;
	    font-size: 8px;

}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color:#4d4d4d;
    height: 0;
	    font-size: 8px;

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
	font-size:13px;
	
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
		<table class = "table" style="margin-top:0px !important;margin-bottom:0px !important;font-size:10px;">
				<tr>
					<td>
						<span>
							Vintage Insurance Agency<br/>
							
							Tel: 6536 0848  Fax: 6536 0850/6438 3669
						</span>
					</td>
					<td>
					<img  width = '110px'src="<?php echo $root_path."/img/greateaster.jpg";?>"style="margin-left:200px;"/></span>
					</td>
				</tr>
			</table>		
			<h3 style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif; font-size: 18px; text-align: center;margin-top:0px !important;margin-bottom: 5px !important;">Domestic Maid Aplication Form</h3><br/>
	<p  style="text-align:center;margin-top:10px;"><span style="text-align:center;color:#e67300;font-size:12px;">Statement Pursuant to section 25(s) of the Insurance Act. Cap 142 . You are to disclose in the proposal ,form fully </span><br/><span  style="color:#e67300;font-size:12px;">and faithfully all the facts which you know or ought to know otherwise the policy issued hereunder may be void. </span></p>

			<h1 style="font-size:13px;font-weight:bold;margin-top:1px !important;margin-bottom:0px !important;">I Employer's Particulars<span style="padding-left:300px;">Policy No__________________</span></h1>
				<table class = "table" style="margin-top:0px !important;margin-bottom:0px !important;line-height:1;">
					<tbody >
					<tr>
						<td style="vertical-align: top;"colspan='4' >
						<span style="padding-left:5px;">Name </span>
							<span style="border-bottom:1px solid #000;padding-right:400px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
						<span style="">Nric No</span>
						<span style="border-bottom:1px solid #000;padding-right:80px;">{{$employer_details[0]->employer_nric_no}}</span>
						</td>
					</tr>
					<tr>
						<td colspan = '4'style="vertical-align: top;">
							<span style="padding-left:5px;">Address</span>
							<span style="border-bottom:1px solid #000;padding-right:300px;">{{ucfirst($employer_details[0]->address)}}</span>
							<span style="">S(<span style = "padding-left:130px;border-bottom:1px solid #000;">&nbsp;</span>)</span></span>
						</td>
					</tr>
					</tbody>
					<tbody >
					<tr>
						<td  colspan='4'style="vertical-align: top;">
							<span style="padding-left:5px;">SB Transmission No.</span>
							<span style = "border-bottom:1px solid #000;padding-right:100px;">@if($insurance_data[0]->SB_transmission_number ){{$insurance_data[0]->SB_transmission_number }}@else {{ '' }}@endif</span>
							<span style="font-weight:bold;white-space:nowrap">email add<span style="border-bottom:1px solid #000;padding-right:250px;">&nbsp;</span></span>
						</td>
						
					</tr>
					</tbody>
					<tbody>
					<tr>

						<td style="height:34.3px;vertical-align: top;" colspan='4'>
							<span style="padding-left:5px;">D.O.B.<span style="border-bottom:1px solid #000;padding-right:80px;">{{$employer_details[0]->employer_date_of_birth }}</span></span>

							<span style="padding-left:5px;">Nationality:S'pore/</span>
							<span style="border-bottom:1px solid #000;padding-right:80px;">&nbsp;</span>

							<span style="">Tel:<span style="border-bottom:1px solid #000;padding-right:40px;">	{{$employer_details[0]->employer_mobile_phone}}</span></span>
					
							<span style="">HP:<span style="border-bottom:1px solid #000;padding-right:100px;">&nbsp;</span></span>
						</td>
					</tr>
					</tbody>
		<tr>
			<th style="text-align:left;">II Maid's Particulars</th>
				</tr>
					<tr>
						<td colspan='4' style="vertical-align: top;">
							<span style="padding-left:5px;">Name of Maid:</span>
							<span style="border-bottom:1px solid #000;padding-right:330px;">{{ucfirst($maid_details[0]->name)}}</span>
						
							<span style="">Passport No</span>
							<span style="border-bottom:1px solid #000;padding-right:30px;">@if($maid_details[0]->passport_number){{$maid_details[0]->passport_number}}@else{{ '' }}@endif</span>
						</td>
					</tr>
					<tr>
						<td style="height:34.3px;vertical-align: top;" colspan='4'>
							<span style="padding-left:5px;">D.O.B.</span>
							<span style="border-bottom:1px solid #000;padding-right:40px;">{{$maid_details[0]->date_of_birth}}</span>
							<span style="">WP  No.:</span>
							<span style="border-bottom:1px solid #000;padding-right:120px;">
							<?php if(isset($maid_details[0]->work_permit_no)) 
					echo $maid_details[0]->work_permit_no;?></span>
							<span style="">Nationality:Filipino/I'sian/Myanmar/Indian/</span>
							<span style="border-bottom:1px solid #000;padding-right:50px;">{{ucfirst($nationality[0]->nationality_name)}}</span>
						
							
						</td>
					</tr>
			</table>
						<h1 style="font-size:13px;font-weight:bold;"><span>III PERIOD OF INSURANCE:</span> <span style="padding-left:5px;font-weight:500;"> From<span style="border-bottom:1px solid #000;padding-right:100px;margin-left:5px;">
						@if($insurance_data[0]->start_date!='' && $insurance_data[0]->start_date!='0000-00-00')
						{{ $insurance_data[0]->start_date }}
						@else
						&nbsp;
						@endif
						</span> <span style="font-weight:500;">to<span style="border-bottom:1px solid #000;padding-right:100px;margin-left:5px;">
						@if($insurance_data[0]->end_date!='' && $insurance_data[0]->end_date!='0000-00-00')
						{{ $insurance_data[0]->end_date }}
						@else
						&nbsp;
						@endif
						</span></span>(26 Months)</h1>
						<h1 style="font-size:13px;font-weight:bold;"><span>IV Type of Cover:</span>						
						@if($insurance_data[0]->plan == 'PLAN DB')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-top:10px;margin-left:30px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN DB </span>
						@else
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-top:10px;margin-left:30px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN DB </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN D1')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN D1 </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN D1</span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN D2')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN D2 </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN D2 </span>
						@endif
						@if($insurance_data[0]->plan == 'PLAN D3')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN D3 </span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:20px;padding-top:10px;"/></span><span style="padding-left:5px;padding-top:10px;">PlAN D3 </span>
						@endif
						<span style="font-weight:500;">(please tick)* *(Details overleaf)</span>
						</h1>

						<h1 style="font-size:13px;font-weight:bold;">V Optional Cover: REIMBURSEMENT OF IDEMNITY PAID TO INSURER(EXCESS: $250)
						@if($insurance_data[0]->reimbursement == 'Yes')
						<span ><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-top:10px;padding-left:5px;"/></span><span style="padding-left:3px;padding-top:10px;">Yes</span>
						@else
						<span  style="padding-top:10px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-top:10px;padding-left:5px;"/></span><span style="padding-left:3px;padding-top:10px;">Yes</span>
						@endif
						@if($insurance_data[0]->reimbursement == 'No')
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>" style="white-space:nowrap;padding-left:1px;padding-top:10px;"/><span style="padding-left:3px;padding-top:10px;">No</span>
						@else
						<img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="white-space:nowrap;padding-left:1px;padding-top:10px;"/><span style="padding-left:3px;padding-top:10px;">No</span>
						@endif
						<span style="font-weight:500">(Please tick)</span>
						</h1>
			<h1 style="font-size:13px;">Declaration</h1>
			<span  style="font-size:10px;">I warrant that the answer given are true and correct and I have not withheld information likely to affect acceptation of this Proposal. I agree that this Proposal of The Overseas Assurance Corporation Limited shall be the basis of the contract between the Corporation and myself and
			further agree to accept the Corporation's policy to the terms,exclusions and conditions thereof.</span>
			<h1 style="font-size:13px;margin-top:5px !important;">Policy Applicaton, Service and Administration</h1>
			<p>Where the policyholder is/are  individual or individuals, by providing the information set out above, I/we agree and consent to Great Eastern, its related corporations(collectively, the 'Companies')as well as their respective representative
			and agents collecting, using disclosing and sharing amongst themselves my/our personal data and disclosing such a personal data to the 'Companies' authorised service providers and relevant and third parties for purchase reasonable required by the Companies to evalaute
			my/our proposal and to provide the product and services which I am/we are applying for (including, without limitation, any policy renewals and policy upgrades, substitutions and replacement).</p>
			<p>These purposes are set out in Great Eastern Privacy's Statements, which is accessible at http://www.greateasternlife.com/sg/en/pncpolicies.htm and which I/we confirm I/we have read and understood.</p>
			<p>Where the policyholder is not individual, we hereby confirm and represent to Great Eastern, its related Corporation(collectively the 'Companies') as well as their respective representatives and agents (Representatives)that the insured individuals of the policy we are
			applying for ("Insured individuals") have agreed and consented to the disclosure of their personal data  to the Companies and Representatives,and further that for the Companies and their Representatives collections, use and/or disclosure of the personal data of the insured individuals, and disclosing such personal data to the 
Companies  authorised service providers and relevant third parties for purposes reasonable required by the Companies to evalaute our proposal and to provide the product and services which are applying for. In respect of the Insured Individual who are subsequently enrolled into the policy that we are 
applying for, we further undertake that we shall ensured the product and each Insured Individual have provide such an agreement and consent in relation to his/her personal data for such purposes.			</p>
<p>These purposes are set out the Great Eastern's Privacy Statement,which is accessible at http://www.greateasternlife.com/sg/en/pncpolicies.htm and which we each of us and the Insured Members have read and understood .</p>
			<table class="table table-bordered" style="width:100%; border: 1px solid black; font-size:9px;margin:0px !important;">
			<tr>
			<td colspan='2' style="padding-left:5px;">
			<h4 align ="center" style="margin:0px 0px; !important;font-size:9px;">LETTER OF INDEMNITY</h4><br/>
			<span style="font-weight:bold;font-size:9px;">IMPORTANT NOTICE:</span><br/><span style="color:#e67300;font-size:9px;"> The Proposer is hereby notified that by virtue of signing of indemnity . It is hereby understood and agreed that a copy of it, either by way of fax or otherwise, shall be deemed binding and legally enforceable in a
			court of law and shall have the same legal effects as that of the original.</span>
			</td>
			</tr>
			<tr><td colspan='2' style="padding-left:5px;">
			<span>To:<span style="padding-left: 35px; font-weight: bold;">The Overseas Assurance Corporation Ltd.</span> </span><br/>
								<p>Dear Sirs,</p>
								<p>COUNTER-INDEMNITY FOR LETTER OF GUARANTEE NO______________________________</p>
								<span>In consideration of The Overseas Assurance Corporation Limited ("the Insurer")whose registered office at 1 Pickering Street, #13-01 Great Eastern Centre,Singapore 048659
								agreeing at the request of the party executing this Counter-Indemnity as the Employer("the Employer") to issue a letter of guarantee ("the Guarantee")in favour of Ministry of Manpower
								("the MOM")for the MOM of S$5,000 only guaranteeing the satisfactory performance and observance  of the conditions imposed on the employer  by the MOM and Security Bond executed 
								by the employer in favour of the MOM. I/we the under-mentioned Employer and Guarantors hereby agree as follows:</span><br/>
								<span>1. I/We hereby guarantee to jointly and severally irrevocably and unconditionally undertake for myself/ourselves my/our theirs executors,administrators assignees and successors to indemnity to
								the insurer in full against at all claims,payments,demands, actions,suits,proceedings,losses and liabilities whatsoever of Guarantee </span><br/>
								<span style="margin:0 !important; padding: 0;">2.I/we agree that the Insurer may in the absolute discretion compromise 
								all claims,payments,demands, actions,suits,proceedings,losses and liabilities whatsoever which may be taken or made against you under the Letter of Guarantee and/or Insurance Bond.</span><br/>
								<span>3. I/We agree to  accept  all the receipts,vouchers,or any other evidence of all payments made by you or 
								all liabilities or obligations incurred by it by reason of the Guarantee as conclusive evidence against me/us and estates of the fact extend of  my/our liability herein Insurer.</span><br/>
							<span>4. I/we hereby agree that the Insurer shall be entitled at any time without prior notice to me/us or the need for my/our consent to assign to any person(including any firm,company and corporation) all are the 
							any part of rights and benefits hereunder and in that events this Counter-Indemnity shall thereafter be read and constructed, and shall have effect, as if assignee was party hereto in the capacity of the Insurer to the infant that such assignee 
							shall have the same rights against me/us as it would have had if assignee had been a party hereto in place of the Insurer and had issued of Guarantee.I/we also agree to pay to the Insurer and demand  all taxes stamps payable in respect of that assignment.</span><br/>
							<span>5. This indemnity shall be governed by and constructed in accordance with the laws of Singapore.</span><br/>
							<span>6. My/Our liability hereunder is irrevocable and shall remain in full force and effect until the Insurer's liability under the Guarantee is discharged and a Insurer has received a letter of 
							Discharge from the Ministry of Manpower.</span><br/>
							<span>In witness where of  I/We have hereinto subscribed my/our name(s)this&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;day of&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;year.</span>
									<table class="table" style="margin-top:5px !important;margin-bottom:0px !important;font-size:8px;">
								<tr>
								<td width='50%' style="vertical-align:top;">
								<div style="border-top:1px dashed #000;padding-top:3px;width:70%"> Witness to the Signature</div>
								Full Name:______________________________<br/>NRIC No.:___________________________<br/>Address:__________________________</td>
								<td width='50%'  style="vertical-align:top;">
								<div style="border-top:1px dashed #000;padding-top:3px;width:70%;padding-right:40px;">The Employer-The first Guarantors</span></div>
								<span style="">Full Name:______________________________________</span><br/></td>
								</tr>
								</table>
								</td></tr>
							
			</table>
</div>	
</body>
</html>
