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
        url:  'payment-detail',
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
				<div>               
			   <header class="panel-heading">
            Invoice List<?php ?>
							
                          </header>
						 
        </div>
       <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                                      <th>S.No.</th>
                                     <th>Invoice To</th>
                                      <th class="numeric">Invoice Number</th>
                                      <th colspan="4" style="text-align:center;" class="numeric">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>

								  @if (count($Invoicelist) === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
                @else

                 <?php 
                    if($_REQUEST){
                        if(isset($_REQUEST['page'])> 1) {
                            $perpage = 10;
                            $i = ($perpage*$_REQUEST['page'])-$perpage;
                        }
                        else
                            $i=0;
                    }
                    else 
                        $i = 0;
                    
                 ?>

                @foreach ($Invoicelist as $employer)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric">{{ $i }}</td>
                    <td title='{{ $employer->name }}'>{{ $employer->name }}</td>

                    <td title='{{ $employer->invoicenumber }}'>@if($employer->invoicenumber) {{ $employer->invoicenumber }} @else {{'N/A'}} @endif</td>

                    <td style="text-align:center"><a style="color: #337ab7;" href="#"  data-toggle="modal" data-target="#myModal" id="{{$employer->invoice_id}}" onclick="return model_call({{$employer->invoice_id}});">  Record Payment</a></td>

                    <td style="text-align:center"><a  class="fa fa-edit" href="{{ url('/application/'.$employer->id.'/edit?tab=tab1')}}" title="Edit"></a></td>
                  
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
				</section>
    </div>
  </div> 
        <center>
     
     </center>

</div>
<div class="col-md-2"></div>
  <!--/row-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white !important">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Payment Detail</h4>
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
