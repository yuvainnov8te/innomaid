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
            Manage Employer profile
								<!--	<a href="{{ url('/employer/create') }}" style="float:right;">Add new Employer profile
									</a>-->
                 <a href="{{ url('/employer/create') }}" title="Add new Employer profile" style="float:right;">Create</a>
                          </header>
						   <form method="POST" action="{{ route('sentinel.employer.search') }}" accept-charset="UTF-8">
					<?php if($search){ $serach_term=$search; } else {  $serach_term=""; }?>
					 <div class="row">
					<div class="col-md-5" style="float:bottom;margin-right:10px; padding-top:20px;"> Total Records : {{$total}} </div>
					 <div class="col-md-6" style="float:right;padding-right:20px; padding-top:10px;" >
					<div class="input-group am-am-input-group input-group-SM" style="">
					<input class="form-control AM form-field " value="<?php echo $serach_term; ?>"  type="text" name="search_term" placeholder="Search with Name and NRIC Number">
					<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
					<i class="glyphicon glyphicon-search"></i>
					</button>
					</div>
					</div>{!! ($errors->has('search_term') ? $errors->first('search_term', '<small class="error">:message</small>') : '') !!} </div>
					</div></form>
        </div>
       <div class="panel-body">
                              <section id="unseen" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                  <thead>
                                  <tr>
                   <th>S.No.</th>
                                      <th>Name</th>
                                      <th class="numeric">Date of birth</th>
                                      <th class="numeric">NRIC number</th>
                                      <th class="numeric">Profession</th>
                                      <th class="numeric">Company Name</th>
                                      <th>Office Number</th>
                                      <th class="numeric">Mobile Number</th>
                                      <th class="numeric">Address</th>
                                      @if(Auth::user()->hasRole(['admin']))
                                      <th class="numeric">Created By</th>
                                      @endif
									  <th class="numeric">Updated Date</th>
									  <th colspan="4" style="text-align:center;" class="numeric">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
								  @if ($employerList->count() === 0)
                    <tr>
                        <td colspan="11"><center> <b>No Data Found.</b></center></td>
                    </tr>
                @else

                 <?php 
                    if($_REQUEST){
                        if(isset($_REQUEST['page'])> 1) {
                            $perpage = 10;
                            $i = ($perpage*$_REQUEST['page'])-$perpage;
                        }
                        else
                            $i=0;
                    }
                    else 
                        $i = 0;
                    
                 ?>

                @foreach ($employerList as $employer)
                    <?php $i++; ?>
                <tr>
                    <td class="numeric">{{ $i }}</td>
                    <td title='{{ $employer->employer_name }}'>{{ $employer->employer_name }}</td>
                    @if( $employer->employer_date_of_birth =='0000-00-00')
                                  <td class="numeric"> {{ '' }}</td>
                        @else
                           <td> {{  date("d M Y", strtotime($employer->employer_date_of_birth)) }}</td>
                        @endif
                   
                    <td class="numeric">{{ $employer->employer_nric_no }}</td>
                    <td class="numeric">
                        {{$employer->employer_profession}}
                        
                    </td>
                    <td class="numeric">{{ $employer->employer_company }}</td>
                    <td class="numeric">@if($employer->employer_office_phone != 0){{ $employer->employer_office_phone }}@else{{''}}@endif</td>
                    <td class="numeric">{{ $employer->employer_mobile_phone }}</td>

                    <td title='{{ $employer->address }}'>{{ mb_strimwidth($employer->address, 0, 25, "...") }}</td>
                    @if(Auth::user()->hasRole(['admin']))
                    <td class="numeric">{{ $employer->username }}</td>
                    @endif
                    <td class="numeric">{{ $employer->updated_at }}</td>
                    <!--<td><a class="btn btn-primary" href="{{ url('/employer', $employer->id)}}">Show</a></td>-->
                    <td> <a class ="fa fa-download" href="{{url('/employer/'.$employer->id.'/show/yes')}}" title="Pdf">
                   
                    </a></td>
                    <td style="text-align:center"><a  class="fa fa-edit" href="{{ url('/employer/'.$employer->id.'/edit?tab=tab0')}}" title="Edit"></a></td>
                    <td><a class="fa fa-times" onclick="return confirmdelete();" href="{{ url('/employer/'.$employer->id.'/delete')}}" title="Delete"></a></td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
				</section>
    </div>
  </div> 
        <center>
        {!!$employerList->render()!!}
     </center>

</div>
<div class="col-md-2"></div>
@stop
