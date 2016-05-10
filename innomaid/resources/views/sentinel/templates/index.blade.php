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
					Manage Templates
					<!--<a href="{{ url('/template/create') }}" style="float:right;">Add new template
					</a>-->
         
					 <a href="{{ url('/template/create') }}" title="Add new template" style="float:right;">Create</a>
        		
      </header>
						  </div>

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center">Title</th>
                    <th style="text-align:center">Visible to Agency </th>
                    <th class="numeric" style="text-align:center">Updated Date</th>
                    <th colspan="4" style="text-align:center" class="numeric">Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($templateList->count() === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
                @else

                 <?php 
                    if($_REQUEST){
                        if($_REQUEST['template'] > 1) {
                            $pertemplate = 10;
                            $i = ($pertemplate*$_REQUEST['template'])-$pertemplate;
                        }
                        else
                            $i=0;
                    }
                    else 
                        $i = 0;
                    
                 ?>

                @foreach ($templateList as $template)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td style="text-align:center" title='{{ $template->title }}'>{{ mb_strimwidth($template->title, 0, 50, "...") }}</td>
                    <td style="text-align:center">@if($template->visible == 1) Yes @else No @endif</td>
                    @if( $template->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($template->updated_at)) }}</td>
                        @endif
					<td style="text-align:center "><a class="fa fa-eye" href="{{ url('/template/'.$template->id.'/preview')}}" data-toggle="modal" title="preview"></a></td>
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/template/'.$template->id.'/edit')}}" title="Edit"></a></td>
					 <td><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/template/'.$template->id.'/delete')}}" title="Delete"></a></td>
					
                </tr>
                @endforeach
                @endif
              </tbody>
		</table>
		</section>
    </div>
  </div>
        <center>
        {!!$templateList->render()!!}
     </center>
 </div>
@stop