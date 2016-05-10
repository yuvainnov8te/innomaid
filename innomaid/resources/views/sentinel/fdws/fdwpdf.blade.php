<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Innomaid</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<?php 
 $root_path= public_path();
 $path = $_SERVER['DOCUMENT_ROOT'].'/public';
$maid_image_root_path = $_SERVER['DOCUMENT_ROOT'];
?>
<style type="text/css">
body {
    color: #333;
    font-size: 10px;
	font-family:"helvetica";
	line-height:1.79;
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
	font-size:10px;
	}
.table {
    margin-bottom: 10px;
	margin-top:20px;
    max-width: 100%;
    width: 100%;
	font-size:10px;
	border-collapse: collapse
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

.per_skill > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.79;
	}
	.per_food > tbody > tr > td, .per_info > tbody > tr > th, .per_info > tfoot > tr > td, .per_info > tfoot > tr > th, .per_info > thead > tr > td, .per_info > thead > tr > th {
	line-height:1.79;
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
	font-size:10px;
	width:60%;
	
}
.per_skill tr td:first-child
{
	font-size:10px;

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
.test tr td:first-child
{
	width:40%;
}
.per_food tr td:first-child
{
	width:37%;	
}
.per_food tr td:nth-child(2)
{
	width:15%;	
}
.page-break {
    page-break-after: always;
}
.bac-clr
{
	background-color:#eee;
}
</style>
<?php $childage=""; 	?>
<body style="background:white;">
	<div class="container-fluid">
	<h3 align="center" style="padding-top:0px !important; font-size:12px;margin-left:5px;margin-bottom:0px !importan;"> BIO-DATA OF FOREIGN DOMESTIC WORKER (FDW) </h3>
	<p style="padding-top:10px;font-size:10px;margin-left:25px;">*Please ensure that you run through the information within the bio-data as it is an important document to help you select a suitable FDW</p>
	<h3 style="font-size:12px;">(A) <span style="border-bottom: 1px solid #000; margin-left:15px; "> PROFILE OF FDW</span></h3>
		
	
	<h1 style="font-size:11px; margin:0px !important;">A1. <span style="margin-left:15px;">Personal Information</span></h1>
	<table class="table table-bordered per_info" style="margin-top:0px !important; margin-bottom:0px !important;font-size: 11px;">
	<tbody>
		<tr>
		<td style="vertical-align:top;padding-top:10px;">
			<table class="table-bordered per_info" style="line-height:2.5;vertical-align:top;margin-top:0px !important; margin-bottom:0px !important;font-size: 11px;">
				<tbody>
					<tr>
						<td colspan='2'><span>1. Name :</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->name)}}</span></td>
						<!--<td>{{ucfirst($user_data[0]->name)}}</td>-->

					</tr>
					<tr>
						<td colspan='2'><span>2. Date of Birth:</span>@if( $user_data[0]->date_of_birth =='0000-00-00')
						{{ '' }}
						@else
							<span style="font-weight:500; padding-left:5px;">{{  date("d M Y", strtotime($user_data[0]->date_of_birth)) }}</span> <span style="padding-left: 30px;">Age:</span><span style="font-weight:500; padding-left:5px;">{{$user_data[0]->age}}</span>
						@endif</td>
						<!--<td >
						@if( $user_data[0]->date_of_birth =='0000-00-00')
						{{ '' }}
						@else
							{{  date("d M Y", strtotime($user_data[0]->date_of_birth)) }}
						@endif
						</td>-->
				   </tr>
				 <!--  <tr>
						<td >2. Age:<span style="font-weight:500">{{$user_data[0]->age}}</span></td>
						<!--<td >{{$user_data[0]->age}}
						</td>
				   </tr>-->
				   <tr>
						<td colspan='2'><span>3. Place of Birth:</span><span style="font-weight:500; padding-left:5px;">{{$user_data[0]->place_of_birth}}</span></td>
						<!--<td>{{$user_data[0]->place_of_birth}}</td>	-->			
				   </tr>
				   <tr>
						<td colspan ='2'><span>4. Height & Weight:</span>
						<span style="font-weight:500; padding-left:5px;">
						@if($user_data[0]->height){{$user_data[0]->height}}cm
						</span>
						<span style="font-weight:500; padding-left:5px;">
						@if($user_data[0]->weight){{$user_data[0]->weight}}kg
						@endif</span>
						@else
							<span style="font-weight:500">-<span style="font-weight:500;">
						@endif
						</td>
						<!--@if($user_data[0]->weight)
						<td>{{$user_data[0]->weight}}kg</td>
						@else
						<td>-</td>
						@endif-->
						
				   </tr>
				  <!-- <tr>
						<!--<td>5. Height:@if($user_data[0]->height)<span style="font-weight:500">{{$user_data[0]->height}}cm
						@else
							<span style="font-weight:500">-</span>
						@endif</td>
						<!--@if($user_data[0]->height)
						<td>{{$user_data[0]->height}}cm</td>
						@else
						<td>-</td>
						@endif
				   </tr>-->
				   <tr>
						<td colspan='2'><span>5. Nationality:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->nationality_name)}}</span></td>
						<!--<td>{{ucfirst($user_data[0]->nationality_name)}}</td>-->
				   </tr>
				   <tr>
						<td colspan='2'><span>6. Residential Address in home country:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->address)}}</span></td>
						<!--<td>{{ucfirst($user_data[0]->address)}}</td>-->
				   </tr>
				   <tr>
						<td colspan='2'><span>7. Name of port/airport to be repatriated to:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->port_name)}}</span></td>
						<!--<td>{{ucfirst($user_data[0]->port_name)}}</td>-->
				   </tr>
					<tr>
						<td colspan = '2'><span>8. Contact Number in home country:</span><span style="font-weight:500; padding-left:5px;">{{$user_data[0]->contact_number}}</span></td>
						<!--<td colspan='2'>{{$user_data[0]->contact_number}}</td>-->
				   </tr>
				   <tr>
						<td colspan='2'><span>9. Religion:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->religion)}}</span></td>
						<!--<td colspan='2'>{{ucfirst($user_data[0]->religion)}}</td>-->
				   </tr>
				   <tr>
						<td colspan='2'><span>10. Education level:</span><span style="font-weight:500; padding-left:5px;">@if($user_data[0]->education_level=="Others"){{$user_data[0]->other_education}}@else{{ucfirst($user_data[0]->education_level)}}@endif</span></td>
						<!--<td colspan='2'>{{ucfirst($user_data[0]->education_level)}}</td>-->
				   </tr>
				   <tr>
						<td colspan='2'><span>11. Number of Siblings:</span>
						@if($user_data[0]->no_of_siblings)
							<span style="font-weight:500; padding-left:5px;">{{$user_data[0]->no_of_siblings}}</span>
						@else
							<span style="font-weight:500; padding-left:5px;">-</span>
						@endif</td>
						<!--@if($user_data[0]->no_of_siblings)
						<td colspan='2'>{{$user_data[0]->no_of_siblings}}</td>
						@else
						<td colspan='2'>-</td>
						@endif-->
				   </tr>
				   <tr>
						<td colspan='2'><span>12. Marital status:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->marital_status)}}</span></td>
						<!--<td colspan='2'>{{ucfirst($user_data[0]->marital_status)}}</td>-->
				   </tr>
				   <tr>
						<td colspan='2'><span>13. Number of Children:</span>@if($user_data[0]->no_of_children)
							<span style="font-weight:500; padding-left:5px;">{{$user_data[0]->no_of_children}}</span>
						@else
							<span style="font-weight:500; padding-left:5px;">-</span>
						@endif</td>
						<!--@if($user_data[0]->no_of_children)
						<td colspan='2'>{{$user_data[0]->no_of_children}}</td>
						@else
						<td colspan='2'>-</td>
						@endif-->
				   </tr>
				   <tr>
						<td  colspan='2'><span>Age(s) of children(if any):</span>
					@if($user_data[0]->no_of_children!='' ||$user_data[0]->no_of_children!=0)
					<?php 
					  $childage = explode(',',$user_data[0]->children_age);
					  $childage1 = implode(',',$childage);
					  if($childage1){
					//  for($i=0; $i<$user_data[0]->no_of_children;$i++) { 
					  ?>
						<span style="font-weight:500; padding-left:5px;"><?php echo $childage1.'years old';?></span>
					  <?php }//}
					  else{?>
						<span>-</span>
						<?php } ?>
					  @endif
					 </td>
					  </tr>
				  
				</tbody>
			</table>
	</td><td><table><tr><td style="text-align:left;">@if($user_data[0]->availability) Status: {{$user_data[0]->availability}} @endif</td></tr><tr>
	<td style="border:none;text-align:center;;height:500px; width:300px">
		@if($user_data[0]->image != '')
			<img src='<?php echo $maid_image_root_path."/uploads/maid_image/".$user_data[0]->image;?>' />
		@else
			<img src='<?php echo $path."/front/images/img-not-found.jpg";?>'/>
		@endif </td></tr></table>
	</td>
	</tr>
	</tbody>
	</table>
	<h3 align="left"style="font-weight:bold;font-size:11px;padding-top:13px !important;">A2.<span style="margin-left:15px;"> Medical History / Dietary Restrictions</span></h3>
	<table class="table table-bordered per_skill" style=" width:100%;margin-bottom:3px;line-height:3.!important;">
		<tbody>
			 @if($user_data[0]->allergies == 'Yes')
			<tr>
				<td colspan='2'> <span>14. Allergies(if any):</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->allergy_description)}}</span>
				</td>
				<!--<td colspan='1' >{{ $user_data[0]->allergy_description}}
				</td>-->
			</tr>
			@else
			<tr>
			<td colspan='2'><span>14. Allergies(if any):</span><span style="font-weight:500; padding-left:350px;border-bottom:1px solid #000;"></span>
				</td>
				
				 </tr>
			@endif
		</tbody>
	</table>
<!--<div class="personal-info-2">-->
		<h3 style="margin-bottom:25px !important;font-size:11px;font-weight:500 !important;padding-top:10px!important;">15. Past and existing illness(including chronic ailments and illnesses requiring medication):</h3>
		<!--<span style="padding-left: 30%;">yes</span><span style="padding-left: 5%">no</span>-->

	@if($user_medical_illness)
		@foreach($user_medical_illness as $usermedicalid => $usermedicalvalue)           
			<?php 
			$maiddisease[]=$usermedicalvalue->medical_desieses_id; 
				$description = $usermedicalvalue->description;
			?> 
		@endforeach
	<table class="table table-bordered per_skill" style="margin-left:20px;margin-top:0px !important;margin-bottom:0px !important;width:100%;">
	<tbody>
	 <tr><td style="width:20%;"></td><td style="width:10%;">Yes</td><td style="width:10%;">No</td><td style="width:20%;"></td><td style="width:10%;">Yes</td><td style="width:10%;">No</td></tr>
	<!--<tr><th width='25%'>yes</th><th width='25%'>no</th><th width='25%'>yes</th><th width='25%'>no</th></tr>-->
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
				<td style="width:20%;font-weight:500;" ><span><?php echo romanNumerals($sno).'.';?></span><span style="padding-left:10px;">{{$desieses}}</span></td><td style="width:20%;"><span><img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>"></span></td><td style="width:20%;"><span><img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>"></span></td>
			@else
				<td style="width:20%;font-weight:500;"><span><?php echo romanNumerals($sno).'.';?></span><span style="padding-left:10px;">{{$desieses}}</span></td><td style="width:20%"><span><img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>"></span></td><td style="width:20%;"><span><img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>"></span></td>
			@endif
			<?php 
				if($count == 3){  
				    $count=1;
				}
				$sno++;
			?>
						
			@endforeach
				<tr><td style="width:20%;font-weight:500;"><span><?php echo romanNumerals($sno).'.';?></span><span style="padding-left:10px;">Others :</span>@if($usermedicalvalue->other_desieses)<span>{{ucfirst($usermedicalvalue->other_desieses)}}</span>@endif</td></tr>


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
	<table class="table table-bordered per_skill" style="margin-left:20px;margin-top:0px !important;margin-bottom:0px !important;width:100%;">
	<tbody>
	 <tr><td style="width:20%;"></td><td style="width:10%;">Yes</td><td style="width:10%;">No</td><td style="width:20%;"></td><td style="width:10%;">Yes</td><td style="width:10%;">No</td></tr>
	<!--<tr><th width='25%'>yes</th><th width='25%'>no</th><th width='25%'>yes</th><th width='25%'>no</th></tr>-->
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
				<td style="width:20%;font-weight:500;" ><span><?php echo romanNumerals($sno).'.';?></span><span style="padding-left:10px;">{{$desieses}}</span></td><td style="width:10%;"><span><img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>"></span></td><td style="width:10%"><span><img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>"></span></td>
			
			<?php 
				if($count == 3){  
				    $count=1;
				}
				$sno++;
			?>
						
			@endforeach
				<tr><td style="width:20%;font-weight:500;"><span><?php echo romanNumerals($sno).'.';?></span><span style="padding-left:10px;">Others :</span></td></tr>
			   

		
		</tr>
		
		</tbody>
	</table>
	@endif
	<table class="table table-bordered per_skill " style="margin-top:0px !important;width:100%;line-height:2.5!important;">
		<tbody>
		 @if($user_data[0]->physical_disablity != 'Yes')
		  <tr>
			<td><span>16. Physical Disabilities:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->physical_disablity)}}</span>
			</td>
		<!--	<td colspan='1' >{{$user_data[0]->physical_disablity}}
			 </td>-->
		  </tr>
		@else
		  <tr>
			<td><span>16. Physical Disabilities:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->physical_disability_description)}}</span>
			</td>
			<!--<td colspan='1'>{{$user_data[0]->physical_disability_description}}
			 </td>-->
		  </tr>
		 @endif
		@if($user_data[0]->dietary_restrictions != 'Yes')
		  <tr>
			<td><span>17. Dietary Restrictions:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->dietary_restrictions)}}</span>
			</td>
			<!--<td colspan='1'>{{$user_data[0]->dietary_restrictions}}
			 </td>-->
		  </tr>
		@else
		  <tr>
			<td><span>17. Dietary Restrictions:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->dietary_restrictions_description)}}</span>
			</td>
			<!--<td  colspan='1'>{{$user_data[0]->dietary_restrictions_description}}
			 </td>-->
		  </tr>
		@endif
		</tbody>
	</table> 
		 <table class="table table-bordered per_food " style="margin-top:0px !important;width:100%;">
		<tbody>
		 <tr>
			<td><span >18. Food Handling Preferences:</span>
				<?php $food_handling_prefrences = explode(',', $user_data[0]->food_handling_prefrences)?>
				<span>
				@if(in_array('Pork',$food_handling_prefrences))
				<img  height= '15' width = '15'src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"> No Pork
				@else
				<img  height= '15' width = '15'src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"> No Pork
				@endif
				</span>
			</td>
				@if(in_array('Beef',$food_handling_prefrences))
				
				<td><span><img  height= '15' width = '15'src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"> No Beef</span></td>
				@else
				<td><span><img  height= '15' width = '15'src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"> No Beef</span></td>
				@endif
				@if(in_array('Others',$food_handling_prefrences))
				<td><span><img  height= '15' width = '15'src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"> Others {{ucfirst($user_data[0]->food_handling_preference_other)}}</span></td>
				@else
				<td><span><img  height= '15' width = '15'src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"> Others:<span style="border-bottom:1px solid #00000;padding-left:100px;">&nbsp;</span><span style="border-bottom:1px solid #000;"></span></span></td>
				@endif
		</tr>
		</tbody>
		</table>
		<div class="page-break"></div>
	<h3 align="left"style="font-weight:bold;font-size:11px; padding-top:0px !important;width:60%;">A3. <span style="margin-left:15px;">Others</span></h3>
	<table class="table table-bordered per_skill" style="width:100%;margin-top:15px;line-height:2.5 !important;">
		<tbody>
		  <tr>
			<td colspan='2'><span>19. Preference for rest day:  </span> @if($user_data[0]->rest_days_preference)
				<span style="font-weight:500; padding-left:5px;">{{$user_data[0]->rest_days_preference}} rest day(s) per month.</span>
			@else
				<span style="font-weight:500; padding-left:5px;border-bottom:1px solid #000;"></span>
			@endif
			</td>
			<!--@if($user_data[0]->rest_days_preference)
			<td colspan='1'>
			{{$user_data[0]->rest_days_preference}} rest day(s) per month.
			 </td>
			@else
				<td colspan='1'>-
			 </td>
			@endif-->
		  </tr>
			@if($user_data[0]->medication_remarks)
			  <tr>
				<td colspan='2'><span>20. Any Other Remarks:</span><span style="font-weight:500; padding-left:5px;">{{ucfirst($user_data[0]->medication_remarks)}}</span>
				</td>
				<!--<td colspan='1'>{{$user_data[0]->medication_remarks}}
				 </td>-->
			  </tr>
			@else
			<tr>
				<td colspan='2'><span>20. Any Other Remarks:</span><span style="font-weight:500; padding-left:5px;border-bottom:1px solid #000;"></span>
				</td>
				<!--<td colspan='1'><?php echo 'N/A'; ?>
				 </td>-->
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
	@endforeach <?php $interview_by = explode(';', $user_data[0]->interviewed_by); //print_r($fdw->interviewed_by); //exit;?>
	<p style="padding-top:10px;">Please indicate the method(s) used to evaluate the FDW’s skills(can tick more than one):</p>
	@if(in_array('no evaluation',$interview_by))
		<span><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:6px;margin-left:10px;"/ ><span style="padding-left:10px;">Based on FDW’s declaration,no evaluation/observation by Singapore EA or overseas training centre / EA</span></span><br/>
	@else
		<span><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:6px;margin-left:10px;"/ ><span style="padding-left:10px;">Based on FDW’s declaration,no evaluation/observation by Singapore EA or overseas training centre / EA</span></span><br/>
	@endif
	<br/>
	@if(in_array('Singapore EA',$interview_by))
		<span><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:6px;margin-left:10px;"/ ><span style="padding-left:10px;">Interviewed by <span style="border-bottom:1px solid #000;">Singapore EA</span></span></span><br/>
	@else
		<span><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:6px;margin-left:10px;"/ ><span style="padding-left:10px;">Interviewed by <span style="border-bottom:1px solid #000;">Singapore EA</span></span></span><br/>
	@endif
	@if(in_array('Singapore EA',$interview_by))
		@if(in_array("Interviewed via telephone / teleconference",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference</span> </span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference</span> </span><br/>
		@endif
		@if(in_array("Interviewed via videoconference",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
		@endif
		@if(in_array("Interviewed in person",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
		@endif
		@if(in_array("Interviewed in person and also made observation of FDW in the areas of work",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
		@endif
		<!--<li style="margin-left:15px;">Interviewed via videoconference </li>
				<li style="margin-left:15px;">Interviewed in person </li>
				<li style="margin-left:15px;">Interviewed in person and also made observation of FDW in the areas of work listed in table </li>-->
	@elseif($user_data[0]->interviewed_by == '')
		@if(in_array("Interviewed via telephone / teleconference",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference</span> </span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference</span> </span><br/>
		@endif
		@if(in_array("Interviewed via videoconference",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
		@endif
		@if(in_array("Interviewed in person",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
		@endif
		@if(in_array("Interviewed in person and also made observation of FDW in the areas of work",$interview_method))
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
		@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
		@endif
		<!--<li style="margin-left:15px;">Interviewed via videoconference </li>
				<li style="margin-left:15px;">Interviewed in person </li>
				<li style="margin-left:15px;">Interviewed in person and also made observation of FDW in the areas of work listed in table </li>-->
	@else
			<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference </span></span><br/>
				
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
				
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
				
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
	@endif
	@if($maid_skills)
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
				<td width="15%" valign="top"><b>Willingness</b><br/><span>Yes/No</span> <!--Yes/No-->
				</td>
				<td width="15%" valign="top"><b>Experience </b><br/><span>Yes/No <br /> if yes,state <br/>the no. of <br/>years</span><!--Yes/No <br> if yes,state the no. of years-->
				</td>
				<td valign="top"><b>Assessment / Observation</b> <br/>Please state qualitative observations of FDW and/or rate the FDW (indicate N.A. of no evaluation was done)<br/>Poor ........................Excellent...N.A <br>1&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;4  &nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;N.A 
				</td>
			</tr>
			@if(in_array('Singapore EA',$interview_by))
				<?php $sno=1; ?>
				@foreach ($maid_skills as $skillid => $skillvalue)
					@if($skillvalue->otherskill == 'N' && $skillvalue->workareatitle != 'Care for Special Needs' && $skillvalue->interview_type=='Singapore EA')
					<tr>
					<td width="5%"  style="height: 50px;"valign="top">{{$sno}}
					</td>
				<td width="25%"  valign="top" style="text-align:left;padding-left:5px;">
				@if($skillvalue->workareatitle == 'Cooking' || $skillvalue->workareatitle == 'Language abilities' || $skillvalue->workareatitle == 'Other skills, if any' ||  $skillvalue->workareatitle == 'Care of infants/children')
					{!! $skillvalue->workareatitle !!}<br/>
					@if($skillvalue->feedback_comment!= '')
					{!! $skillvalue->feedback_comment !!}
					@elseif($skillvalue->workareatitle == 'Care of infants/children')
								<span>Please specify age range:<br/><span style="border-bottom:1px solid #000;padding-left:130px;">&nbsp;</span></span>
						@elseif($skillvalue->workareatitle == 'Cooking')
							<span>Please specify cuisines:</span>	
						@else
								<span>Please specify:<span style="border-bottom:1px solid #000;padding-left:60px;">&nbsp;</span></span>
						@endif
					
				@else
					{!! $skillvalue->workareatitle !!}
				@endif
				</td>
				@if($skillvalue->willingness == 'Yes')
								@if($skillvalue->workareatitle == 'Language abilities')
								<td ><img height="80px" width="120px" src="<?php echo $path."/img/cross-img.png";?>"></td>
								@else
								<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">-->Yes</td>
								@endif
				@else
								@if($skillvalue->workareatitle == 'Language abilities')
								<td><img height="80px" width="100px" src="<?php echo $path."/img/cross-img.png";?>"></td>
								@else
								<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>">-->No</td>
								@endif
				@endif
					<!--	<td width="15%" valign="top">{!! $skillvalue->willingness !!}
						</td>
						<td width="15%" valign="top">{!! $skillvalue->experience !!}
						</td>-->
				@if($skillvalue->experience == 'Yes')
					@if($skillvalue->workareatitle == 'Language abilities')
							<td ><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">--></td>
					@else
					<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">-->Yes
					</td>
					@endif
				@else
					@if($skillvalue->workareatitle == 'Language abilities')
						<td ><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">--></td>
					@else
					<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>">-->No</td>
					@endif
				@endif
				@if($skillvalue->rating)
					@if($skillvalue->workareatitle == 'Language abilities')
						<td ><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">--></td>
					@else
					<td>{!! $skillvalue->rating !!}
					</td>
					@endif
				@else
					<td></td>
				@endif
					<!--<td>
						<?php for($i = 0; $i<$skillvalue->rating; $i++){ ?>
						  <span><img height="15px" width="15px" src="<?php echo $path."/img/gold-star.png";?>"></span>
						<?php } ?>
						<?php for($i = 5; $skillvalue->rating<$i; $i--){ ?>
						  <span><img height="15px" width="15px" src="<?php echo $path."/img/gray-star.png";?>"></span>
						<?php } ?>
					</td>
					<!--<td>{!! $skillvalue->feedback_comment !!}
					</td>-->
				</tr>				<?php $sno++; ?>

				@endif
				@endforeach
			@else
				<?php $sno=1; ?>
				@foreach ($maid_skills as $skillid => $skillvalue)
					@if($skillvalue->otherskill == 'N' && $skillvalue->workareatitle != 'Care for Special Needs')
						<tr>
							<td width="5%"  style="height: 50px;"valign="top">{{$sno}}
							</td>
							<td width="25%"  valign="top" style="text-align:left;padding-left:5px;">
								@if($skillvalue->workareatitle == 'Cooking' || $skillvalue->workareatitle == 'Language abilities' || $skillvalue->workareatitle == 'Other skills, if any' ||  $skillvalue->workareatitle == 'Care of infants/children')
									{!! $skillvalue->workareatitle !!}<br/>
									@if($skillvalue->feedback_comment == '')
										@if($skillvalue->workareatitle == 'Care of infants/children' )
											<span>Please specify age range:<br/><span style="border-bottom:1px solid #000;padding-left:130px;">&nbsp;</span></span>
										@elseif($skillvalue->workareatitle == 'Cooking')
											<span>Please specify cuisines:</span>	
										@else
											<span>Please specify:<span style="border-bottom:1px solid #000;padding-left:60px;">&nbsp;</span></span>
										@endif
									@endif
								@else
									{!! $skillvalue->workareatitle !!}
							@endif
							</td>
				
								@if($skillvalue->workareatitle == 'Language abilities')
								<td ><img height="80px" width="120px" src="<?php echo $path."/img/cross-img.png";?>"></td>
								@else
								<td></td>
								@endif
					
						<td></td>
							<td></td>				
						</tr>
						<?php $sno++; ?>
					@endif
				@endforeach
			@endif
		</tbody>
	</table>
		@else
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
			<td width="15%" valign="top"><b>Willingness</b><br/><span>Yes/No</span> <!--Yes/No-->
			</td>
			<td width="15%" valign="top"><b>Experience </b><br/><span>Yes/No <br /> if yes,state <br/>the no. of <br/>years</span><!--Yes/No <br> if yes,state the no. of years-->
			</td>
			<td valign="top"><b>Assessment / Observation</b> <br/>Please state qualitative observations of FDW and/or rate the FDW (indicate N.A. of no evaluation was done)<br/>Poor ........................Excellent...N.A <br>1&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;4  &nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;N.A 
			</td>
			</tr>
			<tr>
				<td colspan='5' style = "text-align:center">
				{{ "Data not available" }}
				</td>
			</tr>
			</table>
		</tbody>
	@endif

	@if($maid_skills)
	<div class='page-break'></div>
	@endif
	@if(in_array('Overseas Training Centre',$interview_by))	
				<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:10pxmargin-left:5px;"/ ><span style="padding-left:10px;">
				<span style="border-bottom:1px solid #000;">Interviewed by overseas training centre / EA</span>(Please state name of foreign training centre / EA: <span style="border-bottom: 1px solid #000;"> {{ucfirst($user_data[0]->training_center)}})</span></span><br/>
				<span style="padding-left:32px;">State if the third party is certified (e.g. ISO9001) or audited periodically by the EA: <span style="border-bottom: 1px solid #000;">  {{ucfirst($user_data[0]->audited_by_EA)}}</span></span><br/>
				@if(in_array("Interviewed via telephone / teleconference",$interview_method))
				<span ><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference </span></span><br/>
					@else
					<span><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference </span></span><br/>
				@endif
				@if(in_array("Interviewed via videoconference",$interview_method))
					<span ><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
				@else
					<span ><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
				@endif
				@if(in_array("Interviewed in person",$interview_method))
					<span ><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
				@else
					<span ><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
				@endif
				@if(in_array("Interviewed in person and also made observation of FDW in the areas of work",$interview_method))
					<span><img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
				@else
					<span><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
				@endif
			<!--<li style="margin-left:15px;">Interviewed via videoconference </li>
					<li style="margin-left:15px;">Interviewed in person </li>
					<li style="margin-left:15px;">Interviewed in person and also made observation of FDW in the areas of work listed in table </li>-->
	@else
				<img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>"  style="padding-top:10px;margin-left:5px;"/ ><span style="padding-left:10px;">
				<span style="border-bottom:1px solid #000;">Interviewed by overseas training centre / EA</span>(Please state name of foreign training centre / EA: ____________ )</span><br/>
				<span style="padding-left:32px;">State if the third party is certified (e.g. ISO9001) or audited periodically by the EA: ____________</span><br/>
			
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via telephone/teleconference </span></span><br/>
				
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed via videoconference</span></span><br/>
				
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person</span></span><br/>
				
					<span style="list-style-type:none;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;padding-left:34px;"><span style="padding-left:5px;">Interviewed in person and also made observation of FDW in the areas of work listed in table</span></span><br/>
	@endif
	@if($maid_skills)
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
			<td width="15%" valign="top"><b>Willingness</b><br/><span>Yes/No</span> <!--Yes/No-->
			</td>
			<td width="15%" valign="top"><b>Experience </b><br/><span>Yes/No <br /> if yes,state <br/>the no. of <br/>years</span><!--Yes/No <br> if yes,state the no. of years-->
			</td>
			<td valign="top"><b>Assessment / Observation</b> <br/>Please state qualitative observations of FDW and/or rate the FDW (indicate N.A. of no evaluation was done)<br/>Poor ........................Excellent...N.A <br>1&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;4  &nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;N.A 
			</td>
			</tr>
			@if(in_array('Overseas Training Centre',$interview_by))
					<?php $sno=1; ?>
				@foreach ($maid_skills as $skillid => $skillvalue)
					@if($skillvalue->otherskill == 'N' && $skillvalue->workareatitle != 'Care for Special Needs'  && $skillvalue->interview_type=='Overseas EA')
						<tr>
							<td width="5%"  style="height: 50px;"valign="top">{{$sno}}
							</td>
							<td width="25%"  valign="top" style="text-align:left;padding-left:5px;">
								@if($skillvalue->workareatitle == 'Cooking' || $skillvalue->workareatitle == 'Language abilities' || $skillvalue->workareatitle == 'Other skills, if any' ||  $skillvalue->workareatitle == 'Care of infants/children' )
									{!! $skillvalue->workareatitle !!}<br/>
										@if($skillvalue->feedback_comment!= '')
										{!! $skillvalue->feedback_comment !!}
										@elseif($skillvalue->workareatitle == 'Care of infants/children')
												<span>Please specify age range:<br/><span style="border-bottom:1px solid #000;padding-left:130px;">&nbsp;</span></span>
										@elseif($skillvalue->workareatitle == 'Cooking')
													<span>Please specify cuisines:</span>	
										@else
												<span>Please specify:<span style="border-bottom:1px solid #000;padding-left:60px;">&nbsp;</span></span>
										@endif
								@else
									{!! $skillvalue->workareatitle !!}
								@endif
							</td>
							@if($skillvalue->willingness == 'Yes')
								@if($skillvalue->workareatitle == 'Language abilities')
								<td ><img height="80px" width="120px" src="<?php echo $path."/img/cross-img.png";?>"></td>
								@else
								<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">-->Yes</td>
								@endif
							@else
								@if($skillvalue->workareatitle == 'Language abilities')
								<td><img height="80px" width="100px" src="<?php echo $path."/img/cross-img.png";?>"></td>
								@else
								<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>">-->No</td>
								@endif
							@endif
					<!--	<td width="15%" valign="top">{!! $skillvalue->willingness !!}
						</td>
						<td width="15%" valign="top">{!! $skillvalue->experience !!}
						</td>-->
				@if($skillvalue->experience == 'Yes')
					@if($skillvalue->workareatitle == 'Language abilities')
							<td ><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">--></td>
					@else
					<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">-->Yes
					</td>
					@endif
				@else
					@if($skillvalue->workareatitle == 'Language abilities')
						<td ><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">--></td>
					@else
					<td><!--<img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>">-->No</td>
					@endif
				@endif
				@if($skillvalue->rating)
					@if($skillvalue->workareatitle == 'Language abilities')
						<td ><!--<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">--></td>
					@else
					<td>{!! $skillvalue->rating !!}
					</td>
					@endif
				@else
					<td></td>
				@endif
					<!--<td>
						<?php for($i = 0; $i<$skillvalue->rating; $i++){ ?>
						  <span><img height="15px" width="15px" src="<?php echo $path."/img/gold-star.png";?>"></span>
						<?php } ?>
						<?php for($i = 5; $skillvalue->rating<$i; $i--){ ?>
						  <span><img height="15px" width="15px" src="<?php echo $path."/img/gray-star.png";?>"></span>
						<?php } ?>
					</td>
					<!--<td>{!! $skillvalue->feedback_comment !!}
					</td>-->
				</tr>
				<?php $sno++; ?>
				@endif
				@endforeach
			@else
					<?php $sno=1; ?>
				@foreach ($maid_skills as $skillid => $skillvalue)
					@if($skillvalue->otherskill == 'N' && $skillvalue->workareatitle != 'Care for Special Needs')
					<tr>
						<td width="5%"  style="height: 50px;"valign="top">{{$sno}}
						</td>
						<td width="25%"  valign="top" style="text-align:left;padding-left:5px;">
						@if($skillvalue->workareatitle == 'Cooking' || $skillvalue->workareatitle == 'Language abilities' || $skillvalue->workareatitle == 'Other skills, if any' ||  $skillvalue->workareatitle == 'Care of infants' || $skillvalue->workareatitle == 'Care of children')
								{!! $skillvalue->workareatitle !!}<br/>
							@if($skillvalue->feedback_comment == ''  )
									@if($skillvalue->workareatitle == 'Care of infants' || $skillvalue->workareatitle == 'Care of children')
										<span>Please specify age range:<br/><span style="border-bottom:1px solid #000;padding-left:130px;">&nbsp;</span></span>
									@elseif($skillvalue->workareatitle == 'Cooking')
										<span>Please specify cuisines:</span>	
									@else
											<span>Please specify:<span style="border-bottom:1px solid #000;padding-left:60px;">&nbsp;</span></span>
									@endif
							@endif
						@else
							{!! $skillvalue->workareatitle !!}
						@endif
						</td>
						@if($skillvalue->workareatitle == 'Language abilities')
						<td><img height="80px" width="100px" src="<?php echo $path."/img/cross-img.png";?>"></td>
						@else
							<td></td>
						@endif
						<td></td>
						<td></td>
					</tr>
					<?php $sno++; ?>
				@endif
				@endforeach
			@endif
		</tbody>
	</table>
	@else
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
			<td width="15%" valign="top"><b>Willingness</b><br/><span>Yes/No</span> <!--Yes/No-->
			</td>
			<td width="15%" valign="top"><b>Experience </b><br/><span>Yes/No <br /> if yes,state <br/>the no. of <br/>years</span><!--Yes/No <br> if yes,state the no. of years-->
			</td>
			<td valign="top"><b>Assessment / Observation</b> <br/>Please state qualitative observations of FDW and/or rate the FDW (indicate N.A. of no evaluation was done)<br/>Poor ........................Excellent...N.A <br>1&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;4  &nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;N.A 
			</td>
			</tr>
			<tr>
				<td colspan='5' style = "text-align:center">
				{{ "Data not available" }}
				</td>
			</tr>
			</table>
		</tbody>
	@endif
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
			$workarea=$maid_employment_historyvalue->workareaname;
			$skills=explode(',',$maid_employment_historyvalue->workareaname);
			//print_r($skills); 
if($skills[count($skills)-1] == " if any"){
array_pop($skills);array_pop($skills);  
$workarea=implode(',',$skills);
}
//print_r($workarea);

		?>
		@if($maid_employment_history)
		<tr>
		<!--<td>{{$sno}}
		</td>-->
			<td> <?php echo date('M',mktime(null,null,null, $maid_employment_historyvalue->from_month+1,null)); ?>/{!! $maid_employment_historyvalue->date_from !!}
			</td>
			<td> <?php echo date('M',mktime(null,null,null, $maid_employment_historyvalue->to_month+1,null)); ?>/{!! $maid_employment_historyvalue->date_to !!}
			</td>
			<td>
			@if($maid_employment_historyvalue->other_country)
				{{ ucfirst($maid_employment_historyvalue->other_country) }}
			@else
				{!! ucfirst($maid_employment_historyvalue->countryname) !!}
			@endif
			</td>
			<td>
			{!! ucfirst($maid_employment_historyvalue->employer) !!}
			</td>
			<td>
			{!! ucfirst($workarea) !!}
			@if($maid_employment_historyvalue->other_workarea)
				@if($workarea)
				,
				@endif
				{!! ucfirst($maid_employment_historyvalue->other_workarea) !!}
					
			@endif
			</td>
			<td>{!! ucfirst($maid_employment_historyvalue->employment_remarks) !!}
			</td>
		</tr>
		@else
			
		@endif
		
		<?php $sno++; ?>
		@endforeach
		@if(!$maid_employment_history)
		<tr ><td style="margin:20px; height:30px"></td><td style="margin:25px; height:30px"></td><td style="margin:25px; height:30px"></td><td style="margin:20px; height:30px"></td><td style="margin:20px; height:30px"></td><td style="margin:25px; height:30px"></td></tr>
		<tr ><td style="margin:20px; height:30px"></td><td style="margin:25px; height:30px"></td><td style="margin:25px; height:30px"></td><td style="margin:20px; height:30px"></td><td style="margin:20px; height:30px"></td><td style="margin:25px; height:30px"></td></tr>
		@endif
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
				break;
			  }
		?>
	@endforeach
	<table class="table table-bordered test" style="width:100%;">
		<tbody>
			<tr>
			  <td><span>Previous working experience in Singapore: 
			<!--  @if($previus_singapore_experience == 'Yes')
			<img height="15px" width="15px" src="<?php echo $path."/img/cheked.jpg";?>">Yes 
			  @else
				<img height="15px" width="15px" src="<?php echo $path."/img/blank.jpg";?>">No
				@endif-->
				<span style="padding-left:90px;">			 
				@if($previus_singapore_experience == 'Yes')
				<img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;">Yes</span> 
				@else
				<span style="padding-left:90px;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;">Yes </span>
				@endif
				<span style="padding-left:100px;">
				@if($previus_singapore_experience != 'Yes')
				<img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;">No </span>
				@else
				<span style="padding-left:100px;"><img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;">No </span>
				@endif
				</span><br/>
				(The EA is required to obtain the FDW’s employment history from MOM and furnish the employer with the employment history of the FDW. The employer may also verify the FDW’s employment history in Singapore through WPOL using SingPass)
				</td>
			</tr>
		</tbody>
	</table>
	 <!--<p>(The EA is required to obtain the FDW’s employment history from MOM and furnish the employer with the employment history of the FDW. The employer may also verify the FDW’s employment history in Singapore through WPOL using SingPass)</p>-->
	<h1 style="font-weight:bold;font-size:11px;padding-top:25px;"> C3. <span style="margin-left:15px;">Feedback from previous employers in Singapore</span> </h1>
	@if($previus_singapore_experience == 'Yes')
		<table class="table table-bordered1">
			<tbody>
				<tr>
					<td width="12%"></td>
					<td colspan="6" align="center"><b>Feedback</b></td>
				</tr>
				<?php $sno=1; ?>
				@foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
				@if($maid_employment_historyvalue->country == 5)
				<tr>
					<td width="12%"><b>Employer{{$sno}}</b></td>
					<td colspan="6" align="center"> {!! ucfirst($maid_employment_historyvalue->employer_feedback) !!}</td>
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
	<h3 style="font-size:12px; ">(D)<span style="border-bottom: 1px solid #000; margin-left:15px;">AVAILABILITY OF FDW TO BE INTERVIEWED BY PROSPECTIVE EMPLOYER</span> </h3><br/>
		<p>
		@if(in_array("In person with observation in the areas of work",$interviewby_prospective_employer))
			<img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW is not available for interview </span><br/>
		@else
			<img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW is not available for interview </span><br/>
		@endif
		@if(in_array("Telephone / Teleconference",$interviewby_prospective_employer))
			<img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW can be interviewed by phone</span><br/>
		@else
			<img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW can be interviewed by phone</span><br/>
		@endif
		@if(in_array("Videoconference",$interviewby_prospective_employer))
			<img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW can be interviewed by video-conference</span><br/>
		@else
			<img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW can be interviewed by video-conference</span><br/>
		@endif
		@if(in_array("In person",$interviewby_prospective_employer))
			<img height="14px" width="14px" src="<?php echo $path."/img/cheked.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW can be interviewed in person</span><br/>
		@else
			<img height="14px" width="14px" src="<?php echo $path."/img/blank.jpg";?>"style="padding-top:4px;"><span style="padding-left:15px;">FDW can be interviewed in person</span><br/>
		@endif
		</p>
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
		<div style="margin-top:25px;margin-left:5px;">
			<span>
			{{ucfirst($user_data[0]->overall_remarks)}}
			</span>
		</div>
	@else
	<div style = "margin-top:30px; height:30px; border-top:1px solid #000;border-bottom:1px solid #000;">
	   </div>
	@endif
	   <br />
	<table class = "table" style="margin-top: 35px;">
		<tr>
		<td style="width:50%;"><?php// echo date("d/m/Y") ?> <div style="border-top: 1px solid #000; padding-top: 2px; font-size: 11px;width:70%;">&nbsp;&nbsp;FDW Name and Signature<br/><span style="padding-left:5px;">Date: <?php echo date("d-m-Y") ?></span></div></td>

		<td ><?php// echo date("d/m/Y") ?> <div style="border-top: 1px solid #000; padding-top: 2px; font-size: 11px;width:80%;margin-left:20px;">&nbsp;&nbsp;EA Personnel Name and Registration Number <br/><span style="padding-left:5px;">Date: <?php echo date("d-m-Y") ?></span> </div></td>
	</tr>
	</table>
	<p style="padding-top: 20px;">I have gone through the 4 page bio-data of this FDW and confirm that I would like to employ her</p>
	<?php// echo date("d/m/Y") ?> <div style="border-top: 1px solid rgb(0, 0, 0); margin-top: 35px; padding-top: 5px; clear: both; width: 30%; font-size: 11px;">Employer Name and NRIC No.<br/> Date: <?php echo date("d-m-Y") ?>
		</div>
		<p style="text-align:center;font-weight:bold;">***************</p>
	<h3 style="font-size:11px;"><span style="border-bottom: 1px solid #000;">IMPORTANT NOTES FOR EMPLOYERS WHEN USING THE SERVICES OF AN EA</h3>
	<ul style="padding-top:10px;">
		<li>Do consider asking for an FDW who is able to communicate in a language you require, and interview her (in person/phone/videoconference)to ensure that she can communicate adequately.</li>
		<li>Do consider requesting for an FDW who has a proven ability to perform the chores you require, for example, performing house hold chores(especially if she is required to hang laundry from a high-rise unit), cooking and caring for young children or the elderly.</li>
		<li>Do work together with the EA to ensure that a suitable FDW is matched to you according to your needs and requirements.</li>
		<li>You may wish to pay special attention to your prospective FDW’s employment history and feedback from the FDW’s previous employer(s) before employing her.</li>
	 </ul>
</div>
</body>
</html>
