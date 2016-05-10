{{-- 
 Developed by :- Harendar Singh
 Module       :- Create View for Roles Permission Module

--}}
@extends('sentinel.layouts.default')
@section('content')
<?php //echo 'ok'; exit; ?>

<script type="text/javascript">
function check() {
var flag = document.getElementById("all").checked;
var i =0;
var chk_arr =  document.getElementsByName("permissions[]");
var length = chk_arr.length;
//document.getElementById("demo").innerHTML= length;
  if ( flag==true){
	//document.getElementById("demo").innerHTML= "exe";
  for ( i = 0; i < chk_arr.length; i++) {
        chk_arr[i].checked= "true";
		}
		}
  if( flag == false)
  {
   for (i = 0; i < chk_arr.length; i++) {
        chk_arr[i].checked= false;
		}
		}  
	
} </script>
<div class="am-tabs am-margin" data-am-tabs>
    <div class="am-tabs-bd">
        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
            <form class="am-form" action="" method="POST">
                <div class="am-g am-margin-top">
                    <h3>Permissions for @if($role[0]->display_name){{ucfirst($role[0]->display_name)}}@else {{($role[0]->name)}}@endif</h3>
                </div>

               
                <div class="am-g am-margin-top"> <ul> 	
				<li style="padding: 0px; list-style: none;" ><input type="checkbox" id="all" onclick="check()" /> Select All / Unselect All </li> </ul>
                    <table class="table">
                    		<tr><td class="am-fl" ><div class=" am-cf per-div"> Maid Application Permissions</div>
							
							 @foreach($permissions as $permission) 
								<?php $group = explode("." ,$permission->name);?>
								<div class="am-cf per-in-div">
								@if(in_array("application",$group))
								
								@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
									
									 @endif </div>
								@endforeach	
							 </tr>
							<tr><td class="am-fl" ><div class=" am-cf per-div"> FDWs Permissions</div>
							
							 @foreach($permissions as $permission) 
								<?php $group = explode("." ,$permission->name);?>
								<div class="am-cf per-in-div">
								@if(in_array("fdws",$group))
								
								@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
									
									 @endif </div>
								@endforeach	
							 </tr> 
							 <tr><td class="am-fl"><div class=" am-cf per-div"> Users Permissions</div>
							 @foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("users",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif </div> 
                             @endforeach</td> </tr> <tr><td class="am-fl"><div class=" am-cf per-div"> Employers Permissions</div>
							  @foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("employer",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							 </tr> <tr><td class="am-fl"><div class=" am-cf per-div"> ServiceFees Permissions</div>
							
							 @foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								  <div class="am-cf per-in-div">
								@if(in_array("servicefees",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							  </tr> <tr><td class="am-fl"><div class=" am-cf per-div"> Services Permissions</div>
							 @foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("service",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							  </tr> <tr><td class="am-fl"><div class=" am-cf per-div"> Static Pages Permissions</div>
							 @foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("page",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							 </tr>
							 <tr><td class="am-fl"><div class=" am-cf per-div"> Form Templates Permissions</div>
							@foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("template",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							 </tr>
							 <tr><td class="am-fl"><div class=" am-cf per-div"> Agreement Forms Permissions</div>
							@foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("agreementform",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							 </tr>
							 <tr><td class="am-fl"><div class=" am-cf per-div"> Roles Permissions</div>
							@foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("role",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach </td>
							 </tr> <tr><td class="am-fl">   <div class=" am-cf per-div"> Profile Permissions</div>
							 
							 @foreach($permissions as $permission) 
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("profile",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach 
							 @foreach($permissions as $permission)    
								<?php $group = explode("." ,$permission->name);?>
								 <div class="am-cf per-in-div">
								@if(in_array("password",$group))
									@if(in_array($permission->name,$rolePerms))
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
									@else
									<input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
									@endif
								@endif</div>
                             @endforeach
                        </td> </tr>
                     
                        
                    </table>

                </div>
                <div style= "float: left; width: 100%;"class="am-g am-margin-top am-cf">
                    <div  class="am-u-sm-8 am-u-md-4 am-u-sm-centered">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">Submit to save</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@stop