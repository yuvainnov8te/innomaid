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
    margin-bottom: 90px;
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
	font-size:10px;
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
    border: 1px solid #000;
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
.page-break {
    page-break-after: always;
}
.table-bordered {
    border-collapse: collapse;
	margin-top: 60px;
}

.table-bordered tr:first-child th {
    border-top: 1px solid #000;;
}

.table-bordered tr td:first-child,
.table-bordered tr th:first-child {
   border:1px solid #000;
    vertical-align: top;
}

</style>
<body style="background:white;">
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//print_r($employer_details);
		?>
		<div class="container-fluid">
		<div >
			<table class = "table" style="margin-top:0px !important">
					<tr>
						<td>
						<span style="font-weight:bold;white-space:nowrap;">Work Pass Division</span><br/>
						18 Havelock Road<br/>
						Singapore 059764<br/>
						www.mom.gov.sg
						</td>
						<td>
						<img style = "width:180px;margin-left: 300px;"src='<?php echo $root_path."/img/mom-logo.png";?>'/>
						</td>
					</tr>
			</table>
			</div>
		<h1 style="text-align:center;font-weight:bold;">Application for a Foreign Domestic Worker's Work Permit</br> 
		<span>under Sponsorship Scheme</span></h1>
		<h1 style="font-size:12px;font-weight:bold;margin-bottom:25px;">Important Notes:</h1>
		<ol style="font-weight:bold;">
		<li>
		To apply for a foreign domestic worker's WorkPermit under the Spononsorship scheme, the employer must be 60 years old and above with no income and no working adults staying with him/her. The employer must be using the income of his/her sponsorsto apply for the foreing domestic worker. The sponsors refer to the employer's children/children's spouses,grandchildren/grandchildren's spouses or the employere's siblings.
	</li><li>
		Please fill in the particulars of the Sponsor and Sponsor's spouses (if married) in Page1 and sign the Undertaking Letter in Page2.In addition, please complete the attached Work Permit application for a Foreign Domestic Worker form.
		</li><li>Please attach a clear copy of the Sponsor's NRIC, latest Income Tax Notice of Assessment, Birth Certificate of the Employer's Child/Children and Marriage Certificate[if sponsor(s) is/are the Employer's son/daughter-in-law]
		</li></ol>
		<hr/>
		<h1 style="font-size:12px;font-weight:bold;margin-bottom:25px;">Particulas of Sponsor(s):</h1>
		<table class="table table-bordered1"style="margin-top:0px !important;">
			<tbody>
			<tr>
				<th style="width:22%;"></th>
				<th style="font-weight:bold;font-size:13px;">Details of Sponsor 1</th>
				<th style="font-weight:bold;font-size:13px;">Details of Sponsor 2</th>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Name of Sponsor:<br/>(as in NRIC / Passport)</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->sponsor_name_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->sponsor_name_1)}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Gender:</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->gender_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->gender_2)}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Date of Birth:<br/>(DD/MM/YYYY)</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->dob_1}}</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->dob_2}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Nationality:</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->nationality_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->nationality_2)}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Marital status:</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->marital_status_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->marital_status_2)}}</td>
			</tr>	
			<tr>
				<td style="width:22%;padding-left:5px;">Sponsor's Relationship with Employer:</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->relation_with_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->relation_with_2)}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Residential Status:</td>
				<td style="padding-left:5px;">
				@if($maid_work_permit[0]->residential_status_1 == 'Other')
				Others, please specify : {{ucfirst($maid_work_permit[0]->other_residential_status_1)}}
				@else
				{{ucfirst($maid_work_permit[0]->residential_status_1)}}
				@endif
				</td>
				<td style="padding-left:5px;">
				@if($maid_work_permit[0]->residential_status_2 == 'Other')
				Others, please specify : {{ucfirst($maid_work_permit[0]->other_residential_status_2)}}
				@else
				{{ucfirst($maid_work_permit[0]->residential_status_2)}}
				@endif
				</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Sponsor's Identity <br/>Card/Malaysian Old or New <br/>IC/Passport Number/FIN:</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->passport_number_1}}</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->passport_number_2}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Sponsor's Occupation:</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->occupation_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->occupation_2)}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Name of Company:</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->company_name_1)}}</td>
				<td style="padding-left:5px;">{{ucfirst($maid_work_permit[0]->company_name_2)}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Conatact Number:</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->contact_number_1}}</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->contact_number_2}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Email Address:</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->email_address_1}}</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->email_address_2}}</td>
			</tr>
			<tr>
				<td style="width:22%;padding-left:5px;">Is the Sponsor's NRIC address different from the Employer's address?:</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->address_difference_1}}</td>
				<td style="padding-left:5px;">{{$maid_work_permit[0]->address_difference_2}}</td>
			</tr>
			</tbody>
		</table>
		<h1 style="font-size:12px;margin-bottom:25px;">Particulars of Sponsor's Spouse(s):</h1>
		<table class="table table-bordered1"style="margin-top:0px !important;">
			<tbody>
				<tr>
					<th style="width:22%;"></th>
					<th style="font-size:13px;">Details of Sponsor 1's Spouse (if married)</th>
					<th style="font-size:13px;">Details of Sponsor 2's Spouse (if married)</th>
				</tr>
				<tr>
					<td style="padding-left:5px;">Name of Sponsor's <br/>Spouse:<br/>(as in NRIC/Passport)</td>
					<td style="padding-left:5px;">
					@if($maid_work_permit[0]->sponsor_spouse_name_1 != '')
					{{ucfirst($maid_work_permit[0]->sponsor_spouse_name_1)}}
					@else
					{{ '-' }}
					@endif
					</td>
					<td style="padding-left:5px;">
					@if($maid_work_permit[0]->sponsor_spouse_name_2 != '')
					{{ucfirst($maid_work_permit[0]->sponsor_spouse_name_2)}}
					@else
					{{ '-' }}
					@endif
					</td>
				</tr>
				<tr>
					<td style="padding-left:5px;">Spouse's Identity Card/<br/>Passport Number/FIN:</td>
					<td style="padding-left:5px;">
					@if($maid_work_permit[0]->passport_spouse_number_1 != '')
					{{$maid_work_permit[0]->passport_spouse_number_1}}
					@else
					{{ '-' }}
					@endif
					</td>
					<td style="padding-left:5px;">
					@if($maid_work_permit[0]->passport_spouse_number_2 != '')
					{{$maid_work_permit[0]->passport_spouse_number_2}}
					@else
					{{ '-' }}
					@endif
				</td>
			   </tr>
			</tbody>
		</table>
		<span>*Delete where inapplicable.</span>
		<div class="page-break"></div>
		<div style="line-height:1.7;">
		<h1 style="text-align:center;font-weight:bold;margin-bottom:45px;">Undertaking Letter by the Sponsor(s)</h1>
		<hr/>
		<p>I/We, the undersigned hereby undertake the following conditions:</p>
		<ol>
		<li>To be responsible for the upkeep, maintenance and well-being of the foreign domestic worker.</li>
		<li>In the event that I or any of the undersigned subsequently apply for a foreign domstic worker for my/own household at anytime during the Work Permit validity of the foreign domestic worker, this undertaking shall be taken into consideration.</li>
		<li>This undertaking shall be valid for the period the employer(as stated above) is employing a foreign domestic worker under my/our sponsorship.</li>
		<li>To sponsor and pay the Foreign Worker Levy and all other employment related expenses on behalf of (Name of Employer)&nbsp;<span style="border-bottom:1px solid #000;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{$employer_details[0]->employer_name}}</span>, who is applying to employ a foreign domestic worker, in the event the said application is successful.</li></ol>
		<p style="margin-top: 50px;">Dated<span style="border-bottom:1px solid #000;padding-left: 50px;padding-right: 50px;">&nbsp;</span> day of <span style="border-bottom:1px solid #000;padding-left: 50px; padding-right: 50px;">&nbsp;</span>month<span style="border-bottom:1px solid #000;padding-left: 50px;padding-right: 50px;">&nbsp;</span> year.</p>
		<br/>
		<div style="margin-top:50px;"> 
		<span style="border-top:1px solid #000;text-align:left;padding-left: 7px;
    padding-right: 210px;">Signature of Sponsor 1 &nbsp;</span>	
		<span style="border-top:1px solid #000;padding-left:10px;margin-left: 60px;
    padding-right: 100px;text-align:right;">Singature of Sponsor 2 &nbsp;</span>
		</div>
		<br/>
		<h1 style="font-size:12px;font-weight:bold;margin-bottom:25px;margin-top: 45px;;">Details of Sponsor 1's Witness</h1><br/>
		<hr style="margin-top: 50px;"/>
		<span>Name of Witness</span><span style="padding-right: 250px;
    padding-left: 250px;"> NRIC No.</span><span> Signature</span>
		<br/>
		<h1 style="font-size:12px;font-weight:bold;margin-bottom:25px;margin-top: 50px;">Details of Sponsor 2's Witness</h1><br/>
		<hr style="margin-top: 50px;"/>
		<span>Name of Witness</span><span style="padding-right: 250px;
    padding-left: 250px;"> NRIC No.</span><span> Signature</span>
		<table class="table table-bordered" >
			<tr>
				<td colspan = '3' style="border-bottom:0 none;font-weight:bold;"><span style="padding-left:10px;">For Official Use</span></td>
			</tr>
			<tr>
				<td colspan = '3' style="border-top:0 none;padding-top:10px;font-weight:bold;"><span style="padding-left:10px;padding-bottom:15px;">DOA:</span>
				<span style="padding-left: 220px;padding-right: 220px;font-weight:bold;padding-bottom:15px;">NRIC No./FIN:</span>
				<span style="padding-bottom:15px;">WP No:</span></td>
			</tr>
		</table>
		</div>	
		</div>
</body>
</html>
