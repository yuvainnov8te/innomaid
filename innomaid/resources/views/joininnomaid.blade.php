@extends('default')

@section('title')
Innomaid
@stop

@section('head')
@stop
@section('main')
<script type="text/javascript">
  $(function () {
    if($('#deleteMsg').val() != ''){
      $('#myModal').modal('show');
    }
  });
</script>
<style>
.error
{
	background-color:#f5f5f5 !important;
}
</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            {{Session::get('success')}}
            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" value="{{Session::get('success')}}" id="deleteMsg">
 <div  class="row list-group std-margin">
          <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%">
          <div class="thumbnail">
            <div class="caption">
				<h5 style="text-align:left">Join Innomaid</h5>
                <div class="container">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-1">
                        <div class="well well-sm">
                          <form class="form-horizontal" method="POST" action="{{ route('welcome.addjoininnomaid') }}" accept-charset="UTF-8">
                          
                            
                            <div class="small-10 columns">
                                <p><span class="mandatory" style='color:red'>*</span> Fields are required</p>
                            </div>
                            <div class="form-group" style='color: #008cba;font-weight: bold;margin-left: 10%;'>
                              1. Contact Information
                            </div>

                            <!-- Name input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="name">Name <span class="mandatory" style='color:red'>*</span></label>
                              <div class="col-md-5">
                                <input id="name" name="name" type="text" placeholder="Your name" class="form-control" value="{{old('name')}}">
                                {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                            
                            <!-- Comapany input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="company_name">Company Name <span class="mandatory" style='color:red'>*</span></label>
                              <div class="col-md-5">
                                <input id="company_name" name="company_name" type="text" placeholder="Your company name" class="form-control" value="{{old('company_name')}}">
                                {!! ($errors->has('company_name') ? $errors->first('company_name', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>

                            <!-- Email input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="email">E-mail <span class="mandatory" style='color:red'>*</span></label>
                              <div class="col-md-5">
                                <input id="email" name="email" type="text" placeholder="Your email" class="form-control" value="{{old('email')}}">
                                {!! ($errors->has('email') ? $errors->first('email', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                            
                            <!-- Telephone input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="email">Phone Number</label>
                              <div class="col-md-5">
                                <input id="telephone" name="telephone" type="text" placeholder="Your phone number" class="form-control" value="{{old('telephone')}}">
                                {!! ($errors->has('telephone') ? $errors->first('telephone', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
							<!--<div class="form-group">
								<div class="col-md-7 col-md-offset-3">							
									<div class="g-recaptcha" data-sitekey="6LdfpRETAAAAAGy8n8rqgzJ4SyfORkStcZaBpM6c"></div>
								</div>
							</div>-->

                            <div class="form-group">
                              <div class="col-md-3 col-md-offset-5">
                                <button type="submit" class="btn btn-warning btn-block">Submit</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="clearfix"></div>

          </div>  
        </div>
      </div>
  @stop 
