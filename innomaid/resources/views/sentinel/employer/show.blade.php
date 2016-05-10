<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Innomaid</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">


<!-- Custom Fonts -->
<link href="{{ asset('front/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<link href="{{ asset('front/css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/custom-style.css') }}" rel="stylesheet">
<link href="{{ asset('front/css/custom-mediaqueries.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/my-style.css') }}">  
</head>
<body style="background:white;">
<div class="container-fluid">
  <div class="row row-offcanvas row-offcanvas-left">
    
    <div class="col-sm-9 col-md-11 main navi-right" style="background:white !important">
    
     <a class="btn1 btn" style="background:#008cba;" href="{{ url('/fdws/')}}">
      Go to List
    </a>
  <div id="demo" class="collapse">
   <div class="col-md-10 col-md-offset-1 form-box-popup">
            
          </div>         
          
  </div>
    
      <div class="row" style="margin-bottom:20px;"> 
        <!--toggle sidebar button-->
        <div class="row container">
          <p class="visible-xs pull-left">
            <button type="button" class="btn custom-btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-bars"></i> MENU</button>
          </p>
          <p class="visible-xs pull-right"><img src="images/logo.png" class="img-responsive"></p>
        </div>
      <div style="overflow:hidden;">
      <div>
        <div><!--header-->
            <div class="fkm-heading">
            <!-- <img src="images/fkm-logo.jpg" /> -->
            </div>
            <!-- <div class="fkm-heading">
            <h1>PT. FIOKEN KENCANA MANDIRI </h1>
            <h4>Manpower Supplier and Services</h4>
            <h5>SIPPTKI Menakertrans RI No: Kep. 364/MEN/XII/07</h5>
            </div> -->
            </div>
            <div class="fkm-heading"><h3>Bio-data Of Foreign Domestic Worker (FDW)</h3><br />
* Please ensure that you run through the information within the bio-data as it is an important document to help you select a suitable FDW 
            </div>
            <div style="clear:both;">
            </div>
            <div>
        <h3>(A) PROFILE OF FDW</h3>
        </div>
        <div style="float:left;">
          <h5> A1. Personal Information</h5>
           </div>
        <div style="clear:both;">
        </div>
           <form class="form-horizontal" style="float:left;  width:70%">

        <div id="personal-info-2">

            <label for="inputEmail">Name of FDW:<span class="notbold"> {{ucfirst($user_data[0]->name)}}</span></label>
           
            
        </div>
       <div id="personal-info-2">

            <label for="inputdob">Date of Birth: 
            <span class="notbold">
            @if( $user_data[0]->date_of_birth =='0000-00-00')
                {{ '' }}
            @else
                {{  date("d M Y", strtotime($user_data[0]->date_of_birth)) }}
            @endif
            </span></label>
            

        </div>
         <div id="personal-info-2">

            <label for="inputpob">Place of Birth: <span class="notbold">{{$user_data[0]->place_of_birth}}</span></label>
            

        </div>
         <div id="personal-info-2">

            <label for="inputweight">Weight:<span class="notbold">{{$user_data[0]->weight}}kg</span></label>
             

        </div>
         <div id="personal-info-2">

            <label for="inputheight">Height:<span class="notbold">{{$user_data[0]->height}}cm </span></label>
             

        </div>
         <div id="personal-info-2">

            <label for="inputnationality">Nationality:<span class="notbold">{{$user_data[0]->nationality_name}}</span></label>
             

        </div>
         <div id="personal-info-2">

            <label for="inputaddress">Residential Address: <span class="notbold">{{$user_data[0]->address}}</span></label>
            

        </div>
           <div id="personal-info-2">

            <label for="inputport">Name of port / airport to be repatriated to:  <span class="notbold"> {{$user_data[0]->port_name}}</span></label>
           
        </div>
         <div id="personal-info-2">

            <label for="inputcontract">Contract Number:<span class="notbold">{{ $user_data[0]->contact_number}}</span></label>
             
        </div>
         <div id="personal-info-2">

            <label for="inputreligion">Religion: <span class="notbold">{{ $user_data[0]->religion}}</span></label>
            
        </div>
         <div id="personal-info-2">

            <label for="inputeducation">Education:<span class="notbold">{{ $user_data[0]-> education_level}}</span></label>
             
        </div>
         <div id="personal-info-2">

            <label for="inputsiblings">Number of Siblings:<span class="notbold"> {{ $user_data[0]-> no_of_siblings}}</span></label>
            
        </div>
          <div id="personal-info-2">

            <label for="inputmarital" >Marital status:<span class="notbold">{{ $user_data[0]-> marital_status}}</span></label>
             
        </div>

         <div id="personal-info-2">

            <label for="inputchildren">Number of Children: <span class="notbold">{{ $user_data[0]-> no_of_children}} people</span></label>
            
        </div>

        <?php 
        $childage = explode(',',$user_data[0]->children_age);
        for($i=0; $i<$user_data[0]->no_of_children;$i++) { 
        ?>
        <div id="personal-info-2">

            <label for="inputchildren">Age of child<?php echo $i+1; ?> : <span class="notbold">{{ $childage[$i] }} year</span></label>

        </div>
        <?php }?>
  <div style="float:left;">
          <h5> A2. Medical History / Dietary Restrictions</h5>
         </div>
      <div style="clear:both;">
        </div>
         @if($user_data[0]->allergies != 'Yes')
         <div id="personal-info-2">

            <label for="inputallergies">Allergies ( if any):<span class="notbold">{{ $user_data[0]->allergy_description}}</span></label>
             
        </div>
         @else
        <div id="personal-info-2">

            <label for="inputallergies">Allergies:<span class="notbold"><?php echo "No"; ?></span></label>
            
        </div>
         @endif

        <div id="personal-info-2" width:>

            <label for="inputillness">Past and existing illness (including chronic ailments and illnesses requiring medication ): <span class="personal-info"></span></label>
             
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
        </div>
         @if($user_data[0]->physical_disablity != 'Yes')
        <div id="personal-info-2">

          <label for="inputdisabilities">Physical Disabilities:<span class="notbold"> {{$user_data[0]->physical_disablity}}</span></label>
        </div>
        @else
        <div >

            <label for="inputdisabilities">Physical Disabilities:<span class="notbold">{{$user_data[0]->physical_disability_description}}</span></label>
            
        </div>
         @endif
         
        @if($user_data[0]->dietary_restrictions != 'Yes')
         <div id="personal-info-2">

            <label for="inputrestrictions">Dietary Restrictions:<span class="notbold">{{$user_data[0]->dietary_restrictions}}</span></label>
            
        </div>
        @else

        <div id="personal-info-2">

            <label for="inputdisabilities">Dietary Restrictions:<span class="notbold">{{$user_data[0]->dietary_restrictions_description}}</span></label>

        </div>
        @endif
        <div id="personal-info-2">
            <label for="inputfood">Food Handling Preferences:<span class="notbold">{{$user_data[0]->food_handling_prefrences}}</span></label>
            
        </div>
        <div style="float:left;">
        <h5>A3. Others</h5>
        </div>
         <div id="personal-info-2">

            <label for="inputday">Preference for rest day:<span class="notbold">{{$user_data[0]->rest_days_preference}}</span></label>
             
        </div>
          <div id="personal-info-2">
          	@if($user_data[0]->medication_remarks)
            <label for="inputremarks">Any Other Remarks:<span class="notbold">{{$user_data[0]->medication_remarks}}</span></label>
 			@else
 			<label for="inputremarks">Any Other Remarks:<span class="notbold">
            <?php echo 'N/A'; ?>
            </span></label>
           @endif
            
             
        </div>

    </form>
    <div style="float:left;">
  @if($user_data[0]->image != '')
      <img src="{{ asset('uploads/maid_image/'.$user_data[0]->image) }}" />
  @else
      <img src="{{ asset('front/images/img-not-found.jpg') }}">
  @endif
        
    </div>
        <div style="clear:both;">
        </div>
        <h3>(B) SKILLS OF FDW</h3><br />
        <div style="float:left;">
       <h5> B1. Method of Evaluation of skills</h5>
       </div><br />
       <div style="clear:both;"> </div>
<p>Please indicate the method(s) used to evaluate the FDW’s skills ( can tick more than one ) :
Based on FDW’s declaration,no evaluation/observation by Singapore EA or overseas training centre/EA</p>
 <?php $interviewby = explode(';', $user_data[0]->interview_method)?>
 <ul><b>Interviewed by {{$user_data[0]->interviewed_by}}</b>
 		@foreach($interviewby as $interviewid => $interviewtitle)
		<li><?php echo $interviewtitle;?>
        </li>
        @endforeach
        </ul>
        <b>Skill:</b>
        <table class="table table-bordered">
        <tr>
        <td><b>S/No</b>
        </td>
        <td><b>Areas of Work</b>
        </td>
        <td><b>Willingness</b>
        </td>
        <td><b>Experience</b>
        </td>
        <td><b>Assessment / Observation <br>( Poor ………..…Excellent 1 2 3 4 5)</b>
        </td>
        <td><b>Comment</b>
        </td>
        </tr>
       	<?php $sno=1; ?>
        @foreach ($maid_skills as $skillid => $skillvalue)
        <tr>
        <td>{{$sno}}
        </td>
        <td>{!! $skillvalue->workareatitle !!}
        </td>
        <td>{!! $skillvalue->willingness !!}
        </td>
        <td>{!! $skillvalue->experience !!}
        </td>
        <td>{!! $skillvalue->rating !!}
        </td>
        <td>{!! $skillvalue->feedback_comment !!}
        </td>
        </tr>
        <?php $sno++; ?>
        @endforeach
        </table>
        
        <h3>(C) EMPLOYMENT HISTORY OF THE FDW</h3><br />
        <div style="float:left;">
       <h5> C1. Employment History Overseas</h5>
       </div><br />

        <table class="table table-bordered">
        <tr>
        <td><b>S/No</b>
        </td>
        <td><b>Year from</b>
        </td>
        <td><b>Year to</b>
        </td>
        <td><b>Country</b>
        </td>
        <td><b>Work duties</b>
        </td>
        <td><b>Remarks</b>
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
        <?php $sno++; ?>
        @endforeach
        </table>
        <div style="float:left;">
       <h5> C2. Employment History in Singapore</h5>
       </div><br />
       <div id="personal-info-2">

            <label for="inputremarks">Previous working experience in Singapore: <span class="personal-info">{{$previus_singapore_experience}}</span></label>
             
        </div>
       
       ( The EA is required to obtain the FDW’s employment history from MOM and furnish the employer with the employment history of the FDW. The employer may also verify the FDW’s employment history in Singapore through WPOL using SingPass) 
		<div style="clear:both;"> </div>
        <div style="float:left;">
       <h5> C3. Feedback from previous employers in Singapore</h5>
       </div><br />
       <div style="float:left;">
       Feedback was / was not obtained by the EA from the previous employers. If feedback was obtained ( attach testimonial if possible), please indicate the feedback in the tablet below :
       </div><br />
       <table class="table table-bordered">
        <tr>
        <td style="width:15%"><b>S/No</b>
        </td>
        <td style="width:25%"><b>Employer</b>
        </td>
        <td style="width:60%"><b>Feedback</b>
        </td>
        </tr>
       	<?php $sno=1; ?>
        @foreach ($maid_employment_history as $maid_employment_historyid => $maid_employment_historyvalue)
        @if($maid_employment_historyvalue->employer_feedback)
        <tr>
        <td>{{$sno}}
        </td>
        <td>{!! $maid_employment_historyvalue->employer !!}
        </td>
        <td>{!! $maid_employment_historyvalue->employer_feedback !!}
        </td>
        </tr>
        <?php $sno++; ?>
        @endif
        @endforeach
        </table>
       <h3>(D) OTHER DETAILS</h3><br /> 
       <?php $can_be_interviewed_via = explode(';', $user_data[0]->can_be_interviewed_via); ?>
       <ul><b>Available for interview via</b>
 		@foreach($can_be_interviewed_via as $can_be_interviewed_viaid => $can_be_interviewed_viatitle)
		<li><?php echo $can_be_interviewed_viatitle;?>
        </li>
        @endforeach
        </ul>
         <div id="personal-info-2">
			@if($user_data[0]->overall_remarks)
            <label for="inputremarks">Other Remarks:<span class="personal-info">
            {{$user_data[0]->overall_remarks}}
            </span></label>
 			@else
 			<label for="inputremarks">Other Remarks:<span class="personal-info">
            <?php echo 'N/A'; ?>
            </span></label>
           @endif
             
        </div>
      </div>
        </div>
      </div>
      <a class="btn1 btn" style="background:#008cba;" href="{{ url('/fdws/')}}">
      Go to List
    </a>
        </div>

          </div>
    </div>
    
    <!--/row-->
    
    <footer>
      <p class="pull-right">©2015 Company</p>
    </footer>
  </div>
</div>
<!--/.container--><!-- script references --> 
<script src="{{ asset('front/js/jquery-1.10.2.min.js') }}"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('front/js/scripts.js') }}"></script> 
<script>
    $('#myCarousel').carousel({
        interval:   4000
    });
    
    $('.navi-left').css('height', $(window).height()+'px');
    $('.main').css('height', $(window).height()+'px');
    //$('.main').css('overflow', 'scroll');
    //$('.main').css('overflow-x', 'hidden');
</script>


<script>
$(document).ready(function(){
  $("#demo").on("hide.bs.collapse", function(){
    $(".btn1").html('<span class="fa fa-chevron-down"></span> Agency Login | Join Innomaid');
  });
  $("#demo").on("show.bs.collapse", function(){
    $(".btn1").html('<span class="fa fa-chevron-up"></span> Agency Login | Join Innomaid');
  });
});
</script>
</body>
</html>
