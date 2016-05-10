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
			  
						  </div>

         <div class="panel-body">
		<section id="unseen" class="table-responsive">
		<table class="table table-bordered table-condensed">
			  <thead>
			  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center">Country Id</th>
                    <th style="text-align:center">Name</th>
					<th style="text-align:center">Visible</th>
					 
     
                </tr>
            </thead>

            <tbody>
                @if ($countries->count() === 0)
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

                @foreach ($countries as $country)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
					<td class="numeric" style="text-align:center">{{ $country->id }}</td>
                    <td style="text-align:center" title='{{ $country->name }}'>{{ mb_strimwidth($country->name, 0, 50, "...") }}</td>
					<td style="text-align:center">@if($country->display_in_fdw == 'Y') Yes @else No @endif</td>
				</tr>
                @endforeach
                @endif
              </tbody>
		</table>
		</section>
    </div>
  </div> 
        <center>
        {!!$countries->render()!!}
     </center>
</div>
@stop