
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

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}

.page-break {
    page-break-after: always;
}
.table.table-bordered.notbold tr td
{
	height:30px;
}
.table.table-bordered.mytst tr td
{
	height:20px;
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
									<img  width = '150px' src="<?php echo $root_path."/img/ecics.png";?>"/>
								</td>
								<td >
									<span style="font-weight:bold;font-size:18px;padding-left:95px;">MAIDAssure PROPOSAL FORM</span><br/><br/>								
									<span style="font-weight:bold;font-size:16px;padding-left:120px;">Application: New / Renewal</span>
								</td>
								</tr>
								<tr>
								<td width='150px'>
								<span style="padding-left:65px;">7 Temasek Boulevard, #10-01 Suntec Tower One,Singapore 038987</span><br/>
								<span style="padding-left:65px;white-space:nowrap;">Tel: 63374779  Fax: 63386951 (Company Registration N0. 19890130C)</span>
								</td>
								</tr>
								</table>
		<div style="border:1px solid #000;font-weight:bold;margin:0px !important; padding:0px !important;">
		<span style=" padding-left: 5px;">1. Pursuant to Section 25(5) of the Insurance Act - You are to disclose in this proposal form fully and faithfully all the facts which you know or ought to know in respect of risk that is being proposed; otherwise the policy issued hereunder may be void.</span><br/><br/>
		<span style=" padding-left: 5px;">2. Please note that this insurance is subject to the premium being paid and received in full by the Company before the inception data, falling which there will be no liability under this cover. </span><br/><br/>
		<span style=" padding-left: 5px;">3. The liability of Company does not commence until this Application is accepted and the premium paid in accordance  with Clause 2 above. </span>
		</div>
			<table class="table table-bordered notbold" style="margin-top:0px !important;margin-bottom:0px !important;" >
				 <tr>
		   <th colspan = '3'style="text-align:left;padding-left:5px;font-size:14px;">A.<span style="padding-left:5px;"> PROPOSER'S(EMPLOYER) PARTICULARS</span></th></tr>
				<tr>
					<td >
					<span style="padding-left:5px;">Name of Proposer(Employer)<br/>(Mr/Mrs/Miss/Mdm/Dr)</span>
					<span style="padding-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
					</td>
				  <td >
					<span style="padding-left:5px;">Passport/NRIC No.</span>
					<span style="padding-left:5px;">{{$employer_details[0]->employer_passport}}/{{$employer_details[0]->employer_nric_no}}</span>
					</td>
					<td>
					<span style="padding-left:5px;">Nationality</span></td>
				  </tr>
				  <tr>
					<td >
					<span style="padding-left:5px;">Home Address</span>
					<span style="padding-left:5px;">{{ucfirst($employer_details[0]->address)}}</span>
					</td>
					<td colspan='2'>
					<span style="padding-left:5px;">Tel No.</span>
					<span style="margin-left:5px;border-bottom:1px solid #000;">{{$employer_details[0]->employer_mobile_phone}}</span>(Home/Mobile)<br/>
					<span style="margin-left:45px;border-bottom:1px solid #000;">{{$employer_details[0]->employer_office_phone}}</span>(Office)
					</td>
				  </tr>
				
			</table>
		
			<table class="table table-bordered notbold" style="margin-top:5px !important;margin-bottom:0px !important;border-spacing:0px 0px !important;"cellspacing='0' cellpadding='0'>
				  <tr>
					<th colspan='3' style="text-align:left;padding-left:5px;font-size:14px;">B.<span style="padding-left:5px;"> MAID'S PARTICULARS</span></th>
				  </tr>
				  <tr>
					<td>
							<span style="padding-left:5px;">SB Transmission No.</span>
							<span style = "padding-right:140px;">{{$insurance_data[0]->SB_transmission_number }}</span>
					</td>
					<td>
					<span style="padding-left:5px;">Nationality</span>
					<span style="padding-left:5px;">{{ucfirst($nationality[0]->nationality_name)}}</span>
					</td>

					<td rowspan='3'>
					<span style="padding-left:5px;">The period of Insurance(dd/mm/yyyy)</span><br/>
						<span style="padding-left:5px;">From<span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->start_date));?></span><br/> <span style="padding-left:5px;">to	</span><span style="padding-left:5px;"><?php echo date('d/m/Y',strtotime($insurance_data[0]->end_date));?></span><br/>
						<span  style="padding-left:5px;">(26 months)</span></span>
					</td>
					
				 
				
				  </tr>
				  <tr>
					<td>
					<span style="padding-left:5px;">Name of Maid</span>
					<span style="padding-left:5px;">{{ucfirst($maid_details[0]->name)}}</span>
					</td>
					<td rowspan='2'>
					<span style="padding-left:5px;">Passport No<span>
					<span style="padding-left:5px;">{{$maid_details[0]->passport_number}}</span>
				</td>	
				  </tr>
				  <tr>
					<td >
					<span style="padding-left:5px;">Work Permit No.</span>
				<?php if(isset($maid_details[0]->work_permit_no)) 
					echo $maid_details[0]->work_permit_no;?>
					</td>
										
				  </tr>
			
			</table>
			<table class='table' style="margin-top: 5px !important;margin-bottom:0px !important;">
				<tr>
				<td width='50%' >
				<table class="table table-bordered mytst" style="margin-top: 0px !important;margin-bottom:0px !important;width:360px;">
				<tr>
					<th colspan='2' style="text-align:left;padding-left:5px;font-size:12px;height:20px;">C.<span style="padding-left:5px;">COST OF PREMIUM-26 Months Policy <br/><span style="font-weight:500;padding-left:15px;"> Prices are inclusive of GST</span></th>
				  </tr>
				  <tr>
					<td >
							<span style="padding-left:5px;font-weight:bold;">Classic Plan</span>
						</td>
						<td >
						@if($insurance_data[0]->plan == '$240.75 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$240.75</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$240.75</span>
						@endif
						</td>
				  </tr>
				  <tr>
					<td>
					<span style="font-weight:bold;padding-left:5px;">Deluxe Plan</span>
					</td>
						<td >
						@if($insurance_data[0]->plan == '$256.80 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$256.80</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$256.80</span>
						@endif
						</td>	
				  </tr>
				    <tr>
					<td>
					<span style="font-weight:bold;padding-left:5px;">Exclusive Plan</span>
					</td>
						<td >
						@if($insurance_data[0]->plan == '$294.25 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$294.25</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$294.25</span>
						@endif
						</td>	
				  </tr>
					<tr>
					<td >
					<span style="font-weight:bold;padding-left:5px;">Waiver of Counter Indemnity</span>
					</td>
					<td >
						@if($insurance_data[0]->plan == '$53.50 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$53.50</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$53.50</span>
						@endif
						</td>
				  </tr>
				  <tr>
					<td >
					<span style="font-weight:bold;padding-left:5px;">2 K Philippines Bond</span><br/>
					</td>
					<td >
						@if($insurance_data[0]->plan == '$42.80 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$42.80</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$42.80</span>
						@endif
						</td>
				  </tr>
			
			</table>
			</td>
	
				<td  width='50%'>
				<table class="table table-bordered mytst" style="margin-top: 0px !important;margin-bottom:0px !important;width:360px;margin-left:40px;">
				<tr>
					<th colspan='2' style="text-align:left;padding-left:5px;font-size:12px;height:20px;">COST OF PREMIUM-14 Months(for renewal only) <br/><span style="font-weight:500;"> Prices are inclusive of GST</span></th>
				  </tr>
				  <tr>
					<td>
							<span style="padding-left:5px;font-weight:bold;">Classic Plan</span>
						</td>
						<td >
						@if($insurance_data[0]->plan_renewal == '$160.50 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$160.50</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$160.50</span>
						@endif
						</td>
				  </tr>
				  <tr>
					<td >
					<span style="font-weight:bold;padding-left:5px;">Deluxe Plan</span>
					</td>
					<td >
						@if($insurance_data[0]->plan_renewal == '$165.85 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$165.85</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$165.85</span>
						@endif
						</td>		
				  </tr>
					  <tr>
					<td >
					<span style="font-weight:bold;padding-left:5px;">Exclusive Plan</span>
					</td>
					<td >
						@if($insurance_data[0]->plan_renewal == '$192.60 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$192.60</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$192.60</span>
						@endif
						</td>		
				  </tr>
		
					<tr>
					<td>
					<span style="font-weight:bold;padding-left:5px;">Waiver of Counter Indemnity</span>
					</td>
					<td >
						@if($insurance_data[0]->plan_renewal == '$32.10 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$32.10</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$32.10</span>
						@endif
						</td>
				  </tr>
				    <tr>
					<td >
					<span style="font-weight:bold;padding-left:5px;">2 K Philippines Bond</span><br/>
					</td>
					<td >
						@if($insurance_data[0]->plan_renewal == '$42.80 Ecics')
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$42.80</span>
						@else
							<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="padding-left:10px;"/><span style="padding-left:5px;">$42.80</span>
						@endif
						</td>
				  </tr>
			
		
			</table>
			</td>
			</tr>
			</table>
		<h4 style="font-size:15px;">
		Counter Indemnity Form
	  <span style="margin-top: 0px;font-size:12px;">(in respect of Security Bond issued to MOM of Singapore)</span></h4>
	  			<span style="font-weight:bold;margin-top:10px;">IMPORTANT NOTICE</span>- The Proposer/Employer is hereby notified that by virtue of signing this Counter-Indemnity Form, it is hereby understood and agreed that a copy of it.<br/>

			<p><span style="font-weight:bold;padding-top:20px;">To:<span style="padding-left: 35px; font-weight: bold;">ECICS Limited</span> </span><br/>
							    <span style="padding-left: 53px;">7 Temasek Boulevard, #10-01 Suntec Tower One,Singapore 038987</span><br/></p>
								<p>Dear Sir,</p>
								<p>In consideration of <span style="font-weight:bold;">ECICS Limited</span>("the Insurer") agreeing at my/our request to issue a Security Bond(the "Security Bond") in favour of the
								Ministry of Manpower ("the MOM") guaranteeing payment on demand of any sums not exceeding in total Singapore Dollars Five Thousand (S$5,000) in lieu of the cash deposit of Singapore Dollars Five Thousand (S$5,000) that the Employer would otherwise have to provide as 
								security under the Security Bond executed by the Employer in favour of the MOM for the grant of an entry pass to(name of maid)
								</p>
								<p>I/We hereby jointly and severally irrevocably and unconditionally agree and undertake
						for myself/ourselves and my/our heirs executors administrators assigns and successors that</p>
					<span>1.  As a continuing obligation I/We shall indemnity and keep 
						indemnified the Insurer from and against all claims,demands,payments,actions,suits,proceedings,
						losses,expenses including legal costs on an indemnity basis and all other liabilities of whatsoever
						nature or description which may be or taken against or incurred by the Insurer in relation to 
						or arising out of the Security Bond and/or Counter Indemnity.</span><br/>
						<span>2.  Where any request is made upon the Insurer by the MOM for payment of any sum of money pursuant to the Security Bond,("such request")
							the Insurer shall at its absolute discretion be at liberty to contest at compromise or immediately pay upon such request and such request 
							shall be sufficient authority to the Insurer for making any payment thereon without requiring or obtaining any evidence or proof that the amount so 
							claimed or requested is due payable to the MOM and without any notice or reference to or further authority from me/us notwithstanding that I/We may
							dispute the validity at any such claim or request.
						</span><br/>
						<span>3.  I/We shall not at any time question or challenge the validity legality or otherwise of any payment made by the Insurer to the MOM pursuant to such
						request or deny any liability under this Counter-Indemnity on the ground that such payment or any part thereof made by the Insurer was not due or payable 
						under the MOM or on any other ground whatsoever.
						</span><br/>
						<span>4.  I/We shall not be discharged or released from the Indemnity by any compromise, variation or arrangement made between the MOM and the Insurer in 
						relation to the obligations undertaken by the Insurer under the Section Bond or by any forbearance whether as to payment,time,performance or otherwise given by the Controller to the Insurer.</span><br/>	
						<span>5. My/Our liability herein is irrevocable and shall remain in full force and effect until the Insurer's liability under the Security Bond is fully discharged to the Insurer's satisfaction.</span><br/>
						<span>6. This Counter-Indemnity shall be governed by and constructed in accordance with the laws of Singapore.</span><br/>
						<span>7.I/We agreed that copy of this letter of indemnity, either by way of fax or otherwise, shall be deemed binding and legally enforceable  in a court of law and shall have the same legal effects as that of the original.</span>
						<p>In addition, we acknowledge that we have read Personal  Data Protection Consent Form and agree to the terms and conditions.</p>
						<p>We also acknowledge that we agree that any pre-existing conditions are not covered under this policy.</p>
						<p>IN WITNESS WHEREOF I/we have hereto subscribed my/our name(s) this day of year.</p>
								<table class="table" style="margin-top:0px !important;margin-bottom:0px !important;">
								<tr>
								<td width='50%' style="vertical-align:top;">
								<div style="border-top:1px dashed #000;padding-top:3px;width:70%">Signature of Proposer/Employer</div>Full Name:______________________________<br/>NRIC No.:___________________________<br/>
								<td width='50%'  style="vertical-align:top;">
								<div style="border-top:1px dashed #000;padding-top:3px;width:70%;padding-right:40px;">Signature of Witness</span></div>
								Full Name:______________________________<br/>NRIC No.:___________________________<br/></td>
								</tr>
								</table>
		</div>
</body>
</html>		
