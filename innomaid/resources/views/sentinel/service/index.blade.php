@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
    function confirmdelete()
    {
      var x;
        var r=confirm("Are you sure you want to delete this ?");
    if (r==true)
      {
     return true;
      }
    else
      {
      return false;
      }
    }
function model_call(id){
    var id = id;
    $.ajax({
        url:  'package-detail',
        type: 'POST',
        data: {id: id},
        complete: function(){
            $('#myModal').modal('show');
        },
        success: function(html){
            $('.modal-body').html(html);  
        },
        error: function(){
            alert("error");
        }  
    });  

}
</script>
<div class="row">
                  <div class="col-lg-12">				               
			   <header class="panel-heading">
            Manage @if($_REQUEST['mode'] == 'newtransfer') {{'New/Transfer'}} @else {{'Replacement'}} @endif Service
  
                <!--<a href="{{ url('/service/create') }}" style="float:right;">Add new Service
                </a>-->
                 @if(!(Auth::user()->hasRole(['admin'])))
            <a href="{{ url('/service/create?mode='.$_REQUEST['mode']) }}" title="Add new Service" style="float:right;">Create</a>
               @endif
                 </header>
						

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center">Title</th>
                    <th style="text-align:center">Fee</th>
                    <th style="text-align:center">Fee Type</th>
                    @if(Auth::user()->hasRole(['admin']))
                    <th style="text-align:center">Created By</th>
                    @endif
                    <th class="numeric" style="text-align:center">Updated Date</th>
                    <th colspan="4" style="text-align:center" class="numeric">Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($serviceList->count() === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
                @else

                 <?php 
                    if($_REQUEST){
                      if (isset($_REQUEST['page'])) {
                          if($_REQUEST['page'] > 1) {
                              $perpage = 10;
                              $i = ($perpage*$_REQUEST['page'])-$perpage;
                          }
                          else
                              $i=0;
                      }else{
                        $i=0;
                      }    
                    }
                    else 
                        $i = 0;
                    
                 ?>

                @foreach ($serviceList as $service)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td style="text-align:center" title='{{ $service->title }}'>{{ ucfirst(mb_strimwidth($service->title, 0, 50, "...")) }}</td>
                    <td style="text-align:center">@if($service->price!="0"){{$service->price }}@else<a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$service->id}}" onclick="return model_call({{$service->id}});"> {{'According to Package'}}</a>@endif</td>
                    <td style="text-align:center">@if($service->type == 'S') Service Fee @else Placement Fee @endif</td>
                    @if(Auth::user()->hasRole(['admin']))
                    <td style="text-align:center">{{ ucfirst($service->username) }}</td>
                    @endif
                    @if( $service->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($service->updated_at)) }}</td>
                        @endif
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/service/'.$service->id.'/edit?mode='.$_REQUEST['mode'])}}" title="Edit"></a></td>
<td style="text-align:center"><a class="fa fa-times" onclick="return confirmdelete()" href="{{ url('/service/'.$service->id.'/delete?mode='.$_REQUEST['mode'])}}" title="Delete"></a></td>
                   
                    
                </tr>
                @endforeach
                @endif
              </tbody>
		</table>
		</section>
    </div>
  </div> 
        <center>
        {!!$serviceList->appends(['mode' => $_REQUEST['mode']])->render()!!}
     </center>
</div>
   <!--/row-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white !important">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Package Detail</h4>
            </div>
            <div class="modal-body" style="">

            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop
