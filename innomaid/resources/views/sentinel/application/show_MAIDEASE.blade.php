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
    font-size: 12px;
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

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}
#mytst
{
	width:26%;
}

#rotate {
     -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=3);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)"; /* IE8 */
		 }

.table.table-bordered tr td:first-child {
    vertical-align: bottom;
    width: 23px;
}
</style>
<body style="background:white;">
	<div>
	
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//print_r($employer_details);
		?>	
	  <table style="margin-top:0px !important;margin-bottom:0px !important;">
	  <tr><td width='40%' style="vertical-align:top;"><h4>SCANWELL ASSOCIATES PTE LTD</h4><p>11 Keng Cheow Street #01-03<br>The Reverside Pizza Singapore 059608<br>Tel: 64383228 Fax: 64383238<br>Company Registration No:198204728E</p></td>
	  
	  								<td width='60%' style="vertical-align:top-right;padding-left:150px;">
									<img  width = '200px'src="<?php echo $root_path."/img/tenet_logo.jpg";?>" style="margin-left:100px;"/>
<p><span style="font-weight:bold;padding-left:75px;">TENET SOMPO INSURANCE PTE. LTD.</span><br><span style="padding-left:150px;">50 Raffles Place #05-01/06</span><br><span style="padding-left:75px;">Singapore Land Tower Singapore 048623</span><br><span style="padding-left:135px;">Tel: 62212211  Fax: 62213302</span><br><span style="padding-left:107px;">Website: www.tenetsompo.com.sg</span><br><span >Co.Reg.NO. : 198905490E GST Reg NO.:M200903196</span></p></td></tr>
	  </table>
	  <h4 style="text-align: center; border-radius: 0px; background-color: #f2f2f2; padding: 4px 13px 16px; width: 100%;height: 0px;">MAIDEASE INSURANCE PROPSAL FORM (26 MONTHS)</h4>
	
 <table class="table table-bordered" style="margin-top: -10px;margin-bottom:6px ; font-size: 8px;">
		<tr><th style="text-align: left;  padding-left: 5px;">IMPORTANT NOTICE</th></tr>
		<tr><td><p style=" padding-left: 5px;">1. STATEMENT Pursuant to Section 25(5) of the Insurance Act - You are to disclose in this proposal form fully and faithfully all the facts which you know or ought to know otherwise the policy issued hereunder may be void.<br/>
		2. This Insurance is subject to premium being paid and received in fully by the Company before the inception date and the liability of the COmpany will only commence when the Application's accepted and the premium is paid.</p></td></tr>
	  </table>
	  <h4>AGENCY : ________________________________ POLICY NO.: ___________________________________________</h4>

<table class="table table-bordered" style="margin-top: 0 !important; margin-bottom: 0 !important">	  
	
		   <tr><td bgcolor="#f2f2f2 " > 
		   <div id="rotate" style="font-size: 8px;margin-bottom: 20px; width: 23px !important;">PROPOSER/EMPLOYER
		   </div>
		   </td>
	  <td >
	    <table >
	    <tr><td >Name<span style="border-bottom:1px solid #000; padding-right:585px;margin-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</td></tr>
	    <tr><td >Home Address<span style="border-bottom:1px solid #000;padding-right:525px;margin-left:5px;">{{ucfirst($employer_details[0]->address)}}</td></tr>
	    <tr><td > NRIC/FIN NO.<span style="border-bottom:1px solid #000; padding-right:100px;">{{$employer_details[0]->employer_nric_no}}</span>Nationality _________________SB Transmission Ref No<span style="border-bottom:1px solid #000; padding-right:83px;">{{$insurance_data[0]->SB_transmission_number}}</span></td></tr>
		<tr><td>Date of Birth:<span style="border-bottom:1px solid #000; padding-right:20px;"><?php echo date('d/m/Y',strtotime($employer_details[0]->employer_date_of_birth));?></span> Tel:<span style="border-bottom:1px solid #000; padding-right:80px;margin-left:5px;">{{$employer_details[0]->employer_mobile_phone}}</span>(R) _____________(HP) Email _____________________</td> </tr>
	  </table>
	  </td></tr>  
	  
	   <tr><td bgcolor="#f2f2f2"> <div id="rotate" style="font-size: 8px; text-align: center;">DOMESTIC MAID</div></td>
	    <td >
	  <table >
		<tr><td>Name<span style="border-bottom:1px solid #000; padding-right:585px;margin-left:5px;">{{ucfirst($maid_details[0]->name)}}</span></td></tr>
	    <tr><td>Date of Birth<span style="border-bottom:1px solid #000; padding-right:100px;"><?php echo date('d/m/Y', strtotime($maid_details[0]->date_of_birth));?></span> WP No<span style="border-bottom:1px solid #000; padding-right:150px;"><?php if(isset($maid_details[0]->work_permit_no)) 
		echo $maid_details[0]->work_permit_no;
		else
		echo ' ';
		?></span>
		Passport N0.<span style="border-bottom:1px solid #000; padding-right:83px;">{{$maid_details[0]->passport_number}}</span></td></tr>
		<tr><td style="padding-top:10px;">Nationality
		@if($nationality[0]->nationality_name == 'Philippines')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>Filipina</span>
		@else
		<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>Filipina</span>
		@endif
		@if($nationality[0]->nationality_name == 'Indonesian')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>Indonesian</span>
		@else
		<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>Indonesian</span>
		@endif
		@if($nationality[0]->nationality_name == 'Myanmarese')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>Myanmar</span>
		@else
		<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>Myanmar</span>
		@endif
		@if($nationality[0]->nationality_name != 'Indonesian' && $nationality[0]->nationality_name != 'Myanmarese' && $nationality[0]->nationality_name != 'Philippines')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;"/>Others, Please Specify<span style="border-bottom:1px solid #000; padding-right:60px;">{{ucfirst($nationality[0]->nationality_name)}}</span></span>
		@else
		<span style="white-space:nowrap;padding-left:22px;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;"/>Others, Please Specify<span style="border-bottom:1px solid #000; padding-right:60px;"></span></span>
		@endif
		</td></tr>
	  </table></td>
	  </tr>
	  
	    <tr><td bgcolor="#f2f2f2" style="vertical-align:bottom;  border-collapse: collapse; "> <div id="rotate" style="font-size: 8px; text-align: center;"> COVERAGE REQUIRED</div></td>
	  <td  >
	  <table class="tablebordered"style=" border: 1 px solid #000000 margin-top: 0px !important;margin-bottom:0px !important;border-collapse: collapse; border-bottom: 0px !important;border-top: 0px !important;border-left: 0px !important;border-right: 0px !important;font-size: 10px;"  cellspacing='0' cellpadding='0'>
		<tr><td colspan="5" style="padding-top:5px;">From
		@if($insurance_data[0]->start_date)
		<?php echo date('d/m/Y', strtotime($insurance_data[0]->start_date))?>
		@else
		_____/____/____ 
		@endif
		for 26 months or until the cessation of the employment whichever is earlier</td></tr>
		<tr style="background-color: #f2f2f2; font-weight: bold;"><td width="50%" >COVERAGE SELECTION & PREMIUM (inclusive of 7% GST)</td><td style="text-align: center;">Basic</td><td style="text-align: center;">Standard</td><td style="text-align: center;">Prestige</td><td style="text-align: center;">Prestige Plus</td></tr>
		<tr><td style="padding-top:5px;">(a) Insurance+ Letter of Guarantee</td>
		<td style="padding-top:5px;">
		
		@if($insurance_data[0]->plan == 'S$246.10 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@endif</td>
		<td style="padding-top:5px;">@if($insurance_data[0]->plan == 'S$267.80 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$267.80</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$267.80</span>
			@endif</td> 
			<td style="padding-top:5px;">@if($insurance_data[0]->plan == 'S$301.00 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$301.00</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$301.00</span>
			@endif</td> 
			<td style="padding-top:5px;">
			@if($insurance_data[0]->plan == 'S$320.00 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$320.00</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$320.00</span>
			@endif</td>
			</tr>
		<tr><td style="padding-top:5px;">(b) Insurance + Letter of Guarantee+ Waiver of Counter Indemnity</td>
		<td style="padding-top:5px;">
		@if($insurance_data[0]->plan == 'S$299.60 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@endif</td>
			<td style="padding-top:5px;">@if($insurance_data[0]->plan == 'S$321.30 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@endif</td> 
			<td style="padding-top:5px;">
			@if($insurance_data[0]->plan == 'S$354.50 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@endif</td> 
			<td style="padding-top:5px;">
			@if($insurance_data[0]->plan == 'S$373.50 MAIDEASE')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$246.10</span>
			@endif</td></tr>
		<tr><td colspan="1" style="padding-top:5px;font-weight:bold;background-color: #f2f2f2;">OPTIONAL COVER & PREMIUM(inclusive of 7% GST)</td>
		<td colspan="2" style="text-align:center;font-weight:bold;">
		@if($insurance_data[0]->plan == '$2,000')
			<span> S$2,000 Guarantee</span>
			@else
			<span> S$2,000 Guarantee</span>
			@endif</td> 
			<td colspan="2" style="padding-top:5px;text-align:center;font-weight:bold">
			@if($insurance_data[0]->plan == '$7,000')
			<span>S$7,000 Guarantee</span>
			@else
			<span>S$7,000 Guarantee</span>
			@endif</td></tr>
		<tr><td colspan="1" style="padding-top:5px;font-weight:bold;">letter of Guarantee to the P.O.L.O.</td> 
		<td colspan="2" style="padding-top:5px;text-align:center;">@if($insurance_data[0]->premium == 'S$35.31')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$35.31</span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px;margin-top:2px;"/>S$35.31</span>
			@endif</td> 
			<td colspan="2" style="padding-top:5px;text-align:center;">
			@if($insurance_data[0]->premium == 'S$74.90')
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:25px;margin-top:2px;"><span>S$74.90</span></span>
			@else
			<span style="white-space:nowrap;padding-left:22px;"><img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:25px; margin-top:2px;"><span>S$74.90</span></span>
			@endif</td></tr>
	  </table></td></tr>
	  
	  
	  <tr><td bgcolor="#f2f2f2" style="vertical-align:bottom;border-collapse: collapse; ">
	  <div id="rotate" style="font-size: 8px; ">BASIS OF PROPOSAL & COUNTER INDEMNITY</div></td>
	   <td >
		<table style="font-size: 7px; margin-top: 0px !important;margin-bottom:0px !important;">
		  <tr>
			<td >
			<p>I/We submit herewith my/our application for the selected coverage to be issued in connection with my/our employment of a domestic maid and hereby declare that as the above particulars are true and correct.This proposal shall be the part of the contract between me/us and Tenet Sompo insurance pte. Ltd. (here in after refered to as "the company")
			<br/>In consideration of TENET INSURANCE COMPANY LTD (hereinafter referred to as Tenet Insurance? agreeing at my/our request to provide letter of Guarantee as security for the due and satisfactory performance of all conditions under the Insurance Guarantee for the sum of Singapore Dollars Five
Thousand only (S$5,000) to the MINISTRY OF MANPOWER OF SINGAPORE provided under Section 11 of the Policy for Compliance of Visit Pass
Holder, as named in the Guarantee, of all conditions under section 12 of Employment of Foreign Manpower ( Work Passes ) Regulations or section 21
of Immigration Regulations.
<br/>I/We hereby agree and undertake as follows:
<br/>1. to jointly and severally indemnify Tenet Insurance on demand in full against all claims payments demands actions suits proceedings losses liabilities costs interests and expenses whatsoever which may be taken or made against them or incurred or become payable by them under the liability or obligations of the Guarantee.
<br/>2. that the Company may in this absolute discretion compromise all claims payment demands actions suits proceedings losses liablities which may be taken or made against them under the guarantee, and to accept all receipt vouchers and other evidence of all payments made by the company or of all liablities or obligations incurred by them by reason of the Guarantee as conclusive evidence against me/us and my/our estate of the fact and extent of my/our liablity herein.
<br/>3. notwithstanding the above, I/we further agree to pay the Company interest based on the rate of 6% per annum on all sums paid by them under the Gurantee calculated from the date when payment was made until the date when I/we reimburse them and to pay on an Indemnity Basis, all costs incurred by the Company in the course of pursuing legal proceedings to enforce their rights under this indemnity against me/us.

<br/>4. that the indemnity shall be a continuing indemnity and the Company may at any time or times discretion without giving any notice to me/us extend the validity of the Guarantee without discharging or impairing my/our liablity under this indemnity.
<br/>5. that no delay or omission on the part of the Company in exercising any right,power, privilege or remedy in respect of this indemnity shall impair such right,power,peivilege or remedy . The rights,powers,privileges and remedies providede in this indemnity are cumulaive and not exclusive of any rights,powers,privileges and remedies provided by law.
<br/>6. that this indemnity shall be governed and construde by the laws of the Republic of Singapore and I/we irrevocably submit to the jurisdiction of the Courts of the Republic of Singapore.
<br/>7. that the Company may collect,use,sidclose and/or process my/our personal data in accordance with the Personal Data Protection Act 2012 as described in the Company's Privacy Policy, which can be found at www.tenetsompo.com.sg. I represent that I have obtained the consent of the individual(s) in the policy.
<br/>to abide by the terms,conditions and exclusions and confirm that information given in this form is true and complete.
</p>IN WITNESS WHERE OF I/We have hereto subscribed my/our name(s)this__________day of___________20____________.
			<table class="table" style='margin:0px;'>
			<tr><td width='50%' style="vertical-align:top;float: left;">_______________________________________________<br/> Witnessed/Verified by <br/><br/>Name___________________________________________</td>
			
			<td width='50%' style="vertical-align:top; float: right;">___________________________________________________<br/>Signature of indemnifier(Proposer/Employer)<br><br/>Name_____________________________________</td></tr>
			</table>

	   </td></tr>
	</table></td></tr>
	 
</table>	  

	</div>		
</body>
</html>

