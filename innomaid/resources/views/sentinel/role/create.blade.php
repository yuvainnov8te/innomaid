{{-- 
 Developed by :- Harendar Singh
 Module       :- Create View for Role Module

--}}
@extends('sentinel.layouts.default')
@section('content')
<h3 style='margin-left:10px;'>Add Role</h3>
<hr/>
<div class="panel-body" style="background-color:#f0f2f7;">
      {!! Form::open(array('route' => 'role.create' ,'enctype'=>'multipart/form-data')) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Role identity: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Role name:</label>
                    </div>
                    <div class="col-xs-5">
                       {!! Form::text('display_name', null, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('display_name') ? $errors->first('display_name', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Description:</label>
                    </div>
                   <div class="col-xs-5">
                       {!! Form::text('description', null, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('description') ? $errors->first('description', '<small class="error">:message</small>') : '') !!}
                    </div>  
                </div>
                <div class="row">
                  <div class="small-width18 columns">
                    <label for="Name of FDW">Display:</label>
                  </div>
                  <div class="col-xs-5">
                      <input name="display" value="1" type="checkbox">
                  </div>
                </div>
                <div class="row">
                  <div class="small-width18 columns">
                    <label for="Name of FDW">Activate:</label>
                  </div>
                  <div class="col-xs-5">
                      <input name="activated" value="1" type="checkbox">
                  </div>
                </div>
               <div style="margin-top:20px;"class="row">
                  <div class="small-10 small-offset-2 columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save</button>
                       <button onclick="window.location='{{ url('role') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>

    </form>
</div>
@stop

