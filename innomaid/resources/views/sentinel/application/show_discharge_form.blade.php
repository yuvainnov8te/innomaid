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
$root_path = $_SERVER['DOCUMENT_ROOT'].'/innomaid/public';
?>
<style type="text/css">

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
	font-size:10px;
	
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
.page-break {
    page-break-after: always;
}

td.nth-child(3){
	width: 50px;
	}

</style>
<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				
				//echo '<pre>';print_r($user_data);
		?>	
<body style="background:white;font-size:10px;">
	<!--<div style='padding-top:5%' ><b style='font-size:15;'> {{$user_data[0]->company_name}}</b><br/>{{$user_data[0]->address}}<br/>Tel. No.: {{$user_data[0]->telephone}} Fax: {{$user_data[0]->fax}}<br/>MOM LIC {{$user_data[0]->license_no}}</div> -->

	<div style='font-size:15;padding-top:5%;text-align:center;margin-bottom: 25px;' ><b style=''>Discharge letter for Maid</b></div>
<div style="line-height: 25px;">Employer's Name:<span style="border-bottom:1px solid #000;padding-right:40%;margin-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?>{{ucfirst($employer_details[0]->employer_name)}}</span></div>
<div style="line-height: 25px;">Address:<span style="border-bottom:1px solid #000;padding-right:70%;margin-left:5px;">{{ucfirst($employer_details[0]->address)}}</span></div>	
<div style="line-height: 25px;">Discharge of Maid(name):<span style="border-bottom:1px solid #000;padding-right:40%;margin-left:5px;">{{ucfirst($maid_details[0]->name)}}</span></div>
<div >
<table width="80%" height="30px" style="margin-top: 5px; margin-bottom: 0px; margin-left: -2px font-size: 10px; ">
<tr>
	<td width="14%">Date of commencement:</td><td width="15%" style="border-bottom:1px solid #000;"><span style="padding-right:40%;">@if($salarypayment){{$salarypayment[0]->date_of_commencement}}@endif</span></td>
	<td  width="6%"></td>
	<td width="11%">Date of Discharge : </td><td width="20%" style="border-bottom:1px solid #000;"><span style="padding-right:40%;"><?php echo date('d-m-Y');?></span></td>
</tr>
</table>
</div>
<div>
<table width="80%" height="30px" style="margin-top: 5px; margin-bottom: 20px; margin-left: -2px font-size: 10px; ">
<tr>
	<td width="6%">Work Permit:</td><td width="15%" style="border-bottom:1px solid #000;"><span style="padding-right:40%;">{{$maid_details[0]->work_permit_no}}</span></td>
	<td  width="6%"></td>
	<td width="6%">Passport No : </td><td width="20%" style="border-bottom:1px solid #000;"><span style="padding-right:40%;">{{$maid_details[0]->passport_number}}</span></td>
</tr>
</table>
</div>



<table class=' table-bordered'width="80%">
	<tr>
	  <td style='width:70%'>By way of this letter,all parties also hereby confirm that:-</th> 
	  <td style='width:10%'>Yes/No</th> 
	  <td style='width:20%'>Remarks</th> 
	</tr>
<tr> <td>1. The FDW has recieved all salaries due to her there are no monies owed to each other( between the Employer and FDW) </td><td></td><td></td></tr>
<tr> <td>2. The Employer has inspected and verified the packed belonging of the FDW prior to her leaving the house </td><td></td><td></td></tr>

<tr> <td>3. The FDW has gathered all her belonging and there is nothing left behind or withheld by the Employer</td><td></td><td></td></tr>

<tr> <td>4. The pasport of the FDW has been handed over to the FDW</td><td></td><td></td></tr>

<tr> <td>5. The work permit card of the FDW will be returned to MOM</td><td></td><td></td></tr>

<tr> <td>6. The FDW confirmed that she has not been abused in any way</td><td></td><td></td></tr>

<tr> <td>7. </td><td></td><td></td></tr>


</table>





<div class="page-break"></div>
<!--<div style='padding-top:5%' ><b style='font-size:15;'> {{$user_data[0]->company_name}}</b><br/>{{$user_data[0]->address}}<br/>Tel. No.: {{$user_data[0]->telephone}} Fax: {{$user_data[0]->fax}}<br/>MOM LIC: {{$user_data[0]->license_no}}<br/><u>{{$user_data[0]->email}}</u></div>-->
<br/>
<span style="padding-left:80%">Date:<span style="border-bottom: 1px solid #000; margin-left: 5px; padding-right: 5%;"><?php echo date('d-m-Y');?></span></span><br/><br/><br/><br/>
<div style="line-height: 25px;"> Employer Name: <span style="border-bottom: 1px solid #000;  margin-left: 5px;padding-right: 40%;">{{$employer_details[0]->employer_name}} </span> </div>
<div style="line-height: 25px;">
<table class="table"> 
<tr>
	<td height="15px" width="10%">Address:</td><td colspan='3'><span style="border-bottom: 1px solid #000; padding-right: 85%;">{{$employer_details[0]->address}}</span></td>
</tr>
<tr>
	<td height="15px"></td><td width="70%" style="border-bottom: 1px solid #000;"> </td><td width="2%">[S]</td><td style="border-bottom: 1px solid #000;">
</tr>
</table>
</div>
<div style="line-height: 25px;">Dear Sir/Madam,</div><br/><br/>
<span><u>TAKE OVER of Foreign Domestic Worker (FDW) from Employer</u></span><br/>
<div style="line-height: 25px;">Name of Foreign Domestic Worker : <span style="border-bottom: 1px solid #000;  margin-left: 5px; padding-right: 40%;">{{$maid_details[0]->name}} </span> </div>
<div>
<table width="80%" height="30px" style="margin-top: 5px; margin-bottom: 20px; margin-left: -2px font-size: 10px; ">
<tr>
	<td width="6%">Work Permit:</td><td width="15%" style="border-bottom:1px solid #000;"><span style="padding-right:40%;">{{$maid_details[0]->work_permit_no}}</span></td>
	<td  width="6%"></td>
	<td width="6%">Passport No : </td><td width="20%" style="border-bottom:1px solid #000;"><span style="padding-right:40%;">{{$maid_details[0]->passport_number}}</span></td>
</tr>
</table>
</div>
<br/>
<span style=>This is to condfirm that the above named Foreign Domestic Worker(FDW) has been handed over to Agency with effect from _______________ for the purpose of re-deployment to a new employer. </span><br/>
<span> We understand that she is unable to find an new employer within max.<u>30 days</u>, her Work Permit shall be cancelled as agreed in the original contract between all parties and the FDW shall be <b>required to exit Singapore within 7 days. Lodging will be charge to employer for 14 days at $15/day</b>
while she is under the care of our Agency, we will take full responsiblity for her welfare and safety.</span>
<table class="table-bordered" width="80%" style="margin-top: 20px;">
<tr><td style='width:70%'><b>By way of this letter, all parties also hereby confirm that:-</b></th>
	<td style='width:10%'><b>Yes/No</b></th>
	<td style='width:20%'><b>Remarks</b></th></tr>
<tr>
	<td>1. The FDW has recieved all salaries due to her there are no monies owed to each other( between the Employer and FDW)</td>
	<td></td><td></td>
</tr>
<tr>
	<td>2. The Employer has inspected and verified the packed belonging of the FDW prior to her leaving the house </td><td></td><td></td></tr>
<tr>
	<td>3. The FDW has gathered all her belonging and there is nothing left behind or withheld by the Employer</td><td></td><td></td>
</tr>
<tr>
	<td>4. The pasport of the FDW has been handed over to the Agency</td><td></td><td></td>
</tr>
<tr>
	<td>5. The work permit card of the FDW has been handede over to the Agency</td><td></td><td></td>
</tr>

</table>
<table class="table" style="margin-top:50px; font-size: 10px;">
<tr>
	<td width="10%" style="border-top: 1px solid #000;"><span style="padding-left:15%">Acknowledge by FDW </span></td>
	<td width="10%"></td>
	<td width="10%" style="border-top: 1px solid #000;"><span style="padding-left:15%"> Acknowledge by Employer</span></td>
	<td width="10%"></td>
</tr>
</table>
<table class="table" style="margin-top:30px; font-size: 10px">
<tr>
	<td width="10%" style="border-top: 1px solid #000;"><span style="padding-left:15%">Signed by Agency</span></td>
	<td width="10%"></td>
	<td width="10%"> <span style=" padding-right: 3px;">Date:</span><span style="border-bottom: 1px solid #000;  padding-right: 5%;"><?php echo date('d-m-Y');?></span></td>
	<td width="10%"></td>
	</tr>
</table>


</body>
</html>





