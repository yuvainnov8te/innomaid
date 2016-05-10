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
					Manage Agreement Form
					<!--<a href="{{ url('/agreementform/create') }}" style="float:right;">Add new agreementform
					</a>-->
          		
      </header>
						  </div>

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center">Title</th>
                    <th class="numeric" style="text-align:center">Updated Date</th>
                    <th colspan="4" style="text-align:center" class="numeric">Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($agreementformList->count() === 0 && $standardformList->count() === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
                @else

                 <?php 
                    if($_REQUEST){
                        if($_REQUEST['agreementform'] > 1) {
                            $peragreementform = 10;
                            $i = ($peragreementform*$_REQUEST['agreementform'])-$peragreementform;
                        }
                        else
                            $i=0;
                    }
                    else 
                        $i = 0;
                    
                 ?>

                @foreach ($agreementformList as $agreementform)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td style="text-align:center" title='{{ $agreementform->title }}'>{{ mb_strimwidth($agreementform->title, 0, 50, "...") }}</td>
                   
                    @if( $agreementform->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($agreementform->updated_at)) }}</td>
                        @endif
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/agreementform/'.$agreementform->form_id.'/edit')}}" title="Edit"></a></td>
                   
                    
                </tr>
                @endforeach
				@foreach ($standardformList as $standardform)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i  }} </td>
                    <td style="text-align:center" title='{{ $standardform->title }}'>{{ mb_strimwidth($standardform->title, 0, 50, "...") }}</td>
                    
                    @if( $standardform->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($standardform->updated_at)) }}</td>
                        @endif
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/agreementform/'.$standardform->id.'/edit')}}" title="Edit"></a></td>
                   
                    
                </tr>
                @endforeach
                @endif
              </tbody>
		</table>
		</section>
    </div>
  </div> 
        <center>
        {!!$agreementformList->render()!!}
     </center>
</div>
@stop