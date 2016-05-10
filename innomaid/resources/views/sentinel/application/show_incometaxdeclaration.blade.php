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
	line-height:1.5;
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
	line-height:1.7;
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
.table-bordered1 {
    border-collapse: collapse;
}
.table-bordered1 td, table th {
    border: 1px solid black;
}
.table-bordered1 tr:first-child th {
    border-left: 0;
}
.table-bordered1 tr:last-child td {
    border-right: 0;
}
.table-bordered1 tr td:first-child,
.table-bordered1 tr th:first-child {
    border-bottom: 1px solid #000;
    border-left: 0 none;

}
.table-bordered1 tr td:last-child,
.table-bordered1 tr th:last-child {
   border-bottom: 1px solid #000;
    border-right: 0 none;

}

</style>
<body style="background:white;">
			<div >
			<table class = "table table-bordered" style="margin-top:0px !important">
					<tr>
						<td>
						<span style="font-weight:bold;white-space:nowrap;">Work Pass Division</span><br/>
						18 Havelock Road<br/>
						Singapore 059764<br/>
						www.mom.gov.sg<br/>
						mom_wpd@mom.gov.sg
						</td>
						<td>
						<img style = "width:180px;margin-left:250px;"src='<?php echo $root_path."/img/mom-logo.png";?>'/>
						</td>
					</tr>
			</table>
			</div>
		<h1 style="text-align:center;font-weight:bold;"><span>Annex A</span><br/>
		<span > Employer and Spouse Income Tax Declaration </span></h1>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//print_r($employer_details);
		?>
		<h1 style="font-size:12px;margin-bottom:50px;">Please complete this form only if you do not wish to submit your Income Tax Notice of Assessment when applying for a Work Permit (WP) for a foreign domestic worker.</h1>
		<h1 style="font-size:12px;margin-bottom:30px;">Part I - Monthly Combined Income of Employer and Spouse</h1>
		<h1 style="font-size:12px;margin-bottom:30px;">Please tick the appropriate box.</h1>
		<table class="table table-bordered" style="margin-top:0px !important;margin-bottom:25px;">
			<tr>
				@if($maid_tax_declaration[0]->combined_income == 'Below $2,000')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">Below $2,000</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> Below $2,000</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$2,000 to $2,499')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$2,000 to $2,499</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $2,000 to $2,499</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$2,500 to $2,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$2,500 to $2,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $2,500 to $2,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$3,000 to $3,499')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$3,000 to $3,499</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $3,000 to $3,499</span></td>
				@endif
			</tr>
			<tr>
				@if($maid_tax_declaration[0]->combined_income =='$3,500 to $3,999' )
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$3,500 to $3,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $3,500 to $3,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$4,000 to $4,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$4,000 to $4,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $4,000 to $4,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$5,000 to $5,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$5,000 to $5,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $5,000 to $5,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$6,000 to $7,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$6,000 to $7,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $6,000 to $7,999</span></td>
				@endif
			</tr>
			<tr>
				@if($maid_tax_declaration[0]->combined_income == '$8,000 to $9,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$8,000 to $9,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $8,000 to $9,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$10,000 to $12,499')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$10,000 to $12,499</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $10,000 to $12,499</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$12,500 to $14,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$12,500 to $14,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $12,500 to $14,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$15,000 to $19,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$15,000 to $19,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $15,000 to $19,999</span></td>
				@endif
			</tr>
			<tr>
				@if($maid_tax_declaration[0]->combined_income == '$20,000 to $24,999')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$20,000 to $24,999</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $20,000 to $24,999</span></td>
				@endif
				@if($maid_tax_declaration[0]->combined_income == '$25,000 and above')
				<td><span style ="font-weight:500;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>">$25,000 and above</td>
				@else
				<td><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"> $25,000 and above</span></td>
				@endif
			</tr>
		</table>
		<h1 style="font-size:12px;margin-bottom:25px;">Part II - Authorisation by Employer and His/Her Spouse</h1>
		<p>If either you and/or your spouse do not wish to submit a copy of your Income Tax Notice of Assessment, please complete Part II and authorise the Comptroller of Income Tax to verify your income range stated in Part I above and communicate the results of the verification to the Controller of Work Passes.</p>
		<p>I,<span style="border-bottom:1px solid #000;padding-left:130px;padding-right:150px;"> <?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>, *NRIC/WP No/FIN:<span style="border-bottom:1px solid #000;padding-left:100px;padding-right:100px;">{{$employer_details[0]->employer_nric_no}}</span>,
		</p>
		<p>
		and/or I,
		<span style="border-bottom:1px solid #000;padding-left:150px;padding-right:100px;">
		@if($employer_details[0]->spouse_name)
		{{ucfirst($employer_details[0]->spouse_name)}}
		@else
		{{ '-' }}
		@endif
		</span>
		, *NRIC/WP No/FIN:
		<span style="border-bottom:1px solid #000;padding-left:100px;padding-right:163px;">
		@if($employer_details[0]->spouse_nric_no)
		{{$employer_details[0]->spouse_nric_no}}
		@else
		{{ '-' }}
		@endif
		</span>,
		</p>
		<p>authorise the Comptroller of Income Tax to verify *my/our income tax range stated in Part I above, based on *my/our assessment record(s) for the current Year of Assessment and the two previous Years of Assessment for the Controller of Work Passes. *I/We also authorise the Comprtoller of Income Tax to thereafter communicate the results of the verfication to the Controller of Work Passes.
		</p>
		<p> In the event that *my/our assessment record(s) for the current Year of Assessment *is/are not available or finalised at the point of verification, I*/we understand that the Comptroller of Income Tax will verify *my/our income range stated in Part I against *my/our assessment record(s) for the two previous Years of Assessment.</p>
		<table class="table table-bordered1">
			<tbody>
				<tr>
					<th>Employer</th>
					<th>Employer's Spouse</th>
				</tr>
				<tr>
					<td style="padding-left:5px; padding-bottom:20px">Income Tax Notice of Assessment No:
					{{$employer_details[0]->employer_nric_no}}
					</td>
					<td style="padding-left:5px;padding-bottom:20px">Income Tax Notice of Assessment No:
					{{$employer_details[0]->spouse_nric_no}}
					</td>
				</tr>
				<tr>
					<td style="padding-left:5px;padding-bottom:20px">Signature:</td>
					<td style="padding-left:5px;">Signature:</td>
				</tr>
				<tr>
					<td style="padding-left:5px;padding-bottom:20px">Date: <?php echo date("d-m-Y");?></td>
					<td style="padding-left:5px;padding-bottom:20px">Date: <?php echo date("d-m-Y");?></td>
				</tr>
			</tbody>
		</table>
		*Delete where inapplicable 
</div>
</body>
</html>
