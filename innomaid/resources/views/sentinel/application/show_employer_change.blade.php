
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
$root_path = $_SERVER['DOCUMENT_ROOT'];
?>
<style type="text/css">

body {
    color: #4d4d4d;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 15px;
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
    color:#4d4d4d;
    line-height: 1.1;
    height: 0;
}
.fkm-heading {
    float: left;
}
.fkm-heading h4, h5 {
    color: #4d4d4d;
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
	font-color:#4d4d4d;
	font-weight:bold;

	
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
	<div style="padding-left:45px;">
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				$from = new DateTime($employer_details[0]->employer_date_of_birth);
			$to   = new DateTime('today');
			 $age = $from->diff($to)->y;
				//print_r($employer_details);
			
		?>	
		
			<p style="  margin-top: 50px;"><span style="padding-top:20px;font-weight:bold;">Date:</span><br/>
								<p style="font-weight:bold;margin-top: 65px;">To:
								<br/><br/>
								Work Pass Division<br/>
								Ministry of Manpower<br/>
								18 Havelock Road <br/>
								Singapore 059764
								</p>
								<p style="font-weight:bold;margin-top: 65px;"> <span style="font-weight:bold;">Dear Sir/Mdm</span>
								</p>
								<table class = "table" >
								<tr>
									<td>Foreign Worker<span style="padding-left: 68px;">:{{ucfirst($maid_details[0]->name)}}</span></td>
								</tr>
								<tr>
								<td>Work Permit Number<span style="padding-left: 29px;">:<?php if(isset($maid_details[0]->work_permit_no)) 
									echo $maid_details[0]->work_permit_no;?></span></td>
								</tr>
								<tr>
								<td>Date of Application<span style="padding-left: 41px;">:</span></td>
								</tr>
								</table>
								<p style="padding-top: 30px;font-weight:bold;line-height:2.5">I, <span style="border-bottom:1px solid #000;padding-right:100px;margin-left:5px;"> <?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>( Name of Current Employer )  of IC / Passport No. S7349027H<br/>
									Agree to release my domestic worker named above to the prospective employer,<br/> <span style="border-bottom:1px solid #000;padding-right:350px;margin-left:5px;">&nbsp;</span>( Name of Prospective Employer )
								</p>

								<div>
								<p style="font-size:12px;font-weight:bold;margin-top: 65px;">Pending the outcome of the application, I undertake all the responsibilities for the employment of the said domestic worker and will extend her work permit
								(if necessary). If the application is not approved and I do not wish to continue her employment, I will repatriate this worker. </p>
								</div>
								<table class = "table" style="margin-top:70px !important;margin-bottom:0px !important;line-height: 2;font-weight:bold;">
								<tr>
									<td >
										<span>
											<span style="border-top:1px solid #000;">Signature of Current Employer</span>
										</span>
									</td>
								</tr>
							</table>						
		</div>
</body>
</html>		
