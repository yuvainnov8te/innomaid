@extends('default')

@section('title')
Innomaid
@stop

@section('head')
<script type="text/javascript">
function addshortlist(id,token){

    var id = id;
    $.ajax({
        url:  'addshortlist',
        type: 'POST',
        data: {maid_id: id},
        complete: function(){
            $('#myModal').modal('show');
        },
        success: function(html){
            $('.modal-body').html('Profile added to shotlist sucessfully.');  
        },
        error: function(){
            alert("error");
        }  
    });  

}
</script>
<script type="text/javascript">

var busy = false;
var limit = 10
var offset = 0;

function displayRecords(lim, off) {
        $.ajax({
          type: "GET",
          async: false,
          url: "welcome/maidlisting",
          data: "limit=" + lim + "&offset=" + off + "&Ajaxcall=" + 'yes',
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(result) {
            //console.log(result);
            var jsondata = eval('('+result+')');      
            for(var i=0; i<jsondata.length; i++){
               
             var row ='<div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0"><a href="{{ url("/Maid-Details//show") }}"><div class="thumbnail"><div class="caption"><img class="thumbnail img-profile" src="{{ asset("front/images/img-not-found.jpg") }}"><h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title=""></h4><p class="group inner list-group-item-text"> From : <span class="text-danger"></span><br>Age :<span class="text-info"> </span><br>Type :<span class="text-info"></span><br><!-- Salary :<span class="text-danger">$500</span><br> -->Days Off :<span class="text-info"></span><br></p><p class="group inner list-group-item-text text-primary agency-name"> </p></div><div class="clearfix"></div><ul class="nav nav-pills  default-info"><li role="presentation"><a href="#">Code : </a></li><li role="presentation"><a style="cursor:pointer" onclick="return addshortlist();"><span aria-hidden="true" class="fa fa-heart"></span>  Add To Shortlist</a></li></ul></div></a></div>';
            
            $("#results").append(row);
          }
            
            $('#loader_image').hide();
            if (result == "[]") {
              $("#loader_message").html('<div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%"><div class="thumbnail"><div class="caption"><p class="group inner list-group-item-text text-primary agency-name" style="text-align: center; padding-top: 10px; font-size: 1.2em;">No more records available.</p></div><div class="clearfix"></div></div></div>').show()
              busy = true;
            } else {
              $("#loader_message").html().show();
            window.busy = false;
            }
            

          }
        });
}

//$(document).ready(function() {
 // if (busy == false) {
 //   busy = true;
    // start to load the first set of data
  //  displayRecords(limit, offset);
 // }
 // $(window).scroll(function() {
   // alert($(window).scrollTop() + $(window).height());
   // alert($(window).scrollTop() + $(window).height()+$("#results").height());
          // make sure u give the container id of the data to be loaded in.
  //        if ($(window).scrollTop() + $(window).height() > $(".header-banner1").height()+$(".list-group").height() && !busy) { 
   //         busy = true;
   //         offset = limit + offset;
 
  //          displayRecords(limit, offset);
 //
   //       }
//});
//});

</script>
@stop
@section('main')
@if ($message = Session::get('clearlist'))
<div class="row">
  <div data-alert class="alert-box info radius">
    <strong>FYI:</strong> {!! $message !!}
    <a href="#" class="close">&times;</a>
  </div>
</div>
{{ Session::forget('clearlist') }}
@endif
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- added on  : 06-11-2015 -->
      <div class='banner-fix'>
        <div class="header-banner1">
        <div class="image-maid">       
        </div>
          <div class="pull-right form-box">
            <form class="form-horizontal" role="form" method='post' action="search">
              <h2> <span class="fa fa-search text-default" aria-hidden="true" style="margin-right:10px;"></span>FIND MY MAID</h2>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="expiry-month">Name</label>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-10 select_style">
                      <input style='border:none' type='text' name='maid_name' value='' placeholder="Enter maid name">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="expiry-month">Primary Duty </label>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-10 select_style">
                      {!! Form::select('skill_id', 
                            (['' => ''] + $workarea_data), 
                                 Request::input('skill_id'), 
                                ['class' =>"form-control"]) !!}
                                <span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="expiry-month">Nationality </label>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-10 select_style">
                       {!! Form::select('country_id', 
                            (['' => ''] + $countries_data), 
                                 Request::input('country_id'), 
                                ['class' =>"form-control"]) !!}
                                <span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="expiry-month">Type </label>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-10 select_style">
                      {!! Form::select('type', array('' => '', 
                          'New' => 'New', 'Transfer' => 'Transfer', 'Replacement'=>'Replacement','Ex-Singapore'=>'Ex-Singapore'), Request::input('type'),
                          array('class' => 'form-control')) !!}
                          <span></span>
                    </div>
                  </div>
                </div>
              </div>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="expiry-month">Salary </label>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-10 select_style">
                        {!! Form::select('expected_salary', array('' => '', 
                           '400-450' => '400-450', '460-500'=>'460-500', '510-550'=>'510-550', '560-600'=>'560-600','600-'=>'Above 600'), Request::input('type'),
                          array('class' => 'form-control')) !!}
                      <span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="expiry-month">Age Range </label>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-xs-10 select_style">
                       {!! Form::select('age', array('' => '', 
                          '21-25' => '21-25', '26-30' => '26-30', '31-35'=>'31-35', '36-40'=>'36-40', '41-'=>'Above 41'), Request::input('type'),
                          array('class' => 'form-control')) !!}
                          <span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-7 col-sm-5"> 
                  <button type="submit" class="btn btn-primary">Search </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        </div>
     <!-- </div> -->
      <div  class="list-group fix-data">
      @if(\Request::input('submenuname'))
      <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%">
            <div class="caption">
              <div style="width:100%">
                        <h5 style="text-align:left"> List of {{\Request::input('submenuname')}} Maids</h5>
                </div>
            </div>
            <div class="clearfix"></div>
          </div>
          @endif
     
       <!-- this will hold all the data -->
<div id="results" class = "col-lg-9 col-md-9 default-margin imagezoom">
  @if($count > 0)
  <?php 
        $filipincount = 0; 
        $indocount = 0;
        $myanmarcount = 0;
        $indiacount = 0;
        $srilankacount = 0;
  ?>
  <div class="row custom-box filipinimagezoom">
        <div class="box-ribon clearfix"><span class='pull-left'>Philippines Maids</span>  <a style='cursor:pointer' class='pull-right' href="{{url('search/Philippines')}}">view more</a></div>
       @foreach($data as $key=>$user)
       @if($user->nationality == '11' && $filipincount<3)
        <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0">
   
          <div class="thumbnail">
            <div class="caption">
              @if($user->profile_image != '')
                <img class="thumbnail img-profile img img-test" style="cursor:pointer" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user->image) }}" src="{{ assetnew('uploads/maid_image/'.$user->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
               <a id='decorationnone' href="{{ url('/Maid-Details/'.$user->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($user->name)}}">@if($user->name){{ ucfirst($user->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text"> <span class="text-danger">@if($user->country_name){{$user->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($user->age) {{$user->age}} ({{$user->marital_status}}) @else - @endif</span><br>
                  Type :<span class="text-info">@if($user->type) {{ $user->type}} @else - @endif</span><br>
                  <!-- Salary :<span class="text-danger">$500</span><br> -->
                  Days Off :<span class="text-info">@if($user->rest_days_preference){{ $user->rest_days_preference }} @else - @endif</span><br>
                </p>
                <p class="group inner list-group-item-text text-primary agency-name">
                <span class='ellip'>
                @if($user->company_name)
                  {{ucfirst($user->company_name)}}
                   @else
                  <?php echo '-'; ?>
                @endif
                </span>
                 </p>
                  </a>
            </div>
            <div class="clearfix"></div>
          </div>
             
        </div>
        <?php 
          $filipincount++;
        ?>
        @endif
        @endforeach
		</div>
		<div class="row custom-box indoimagezoom">
        <div class="box-ribon clearfix"><span class='pull-left'>Indonesian Maids</span> <a style='cursor:pointer' class='pull-right' href="{{url('search/Indonesian')}}">view more</a></div>
      @foreach($data as $key=>$user)
       @if($user->nationality == '12' && $indocount<3)
        <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0">
        
          <div class="thumbnail">
            <div class="caption">
              @if($user->profile_image != '')
                <img class="thumbnail img-profile img img-test" style="cursor:pointer" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user->image) }}" src="{{ assetnew('uploads/maid_image/'.$user->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
              <a id='decorationnone' href="{{ url('/Maid-Details/'.$user->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($user->name)}}">@if($user->name){{ ucfirst($user->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text">  <span class="text-danger">@if($user->country_name){{$user->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($user->age) {{$user->age}} ({{$user->marital_status}}) @else - @endif</span><br>
                  Type :<span class="text-info">@if($user->type) {{ $user->type}} @else - @endif</span><br>
                  <!-- Salary :<span class="text-danger">$500</span><br> -->
                  Days Off :<span class="text-info">@if($user->rest_days_preference){{ $user->rest_days_preference }} @else - @endif</span><br>
                </p>
                <p class="group inner list-group-item-text text-primary agency-name">
                <span class='ellip'>
                @if($user->company_name)
                  {{ucfirst($user->company_name)}}
                  @else
                  <?php echo '-'; ?>
                @endif
                </span>
                 </p>
                 </a> 
            </div>
            <div class="clearfix"></div>
          </div>
             
        </div>
        <?php 
          $indocount++;
        ?>
        @endif
        @endforeach
		</div>
		<div class="row custom-box myanimagezoom">
        <div class="box-ribon clearfix"><span class='pull-left'>Myanmarese Maids</span> <a style='cursor:pointer' class='pull-right' href="{{url('search/Myanmarese')}}">view more</a></div>
      @foreach($data as $key=>$user)
       @if($user->nationality == '18' && $myanmarcount<3)
        <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0">
       
          <div class="thumbnail">
            <div class="caption">
              @if($user->profile_image != '')
                <img class="thumbnail img-profile img img-test" style="cursor:pointer" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user->image) }}" src="{{ assetnew('uploads/maid_image/'.$user->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
               <a id='decorationnone' href="{{ url('/Maid-Details/'.$user->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($user->name)}}">@if($user->name){{ ucfirst($user->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text">  <span class="text-danger">@if($user->country_name){{$user->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($user->age) {{$user->age}} ({{$user->marital_status}}) @else - @endif</span><br>
                  Type :<span class="text-info">@if($user->type) {{ $user->type}} @else - @endif</span><br>
                  <!-- Salary :<span class="text-danger">$500</span><br> -->
                  Days Off :<span class="text-info">@if($user->rest_days_preference){{ $user->rest_days_preference }} @else - @endif</span><br>
                </p>
                <p class="group inner list-group-item-text text-primary agency-name">
                <span class='ellip'>
                @if($user->company_name)
                  {{ucfirst($user->company_name)}}
                  @else
                  <?php echo '-'; ?>
                @endif
                </span>
                 </p>
                  </a> 
            </div>
            <div class="clearfix"></div>
          </div>
            
        </div>
        <?php 
          $myanmarcount++;
        ?>
        @endif
        @endforeach
		</div>
		<div class="row custom-box indiaimagezoom">
        <div class="box-ribon clearfix"><span class='pull-left'>indian Maids</span> <a style='cursor:pointer' class='pull-right' href="{{url('search/Indian')}}">view more</a></div>
      @foreach($data as $key=>$user) 
       @if($user->nationality == '6' && $indiacount<3) <?php // print_r($user);?>
        <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0">
        
          <div class="thumbnail">
            <div class="caption">
              @if($user->profile_image != '')
                <img class="thumbnail img-profile img img-test" style="cursor:pointer" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user->image) }}" src="{{ assetnew('uploads/maid_image/'.$user->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
              <a id='decorationnone' href="{{ url('/Maid-Details/'.$user->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($user->name)}}">@if($user->name){{ ucfirst($user->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text">  <span class="text-danger">@if($user->country_name){{$user->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($user->age) {{$user->age}} ({{$user->marital_status}}) @else - @endif</span><br>
                  Type :<span class="text-info">@if($user->type) {{ $user->type}} @else - @endif</span><br>
                  <!-- Salary :<span class="text-danger">$500</span><br> -->
                  Days Off :<span class="text-info">@if($user->rest_days_preference){{ $user->rest_days_preference }} @else - @endif</span><br>
                </p>
                <p class="group inner list-group-item-text text-primary agency-name">
                <span class='ellip'>
                @if($user->company_name)
                  {{ucfirst($user->company_name)}}
                  @else
                  <?php echo '-'; ?>
                @endif
                </span>
                 </p>
                 </a>
            </div>
            <div class="clearfix"></div>
          </div>
              
        </div>
        <?php 
          $indiacount++;
        ?>
        @endif
        @endforeach
		</div>
		<div class="row custom-box sriimagezoom">
        <div class="box-ribon clearfix"><span class='pull-left'>Sri lankan Maids</span><a style='cursor:pointer' class='pull-right' href="{{url('search/Sri-Lankan')}}">view more</a></div>
      @foreach($data as $key=>$user)
       @if($user->nationality == '14' && $srilankacount<3)
        <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0">
        
          <div class="thumbnail">
            <div class="caption">
              @if($user->profile_image != '')
                <img class="thumbnail img-profile img img-test" style="cursor:pointer" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user->image) }}" src="{{ assetnew('uploads/maid_image/'.$user->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
              <a id='decorationnone' href="{{ url('/Maid-Details/'.$user->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($user->name)}}">@if($user->name){{ ucfirst($user->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text"> <span class="text-danger">@if($user->country_name){{$user->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($user->age) {{$user->age}} ({{$user->marital_status}}) @else - @endif</span><br>
                  Type :<span class="text-info">@if($user->type) {{ $user->type}} @else - @endif</span><br>
                  <!-- Salary :<span class="text-danger">$500</span><br> -->
                  Days Off :<span class="text-info">@if($user->rest_days_preference){{ $user->rest_days_preference }} @else - @endif</span><br>
                </p>
                <p class="group inner list-group-item-text text-primary agency-name">
                <span class='ellip'>
                @if($user->company_name)
                  {{ucfirst($user->company_name)}}
                  @else
                  <?php echo '-'; ?>
                @endif
                </span>
                 </p>
                  </a> 
            </div>
            <div class="clearfix"></div>
          </div>
            
        </div>
        <?php 
          $srilankacount++;
        ?>
        @endif
        @endforeach
		</div>
        @else
          <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0" style="align:center;width:100%">
          <div class="thumbnail">
            <div class="caption">
                <p class="group inner list-group-item-text text-primary agency-name" style="text-align: center; padding-top: 10px; font-size: 1.2em;">
                  Sorry !! No profile match found with selected criteria.
                 </p>
            </div>
            <div class="clearfix"></div>

          </div>  
          </div>
        @endif
</div>
<div class = "in_rightbar col-lg-3 col-md-3" >
	<div id="in_rbimg"></div>
</div>
<!-- loading image -->
<div id="loader_image"></div>
<!-- for message if data is avaiable or not -->
<div id="loader_message"></div>
        
      </div>
    </div>
     <script type="text/javascript">
    $(".imagezoom").imageBox();
  </script>
  @stop 
    <!--/row-->
