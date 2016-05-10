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
    color: #000;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 10px;
    line-height: 1.42857;
}
.h3, h3 {
    font-size: 14px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color:#000;
    line-height: 1.1;
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
	font-size:10px;
	
}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}
#mytst
{
	width:26%;
}
.align
{
width:33.33px;
}
#rotate {
     -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
		 }
.page-break {
    page-break-after: always;
}
</style>
<body style="background:white;">
	<div>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
			$from = new DateTime($employer_details[0]->employer_date_of_birth);
			$to   = new DateTime('today');
			 $age = $from->diff($to)->y;
		?>		
		  <table class="table"style="margin-top:0px !important;margin-bottom:0px !important;">
	  <tr><td width='50%' style="vertical-align:top;"><img  width = '200px' src="<?php echo $root_path."/img/smarthelper_logo1.jpg";?>"/></td>
	  
	  	<td width='50%' style="vertical-align:top-right;padding-left:170px;">
									
<p style="font-size: 10px;float: right;">AXA INSURANCE SINGAPORE PTE LTD<br>8 Shenton Way, #27-01 AXA Tower<br>Singapore 068811<br>website: www.axa.com.sg<br>GST Registration No.: M2-0009922-2<br>Co.Reg.NO.: 196900406D</p></td></tr>
	  </table>
	  
	  <table align="center" style="margin-top: 3px;margin-bottom:3px ; ">
		<tr>
		<td>
			<span><img  width = '70px' src="<?php echo $root_path."/img/smarthelper_logo2.jpg";?>" style="padding-left:150px;"/></span>
		</td>
		<td>
		<p align='center'style=""> <b>Smart</b><i>Helper</i><br/> 
		<span style="font-weight:bold; font-size:14px;">ANDA INSURANCE AGENCIES PTE LTD</span><span style="font-size: 9px;"><br/>
		190 MacPherson Road #03-01,Wisma Gulab, Singapore 348548<br/>
		<span style="font-weight: bold;">Tel: 6534 2288  Fax: 6534 2222</span><span> Email: enquiries@anda.com.sg<br/>
		Website: www.anda.com.sg Co.Reg.No.: 197903504K GST Reg. No.:M2-0036589-5</span>
		</p>
		</td>
		</tr>
	  </table>
	  
	  <table style=" border: 1px solid black; margin-top: 2px; margin-bottom:2px ; font-size: 9px;">

		<tr><td><p style=" text-align:center;"> Statement Pursuant to Section 25(5) of the Insurance Act, Singapore : You are ro disclose in this proposal form fully and faithfully all the facts which you know or ought to know, otherwise the policy issued hereunder may be void.</p></td></tr>
	  </table >
	  
	  <table class="table table-bordered"   cellspacing='0' cellpadding='0' style="margin-top: 2px; margin-bottom: 0px ;" >
		<tr><td style="vertical-align:bottom; height: 100px; width: 1%; "> <div id="rotate" style="font-size: 8px;">EMPLOYER</div></td>
	     <td>
	       <table class= "table" cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important; height: 100px; border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important; ">
	    <tr><td colspan='4' style=" border-bottom: 1px solid #000" >
		<span style="white-space:nowrap;padding-left:5px;">Name ( Mr/Mrs/Mdm/Miss/Dr)</span>
		<span style="white-space:nowrap;padding-left:5px;"><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</span>
		</td></tr>
	    <tr><td colspan='4' style=" border-bottom: 1px solid #000">
		<span style="white-space:nowrap;padding-left:5px;">Home Address:</span>
		<span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->address)}}</span>
		</td></tr>
		<tr><td colspan='3' style=" border-bottom: 1px solid #000">
		</td><td style=" border-bottom: 1px solid #000">Postal Code 
		</td></tr>
	    <tr><td colspan='2'style=" border-bottom: 1px solid #000"> 
		<span style="white-space:nowrap;padding-left:5px;">NRIC No/ FIN No:</span>
		<span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_nric_no}}</span>
		</td>
		<td colspan="2" style=" border-bottom: 1px solid #000">
			<span style="white-space:nowrap;padding-left:5px;">SB Transmission Ref No</span>
		<span style="white-space:nowrap;padding-left:5px;">{{$insurance_data[0]->SB_transmission_number}}</span>
		</td></tr>
		  <tr><td colspan='3' style=" border-bottom: 1px solid #000">
		  <span style="white-space:nowrap;padding-left:5px;">  Occupation :</span>
		  <span style="white-space:nowrap;">{{ucfirst($employer_details[0]->employer_profession)}}</span>
		  </td>
		  <td style=" border-bottom: 1px solid #000">
		  <span style="white-space:nowrap;padding-left:5px;"> Company's Name/Employer :</span>
		  <span style="white-space:nowrap;padding-left:5px;">{{ucfirst($employer_details[0]->employer_company)}}</span>
		  </td></tr>
		<tr><td>
		 <span style="white-space:nowrap;padding-left:5px;"> Tel(Home): </span>
		  <span style="white-space:nowrap;padding-left:5px;">{{$employer_details[0]->employer_mobile_phone}}</span>
		</td> 
		<td>
		 <span style="white-space:nowrap;padding-left:5px;"> (Office):</span>
		</td><td>
		 <span style="white-space:nowrap;padding-left:5px;">(H/P):</span>
		</td> 
		<td>

		 <span style="white-space:nowrap;padding-left:5px;">Email:</span>
		 
		</td> </tr>
	  </table>
	  </td></tr>     
	  </table>
	  <table class="table table-bordered"   cellspacing='0' cellpadding='0' style="margin-top: 5px !important; margin-bottom: 0px !important; height: 100px;" >
	  <tr><td style="vertical-align:middle;  width: 1%; "> <div id="rotate" style="font-size: 8px;">MAID</div></td>
	   <td>
	   <table class= "table" style="margin-top:0px; margin-bottom:20px !important;">
	    <tr><td colspan='3' style="border-bottom: 1px solid #000;">Name of Domestic Helper:
		<span style=" padding-right:50px;margin-left:5px;">{{ucfirst($maid_details[0]->name)}}</span></td></tr>
	    <tr>
		<td >
		Passport No.:<span style=" padding-right:83px;">{{$maid_details[0]->passport_number}}</span>
		</td>
		<td >Date of Birth : <span style=" padding-right:50px;"><?php echo date('d/m/Y', strtotime($maid_details[0]->date_of_birth));?></span>
		</td>
			<td >W.P.No: <span style=" padding-right:150px;"><?php if(isset($maid_details[0]->work_permit_no)) 
		echo $maid_details[0]->work_permit_no;
		else
		echo ' ';
		?></span></td>
		</tr>
	    <tr><td colspan='3'style="padding-top: 3px; border-top: 0.5px solid black" > Nationality :
		<span>(a)</span>
		@if($nationality[0]->nationality_name == 'Philippines')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>Filipina</span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Filipina</span>
		@endif
		<span>(b)</span>
		@if($nationality[0]->nationality_name == 'Sri Lankan')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>Sri Lankan</span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Sri Lankan</span>
		@endif
		<span>(c)</span> 
		@if($nationality[0]->nationality_name == 'Thailand')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>Thai</span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Thai</span>
		@endif
		
		<span>(d)</span>
		@if($nationality[0]->nationality_name == 'Indonesian')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:5px;"/>Indonasian</span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Indonasian</span>
		@endif
		<span>(e) </span>
		@if($nationality[0]->nationality_name == 'Indian')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>Indian</span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Indian</span>
		@endif
		
		<span>(f)</span>
		@if($nationality[0]->nationality_name == 'Myanmarese')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>Myanmar</span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Myanmar</span>
		@endif
		<span>(g)</span>		
		@if($nationality[0]->nationality_name != 'Indonesian' && $nationality[0]->nationality_name != 'Myanmarese' && $nationality[0]->nationality_name != 'Philippines' && $nationality[0]->nationality_name != 'Indian' && $nationality[0]->nationality_name != 'Sri Lankan')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>Others:{{ $nationality[0]->nationality_name }} <span style=" padding-right:60px;"></span></span>
		@else
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Others: <span style=" padding-right:60px;"></span></span>
		@endif
		
		</td></tr>
	  </table>
	  </td></tr>     
	  </table>
	   <table class="table table-bordered"   cellspacing='0' cellpadding='0' style="margin-top: 5px !important; margin-bottom:0px !important; font-size: 9px;" >
	  <tr><td style="vertical-align:bottom; height: 100px; width: 1%; "> <div id="rotate" style="font-size: 8px;">INSURANCE<br/>APPLIED FOR</div></td>
	   <td>
	   <table class= "table" cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important;  border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important;  font-size: 10px; width: 100%">
	    <tr>
		<td width="25%" style="padding-left: 5px;">
		(1) 
		@if($insurance_data[0]->plan == 'Letter of Guarantee Only')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> Letter of Guarantee Only </span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Letter of Guarantee Only</span><br/> 
			@endif
		(2) Philippine Embassy Bond<br/><span style="text-align:center; padding-left: 25px;">
@if($insurance_data[0]->plan == '$2,000')
			<span>(a)</span>
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> $2,000 </span>
			@else
			<span>(a)</span>
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/> $2,000 </span>
			@endif </span>
			<br/><span style="text-align:center; padding-left: 25px;">
			@if($insurance_data[0]->plan == '$7,000')
			<span>(b)</span>
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/>  $7,000 </span>
			@else
		    <span>(b)</span>
		<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>$7,000 </span>
			@endif </span></td> </td>
		<td style="width: 25%">(3)
			@if($insurance_data[0]->plan == 'Standard Package')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> Standard Package</span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Standard Package</span><br/> 
			@endif
			(4) 
			@if($insurance_data[0]->plan == 'Compre-Plus Package')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> Compare-Plus Package</span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Compare-Plus Package</span><br/> 
			@endif
			(5) 
			@if($insurance_data[0]->plan == 'Ultimate Plus Package')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> Ultimate Plus Package</span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Ultimate Plus Package</span><br/> 
			@endif
			&nbsp;</td>
		
		<td style="width:45%">
			@if($insurance_data[0]->plan_term == 'With Guarantee')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> With Guarantee </span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>With Guarantee </span><br/> 
			@endif
			@if($insurance_data[0]->plan_term == 'Without Guarantee')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> Without Guarantee </span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>Without Guarantee </span><br/> 
			@endif
			@if($insurance_data[0]->plan_term == 'With Security Bond Protector')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> With Security Bond Protector </span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>With Security Bond Protector </span><br/> 
			@endif
			@if($insurance_data[0]->plan_term == 'With H&S Top-Up of $5,000/$10,000/$15,000/$20,0000')
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/cheked.jpg";?>"style="padding-left:2px;"/> With H&S Top-Up of $5,000/$10,000/$15,000/$20,000 </span><br/>
			@else
			<span style="white-space:nowrap;"><img  height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"style="padding-left:2px;"/>With H&S Top-Up of $5,000/$10,000/$15,000/$20,000</span><br/> 
			@endif
	 </td></tr>
		<tr><td colspan='3' style="padding-left: 5px;"><b>Note</b>: Only "Plus"Policies cover Repatriation Expenses for death or permanent disablement due to ANY CAUSE,including suicide and/or unexplained causes<br/>
		Period of cover:	<span style=" padding-right:50px;margin-left:5px;">{{$insurance_data[0]->start_date}}</span>
		to  <span style=" padding-right:50px;margin-left:5px;">{{$insurance_data[0]->end_date}}</span> 
		( <span style=" padding-right:50px;margin-left:5px;">{{$insurance_data[0]->period_of_insurance}}</span> months)</td></tr>
	     </table>
	   </td></tr>     
	  </table>
  <table class="table" style="font-size:8px; margin-top: 0px; margin-bottom: 13px ; " >
	  <tr><td>
	  I hereby declare thet the information given above is true and complete and that I have not withheld any material fact. This Proposal and any Guarantee issued pursuant to this Proposal shall be subject to the Counter Idemnity below to which terms and conditions I agree.<br/><u>Personal Data</u><br/>I confirm that the informaton I have provided is my personal data and, where it is not my personal data, that I have the consent of the owner of such persoanl data to provide such information. By providinng this information, I understand and give my cnsent for AXA Insurance Singapore and AXA life Insurance Singapore (collectively "AXA") and their respectives representatives or agents to:<br/>
	   <table class="table" style="font-size:8px; margin-top: 0px !important; margin-bottom: 2px !important; " >
	   <tr><td>
	  a.<br/><br/><br/></td><td>Collect,use,store,transfer and/or disclose the information, to or with all such persons(including any member of the AXA Group or any third party service provider, and  whether within or outside of Singapore) for the purpose of enabling AXA to provide me with service required of an insurance provider, including the evaluating, processing, administering and/or managing of my relationship and policy(ies) with AXA,and for the purpose set out in AXA's Data Use Statement which can be found at http://www.axa.com.sg("Purposes").</td></tr>
	  <tr>
	  <td>b.<br/></td><td> Collect,use,store,transfer and /or disclose personal data about me and those whose personal data I have provided from sources other than myself for the Purposes.
	  </td></tr>
	  <tr><td>
	  c.</td><td>Contact me share with me information about the products and services feom AXA that may be interest to me by post and e-mail and 
	  <br/> <img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"/> By telephone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	  <img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"/> By fax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"/> By text message </td></tr></table>
	  <br/>Anda Insurance Agencies Pte Ltd may, from time to time,contact you in relation to other products or services that may interest you.<br/>Please tick the box if you <u>do not</u> wish to receive this information.<img  height= '10' width = '10'src="<?php echo $root_path."/img/blank.jpg";?>"/>
	
	</td></tr>  
	<tr><td>
	<table class="table" style="font-size:8px; margin-top: 0px !important; margin-bottom: 0px !important; ">
	<tr>
	 <td> ..........................................................................................................................<br/> Signature of Witness&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>Full Name : .......................................................................................................<br/>NRIC No : ..................................................Tel: ...............................................<br/>Address : ..........................................................................................................<br/>...........................................................................................................................</td>
	 
	<td style="text-align: left;"><br/><br/>.........................................................................................<br/>Signature of Employer/Applicant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>Date : .....................................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></td>
	</tr></table>
	</td></tr>
	<tr><td>  
	<p> <b><span style="font-size: 10px; margin-top: 0px; !important">TERMS AND CONDITION OF COUNTER INDEMNITY FOR LETTER OF GUARANTEE APPLIED FOR ABOVE</span></b><br/>In consideration of AXA Insurance Singapore Pte Ltd (the Company) agrreing at the request of the part of the party executing this Counter Indemnity to issue a letter of Guarantee in favour of the Ministry of Manpoiwer, Singapore (MOM Guarantee) guaranteeing the satisfactory performence and observation of the conditions imposed on the employer by the MOM in the Security Bond executed by the mployer in favopur of the MOM and/or to issue a letter of Guarantee in favour of the Labour Attache (the Labatt), Embassy of the Philippines for the sum of $2000 or $7000, whichever applicable,(hereinafter called the labatt Guarantee)(collectively known as the Guarantees) guaranteeing the satisfactory performence and observance of the conditions imposed on the Employer by the labatt in the Embassy of the philippines'Standard Employment Contract for filipino workers in singapore executed by the Employer in favour of the labatt , I the Employer hereby agree as follows: <br/></td></tr></table>
	 <table class="table" style="font-size:8px; margin-top: 0px !important; margin-bottom: 0px !important; " >
	<tr>
		<td>1.<br/><br/><br/><br/><br/></td><td>I hereby irrevocably and unconditionally undertake for myself/my heirs executors administrators assigns and successors, as a counting obligation, to indemnify the company on demand in full against all claims payments demands actions suits proceedings losses liabilities costs interests and expenses whatsoecer which may be taken or made against it or incurred or become payable by it under or in respect of either or both the Gurantees including,without limitation, Indemnit. I agree that the Company may in its absolute discertion compromise all claims payments demands actions suits proceedings losses liablities which may be taken or made against it under either or both the Guarantees. I also agree to accept all receipts vouchers and other evidence of all payments made by the Company or of all iabilities or obligations incurred by it by reason of either or both the Guarantees as conclusive evidence against me and my estate of the fact and extent of my liability herein to the Company.</td>
	</tr>
	<tr>
		<td>2.<br/><br/><br/></td><td>I further agree that you will be entitled to impose an interest charges of 9% per annum or any sum of money paid out by you on my behalf in connection with the above guarantee whether to the Ministry of Manpower or otherwise and that such interest will be payable on any sum(s) of money paid by you on my behalf in the event that I do not settle the said outstanding payment(s) made on my behalf within 7 days from the date I am given notice by you of the same.
		</td>
	</tr>	 

	<tr>
		<td>3.</td><td> My liability hereunder is irrevocable and shall remain in full force or effect untill the company's liability under either or both the Guarantees is discharged.
		</td>
	</tr>
  </table></p>

	 </td></tr> 
	</table>
	<div class="page-break"></div>
	<h2 align="center"><b>Smart</b><i>Helper</i> <b>Insurance Package</b></h2>
	<table class="table table-bordered" style="text-align: center; font-size: 10px; margin-top: 13px; margin-bottom: 13px ;">
	<tr><th width="3%">SECTION</th><th width="40%"> COVERAGE</th><th>STANDARD<BR/>PACKAGE</th><th>COMPRE-PLUS<BR/>PACKAGE #</th><th>ULTIMATE<BR/>PLUS PACKAGE #</th></tr>
	<tr>
		<td>1</td>
		<td style="text-align: left; padding-left: 5px;">LETTER OF GUARANTEE<BR/>To Ministry of Manpower</td>
		<td  >$5,000</td>
		<td >$5,000</td>
		<td >$5,000</td>
	</tr>
	
	<tr>
		<td>2</td>
		<td style="text-align: left;padding-left: 5px;">PERSONAL ACCIDENT FOR INSURED PERSON <BR/><span style="align:center;">a)&nbsp;&nbsp;&nbsp;Accidental Death<br/>b)&nbsp;&nbsp;&nbsp;Permanent Disablement<br/>c)&nbsp;&nbsp;&nbsp;Medical Expenses<br/>d)&nbsp;&nbsp;&nbsp;TCM Expenses (Per Accident)</span></td>
		<td>$40,000<br/>$40,000<br/>$1,000<br/>N.A</td>
		<td>$40,000<br/>$40,000<br/>$2,000<br/>$150</td>
		<td>$40,000<br/>$40,000<br/>$3,000<br/>$200</td>
	</tr>
	
	<tr>
		<td>3</td>
		<td style="text-align: left; padding-left: 5px;">REPATRIATION EXPENSES</td>
		<td colspan="3" style="font-size:10px; text-align: left; width: 100%; padding-left: 5px;"> 
			<table>
			<tr><td><img  height= '10' width = '10'src="<?php echo $root_path."/img/dot.png";?>"/><br/><br/><br/></td><td>	UNLIMITED when service are provided by our appointed emergency medical assistance provider, HENG-GREF International Assistance Holding Pte Ltd(Tel: 62726018),<b>OTHERWISE</b> the limit of liability is $3,000.</td></tr>
		<tr><td># <br/><br/></td><td>Only "Plus" policies cover death or permanent disablement due to ANY CAUSE, including suicide and/or unexplained causes.</td></tr>
			</table>
		</td>
		
	</tr>
	
	<tr>
		<td>4</td>
		<td style="text-align: left; padding-left: 5px;">HOSPITALISATION & SURGICAL<br/>In-Patient Expenses Including Day Surgery Annual Limit</td>
		<td>$15,000</td>
		<td>$15,000</td>
		<td>$20,000<br/>(World Wide)</td>
	</tr>
	
	<tr>
		<td>5</td>
		<td style="text-align: padding-left: 5px;">OUT-PATIENT KIDNEY DIALYSIS <br/>&/OR CANCER TREATMENT</td>
		<td>N.A</td>
		<td>$1,000</td>
		<td>$3,000</td>
	</tr>
	
	<tr>
		<td>6</td>
		<td style="text-align: left; padding-left: 5px;">CRITICAL ILLNESS</td>
		<td>N.A</td>
		<td>$1,000</td>
		<td>$3,000</td>
	</tr>
	
	<tr>
		<td>7</td>
		<td style="text-align: left; padding-left: 5px;">WAGES REIMBURSEMENT</td>
		<td>N.A</td>
		<td colspan="2"> Up to $30 Per Day <br/>(Maximum 60 Days) of Hospitalisation </td>
		
	</tr>
	
	<tr>
		<td>8</td>
		<td style="text-align: left; padding-left: 5px;">RE-HIRING EXPENSES</td>
		<td>N.A</td>
		<td>$500</td>
		<td>$750</td>
	</tr>
	
	<tr>
		<td>9</td>
		<td style="text-align: left; padding-left: 5px;">DOMESTIC HELPER'S LIABILITY</td>
		<td>N.A</td>
		<td>$3,000</td>
		<td>$5,000</td>
	</tr>
	
	<tr>
		<td>10</td>
		<td style="text-align: left; padding-left: 5px;">SPECIAL GRANT</td>
		<td>N.A</td>
		<td>$2,000</td>
		<td>$3,000</td>
	</tr>
	
	<tr>
		<td>11</td>
		<td style="text-align: left; padding-left: 5px;">SECURITY BOND PROTECTOR(SBP)<br/>(Optional Cover- Subject to Acceptance)</td>
		<td colspan="3" style="font-size:10px; text-align: left; padding-left: 5px;"> Reimburses the Insured for the Loss of the Security Bond,if forfeited due to the Maids fault subject to an excess of $250(if applicable).
		</td>
	</tr>
	
	<tr>
		<td>12</td>
		<td style="text-align: left; padding-left: 5px;">TOP-UP COVER FOR SECTION 4 <br>(Optional Cover)</td>
		<td colspan="3" style="font-size:10px; text-align: left; padding-left:5px;">A choice to increase annual limit in increments of $5,000 to suit your needs, i.e. $5,000,$10,000,$15,000 or $20,000up to the maximum equal to the existing Policy.<br/>Top-ups are allowed for Policies issued within 3 months & subject to Insurer' acceptance and a Waiting Period of 30 Days.
		</td>
	</tr>
	<tr>
	<td colspan="2">
	<table class= "table table-bordered" cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important;border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important;text-align: center;">
	<tr>
	<td style="vertical-align:bottom;width: 1%; "> <div id="rotate" style="font-size: 8px;">PREMIUM (Incl. GST)</div></td>
	<td  style="text-align:center;padding-bottom:30px !important;">PACKAGE</td>
	<td style="text-align:center;padding-bottom:30px !important;">26 MONTHS</td>
		</tr>
	<tr>
	<td colspan="3">
	<table class= "table table-bordered" cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important;border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important;text-align: center;">
	<tr>
	<td style="vertical-align:bottom; height: 100px; width: 1%; ">
	<div id="rotate" style="font-size: 8px;">FOR 26 MONTHS</div>
	</td>
	<td>
		<table class="table" style="margin-bottom:0px !important; margin-top:0px !important; ">
			<tr><td style="border-bottom: 1px solid #000;width:100%"><span style="padding-left: 5px;">INSURANCE ONLY</span></td></tr>
			<tr><td style="border-bottom: 1px solid #000; width: 100%"><span style="padding-left: 5px;">LETTER OF GUARANTEE ONLY</span></td></tr>
			<tr><td style="border-bottom: 1px solid #000;"><span style="padding-left: 5px;">SECURITY BOND PROTECTOR</span></td></tr>
			<tr><td style="border-bottom: 1px solid #000;"><span style="padding-left: 5px;">PHILIPPINE EMBASSY BOND</span></td></tr>
			<tr><td><span style="padding-left: 5px;">TOP-UP COVER FOR SECTION 4<br/><span style="padding-left: 5px;">(Hospitalization & Surgical)</span><br/>
				<span style="padding-left: 130px;">$ 5,000</span><br/>
				<span style="padding-left: 130px;">$10,000</span><br/>
				<span style="padding-left: 130px;">$15,000</span><br/>
				<span style="padding-left: 80px;">$20,000(For Ultimate-Plus Only)</span></span></td></tr>
		
		</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	
	
	</table>
 </td>
	

	<td colspan="3">
	<table class= "table" cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important;border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important;text-align: center;">
	<tr><td align='center' style="border-bottom: 1px solid #000; border-right: 1px solid #000;">$246.10</td>
	<td style="border-bottom: 1px solid #000; border-right: 1px solid #000;">$267.50</td>
	<td style="border-bottom: 1px solid #000;">$299.60</td></tr>
	<tr>
	<td style="border-bottom: 1px solid #000; border-right: 1px solid #000;">$184.58</td>
	<td style="border-bottom: 1px solid #000; border-right: 1px solid #000;">$200.63</td>
	<td style="border-bottom: 1px solid #000;">$224.70</td></tr>
	<tr>
	<td style="border-bottom: 1px solid #000; border-right: 1px solid #000;">$203.30</td>
	<td style="border-bottom: 1px solid #000; border-right: 1px solid #000;">$224.70</td>
	<td style="border-bottom: 1px solid #000;">$256.80</td></tr>
	<tr><td colspan="3" style="border-bottom: 1px solid #000; text-align:left; padding-left:45px;">$107.00</td></tr>
	<tr><td colspan="3"style="border-bottom: 1px solid #000;">
		<table class="table " cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important;border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important;text-align: center;">
		<tr><td width='50%'style="text-align:left; padding-left:20px;"> a)&nbsp;&nbsp; If taken With Any Package </td><td style="text-align: left;">- $53.50</td></tr>
		<tr><td width='50%'style="text-align:left; padding-left:20px;"> b)&nbsp;&nbsp; If taken within 3 months<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;of any package</td><td style="text-align: left;"> - $85.60(subject to accepetance<br/>&nbsp;&nbsp;& Waiting period of 30 Days)</td></tr>
		</table>
	</td></tr>
	<tr><td colspan='3' style="text-align: left; padding-left: 20px;"> a) $2,000 Bond - $37.45<br/>b) $7,000 Bond - $74.90</td></tr>
	<tr><td colspan='3' style="border-top: 1px solid #000; text-align: left; padding-left: 20px;">
	<span>For Up TO 26 Months Or the Expiry Date of Policy, whichever is earlier </span><br/>
		<table class="table" cellspacing='0' cellpadding='0' style="margin-top: 0px !important; margin-bottom: 0 !important;border-bottom: 0px !important;border-top: 0px ! important; border-left: 0px !important; boeder-right: 0px !important;text-align: left; ">
			<tr>
			<td >a) Taken with any Package <br/>
			<span style=" padding-left: 40px;">$42.80</span><br/>
			<span style=" padding-left: 40px;">$64.20</span><br/>
			<span style=" padding-left: 40px;">$85.60</span><br/>
			<span style=" padding-left: 40px;">$107.00</span></td>
			<td > b) Taken within 3 months <br/> 
			<span style=" padding-left: 40px;">$64.20</span><br/>
			<span style=" padding-left: 40px;">$96.30 </span> <br/>
			<span style=" padding-left: 40px;">$128.40</span><br/>
			<span style=" padding-left: 40px;">$160.50</span></td></tr>
		</table>
	</td></tr>
	</table>
	</td>
	</tr>
	
	</table>
	
	
	 <table style="font-size: 5px; margin-top: -26px; margin-bottom: 0px ;" >
	 <tr><td>
	<p style="font-size: 10px;"><b>APPLICATION PROCEDURE</b><br/>1. Complete the Application Form overleaf and mail it to us with your cheque for the appropriate premium or leave them with your Employment<br/>&nbsp;&nbsp;&nbsp;&nbsp;Agent for collection.<br/>2. Alternatively, you can apply through our website at : www.anda.com.sg<br/> &nbsp;&nbsp;&nbsp;&nbsp;Premium payment can then be made through our web-site or any AXS machine<br/>3. Upon receipt of your application and payment, we will proceed with the necessary documentation with the Ministry of Manpower<br/>*********************************************************************************************************************************************************************************************************<br/><b>Call us on the above ofr if you have any other insurance needs, such as:</b><br/>- travel insurance for your holidays or business trips<br/>- motor insurance for your vechicles, motor cycles, commercial vechicles<br/>- for personal & family protection - fire, personal accident, medical, etc<br/>- for business- all classes of general and contracts insurance, Security Bond, medical or workmen's compensation insurance for your foreign worker's etc</p>
	<p style="font-size: 10px;">"This policy is protected under the Policy Owners'Protection Scheme which is administered by the Singapore Deposit Insurance Corporation (sdic).Coverage for your policy is automatic and no further action is required from you. For more information on the types of benefits that are covered under the scheme as well as the limits of coverage, where applicable, please contact your insurer or visit the GIA or SDIC webstes (www.gia.org.sg or www.sdic.org.sg)." </p>
	<p align="center" style="font-size: 10px;"><b>ANDA INSURANCE AGENCIES PTE LTD</b><BR/>Tel: 6534 2288 Fax: 6534 2222 Email: enquiries@anda.com.sg Website : www.anda.com.sg<br/>Subsidiary of Jordine LIoyd Thompson Pte Ltd</p></td></tr>
</table>	
</div>	
</body>	
</body>
</html>





