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
	font-size:13px;
	
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
<body style="background:white;">
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				//echo '<pre>';print_r($employer_details);
				//print_r($user_data);
				//echo '<pre>'; print_r($maid_details);
				
			
		?>	
	
		<h2 align='center'> <span style="font-weight: bold; font-size: 16px;">UNDERTAKING OF EMPLOYER FOR THE EMPLOYMENT OF A HOUSEHOLD SERVICE WORKER (HSW)</span></h2>
		<br/><br/><br/><br/><br/><br/><br/><br/>
		<span style="color: #000;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, <span style="border-bottom: 1px solid #000;padding-left: 20%; padding-right: 20%; ">{{$employer_details[0]->employer_name}} </span>,with residence and postal address at<br/><span style="padding-left:25%">(name of employer)</span><br/><br/><span style="border-bottom: 1px solid #000;padding-left: 20%; padding-right: 20%; ">{{$employer_details[0]->address}}</span>,in connection with the employment <br/><span style="padding-left:25%">(address of employer)</span><br/><br/>of filipino household service worker(HSW) thru&nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid #000;padding-left: 20%; padding-right: 20%; ">{{$user_data[0]->company_name}}</span>
		<br/><span style="padding-left:65%">(name of agency)</span><br/><br/>do hereby undertake the following:</span><br/>
		<table class="table" style="margin-top: 20px; margin-left:20px;color: #000;">
			<tr><td>1.<br/><br/><br/></td><td>That I will shoulder all expenses to be inccured in hiring <span style="border-bottom: 1px solid #000;padding-left: 15%; padding-right: 15%; ">{{$maid_details[0]->name}}</span><br/><span style="padding-left:65%">(name of HSW)</span><br/>including recruitment agency fees, if applicable;</td></tr>
			<tr><td>2.<br/><br/></td><td>That I shall not allow the deduction of any amount from the monthly salary/wages of above-named HSW as placement fee or refund of expenses and agency fees;</td></tr>
			<tr><td>3.<br/><br/></td><td>That upon the arrival of the HSW, I will allow/permit her to attend the post-arrival orientation Seminar(PAOS) being conducted by the philippine embassy for newly arrived workers;</td></tr>
			<tr><td>4.<br/></td><td>That the HSW shall be permitted to communicate with the embassy when needed and have custody of her passport/travel documents at all times;</td></tr>
			<tr><td>5.<br/></td><td>That I shall provide the HSW with separate sleeping quarters and given a rest period of at least eight(8) continous hours daily;</td></tr>
			<tr><td>6.<br/></td><td>That HSW shall be given a weekly rest day as provided in the employment contract and as required under MOM regulations;</td></tr>
			<tr><td>7.<br/></td><td>That HSW shall be made to work in my residence only and shall be treated humanely by me and other persons staying at my house;</td></tr>
			<tr><td>8.<br/></td><td>That HSW shall be allowed to freely communicate with her family in the philippines at reasonable times of the day or night;</td></tr>
			<tr><td>9.<br/><br/></td><td>That I shall not make the HSW extend her contract or transfer to another employer without informing the philippine Embassy and shall present the person of the HSW to the embassy when so required; </td></tr>
			<tr><td>10.<br/><br/></td><td>That I shall notify the philippine Embassy of any significant sevelopments about the condition and employment of the HSW including her repatriation;</td></tr>
			<tr><td>11.<br/></td><td>That I shall explain to the members of my household the foregoing undertaking and ensure that the undertakings are observed by them;and </td></tr>
			<tr><td>12.<br/></td><td>That I shall assist the HSW in availing of benifits provided under the law of <u>SINGAPORE.</u></td></tr>
		</table>
		<table class="table" style="margin-top: 30px;">
			<tr><td colspan='3'>It is my understanding that if any or all of the above undertakings are violated or not compiled with, I will be blacklisted and banned from hiring household service workers from the philippines.<br/><br/><br/><br/></td></tr>
			<tr><td>_____________________________<br/><span style="padding-left:25%">Date</span> </td><td></td><td>__________________________<br/><span style="padding-left:10%">Signature of Employer</span></td></tr>
		</table>
		
			
		
		<div class="page-break"></div>
		<h2 align='center'> <span style="font-weight: bold; font-size: 16px;">UNDERTAKING OF EMPLOYER FOR THE EMPLOYMENT OF A HOUSEHOLD SERVICE WORKER (HSW)</span></h2>
		<br/><br/><br/><br/><br/><br/><br/><br/>
		<span style="color: #000;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, <span style="border-bottom: 1px solid #000;padding-left: 20%; padding-right: 20%; ">{{$employer_details[0]->employer_name}} </span>,with residence and postal address at<br/><span style="padding-left:25%">(name of employer)</span><br/><br/><span style="border-bottom: 1px solid #000;padding-left: 20%; padding-right: 20%; ">{{$employer_details[0]->address}}</span>,in connection with the employment <br/><span style="padding-left:25%">(address of employer)</span><br/><br/>of filipino household service worker(HSW) thru&nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid #000;padding-left: 20%; padding-right: 20%; ">{{$user_data[0]->company_name}}</span>
		<br/><span style="padding-left:65%">(name of agency)</span><br/><br/>do hereby undertake the following:</span><br/>
		<table class="table" style="margin-top: 20px; margin-left:20px;color: #000;">
			<tr><td>1.<br/><br/><br/></td><td>That I will shoulder all expenses to be inccured in hiring <span style="border-bottom: 1px solid #000;padding-left: 15%; padding-right: 15%; ">{{$maid_details[0]->name}}</span><br/><span style="padding-left:65%">(name of HSW)</span><br/>including recruitment agency fees, if applicable;</td></tr>
			<tr><td>2.<br/><br/></td><td>That I shall not allow the deduction of any amount from the monthly salary/wages of above-named HSW as placement fee or refund of expenses and agency fees;</td></tr>
			<tr><td>3.<br/><br/></td><td>That upon the arrival of the HSW, I will allow/permit her to attend the post-arrival orientation Seminar(PAOS) being conducted by the philippine embassy for newly arrived workers;</td></tr>
			<tr><td>4.<br/></td><td>That the HSW shall be permitted to communicate with the embassy when needed and have custody of her passport/travel documents at all times;</td></tr>
			<tr><td>5.<br/></td><td>That I shall provide the HSW with separate sleeping quarters and given a rest period of at least eight(8) continous hours daily;</td></tr>
			<tr><td>6.<br/></td><td>That HSW shall be given a weekly rest day as provided in the employment contract and as required under MOM regulations;</td></tr>
			<tr><td>7.<br/></td><td>That HSW shall be made to work in my residence only and shall be treated humanely by me and other persons staying at my house;</td></tr>
			<tr><td>8.<br/></td><td>That HSW shall be allowed to freely communicate with her family in the philippines at reasonable times of the day or night;</td></tr>
			<tr><td>9.<br/><br/></td><td>That I shall not make the HSW extend her contract or transfer to another employer without informing the philippine Embassy and shall present the person of the HSW to the embassy when so required; </td></tr>
			<tr><td>10.<br/><br/></td><td>That I shall notify the philippine Embassy of any significant sevelopments about the condition and employment of the HSW including her repatriation;</td></tr>
			<tr><td>11.<br/></td><td>That I shall explain to the members of my household the foregoing undertaking and ensure that the undertakings are observed by them;and </td></tr>
			<tr><td>12.<br/></td><td>That I shall assist the HSW in availing of benifits provided under the law of <u>SINGAPORE.</u></td></tr>
		</table>
		<table class="table" style="margin-top: 30px;">
			<tr><td colspan='3'>It is my understanding that if any or all of the above undertakings are violated or not compiled with, I will be blacklisted and banned from hiring household service workers from the philippines.<br/><br/><br/><br/></td></tr>
			<tr><td>_____________________________<br/><span style="padding-left:25%">Date</span> </td><td></td><td>__________________________<br/><span style="padding-left:10%">Signature of Employer</span></td></tr>
		</table>
		
			
			
</body>
</html>

