@extends('sentinel.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Edit Profile
@stop

{{-- Content --}}
@section('content')
<?php //echo "<pre>"; print_r($agencycontacts); exit; ?>
<script type="text/javascript">
        $(function () {
            $('#roles').prop('disabled', true);
            $( "#tabs" ).tabs();
            <?php if(isset($_GET['tab'])) {
                    if($_GET['tab'] == 'tab1')
                    {?>
                        $( "#tabs" ).tabs({active:1});
            <?php } else if($_GET['tab'] == 'tab2'){ ?>
                        $( "#tabs" ).tabs({active:2});
            <?php } else if($_GET['tab'] == 'tab3'){ ?>
                        $( "#tabs" ).tabs({active:3});
            <?php }else {?>
                        $( "#tabs" ).tabs({active:0});
                <?php } }?>
        });
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
    function validation(){
         var contactname = document.getElementsByName("contact_name[]");
         var contactnumber = document.getElementsByName("contact_no[]");
            var alpha_space = /^[a-zA-Z ]*$/;
            var number = /^[0-9]*$/;
            var ret = true;
            for (var x = 0; x < contactname.length; x++) { 
                var contact_name = contactname[x].value;
                var uniquename = $('#uniquecontactname').val();
                var find = uniquename.search(contact_name);
                if(contact_name == '' || contact_name == '0'){
                    var msg = "Please enter value in contact name "+(x+1)+".";
                    ret = false;
                    break;
                    }else if(contact_name.length < 3) {
                        var msg = "Please enter at least three characters in contact name "+(x+1)+".";
                        ret = false;
                        break;
                    }else if(!(alpha_space.test(contact_name))) {
                        var msg = "Please enter alphabatic value in contact name "+(x+1)+".";
                        ret = false;
                        break;
                    }else if(find>0){
                        var msg = "You enter duplicate entry for company name "+(x+1)+".";
                        ret = false;
                        break;
                    }
                    else{
                            var contact_number = contactnumber[x].value;
                                if(contact_number == '' || contact_number == '0'){
                                var msg = "Please enter value in contact number "+(x+1)+".";
                                ret = false;
                                break;
                                }else if(contact_number.length < 8 || contact_number.length > 15) {
                                    var msg = "Please enter digits 8 to 15 in contact number "+(x+1)+".";
                                    ret = false;
                                    break;
                                }else if(!(number.test(contact_number))) {
                                    var msg = "Please enter only digits in contact number "+(x+1)+".";
                                    ret = false;
                                    break;
                                }else {
                                var   uniquestring =uniquename + ',' + contact_name;
                                $('#uniquecontactname').val(uniquestring);
                                    ret = true;
                                } 

                                
                        } 

                 }
            

               if (ret == false)
               {
                 alert(msg); return ret;        
               }
    }
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
                var fromAMPM = fromtime.match(/00(.*)$/)[1];;
                if(fromAMPM == "PM" && fromhours<12) fromhours = fromhours+12;
                if(fromAMPM == "AM" && fromhours==12) fromhours = fromhours-12;
                var fromsHours = fromhours.toString();
                var fromsMinutes = fromminutes.toString();
                if(fromhours<10) fromsHours = "0" + fromsHours;
                if(fromminutes<10) fromsMinutes = "0" + fromsMinutes;

                var totime = $('.'+id+'to').val(); 
                var tohours = Number(totime.match(/^(\d+)/)[1]);
                var tominutes = Number('00');
                var toAMPM = totime.match(/00(.*)$/)[1];;
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
<?php
    // Pull the custom fields from config
    $isProfileUpdate = ($user->email == Auth::user()->email);
    $customFields = config('sentinel.additional_user_fields');

    // Determine the form post route
    if ($isProfileUpdate) {
        $profileFormAction = route('sentinel.profile.update');
        $passwordFormAction = route('sentinel.password.change', $user->id);
    } else {
        $profileFormAction =  route('sentinel.users.update', $user->hash);
        $passwordFormAction = route('sentinel.password.change', $user->id);
    }
?>

<div class="row">
    <h3>
        Edit
        @if ($isProfileUpdate)
            Your
        @endif
        Account
    </h3 >
</div>

<?php $customFields = config('sentinel.additional_user_fields'); ?>
<div id="tabs">
    <ul>
    @if (Auth::user()->hasRole('admin'))
      <li><a href="#tabs-1"><strong>Part A.</strong> <span style="font-size:0.7em">AGENCY ACCOUNT</span></a></li>
      <li><a href="#tabs-2"><strong>Part B.</strong> <span style="font-size:0.7em">CONTACT PERSON DETAILS</span></a></li>
      <li><a href="#tabs-3"><strong>Part C.</strong> <span style="font-size:0.7em">CHANGE PASSWORD</span></a></li>
      <li><a href="#tabs-4"><strong>Part D.</strong> <span style="font-size:0.7em">OTHER SETTINGS</span></a></li>
   @else
      <li><a href="#tabs-1"><strong>Part A.</strong> <span style="font-size:0.7em">USER ACCOUNT</span></a></li>
      <li><a href="#tabs-3"><strong>Part B.</strong> <span style="font-size:0.7em">CHANGE PASSWORD</span></a></li>
   @endif
    </ul>
    <div id="tabs-1">
        <form method="POST" action="{{ route('sentinel.users.update',['id'=>$user->id]) }}" enctype='multipart/form-data' accept-charset="UTF-8" >
          <div class="row">
                <div class="small-10 large-centered columns">
                    @if (Auth::user()->hasRole('user'))
                    <h3>Update User</h3>
                    @else
                    <h3>Update Agency</h3>
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
                                        $user_role[0]->role_id,
                                        ['class' => ' class = "am-dropdown"  Data-am-dropdown','id' => 'roles']) !!}
                            {!! ($errors->has('role') ? $errors->first('role', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">Company Name: <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('company_name')) ? 'error' : '' }}">
                            <input placeholder="Company name" name="company_name" type="text" value="<?php echo $user->company_name;?>">
                            {!! ($errors->has('company_name') ? $errors->first('company_name', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">E-mail: <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('email')) ? 'error' : '' }}">
                            <input placeholder="E-mail" name="email" type="text" value="<?php echo $user->email;?>">
                            {!! ($errors->has('email') ? $errors->first('email', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>

                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">Telephone: <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('telephone')) ? 'error' : '' }}">
                            <input placeholder="" name="telephone" type="text" value="<?php echo $user->telephone;?>">
                            {!! ($errors->has('telephone') ? $errors->first('telephone', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>

                    @if (Auth::user()->hasRole('admin'))    

                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">Fax:</label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('fax')) ? 'error' : '' }}">
                            <input placeholder="" name="fax" type="text" value="<?php echo $user->fax;?>">
                            {!! ($errors->has('fax') ? $errors->first('fax', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>

                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">Website:</label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('website')) ? 'error' : '' }}">
                            <input placeholder="http://www.example.com" name="website" type="text" value="<?php echo $user->website;?>">
                            {!! ($errors->has('website') ? $errors->first('website', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>       
                     <div class="row">
                <div class="small-3 columns">
                    <label for="right-label" class="">Operating Days & Hours:<span class="mandatory">*</span> </label>
                </div>
                <?php 
                    $Monday = '';
                    $monfrom = '';
                    $monto = '';
                    $Tuesday = '';
                    $tuefrom = '';
                    $tueto = '';
                    $Wednesday = '';
                    $wedfrom = '';
                    $wedto = '';
                    $Thrusday = '';
                    $thrfrom = '';
                    $thrto = '';
                    $Friday = '';
                    $frifrom = '';
                    $frito = '';
                    $Saturday = '';
                    $satfrom = '';
                    $satto = '';
                    $Sunday = '';
                    $sunfrom = '';
                    $sunto = '';
                ?>
                @foreach($agency_opertaing_info as $key => $daytime)
                      <?php //echo '<pre>';  print_r($daytime); exit; 
                            if($daytime->operating_day == 'Monday'){
                                $Monday = 'checked';
                                $monfrom = $daytime->operating_hrs_from;
                                $monto = $daytime->operating_hrs_to;
                            }
                            else if($daytime->operating_day == 'Tuesday'){
                                $Tuesday = 'checked';
                                $tuefrom = $daytime->operating_hrs_from;
                                $tueto = $daytime->operating_hrs_to;
                            }
                            else if($daytime->operating_day == 'Wednesday'){
                                $Wednesday = 'checked';
                                $wedfrom = $daytime->operating_hrs_from;
                                $wedto = $daytime->operating_hrs_to;
                            }
                            else if($daytime->operating_day == 'Thrusday'){
                                $Thrusday = 'checked';
                                $thrfrom = $daytime->operating_hrs_from;
                                $thrto = $daytime->operating_hrs_to;
                            }
                            else if($daytime->operating_day == 'Friday'){
                                $Friday = 'checked';
                                $frifrom = $daytime->operating_hrs_from;
                                $frito = $daytime->operating_hrs_to;
                            }
                            else if($daytime->operating_day == 'Saturday'){
                                $Saturday = 'checked';
                                $satfrom = $daytime->operating_hrs_from;
                                $satto = $daytime->operating_hrs_to;
                            }
                            else if($daytime->operating_day == 'Sunday'){
                                $Sunday = 'checked';
                                $sunfrom = $daytime->operating_hrs_from;
                                $sunto = $daytime->operating_hrs_to;
                            }
                      ?>

                @endforeach
                <div class="small-2 columns">
                    @if($Monday == 'checked')
                      <input type="checkbox" onchange="timefield('Monday')" class="operating_day" id="Monday" value="Monday" name="operating_day[]" checked='checked'> Monday
                    @else
                      <input type="checkbox" onchange="timefield('Monday')" class="operating_day" id="Monday" value="Monday" name="operating_day[]"> Monday
                    @endif
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
                    {!! Form::select('operating_hrs_from[]',$hours ,$monfrom,['class' => 'field Mondayfrom','onchange'=>'return checkday("Monday","Mondayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     {!! Form::select('operating_hrs_to[]',$hours ,$monto,['class' => 'field Mondayto','onchange'=>'return checkday("Monday","Mondayto")']) !!}
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>
                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    @if($Tuesday == 'checked')
                      <input type="checkbox" onchange="timefield('Tuesday')" class="operating_day" id="Tuesday" value="Tuesday" name="operating_day[]" checked='checked'> Tuesday
                    @else
                      <input type="checkbox" onchange="timefield('Tuesday')" class="operating_day" id="Tuesday" value="Tuesday" name="operating_day[]"> Tuesday
                    @endif
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                    {!! Form::select('operating_hrs_from[]',$hours ,$tuefrom,['class' => 'field Tuesdayfrom','onchange'=>'return checkday("Tuesday","Tuesdayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     {!! Form::select('operating_hrs_to[]',$hours ,$tueto,['class' => 'field Tuesdayto','onchange'=>'return checkday("Tuesday","Tuesdayto")']) !!}
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>


                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    @if($Wednesday == 'checked')
                      <input type="checkbox" onchange="timefield('Wednesday')" class="operating_day" id="Wednesday" value="Wednesday" name="operating_day[]" checked='checked'> Wednesday
                    @else
                      <input type="checkbox" onchange="timefield('Wednesday')" class="operating_day" id="Wednesday" value="Wednesday" name="operating_day[]"> Wednesday
                    @endif
                    
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns {{ ($errors->has('operating_hrs')) ? 'error' : '' }}">
                    {!! Form::select('operating_hrs_from[]',$hours ,$wedfrom,['class' => 'field Wednesdayfrom','onchange'=>'return checkday("Wednesday","Wednesdayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns {{ ($errors->has('operating_hrs')) ? 'error' : '' }}">
                     {!! Form::select('operating_hrs_to[]',$hours ,$wedto,['class' => 'field Wednesdayto','onchange'=>'return checkday("Wednesday","Wednesdayto")']) !!}
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    @if($Thrusday == 'checked')
                      <input type="checkbox" onchange="timefield('Thrusday')" class="operating_day" id="Thrusday" value="Thrusday" name="operating_day[]" checked='checked'> Thursday
                    @else
                      <input type="checkbox" onchange="timefield('Thrusday')" class="operating_day" id="Thrusday" value="Thrusday" name="operating_day[]"> Thursday
                    @endif
                    
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns {{ ($errors->has('operating_hrs')) ? 'error' : '' }}">
                    {!! Form::select('operating_hrs_from[]',$hours ,$thrfrom,['class' => 'field Thrusdayfrom','onchange'=>'return checkday("Thrusday","Thrusdayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     {!! Form::select('operating_hrs_to[]',$hours ,$thrto,['class' => 'field Thrusdayto','onchange'=>'return checkday("Thrusday","Thrusdayto")']) !!}
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    @if($Friday == 'checked')
                      <input type="checkbox" onchange="timefield('Friday')" class="operating_day" id="Friday" value="Friday" name="operating_day[]" checked='checked'> Friday
                    @else
                      <input type="checkbox" onchange="timefield('Friday')" class="operating_day" id="Friday" value="Friday" name="operating_day[]"> Friday
                    @endif
                    
                </div>
                <div class="small-7 columns">
                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns {{ ($errors->has('operating_hrs')) ? 'error' : '' }}">
                    {!! Form::select('operating_hrs_from[]',$hours ,$frifrom,['class' => 'field Fridayfrom','onchange'=>'return checkday("Friday","Fridayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns ">
                     {!! Form::select('operating_hrs_to[]',$hours ,$frito,['class' => 'field Fridayto','onchange'=>'return checkday("Friday","Fridayto")']) !!}
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns ">
                    @if($Saturday == 'checked')
                      <input type="checkbox" onchange="timefield('Saturday')" class="operating_day" id="Saturday" value="Saturday" name="operating_day[]" checked='checked'> Saturday
                    @else
                      <input type="checkbox" onchange="timefield('Saturday')" class="operating_day" id="Saturday" value="Saturday" name="operating_day[]"> Saturday
                    @endif
                    
                </div>
                <div class="small-7 columns">

                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                    {!! Form::select('operating_hrs_from[]',$hours ,$satfrom,['class' => 'field Saturdayfrom','onchange'=>'return checkday("Saturday","Saturdayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns">
                     {!! Form::select('operating_hrs_to[]',$hours ,$satto,['class' => 'field Saturdayto','onchange'=>'return checkday("Saturday","Saturdayto")']) !!}
                    {!! ($errors->has('operating_hrs_to') ? $errors->first('operating_hrs_to', '<small class="error">:message</small>') : '') !!}
                    </div>
                </div>

                <div class="small-3 columns">
                    <label for="right-label" class="">&nbsp</label>
                </div>
                <div class="small-2 columns">
                    @if($Sunday == 'checked') 
                      <input type="checkbox" onchange="timefield('Sunday')" class="operating_day" id="Sunday" value="Sunday" name="operating_day[]" checked='checked'> Sunday
                    @else
                      <input type="checkbox" onchange="timefield('Sunday')" class="operating_day" id="Sunday" value="Sunday" name="operating_day[]"> Sunday
                    @endif
                    
                </div>
                <div class="small-7 columns">

                 <div class="small-2 columns">
                    <label for="right-label" class="">From:</label>
                </div>
                  <div class="small-4 columns">
                    {!! Form::select('operating_hrs_from[]',$hours ,$sunfrom,['class' => 'field Sundayfrom','onchange'=>'return checkday("Sunday","Sundayfrom")']) !!}
                    {!! ($errors->has('operating_hrs_from') ? $errors->first('operating_hrs_from', '<small class="error">:message</small>') : '') !!}
                    </div> 
                    <div class="small-2 columns">
                    <label for="right-label" class="">To:</label>
                </div> 
                    <div class="small-4 columns ">
                     {!! Form::select('operating_hrs_to[]',$hours ,$sunto,['class' => 'field Sundayto','onchange'=>'return checkday("Sunday","Sundayto")']) !!}
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
                    <input placeholder="Other Information" name="other_information" type="text" value="<?php echo $user->other_information;?>">
                    </div> 
                </div>
            </div>
                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">License Number: <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('license_no')) ? 'error' : '' }}">
                            <input placeholder="" name="license_no" type="text" value="<?php echo $user->license_no;?>">
                            {!! ($errors->has('license_no') ? $errors->first('license_no', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>
                    @endif
                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="">Address: <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('address')) ? 'error' : '' }}">
                            <input placeholder="" name="address" type="text" value="<?php echo $user->address;?>">
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
                                    'Central' => 'Central', 'East' => 'East', 'North'=>'North', 'North-East'=>'North-East','West'=>'West'),$user->area,
                            array('class' => 'form-control')) !!}
                            {!! ($errors->has('area') ? $errors->first('area', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>
						<div class="row">
        				<div class="small-3 columns">
        				{!! Form::label('Agency Logo', 'Agency Logo:') !!}
        			</div>
        				<div class="small-9 columns">
        				<div style="width:50%;float:left;">
        				{!! Form::file('image') !!}
        				{!! ($errors->has('image') ? $errors->first('image', '<small class="error">:message</small>') : '') !!}
        				</div>
        				@if($user->image)
        				<div style="float:right"><img src="{{ assetnew('uploads/agency_logo/'.$user->image) }}" title="Agency Logo"   height="50px" width="100px"/></div>
        				@else
        				<div></div>
        			@endif
        			</div></div>
                    @endif
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="activate">Activate:</label>
                        </div>
                        <div class="small-9 columns {{ ($errors->has('address')) ? 'error' : '' }}">
                        @if($user->activated == 1)
                            <input name="activated" value="1" type="checkbox" checked="checked">
                        @else($user->activated == 0)
                            <input name="activated" value="1" type="checkbox">
                        @endif
                        </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                     <div class="row">
                        <div class="small-10 small-offset-3 columns">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input class="button small" value="Update" type="submit" onclick = 'return checkhours()'>
                            {!! Form::reset('Reset', array('class' => 'button small')) !!}
                            <button onclick="window.location='{{ url("users") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                        </div>
                    </div>
                    </div>          
                </div>
            </form>
        </div>
    @if (Auth::user()->hasRole('admin'))    
    <div id="tabs-2">
        <form method="POST" action="{{ route('sentinel.users.updateagencycontact',['id'=>$user->id]) }}" accept-charset="UTF-8">
            <div class="row">
                <div class="small-8 large-centered columns">
                    <h3>Create Agency Contacts</h3>
                    <div class="table-responsive">
                        <div class="small-10 columns">
                            <p><span class="mandatory">*</span> Fields are required</p>
                        </div>
                        <table class="table table-bordered" id="contactcontent" width="100%">
                              <thead>
                                <tr id='addcontact0'>
                                  <th style="width:20%">Contact Name <span class="mandatory">*</span></th>
                                  <th style="width:20%">Contact Number <span class="mandatory">*</span></th>
                                  <th style="width:15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php $radiocounter = 0;
                                     $contactnamestring = 'a';
                                   ?>
                                 
                                    @if($agencycontacts)
                                      @foreach ($agencycontacts as $agencycontactsid => $agencycontactsvalue)
                                        <?php $contactnamestring .= ','.$agencycontactsvalue->contact_name; ?>
                                        <tr>
                                            <td>{!! $agencycontactsvalue->contact_name !!}</td>
                                            <td>{!! $agencycontactsvalue->contact_no !!}</td>
                                            <td><a href="{{  url('/users/'.$agencycontactsvalue->agency_id.'/agencycontactsdelete/'.$agencycontactsvalue->id)}}" onclick="return confirmdelete();">
                                            <img src="{{ asset('uploads/delete.png') }}" title="Delete Image"   height="20px" width="20px"/></a></td>
                                        </tr>
                                        <?php $radiocounter++; ?>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td><input placeholder="" name="contact_name[]" type="text" value="" id="contact_name"></td>
                                            <td><input placeholder="" name="contact_no[]" type="text" value=""></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                        <tr id='addcontact1'></tr>
                              </tbody>
                        </table>
                        <input type="hidden" value="<?php echo $contactnamestring; ?>"id="uniquecontactname">
                        <a id="add_row_contact" class="btn btn-default pull-left">Add Contact</a><a id='delete_row_contact' class="pull-right btn btn-default">Remove</a>
                    </div>    
                </div>
            </div>
            <br />
            <div class="row">
                <div class="small-10 small-offset-2 columns">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="button small" value="Create" type="submit" onclick="return validation();">
                    {!! Form::reset('Reset', array('class' => 'button small')) !!}
                    <button onclick="window.location='{{ url("users") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                </div>
            </div>
        </form>
    </div>
    @endif
    <div id="tabs-3">
        <form method="POST" action="{{ $passwordFormAction }}" accept-charset="UTF-8" class="form-inline" role="form">
            <div class="row">
                <div class="small-7 large-centered columns">
                    <h4>Change Password</h4>    
                    <div class="small-10 columns">
                        <p><span class="mandatory">*</span> Fields are required</p>
                    </div>
                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="right inline">New <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns">
                            <input class="" placeholder="New Password" name="newPassword" value="" id="newPassword" type="password">
                            {!! ($errors->has('newPassword') ?  $errors->first('newPassword', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>

                     <div class="row">
                        <div class="small-3 columns">
                            <label for="right-label" class="right inline">Confirm <span class="mandatory">*</span> </label>
                        </div>
                        <div class="small-9 columns">
                            <input class="" placeholder="Confirm New Password" name="newPassword_confirmation" value="" id="newPassword_confirmation" type="password">
                            {!! ($errors->has('newPassword_confirmation') ?  $errors->first('newPassword_confirmation', '<small class="error">:message</small>') : '') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-9 small-offset-3 columns">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input class="button small" value="Change Password" type="submit">
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
     @if (Auth::user()->hasRole('admin'))
    <div id="tabs-4">
        <form method="POST" action="{{ route('sentinel.users.updateothersetting',['id'=>$user->id]) }}" accept-charset="UTF-8" class="form-inline" role="form">
            <div class="row">
                <div class="small-10 large-centered columns">
                    <h3>Other Settings</h3>
                        <div class="row">
                        <div class="small-3 columns">
                           <label for="Insurance_company">Insurance Company: <span class="mandatory">*</span> </label>
                              </div>
                            <div class="small-9 columns">
                            {!! Form::select('insurance_company', array('' => 'Select Company', 
                           'Liberty Insurance Pte Ltd' => 'Liberty Insurance Pte Ltd','InsureAsia Agency Pte Ltd' => 'InsureAsia Agency Pte Ltd','Tenet Sompo Insurance Pte Ltd' => 'Tenet Sompo Insurance Pte Ltd','AXA Insurance Singapore Pte Ltd' => 'AXA Insurance Singapore Pte Ltd','Tokio Marine Insurance Singapore Ltd' => 'Tokio Marine Insurance Singapore Ltd','Allied World Assurance Company Ltd' => 'Allied World Assurance Company Ltd','Wah Hong Ensure Pte Ltd' => 'Wah Hong Ensure Pte Ltd','Vintage Insurance Agency' => 'Vintage Insurance Agency','Ecics Limited' => 'Ecics Limited'),$user->insurance_company,
                            array('class' => 'form-control')) !!}
							{!! ($errors->has('insurance_company') ? $errors->first('insurance_company', '<small class="error">:message</small>') : '') !!}
                            </div>
                        </div>
                        <div class="row">
                        <div class="small-10 small-offset-3 columns">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input class="button small" value="Update" type="submit">
                            {!! Form::reset('Reset', array('class' => 'button small')) !!}
                            <button onclick="window.location='{{ url("users") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
 <script type="text/javascript">
    $(document).ready(function(){
     // This section is used for history pannel add delete row
     var k=1;
        $("#add_row_contact").click(function(){
            $('#addcontact'+k).html('<td><input placeholder="" name="contact_name[]" type="text" value="" id="contact_name"></td><td><input placeholder="" name="contact_no[]" type="text" value=""></td><td></td>');

            $('#contactcontent').append('<tr id="addcontact'+(k+1)+'"></tr>');
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