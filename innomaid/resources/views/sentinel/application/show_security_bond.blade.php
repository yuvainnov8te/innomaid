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
	margin-top:20px;
    max-width: 100%;
    width: 100%;
	font-size:10px;
	}
.table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    border: 1px solid #000;
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
.table-bordered {
    border-collapse: collapse;
}
.table-bordered td, table th {
    border: 1px solid black;
}
.table-bordered tr:first-child th {
    border-top: 0;
}
.table-bordered tr:last-child td {
    border-bottom: 0;
}
.table-bordered tr td:first-child,
.table-bordered tr th:first-child {
    border-bottom: 1px solid #000;
    border-left: 0 none;
    border-top: 0 none;
    vertical-align: top;
}
.table-bordered tr td:last-child,
.table-bordered tr th:last-child {
   border-bottom: 1px solid #000;
    border-right: 0 none;
    border-top: 0 none;
    vertical-align: top;
}
</style>
<body style="background:white;">
		<div class="container-fluid">
			<div>
			<table class = "table" style="margin-top:0px !important">
					<tr>
						<td>
						<span style="font-weight:bold;white-space:nowrap;">Work Pass Division</span><br/>
						18 Havelock Road<br/>
						Singapore 059764<br/>
						www.mom.gov.sg
						</td>
						<td>
						<img style = "width:80px;margin-left: 250px;"src='<?php echo $root_path."/img/mom-logo.png";?>'/>
						</td>
					</tr>
			</table>
			</div>
		<h1 style="text-align:center;font-size:10px;font-weight:bold;"><span > Employment of Foreign Manpower Act(Chapter 91A) </span><br/>
		<span> Employment of Foreign Manpower Workpass Regulations (Regulation 12) </span><br/>
		<span> Security Bond Form for Foreign Worker ( Domestic and Non-Domestic) </span></h1>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//print_r($employer_details);
		?>
		BY THIS BOND received this 
		@if($maid_rest_day[0]->date_of_bond != '0000-00-00')
			<span style="border-bottom:1px solid #000;padding-left:10px;padding-right:10px;"><?php echo date('d',strtotime($maid_rest_day[0]->date_of_bond));?></span>  day of <span style="border-bottom:1px solid #000;padding-left:10px;padding-right:10px;"><?php echo date('m',strtotime($maid_rest_day[0]->date_of_bond));?></span>20<span style="border-bottom:1px solid #000;padding-left:10px;padding-right:10px;"><?php echo date('y',strtotime($maid_rest_day[0]->date_of_bond));?></span>.<br/><em>(Date indicated must be on/before the Banker's or Insurance Guarantee start date.)</em>
		@else
			<span style="border-bottom:1px solid #000;padding-left:30px;padding-right:30px;">&nbsp;</span> day of <span style="border-bottom:1px solid #000;padding-left:30px;padding-right:30px;">&nbsp;</span>20<span style="border-bottom:1px solid #000;padding-left:30px;padding-right:30px;margin-left:5px;">&nbsp;</span>.<br/><em>(Date indicated must be on/before the Banker's or Insurance Guarantee start date.)</em>
		@endif
		<p>I/We 
		@if($employer_details[0]->employer_name!= '')
					<span style="border-bottom:1px solid #000;margin-left:5px;padding-left:20px;padding-right:20px;">
					{!!ucfirst($employer_details[0]->employer_name)!!}
					</span>
					@else
					<span style="border-bottom:1px solid #000;margin-left:5px;padding-left:20px;padding-right:20px;">&nbsp;</span>
					@endif
					of (or having our registered office at)
					@if($employer_details[0]->address!= '')
					<span style="border-bottom:1px solid #000;margin-left:5px;padding-left:20px;padding-right:20px;">{{ucfirst($employer_details[0]->address)}}</span>
					@else
					<span style="border-bottom:1px solid #000;margin-left:5px;padding-left:20px;padding-right:20px;">&nbsp;</span>
					@endif
					
		acknowledge myself/ourselves bound to pay
		the Government of the Republic of Singapore the sum of SGD$<span style="border-bottom:1px solid #000;margin-left:5px;margin-left:3px;padding-left:20px;padding-right:20px;">5,000.00</span> ("the Obligation").</p>
		<p style="margin-top:5px; margin-bottom:5px;">PURPOSE</p>
		<p>I/We wish to apply for the issue of Work Passes:</p>
		<ol type='a'>
		<li> for the persons whose particulars appear in the Schedule to this Bond (the "Schedule")("the said persons");</li>
		<li> for the number of persons indicated in the Schedule whose particulars shall be supplied from time to time on the date of their arrival in Singapore and when so supplied shall form part of the Schedule("the said persons");</li>
		<li> for the persons whose particulars may from time to time be included in the Schedule with the consent of the Controller of Work Passes prior to or on the date of their arrival in Singapore in substitution for those whose particulars appear in the Schedule("the said persons").</li>
		</ol>
		<p>*(Delete a,b or c as necessary)</p>
		<p style="margin-top:5px; margin-bottom:5px;">STATUTORY AUTHORITY</p>
		<p>The Controller of Work Passes is agreeable to the issuing of Work Passes to the said persons on the following conditions to be observed by me/us in respect of the said persons, namely:-</p>
		<ol type="i">
			<li>That during their stay in Singapore ,I/we shall be responsible for the prompt payment of salary,be responsible for and bear the costs of their upkeep and maintenance, including medical treatment, and given them reasonable notice of and bear the full cost of their repatriation, ensuring that all outstanding salaries or monies due to them have been paid before their repatriation;</li>
			<li>That I/we shall provide acceptable accommodation for them;</li>
			<li>That, if any of them should die while in Singapore, I/we shall be responsible for the cost of their burial or cremation or the return of the body to the country of nationality;</li>
			<li>That I/we shall produce to the Controller of Work Passes any person whose Work Pass has been cancelled or whose Visit Pass/Special Pass has expired or who is required to report to the Controller at such times as I/we may be required to do so;</li>
			<li>That I/we shall employ them in accordance with the Work Pass applicable to them;</li>
			<li>That I/we shall take reasonable steps to ensure that they comply with the Work Pass Conditions applicable to them, and such steps shall include (a) reporting to the Controller of Work Passes if I/we know they are not complying and (b) informing them of the Work Pass conditions applicable to them; and</li>
			<li>That upon completion or termination of employment or resignation form employment of any of them ,or the cancellation or revocaion of their Work Passes, I/we shall inform the Controller of Work Passes in writing within seven days of such completion or termination of employment or resignation from employment and, subject to giving them reasonable notice, I/we shall immediately or within such period that may be specified by the Controller of Work Passes repatriate them. </li>		
		</ol>
		<p> And regulation 12 of the Employment of Foreign Manpower (Work Passes) regulations provides that the Controller of Work Passes may require a bond to ensure compliance of the above conditions.</p>
		<p style="margin-top:5px; margin-bottom:5px;">SECURITY DEPOSIT</p>
		<p>I/we hereby deposit the sum of dollars <span style="border-bottom:1px solid #000;margin-left:5px;margin-left:3px;padding-left:15px;padding-right:15px;font-size:13px">FIVE THOUSAND ONLY </span> (SGD$ <span style="margin-left:5px;margin-left:3px;padding-left:10px;padding-right:10px;">5,000.00</span> )  as security in respect of the performance of the above conditions.</p>
		<p>NOW THE OBLIGATION shall be void and the cash deposit shall be returned to me/us if I/we at all times perform and observe the above conditions.</p>
		<p>But should I/we breach any of the above conditions in respect of any of the said persons, then the Obligation shall be in full force and effect and the amount in respect of that person as indicated in the Schedule shall be forfeitd partially or in whole by the Government of the Republic of Singapore. A partial forfeiture shall not extinguish the Government of the Republic of Singapore's right to forfeit the remainder for the same breach or a different breach.</p>
		<table class="table table-bordered"style="margin-top:0px !important;">
			<tbody>
					<tr><td><span style="padding-left:5px;">Signed,sealed and delivered by**:</span><br/>
					@if($employer_details[0]->employer_name!= '' || $employer_details[0]->employer_nric_no!= '')
					<p style="margin-top:25px;">
					<span style="padding-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {!! ucfirst($employer_details[0]->employer_name)!!} & {{$employer_details[0]->employer_nric_no}}</span>
					</p>
					@else
					<span style="border-bottom:1px solid #000;margin-left:5px;"></span>
					@endif
					</span></td>
					<td><span style="padding-left:5px;">In the presence of:</span><br/>
					
					@else
					<span style="border-bottom:1px solid #000;margin-left:5px;"></span>
					@endif
					</td>
					</tr>
					<tr>
					<td><span style="padding-left:5px;">NRIC/Passport No.,Designation & Signature:</span><br/>
					<p style="margin-top:33px;padding-left:5px;">for and on behalf of <br/>
					<span style="border-top: 1px solid rgb(0, 0, 0); margin-left: 105px;padding-left:25px;padding-right:25px;">Name of Company</span><span style="border-top:1px solid #000;margin-left:30px;padding-left:10px;padding-right:50px;">Seal</span> 
					</p> 
					</td>
					<td><span style="padding-left:5px;font-weight:500;text-align:left;">Name & Address of Witness</span><span style="padding-left: 50px;font-weight:500;text-align:right;">Signature</span><p style="margin-top:25px;padding-left:5px;">
					@if($user_data[0]->company_name!= '' || $user_data[0]->address!= '')
					<span style="padding-left:5px;">{!!ucfirst($user_data[0]->company_name)!!} <br/> {{ucfirst($user_data[0]->address)}}</span>
					</p>
					</td>
			   </tr>
			</tbody>
		</table>
		<h1 style="text-align:center;margin-bottom:0px !important;font-size:12px;">The Schedule**</h1>
		<table class="table table-bordered1 per_info"style="margin-top:5px !important;">
			<tbody>
				<tr>
					<th>S/N</th>
					<th>Name of Worker</th>
					<th>Work Permit Number</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td style="text-align:center;">{{1}}</td>
					<td style="text-align:center;">{{ucfirst($maid_details[0]->name)}}</td>
					<td style="text-align:center;">
					<?php if(isset($maid_details[0]->work_permit_no)) 
					echo $maid_details[0]->work_permit_no;
					?></td>
					<td style="text-align:center;">$5000</td>
				</tr>
			</tbody>
		</table>
		<p>**For sole proprietorships or partnerships, it has to be signed by the sole proprietor or partner. For private limited companies, it has to be signed by a director, registered with ACRA. If the director wishes to appoint his employee to sign the form , he must provide a written authorisation to MOM.</p>
		<p>***To provide another worker's particulars, please provide the details on a separate A4 size paper and attach it together with this Security Bond Form.</p>
</div>
</body>
</html>
