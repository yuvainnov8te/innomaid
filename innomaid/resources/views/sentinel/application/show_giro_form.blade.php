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
    color: #333;
    font-size: 10px;
	font-family:"Arial",Helvetica Neue,Helvetica,sans-serif;
	}
.h3, h3 {
    font-size: 20px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 30px;
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
    font-size: 20px;
    font-style: italic;
    font-weight: bold;
    text-align: center;
}
.td { }
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
	font-size:10px;
	}
.table {
    margin-bottom: 10px;
	margin-top:25px;
    max-width: 100%;
    width: 100%;
	font-size:10px;
	}
.table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
   margin-left:10px;
   border: 1px solid #000;
	line-height:1;
}

.table > thead > tr > th
{
	font-size:10px;
}
.table > thead > tr > th > p
{
	font-weight:500px;
}

p{
	font-size:10px;
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
.table-bordered {
    border-collapse: collapse;
}
td{ border: none;}
.back{
background-color:#DDDDDD ;
}
.rotate {
/* Safari */
-webkit-transform: rotate(-180deg);

/* Firefox */
-moz-transform: rotate(-180deg);

/* IE */
-ms-transform: rotate(-180deg);

/* Opera */
-o-transform: rotate(-180deg);

/* Internet Explorer */
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

}
.set_align
{

}
</style>
<body style="background:white;">
		<div class="container-fluid">
		<div>
			<table class = "table" style="margin-top:0px !important;" height="5%">
				<tr height="100px">
					<td style="padding:0; height:70px">
						<img style = "width:100px;"src='<?php echo $root_path."/img/mom-logo.png";?>'/>
					</td>
					<td style="padding:0; height:70px">
						<p style="text-align:right;padding-left:30px;">
						<span style="font-weight:bold;white-space:nowrap;">Central Provident Fund Board</span><br/>
						<span style="white-space:nowrap;">79 Robinson Road, CPF Building Singapore 068897</span><br/>
						<span style="white-space:nowrap;">Website:www.cpf.gov.sg CPF Call Centre:1800-227-1188</span>
						</p>
					</td>
					<td style="padding:0; height:70px">
						<img style = "width:100px;padding-left:20px;"src='<?php echo $root_path."/img/girologo.jpg";?>'/>
					</td>
				</tr>
			</table>			
			</div>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				
				if($maid_giro_form){
			$rejected_by = explode(';', $maid_giro_form[0]->rejected_by);
			}
			else{$rejected_by=array();
				} //print_r($employer_details);
		?>
		<h1> Application For Inter-Bank GIRO(Foreign Worker Levy Payment</h1>
		<p class="back" style="width:100% !important; margin-bottom:1px;margin-top:1px"> PART 1: For Applicant's Completion ( please complete all required details ( marked =>)</p>
		<table class="table table-bordered1"style="margin-top:0px !important;">
		<tr><td colspan="2">
			<p style="margin:0px">Notes</p> 
			<ul style=" padding-left:30px; margin:0px">
			<li> Please read overleaf "Information on Application for Inter-Bank GIRO" before filling in the form</li>
			<li> Do not fax this form to CPF Board as the bank requires original signature(s) for verification. </li>
			<li> Incomplete details or illegible handwriting on the form will delay the processing of the application.</li>
			<li> Amendments made on the form must be countersigned by the bank account holder. Use of correction fluid/tape is not allowed</li>
			</ul>
		</td>
		</tr>
		<tr>
		<td style="padding-bottom:18px; width:60%">Date:</td>
		<td style="padding-bottom:18px; width:40%">Name of Billing Organisation(BO):</td>
		</tr>
		<tr><td colspan="2" style="padding-bottom:20px"> Name of Employer (Business/Company/Entity/Individual): 
		</td></tr>
		<tr><td colspan="2">Type(s) of payment ( Please  <img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> where application)</td></tr>
		<tr> <td> For Business/Company/other UEN registered entity <br><table ><tr><td width="200px"rowspan="4">
		<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> 1. <b>Business </b>Foreign Worker Levy </td></tr>
		<tr><td> Unique Entity Number (UEN): </td></tr><tr><td><table class="table table-bordered1"style="margin:0px !important; width:200px !important;"><tr><td height="17px"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table>
		</td><tr><td > E.g. 123456789X</td></tr></table>
		</td><td ><table> <tr><td colspan="1"><span> <b>CPF Payment Code </b></span></td></tr><tr><td>
		<table class="table table-bordered1"style=" width:150px; margin:0px; ">
		<tr><td height="17px"></td> <td></td><td></td><td class="table-bordered"><center>-</center></td><td></td><td></td></tr></table></td></tr>
		<tr> <td> <table> <tr><td><b>E.g.</b> </td><td>P</td><td>T</td><td>E</td><td></td><td>0</td><td>1</td></tr></table>
		</td> </tr></table>
		 </td></tr>
		 <tr> <td> For Individual trading under own name<br> (e.g architect/engineer or individual hiring local personal driver/gardener) <br> <table ><tr><td width="200px" rowspan="4">
		<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> 2.<b> Business</b> Foreign Worker Levy </td></tr>
		<tr><td><b> Employer's NRIC/FIN:</b> </td></tr><tr><td><table class="table table-bordered1"style="margin:0px; !important; width:200px !important;"><tr><td height="17px"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table>
		</td><tr><td> E.g. 123456789A</td></tr></table>
		</td><td width="30%"><table> <tr><td colspan="1"><span><b> CPF Payment Code</b> </span></td></tr><tr><td>
		<table class="table table-bordered1"style="margin:0px !important; width:150px">
		<tr><td height="17px"></td> <td></td><td></td><td class="table-bordered"><center>-</center></td><td></td><td></td></tr></table></td></tr>
		<tr> <td> <table> <tr><td><b>E.g.</b></td><td>P</td><td>T</td><td>E</td><td></td><td>0</td><td>1</td></tr></table>
		</td> </tr></table>
		 </td></tr>
		 <tr> <td colspan="2"> <table ><tr><td width="450px" rowspan="4">
		<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> 3. <b>Domestic</b> Foreign Worker Levy </td></tr>
		<tr style="float:right"><td> <b>Employer's NRIC/FIN:</b> </td></tr><tr><td><table class="table table-bordered1"style="margin:0px !important; width:200px !important;"><tr><td height="17px"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table>
		</td><tr><td><b> E.g.</b> 123456789A</td></tr></table>
		</td></tr>
		</table>
		
		(a) I/We hereby instruct you to process the Billing Organisation's (BO's) instruction to debit and credit my/you account.<br>
		(b) You are entitled to reject the BO's  debit instruction if my/our account does not have sufficient fund and charge me/us a fee for this. You may also at your discretion allow the debit even if this result in an overdraft on the account and impose charge accordingly.<br>
		(c) This authorisation will remain in focus until terminated by your notice sent to my/our address last known to you or upon receipt of my/our written revocation through the BO.<br>
	<table class="table table-bordered1"style="margin:1px !important;">
		<tr><td width='50%'> Name of Bank and Branch : {{$maid_giro_form[0]->bank_name}}</td> 
		<td width='50%' rowspan="4"  valign="top" style="line-height:1;" ><table><tr><td>
		<p style="margin:0px;"><span style="margin-top:0px"> My/Our Company's Stamp/Signature(s)/Thumbprint(s)* as in Bank's records:</span></p></td></tr>
		<tr><td height="40px"></td></tr>
		<tr><td>
		<p style="margin:0px;"><span style="padding-top:100px; " valign="bottom" > *For thumbprint(s), you must approach your respective Bank with your identification document for verification. For signature(s), you have the option to approach your respective Bank for verification.  </span> </p> </td></tr></table></td></tr>
		<tr><td> Name (as in Bank Account): {{$maid_giro_form[0]->name_in_bank_acc}}</td></tr>
		<tr><td>Bank Account Number : {{$maid_giro_form[0]->account_no}}</td></tr>
		<tr><td>Contact Number/E-mail address : {{$employer_details[0]->employer_mobile_phone}}</td></tr>
		</table>
		<b><p class="back" width="100%" style=" margin-bottom:1px;margin-top:1px"> PART 2: For CPF Board's Completion </p></b>
		<table class="table table-bordered1"style="margin:1px !important; width:450px !important;">
		<tr> <td colspan="4"> Bank </td> <td colspan="3"> Branch </td> <td colspan="9"> CPF Board's Account No.</td></tr>
		<tr ><td height="17px"></td> <td></td> <td></td> <td></td>
		<td></td><td></td><td></td>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</table>
		<table class="table table-bordered1"style="margin:1px !important; width:500px !important;" >
		<tr> <td colspan="4"> Bank </td> <td colspan="3"> Branch </td> <td colspan="11"> Account No. To Be Debited </td></tr>
		<tr ><td height="17px"></td> <td></td> <td></td> <td></td>
		<td></td><td></td><td></td>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</table>
		<b><p class="back" width="100%" style="margin:0px"> PART 3: For Bank Completion </span></p><br>
		<p style="margin:0px">This application is hereby REJECTED (please <img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>) for the following reason(s):</p>
		
		<table  width="100%" style="margin:0px !important;">
			<tr>
			<td>
			@if(in_array('Signature/Thumbprint# deffers from banks records',$rejected_by))
				<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> Signature/Thumbprint# deffers from bank's records
			@else
				<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> Signature/Thumbprint# deffers from bank's records
			@endif
			</td>
			<td>
			@if(in_array('Wrong account number',$rejected_by))
				<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> Wrong account number
			@else
				<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> Wrong account number
			@endif
			</td>
			</tr>
			<tr>
			<td>
			@if(in_array('Signature/Thumbprint# incomplete/unclear#',$rejected_by))
				<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> Signature/Thumbprint# incomplete/unclear#
			@else
				<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> Signature/Thumbprint# incomplete/unclear#
			@endif
			</td>
			<td>
			@if(in_array('Amendment not countersigned by Bank Account Holder',$rejected_by))
				<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> Amendment not countersigned by Bank Account Holder
			@else
				<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> Amendment not countersigned by Bank Account Holder
			@endif
			</td>
			</tr>
			<tr>
			<td>
			@if(in_array('Account operated by Signature/Thumbprint#',$rejected_by))
				<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> Account operated by Signature/Thumbprint#
			@else
				<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> Account operated by Signature/Thumbprint#
			@endif
			</td>
			<td>
			@if(in_array('Others', $rejected_by))
				<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>  Others:<u>{{$maid_giro_form[0]->other_rejected_by}} </u>
			@else
				<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> Others: _______________________
			@endif 
			</td>
			</tr>
			</table>
			<table width="100%">
			<tr>
			<td>______________</td>
			<td>________________________ </td>
			<td>____________________</td>
			</tr>
			<tr>
			<td>
			Name of Bank Officer
			</td>
			<td>
			Authorised Signature and Stamp of Bank</td>
			<td>
			Date:  <?php echo date("d-m-Y");?></td>
			</tr>
			</table>
			
</div>
<div class="page-break"></div>
<table><tr>
<td> <img style = "width:10px; height:150px; margin-top:30px; margin-bottom:30px;"src='<?php echo $root_path."/img/para-line.jpg";?>'/></td> <td rowspan="2">
<div style="height:100px"></div><pre>
<center style="height:200px">
<div class="rotate" style="text-align: centre; margin: 30px auto 10px 100px;width:0px; clear: both;">
<div >BUSINESS REPLY SERVICE
 PERMIT NO. 08383</div>
		
<img style = "width:100px; height:30px; margin-top:30px"src='<?php echo $root_path."/img/giro_pattern.jpg";?>'/>
CENTRAL PROVIDENT FUND BOARD 
  ROBINSON ROAD P.O.BOX 626
	SINGAPORE 901226
</div>
</center></td></tr><tr><td>
<div class="rotate" style="text-align:centre; border-bottom: 1px solid rgb(0, 0, 0);  border-left: 1px solid rgb(0, 0, 0);  margin: 0px auto 0px 50px; width:110px; height:80px clear: both; float:left;">
Postage will be
 paid by
 addressee. For 
 Posting in
 Singapore only.
</div>
</pre></td></tr></table>
<hr style="border-top: dotted 1px;" />
		<div style="margin-top:30px;">
			<table class = "table" style="margin-top:0px !important">
				<tr>
					<td>
						<img style = "width:100px;padding-left:20px;"src='<?php echo $root_path."/img/girologo.jpg";?>'/>
					</td>
					<td>
						<p style="text-align:left;padding-left:30px;">
						<span style="font-weight:bold;white-space:nowrap;">Central Provident Fund Board</span><br/>
						<span style="white-space:nowrap;">79 Robinson Road, CPF Building Singapore 068897</span><br/>
						<span style="white-space:nowrap;">Website:www.cpf.gov.sg CPF Call Centre:1800-227-1188</span>
						</p>
					</td>
					<td width="60%">
					</td>
				</tr>
			</table>			
			</div><center>
			<table style=" border: 1px solid black; margin-bottom:30px;"><tr> <td > <center><h5 style="margin:20px; margin-left:50px !important"> Application For Inter-Bank GIRO(Foreign Worker Levy Payment) </h5><br>
			<span style="background-color:#DDDDDD;border: 1px solid black; "> Contact Us</span> www.cpf.gov.sg . giro@cpf.gov.sg <br> CPF Call Centre : 1800-227-1188
			</td></tr></table></center>
<div class="container-fluid">
<hr style="border-top: dotted 1px; margin-top:50px" />
<div style="background-color:#DDDDDD">
<p><u><b> Information On Application For Inter-Bank GIRO </b></u></p>
<ul>
<li> Your GIRO application will be sent to your bank and will be processed within 21 working days. You will receive a letter on the status and effective ate of the GIRO arrangement upon approval.</li>
<li> You can also check the status of your GIRO application at <u>www.cpf.gov.sg</u> under E-Services > Direct Debit Authorisation /GIRO Application Status.
<li> Please ensure you have enough balance in your bank account before the deduction date. If you have set a payment limit on your GIRO deduction with your bank, ensure that the limit is sufficient to pay for the Foreign  Worker Levy. Some banks may charge an administrative fee for each unsuccessful deduction.</li>
<li>If you have an existing GIRO arrangement with CPF Board and wish to change your bank account, you will need to complete a new GIRO application is approved.
</ul>
<p><u><b> For Business & Domestic Worker Levy Payment : </b></u></p>
<ul>
<li> While your GIRO application is being processed, please continue to pay your Foreign Worker Levy by the 14<sup>th</sup>of each month. Otherwise ,late payment interest will be charged.</li>
<li> The Foreign Worker Levy will be deduction automatically from your bank account on the 17<sup>th</sup> (or the next working day if the 17<sup>th</sup> falls on a Saturday, Sunday or public holiday).</li>
<li> For further enquiries on Foreign Worker Levy matters, please call the MOM Work Pass Division at 6438 5122.</li>
<li> You need not re-apply for Inter-Bank GIRO when renewing work permits for your foreign worker or changing foreign workers.
</ul>
<p><b> For enquiries on CPF Submission Number(CSN), Unique Entity Number(UEN) and CPF Payment Code, please email <u>employer@cpf.gov.sg</u> </b></p>
 </div>
</div>
</body>
</html>
