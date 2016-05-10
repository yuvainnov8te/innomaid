{{-- 
 Developed by :- Harendar Singh
 Module       :- Create View for Permission Module

--}}
@extends('sentinel.layouts.default')
@section('content')
<h3 style='margin-left:10px;'>Add Permission</h3>
<hr/>
<div class="panel-body" style="background-color:#f0f2f7;">
      {!! Form::model($permission, array('route' => array('sentinel.permission.update', $permission[0]->id))) !!}
                <div class="small-10 columns">
                    <p><span class="mandatory">*</span> Fields are required</p>
                </div>

                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Permission name: <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
                        {!! Form::text('name', $permission[0]->name, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Display name:</label>
                    </div>
                    <div class="col-xs-5">
                       {!! Form::text('display_name', $permission[0]->display_name, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('display_name') ? $errors->first('display_name', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
                <div class="row">
                    <div class="small-width18 columns">
                    <label for="Name of FDW">Description:</label>
                    </div>
                   <div class="col-xs-5">
                       {!! Form::text('description', $permission[0]->description, ['class'=> 'form-control']) !!}
                        {!! ($errors->has('description') ? $errors->first('description', '<small class="error">:message</small>') : '') !!}
                    </div>  
                </div>

               <div style="margin-top:20px;"class="row">
                  <div class="small-10 small-offset-2 columns">
                       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save</button>
                       <button onclick="window.location='{{ url('permission') }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                  </div>
              </div>

    </form>
</div>
@stop
