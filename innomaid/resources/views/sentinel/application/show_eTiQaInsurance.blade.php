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
}
.h3, h3 {
    font-size: 10px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 20px;
    margin-top: 30px;
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
	font-size:12px;
		line-height:1.5;

	
}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}
#mytst
{
	width:26%;
}
.align
{
width:33.33px;
}
#wid 
{
width:70%;
}
#bgcol
{
	background-color:#ffd11a;
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
<table class = "table" style="margin:0px 0px !important;">
					<tr>
					<td style=""width='50%'>
							<img src="<?php echo $root_path."/img/etiqa_logo1.png";?>" width='200px'/>
						</td>
						<td style="vertical-align:top;">
						<span>Arranged by:</span>
					</td>
					<td style="vertical-align:top;"><span><img src="<?php echo $root_path."/img/logo_small.png";?>"width='30px'  height='50px' >
							
							Wah Hong Ensure Pte Ltd<br/>
							<span>38 Toh Guan Road East #01-57</span><br/>
							<span>Enterprise Hub, Singapore 608581</span><br/>
							<span >Tel: 6515 5988 Fax: 6896 6321</span><br/>
							<span >Email: enquiry@wahhong.sg</span>
						</span>
						</td>
					</tr>
			</table>
	
			<span style="text-align: center;padding-top:5px;margin-top:0px !important;margin-bottom: 5px !important;display:inline-block; border:1px solid #000;font-weight:bold;background-color:#ffd11a;height:18px;">DOMESTIC MAID INSURANCE APPLICATION FORM</span><br/>
	<span style="font-weight:bold;">Important Notice</span><br/>
	<span>
	Statement Pursuant to section 25(s) of the Insurance Act.(Cap 142) . You are to disclose in the proposal ,form fully and faithfully all the facts which you know or ought to know,
	otherwise the policy issued hereunder may be void.This Insurance will not be in force until the proposal has been accepted by the Company.This Proposal is not a contract of insurance.
	Please refer to the policy(which will be issued to you upon acceptance of your application and payment of the premium)for its exclusions and complete details of coverage.
	</span><br/>
				<table class = "table table-bordered" style="margin:0px 0px;!important;"cellspacing = '0' cellpadding='0'>
					<tbody >
					<tr>
						<th colspan='3' style="background-color:#ffd11a;text-align:left;">1. PARTICULARS OF THE EMPLOYER / PROPOSER </th>
					</tr>
					<tr>
						<td style="left" colspan='1' width='45%' style="font-size:10px;">
						<span style="padding-left:5px;font-weight:bold;font-size:10px;">NAME :</span>
							<span style=""><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
						</td>
						<td colspan='2' style="font-size:10px;">
						<span style="padding-left:5px;font-weight:bold;">EMAIL:</span>
						</td>
					</tr>
					<tr>
						<td rowspan = '2' style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">MAILING ADDRESS:</span>
							<span style="">{{ucfirst($employer_details[0]->address)}}</span>
						
						</td>
						
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">NATIONALITY:</span>
							<span style="">&nbsp;</span>
						</td>
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">DATE OF BIRTH:</span><span style=""><?php echo date('d/m/Y',strtotime($employer_details[0]->employer_date_of_birth));?></span>
						</td>
					</tr>
					<tr>
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">NRIC / FIN NO:</span>
							<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</span>
						</td>
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">SEX:</span><span style=""></span></span>
						</td>
					</tr>
					</tbody>
					<tbody >
					<tr>
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">SB TRANSMISSION REF NO:</span>
							<span style = "">{{$insurance_data[0]->SB_transmission_number }}</span>
						</td>
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">OCCUPATION:</span>
							<span style="white-space:nowrap;">{{ucfirst($employer_details[0]->employer_profession)}}</span>
						</td>
						<td style="font-size:10px;" >
							<span style="padding-left:5px;font-weight:bold;;">MARITAL STATUS:</span><span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->marital_status)}}</span></span>
						</td>
					</tr>
					</tbody>
					<tbody>
					<tr>

						<td style="font-size:10px;" colspan='3'>
							<span style="padding-left:5px;font-weight:bold">TEL NO:(H)<span style="font-weight:500">	{{$employer_details[0]->employer_mobile_phone}}</span></span>

							<span style="padding-left:100px;font-weight:bold">(o)<span style="font-weight:500"></span></span>
					
							<span style="padding-left:100px;font-weight:bold">(HP)<span style="font-weight:500">&nbsp;</span></span>
						</td>
					</tr>
					</tbody>
					<tr>
					<td colspan='3'>
					<table class="table table-bordered" style="margin:0px 0px;!important;border-bottom:0px ;border-left:0px;border-right:0px ;border-top:0px; " cellspacing = '0' cellpadding='0'>
					<tbody>
					<tr>
						<th colspan='2'  style="background-color:#ffd11a;text-align:left;">2. PARTICULARS OF THE MAID / INSURED MAID </th>
					</tr>			
					<tr>
						<td colspan='2'style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">NAME:</span>
							<span style="">{{ucfirst($maid_details[0]->name)}}</span>
						
						
						</td>
					</tr>
					<tr>
					<td style="font-size:10px;"><span style="padding-left:5px;font-weight:bold;">PASSPORT NO:</span>
						<span style="">{{$maid_details[0]->passport_number}}</span>	
						</td>
							<td style="font-size:10px;"><span style="padding-left:5px;font-weight:bold;">NATIONALITY:</span>
							<span style="">{{ucfirst($nationality[0]->nationality_name)}}</span>
							</td>
					</tr>
					<tr>
						<td style="font-size:10px;">
							<span style="padding-left:5px;font-weight:bold;">DATE OF BIRTH:</span>
							<span style=""><?php echo date('d/m/Y',strtotime($maid_details[0]->date_of_birth));?></span>

							</td>
							<td style="font-size:10px;" >
							<span style="padding-left:5px;font-weight:bold;">WORK PERMIT NO:</span>
							<span style="">
							<?php if(isset($maid_details[0]->work_permit_no)) 
					echo $maid_details[0]->work_permit_no;?></span>
					</td>
					</tr>
					</tbody>
					</table>
					</td>
					</tr>
					<tbody>
					<tr>
						<th colspan='3'  style="background-color:#ffd11a;text-align:left;">3.  PERIOD OF INSURANCE:</th>
					</tr>
					
					<tr>
						<td colspan='3' style="padding-left:5px;font-weight:bold;font-size:10px;">FROM:@if($insurance_data[0]->start_date!='' && $insurance_data[0]->start_date!='0000-00-00')
						{{ $insurance_data[0]->start_date }}
						@else
						&nbsp;
						@endif
						</span> <span style="font-weight:500;">TO:<span style="200px;margin-left:5px;">
						@if($insurance_data[0]->end_date!='' && $insurance_data[0]->end_date!='0000-00-00')
						{{ $insurance_data[0]->end_date }}
						@else
						&nbsp;
						@endif
						</span></span><span style="font-weight:500;">FOR 26 MONTHS</span></td>
					</tr>
					</tbody>
					<tr>
					<td colspan='3'>
					<table class="table table-bordered" style="margin:0px 0px;!important;border-bottom:0px ;border-left:0px;border-right:0px ;border-top:0px; " cellspacing = '0' cellpadding='0'>
					<tbody>
					<tr>
						<th width='50%'  style="background-color:#ffd11a;text-align:left;font-weight:bold;">4.  COVERAGE REQUIRED WITH GST(PLEASE TICK):</th>
						<th  style="background-color:#ffd11a;font-weight:bold;">PLAN A</th>
						<th  style="background-color:#ffd11a;font-weight:bold;">PLAN B</th>
						<th  style="background-color:#ffd11a;font-weight:bold;">PLAN C</th>
						<th  style="background-color:#ffd11a;font-weight:bold;">PLAN D</th>
					</tr>
					
					<tr>
						<td style="padding-left:5px;font-weight:bold;font-size:10px;">
						a) INSURANCE BENEFITS + LETTER OF GUARANTEE(S$5,000)
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$246.10 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$246.10
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="margin-left:5px;margin-top:2px;">S$246.10
						@endif
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$267.50 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$267.50
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="margin-left:5px;margin-top:2px;">S$267.50
						@endif
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$299.60 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$299.60
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="margin-left:5px;margin-top:2px;">S$299.60
						@endif
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$376.50 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$374.50
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="margin-left:5px;margin-top:2px;">S$374.50
						@endif
						</td>
					</tr>
					<tr>
						<td style="padding-left:5px;font-weight:bold;font-size:10px;">
						b) INSURANCE BENEFITS + LETTER OF GUARANTEE(S$5,000)<br/><span style="padding-left:15px;"> + REIMBURSEMENT OF INDEMNITY</span>
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$299.60 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$299.60
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="margin-left:5px;margin-top:2px;">S$299.60
						@endif
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$321.00 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$321.00
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="margin-left:5px;margin-top:2px;">S$321.00
						@endif
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$353.10 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$353.10
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="margin-left:5px;margin-top:2px;">S$353.10
						@endif
						</td>
						<td style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->plan  == 'S$428.00 eTiQa')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;">S$428.00
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"style="margin-left:5px;margin-top:2px;">S$428.00
						@endif
						</td>
					
					</tr>
					<tr>
						<th colspan="1"  style="background-color:#ffd11a;text-align:left;">5. OPTIONAL COVER / ADDITIONAL PREMIUM WITH GST(PLEASE TICK):</th>
						<th  style="background-color:#ffd11a;font-weight:bold;"colspan='2'>SUM INSURED:S$2,000.00</th>
						<th  style="background-color:#ffd11a;font-weight:bold;"colspan='2'>SUM INSURED:S$7,000.00</th>
					</tr>
					<tr>
						<td colspan="1" style="padding-left:5px;font-weight:bold;font-size:10px;">LETTER OF GUARANTEE TO PHILIPPINES WITH EMBASSY</td>
						<td colspan='2' style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->premium == 'S$48.15')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>"style="margin-left:5px;margin-top:2px;"><span style="white-space:nowrap;padding-left:5px;">S$48.15</span></td>
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="margin-left:5px;margin-top:2px;"> <span style="white-space:nowrap;padding-left:5px;"/>S$48.15</span>
						@endif
						<td colspan='2' style="padding-left:5px;font-size:10px;">
						@if($insurance_data[0]->premium == 'S$80.25')
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/cheked.jpg";?>" style="margin-left:5px;margin-top:2px;"><span style="white-space:nowrap;padding-left:5px;">S$80.25</span></td>
						@else
						<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>" style="margin-left:5px;margin-top:2px;"> <span style="white-space:nowrap;padding-left:5px;"/>S$80.25</span>
						@endif
						</td>
					</tr>
					</tbody>
					</table>
					</td>
					</tr>
			</table>
			<table class = "table table-bordered" style="margin-top:5px !important;font-size:10px; ">
					<tr>
						<th style="padding-left:5px;"style="background-color:#ffd11a" id='bgcol'>
							DECLARATION AND UNDERTAKING
						</th>
					</tr>
					<tr>
						<td style="padding-left:5px;">
						<h1 style="font-size:13px;font-weight:bold;margin-top: 0px;margin-bottom:15px;">IMPORTANT NOTICE</h1>
						<span style="padding-top:5px;">The Proposer is hereby notified that by virue of signing this letter of declaration and undertaking. it is hereby understood and agreed that a company of it,either by way of fax or otherwise shall be deemed
							binding and legally enforceable in a count of law and shall have the same legal effects as that of the original</span><br/>
						<span style="font-weight:bold;">To:Etiqa Insurance Berhad 1</span><span>North Bridge Road #08-o1  High Street Centre,Singapore 179094 </span><br/>
								<span>I/We hereby declare that the answers and statements given above are true and complete, and that I/We have not withheld any material information.</span><br/>
						<span>This Proposal and any Guarantee issued pursuant to this Proposal shall be the Counter Indemnity set forth below to which terms and conditions I/We agree</span><br/>
							<table class = "table" style="margin-top:10px !important;margin-bottom:0px !important;">
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
										<span style="">Full Name:</span><span style="">{{$employer_details[0]->employer_name}}</span>
									</td>
								</tr>
								</table>
								
									<span>TERMS AND CONDITIONS OF COUNTER INDEMNITY FOR LETTER OF GURANTEE NO._________________________________</span><br/>
						<span>In consideration of ERGO Insurance Pte. Ltd.("the Insurer") agreeing at my/our request to issue:
						a) A letter of Guarantee for the sum of Singapore Dollars Five Thousand Only S$5,000) to the
						Ministry of Manpower, Singapore as security for the duty and satisfactory observance for all conditionals under the Security Bond  and /or .</span><br/>
						<span>b) (if applicable) A letter of Guarantee for the sum of Singapore Dollars(Two/ Seven Thousand)* only (S$2,000/S$7,000)* to the Labour attached
						(the Labatt),Embassy of Philippines for Compliance of the Standard Employment contract for Filipino Household Workers in Singapore.						
						</span><br/>
							<span>I/We hereby jointly and serverally irrevocobly and unconditionally agree and undertake
						for myself ourselves and my/our heirs, executors, administrators, assigns and successors that</span><br/>
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
						<span>5. My/Our liabalility herein is irrevocable and shall remain in full force and effect until the Insurer's liabiilty under the Guarantee is fully discharged to the Insurere's satisfaction.</span><br/>
						<span>6. This indemnity shall be governed by and constructed in accordance with the laws of Singapore.</span>
								</td></tr>
							
			</table>
						
</div>	
</body>
</html>
