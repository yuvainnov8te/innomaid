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
	font-size:8px;
	
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
<body style="background:white;font-size:10px;">
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//echo '<pre>';print_r($employer_details);
				//print_r($user_data);
				//echo '<pre>'; print_r($maid_details);
				
			
		?>	
		<h2 align='center'> <span style="font-size:16px;font-weight: bold;"> STANDARD EMPLOYEMENT CONTRACT</span></h2><br/>
		<h4 align='center'> <span> For Filipino Household Service Worker</span></h4><br/>
		<p> This employment contract is executed and entered in by and between: </p><br/>
		
		
		<table class="table" style="margin-top: -10px; margin-bottom: 5px; table-layout: auto; text-align:left;">
			<tr>
				<td> A.<br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
				<td>
					<table width="100%">
					<tr><td> Employer:</td><td colspan='3' width='90%' style="border-bottom: 1px solid #000;">{{$employer_details[0]->employer_name}}</td></tr>
					<tr><td> Address:</td><td colspan='3' width='90%' style="border-bottom: 1px solid #000;"> {{$employer_details[0]->address}}</td></tr>
					<tr>
						<td style="width: 10% !important"> Civil Status: </td>
						<td colspan='3'>
							<table width='100%' style="table-layout: auto;">
							<tr>
								<td style="border-bottom: 1px solid #000;">{{$employer_details[0]->marital_status}}</td><td width="20%">Contact Number:</td><td style="border-bottom: 1px solid #000;">{{$employer_details[0]->employer_mobile_phone}}</td>
							</tr>
							</table>
						</td>
						
					</tr> 
					<tr width='100%'><td colspan='4'> Represented in the host country by: </td></tr>
					<tr><td width='30%'> Foreign Placement Agency:</td><td colspan='3' style="border-bottom: 1px solid #000;"> </td></tr>
					<tr><td> Address:</td><td colspan='3' style="border-bottom: 1px solid #000;"> </td></tr>
					<tr><td> Contact Numbers:</td><td colspan='3' style="border-bottom: 1px solid #000;"> </td></tr>
					</table>
			    </td>
			</tr>
		</table>
		<p style=" padding-left: 50%;">and the </p>
		<table class="table" style=" margin-top:-10px;">
			<tr>
				<td> B.<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
				<td>
					<table width='100%'>
					<tr><td width='30%'> Household Service Worker:</td><td colspan='3' style="border-bottom: 1px solid #000;"> {{$maid_details[0]->name}}</td></tr>
					<tr>
						<td> Philippine Address:</td><td  colspan='3'width='90%' style="border-bottom: 1px solid #000;"> </td>
					</tr>
					<tr>
						<td> Civil Status: </td>
						<td colspan='3'>
							<table width='100%' style="table-layout: auto;">
							<tr>
								<td style="border-bottom: 1px solid #000;">{{$employer_details[0]->marital_status}}</td><td width="20%">Contact Number:</td><td style="border-bottom: 1px solid #000;">{{$employer_details[0]->employer_mobile_phone}}</td>
							</tr>
							</table>
						</td>
						
					</tr> 
					<tr>
						<td> Passport Number: </td>
						<td colspan='3'>
							<table width='100%' style="table-layout: auto;">
							<tr>
								<td style="border-bottom: 1px solid #000;"> {{$maid_details[0]->passport_number}}</td><td width='25%'>Date of issue & place:  </td><td style="border-bottom: 1px solid #000;"> </td>
							</tr>
							</table>
						</td>
						
					</tr> 
				
					<tr><td colspan='4'> Represented in the philippines by: </td></tr>
					<tr><td> Philippine Recruitment Agency:</td><td colspan='3' style="border-bottom: 1px solid #000;"> </td></tr>
					<tr><td> Address:</td><td colspan='3' style="border-bottom: 1px solid #000;"> </td ></tr>
					<tr><td> Contact Numbers:</td><td colspan='3' style="border-bottom: 1px solid #000;"> </td></tr>
					</table>
			    </td>
			</tr>
		</table>
		<table class="table" style="font-size: 10px;">
			<tr>
				<td> </td><td>Voluntarily binding themselves to the following terms and conditions</td>
			</tr>
			<tr><td>1.</td><td>Site of Employment: Singapore </td></tr>
			<tr><td>2.<br/></td><td>Contract duration: TWO(2) years of commencing from the household services worker's departure from the point of origin to the site of employment .</td></tr>
			<tr><td>3.</td><td>Basic monthly salary: US$400.00 or it's equivalent in local money.</td></tr>
			<tr><td>4.</td><td> Work hours: The household service worker shall be provided with continuous rest of at least 8 hours per day.</td></tr>
			<tr><td>5.</td><td></td></tr>
		    <tr><td>6.<br/><br/><br/></td><td>Free transportation to the site of employment and back to the point of origin upon expiration of the contract or when contract of employment is terminated through no fault of the household service and/or due to force majeure.In case of contract renewal, free round trip economy class air ticket shall be provided by the employer.</td></tr>
			<tr><td>7.<br/><br/></td><td>The employer shall furnish the household service worker, free of charge, saperate, suitable and sanitary living auarters as well as adequate food or food allowance.</td></tr> 
			<tr><td>8.</td><td>Free emergency medical and dental services for the household service worker including facilities and medicine. </td></tr>
			<tr><td>9.</td><td>Vacation leave with full pay of not less than 15 calender days for every year of service to be availed of upon completion of the contract</td></tr>
			<tr><td>10.<br/><br/></td><td>The employer shall provide the household service worker with personal life accident, medical and repatriation insurance with reputable insurance company in the host country.</td></tr>
			<tr><td>11.<br/><br/><br/></td><td>In the event of death of the household service during the term of this contract, his/her remain and personal belongings shall be repatriated to the philippines at the expense of the Employer. In case the repatriation of remains is not possible, the same may be disposed of upon prior approval of the household service worker's next of the kin or by philippine Embassy. </td></tr>
		</table>
		<table width="90%" style="margin-top: 10px; padding-left: 45px; font-size: 10px;">
		<tr> 
			<td width='30%'style="border-top: 1px solid #000;"><span style="padding-left:40px;">Employer</span></td>
			<td width='30%'></td>
			<td width='30%' style="border-top: 1px solid #000;"><span style="padding-left:10px;">Household service worker</span></td>
		</tr>
		</table>
		
		
		
			
			
</body>
</html>

