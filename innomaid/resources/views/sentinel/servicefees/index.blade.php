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
</script>
<div class="row">
                  <div class="col-lg-12">
				<div>               
			   <header class="panel-heading">
            Manage Service Cost
               <!-- <a href="{{ url('/servicefees/create') }}" style="float:right;">Add new Services & Fees Schedule
                </a>-->
				@if(!(Auth::user()->hasRole(['admin'])))
        <a href="{{ url('/servicefees/create') }}" title="Add new Services" style="float:right;">Create</a>
                        @endif
                          </header>
						  </div>
         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric">S.No.</th>
                    <th>Maid Name</th>
                    <th class="numeric">Total Cost($)</th>
                    @if(Auth::user()->hasRole(['admin']))
                    <th class="numeric">Created By</th>
                    @endif
                    <th>Updated Date</th>
                    <th colspan="4" style="text-align:center;" class="numeric">Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($servicefees->count() === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
                @else

                 <?php 
                    if($_REQUEST){
                        if($_REQUEST['page'] > 1) {
                            $perpage = 10;
                            $i = ($perpage*$_REQUEST['page'])-$perpage;
                        }
                        else
                            $i=0;
                    }
                    else 
                        $i = 0;
                    
                 ?>

                @foreach ($servicefees as $service)
                    <?php  $i++; ?>
                <tr>
                    <td class="numeric" >{{ $i }}</td>
                    <td title="{{ $service->name }}">{{ mb_strimwidth($service->name, 0, 25, "...") }}</td>
                    <td class="numeric">{{ $service->service_cost }}</td>
                    @if(Auth::user()->hasRole(['admin']))
                    <td class="numeric">{{ $service->username }}</td>
                    @endif
                    <td style="text-align:center">{{ $service->created_at }}</td>
                    <td> <a class="fa fa-download" href="{{url('/servicefees/'.$service->id.'/show/yes')}}" title="Pdf">
                    </a></td>
                   <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/servicefees/'.$service->id.'/edit')}}" title="Edit"></a></td>
                    <td><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/servicefees/'.$service->id.'/delete')}}" title="Delete"></a></td>
                    
                </tr>
                @endforeach
                @endif
               </tbody>
		</table>
		</section>
    </div>
  </div> 
        <center>
        {!!$servicefees->render()!!}
     </center>

</div>
@stop