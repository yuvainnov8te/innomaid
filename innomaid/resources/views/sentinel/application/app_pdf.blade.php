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
$root_path1 = $_SERVER['DOCUMENT_ROOT'];
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
    margin-bottom: 10px;
    padding-top: 15px;
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
	text-align:center;
	font-size:11px;
	}
.table {
    margin-bottom: 10px;
	margin-top:20px;
    max-width: 100%;
    width: 100%;
	font-size:10px;
}
table {
    background-color: transparent;
}
table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    border: 1px solid #000;
	line-height:1.25;
}
.per_info > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.79;
	}
.fdw_info > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.30;
	margin-top:0px;
	}
.table > thead > tr > th
{
	font-size:10px;
}
.table > thead > tr > th > p
{
	font-weight:500px;
}
.per_info tr td:first-child
{
	font-size:11px;
	font-weight: bold;
	width:40%;
}
.fdw_info tr td:first-child
{
	font-size:10px;
	font-weight: bold;
	width:40%;
}
.per_info tr td:nth-child(2)
{
	width:40%;
}
.fdw_info tr td:nth-child(2)
{
	width:40%;
}
.skf 
{
	line-height:1.4;
}
/* bootstrap class added for icon right or cross */
ul li
{
	font-size:10px;
}
p{
	font-size:10px;
}

</style>
<body style="background:white;">
	<div class="container-fluid">
		@if($user_data[0]->agency_logo)
		<div style="width:100px; height:100px;">
				<img style = "height:100px; width:100px;"src='<?php echo $root_path1."/uploads/agency_logo/".$user_data[0]->agency_logo;?>' />
		</div>
		@endif
		<p style="padding-top:10px;font-size:10px;font-weight:bold;">Job Scope Sheet for Foreign Domestic Worker</p>
		<table class="table table-bordered per_info">
			<tbody>
					<tr><td><span>The Employement Agency Name:</span><span style="font-weight:500; padding-left:5px;">@if($user_data[0]->company_name!= '')
					{{ucfirst($user_data[0]->company_name)}}
					@else
					{{ '-' }}
					@endif
					</span></td></tr>
					<tr>
					<td><span>License No. :</span><span style="font-weight:500; padding-left:5px;">
					@if($user_data[0]->license_no != '')
					{{ucfirst($user_data[0]->license_no)}}
					@else
					{{ '-' }}
					@endif</span></td>
					<td><span style="padding-left: 30px;font-weight:bold;">Reference No:</span>
					@if($user_data[0]->maid_reference_code != '')
					<span>{{ucfirst($user_data[0]->maid_reference_code)}}</span>
					@else
					<span style="border-bottom:1px solid #000;">&nbsp;</span>
					@endif
					
					</td>
			   </tr>
			</tbody>
		</table>
		
	<p style="padding-top:5px;font-size:11px;">This job scope sheet pertains to the job offer made by the <i>Employer</i> to the <i>FDW</i>. It shall be translated into the FDW's language and given to her befrore she signs the employment contract.</p>
	<hr></hr>
	<span align="left"style="font-weight:bold;font-size:11px; padding-top:0px !important;border-bottom:1px solid #000;">Particulars of Parties</span>
		<?php $employer_details[] = json_decode($user_data[0]->employer_json_data);?>
		<table class="table table-bordered fdw_info">
			<tbody>
				<tr>
					<td>The<i>Employer</i></td></tr>
					<tr><td><span>Full Name:</span><span style="font-weight:500; padding-left:5px;"> <?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> @if($employer_details[0]->employer_name!= '')
					{{ucfirst($employer_details[0]->employer_name)}}
					@else
					{{ '-' }}
					@endif
					</span></td>
					<td><span style="padding-left: 30px;font-weight:bold;">NRIC/Passport No:</span><span style="font-weight:500; padding-left:5px;">@if($employer_details[0]->employer_nric_no != '' || $employer_details[0]->employer_passport!= '')
					{{ucfirst($employer_details[0]->employer_nric_no)}}/{{ucfirst($employer_details[0]->employer_passport)}}
					@else
					{{ '-' }}
					@endif</span></td>
			   </tr>
			</tbody>
		</table>
		<?php $maid_details[] = json_decode($user_data[0]->maid_json_data);?>
		<table class="table table-bordered fdw_info" style="margin-top:0px;">
			<tbody>
				<tr>
					<td>The <i>Foreign Domestic Worker(FDW)</i></td></tr>
					<tr><td><span>Full Name:</span><span style="font-weight:500; padding-left:5px;">
					@if($maid_details[0]->name!= '')
					{{ucfirst($maid_details[0]->name)}}
					@else
					{{ '-' }}
					@endif
					</span></td>
					<td><span style="padding-left: 30px;font-weight:bold;">Passport No:</span><span style="font-weight:500; padding-left:5px;">
					@if($maid_details[0]->passport_number!= '')
					{{ucfirst($maid_details[0]->passport_number)}}
					@else
					{{ '-' }}
					@endif
					</span>	
					</td>
			   </tr>
			</tbody>
		</table>
		
		<span style="font-size:12px;border-bottom:1px solid #000;font-weight:bold;"> Job Scope </span>
		<p style="padding-top: 10px;">Persons in household of Employer's family</p>
		<table class="table table-bordered per_info" style="margin-left: 35px;
		margin-top: 0px !important;">
			<tbody>
				<tr>
					<td colspan='2'>
					@if($maid_job_data[0]->adult != '')
					<span style="font-weight:500; padding-left: 5px;
		padding-right: 5px;5px;border-bottom: 1px solid #000;">{{$maid_job_data[0]->adult}}</span>
					@else
					{{ 'No data'}}
				@endif
				<span style="font-weight:500;">adults.</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
					@if($maid_job_data[0]->y_adult != '')
					<span style="font-weight:500; padding-left: 5px;
		padding-right: 5px;border-bottom: 1px solid #000;">{{$maid_job_data[0]->y_adult}}</span>
					@else
					{{ 'No data'}}
				@endif
				<span style="font-weight:500;">young adults aged 13 to 18.</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
					@if($maid_job_data[0]->l_child != '')
					<span style="font-weight:500; padding-left: 5px;
		padding-right: 5px;border-bottom: 1px solid #000;">{{$maid_job_data[0]->l_child}}</span>
					@else
					{{ 'No data'}}
				@endif
				<span style="font-weight:500;">children aged 5 to 12.</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
					@if($maid_job_data[0]->m_child != '')
					<span style="font-weight:500; padding-left: 5px;
		padding-right: 5px;border-bottom: 1px solid #000;">{{$maid_job_data[0]->m_child}}</span>
					@else
					{{ 'No data'}}
				@endif
				<span style="font-weight:500;">children aged between 3 to 5.</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
					@if($maid_job_data[0]->babies != '')
					<span style="font-weight:500;padding-left: 5px;
		padding-right: 5px;border-bottom: 1px solid #000;">{{$maid_job_data[0]->babies}}</span>
					@else
					{{ 'No data'}}
				@endif
				<span style="font-weight:500;">infants/babies below 3.</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
					@if($maid_job_data[0]->constant_care != '')
					<span style="font-weight:500; padding-left: 5px;
		padding-right: 5px;border-bottom: 1px solid #000;">{{$maid_job_data[0]->constant_care}}</span>
					@else
					{{ 'No data'}}
				@endif
				<span style="font-weight:500;">person(s) requiring constant care and attention (excluding babies).</span>
					</td>
				</tr>
			</tbody>
		</table>
		<h3 style="font-size:12px;">The FDW shall be required to perform domestic duties as follows (to tick where applicable):</h3>
		<?php $domestic_duty = explode(';',$maid_job_data[0]->domestic_duties);?>
		@foreach($domestic_duty as $domestic_dutyid => $domestic_duty_value)
		<?php $domestic_duty_val[]= $domestic_duty_value;?>
		@endforeach
		<ul style="margin-top:15px;">
			@if(in_array("Household chores", $domestic_duty_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Household chores</li>
			@else
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/blank.jpg";?>">Household chores</li>
			@endif
			@if(in_array("Cooking", $domestic_duty_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Cooking</li>
			@else
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/blank.jpg";?>">Cooking</li>
			@endif
			@if(in_array("Looking after aged person", $domestic_duty_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Looking after aged person(s) in the household [constant attention is *required/not required]</li>
			@else
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/blank.jpg";?>">Looking after aged person(s) in the household [constant attention is *required/not required]</li>
			@endif
			@if(in_array("Baby-sitting", $domestic_duty_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Baby-sitting</li>
			@else
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/blank.jpg";?>">Baby-sitting</li>
			@endif
				@if(in_array("Child-minding", $domestic_duty_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Child-minding</li>
			@else
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/blank.jpg";?>">Child-minding</li>
			@endif
			@if($maid_job_data[0]->other_duty != '')
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Others:<span style="font-weight:500; margin-left:5px;border-bottom:1px solid #000;">{{ucfirst($maid_job_data[0]->other_duty)}}</span></li>
			@endif
		</ul>
		<h1 style="font-weight:bold;font-size:11px;padding-top:25px;">Place of work (to tick where applicable) </h1>
		<p style="margin-top:15px;"><span>a)</span><span style ="padding-left:30px;"> House Type:</span></p>
		<?php $place_work = explode(';',$maid_job_data[0]->place_of_work);?>
		@foreach($place_work as $place_workid => $place_work_value)
		<?php $place_work_val[]= $place_work_value;?>
		@endforeach
		<ul>
			@if(in_array("Landed Property", $place_work_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Landed Property</li>
			@else
				<li style="list-style-type:none;"><img height='18px'src="<?php echo $root_path."/img/blank.jpg";?>">Landed Property</li>
			@endif
			@if(in_array("Condominium/Private Apartment", $place_work_val))
				<li style="list-style-type:none;"><img height='18px'src="<?php echo $root_path."/img/cheked.jpg";?>">Condominium/Private Apartment</li>
			@else
				<li style="list-style-type:none;"><img height='18px'src="<?php echo $root_path."/img/blank.jpg";?>">Condominium/Private Apartment</li>
			@endif
			@if(in_array("HDB 5-rooms or larger", $place_work_val))
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">HDB 5-rooms or larger</li>
			@else
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/blank.jpg";?>">HDB 5-rooms or larger</li>
			@endif
			@if($maid_job_data[0]->no_rooms != ''&&$maid_job_data[0]->no_rooms != '0')
				<li style="list-style-type:none;"><img height='18px'src="<?php echo $root_path."/img/cheked.jpg";?>">HDB {{$maid_job_data[0]->no_rooms}} -Room Flat(specify no. of rooms)</li>
			@endif
			@if($maid_job_data[0]->other_work_place != '')
				<li style="list-style-type:none;"><img height='18px' src="<?php echo $root_path."/img/cheked.jpg";?>">Others: {{$maid_job_data[0]->other_work_place}}</li>
			@endif
				
		</ul>
		@if($maid_job_data[0]->bedrooms != ''&&$maid_job_data[0]->bedrooms != '0')
		<p style="padding-left:5px;">b)<span style ="padding-left:30px;"> Number of Bedrooms in the house:</span><span style="border-bottom:1px solid #000;">{{$maid_job_data[0]->bedrooms}}</span> </p>
		@endif
		<table class="table table-bordered">
		<tr>
			<td style="text-align:left;">
			__________________________________________ <br />
			FDW's Signature <br/>Date: <?php echo date("d-m-Y");?>
			</td>
			<td>
			</td>
			<td style="padding-left:170px;">
			__________________________________________ <br />
			Employer's Signature <br/>Date: <?php echo date("d-m-Y");?>
			</td>
		</tr>
		</table>
	</div>
</body>
</html>
