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
    border:1px solid #000;
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
   border: 1px solid #000;
	line-height:2.0;
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
		<div class="container-fluid">
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
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				$declaration_by_ea = explode(';', $maid_authorisation[0]->declaration_by_ea);
				//print_r($employer_details);
		?>
		<table class="table table-bordered1"style="margin-top:0px !important;"><tr><td style="padding-left:10px"> 
		<h1 style="text-align:left;font-weight:bold; line-height:1"><span >Authorisation Form for Foreign Domestic Worker Work Pass Transactions</span></h1>
		<p>This authorisation letter shall only be valid for 14 days from the date of employer's authorisation  ,and only applies to the application / renewal / transfer / cancellation of the foreign domestic worker(s) listed below. To ensure prper authorization, employers are to indicate <u><b>NA</b></u> for rows that are not filled. </p>
		<p><b>*The softcopy of this form contains macros and can only be used with MS word 2007 version or later. Please print out the PDF version and fill it in hardcopy if you do not have the required software. </b></p>
		</td></tr></table>
		<table class="table table-bordered1"style="margin-top:0px !important;">
			<tbody>
					<tr>
						<td colspan='5' style="float:left; background-color: #ccc; font-weight: bold;">Declaration by Employer</td>
					</tr>
					<tr>
					
					<td colspan='2' style="padding-left:10px">
						<b>Employer Name</b>
					</td>
					<td colspan='3'>{{ucfirst($employer_details[0]->employer_name)}}
					</td>
					</tr>
					<tr>
					<td colspan='2' style="padding-left:10px">
						<b>NRIC No./FIN</b>
					</td>
					<td colspan='3'>{{ucfirst($employer_details[0]->employer_nric_no)}}
					</td>
					</tr>
					<tr>
					<td colspan='2' style="padding-left:10px">
						<b>Contact No.</b>
					</td>
					<td colspan='3'>{{ucfirst($employer_details[0]->employer_mobile_phone)}}
					</td>
					</tr>
					<tr>
					<td colspan='2' style="padding-left:10px">
						<b>Signature and Date</b>
					</td>
					<td colspan='3'>
					</td>
					</tr>
					<tr>
						<th>S/N</th>
						<th colspan='2'>Name of Foreign Domestic Worker(s)</th>
						<th>Passport/FIN/WP No.</th>
						<th>Authorised Transaction</th>
					</tr>
					<tr>
						<td style="padding-left:10px">1</td>
						<td colspan='2'> {{ucfirst($maid_details[0]->name)}}</td>
						<td>
						@if($maid_details[0]->passport_number != '' )
						{{ucfirst($maid_details[0]->passport_number)}}/{{ '' }}/ @endif<?php if(isset($maid_details[0]->work_permit_no)) 
									echo $maid_details[0]->work_permit_no;?></</td>
						<td> </td>
					</tr>
					<tr><td colspan='5' style="padding:10px" >
					@if($maid_authorisation[0]->is_agency_authorise_workpass == 'agency authorise workpass')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> I hereby declare that I am authorising <u> {{ucfirst($agency_data[0]->company_name)}} and {{$agency_data[0]->license_no}}</u> (Name and licence no. of employment agency) to perform the above work pass transaction(s) on my behalf.
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> I hereby declare that I am authorising <u> {{ucfirst($agency_data[0]->company_name)}} and {{$agency_data[0]->license_no}}</u> (Name and licence no. of employment agency) to perform the above work pass transaction(s) on my behalf.
					@endif
					</td>
					</tr>
					<tr>
						<td colspan='5' style="padding:10px" >
							<u>Fill in only if applicable.</u><br>
							@if($maid_authorisation[0]->is_emplyer_authoise_form_submit == 'emplyer authoise form submit')
							<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> I hereby authorise <u> {{ucfirst($employer_details[0]->employer_name)}}</u> (Full name as in NRIC/Passport),<u>{{$employer_details[0]->employer_nric_no}}</u> (NRIC/Passport No.), to submit this authorisation form on my behalf. A copy of the representative's NRIC/Passport is enclosed with this authorisation form.
							@else
							<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> I hereby authorise <u>{{ucfirst($employer_details[0]->employer_name)}}</u> (Full name as in NRIC/Passport),<u>{{$employer_details[0]->employer_nric_no}}</u> (NRIC/Passport No.), to submit this authorisation form on my behalf. A copy of the representative's NRIC/Passport is enclosed with this authorisation form.
							@endif
						</td>
					</tr>
			</tbody>
		</table>
				<table class="table table-bordered1"style="margin-top:0px !important;">
			<tbody>
					<tr>
						<td colspan='2' style=" background-color: #ccc; font-weight: bold; ">Declaration by EA</td>
					</tr>
					<tr>
						<td colspan='2' style="padding:10px">
					@if(in_array('Employer Authorisation',$declaration_by_ea))
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> I have spoken to and verified with employer to confirm his/her authorisation.
					@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> I have spoken to and verified with employer to confirm his/her authorisation.
					@endif
					<br>
					@if(in_array('Authorised person Submitting form',$declaration_by_ea))
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> I have spoken to and verified with employer that the person submitting this form to the EA is authorised to do so on behalf of the employer.
					@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> I have spoken to and verified with employer that the person submitting this form to the EA is authorised to do so on behalf of the employer.
					@endif
					<br>
					@if(in_array('All necessary fields are filled',$declaration_by_ea))
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> I declare that I have ensured all necessary fields are filled in prior to making the abovementioned work pass.
					@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> I declare that I have ensured all necessary fields are filled in prior to making the abovementioned work pass.
					@endif
					<br>
					@if(in_array('Information provided is correct',$declaration_by_ea))
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> I declare that information provided on this form is true and correct.
					@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/> I declare that information provided on this form is true and correct.
					@endif
					
						</td>
					</tr>
					<tr>
					
					<td style="padding-left:10px">
						<b>Name of EA personnel</b>
					</td>
					<td > {{ucfirst($user_data[0]->company_name)}}
					</td>
					</tr>
					<tr>
					<td style="padding-left:10px">
						<b>Registration No.</b>
					</td>
					<td > {{$user_data[0]->registration_number}}
					</td>
					</tr>
					<tr>
					<td style="padding-left:10px">
						<b>Signature and Date</b>
					</td>
					<td >
					<?php echo date("d-m-Y");?>
					</td>
					</tr>
					
			</tbody>
		</table>
				<div style="display:inline-block; background-color: #ccc; font-size:10px; ">
		<span style="font-weight:bold;padding-left:5px">Ministry of Manpower Foreign Manpower Management Division</span><br/>
		<span  style="padding-left:5px">1500 Bendemeer Road Singapore 339946</span><span style="padding-left:20px">Tel +65 6432 5122</span><span style="padding-left:20px">Web http://www.mom.gov.sg</span><span style="padding-left:20px">Email mom_fmmd@mom.gov.sg</span>
		</div>
</div>
</body>
</html>
