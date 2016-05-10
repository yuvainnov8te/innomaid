@extends('default')

@section('title')
Innomaid
@stop

@section('head')
<script type="text/javascript">
  $(function () {
    if($('#deleteMsg').val() != ''){
      $('#myModal').modal('show');
    }
  });
  function addshortlist(id,token){

    var id = id;
    $.ajax({
        url:  "{{url('addshortlist')}}",
        type: 'POST',
        data: {maid_id: id},
        complete: function(){
            $('#myModal').modal('show');
        },
        success: function(counter){
            $('.modal-body').html('Profile added to shortlist successfully.');  
            $("#addcart a").text("My Shortlisted ("+counter+") ");
        },
        error: function(){
            alert("error");
        }  
    });  

}
</script>
<style>
.error
{
	background-color:#f5f5f5 !important;
}
</style>
@stop
@section('main')
  <div class='std-margin'>
    <div class="col-lg-9 col-md-9 bg-white">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            {{Session::get('success')}}
            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <input type="hidden" value="{{Session::get('success')}}" id="deleteMsg">
</div>
  <p class="maid-heading">Bio-data Of Foreign Domestic Worker (FDW)</p>
  
  <div class="row clearfix">
    <div class="col-lg-12 clearfix">
		<div class="pull-left profile_agency">{{$user_data[0]->company_name}}</div>
  <div class="pull-right">
    <button class="btn btn-info" onclick='return addshortlist({{$user_data[0]->id}});' type="button"><span aria-hidden="true" class="fa fa-heart"></span> ADD TO SHORTLIST</button>
    <a class="btn btn-warning" href="#agency_form"><span aria-hidden="true" class="fa fa-envelope"></span> CONTACT AGENT</a>
  </div>
    </div>
	 <div class="col-lg-12 cust-heading"><p class="maid-heading1">Maid’s Profile</p></div>
    <div class="col-xs-12 col-sm-2 col-md-3 imagezoom">@if($user_data[0]->profile_image != '')
      <img class="thumbnail img-profile img img-test" src="{{ assetnew('uploads/maid_image/'.$user_data[0]->profile_image) }}" style="border:1px solid #000; width:150px; height:150px;cursor:pointer;" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user_data[0]->image) }}"/>
  @else
      <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}" style="border:1px solid #000; width:150px; height:150px;">
  @endif</div>
    <div class=" col-xs-12 col-sm-10 col-md-9">
      <table class="maid-table">
        <tr>
          <td class="maid-info">Name :</td>
          <td class="themes-blue">@if($user_data[0]->name){{ucfirst($user_data[0]->name)}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Ref Code :</td>
          <td class="themes-blue">@if($user_data[0]->maid_reference_code){{ucfirst($user_data[0]->maid_reference_code)}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Type : </td>
          <td class="themes-blue">@if($user_data[0]->type){{ucfirst($user_data[0]->type)}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Nationality : </td>
          <td class="themes-blue">@if($user_data[0]->nationality_name){{ucfirst($user_data[0]->nationality_name)}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Date of Birth : </td>
          <td class="themes-blue"> @if( $user_data[0]->date_of_birth =='0000-00-00')
                {{ 'NA' }}
            @else
                {{  date("d M Y", strtotime($user_data[0]->date_of_birth)) }}
            @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Place of Birth : </td>
          <td class="themes-blue">@if($user_data[0]->place_of_birth){{ucfirst($user_data[0]->place_of_birth)}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Height : </td>
          <td class="themes-blue">@if($user_data[0]->height){{$user_data[0]->height}}cm @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Weight : </td>
          <td class="themes-blue">@if($user_data[0]->weight){{$user_data[0]->weight}}kg @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Religion : </td>
          <td class="themes-blue">@if($user_data[0]->religion){{$user_data[0]->religion}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Marital Status : </td>
          <td class="themes-blue">@if($user_data[0]-> marital_status){{ $user_data[0]-> marital_status}} @else {{'-'}} @endif</td>
        </tr>
 <tr>
          <td class="maid-info">No. of Siblings : </td>
          <td class="themes-blue">@if($user_data[0]->no_of_siblings ){{ $user_data[0]-> no_of_siblings}} @else {{'-'}} @endif </td>
        </tr>
        <tr>
          <td class="maid-info">No. of Children : </td>
          <td class="themes-blue">@if($user_data[0]-> no_of_children){{ $user_data[0]-> no_of_children}} @else {{'-'}} @endif </td>
        </tr>
        <tr>
          <td class="maid-info">Education : </td>
          <td class="themes-blue">@if($user_data[0]-> education_level){{ $user_data[0]-> education_level}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Availability : </td>
          <td class="themes-blue">@if($user_data[0]->availability){{ucfirst($user_data[0]->availability)}} @else {{'-'}} @endif</td>
        </tr>
        <!--<tr>
          <td class="maid-info">Expected Salary : </td>
          <td class="themes-blue">@if($user_data[0]->expected_salary){{$user_data[0]->expected_salary}} S$ @else {{'-'}} @endif</td>
        </tr>-->
        <tr>
          <td class="maid-info">Off days : </td>
          <td class="themes-blue">@if($user_data[0]->rest_days_preference){{$user_data[0]->rest_days_preference}} @else {{'-'}} @endif</td>
        </tr>
        <tr>
          <td class="maid-info">Language : </td>
          <td class="themes-blue">@foreach ($maid_skills as $skillid => $skillvalue) @if($skillvalue->otherskill == 'N'&&$skillvalue->work_area_id=='6'){{ucfirst($skillvalue->feedback_comment)}} @endif @endforeach</td>
        </tr>
      </table>
    </div>
    <?php 
          $skill = 'no'; 
          $other = 'no';
    ?>
    @foreach ($maid_skills as $skillid => $skillvalue)
    @if($skillvalue->otherskill == 'N'&&$skillvalue->work_area_id!='6')
     <?php  $skill = 'yes';  ?>
    @endif
    @if($skillvalue->otherskill == 'Y')
    <?php  $other = 'yes';  ?>
    @endif
    @endforeach
    @if($skill == 'yes')
    <div class="col-md-12">
      <p class="maid-heading1">Skills</P>
    </div>
    <div class="col-md-12">
      <table class="table table-striped table-skill" >
        <thead>
          <tr >
            <th class="text-center green-heading">Area of work</th>
            <th class="text-center green-heading">Willingness</th>
            <th class="text-center green-heading">Experience</th>
            <th class="text-center green-heading">Evaluation</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($maid_skills as $skillid => $skillvalue)
        @if($skillvalue->otherskill == 'N'&&$skillvalue->work_area_id!='6')
          <tr>
            <td>{!! $skillvalue->title !!}</td>
            <td class="text-center">@if($skillvalue->willingness == 'Yes')<span aria-hidden="true" class="fa fa-check text-theme-green"></span>@else<span aria-hidden="true" class="fa fa-remove text-theme"></span>@endif</td>
            <td class="text-center">@if($skillvalue->experience == 'Yes')<span aria-hidden="true" class="fa fa-check text-theme-green"></span>@else<span aria-hidden="true" class="fa fa-remove text-theme"></span>@endif</td>
            <td class="text-center">
            <?php for($i = 0; $i<$skillvalue->rating; $i++){ ?>
              <span aria-hidden="true" class="fa fa-star text-theme-yellow"></span>
            <?php } ?>
            <?php for($i = 5; $skillvalue->rating<$i; $i--){ ?>
              <span aria-hidden="true" class="fa fa-star text-theme-gray"></span>
            <?php } ?>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
    <div class="col-md-12 other-info">
    @if($other == 'yes')
      <p class="maid-heading1">Other Information</p>
     @endif
      <ul class="list-unstyled">
      @foreach ($maid_skills as $skillid => $skillvalue)
        @if($skillvalue->otherskill == 'Y')
          <li>@if($skillvalue->willingness == 'Yes') {!! $skillvalue->title !!} <span aria-hidden="true" class="fa fa-check text-theme-green"></span>@else  {!! $skillvalue->title !!}<span aria-hidden="true" class="fa fa-remove text-theme"></span>@endif</li>
        @endif
      @endforeach
      </ul>
      @if($user_data[0]->overall_remarks)
      <p class="maid-heading2">Additional Remarks</p>
        <div><p class="ad-info">{{$user_data[0]->overall_remarks}}</p></div>
      @endif  
    </div>
  </div>
 <!-- @if($user_data[0]->intro)
  <div class="col-md-12">
      <p class="maid-heading1">Maid Introduction</P>
    </div>
    <div class="col-md-12" style="margin-bottom:10px;font-size: 13.5px;">
	<div style="word-wrap: break-word;">
      @if($user_data[0]->intro){!!$user_data[0]->intro!!} @else {{'Maid introduction is not available.'}} @endif</div>
    </div>
    @endif-->
<div  class="col-md-12">
          <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%">

                  
                        <div class="well well-sm" id='agency_form'>
                          <form class="form-horizontal" method="POST" action="{{ route('welcome.storerequestmaid') }}" accept-charset="UTF-8">
                          <fieldset>
                            <input id="" value='{{$user_data[0]->email}}' name="agency_mail" type="hidden" placeholder="Your email" class="form-control">
                            <input id="" value='yes' name="maiddetail" type="hidden" placeholder="Your email" class="form-control">
                            <input id="" value='{{$user_data[0]->id}}' name="maid_id" type="hidden" placeholder="Your email" class="form-control">
                            <div class="small-10 columns">
                                <p><span class="mandatory" style='color:red'>*</span> Fields are required</p>
                            </div>
                            <div class="form-group" style='color: #008cba;font-weight: bold;margin-left: 10%;'>
                              1. Contact Information
                            </div>

                            <!-- Name input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="name">Name <span class="mandatory" style='color:red'>*</span></label>
                              <div class="col-md-5">
                                <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                                {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                    
                            <!-- Email input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="email">E-mail <span class="mandatory" style='color:red'>*</span></label>
                              <div class="col-md-5">
                                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                                {!! ($errors->has('email') ? $errors->first('email', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                            
                            <!-- Telephone input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="email">Telephone</label>
                              <div class="col-md-5">
                                <input id="telephone" name="telephone" type="text" placeholder="Your telephone" class="form-control">
                                {!! ($errors->has('telephone') ? $errors->first('telephone', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>

                            <div class="form-group" style='color: #008cba;font-weight: bold;margin-left: 10%;'>
                              2. Please provide as much detail as possible on your special requests or questions/issues <span class="mandatory" style='color:red'>*</span>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">
                              <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" id="message" name="request_detail" placeholder="" rows="5"></textarea>
                                {!! ($errors->has('request_detail') ? $errors->first('request_detail', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                    
                            <!-- Form actions -->
                            <div class="form-group">
                              <div class="col-md-3 col-md-offset-8">
                                <button type="submit" class="btn btn-warning btn-block">Submit</button>
                              </div>
                            </div>
                          </fieldset>
                          </form>
                        </div>
               
            
            </div>
            <div class="clearfix"></div>

        
      </div>
</div>
    <div class = "in_rightbar col-lg-3 col-md-3" style="">
  <div id="in_rbimg"></div>

        </div>
        </div>
		 <script type="text/javascript">
    $(".imagezoom").imageBox();
  </script>
    <!--/row-->
    
<!--/.container--><!-- script references --> 

@stop
