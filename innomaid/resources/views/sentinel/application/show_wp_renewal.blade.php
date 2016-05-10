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
    font-size: 12px;
	font-family:"helvetica";
	}
.h3, h3 {
    font-size: 20px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 50px;
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
	font-size:11px;
	}
.table {
    margin-bottom: 10px;
	margin-top:25px;
    max-width: 100%;
    width: 100%;
	font-size:11px;
	}
.table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
   margin-left:10px;
   border: 5px solid #CED7E0;
	line-height:2.0;
	text-align: left top;
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

</style>
<body style="background:white;">
<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
$employer_details[] =json_decode($maid_employer->employer_json_data);?>
<div class="container-fluid"><div><b> Foreign domestic worker work permit renewal declaration and security bond conditions</b> </div>
<div style="background-color: #CED7E0;height:4px;"></div>

			<div>
			<table class = "table" style="margin-top:0px !important">
				<tr>
					<td>
						<img style = "width:100px;height:100px;"src='<?php echo $root_path."/img/majular-singapora.jpg";?>'/>
					</td>
					<td>
						<img style = "width:150px;margin-left:300px;"src='<?php echo $root_path."/img/mom-logo.png";?>'/>
					</td>
				</tr>
			</table>			
			</div>
<div style="background-color: #CED7E0;height:4px;" ></div>
<h1>Foregin Domestic Worker Work Permit Renewal Application Form </h1>
<p><b style="margin-top:20px">Use this form only if you are an Employment Agent acting on behalf of an employer.</b></p>
<p><b style="margin-top:20px">Declaration by the employer:</b></p>
<ol><li>
In order to renew a work pass under the Employment of Foreign Manpower Act("EFMA"). I declare that :</li>
	<ol type='a'>
	<li>I am fully aware of and shall fulfil my abligations as an employer of a foreign domectic worker under the EFMA and the Employment of Foreign Menpower(Work Passes)Regulations("EFMR") which includes the following:
	<ul>
		<li> Pay her salary promptly</li>
		<li> Pay for her upkeep and maintenance, including medical treatment</li>
		<li> Provide acceptable accommodation for her</li>
		<li> Should she die while in Singapore, pay for her burial or cremation and pay for her body and belongings to be returned to her home</li>
		<li> Take her to the Controller of Work Passes when required by MOM </li>
		<li> Inform the Controller of Work Passes in writing within seven days when her employment ends or her work pass is cancelled</li>
		<li> Arrange and pay for her passage home, after giving her reasonable notice, and paying her outstanding salary. </li>
	</ul>
	</li>
	<li> I shall take reasonable steps to ensure that my foreign domestic worker complies with  the EFMA and the EFMR; and such steps shall include reporting to the Controller of Work Passes if I know that she is non-compliant; and</li>
	<li> I have obtained my foreign domestic worker's written consent to continue her employment with me.</li>
	</ol>
<li> When a new  security bond is needed , I declare that:
	<ol type='a'>
	<li> I have furnished my security bond as follows
	<table class="table table-bordered1"  cellspacing="5px" cellpadding= '0' style="padding-bottom:10px; margin:5px;"><tr><td>Policy Number: @if($workpermit)@if($workpermit->policy_number){{$workpermit->policy_number}}@endif @endif </td><td>Expiry Date (DD-MM-YYYY): @if($workpermit)@if($workpermit->expiry_date) <?php echo date('d-m-Y', strtotime( $workpermit->expiry_date)); ?>@endif @endif</td></tr></table>	
	</li>
	<li>  I understand that the Controller of Work Passes has imposed on me a security bond for the sum of FIVE THOUSAND SINGAPORE DOLLER (SGD 5,000) payable to the Government of the Republic of Singapore to ensure that I comply with my obligations under the EFMA and the EFMR [including those in 1(a) above];  </li>
	<li> I understand that if I breach any of my obligations as an employer of a foreign domestic worker, my Security Bond may be forfeited fully or in part. I also understand that if there is only partial forfeiture, the  Government of the Republic of Singapore may forfeit the rest at a later point in time for the same breach or a different breach.</li>
	</ol>


</li>
<li>
 By signing the form, I indicate that I have read and understood the declaration; and intent to be bound by it. I am aware that if I have wilfully stated in it anything which I know to be false or do not believe to be ture, I may be prosecuted.</li></ol>

<table class="table table-bordered1"  cellspacing="5px" cellpadding= '0' style="padding-bottom:50px">

<tr><td><table style=" border:none !important;"><tr><td> Name of Foregin Domestic Worker: {{ucfirst($maid_details[0]->name)}} </td></tr> <tr> <td></td> </tr> </table></td><td style="text-align: top !important;"> FIN of Foregin Domestic Worker: {{$maid_details[0]->passport_number}}</td></tr>
<tr><td><table style=" border:none !important;"><tr><td> Name of Employer: <?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}} </td></tr> <tr> <td>NRIC/FIN: {{$employer_details[0]->employer_nric_no}} </td> </tr> </table></td><td style="text-align: top !important;"><table style=" border:none !important;"><tr><td> Signature of Employer: </td></tr><tr><td> Date(DD-MM-YYYY): <?php echo date("d-m-Y");?></td></tr></table></td></tr>

</table>
<div style="background-color: #CED7E0;">
<span> Ministry of Manpower Work Pass Division </span><br>
 <table><tr><td><span>Web <span> http://www.mom.gov.sg </td><td> <span>Contact us <span> http://www.mom.gov.sg/contact </td></tr></table>
 </div>
</body>
