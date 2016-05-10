@extends('default')

@section('title')
Innomaid
@stop

@section('head')
@stop
@section('main')
<script type="text/javascript">
  $(function () {
    if($('#deleteMsg').val() != ''){
      $('#myModal').modal('show');
    }
  });
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
              {{$description}}
            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" value="{{$description}}" id="deleteMsg">
              <!-- this will hold all the data -->
<div id="results" class = "std-margin details_maid col-lg-12 col-md-12 imagezoom" style="padding-top:10px;">
<div class="box-ribon clearfix"><div style="color:#ee0734;font-size: 1.2em;font-weight: bold;padding: 11px;padding-left:0px !important;" class='pull-left'> Shortlisted Profiles
</div><div class='pull-right pull-none'><p class="group inner list-group-item-text text-primary agency-name" style="font-size: 1em;color: #ec0633;text-align: right; padding-top:11px;">
                  <a  href="{{url('clearshortlist')}}" style="text-transform: none;">Clear List</a>
                 </p></div></div>
   <div class="row custom-box" style="margin-bottom:0px !important;">
       @if(count($cart))
       @foreach($cart as $fdw)

        <div class="item  col-xs-12 col-xs-offset-0 col-lg-3 col-md-6 col-lg-offset-0" style="padding-top:15px;">
        
          <div class="thumbnail" style="margin-bottom:10px;">
            <div class="caption">
              @if($fdw->options->profile_image != '')
                <img class="thumbnail img-profile" src="{{ assetnew('uploads/maid_image/'.$fdw->options->profile_image) }}">
              @else
                <img class="thumbnail img-profile" src="{{ asset('front/images/img-not-found.jpg') }}">
              @endif
              <a id='decorationnone' href="{{ url('/Maid-Details/'.$fdw->id.'/show') }}">
                <h4 class="group inner list-group-item-heading elipses" data-toggle="tooltip" title="{{ ucfirst($fdw->name)}}">@if($fdw->name){{ ucfirst($fdw->name)}} @else - @endif</h4>
                <p class="group inner list-group-item-text"> From : <span class="text-danger">@if($fdw->options->country_name){{$fdw->options->country_name}}@else - @endif</span><br>
                  Age :<span class="text-info"> @if($fdw->options->age) {{$fdw->options->age}}({{$fdw->options->marital_status}}) @else - @endif</span><br>
                  Type :<span class="text-info">@if($fdw->options->type) {{ $fdw->options->type}} @else - @endif</span><br>
                  <!-- Salary :<span class="text-danger">$500</span><br> -->
                  Days Off :<span class="text-info">@if($fdw->options->rest_days_preference){{ $fdw->options->rest_days_preference }} @else - @endif</span><br>
                </p>
                <p class="group inner list-group-item-text text-primary agency-name">
                <span class='ellip'>
                @if($fdw->options->company_name)
                  {{ucfirst($fdw->options->company_name)}}
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
                  Sorry ! Profile not found for the Searched criteria.
                 </p>
            </div>
            <div class="clearfix"></div>

          </div>  
          </div>
        @endif 
        </div>
  
</div>
  @stop 