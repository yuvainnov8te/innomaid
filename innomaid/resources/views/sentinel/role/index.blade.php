{{-- 
 Developed by :- Harendar Singh
 Module       :- Index View for Permission Module

--}}
@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">
    function confirmdelete(total)
    {
      var x;
      if(total > 0){
        alert('This role is assigned to '+total+' user(s), please unlink user first.')
        return false;
      }
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
                    Manage Role
                    <!--<a href="{{ url('/page/create') }}" style="float:right;">Add new Page
                    </a>-->

                     <a href="{{ url('/role/create') }}" title="Add new Role" style="float:right;">Create</a>         
      </header>
                          </div>

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th style="text-align:center"> Role Identity</th>
                    <th style="text-align:center"> Role Name</th>
                    <th class="table-author am-hide-sm-only">Description</th>
                    <th class="table-author am-hide-sm-only">Display</th>
                    <th class="table-author am-hide-sm-only">Status</th>
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

                @foreach ($roles as $role)
                @if(!($role->id == 1))
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td style="text-align:center" title='{{ $role->name }}'>{{ $role->name }}</td>
                    <td style="text-align:center">{{ $role->display_name }}</td>
                    <td style="text-align:center">{{ $role->description }}</td>
                    <td>@if($role->display == 1) Yes @else No @endif</td>
                    <td>@if($role->activated == 1) Active @else Not Active @endif</td>
                    @if( $role->updated_at =='0000-00-00 00:00:00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($role->updated_at)) }}</td>
                        @endif
                    <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/role/'.$role->id.'/edit')}}" title="Edit"></a></td>
                    <td style="text-align:center"><a class="fa fa-pencil" href="{{ url('/role/'.$role->id.'/permissions')}}" title="Edit Permission"></a></td>
                    <td style="text-align:center"><a class="fa fa-times" onclick="return confirmdelete(<?php echo $role->total; ?>);" href="{{ url('/role/'.$role->id.'/delete')}}" title="Delete"></a></td>

                    
                </tr>
                @endif
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


