@extends('sentinel.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Create New Agencies
@stop

{{-- Content --}}
@section('content')
<script type="text/javascript">
        $(function () {
            $( ".hourfrom" ).val('');
            $( ".hourto" ).val('');
            $( "#tabs" ).tabs();
            $( "#tabs" ).tabs( "disable", 1 );

var input = $('.field');
input.clockpicker({
    autoclose: true,
  donetext: 'Done',
twelvehour: true,
                       
});
        });
    function checkday(day,element){
        if(document.getElementById(day).checked)
        {
        }else{
            alert('First select the day.');
            $('.'+element).prop('selectedIndex',0);
        }
    }  
    function timefield(id){
        if($('#'+id).is(':checked')) {
        }else{
            $('.'+id+'from').prop('selectedIndex',0);
            $('.'+id+'to').prop('selectedIndex',0);
        }
    } 
    function checkhours()
    {  var val = [];
        var validate = 0;
        var msg ='';
        $('.operating_day:checked').each(function(i){
            var id = $(this).val();
            if($('.'+id+'from').val()=='' && $('.'+id+'to').val()==''){
                msg += 'Please select hours for '+ $(this).val()+'\n';
                validate = 1;
            }else if($('.'+id+'from').val()=='' && $('.'+id+'to').val()!=''){
                msg += 'Please select the hour from for '+ $(this).val()+'\n';
                validate = 1;
            }else if($('.'+id+'from').val()!='' && $('.'+id+'to').val()==''){
                msg += 'Please select the hour to for '+ $(this).val()+'\n';
                validate = 1;
            }else{
                var fromtime = $('.'+id+'from').val(); 
                var fromhours = Number(fromtime.match(/^(\d+)/)[1]);
                var fromminutes = Number('00');
                var fromAMPM = fromtime.substr(-2);
                if(fromAMPM == "PM" && fromhours<12) fromhours = fromhours+12;
                if(fromAMPM == "AM" && fromhours==12) fromhours = fromhours-12;
                var fromsHours = fromhours.toString();
                var fromsMinutes = fromminutes.toString();
                if(fromhours<10) fromsHours = "0" + fromsHours;
                if(fromminutes<10) fromsMinutes = "0" + fromsMinutes;

                var totime = $('.'+id+'to').val(); alert(fromtime);
                var tohours = Number(totime.match(/^(\d+)/)[1]);
                var tominutes = Number('00');
                var toAMPM = totime.substr(-2);
                if(toAMPM == "PM" && tohours<12) tohours = tohours+12;
                if(toAMPM == "AM" && tohours==12) tohours = tohours-12;
                var tosHours = tohours.toString();
                var tosMinutes = tominutes.toString();
                if(tohours<10) tosHours = "0" + tosHours;
                if(tominutes<10) tosMinutes = "0" + tosMinutes;
                if(tosHours && fromsHours){
                    if(tosHours > fromsHours){
                    }
                    else{if(id=='Thrusday')
                        {
                            id='Thursday';
                        }
                         msg += 'Please select operating Hours from less than operating Hours to for '+id+'.\n';
                        validate = 1;
                    }
                }
            }
        });
        if(validate){
            alert(msg);
            return false;
        }
    }   
</script>
<div id="tabs">
<?php //print_r($errors); exit; ?>
    @if (Auth::user()->hasRole('admin'))
    <ul>
      <li><a href="#tabs-1"><strong>Part A.</strong> <span style="font-size:0.7em">AGENCY ACCOUNT</span></a></li>
    </ul>
    @endif
    <div id="tabs-1">      
    <form method="POST" action="{{ route('sentinel.users.create') }}" enctype='multipart/form-data' accept-charset="UTF-8">
      <div class="row">
        <div class="small-10 large-centered columns">
            @if (Auth::user()->hasRole('user'))
            <h3>Create New User</h3>
            @else
            <h3>Create New Agency</h3>
            @endif
            <div class="small-10 columns">
                <p><span class="mandatory">*</span> Fields are required</p>
            </div>
            @if (Auth::user()->hasRole('user'))
            <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Role:<span class="mandatory">*</span></label>
                </div>
                <div class="small-9 columns {{ ($errors->has('role')) ? 'error' : '' }}">
                    {!! Form::select('role', 
                            (['' => 'Select a Role'] + $roles), 
                                'roles',
                                ['class' => ' class = "am-dropdown"  Data-am-dropdown','id' => 'roles']) !!}
                    {!! ($errors->has('role') ? $errors->first('role', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>
            @endif
            <div class="row">
                <div class="small-3 columns">
                    @if (Auth::user()->hasRole('user'))
                    <label for="right-label" class="">Name: <span class="mandatory">*</span> </label>
                    @else
                   <label for="right-label" class="">Agency Name: <span class="mandatory">*</span> </label>
                    @endif
                </div>
                <div class="small-9 columns {{ ($errors->has('company_name')) ? 'error' : '' }}">
                    <input placeholder="Name" name="company_name" type="text" value="{{ Input::old('company_name') }}">
                    {!! ($errors->has('company_name') ? $errors->first('company_name', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

            <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">E-mail:<span class="mandatory">*</span></label>
                </div>
                <div class="small-9 columns {{ ($errors->has('email')) ? 'error' : '' }}">
                    <input placeholder="E-mail" name="email" type="text" value="{{ Input::old('email') }}">
                    {!! ($errors->has('email') ? $errors->first('email', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>
            
            <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Password:<span class="mandatory">*</span></label>
                </div>
                <div class="small-9 columns">
                    <input class="form-control" placeholder="Password" name="password" value="" type="password">
                    {!! ($errors->has('password') ?  $errors->first('password', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

            <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Confirm Password:<span class="mandatory">*</span></label>
                </div>
                <div class="small-9 columns">
                    <input class="form-control" placeholder="Confirm Password" name="password_confirmation" value="" type="password">
                    {!! ($errors->has('password_confirmation') ?  $errors->first('password_confirmation', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

             <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Telephone:<span class="mandatory">*</span></label>
                </div>
                <div class="small-9 columns {{ ($errors->has('telephone')) ? 'error' : '' }}">
                    <input placeholder="" name="telephone" type="text" value="{{ Input::old('telephone') }}">
                    {!! ($errors->has('telephone') ? $errors->first('telephone', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

            @if (Auth::user()->hasRole('admin'))

             <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Fax:</label>
                </div>
                <div class="small-9 columns {{ ($errors->has('fax')) ? 'error' : '' }}">
                    <input placeholder="" name="fax" type="text" value="{{ Input::old('fax') }}">
                    {!! ($errors->has('fax') ? $errors->first('fax', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

             <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Website:</label>
                </div>
                <div class="small-9 columns {{ ($errors->has('website')) ? 'error' : '' }}">
                    <input placeholder="http://www.example.com" name="website" type="text" value="{{ Input::old('website') }}">
                    {!! ($errors->has('website') ? $errors->first('website', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>
             <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Operating Days & Hours:<span class="mandatory">*</span> </label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Monday')" class="operating_day" id="Monday" value="Monday" name="operating_day[]"> Monday
                </div>
                <div class="small-7 columns">
                <?php 
                    $hours[''] = '00.00';
                    for($i = 1; $i <= 24; $i++){ 
                        $hours[date("h.iA", strtotime("$i:00"))] = date("h.iA", strtotime("$i:00"));
                     }
                 ?>
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
			<input type='text' name='operating_hrs_from[]' class='field Mondayfrom hourfrom' onchange='return checkday("Monday","Mondayfrom")'>
                   
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                    <input type='text' name='operating_hrs_to[]' class = 'field Mondayto hourto' onchange='return checkday("Monday","Mondayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}<?php //print_r($errors); exit; ?>
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Tuesday')" class="operating_day" id="Tuesday" value="Tuesday" name="operating_day[]"> Tuesday
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                    <input type='text' name='operating_hrs_from[]' class = 'field Tuesdayfrom hourfrom' onchange='return checkday("Tuesday","Tuesdayfrom")'>
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     <input type='text' name='operating_hrs_to[]' class = 'field Tuesdayto hourto' onchange='return checkday("Tuesday","Tuesdayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>


                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Wednesday')" class="operating_day" id="Wednesday" value="Wednesday" name="operating_day[]"> Wednesday
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:
                    </label>
                </div>
                  <div class="small-4 columns">
                    <input type='text' name='operating_hrs_from[]' class = 'field Wednesdayfrom hourfrom' onchange='return checkday("Wednesday","Wednesdayfrom")'>
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:
                    </label>
                </div> 
                    <div class="small-4 columns">
                     <input type='text' name='operating_hrs_to[]' class ='field Wednesdayto hourto' onchange='return checkday("Wednesday","Wednesdayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Thrusday')" class="operating_day" id="Thrusday" value="Thrusday" name="operating_day[]"> Thursday
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                   <input type='text' name='operating_hrs_from[]' class = 'field Thrusdayfrom hourfrom' onchange='return checkday("Thrusday","Thrusdayfrom")'>
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     <input type='text' name='operating_hrs_to[]' class = 'field Thrusdayto hourto' onchange='return checkday("Thrusday","Thrusdayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Friday')" class="operating_day" id="Friday" value="Friday" name="operating_day[]"> Friday
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                    <input type='text' name='operating_hrs_from[]' class = 'field Fridayfrom hourfrom' onchange='return checkday("Friday","Fridayfrom")'>
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     <input type='text' name='operating_hrs_to[]' class = 'field Fridayto hourto' onchange='return checkday("Friday","Fridayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Saturday')" class="operating_day" id="Saturday" value="Saturday" name="operating_day[]"> Saturday
                </div>
                <div class="small-7 columns">

                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                   <input type='text' name='operating_hrs_from[]' class ='field Saturdayfrom hourfrom' onchange='return checkday("Saturday","Saturdayfrom")'>
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     <input type='text' name='operating_hrs_to[]' class = 'field Saturdayto hourto' onchange='return checkday("Saturday","Saturdayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    <input type="checkbox" onchange="timefield('Sunday')" class="operating_day" id="Sunday" value="Sunday" name="operating_day[]"> Sunday
                </div>
                <div class="small-7 columns">

                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                    <input type='text' name='operating_hrs_from[]' class= 'field Sundayfrom hourfrom' onchange='return checkday("Sunday","Sundayfrom")'>
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                    <input type='text' name='operating_hrs_to[]' class = 'field Sundayto hourto' onchange='return checkday("Sunday","Sundayto")'>
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>
                 <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                 <div class="small-9 columns">
                {!! ($errors->has('operating_day') ? $errors->first('operating_day', '<small class="error">:message</small>') : '') !!}
                {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                 </div>
                 <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-9 columns">

                 <div class="small-3 columns">
                    <label for="right-label" class="">Other Information:</label>
                </div>
                  <div class="small-9 columns">
                    <input placeholder="Other Information" name="other_information" type="text" value="{{ Input::old('other_information') }}">
                    </div> 
                </div>
            </div>
             <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">License Number:<span class="mandatory">*</span> </label>
                </div>
                <div class="small-9 columns {{ ($errors->has('license_no')) ? 'error' : '' }}">
                    <input placeholder="" name="license_no" type="text" value="{{ Input::old('license_no') }}">
                    {!! ($errors->has('license_no') ? $errors->first('license_no', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

            @endif
		<div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Registration No: <span class="mandatory">*</span> </label>
                </div>
                <div class="small-9 columns {{ ($errors->has('registration_number')) ? 'error' : '' }}">
                    <input placeholder="" name="registration_number" type="text" value="{{ Input::old('registration_number') }}" autocomplete ='off'>
                    {!! ($errors->has('registration_number') ? $errors->first('registration_number', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>

             <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Address: <span class="mandatory">*</span> </label>
                </div>
                <div class="small-9 columns {{ ($errors->has('address')) ? 'error' : '' }}">
                    <input placeholder="" name="address" type="text" value="{{ Input::old('address') }}">
                    {!! ($errors->has('address') ? $errors->first('address', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>
            @if (Auth::user()->hasRole('admin')) 
            <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Area: <span class="mandatory">*</span> </label>
                </div>
                <div class="small-9 columns {{ ($errors->has('area')) ? 'error' : '' }}">
                    {!! Form::select('area', array('' => 'Select Area', 
                            'Central' => 'Central', 'East' => 'East', 'North'=>'North', 'North-East'=>'North-East','West'=>'West'),null,
                    array('class' => 'form-control')) !!}
                    {!! ($errors->has('area') ? $errors->first('area', '<small class="error">:message</small>') : '') !!}
                </div>
            </div>
			<div class="row">
				<div class="small-3 columns">
					{!! Form::label('Agency logo', 'Agency Logo:') !!}
					</div>
				<div class="small-9 columns">
					{!! Form::file('image') !!}
					{!! ($errors->has('image') ? $errors->first('image', '<small class="error">:message</small>') : '') !!}
					</div>
				</div>
            @endif    
            <div class="row">
                <div class="small-3 columns">
                    <label for="activate">Activate:</label>
                </div>
                <div class="small-9 columns {{ ($errors->has('address')) ? 'error' : '' }}">
                    <input name="activated" value="1" type="checkbox">
                </div>
                </div>

             <div class="row">
                <div class="small-10 small-offset-3 columns">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="button small" value="Create" type="submit" onclick = 'return checkhours()'>
                    {!! Form::reset('Reset', array('class' => 'button small')) !!}
                    <button onclick="window.location='{{ url("users") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                </div>
            </div>
            </div>          
        </div>
        </form>
    </div>            

 </div>
 <script type="text/javascript">
    $(document).ready(function(){
     // This section is used for history pannel add delete row
     var k=1;
        $("#add_row_contact").click(function(){
            $('#addcontact'+k).html('<div class="row"><div class="small-3 columns"><label for="right-label" class="">Contact Name '+(k+1)+' <span class="mandatory">*</span> :</label></div> <div class="small-9 columns"><input placeholder="" name="contact_name" type="text" value=""></div></div><div class="row"><div class="small-3 columns"><label for="right-label" class="">Contact Number '+(k+1)+' <span class="mandatory">*</span> :</label></div><div class="small-9 columns"><input placeholder="" name="contact_no" type="text" value=""></div></div>');

            $('#contactcontent').append('<div id="addcontact'+(k+1)+'"></div>');
            k++; 
        });
    $("#delete_row_contact").click(function(){
       if(k>1){
         $("#addcontact"+(k-1)).html('');
         k--;
       }
    });

});
</script>
@stop
