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
 <div  class="row list-group std-margin" >
          <div class="item  col-xs-12 col-xs-offset-0 col-lg-4 col-lg-offset-0" style="align:center;width:100%">
          <div class="thumbnail">
            <div class="caption">
				<h5 style="text-align:left">Request for a maid</h5>
                <div class="container">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-1">
                        <div class="well well-sm">
                          <form class="form-horizontal" method="POST" action="{{ route('welcome.storerequestmaid') }}" accept-charset="UTF-8">
                            
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
                                <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                                {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                    
                            <!-- Email input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="email">E-mail <span class="mandatory" style='color:red'>*</span></label>
                              <div class="col-md-5">
                                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                                {!! ($errors->has('email') ? $errors->first('email', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
                            
                            <!-- Telephone input-->
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="email">Telephone</label>
                              <div class="col-md-5">
                                <input id="telephone" name="telephone" type="text" placeholder="Your telephone" class="form-control">
                                {!! ($errors->has('telephone') ? $errors->first('telephone', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>

                            <div class="form-group" style='color: #008cba;font-weight: bold;margin-left: 10%;'>
                              2. Please provide as much detail as possible on your special requests or questions/issues <span class="mandatory" style='color:red'>*</span>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">
                              <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" id="message" name="request_detail" placeholder="" rows="5"></textarea>
                                {!! ($errors->has('request_detail') ? $errors->first('request_detail', '<small class="error">:message</small>') : '') !!}
                              </div>
                            </div>
							<!--<div class="form-group">
								<div class="col-md-10 col-md-offset-1">
								<div class="g-recaptcha" data-sitekey="6LdfpRETAAAAAGy8n8rqgzJ4SyfORkStcZaBpM6c"></div>
								</div>
							</div>-->
                            <!-- Form actions -->
                            <div class="form-group">
                              <div class="col-md-3 col-md-offset-8">
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
