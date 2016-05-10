{{-- 
 Developed by :- Harendar Singh
 Module       :- Index View for Permission Module

--}}
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
                    Manage Permissions
                    <!--<a href="{{ url('/page/create') }}" style="float:right;">Add new Page
                    </a>-->

                     <a href="{{ url('/permission/create') }}" title="Add new Page" style="float:right;">Create</a>         
      </header>
                          </div>

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center">Title</th>
                    <th style="text-align:center">Category</th>
                    <th class="table-author am-hide-sm-only">Author</th>
                    <th class="numeric" style="text-align:center">Updated Date</th>
                    <th colspan="4" style="text-align:center" class="numeric">Action</th>
                </tr>
            </thead>

            <tbody>
                @if ($count === 0)
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

                @foreach ($permissions as $permission)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td style="text-align:center" title='{{ $permission->name }}'>{{ $permission->name }}</td>
                    <td style="text-align:center">{{ $permission->display_name }}</td>
                    <td style="text-align:center">{{ $permission->description }}</td>
                    @if( $permission->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($permission->updated_at)) }}</td>
                        @endif
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/permission/'.$permission->id.'/edit')}}" title="Edit"></a></td>
                   <td style="text-align:center"><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/permission/'.$permission->id.'/delete')}}" title="Delete"></a></td>
                    
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
@stop


