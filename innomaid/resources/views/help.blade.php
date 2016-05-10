@extends('default')
@section('title')
Innomaid
@stop
@section('head')
@stop
@section('main')
<script type="text/javascript">
var $ = jQuery.noConflict();
</script>
<div  class="row list-group  std-margin">
	<div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%">
          <div class="thumbnail">
            <div class="caption">
                @if($count > 0)
	                <div style="width:100%">
                    <h5 style="text-align:left"> {{$help[0]->title}}</h5>
                  </div>
					  <div class="panel-group" id="accordion1">
	                 {!! $help[0]->content !!}
					 </div>
                @else 
                  <div style="width:100%">
                    <h5 style="text-align:left"> F&Q</h5>
                  </div>
	                 No F&Q available.
	            @endif
            </div>
            <div class="clearfix"></div>

          </div>  
    </div>
</div>
@stop 
