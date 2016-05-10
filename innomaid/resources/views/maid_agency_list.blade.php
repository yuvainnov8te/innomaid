@extends('default')

@section('title')
Innomaid
@stop

@section('head')
@stop
@section('main')
<script>
 $(function() {
    $( "#tabs" ).tabs();
  });
function model_call(id){

    var id = id;
    $.ajax({
        url:  'maid-agency-detail',
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
    <div class="row list-group std-margin">
        <div style="align:center;width:100%" class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0">
            <div class="thumbnail">
                <div class="caption">
                    <div style="width:100%; margin-left:15px">
                        <h5 style="text-align:left"> Agency List</h5>  
                    </div>
                    <div id="tabs">
                    <ul >
                    <li><a href="#tabs-1"><span style="font-size:0.8em">All</span></a></li>
                    <li><a href="#tabs-2"><span style="font-size:0.8em">Central</span></a></li>
                    <li><a href="#tabs-3"><span style="font-size:0.8em">East</span></a></li>  
                    <li><a href="#tabs-4"><span style="font-size:0.8em">North</span></a></li>
                    <li><a href="#tabs-5"><span style="font-size:0.8em">North-East</span></a></li>
                    <li><a href="#tabs-6"><span style="font-size:0.8em">West</span></a></li>
                    </ul>
                    <div id="tabs-1">
                    <div style="word-wrap: break-word !important;  margin-left:15px">
                        <table cellspacing="2" cellpadding="2" style="width:100%">
                            <tbody>
                              <tr>
                                <td>
                                <ul class="block-list">
                                   @foreach($maidagencylist as $agency)
                                      <li><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$agency->id}}" onclick="return model_call({{$agency->id}});">{{ ucfirst($agency->company_name) }}</a></li>
                                  @endforeach
                                </ul>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id="tabs-2">
                    <div style="word-wrap: break-word !important;  margin-left:15px">
                        <table cellspacing="2" cellpadding="2" style="width:100%">
                            <tbody>
                              <tr>
                                <td><?php $count1=0; ?>
                                <ul class="block-list">
                                   @foreach($maidagencylist as $agency)
                                        @if($agency->area=="Central")
                                      <li><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$agency->id}}" onclick="return model_call({{$agency->id}});">{{ ucfirst($agency->company_name) }}</a></li>
                                    <?php $count1++; ?>
                                    @endif
                                  @endforeach
                                  @if($count1== 0)
                                  No Agencies are available in this area.
                                  @endif
                                  </ul>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id="tabs-3">
                    <div style="word-wrap: break-word;  margin-left:15px">
                        <table cellspacing="2" cellpadding="2" style="width:100%">
                            <tbody>
                              <tr>
                                <td>
                                <ul class="block-list">
                                <?php $count2=0; ?>
                                   @foreach($maidagencylist as $agency)
                                        @if($agency->area=="East")
                                      <li><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$agency->id}}" onclick="return model_call({{$agency->id}});">{{ ucfirst($agency->company_name) }}</a></li>
                                        <?php $count2++; ?>
                                    @endif
                                    @endforeach
                                     @if($count2== 0)
                                  No Agencies are available in this area. 
                                  @endif
                                </ul>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id="tabs-4">
                    <div style="word-wrap: break-word;  margin-left:15px">
                        <table cellspacing="2" cellpadding="2" style="width:100%">
                            <tbody>
                              <tr>
                                <td>
                                <ul class="block-list">
                                <?php $count3=0; ?>
                                   @foreach($maidagencylist as $agency)
                                        @if($agency->area=="North")
                                      <li><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$agency->id}}" onclick="return model_call({{$agency->id}});">{{ ucfirst($agency->company_name) }}</a></li>
                                    <?php $count3++; ?>
                                    @endif
                                  @endforeach
                                   @if($count3== 0)
                                  No Agencies are available in this area. 
                                  @endif
                                </ul>
                                </t
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id="tabs-5">
                    <div style="word-wrap: break-word;  margin-left:15px">
                        <table cellspacing="2" cellpadding="2" style="width:100%">
                            <tbody>
                              <tr>
                                <td>
                                <ul class="block-list">
                                <?php $count4=0; ?>
                                   @foreach($maidagencylist as $agency)
                                        @if($agency->area=="North-East")
                                      <li><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$agency->id}}" onclick="return model_call({{$agency->id}});">{{ ucfirst($agency->company_name) }}</a></li>
                                        <?php $count4++; ?>
                                    @endif
                                  @endforeach
                                  @if($count4== 0)
                                 No Agencies are available in this area.
                                  @endif
                                </ul>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id="tabs-6">
                    <div style="word-wrap: break-word;  margin-left:15px">
                        <table cellspacing="2" cellpadding="2" style="width:100%">
                            <tbody>
                              <tr>
                                <td>
                                <ul class="block-list">
                                <?php $count5=0; ?>
                                   @foreach($maidagencylist as $agency)
                                        @if($agency->area=="West")
                                      <li><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$agency->id}}" onclick="return model_call({{$agency->id}});">{{ ucfirst($agency->company_name) }}</a></li>
                                        <?php $count5++; ?>
                                    @endif
                                  @endforeach
                                  @if($count5== 0)
                                  No Agencies are available in this area.
                                  @endif
                                </ul>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>  
                    
                </div>
                <div class="clearfix"></div>
            </div>  
        </div>
    </div>
</div>
    <!--/row-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Maid Agency Details</h4>
            </div>
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
<!-- /.modal -->
@stop

