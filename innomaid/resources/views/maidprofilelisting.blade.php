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
          data: "limit=" + lim + "&offset=" + off + "&natinaolity=" + 'yes',
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
              $("#loader_message").html('<img src="{{ asset("front/images/input-spinner.gif") }}" alt="" width="24" height="24"> Loading...please wait').show();
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
  //       if ($(window).scrollTop() + $(window).height() > $(".header-banner1").height()+$(".list-group").height() && !busy) { 
  ////          busy = true;
   ///        offset = limit + offset;
 
   ///        displayRecords(limit, offset);
 
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
        <div style="margin-top:48px">
        </div>
     <!-- </div> -->
      <div  class="list-group">
<?php if(isset($_REQUEST['per_page'])) {
   $perpage = $_REQUEST['per_page'];
  }else{
    $perpage ='15'; 
  }
  ?>

       <!-- this will hold all the data -->
<div id="results" class = "details_maid col-lg-9 col-md-9 imagezoom" style="margin-top:0px !important; padding-top:10px;">
<div class="box-ribon clearfix"><div style="color:#ee0734;font-size: 1.2em;font-weight: bold;padding: 11px;padding-left:0px !important;" class='pull-left'> List of  {{\Request::segment(2)}}  Maids
</div><div class='pull-right pull-none'><div><div class="pull-left list-height"><form class='perpage' action='<?php echo url('search/'.\Request::segment(2)); ?>'><label>Items per page:</label>{!! Form::select('per_page', array('15'=>'15','30'=>'30','60'=>'60','120'=>'120'),$perpage,['onchange'=> 'submit()']) !!}</form></div><div class="pull-right xs-height">{!!$data->appends(['per_page' => $perpage])->render()!!} </div></div></div></div>
	 <div class="row custom-box" style="margin-bottom:0px !important;">
       @if($count > 0)
       @foreach($data as $key=>$user)

        <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-md-6 col-lg-offset-0" style="padding-top:15px;">
        
          <div class="thumbnail" style="margin-bottom:10px;">
            <div class="caption">
              @if($user->profile_image != '')
                <img class="thumbnail img-profile img img-test" style="cursor:pointer" data-toggle="tooltip" title="Click to see full profile image" data-url="{{ assetnew('uploads/maid_image/'.$user->image) }}" src="{{ assetnew('uploads/maid_image/'.$user->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
              <a id='decorationnone' href="{{ url('/Maid-Details/'.$user->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($user->name)}}">@if($user->name){{ ucfirst($user->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text"> From : <span class="text-danger">@if($user->country_name){{$user->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($user->age) {{$user->age}}({{$user->marital_status}}) @else - @endif</span><br>
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
          </div>
        </div>
        @endforeach
        @else
          <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%">
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