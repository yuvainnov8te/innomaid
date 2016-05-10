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
					Manage Maid Application
					<!--<a href="{{ url('/page/create') }}" style="float:right;">Add new Page
					</a>
          @if(!(Auth::user()->hasRole(['admin'])))--> <!--@endif-->   
					 <a href="{{ url('/application/create') }}" title="Add new Application" style="float:right;">Create</a>
         	
      </header>
	   <form method="POST" action="{{ route('sentinel.application.search') }}" accept-charset="UTF-8">
					<?php if($search){ $serach_term=$search; } else {  $serach_term=""; }?>
					 <div class="row">
					<div class="col-md-5" style="float:bottom;margin-right:10px; padding-top:20px;"> Total Records : {{$total}} </div>
					 <div class="col-md-6" style="float:right;padding-right:20px; padding-top:10px;" >
					<div class="input-group am-am-input-group input-group-SM" style="">
					<input class="form-control AM form-field " value="<?php echo $serach_term; ?>"  type="text" name="search_term" placeholder="Search with Case Id , Employer Name, and  Maid Name">
					
					
			
					<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
					<i class="glyphicon glyphicon-search"></i>
					</button>
					</div>
					</div> {!! ($errors->has('search_term') ? $errors->first('search_term', '<small class="error">:message</small>') : '') !!}
					</div>
					</div></form>
						  </div>

         <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                    <th class="numeric" style="text-align:center">S.No.</th>
                    <th class="numeric" style="text-align:center">Case Id</th>
                    <th style="text-align:center">Maid</th>
                    <th style="text-align:center">Employer</th>
                    @if(Auth::user()->hasRole(['admin','user']))
                    <th style="text-align:center">Created By</th>
                    @endif
			<th style="text-align:center">Application Status</th> 
			<th style="text-align:center">Application Type</th> 
                    <th class="numeric" style="text-align:center">Updated Date</th> 
		<th colspan="2" style="text-align:center" class="numeric">Action</th>
                    @if(!(Auth::user()->hasRole(['admin'])))   
                   
                    @endif
                </tr>
            </thead>

            <tbody>
                @if ($applicationlist->count() === 0)
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

                @foreach ($applicationlist as $application)
                <?php  $maid_details = json_decode($application->maid_json_data); 
                    $employer_details = json_decode($application->employer_json_data); ?>
                    <?php $i++; ?>
                <tr>
                    <td class="numeric" style="text-align:center">{{ $i }}</td>
                    <td class="numeric" style="text-align:center">{{ $application->id }}</td>
                    <td style="text-align:center" >{{ucfirst( $maid_details->name ) }}</td>
                    <td style="text-align:center">{{ ucfirst($employer_details->employer_name)  }}</td>
                    @if(Auth::user()->hasRole(['admin','user']))
                    <td style="text-align:center">{{ ucfirst($application->username) }}</td>
                    @endif
		@if($application->status=="")
			<td style="text-align:center"> Active </td>
			@else
			<td style="text-align:center"> Closed </td>
			@endif
		    <td style="text-align:center">{{ ucfirst($application->type) }}</td>
                    @if( $application->updated_at =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric" style="text-align:center"> {{  date("d-m-Y", strtotime($application->updated_at)) }}</td>
                        @endif
                   <!-- <td style="text-align:center"><a class="fa fa-download" href="{{url('/application/'.$application->id.'/show_job_scope/yes')}}"title="Pdf"></a></td>-->
                   @if((Auth::user()->id==$application->user_agents_id))                  
            					 <td style="text-align:center"><a class="fa fa-edit" href="{{ url('/application/'.$application->id.'/edit?tab=tab0')}}" title="Edit"></a>
                      <td><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/application/'.$application->id.'/delete')}}" title="Delete"></a></td></td>
                  
                     @elseif(!(Auth::user()->hasRole(['admin'])))                  
            					<td style="text-align:center"><a class="fa fa-edit" href="{{ url('/application/'.$application->id.'/edit?tab=tab0')}}" title="Edit"></a></td>
                      <td><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/application/'.$application->id.'/delete')}}" title="Delete"></a></td>
		@else <td></td><td> </td>
                  @endif
                   
                    
                </tr>
                @endforeach
                @endif
              </tbody>
		</table>
		</section>
    </div>
  </div> 
        <center>
        {!!$applicationlist->render()!!}
     </center>
</div>
@stop
