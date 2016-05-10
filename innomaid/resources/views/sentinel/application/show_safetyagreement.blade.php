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
	font-family:"Arial",Helvetica Neue,Helvetica,sans-serif,tamil-latha;
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
	font-size:10px;
	}
.table {
    
    border-spacing: 0;
}

.table-bordered1 > tbody > tr > td, .table-bordered1 > tbody > tr > th, .table-bordered1 > tfoot > tr > td, .table-bordered1 > tfoot > tr > th, .table-bordered1 > thead > tr > td, .table-bordered1 > thead > tr > th {
    border: 1px solid #000;
	padding:5px;
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
				$residential_dwelling = explode(';',$maid_safety_agreement[0]->dwelling_type);
				$location_window = explode(';',$maid_safety_agreement[0]->location_of_window);
				//print_r($location_window);
				
		?>
		<div class="container-fluid">
			<div>
			<table class = "table" style="margin-top:0px !important;margin-bottom:0px !important;">
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
		<table class="table table-bordered1"  style="width:40%;margin:0px !important;">
			<tr>
				<th>EA Name</th>
			</tr>
			<tr>
				<td rowspan='4' style="text-align:center;">
				{{ucfirst($user_data[0]->company_name)}}
				</td>
			</tr>
		</table>
		<h1 style="text-align:center;font-weight:bold;font-size:17px;margin-bottom:30px;margin-top:35px;"><span style="border-bottom:1px solid #000;">SAFETY AGREEMENT BETWEEN FOREIGN DOMESTIC WORKER AND EMPLOYER</span></h1>
		<div style="border:1px solid #000;border-radius:27px;border-width:3px">
			<div style="border: 1px solid rgb(0, 0, 0); border-radius:23px;padding-left:15px;margin:2px;line-height:2;">
			<p>This agreement is made between <span style="border-bottom:1px solid #000">(a) The Employer</span> and <span style="border-bottom:1px solid #000">(b) The Foreign Domestic Worker(FDW) </span> and facilitated by <span style="border-bottom:1px solid #000">(c)The Employment Agency (EA)</span> to accord with the Ministory of Manpower's regulations on conditions for window cleaning.<br/>
			[Refer to Annex A on excerpt from the Employment of Foreing Manpower (Work Passes) Regulations("the Condition")]
			</p>
			<p>
			Employers of FDW's shall not permit their FDW's to clean the window exterior except where two conditions are met:
			</p>
			<ol type = 'a'>
				<li style="font-weight:bold;font-style:italic;"> Window grilles have been installed and are locked at all times during the cleaning process; and</li>
				<li style="font-weight:bold;font-style:italic;">The employer or an adult representative of the employer is physically present to supervise the FDW.</li>
			</ol>
			<p>The rules will apply to all homes, except for windows that are at the ground level or along common corridors.</p>
		</div>
		</div>
			<table class="table table-bordered1">
			<tbody>
				<tr>
					<th colspan='3' style=" background-color: #ccc; font-weight: bold;">Part A - Employer</th>
				</tr>
				<tr>
					<td height='15px' >Employer Name</td>
					<td colspan='2' height='30px'><?php if(isset($employer_details[0]->name_title)) {echo $employer_details[0]->name_title;} ?> {{ucfirst($employer_details[0]->employer_name)}}</td>
				</tr>
				<tr>
					<td height='15px'>NRIC No. / FIN</td>
					<td colspan='2' height='30px'>{{$employer_details[0]->employer_nric_no}}</td>
				</tr>
				<tr>
					<td height='15px'>Contact No.</td>
					<td colspan='2' height='30px'>{{$employer_details[0]->employer_mobile_phone}}</td>
				</tr>
				<tr>
					<td height='15px'>Residential Address</td>
					<td colspan='2' height='30px'>{{ucfirst($employer_details[0]->address)}}</td>
				</tr>
				<tr>
					<td height='15px'>Residential Dwelling Type</td>
					<td colspan='2' height='15px'>
					@if(in_array("HDB Apartment", $residential_dwelling))
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>HDB Apartment
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/>HDB Apartment
					@endif
					@if(in_array("Private Apartment/Condominium", $residential_dwelling))
						<span style="padding-left:55px;padding-right:55px;">	<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>Private Apartment/Condominium</span>
					@else
						<span style="padding-left:55px;padding-right:55px;">	<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/>Private Apartment/Condominium</span>
					@endif
					@if(in_array("Landed Property", $residential_dwelling))
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>Landed Property
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/>Landed Property
					@endif
					</td>
				</tr>
				</tbody>
				<tbody>
				<tr>
					<th colspan='3' style=" background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);font-weight: bold;height:15px;">Do I require my FDW to clean window exterior?</th>
				</tr>
				<tr>
					<td colspan='2' style=" text-align: center;width: 70%;padding-left: 90px;height:15px;">
					@if($maid_safety_agreement[0]->clean_exterior_window == 'Yes')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>Yes
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/>Yes
					@endif
					</td>
					<td style=" text-align: center;height:15px;">
					@if($maid_safety_agreement[0]->clean_exterior_window == 'No')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/>No
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/>No
					@endif
					</td>
				</tr>
				<tr>
					<td >(i) Locaion of window <br/> exterior</td>
					<td >
					@if(in_array("On ground floor", $location_window))
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">On ground floor</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">On ground floor</span>
					@endif
					<br/>
					<br/>
					@if(in_array("Facing common corridor", $location_window))
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">Facing common corridor</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">Facing common corridor</span>
					@endif
					<br/>
					<br/>
					@if(in_array("Others", $location_window))
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">Others</span><br/>If "Others" is selected,proceed to (ii)
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">Others</span><br/>If "Others" is selected,proceed to (ii)
					@endif
					</td>
					<td  rowspan='3' style=" background-color: rgb(0, 0, 0);"></td>
				</tr>
				<tr>
					<td >(ii) Grilles installed on <br/> windows required to be <br/> cleaned by FDW</td>
					<td  >
					@if($maid_safety_agreement[0]->cleaning_grilles == 'Yes')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">Yes
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">Yes
					@endif
					<br/> 
					<br/> 
					@if($maid_safety_agreement[0]->cleaning_grilles == 'No')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">No</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">No</span>
					@endif
					<br/> If "Yes" is selected , proced to (iii)</td>
				</tr>
				<tr>
					<td >(iii) Adult supervision when <br/> cleaning window exterior</td>
					<td  >
					@if($maid_safety_agreement[0]->adult_supervision == 'Yes')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">Yes</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">Yes</span>
					@endif<br/>
					<br/>
					@if($maid_safety_agreement[0]->adult_supervision == 'No')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px;">No</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px;">No</span>
					@endif
					</td>
				</tr>
			</tbody>
			</table>
			<div class="page-break"></div>
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
			<table class="table table-bordered1">
			<tbody>
				<tr>
					<th colspan='3' style=" background-color: #ccc; font-weight: bold;"> Continuation of Part A - Employer</th>
				</tr>
				<tr>
					<td colspan='3'>
					@if($maid_safety_agreement[0]->follow_advisory_checklist == 'Yes')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I have received the advisory letter and trainer's assessment checklist from the Settling-In-Programme(for employers of first-time FDWs)</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I have received the advisory letter and trainer's assessment checklist from the Settling-In-Programme(for employers of first-time FDWs)</span>
					@endif
					</td>
				</tr>
				<tr>
					<td colspan='3'>
					<p>[The Employer is required to choose only <span style="font-weight:bold; border-bottom:1px solid #000;">one</span> of the following options]</p>
					<p>
					@if($maid_safety_agreement[0]->employer_conditions == 'not require to clean exterior window')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand the Conditions and I will not require my FDW to clean the window exterior of my home.</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand the Conditions and I will not require my FDW to clean the window exterior of my home.</span>
					@endif
					</p>
					<p>
					@if($maid_safety_agreement[0]->employer_conditions == 'require to clean exterior window')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand the Conditions and I require my FDW to clean only the window exterior on the ground floor of my home.</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand the Conditions and I require my FDW to clean only the window exterior on the ground floor of my home.</span>
					@endif
					</p>
					<p>
					@if($maid_safety_agreement[0]->employer_conditions == 'require to clean exterior window with corridor')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand the Conditions and I require my FDW to clean only the window exterior along the common corridor of my home.</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand the Conditions and I require my FDW to clean only the window exterior along the common corridor of my home.</span>
					@endif
					</p>
					<p>
					@if($maid_safety_agreement[0]->employer_conditions == 'require to clean exterior window with corridor with supervision')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I require my FDW to clean the window exterior of my home and I shall ensure that the grilles are locked when cleaning the window exterior and</span><span style="padding-left:18px"> cleaned only when supervised by myself or my adult representative.</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I require my FDW to clean the window exterior of my home and I shall ensure that the grilles are locked when cleaning the window exterior and</span><span style="padding-left:18px"> cleaned only when supervised by myself or my adult representative.</span>
					@endif
					</p>
					</td>
				</tr>
				<tr>
					<td style="width:20%">Signature / Date</td>
					<td colspan='2'><?php echo date("d-m-Y",strtotime($maid_safety_agreement[0]->created_at));?></td>
				</tr>
			</tbody>
		</table>
		<em>Employer is to ensure that Part A is duly completed before the agreement is signed and dated. Do not pre-sign the agreement or sign on incomplete form.</em>
			<table class="table table-bordered1">
			<tbody>
				<tr>
					<th colspan='2' style=" background-color: #ccc; font-weight: bold;">Part B - Employment Agency</th>
				</tr>
				<tr>
					<td  style="width:20%">Name</td>
					<td>{{ucfirst($user_data[0]->company_name)}}</td>
				</tr>
				<tr>
					<td style="width:20%">Registration No.</td>
					<td>{{$user_data[0]->license_no}}</td>
				</tr>
				<tr>
					<td colspan='2'>I have explained teh Conditions to the Employer and advised the Employer that he<span style="font-weight:bold;"> * can / cannot </span > require the FDW to clean the window exterior of his home based on the information presented in Part A[* to delete accordingly]</td>
				</tr>
				<tr>
					<td style="width:20%">Signature / Date</td>
					<td><?php echo  date("d-m-Y",strtotime($maid_safety_agreement[0]->created_at));?></td>
				</tr>
			</tbody>
			</table>
			<table class="table table-bordered1">
			<tbody>
				<tr>
					<th colspan='2' style=" background-color: #ccc; font-weight: bold;">Part C - Foreign Domestic Worker</th>
				</tr>
				<tr>
					<td style="width:20%">Name</td>
					<td>{{ucfirst($maid_details[0]->name)}}</td>
				</tr>
				<tr>
					<td style="width:20%">WP No.</td>
					<td><?php if(isset($maid_details[0]->work_permit_no)) 
					echo $maid_details[0]->work_permit_no;
					?></td>
				</tr>
				<tr>
					<td colspan='2'>
					@if($maid_safety_agreement[0]->follow_employer_condition == 'Yes')
					<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I shall abide by my Emplyer's instructions to clean the window exterior safely in compliance with the Condition</span>
					@else
					<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I shall abide by my Emplyer's instructions to clean the window exterior safely in compliance with the Condition</span>
					@endif
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<p>[The FDW is required to choose only <span style="font-weight:bold; border-bottom:1px solid #000;">one</span> of the following options.]</p>
						<p>As indicated by the Employer above:-</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'not require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand that I am not require to clean only the Window exterior of my employer's home.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand that I am not require to clean only the Window exterior of my employer's home.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand that I am requrired to clean only the window exterior on the ground floor of my employer's home.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand that I am requrired to clean only the window exterior on the ground floor of my employer's home.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand that I am required to clean only the winodow exterior along the common corridor of my employer's home.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand that I am required to clean only the winodow exterior along the common corridor of my employer's home.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor with supervision')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understant that I am required to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when the </span><span style="padding-left:15px">grilles are locked and only when supervised by my employer or his adult representative.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understant that I am required to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when the</span><span style="padding-left:15px"> grilles are locked and only when supervised by my employer or his adult representative.</span>
						@endif
						</p>
					</td>	
					</tr>
					</tbody>
				</table>
				<div class="page-break"></div>
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
				<table class="table table-bordered1">
				<tbody>
					<tr><th colspan='2' style=" background-color: #ccc; font-weight: bold;">Continuation of Part C - Foreign Domestic Worker</th></tr>
					<tr>
					<td colspan='2'>
						@if($maid_safety_agreement[0]->native_language == 'Tagalog')
						<p>[Ang FDW o Dayuhang kasambahay ay kaliangan lamang pumili na <span style="font-weight:bold;border-bottom:1px solid #000;">isa</span> sa mga mga sumsunod na pagpipilian.]</p>
						<p>Gaya ng isinaad ng amo sa itaas:-</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'not require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na hindo ako kinakailangang maglinis ng labas na parte ng bintana sa bahay ng amo ko.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na hindo ako kinakailangang maglinis ng labas na parte ng bintana sa bahay ng amo ko.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na kinakailangang lamang akong maglinis sa labas na parte ng bintana sa unang palapag ng bahay ng amo ko.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na kinakailangang lamang akong maglinis sa labas na parte ng bintana sa unang palapag ng bahay ng amo ko.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na kinakailangang lamang akong maglinis ng labas na parte ng bintana na nasa may pasilyo ng bahay ng amo ko.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na kinakailangang lamang akong maglinis ng labas na parte ng bintana na nasa may pasilyo ng bahay ng amo ko.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor with supervision')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na kinakailangang akong maglinis ng labas na parte ng bintana sa bahay ng amo ko, at sisiguraduhin ko na lilinisan ko lamang ang</span><span style="padding-left:13px"> labas na bahagi ng bintana kapag ang rehas ng bintana ay nakakandado at kapag pinangangasiwaan lamang ako ng aking amo o ng kanyang</span><span style="padding-left:13px"> representateng tao na may tamang edad.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Nauunawaan ko na kinakailangang akong maglinis ng labas na parte ng bintana sa bahay ng amo ko, at sisiguraduhin ko na lilinisan ko lamang ang </span><span style="padding-left:18px">labas na bahagi ng bintana kapag ang rehas ng bintana ay nakakandado at kapag pinangangasiwaan lamang ako ng aking amo o ng kanyang</span><span style="padding-left:18px"> representateng tao na may tamang edad.</span>
						@endif
						</p>
						@elseif($maid_safety_agreement[0]->native_language == 'Burmese')
						<p>[အဆိုပါ FDW သာ ရှေးခယျြဖို့ လိုအပ်ပါသည်<span style="font-weight:bold;border-bottom:1px solid #000;">တစ်</span> အောက်ပါ ၏ ရွေးချယ်မှုများ.]</p>
						<p>က ညွှန်ပြ ထားသကဲ့သို့ အထက် အလုပ်ရှင်:-</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'not require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ဖို့ မလိုအပ် ပါ၏ နားလည်ပါသည်။</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ဖို့ မလိုအပ် ပါ၏ နားလည်ပါသည်။</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/> <span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ မြေညီထပ် အပေါ် ကိုသာ ဒိုးကို အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px"> ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ မြေညီထပ် အပေါ် ကိုသာ ဒိုးကို အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ ဘုံ စင်္ကြံ တစ်လျှောက်မှာ သာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့အိမျ ၏ ဘုံ စင်္ကြံ တစ်လျှောက်မှာ သာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် ပါ၏ နားလည်ပါသည်။</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor with supervision')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် သူဖြစ်ကြောင်းကို နားလည် , ငါ ကင် သော့ခတ်ထား ကြသည် တဲ့အခါမှသာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ကြောင်း သေချာစေရန် နှင့် အလုပ်ရှင် သို့မဟုတ်သူ အရွယ်ရောက်ပြီးသူ ကိုယ်စားလှယ် များက ကြီးကြပ် တဲ့အခါမှသာ ရကြလိမ့်မည် ။</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">ငါသည်ငါ့ အလုပ်ရှင် ရဲ့ အိမ်ရဲ့ ပြတင်းပေါက် အပြင်ပန်း ဆေးကြောသန့်စင် ရန် လိုအပ် သူဖြစ်ကြောင်းကို နားလည် , ငါ ကင် သော့ခတ်ထား ကြသည် တဲ့အခါမှသာ ပြတင်းပေါက်က အပြင်ပန်း ဆေးကြောသန့်စင် ကြောင်း သေချာစေရန် နှင့် အလုပ်ရှင် သို့မဟုတ်သူ အရွယ်ရောက်ပြီးသူ ကိုယ်စားလှယ် များက ကြီးကြပ် တဲ့အခါမှသာ ရကြလိမ့်မည် ။</span>
						@endif
						</p>
						@elseif($maid_safety_agreement[0]->native_language == 'Indonesian')
						<p>[PLRT Asing diharuskan memilih<span style="font-weight:bold;border-bottom:1px solid #000;">satu</span> sja dari pilihan-pilihan berikut.]</p>
						<p>Sebagaimana yang diusulkan oleh majikan yang tertera di atas:-</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'not require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya tidak perlu membersihkan jendela luar rumah majikan saya .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya tidak perlu membersihkan jendela luar rumah majikan saya .</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior di lantai dasar rumah majikan saya .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior di lantai dasar rumah majikan saya .</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior sepanjang koridor umum dari rumah majikan saya .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya membutuhkan untuk membersihkan hanya jendela eksterior sepanjang koridor umum dari rumah majikan saya .</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor with supervision')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya membutuhkan untuk membersihkan jendela luar rumah majikan saya , dan saya harus memastikan bahwa saya membersihkan jendela luar hanya bila kisi-kisi terkunci dan hanya jika diawasi oleh majikan atau perwakilan dewasanya .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">Saya mengerti bahwa saya membutuhkan untuk membersihkan jendela luar rumah majikan saya , dan saya harus memastikan bahwa saya membersihkan jendela luar hanya bila kisi-kisi terkunci dan hanya jika diawasi oleh majikan atau perwakilan dewasanya .</span>
						@endif
						</p>
						@elseif($maid_safety_agreement[0]->native_language == 'Tamil')
						<p >[எஃப்டிடபிள்யூ மட்டும் தேர்வு செய்ய தேவை <span style="font-weight:bold;border-bottom:1px solid #000;">ஒரு</span> பின்வரும் விருப்பங்களில்.]</p>
						<p>வேலை மேலே குறிப்பிடப்படுகிறது:-</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'not require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px"> நான் என் முதலாளி வீட்டில் ஜன்னல்கள் வெளிப்புறம் சுத்தம் செய்ய தேவையில்லை என்று புரிந்துகொள்ளுங்கள் .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px"> நான் என் முதலாளி வீட்டில் ஜன்னல்கள் வெளிப்புறம் சுத்தம் செய்ய தேவையில்லை என்று புரிந்துகொள்ளுங்கள் .</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px"> நான் என் முதலாளி வீட்டில் தரையில் மட்டுமே சாளரத்தில் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">  நான் என் முதலாளி வீட்டில் தரையில் மட்டுமே சாளரத்தில் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் .</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px"> நான் என் முதலாளி வீட்டில் பொதுவான நடைபாதையில் சேர்த்து சாளர வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் .</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px"> நான் என் முதலாளி வீட்டில் பொதுவான நடைபாதையில் சேர்த்து சாளர வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் .</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor with supervision')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px"> நான் என் முதலாளி வீட்டில் ஜன்னல் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் , மற்றும் நான் grilles பூட்டி முதலாளி அவரது நடுத்தர வயது பிரதிநிதி மூலம் கண்காணிக்கப்பட்டது போது மட்டும் போது நான் மட்டும் ஜன்னல் வெளிப்புறம் சுத்தம் என்று உறுதி செய்ய வேண்டும்.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">  நான் என் முதலாளி வீட்டில் ஜன்னல் வெளிப்புறம் சுத்தம் செய்ய தேவைப்படும் என்று புரிந்துகொள்ளுங்கள் , மற்றும் நான் grilles பூட்டி முதலாளி அவரது நடுத்தர வயது பிரதிநிதி மூலம் கண்காணிக்கப்பட்டது போது மட்டும் போது நான் மட்டும் ஜன்னல் வெளிப்புறம் சுத்தம் என்று உறுதி செய்ய வேண்டும்.</span>
						@endif
						</p>
						@else
						<p>[In native language][The FDW is required to choose only <span style="font-weight:bold;border-bottom:1px solid #000;">one</span> of the following options.]</p>
						<p>As indicated by the Employer above:-</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'not require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand that I am not require to clean only the Window exterior of my employer's home.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand that I am not require to clean only the Window exterior of my employer's home.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand that I am requrired to clean only the window exterior on the ground floor of my employer's home.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand that I am requrired to clean only the window exterior on the ground floor of my employer's home.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understand that I am required to clean only the winodow exterior along the common corridor of my employer's home.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understand that I am required to clean only the winodow exterior along the common corridor of my employer's home.</span>
						@endif
						</p>
						<p>
						@if($maid_safety_agreement[0]->fdw_conditions == 'require to clean exterior window with corridor with supervision')
						<img height='12px' src="<?php echo $root_path."/img/cheked.jpg";?>"/><span style="padding-left:5px">I understant that I am required to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when the </span><span style="padding-left:10px">grilles are locked and only when supervised by my employer or his adult representative.</span>
						@else
						<img height='12px' src="<?php echo $root_path."/img/blank.jpg";?>"/><span style="padding-left:5px">I understant that I am required to clean the window exterior of my employer's home, and I shall ensure that I clean the window exterior only when the</span><span style="padding-left:10px"> grilles are locked and only when supervised by my employer or his adult representative.</span>
						@endif
						</p>
						@endif
					</td>
					
					</tr>
					<tr>
						@if($maid_safety_agreement[0]->native_language == 'Tagalog')
						<td  style="width:20%"> Signature / Date<br/> Lagda / Pesta</td>
						
						@elseif($maid_safety_agreement[0]->native_language == 'Burmese')
						<td  style="width:20%"> Signature / Date<br/>လက်မှတ် / နေ့စှဲ</td>
						
						@elseif($maid_safety_agreement[0]->native_language == 'Indonesian')
						<td  style="width:20%"> Signature / Date<br/> Tanda Tangan / Tanggal</td>
						
						@elseif($maid_safety_agreement[0]->native_language == 'Tamil')
						<td  style="width:20%"> Signature / Date<br/>கையொப்பம் / தேதி </td>
					
						@else
						<td  style="width:20%"> Signature / Date</td>
						
						@endif
						<td><?php echo  date("d-m-Y",strtotime($maid_safety_agreement[0]->created_at));?></td>
						
					</tr>
			</tbody>
			</table>
			<table class="table table-bordered1">
			<tbody>
				<tr>
					<th colspan='2' style=" background-color: #ccc; font-weight: bold;">Part D - Employment Agency</th>
				</tr>
				<tr>
					<td colspan='2'>I have explained teh Conditions to the FDW that she<span style="font-weight:bold;"> * can / cannot </span >clean the window exterior of the residential address based on the employer's declaration in Part A [* to delete accordingly]</td>
				</tr>
				<tr>
					<td  style="width:20%">Signature / Date</td>
					<td><?php echo  date("d-m-Y",strtotime($maid_safety_agreement[0]->created_at));?></td>
				</tr>
			</tbody>
			</table>
			<p style="text-align:right;font-weight:bold;">Annex A<br/>___________</p>
			<h1 style="font-size:12px;font-weight:bold;margin-bottom:25px;">Condition 4A of the Employment of Foreign Manpower Regulations</h1>
			<p>The employer shall provide safe working conditions and take such measure as are necessary to ensure the safety and health of the foreign employee at work. This includes</p>
			<p>a)<span style="padding-left:15px;"> Not permitting the foreign employee to clean the outward facing side of any window not located on the ground level or not facing a common corridor if </span><span style="padding-left:28px;">the window is not fitted with a grille sevuring against any adult extending any part of this bofy beyond the window ledge xcept his arms; and</span></p>
			<p>b)<span style="padding-left:15px;"> In the case of a window referred to in paragraph (a) filled with a grille of the description specified in that paragraph,not permitting the foreign employee</span><span style="padding-left:28px;"> to clean the outward facing side of the window unless at all times during the cleaning process- </span></p>
			<ol type = "i" style="margin-left:20px;">
				<li>The grille is locked or secured in a manner that prevents the grille from beign opened;</li>
				<li>The foreign employee remains inside the room</li>
				<li>No part of the foreign employee's body extends beyond the window ledge except the arms; and</li>
			</ol>
			<p>The foreign employee is supervised by the employer, or an adult representative of the employer, who is reasonably capable of conduction such supervision and is aware of the requirements in sub-paragraphs (i), (ii) and (iii).</p>
		</div>
</body> 
</html>
