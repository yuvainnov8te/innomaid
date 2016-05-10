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
    color: #333;
    font-size: 12px;
	font-family:"helvetica";
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
	font-size:11px;
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
.table > thead > tr > th
{
	font-size:11px;
}
.table > thead > tr > th > p
{
	font-weight:500px;
}
.per_info tr td
{
	font-size:11px;
	width:35%;

}
.per_info tr td:nth-of-type(2)
{
	width:20%
}
.skf 
{
	line-height:1.4;
}
/* bootstrap class added for icon right or cross */
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: inherit;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
}
ul li
{
	font-size:11px;
}
p{
	font-size:11px;
}

</style>

<body style="background:white;">
	<div class="container-fluid">
		<div style="width:50px; height:50px;">
			@if($user_data[0]->agency_logo != '')
				<img style = "height:50px; width:50px;"src='<?php echo $root_path."/uploads/agency_logo/".$user_data[0]->agency_logo;?>' />
			@else
				<img src='<?php echo $root_path."/front/images/img-not-found.jpg";?>'/>
			@endif
		</div>
		<h3 align="center" style="padding-top:0px !important; font-size:12px;margin-left:5px;"> BIO-DATA OF FOREIGN DOMESTIC WORKER (FDW) </h3>
		<p style="padding-top:10px;font-size:10px;margin-left:25px;">*Please ensure that you run through the information within the bio-data as it is an important document to help you select a suitable FDW</p>
		<h3 style="font-size:12px;">(A) <span style="border-bottom: 1px solid #000; margin-left:15px; "> PROFILE OF FDW</span></h3>
		<!--<td>
		@if($user_data[0]->image != '')
			  <img width = "300px"src='<?php echo $root_path."/public/uploads/maid_image/".$user_data[0]->image;?>' />
		@else
			  <img src='<?php echo $root_path."/public/front/images/img-not-found.jpg";?>' />
		@endif
				</td>-->
	
	<h1 style="font-size:11px;">A1. <span style="margin-left:15px;">Personal Information</span></h1>
	<table class="table table-bordered per_info">
		<tbody>
			<tr>
				<td >1. Name :</td>
				<td>{{ucfirst($user_data[0]->name)}}</td>
				<td rowspan="14" style="border:none;text-align:center;">
					 @if($user_data[0]->image != '')
					  <img src='<?php echo $root_path."/uploads/maid_image/".$user_data[0]->image;?>' />
					@else
					  <img src='<?php echo $root_path."/public/front/images/img-not-found.jpg";?>'/>
					@endif
				</td>
			</tr>
			<tr>
				<td >2. Date of Birth:</td>
				<td >
				@if( $user_data[0]->date_of_birth =='0000-00-00')
				{{ '' }}
				@else
					{{  date("d M Y", strtotime($user_data[0]->date_of_birth)) }}
				@endif
				</td>
		   </tr>
		   <tr>
				<td>3. Place of Birth:</td>
				<td>{{$user_data[0]->place_of_birth}}</td>				
		   </tr>
		   <tr>
				<td>4. Weight:</td>
				@if($user_data[0]->weight)
				<td>{{$user_data[0]->weight}}kg</td>
				@else
				<td>-</td>
				@endif
				
		   </tr>
		   <tr>
				<td>5. Height:</td>
				@if($user_data[0]->height)
				<td>{{$user_data[0]->height}}cm</td>
				@else
				<td>-</td>
				@endif
		   </tr>
		   <tr>
				<td>6. Nationality:</td>
				<td>{{ucfirst($user_data[0]->nationality_name)}}</td>
		   </tr>
		   <tr>
				<td>7. Residential Address in home country:</td>
				<td>{{ucfirst($user_data[0]->address)}}</td>
		   </tr>
		   <tr>
				<td >8. Name of port/airport to be repatriated to:</td>
				<td>{{ucfirst($user_data[0]->port_name)}}</td>
		   </tr>
			<tr>
				<td colspan = '1'>9. Contract Number in home country:</td>
				<td colspan='2'>{{$user_data[0]->contact_number}}</td>
		   </tr>
		   <tr>
				<td colspan = '1'>10. Religion:</td>
				<td colspan='2'>{{ucfirst($user_data[0]->religion)}}</td>
		   </tr>
		   <tr>
				<td colspan = '1'>11. Education:</td>
				<td colspan='2'>{{ucfirst($user_data[0]->education_level)}}</td>
		   </tr>
		   <tr>
				<td colspan = '1'>12. Number of Siblings:</td>
				@if($user_data[0]->no_of_siblings)
				<td colspan='2'>{{$user_data[0]->no_of_siblings}}</td>
				@else
				<td colspan='2'>-</td>
				@endif
		   </tr>
		   <tr>
				<td colspan = '1'>13. Marital status:</td>
				<td colspan='2'>{{ucfirst($user_data[0]->marital_status)}}</td>
		   </tr>
		   <tr>
				<td colspan = '1'>14. Number of Children:</td>
				@if($user_data[0]->no_of_children)
				<td colspan='2'>{{$user_data[0]->no_of_children}}</td>
				@else
				<td colspan='2'>-</td>
				@endif
		   </tr>
			<?php 
			  $childage = explode(',',$user_data[0]->children_age);
			  for($i=0; $i<$user_data[0]->no_of_children;$i++) { 
			  ?>
			  <tr>
				<td colspan = '1'>Age of child<?php echo $i+1; ?> :</td>
				<td colspan = '2'>{{ $childage[$i] }} year</td>
			  </tr>
			  <?php }?>
		</tbody>	
	</table>
	<h3 align="left"style="font-weight:bold;font-size:11px;padding-top:0px !important;">A2.<span style="margin-left:15px;"> Medical History / Dietary Restrictions</span></h3>
	<table class="table table-bordered per_info" style=" width:62%;margin-bottom:3px;">
		<tbody>
			 @if($user_data[0]->allergies == 'Yes')
			<tr>
				<td colspan='2'> 15. Allergies(if any):
				</td>
				<td colspan='1' >{{ $user_data[0]->allergy_description}}
				</td>
			</tr>
			@else
			<tr>
				<td colspan='2' >15. Allergies:
				</td>
				<td colspan='1'><?php echo "No"; ?>
				 </td>
			@endif
			</tr>
		</tbody>
	</table>
<!--<div class="personal-info-2">-->
		<span style="margin-bottom:0px !important;font-size:11px;">16. Past and existing illness(including chronic ailments and illnesses requiring medication):</span>
	@if($user_medical_illness)
		@foreach($user_medical_illness as $usermedicalid => $usermedicalvalue)           
			<?php 
				$maiddisease[]=$usermedicalvalue->medical_desieses_id; 
				$description = $usermedicalvalue->description;
			?>
		@endforeach	
	<table class="table table-bordered" style="margin-left:20px;margin-top:0px !important;margin-bottom:0px !important;width:80%;">
	<?php $count = 0;
			$sno = 1;
	function romanNumerals($num){
    $n = intval($num);
    $res = '';

    /*** roman_numerals array  ***/
    $roman_numerals = array(
        'm'  => 1000,
        'cm' => 900,
        'd'  => 500,
        'cd' => 400,
        'c'  => 100,
        'xc' => 90,
        'l'  => 50,
        'xl' => 40,
        'x'  => 10,
        'ix' => 9,
        'v'  => 5,
        'iv' => 4,
        'i'  => 1);

    foreach ($roman_numerals as $roman => $number){
        /*** divide to get  matches ***/
        $matches = intval($n / $number);
        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);
        /*** substract from the number ***/
        $n = $n % $number;
    }

    /*** return the res ***/
    return $res;
}
		echo "<tr>";
			

	?>
	
		@foreach($medical_desieses as $id => $desieses)
			
			<?php $count++; 
				if($count == 3){
					echo "</tr>"; 
					echo "<tr>";  
					 $count=1;        
				}
			?>
			@if(in_array($id, $maiddisease))
				<td style="width:20%"><?php echo romanNumerals($sno).'.';?><span style="padding-left:10px;">{{$desieses}}</span></td><td style="width:20%"><img src="<?php echo $root_path."/img/right.jpg";?>"></td>
			@else
				<td style="width:20%"><?php echo romanNumerals($sno).'.';?><span style="padding-left:10px;">{{$desieses}}</span></td><td style="width:20%"><img src="<?php echo $root_path."/img/close.jpg";?>"></td>
			@endif
			<?php 
				if($count == 3){  
				    $count=1;
				}
				$sno++;
			?>
						
			@endforeach
				<tr><td style="width:20%"><?php echo romanNumerals($sno).'.';?><span style="padding-left:10px;">Others :</span>@if($description){{$description}}@else {{'No'}} @endif</td></tr>
			

			<!--<td  colspan='1'>
			<ul>
				 @foreach($user_medical_illness as $usermedicalid => $usermedicalvalue)           
				  @if($usermedicalvalue->medical_desieses_id == 'Others')
				  <li>{{$usermedicalvalue->other_desieses}}
				  </li>
				  @else
				  <li>{{$usermedicalvalue->title}}
				  </li>
				  @endif
				@endforeach
			</ul>
			</td>-->
			
		<!--</div>-->
		</tr>
		</tbody>
	</table>
	@else
		<span style="font-size:11px; margin-left: 5px;">No data Available</span>
	@endif
	<table class="table table-bordered per_info " style="margin-top:5px;width:62%;">
		<tbody>
		 @if($user_data[0]->physical_disablity != 'Yes')
		  <tr>
			<td colspan='2' >17. Physical Disabilities:
			</td>
			<td colspan='1' >{{$user_data[0]->physical_disablity}}
			 </td>
		  </tr>
		@else
		  <tr>
			<td colspan='2' >17. Physical Disabilities:
			</td>
			<td colspan='1'>{{$user_data[0]->physical_disability_description}}
			 </td>
		  </tr>
		 @endif
		 
		@if($user_data[0]->dietary_restrictions != 'Yes')
		  <tr>
			<td colspan='2'>18. Dietary Restrictions:
			</td>
			<td colspan='1'>{{$user_data[0]->dietary_restrictions}}
			 </td>
		  </tr>
		@else
		  <tr>
			<td  colspan='2'>18. Dietary Restrictions:
			</td>
			<td  colspan='1'>{{$user_data[0]->dietary_restrictions_description}}
			 </td>
		  </tr>
		@endif
		<!--<tr>
			<td  colspan='2'>19. Food Handling Preferences:
			</td>
			<td colspan='2'>No Pork</td>
			<td colspan='2'>No Beef</td>
			<td colspan='2'>Others:___________</td>
			<td colspan='1'>{{$user_data[0]->food_handling_prefrences}}
			 </td>
		</tr>-->
		</tbody>
	</table>
	<h3 align="left"style="font-weight:bold;font-size:11px; padding-top:0px !important;width:60%;">A3. <span style="margin-left:15px;">Others</span></h3>
	<table class="table table-bordered per_info" style="width:62%;margin-top:15px;">
		<tbody>
		  <tr>
			<td colspan='2'>19. Preference for rest day:   
			</td>
			@if($user_data[0]->rest_days_preference)
			<td colspan='1'>
			{{$user_data[0]->rest_days_preference}} rest day(s) per month.
			 </td>
			@else
				<td colspan='1'>-
			 </td>
			@endif
		  </tr>
			@if($user_data[0]->medication_remarks)
			  <tr>
				<td colspan='2'>20. Any Other Remarks:
				</td>
				<td colspan='1'>{{$user_data[0]->medication_remarks}}
				 </td>
			  </tr>
			@else
			<tr>
				<td colspan='2'>20. Any Other Remarks:
				</td>
				<td colspan='1'><?php echo 'N/A'; ?>
				 </td>
			  </tr>
		   @endif
		</tbody>
	</table>
	<h3 style="font-size:12px;"> (B)<span style="border-bottom: 1px solid #000; margin-left:15px; ">SKILLS OF FDW </span></h3>
	<h1 style="font-weight:bold;font-size:11px;padding-top:30px;">B1.<span style="margin-left:15px;">Method of Evaluation of Skills</span></h1>
	   <!-- <div style="float:left;">
		<h3 align="left"style="font-size:15px; font-weight:500px;">B1. Method of Evaluation of skills</h3>
	
		<p>Please indicate the method(s) used to evaluate the FDW’s skills(can tick more than one)
	<?php $interviewby = explode(';', $user_data[0]->interview_method)?>
	<!--<ul><b>Interviewed by {{$user_data[0]->interviewed_by}}</b>-->
	
@foreach($interviewby as $interviewid => $interviewtitle)
	<?php
		
		$interview_method[] = $interviewtitle;
	?>
	@endforeach
	<p style="padding-top:10px;">Please indicate the method(s) used to evaluate the FDW’s skills(can tick more than one):</p>
	<p>Based on FDW’s declaration,no evaluation/observation by Singapore EA or overseas training centre / EA</p>
			 <!--<p style="margin-left:5px;">Interviewed by {{$user_data[0]->interviewed_by}}</p>-->
	<ul>Interviewed by {{$user_data[0]->interviewed_by}}
		@if(in_array("Interviewed via telephone / teleconference",$interview_method))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">Interviewed via telephone/teleconference </li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">Interviewed via telephone/teleconference </li>
		@endif
		@if(in_array("Interviewed via videoconference",$interview_method))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">Interviewed via videoconference</li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">Interviewed via videoconference</li>
		@endif
		@if(in_array("Interviewed in person",$interview_method))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">Interviewed in person</li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">Interviewed in person</li>
		@endif
		@if(in_array("Interviewed in person and also made observation of FDW in the areas of work",$interview_method))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">Interviewed in person and also made observation of FDW in the areas of work listed in table</li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">Interviewed in person and also made observation of FDW in the areas of work listed in table</li>
		@endif
				<!--<li style="margin-left:15px;">Interviewed via videoconference </li>
				<li style="margin-left:15px;">Interviewed in person </li>
				<li style="margin-left:15px;">Interviewed in person and also made observation of FDW in the areas of work listed in table </li>-->
	</ul>
	<table class="table table-bordered1 skf">
		<tbody>
		<!--</div><br />-->
			 <!-- <div style="clear:both;"> </div>-->
			 <!-- <b>Skill:</b>-->
			<tr style="background-color:#eee;">
			<td width="5%"  valign="top"><b>S/No</b>
			</td>
			<td width="25%"  valign="top"><b>Areas of Work</b>
			</td>
			<td width="15%" valign="top"><b>Willingness </b><!--Yes/No-->
			</td>
			<td width="15%" valign="top"><b>Experience </b><!--Yes/No <br> if yes,state the no. of years-->
			</td>
			<td valign="top"><b>Assessment / Observation</b> <!--<br>Please state qualitative observations of FDW and/or rate the FDW (indicate N.A. of no evaluation was done)--><br>Poor ........................Excellent...N.A <br>1&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;4  &nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;N.A 
			</td>
			</tr>
			<?php $sno=1; ?>
			@foreach ($maid_skills as $skillid => $skillvalue)
			 @if($skillvalue->otherskill == 'N')
			<tr>
			<td width="5%"  valign="top">{{$sno}}
			</td>
			<td width="25%"  valign="top">{!! $skillvalue->workareatitle !!}
			</td>
			@if($skillvalue->willingness == 'Yes')
				<td><img src="<?php echo $root_path."/public/img/right.jpg";?>"></td>
			@else
				<td><img src="<?php echo $root_path."/public/img/close.jpg";?>"></td>
			@endif
			<!--	<td width="15%" valign="top">{!! $skillvalue->willingness !!}
				</td>
				<td width="15%" valign="top">{!! $skillvalue->experience !!}
				</td>-->
			@if($skillvalue->experience == 'Yes')
				<td><img src="<?php echo $root_path."/public/img/right.jpg";?>"></td>
			@else
				<td><img src="<?php echo $root_path."/public/img/close.jpg";?>"></td>
			@endif
			<!--<td>{!! $skillvalue->rating !!}
			</td>-->
			<td>
				<?php for($i = 0; $i<$skillvalue->rating; $i++){ ?>
				  <span><img src="<?php echo $root_path."/public/img/star.jpg";?>"></span>
				<?php } ?>
				<?php for($i = 5; $skillvalue->rating<$i; $i--){ ?>
				  <span><img src="<?php echo $root_path."/public/img/star-g.jpg";?>"></span>
				<?php } ?>
            </td>
			<!--<td>{!! $skillvalue->feedback_comment !!}
			</td>-->
		</tr>
			<?php $sno++; ?>
			@endif
			@endforeach
		</tbody>
	</table>
		<!--<ul style="padding-top:15px;">
		<li> Interviewed by overseas training centre / EA(Please state name of foreign training centre / EA:_________________ )<br>
		State if the third party is certified (e.g. ISO9001) or audited periodically by the EA:__________________________________</li>

		<li style="margin-left:15px;">Interviewed via telephone/teleconference </li>
		 
		 
			 <li style="margin-left:15px;">Interviewed via videoconference </li>
		 
		 
			 <li style="margin-left:15px;">Interviewed in person </li>
		 
		 
			 <li style="margin-left:15px;">Interviewed in person and also made observation of FDW in the areas of work listed in table </li>
		</ul>
		<table class="table table-bordered1">
		<tbody>

	   <!--<br />-->
	  <!-- <div style="clear:both;"> </div>-->
		
	   <!-- <b>Skill:</b>-
		
		<tr style="background-color:#eee;">
		<td width="5%" valign="top"><b>S/No</b>
		</td>
		<td width="25%" valign="top"><b>Areas of Work</b>
		</td>
		<td width="15%" valign="top"><b>Willingness</b> Yes/No</b>
		</td>
		<td width="15%" valign="top"><b>Experience</b> Yes/No <br> if yes,state the no. of years
		</td>
		<td><b>Assessment/Observation</b> <br>Please state qualitative observations of FDW and/or rate the<br> FDW (indicate N.A. of no evaluation was done)<br>Poor ........................Excellent...N.A 1       2       3         4        5       N.A 
		</td>
		
		</tr>
		<?php $sno=1; ?>
		@foreach ($maid_skills as $skillid => $skillvalue)
		<tr>
		<td width="5%" valign="top">{{$sno}}
		</td>
		<td width="5%" valign="top">{!! $skillvalue->workareatitle !!}
		</td>
		
		<td width="5%" valign="top">{!! $skillvalue->willingness !!}
		</td>
		<td width="5%" valign="top">{!! $skillvalue->experience !!}
		</td>
		<td>{!! $skillvalue->rating !!}
		</td>
		<!--<td>{!! $skillvalue->feedback_comment !!}
		</td>-
		</tr>
		<?php $sno++; ?>
		@endforeach
		</tbody>
		</table>-->
	<h3 style="font-size:12px;">(C)<span style="border-bottom: 1px solid #000; margin-left:15px; ">EMPLOYMENT HISTORY OF THE FDW</span></h3>
	<h1 style="font-weight:bold;font-size:11px;padding-top:25px;">C1. <span style="margin-left:15px;">Employment History Overseas</span> </h1>
	   <!-- <div style="float:left;">
	   </div><br />-->
	<table class="table table-bordered1">
	   <tbody>
		<tr  style="background-color:#eee;">
			<td colspan="2" width="18%"><b>Date</b></td>
			<td width="15%" valign="top" rowspan='2'><b>Country(including FDW's home country)</b>
			</td>
			<td width="15%" valign="top" rowspan='2'><b>Employer</b>
			</td>
			<td valign="top" rowspan='2'><b>Work duties</b>
			</td>
			<td valign="top" rowspan='2' width="15%"><b>Remarks</b>
			</td>
		</tr>
		<tr style="background-color:#eee;">
			<td valign="top"><b>From</b>
			</td>
			<td valign="top"><b>To</b>
			</td>
		</tr>
		<?php $sno=1; 
			if($maid_employment_history){

			}
			else{
			  $previus_singapore_experience = 'No';
			}
		?>
		@foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
		<?php 

			  if($maid_employment_historyvalue->country != 5)
			  {
				$previus_singapore_experience = 'No';
			  }
			  else{
				$previus_singapore_experience = 'Yes';
			  }
		?>
		@if($maid_employment_history)
		<tr>
		<!--<td>{{$sno}}
		</td>-->
			<td>{!! $maid_employment_historyvalue->date_from !!}
			</td>
			<td>{!! $maid_employment_historyvalue->date_to !!}
			</td>
			<td>{!! $maid_employment_historyvalue->countryname !!}
			</td>
			<td>
			{!! $maid_employment_historyvalue->employer !!}
			</td>
			<td>{!! $maid_employment_historyvalue->workareaname !!}
			</td>
			<td>{!! $maid_employment_historyvalue->employment_remarks !!}
			</td>
		</tr>
		@endif
		<?php $sno++; ?>
		@endforeach
		</tbody>
	</table>
	<h1 style="font-weight:bold;font-size:11px;padding-top:25px;"> C2. <span style="margin-left:15px;">Employment History in Singapore</span></h1>
	@foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
		<?php 
			if($maid_employment_historyvalue->country != 5)
			  {
				$previus_singapore_experience = 'No';
			  }
			  else{
				$previus_singapore_experience = 'Yes';
			  }
		?>
	@endforeach
	<table class="table table-bordered" style="width:45%;">
		<tbody>
			<tr>
			  <td> Previous working experience in Singapore</td> 
			  @if($previus_singapore_experience == 'Yes')
				<td colspan='2'><img src="<?php echo $root_path."/public/img/right.jpg";?>">Yes </td>
			  @else
				<td colspan='2'><img src="<?php echo $root_path."/public/img/right.jpg";?>">No</td>
				@endif
			</tr>
		</tbody>
	</table>
	 <p>(The EA is required to obtain the FDW’s employment history from MOM and furnish the employer with the employment history of the FDW. The employer may also verify the FDW’s employment history in Singapore through WPOL using SingPass)</p>
	<h1 style="font-weight:bold;font-size:11px;padding-top:25px;"> C3. <span style="margin-left:15px;">Feedback from previous employers in Singapore</span> </h1>
	@if($previus_singapore_experience == 'Yes')
		<table class="table table-bordered1">
			<tbody>
				<tr>
					<td width="12%"></td>
					<td colspan="6" align="center"> <b>Feedback</b></td>
				</tr>
				<?php $sno=1; ?>
				@foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
				@if($maid_employment_historyvalue->country == 5)
				<tr>
					<td width="12%"><b>Employer{{$sno}}</b></td>
					<td colspan="6" align="center"> {!! $maid_employment_historyvalue->employer_feedback !!}</td>
				</tr>
				<?php $sno++; ?>
				@endif
				@endforeach
			</tbody>
		</table>
	@else
		<p style="margin-top:10px;padding-top:20px;">Feedback was not obtained by the EA from the previous employers.</p>
	@endif
	  <!-- <div class="personal-info-2">
		@if($previus_singapore_experience == 'No')
		 
			<tr>
		<td><b>S/No</b>
		</td>
		<td><b>From</b>
		</td>
		<td><b>To</b>
		</td>
		<td><b>Country</b>
		</td>
		<td><b>Work duties</b>
		</td>
		<td><b>Remarks</b>
		</td>
		</tr>
		  @foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
		<?php 
			  if($maid_employment_historyvalue->country != 5)
			  {
				$previus_singapore_experience = 'No';
			  }
			  else{
				$previus_singapore_experience = 'Yes';
			  }
		?>
		@if($maid_employment_historyvalue->country == 5)
		<tr>
		<td>{{$sno}}
		</td>
		<td>{!! $maid_employment_historyvalue->date_from !!}
		</td>
		<td>{!! $maid_employment_historyvalue->date_to !!}
		</td>
		<td>{!! $maid_employment_historyvalue->countryname !!}
		</td>
		<td>{!! $maid_employment_historyvalue->workareaname !!}
		</td>
		<td>{!! $maid_employment_historyvalue->employment_remarks !!}
		</td>
		</tr>
		
		  @endif
		<?php $sno++; ?>
		@endforeach  
		 @else
			<tr>
				<td colspan="6">		   
					<label for="inputremarks">Previous working experience in Singapore: <span class="personal-info">{{$previus_singapore_experience}}</span></label>
				</td>
			</tr>	
	@endif
	   <!-- </div>
	   
	  <tr> <td colspan="6">( The EA is required to obtain the FDW’s employment history from MOM and furnish the employer with the employment history of the FDW. The employer may also verify the FDW’s employment history in Singapore through WPOL using SingPass) 
	  </td></tr>
	<!--<div style="clear:both;"> </div>
		<tr>
	   <th colspan="6"> C3. Feedback from previous employers in Singapore</th></tr>
	   <?php $showfeedbaktable = 'no'; ?>
	   @foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
		@if($maid_employment_historyvalue->employer_feedback)
		  <?php $showfeedbaktable = 'yes'; ?>
		 @else 
		  <?php $showfeedbaktable = 'no'; ?>
		@endif
		@endforeach
		@if($showfeedbaktable != 'yes')
			<tr><td colspan="6">Feedback was not obtained by the EA from the previous employers.</td></tr>
	   @else
		  <tr>
		  <td style="width:15%;"><b>S/No</b>
		  </td>
		  <td style="width:25%;"><b>Employer</b>
		  </td>
		  <td style="width:60%;" colspan="4"><b>Feedback</b>
		  </td>
		  </tr>
		  <?php $sno=1; ?>
		  @foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
		  @if($maid_employment_historyvalue->employer_feedback)
			 @if($maid_employment_historyvalue->country == 5) 
		  <tr>
		  <td>{{$sno}}
		  </td>
		  <td>{!! $maid_employment_historyvalue->employer !!}
		  </td>
		  <td colspan="4">{!! $maid_employment_historyvalue->employer_feedback !!}
		  </td>
		  </tr>
			@endif
		  @endif
		  <?php $sno++; ?>
		  @endforeach
		@endif
		<?php $can_be_interviewed_via = explode(';', $user_data[0]->can_be_interviewed_via); ?>
	   
	   <tr><b>Available for interview via</b>
	@foreach($can_be_interviewed_via as $can_be_interviewed_viaid => $can_be_interviewed_viatitle)
	<td><?php echo $can_be_interviewed_viatitle;?>
		</td>
		@endforeach-->
	<?php $can_be_interviewed_via = explode(';', $user_data[0]->can_be_interviewed_via); ?>
	@foreach($can_be_interviewed_via as $can_be_interviewed_viaid => $can_be_interviewed_viatitle)
	<?php $interviewby_prospective_employer[] =  $can_be_interviewed_viatitle;?>
	@endforeach
	<h3 style="font-size:12px; ">(D)<span style="border-bottom: 1px solid #000; margin-left:15px;">AILABILITY OF FDW TO BE INTERVIEWED BY PROSPECTIVE EMPLOYER</span> </h3>
	<ul style="padding-top:15px;">
		@if(in_array("In person with observation in the areas of work",$interviewby_prospective_employer))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">FDW is not available for interview </li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">FDW is not available for interview </li>
		@endif
		@if(in_array("Telephone / Teleconference",$interviewby_prospective_employer))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">FDW can be interviewed by phone</li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">FDW can be interviewed by phone</li>
		@endif
		@if(in_array("Videoconference",$interviewby_prospective_employer))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">FDW can be interviewed by video-conference</li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">FDW can be interviewed by video-conference</li>
		@endif
		@if(in_array("In person",$interviewby_prospective_employer))
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/right.jpg";?>">IFDW can be interviewed in person</li>
		@else
			<li style="list-style-type:none;"><img src="<?php echo $root_path."/public/img/close.jpg";?>">FDW can be interviewed in person</li>
		@endif
	</ul>
		<!--<table>
	<?php $can_be_interviewed_via = explode(';', $user_data[0]->can_be_interviewed_via); ?>
	   <tr><b>Available for interview via</b>
	@foreach($can_be_interviewed_via as $can_be_interviewed_viaid => $can_be_interviewed_viatitle)
	<td><?php echo $can_be_interviewed_viatitle;?>
		</td>
		@endforeach
		</ul>
		</tr>
		</table>-->
	<h3 style="font-size:12px;">(E) <span style="border-bottom: 1px solid #000;margin-left:15px; "> OTHER REMARKS</span></h3>
	@if($user_data[0]->overall_remarks)
		<div style="margin-top:25px;">
			<span>
			{{$user_data[0]->overall_remarks}}
			</span>
		</div>
	@else
	<div style = "margin-top:30px; height:30px; border-top:1px solid #000;border-bottom:1px solid #000;">
	   </div>
	@endif
	   <br />
	<div style="margin-top: 35px;">
		<span style="border-top: 1px solid #000; padding-top: 5px; font-size: 11px;">&nbsp;&nbsp;FDW Name and Signature Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span style="border-top: 1px solid #000; padding-top: 5px; font-size: 11px; margin-left:30px;">&nbsp;&nbsp;Personnel Name and Registration Number Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		
	</div>
	<p style="padding-top: 20px;">I have gone through the 4 page bio-data of this FDW and confirm that I would like to employ her</p>
	<div style="border-top: 1px solid rgb(0, 0, 0); margin-top: 35px; padding-top: 5px; clear: both; width: 30%; font-size: 11px;">Employer Name and NRIC No. Date: 
		</div>
	<h3 style="font-size:11px;"><span style="border-bottom: 1px solid #000;">IMPORTANT NOTES FOR EMPLOYERS WHEN USING THE SERVICES OF AN EA</h3>
	<ul style="padding-top:10px;">
		<li>Do consider asking for an FDW who is able to communicate in a language you require, and interview her (in person/phone/videoconference)to ensure that she can communicate adequately.</li>
		<li>Do consider requesting for an FDW who has aprovenability to perform the chores you require, for example, performing house hold chores(especially if she is required to hanglaundry from a high-rise unit), cooking and caring for young children or the elderly.</li>
		<li>Do work to gether with the EA to ensure that a suitable FDW is matched to you according to your need sand requirements.</li>
		<li>You may wish to pay special attention to your prospective FDW’s employment history and feedback from the FDW’s previous employer(s) before employing her.</li>
	 </ul>
</div>
</body>
</html>