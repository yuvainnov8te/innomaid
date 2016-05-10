<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Innomaid</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<?php $path = public_path(); 
$root_path = $_SERVER['DOCUMENT_ROOT'];?>
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

}
.table {
	margin-top:20px;
    margin-bottom: 20px;
	width:100%;
}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}
#mytest
{
	width:26%;
}
</style>
<body style="background:white;">
  <div class="container-fluid">
        @if($user_data[0]->agency_logo)
        <div style="width:100px; height:100px;">
            <img style = "height:100px; width:100px;"src='<?php echo $root_path."/uploads/agency_logo/".$user_data[0]->agency_logo;?>' />
        </div>
        @endif
            <h3 style ="text-align:center;font-weight:bold;">JOB ORDER <br />- EMPLOYER DATA SHEET -</h3>
                  <h3 style="margin-top:45px;font-weight:500;">
				  Information may be obtained <i>from interview through telephone/in person or by fax/email.*</i><br/> <span style="font-size:11px;">*delete where appropriate</span></h3>
                  <table class="per_info" width="100%" border="1" cellspacing="0" style=" padding:0px 0px 0px 0px;margin-top:29px;"> 
                    <tbody>
                      <tr><td colspan="5" style=" padding-left:10px;">Information obtained is solely for the purpose of work permit application. None of it should be divulged for any other purposes.</td></tr>
					  <tr>
					  <th></th>
					  <th colspan="2"style="text-align:left;padding-left:5px;">Employer</th>
					  <th colspan="2"style="text-align:left;padding-left:5px;">Spouse</th>
					  </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;" id="mytest">Name</td>
                        <td colspan="2" style="padding-left:5px;">{{ucfirst($employer_data[0]->name_title)}} {{ucfirst($employer_data[0]->employer_name)}}</td>
                        <!--<td>Spouse Name:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;"> {{ucfirst($employer_data[0]->spouse_name)}}</td>
                        @else
                        <td colspan="2" style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">Date of birth</td>
                        <td colspan="2" style="padding-left:5px;">@if( $employer_data[0]->employer_date_of_birth =='0000-00-00')
                          {{ '' }}
                          @else
                          {{  date("d M Y", strtotime($employer_data[0]->employer_date_of_birth)) }}
                          @endif</td>
                       <!-- <td>Spouse Date of birth:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;">@if( $employer_data[0]->spouse_date_of_birth =='0000-00-00')
                          {{ '' }}
                          @else
                          {{  date("d M Y", strtotime($employer_data[0]->spouse_date_of_birth)) }}
                          @endif</td>
                        @else
                        <td colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                          @endif
                      </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">NRIC No.<br/><span style="font-weight:500;font-size:11px;">(for S'porean,PR & M'slan)</span></td>
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->employer_nric_no}}</td>
                        <!--<td>Spouse NRIC Number:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->spouse_nric_no}}</td>
                        @else
                        <td colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">Passport<br/><span style="font-weight:500;font-size:11px;">(foreign national only)</span></td>
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->employer_passport}}</td>
                        <!--<td>Spouse Passport:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->spouse_passport}}</td>
                        @else
                        <td colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
			<tr>
                        <td style="font-weight:bold;padding-left:5px;">Passport Expiry Date<br/><span style="font-weight:500;font-size:11px;">(foreign national only)</span></td>
                        <td colspan="2" style="padding-left:5px;">
			 @if($employer_data[0]->employer_passport_expiry_date!='0000-00-00')
				{{$employer_data[0]->employer_passport_expiry_date}}
			@endif</td>
                        <!--<td>Spouse Passport:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;">
			@if($employer_data[0]->spouse_passport_expiry_date!='0000-00-00')
				{{$employer_data[0]->spouse_passport_expiry_date}}
			@endif</td>
                        @else
                        <td colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
					
					   <tr>
					<?php $Residential_Status = explode(';', $employer_data[0]->employer_residential_status);?>
						@foreach($Residential_Status as $residential_Statusid => $residential_title)
							<?php $residential_status_value[] = $residential_title;
							
							?>
						@endforeach
					
						<td style="font-weight:bold;padding-left:75px;">Residential Status</td>
	<td colspan="2" style="padding-left:5px">
		@if(in_array("S'porean or PR",$residential_status_value))
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">S'porean or PR</span></span>
		@else
			<span><img  height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">S'porean or PR</span></span>
		@endif
		@if(in_array("EP",$residential_status_value))
			<span ><img style="padding-left:12px;" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">EP</span></span>
		@else
			<span ><img style="padding-left:12px;" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">EP</span></span>
		@endif
		<br />
		@if(in_array("Retriee",$residential_status_value))
			<span><img height= '15px' width = '15px' src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">Retriee</span></span>
		@else
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Retriee</span></span>
		@endif
		@if(in_array("DP",$residential_status_value))
			<span><img style="padding-left:55px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">DP</span></span>
		@else
			<span><img style="padding-left:55px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">DP</span></span>
		@endif		<br />

		@if(in_array("Foreign Armed Forces Personnel",$residential_status_value))
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">Foreign Armed Forces Personnel</span></span><br/>
		@else
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Foreign Armed Forces Personnel</span></span><br/>
		@endif
		@if(in_array("Diplomat",$residential_status_value))
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">Diplomat</span></span>
		@else
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Diplomat</span></span>
		@endif	
		<br />
		</td>
		<td colspan="2" style="padding-left:5px">
		@if($employer_data[0]->marital_status == 'Married')
		@if(in_array("S'porean or PR",$residential_status_value))
			<span><img  height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">S'porean or PR</span></span>
		@else
			<span><img  height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">S'porean or PR</span></span>
		@endif
		@if(in_array("EP",$residential_status_value))
			<span ><img style="padding-left:12px;" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">EP</span></span>
		@else
			<span ><img style="padding-left:12px;" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">EP</span></span>
		@endif
		<br />
		@if(in_array("Retriee",$residential_status_value))
			<span><img height= '15px' width = '15px' src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">Retriee</span></span>
		@else
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Retriee</span></span>
		@endif
		@if(in_array("DP",$residential_status_value))
			<span><img style="padding-left:55px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">DP</span></span>
		@else
			<span><img style="padding-left:55px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">DP</span></span>
		@endif	<br />

		@if(in_array("Foreign Armed Forces Personnel",$residential_status_value))
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">Foreign Armed Forces Personnel</span></span>
		@else
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Foreign Armed Forces Personnel</span></span>
		@endif
		<br/>
		@if(in_array("Diplomat",$residential_status_value))
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">Diplomat</span></span>
		@else
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Diplomat</span></span>
		@endif	
		@else
			<span><img  height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">S'porean or PR</span></span>
			<span ><img style="padding-left:12px;" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">EP</span><br/>
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Retriee</span></span>
			<span><img style="padding-left:55px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">DP</span></span><br />
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Foreign Armed Forces Personnel</span></span><br/>
			<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Diplomat</span></span>
		@endif
	</td>
					</tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">Profession</td>
                        <td style="padding-left:5px;"colspan="2">{{ucfirst($employer_data[0]->employer_profession)}}</td>
                        <!--<td>Spouse Profession:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td style="padding-left:5px;text-align:left;"colspan="2">{{ucfirst($employer_data[0]->spouse_profession)}}</td>
                        @else
                        <td style="padding-left:5px;"colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">Employer/Company</td>
                        <td colspan="2" style="padding-left:5px;">{{ucfirst($employer_data[0]->employer_company)}}</td>
                        <!--<td>Spouse Company:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                       <td colspan="2" style="padding-left:5px">{{ucfirst($employer_data[0]->spouse_company)}}</td>
                        @else
                        <td  colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">Office Phone</td>
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->employer_office_phone}}</td>
                       <!-- <td>Spouse Office Phone:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->spouse_office_phone}}</td>
                        @else
                        <td  colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
                      <tr>
                        <td style="font-weight:bold;padding-left:5px;">Mobile Phone</td>
                        <td colspan="2" style="padding-left:5px;">{{$employer_data[0]->employer_mobile_phone}}</td>
                        <!--<td>Spouse Mobile Phone:</td>-->
                        @if($employer_data[0]->marital_status == 'Married')
                        <td colspan="2" style="padding-left:5px;padding-left:5px;">{{$employer_data[0]->spouse_mobile_phone}}</td>
                        @else
                        <td  colspan="2"style="text-align:left;padding-left:5px;">{{'-'}}</td>
                        @endif
                      </tr>
                      <tr>
                        <td colspan='5'style="font-weight:bold;padding-left:5px;"><span >Address</span>
                        <span style="font-weight:500;">{{$employer_data[0]->address}}</td>
						</tr>
						<tr>
						<td colspan='3'></td>
                        <td colspan='2'><span  style="font-weight:bold;padding-left:5px;">Home Phone:</span><span  style="padding-left:5px;">{{$employer_data[0]->home_phone}}</span></td>
                      </tr> 
                      <tr rowspan="2">
                        <td colspan='5'style="font-weight:bold;padding-left:5px">Type of House:
						<span style="font-weight:500;padding-left:15px;">
						@if($employer_house_type)
								@foreach($employer_house_type as $employer_house_typeid => $employer_house_typevalue)
								<?php 	
									$house_type_value[]=$employer_house_typevalue->housetypetitle;
								?>
								@endforeach
								@else
									<?php $house_type_value = array("default");
									
									?>
								@endif
								@if(in_array("Bungalow",$house_type_value))
									<span><img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:7px;">Bungalow</span></span>
								@else
									<span><img height= '15px' width = '15px' src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:7px;">Bungalow</span></span>
								@endif	
							@if(in_array("Terrace",$house_type_value))
								<span ><img style="padding-left:5px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:7px;">Terrace </span></span>
								@else
									<span><img  style="padding-left:5px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:7px;">Terrace </span></span>
								@endif
								@if(in_array("HDB_room",$house_type_value))
									<span><img   style="padding-left:32px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:7px;">HDB_room </span></span>
								@else
									<span><img  style="padding-left:32px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:7px;">HDB_room </span></span>
								@endif	

								@if(in_array("Condominium",$house_type_value))
									<span ><img style="padding-left:65px;" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:7px;">Condominium </span></span>
								@else
									<span  ><img style="padding-left:65px;"height= '15' width = '15'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:7px;">Condominium </span></span>
								@endif
									<br />
							@if(in_array("Semi-D",$house_type_value))
									<span ><img style="padding-left:109px";height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:6px;">Semi-D</span></span>
								@else
									<span ><img style="padding-left:109px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:6px;">Semi-D</span></span>
								@endif
							@if(in_array("Private Flat",$house_type_value))
									<span ><img style="padding-left:17px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:6px;"> Private Flat </span></span>
								@else
									<span  ><img style="padding-left:17px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:6px;"> Private Flat </span></span>
								@endif
								@if(in_array("HDB 5-room & Above",$house_type_value))
									<span  ><img style="padding-left:11px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">  HDB 5-room & Above </span></span>
								@else
									<span ><img  style="padding-left:11px;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">  HDB 5-room & Above </span></span>
								@endif<br/>
								@if($employer_house_type)
								@if($employer_house_typevalue->house_type_id == 'Others' )
									<span  ><img style="padding-left:109px" height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">  Others:<span style="border-bottom:1px solid #000;padding-left:5px;">{{$employer_house_typevalue->house_type_other}}</span></span></span>
								@else
									<span><img style="padding-left:109px" height= '15' width = '15'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">Others</span><span style="border-bottom:1px solid #000;margin-left:5px;padding-left:55px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
							
								@endif
								@else
									<span><img style="padding-left:109px" height= '15' width = '15'src="<?php echo $root_path."/img/blank.jpg";?>"><span style="padding-left:5px;">Others</span><span style="border-bottom:1px solid #000;margin-left:5px;padding-left:55px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
								@endif
								</span>
							</td>
                      </tr>
					</tbody>
					 <tbody> 
                     <tr>
                        <th colspan="2" style="font-weight:bold;padding-left:25px;text-align:left;">Name of Family Members</th>
                        <th style="font-weight:bold;padding-left:5px;text-align:left;">Relationship</th>
                        <th style="font-weight:bold;padding-left:5px;text-align:left;">BC/NRIC,DP or PP No.</th>
                        <th style="font-weight:bold;padding-left:5px;text-align:left;">Date Of Birth</th>
                      </tr>
						@if($employer_family_details)
                       <?php $sno=1; ?>
                        @foreach ($employer_family_details as $employer_family_detailsid => $employer_family_detailsvalue)
                          <tr>
                          <td colspan="2"style="padding-left:5px;">{!! ucfirst($employer_family_detailsvalue->family_member_name) !!}
                          </td>
                          <td style="padding-left:5px;">{!! ucfirst($employer_family_detailsvalue->relationship) !!}
                          </td>
                          <td style="padding-left:5px;">{!! $employer_family_detailsvalue->bc_nric_dd_pp_no !!}
                          </td>
                          <td style="padding-left:5px;">@if( $employer_family_detailsvalue->member_date_of_birth =='0000-00-00')
                            {{ '' }}
                            @else
                            {{  date("d M Y", strtotime($employer_family_detailsvalue->member_date_of_birth)) }}
                            @endif
                          </td>
                          </tr>
                          <?php $sno++; ?>
                        @endforeach

					  @else
						 <tr><td colspan='2' style="padding-left:5px;">
							</td>
							<td >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							</tr>
							 <tr><td colspan='2' style="padding-left:5px;">
							</td>
							<td >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							</tr>
							 <tr><td colspan='2' style="padding-left:5px;">
							</td>
							<td >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							</tr>
					 @endif
                    <tr>
                        <th colspan = "5" style="font-weight:bold;padding-left:5px;text-align:left;">Purpose of this application is to hire:</th>
                        <?php $employer_purpose_to_hire = explode(';', $employer_data[0]->purpose_to_hire); ?>
						</tr>
						<tr>
                             @foreach($employer_purpose_to_hire as $employer_purpose_to_hireid => $employer_purpose_to_hirevalue)
								<?php $employer_purpose_hirevalue[] = $employer_purpose_to_hirevalue;?>
							@endforeach
							@if(in_array("A New FDW",$employer_purpose_hirevalue))
								<th style="text-align:left;font-weight:500;"><img style="padding-left:5px;font-weight:500;text-align:left;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">a new FDW</span></th>
							@else
								<th style="text-align:left;font-weight:500;"><img style="padding-left:5px;font-weight:500;text-align:left;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">a new FDW</span></th>
							@endif
							@if(in_array("A Replcement",$employer_purpose_hirevalue))
								<th style="text-align:left;font-weight:500;"colspan="2"><img style="padding-left:5px;font-weight:500;text-align:left;"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">a replacement</span><br/>
                                <span style="padding-left:5px;font-weight:500;text-align:left;font-weight:500;">Work Permit No. of<br/> <span  style="padding-left:5px">FDW to be </span>replaced:<span style="border-bottom:1px solid #000;">{{$employer_data[0]->purpose_to_hire_work_permit_no}}</span>
                                </span>
								</th>
							@else
								<th colspan="2" style="padding-left:5px;font-weight:500;text-align:left;font-weight:500;"><img  style="padding-left:5px"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">a replacement</span><br/> <span style="padding-left:5px;font-weight:500;text-align:left;">Work Permit No. of <br/> <span  style="padding-left:5px">FDW to be replaced:</span>
                                </span>
								<span style="border-bottom:1px solid #000;padding-left:75px;margin-left:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								</th>
							@endif
							@if(in_array("An Additional FDW",$employer_purpose_hirevalue))
								<th colspan="2" style="padding-left:5px;font-weight:500;text-align:left;"><img  style="padding-left:5px"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>"><span style="padding-left:5px;">an additional FDW</span></th>
							@else
								<th colspan="2" style="padding-left:5px;font-weight:500;text-align:left;"><img  style="padding-left:5px"height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>"><span style="padding-left:5px;">an additional FDW</span></th>
							@endif
                            
                      </tr> 
                       <tr>
                        <td colspan='5' style="padding-left:5px">If you are an expatriate just arrived in Singapore or a citizen/SPR just returned after a protracted absence and therefore have not paid income tax or are currently not liable for income tax,Please check here
						@if($employer_data[0]->is_income_tax_libal == 'Yes')
							<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>">
						@else
							
						<img height= '15px' width = '15px' src="<?php echo $root_path."/public/img/blank.jpg";?>"> 
						@endif
						and furnish a letter from your employer (with official letterhead) stating the following:<br/>
						
						1. Your Job Tittle :
                        @if($employer_data[0]->job_title)
                        <span style="border-bottom:1px solid #000;margin-left:5px;">{{ucfirst($employer_data[0]->job_title)}}</span>
						@else
						<span style="border-bottom:1px solid #000;margin-left:90px;padding-left:170px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						@endif<br/>
						2. Starting Date :
                       @if( $employer_data[0]->start_date =='0000-00-00')
						<span style="border-bottom:1px solid #000;margin-left:100px;padding-left:170px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                          @else
                          <span style="border-bottom:1px solid #000;margin-left:5px;">{{  date("d M Y", strtotime($employer_data[0]->start_date)) }}</span>
                          @endif<br/>
                      3. Monthly Income in S$ :
					 @if($employer_data[0]->monthly_income != 0.00)
                       <span style="border-bottom:1px solid #000;margin-left:5px;">{{$employer_data[0]->monthly_income}}</span>
					@else
						<span style="border-bottom:1px solid #000;margin-left:53px;padding-left:170px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					@endif
					</td>
                      </tr> 
					<tr>
                        <td colspan='5' style="padding-left:5px">If employer is Citizen or Permanent resident and have just return after an extended period and stay aboard please check box
						@if($employer_data[0]->is_employer_permanent_resident == 'Yes')
						<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>">
						@else<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>">
						@endif and furnish:<br/>
                       1. A copy of a tax returns, with the income tax authority of the country where you last worked.<br/>
						2. The latest copy of employer CPF statement showing the contribution made over the last 3 to 6 months.
						
						</td>
					  </tr>
						<tr>
                        <td colspan='5' style="padding-left:5px">If employer is liable for income tax, please check against the following option:<br />
								@if($employer_data[0]->is_house_hold_income == 'Yes')
                        		<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>">To Declare house hold income in the prescribed work permit application form. State of annual household income in S$ @if($employer_data[0]->annual_house_hold_income)<span style="border-bottom:1px solid #000;">{{$employer_data[0]->annual_house_hold_income}}.</span>
								@else
								<span style="border-bottom:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								@endif
								@else
								<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>">To Declare house hold income in the prescribed work permit application form. State of annual household income in S$
								<span style="border-bottom:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

								@endif<br/>
								@if($employer_data[0]->is_iras_notice == 'Yes')
								<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/cheked.jpg";?>">To attach latest IRAS Notice of Assessment of spouse and employer.
								@else
								<img height= '15px' width = '15px'src="<?php echo $root_path."/public/img/blank.jpg";?>">To attach latest IRAS Notice of Assessment of spouse and yourself.
								@endif

								</td>
                      </tr>
			 </tbody>
         </table>
  </div>
</body>
</html>
