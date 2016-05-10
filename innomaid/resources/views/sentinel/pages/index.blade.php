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
					Manage Pages
					<!--<a href="{{ url('/page/create') }}" style="float:right;">Add new Page
					</a>-->
					 @if(Auth::user()->hasRole(['admin']))
           <a href="{{ url('/page/create') }}" title="Add new Page" style="float:right;">Create</a>
          @endif
			</header>
						  </div>

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center">Title</th>
                    <th style="text-align:center">Published</th>
                    <th class="numeric" style="text-align:center">Updated Date</th>
                    <th colspan="4" style="text-align:center" class="numeric">Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($pageList->count() === 0)
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

                @foreach ($pageList as $page)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td style="text-align:center" title='{{ $page->title }}'>{{ mb_strimwidth($page->title, 0, 50, "...") }}</td>
                    <td style="text-align:center">@if($page->is_published == 1) Yes @else No @endif</td>
                    @if( $page->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($page->updated_at)) }}</td>
                        @endif
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/page/'.$page->id.'/edit')}}" title="Edit"></a></td>
                   
                    
                </tr>
                @endforeach
                @endif
              </tbody>
		</table>
		</section>
    </div>
  </div> 
        <center>
        {!!$pageList->render()!!}
     </center>
</div>
@stop