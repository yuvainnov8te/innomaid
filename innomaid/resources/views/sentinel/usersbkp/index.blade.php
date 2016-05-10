@extends('sentinel.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Home
@stop

{{-- Content --}}
@section('content')
<script type="text/javascript">
    function confirmdelete(totalmaid,totalemployer,totalmaid_application)
    {
      var x;
	  if(totalmaid>0)
		{
			if(totalemployer>0)
			{
				if(totalmaid_application>0)
					alert("This agency have "+totalmaid+" Maid(s) ,"+totalemployer+" Employer(s) and "+totalmaid_application+" Maid application(s) . You have to  delete them first.");
				else
					alert("This agency have "+totalmaid+" Maid(s) and ,"+totalemployer+" Employer(s). You have to delete them first.");
			}
			else{
				alert("This agency have "+totalmaid+" Maid(s) . You have to delete them first.");
			}	
		}
		else
		{
			if(totalemployer>0)
			{
				if(totalmaid_application>0)
					alert("This agency have "+totalemployer+" Employer(s) and "+totalmaid_application+" Maid application(s) . You have to delete them first.");
				else
					alert("This agency have "+totalemployer+" Employer(s). You have to delete them first.");
			}
			else
			{ 
				if(totalmaid_application>0)
					alert( "This agency have "+totalmaid_application+"Maid application(s). You have to delete them first.");
			
				else 
					var r=confirm("Are you sure you want to delete this ?");
			}
	
		}
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
<?php $user_email	=  Session::get('email'); ?>
<div class="row">
	  <div class="col-lg-12">
				<div>               
			   <header class="panel-heading">
			   @if (Auth::user()->hasRole('admin'))
					Current Agencies
				@else
					<th>Current Users</th>
				@endif	

               <!-- <a href="{{ route('users.create') }}" style="float:right;">Add new agency
                </a>-->
				<a href="{{ route('users.create') }}" title="Add new agency" style="float:right;">Create</a>
                          </header>
						  <form method="POST" action="{{ route('sentinel.users.search') }}" accept-charset="UTF-8">
						<div class="row"> <?php if($search){ $serach_term=$search; } else {  $serach_term=""; }?>
						 <div class="col-md-6" style="float:right;padding-right:20px; padding-top:10px;" width="100%">
						<div class="input-group am-am-input-group input-group-SM" style="">
						<input class="form-control AM form-field " value="<?php echo $serach_term; ?>"  type="text" name="search_term" placeholder="Search with  Id, Name and E-mail ">
						<div class="input-group-btn">
						<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
						</button>
						</div></div>
						</div> </div></form>
						  </div>
			<div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
			<th>S.No.</th>
			
			@if (Auth::user()->hasRole('admin'))
			<th>Agency Id</th>
			<th>Agency</th>
			@else
			<th>User Id</th>
			<th>User</th>
			@endif
			<th>Email</th>
			@if (Auth::user()->hasRole('admin'))
			<th>Website</th>
			@endif
			<th>Telephone</th>
			<th>Status</th>
			@if($user_email === 'admin@admin.com')
			<th>Options</th>
			@else
			<th colspan='2'>Options</th>
			@endif
			</tr>
		</thead>
		<tbody>
		@if ($users->count() === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
        @else
			<?php 
	            if($_REQUEST){
	                if(isset($_REQUEST['page']) > 1) {
	                    $perpage = 10;
	                    $i = ($perpage*$_REQUEST['page'])-$perpage;
	                }
	                else
	                    $i=0;
	            }
	            else 
	                $i = 0;
	        ?>
				@foreach ($users as $user)
				@if($user->email !== 'admin@admin.com')
				<?php $i++; ?>
					<tr>
						<td>{{ $i }}</td>
						<td title='{{ $user->id }}'>{{ $user->id }}</td>
						<td title='{{ $user->company_name }}'>{{ $user->company_name }}</td>
						<td><a href="">{{ $user->email }}</a></td>
						@if (Auth::user()->hasRole('admin'))
						<td>{{ $user->website }} </td>
						@endif
						<td>{{ $user->telephone }} </td>
						<td>@if($user->activated == 1) Active @else Not Active @endif</td>
						
						<td style="text-align:center"><a class="fa fa-edit" href="{{ url('/users/'.$user->id.'/edit?tab=tab0')}}" title="Edit"></a></td>
	                    <td style="text-align:center"><a class="fa fa-times" onclick="return confirmdelete(<?php echo $user->totalmaid;?>, <?php echo $user->totalemployer; ?>, <?php echo $user->totalmaid_application; ?>);" href="{{ url('/users/'.$user->id.'/delete')}}" title="Delete"></a></td>
						
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
        {!!$users->render()!!}
     </center>
  </div>
@stop
