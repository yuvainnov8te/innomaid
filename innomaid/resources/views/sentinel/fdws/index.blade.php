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
			   <header class="panel-heading">
              <div class="row">
                <div class="col-md-6">
                    <div class="am-btn-toolbar">
                     Manage Fdw Profile
                    </div>
                </div>
               <div class="col-md-6">
                    <div class="am-btn-toolbar">
                    
                   <a href="{{ url('/fdws/create') }}" title="Add new FDW profile" style="float:right;">Create</a>
          
                    </div>
                </div>
            </div>
									<!--<a href="{{ url('/fdws/create') }}" style="float:right;">Add new FDW profile
									</a>-->
                       
                          </header>
						 <!-- <div>
								<p class="adddnewp" align="right" style="padding-right:20px;">
									<a href="{{ url('/fdws/create') }}">Add new FDW profile
									</a>
								</p>
						</div>-->
						<form method="POST" action="{{ route('sentinel.fdws.search') }}" accept-charset="UTF-8">
						<div class="row"> <?php if($search){ $serach_term=$search; } else {  $serach_term=""; }?>
					<div class="col-md-5" style="float:bottom;margin-right:10px; padding-top:20px;"> Total Records : {{$total}} </div>
					 <div class="col-md-6" style="float:right;padding-right:20px; padding-top:10px;" width="100%">
					<div class="input-group am-am-input-group input-group-SM" style="">
					<input class="form-control AM form-field " value="<?php echo $serach_term; ?>"  type="text" name="search_term" placeholder="Search with Name">
					<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
					<i class="glyphicon glyphicon-search"></i>
					</button>
					</div>{!! ($errors->has('search_term') ? $errors->first('search_term', '<small class="error">:message</small>') : '') !!}</div>
					</div> </div></form>
					<div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed ">
                                  <thead>
                                  <tr>
                                      <th>S.No.</th>
                                      <th>Name</th>
                                      <th class="numeric">Date of birth</th>
                                      <th class="numeric">Height (cm)</th>
                                      <th class="numeric">Weight (kg)</th>
                                      <th class="numeric">Marital Status</th>
                                      <th>Address</th>
                                      <th class="numeric">Contact number</th>
                                      <th class="numeric">Education level</th>
                                      @if(Auth::user()->hasRole(['admin']))
                                      <th class="numeric">Created By</th>
                                      @endif 
									  <th class="numeric">Updated Date</th>
									  <th colspan="4" style="text-align:center;" class="numeric">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                   @if ($fdwList->count() === 0)
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

                @foreach ($fdwList as $fdw)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric">{{ $i }}</td>
                    <td title='{{ $fdw->name }}' >{{ucfirst($fdw->name)}}</td>
                    @if( $fdw->date_of_birth =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td class="numeric"> {{  date("d M Y", strtotime($fdw->date_of_birth)) }}</td>
                        @endif
                   
                    <td class="numeric">{{ $fdw->height }}</td>
                    <td class="numeric">{{ $fdw->weight }}</td>
                    <td>
                       {{$fdw->marital_status}}
                    </td>
                    <td title='{{ $fdw->address }}' class="numeric">{{ mb_strimwidth($fdw->address, 0, 25, "...") }}</td>
                    <td class="numeric">{{ $fdw->contact_number }}</td>
                    <td>{{ $fdw->educationlevel }}</td>
                    @if(Auth::user()->hasRole(['admin']))
                    <td>{{ ucfirst($fdw->username) }}</td>
                    @endif
                    <td class="numeric">{{ $fdw->updated_at }}</td>
                    <!--<td><a class="fa fa-th-list" href="{{ url('/fdws', $fdw->id)}}" title=""></a></td>-->
                    <td> <a class="fa fa-download" href="{{url('/fdws/'.$fdw->id.'/show/yes')}}"title="Pdf"></a></td>
                    <td><a class="fa fa-edit" href="{{ url('/fdws/'.$fdw->id.'/edit?tab=tab0')}}" title="Edit"></a></td>
                    <td><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/fdws/'.$fdw->id.'/Delete')}}" title="Delete"></a></td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
		</table>
		</section>
    </div>
  </div> 
		  <center>
        {!!$fdwList->render()!!}
     </center>  
 </div>
@stop
