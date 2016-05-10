@extends('sentinel.layouts.default')
@section('content')
<script type="text/javascript">

  $(function () {
  if($('#allergies_check').is(':checked')) {
    $('#allergies_text').show();
    } else {  
      $('#allergies_text').hide();
    }
    if($('#die_restrictions_check').is(':checked')) {
    $('#die_restrictions').show();
    } else {  
      $('#die_restrictions').hide();
    }
    if($('#phy_disabilities_check').is(':checked')) {
    $('#phy_disabilities').show();
    } else {  
      $('#phy_disabilities').hide();
    }
    if($('#food_handling_check').is(':checked')) {
    $('#food_handling').show();
    } else {  
      $('#food_handling').hide();
    }
    if($('#med_desieses_other').is(':checked')) {
    $('#med_desieses').show();
    } else {  
      $('#med_desieses').hide();
    }
     if ($("#marital_radio").is(':checked') && $("#marital_radio").val() == 'Single') {
          $('#no_of_children').prop('disabled', true);
          $('.childrenage').prop('disabled', true);  
    }
    else{
      $('#no_of_children').prop('disabled', false);
      $('.childrenage').prop('disabled', false);  
    }
    $('input:radio[name="marital_status"]').change(function(){
      if ($("#marital_radio").is(':checked') && $("#marital_radio").val() == 'Single') {
          $('#no_of_children').prop('disabled', true);
          $('.childrenage').prop('disabled', true);
      }
      else{
      $('#no_of_children').prop('disabled', false);
      $('.childrenage').prop('disabled', false);  
      }
    });


    $( "#tabs" ).tabs();
    $( "#tabs" ).tabs( "disable", 1 );
    $( "#tabs" ).tabs( "disable", 2 );
    $( "#tabs" ).tabs( "disable", 3 );
    $( "#tabs" ).tabs( "disable", 4 );
   $( "#tabs" ).tabs( "disable", 5 );
    $( "#no_of_children" ).change(function () {
      var countchild = parseInt($( "#no_of_children" ).val());
      var str ='';
      for(var i = 0; i < countchild; i++){
      str +='<div class="row"><div class="small-width18 columns"><label for="Age of child">Age of child '+ (i+1) +' :</label></div><div class="col-xs-5"><input type="text" name="children_age[]" class= "form-control childrenage" ></div></div>';
      }
      $("#appendchildage").html(str);
    }).change();
   /* $("#no_of_children").select2({
    width: '400px',
    placeholder: "Please Select a Port",
    allowClear: true
  });*/
   if($('#fdw_education').val() == 5){
        $('#other_education').show();
      }else{
        $('#other_education').hide();
    } 
}); 
  function fdweducation(){
      if($('#fdw_education').val() == 5){
        $('#other_education').show();
      }else{
        $('#other_education').hide();
      }
    }
  function showfield() {
    if($('#allergies_check').is(':checked')) {
    $('#allergies_text').show();
    } else {  
      $('#allergies_text').val('');
      $('#allergies_text').hide();
    }
    if($('#die_restrictions_check').is(':checked')) {
    $('#die_restrictions').show();
    } else {  
      $('#die_restrictions').val('');
      $('#die_restrictions').hide();
    }
    if($('#phy_disabilities_check').is(':checked')) {
    $('#phy_disabilities').show();
    } else {  
      $('#phy_disabilities').val('');
      $('#phy_disabilities').hide();
    }
    if($('#food_handling_check').is(':checked')) {
    $('#food_handling').show();
    } else {  
      $('#food_handling').val('');
      $('#food_handling').hide();
    }
    if($('#med_desieses_other').is(':checked')) {
    $('#med_desieses').show();
    } else {  
      $('#med_desieses').val('');
      $('#med_desieses').hide();
    }
   
  }
  function isFutureDate(){
   // alert();
    var today = new Date().getTime();
    var day = $('#day').val();
    var month = $('#month').val();
    var year = $('#year').val();
    if(day && month && year){
      idate = new Date(year, month - 1, day).getTime();
      if((today - idate) < 0){
        alert('You can not select future date.');
        $("#day").val($("#day option:first").val());
        $("#month").val($("#month option:first").val());
        $("#year").val($("#year option:first").val());
        return false;
      } 
      else{
        var m = parseInt(month, 10);
        var d = parseInt(day, 10);
        var y = parseInt(year, 10);
        var date = new Date(y,m-1,d);
        if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
            return true;
        } else {
            alert('Please select valid date.');
            $("#day").val($("#day option:first").val());
            $("#month").val($("#month option:first").val());
            $("#year").val($("#year option:first").val());
            return false;
        }
      }
     } 
}
function generate_refrence_code(){
  $('#maid_refrence_code').val('IN00001');
}
</script>
<h3 style='margin-left:10px;'>Add FDW Bio data</h3>
<hr/>
{!! Form::open(array('route' => 'fdws.create' ,'enctype'=>'multipart/form-data')) !!}
    <!-- include is used for render partial view errors/form_error.blade.php and books/form.blade.php -->
<div id="tabs">
    <ul>
      <li><a href="#tabs-1"><strong>Part A.</strong> <span style="font-size:0.7em">PROFILE</span></a></li>
      <li><a href="#tabs-2"><strong>Part B.</strong> <span style="font-size:0.7em">SKILLS</span></a></li>
      <li><a href="#tabs-3"><strong>Part C.</strong> <span style="font-size:0.7em">EMPLOYMENT HISTORY</span></a></li>  
      <li><a href="#tabs-4"><strong>Part D.</strong> <span style="font-size:0.7em">OTHER DETAILS</span></a></li>
      <li><a href="#tabs-5"><strong>Part E.</strong> <span style="font-size:0.7em">UPLOAD DOCUMENT</span></a></li>
     <li><a href="#tabs-6"><strong>Part F.</strong> <span style="font-size:0.7em">MAID INTRODUCTION </span></a></li>
    </ul>

<!--FDW Personal Form End-->
<div id="tabs-1">  
  <!--@include('errors.form_error')-->
  <div class="small-10 columns">
   <p><span class="mandatory">*</span> Fields are required</p>
  </div>

@if(Auth::user()->hasRole(['admin']))
<div class="row">
<div class="small-width18 columns">
    <label for="Name of FDW">Agency:<span class="mandatory">*</span></label>
</div>
<div class="col-xs-5 {{ ($errors->has('users_agents_id')) ? 'error' : '' }}">
    {!! Form::select('users_agents_id', [''=>'Select agency'] + $agencies,null, ['class' => 'form-control']) !!}
    {!! ($errors->has('users_agents_id') ? $errors->first('users_agents_id', '<small class="error">:message</small>') : '') !!}
</div>
</div> 
 @endif

<div class="row">
<div class="small-width18 columns">
    <label for="Name of FDW">Name of FDW:<span class="mandatory">*</span></label>
</div>
<div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">
    {!! Form::text('name', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    <label for="Date of birth">Date of birth: <span class="mandatory">*</span> </label>
</div>
 <div class="col-xs-5 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}">
 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
  {!! Form::select('day', ['' => 'Day'] + array_combine(range(1, 31), range(1, 31)),'null',['onchange'=> 'return isFutureDate()','id'=>'day']) !!}
 </div>
 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 2px;padding-right: 2px;">
{!! Form::select('month', array('' => 'Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field','onchange'=> 'return isFutureDate()','id'=>'month']) !!}
 </div>
 
 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
 {!! Form::select('year', ['' => 'Year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),'null',['onchange'=> 'return isFutureDate()','id'=>'year']) !!}
 </div>
  {!! ($errors->has('day') ? $errors->first('day', '<small class="error">:message</small>') : '') !!}
   {!! ($errors->has('month') ? $errors->first('month', '<small class="error">:message</small>') : '') !!}
    {!! ($errors->has('year') ? $errors->first('year', '<small class="error">:message</small>') : '') !!}
  </div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Place of birth">Place of birth: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('place_of_birth')) ? 'error' : '' }}">
  {!! Form::text('place_of_birth', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
  {!! ($errors->has('place_of_birth') ? $errors->first('place_of_birth', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Height', 'Height (cm):') !!}
      </div>
    <div class="col-xs-5 {{ ($errors->has('height')) ? 'error' : '' }}">
    {!! Form::text('height', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('height') ? $errors->first('height', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Weight', 'Weight (kg):') !!}
      </div>
    <div class="col-xs-5 {{ ($errors->has('weight')) ? 'error' : '' }}">
    {!! Form::text('weight', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('weight') ? $errors->first('weight', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Nationality">Nationality: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('nationality')) ? 'error' : '' }}">
    {!! Form::select('nationality', [''=>'Select nationality'] + $nationality, ['class' => 'form-control']) !!}
    {!! ($errors->has('nationality') ? $errors->first('nationality', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Address">Address: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('address')) ? 'error' : '' }}">
    {!! Form::text('address', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('address') ? $errors->first('address', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Name of port/airport">Name of port/airport: <span class="mandatory"> *</span></label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('port_name')) ? 'error' : '' }}">
    {!! Form::text('port_name', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('port_name') ? $errors->first('port_name', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Contact number">Contact number <span class="mandatory">*</span> :</label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('contact_number')) ? 'error' : '' }}">
    {!! Form::text('contact_number', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('contact_number') ? $errors->first('contact_number', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Passport number">Passport number :</label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('passport_number')) ? 'error' : '' }}">
    {!! Form::text('passport_number', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('passport_number') ? $errors->first('passport_number', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Passport number">Work permit number:</label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('work_permit_no')) ? 'error' : '' }}">
    {!! Form::text('work_permit_no', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('work_permit_no') ? $errors->first('work_permit_no', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Maid reference code">Maid reference code: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('maid_reference_code')) ? 'error' : '' }}">
    {!! Form::text('maid_reference_code', null, ['class'=> 'form-control','id'=>'maid_refrence_code', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('maid_reference_code') ? $errors->first('maid_reference_code', '<small class="error">:message</small>') : '') !!}
</div><button  class="btn btn-success btn-sm" onclick="return generate_refrence_code()" type="button" id="cancel" name="generate_refrence" value="next">Generate refernce code</button>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Religion">Religion: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('religion')) ? 'error' : '' }}">
     {!! Form::select('religion', array('' => 'Select religion', 
    'Hindu' => 'Hindu', 'Muslim' => 'Muslim', 'Free Thinker'=>'Free Thinker', 'Christian'=>'Christian', 'Catholic'=>'Catholic', 'Buddhist'=>'Buddhist', 'Sikh'=>'Sikh', 'Others'=>'Others'), Input::old('religion'),
    array('class' => 'form-control')) !!}
    {!! ($errors->has('religion') ? $errors->first('religion', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Education level: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('education_level')) ? 'error' : '' }}">
     {!! Form::select('education_level', [''=>'Select education level'] + $education_levels, null,['class' => 'form-control', 'onchange' => 'fdweducation()','id'=>'fdw_education']) !!}
     {!! Form::text('other_education', null, ['class'=> 'form-control','id'=>'other_education','placeholder'=>'Education level']) !!}
     {!! ($errors->has('education_level') ? $errors->first('education_level', '<small class="error">:message</small>') : '') !!}
     {!! ($errors->has('other_education') ? $errors->first('other_education', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Type: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('type')) ? 'error' : '' }}">
     {!! Form::select('type', array('' => 'Select type', 
    'New' => 'New', 'Transfer' => 'Transfer' , 'Ex-Singapore'=>'Ex-Singapore'), Input::old('type'),
    array('class' => 'form-control')) !!}
     {!! ($errors->has('type') ? $errors->first('type', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Availability:</label>
      </div>
    <div class="col-xs-5">
     {!! Form::select('availability', array('' => 'Select availability', 
   'Available'=>'Available', 'Immediate' => 'Immediate', 'Taken' => 'Taken'), Input::old('availability'),
    array('class' => 'form-control')) !!}
     {!! ($errors->has('availability') ? $errors->first('availability', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Expected Salary:</label>
      </div>
    <div class="col-xs-5">
    {!! Form::text('expected_salary', null, ['class'=> 'form-control','placeholder' => 'S$', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('expected_salary') ? $errors->first('expected_salary', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('No. of siblings', 'No. of siblings:') !!}
      </div>
    <div class="col-xs-5 {{ ($errors->has('no_of_siblings')) ? 'error' : '' }}">
     {!! Form::text('no_of_siblings', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('no_of_siblings') ? $errors->first('no_of_siblings', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Marital status">Marital status: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('marital_status')) ? 'error' : '' }}">
    <label class="radio-inline"> {!! Form::radio('marital_status', 'Single', true,['id' => 'marital_radio']) !!} Single</label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Married', null,['id' => 'marital_radio']) !!} Married </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Widowed', null,['id' => 'marital_radio']) !!} Widowed </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Divorced', null,['id' => 'marital_radio']) !!} Divorced </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Separated', null,['id' => 'marital_radio']) !!} Separated </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Single Parent', null,['id' => 'marital_radio']) !!} Single Parent </label>
    {!! ($errors->has('marital_status') ? $errors->first('marital_status', '<small class="error">:message</small>') : '') !!}
</div>
</div></br>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Display Biodata:</label>
      </div>
    <div class="col-xs-5">
	<label class="radio-inline"><input type="radio" value="Yes" checked="checked" name='display_biodata' > Yes</label>
        <label class="radio-inline"><input type="radio" value="No" name='display_biodata'> No </label>
</div>
</div></br>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('No. of children', 'No. of children:') !!}
      </div>
    <div class="col-xs-5 {{ ($errors->has('no_of_children')) ? 'error' : '' }}">
     {!! Form::text('no_of_children', null, ['class'=> 'form-control', 'autocomplete' => 'off','id'=>'no_of_children']) !!}
    {!! ($errors->has('no_of_children') ? $errors->first('no_of_children', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div id='appendchildage'>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Profile image', 'Profile image:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::file('profile_image', ['id'=> 'thumbnail','class'=> 'maid_image']) !!}
    <span class="image-description">Preferred image size 100 X 100 and formats JPEG, PNG, JPG are allowed</span>
   {!! ($errors->has('profile_image') ? $errors->first('profile_image', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Full body image', 'Full body image:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::file('image', ['id'=> 'profile','class'=> 'maid_image']) !!}
    <span class="image-description">Preferred image size 500 X 300 and formats JPEG, PNG, JPG are allowed</span>
   {!! ($errors->has('image') ? $errors->first('image', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Upload Profile Document', 'Upload Profile Document:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::file('profile_document', ['id'=> 'profile_document','class'=> 'maid_image']) !!}
    <span class="image-description">Preferred image size 2MB and formats pdf, docx, doc are allowed.</span>
   {!! ($errors->has('profile_document') ? $errors->first('profile_image', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<!--<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Full body image', 'Passport Document:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::file('passportdocument[]', array('multiple'=>true)) !!}
   {!! ($errors->has('passportdocument') ? $errors->first('passportdocument', '<small class="error">:message</small>') : '') !!}
</div>
</div>-->
<!--<div class="row">
    <div class="small-2 columns">
      {!! Form::label('Availabe of FDW to be interview by prospective employer', 'Availabe of FDW to be interview by prospective employer:') !!}
    </div>
    <div class="col-xs-5">
      <div class="row">
        <label class="checkbox-inline" id="">
            <input type="checkbox" value="Interviewed via telephone / teleconference" name="interview_method[]"> Interviewed via telephone / teleconference
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          <input type="checkbox" value="Interviewed via videoconference" name="interview_method[]"> Interviewed via videoconference
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          <input type="checkbox" value="Interviewed in person" name="interview_method[]" onchange="showfield()" id="food_handling_check"> Interviewed in person
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          <input type="checkbox" value="Interviewed in person and also made observation of FDW in the areas of work" name="interview_method[]" > Interviewed in person and also made observation of FDW in the areas of work
        </label>
      </div>
    </div>
  </div>--></br>
<div class="row">
<div class="small-width18 columns">
    <label for="Name of FDW">Video link:</label>
</div>
<div class="col-xs-5 {{ ($errors->has('video_link')) ? 'error' : '' }}">
    {!! Form::text('video_link', null, ['class'=> 'form-control','placeholder'=>'Video url allowed.']) !!}
    {!! ($errors->has('video_link') ? $errors->first('video_link', '<small class="error">:message</small>') : '') !!}
</div>
</div>
  
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Allergies ( if any)', 'Allergies ( if any):') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::checkbox('allergies', 'Yes',null,['id' => 'allergies_check', 'onChange' => 'showfield()']) !!}{!! Form::text('allergy_description', null, ['class'=> 'form-control','id'=>'allergies_text']) !!}
</div>
</div>

<div class="row">
<div class="small-10 columns">
<p>Past and existing illness ( including chronic ailments and illnesses requiring medication ):</p>
 </div>
  </div>
      <?php $count = 0; 
      echo "<div class='row'>";
      ?>
      @foreach ($medical_desieses as $id => $title)
        <?php $count++; 
        if($count == 4){
            echo "</div>"; 
            echo "<div class='row'>";  
            $count=1;
            }
        ?>
      <div class="col-xs-3">
        <label class="checkbox-inline">
        {!! Form::checkbox('medical_desieses_id[]', $id) !!} {{ $title }}
        </label>
          </div>
        <?php 
          if($count == 4){  
            $count=1;
            }
        ?>   
      @endforeach
      </br>
    <div class="col-xs-5"><label class="checkbox-inline"> {!! Form::checkbox('medical_desieses_id[]', 'Others',null,['id' => 'med_desieses_other', 'onChange' => 'showfield()']) !!} Others (if any) </label> {!! Form::text('description', null, ['class'=> 'form-control','id'=>'med_desieses']) !!}</div>
</div>
</br>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Physical disabilities', 'Physical disabilities:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::checkbox('physical_disablity', 'Yes',null,['id' => 'phy_disabilities_check', 'onChange' => 'showfield()']) !!} {!! Form::text('physical_disability_description', null, ['class'=> 'form-control','id'=>'phy_disabilities']) !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Dietary restrictions', 'Dietary restrictions:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::checkbox('dietary_restrictions', 'Yes',null,['id' => 'die_restrictions_check', 'onChange' => 'showfield()']) !!}{!! Form::text('dietary_restrictions_description', null, ['class'=> 'form-control','id'=>'die_restrictions']) !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Food handling preferences', 'Food handling preferences:') !!}
      </div>
    <div class="col-xs-5">
    <label class="checkbox-inline"> {!! Form::checkbox('food_handling_prefrences[]', 'Pork') !!} No Pork </label><label class="checkbox-inline"> {!! Form::checkbox('food_handling_prefrences[]', 'Beef') !!} No Beef </label><label class="checkbox-inline"> {!! Form::checkbox('food_handling_prefrences[]', 'Others',null,['id' => 'food_handling_check', 'onChange' => 'showfield()']) !!} Others (if any) </label>{!! Form::text('food_handling_preference_other', null, ['class'=> 'form-control','id'=>'food_handling']) !!}
</div>
</div>
</br>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Preference for rest day', 'Preference for rest day:') !!}
      </div>
    <div class="col-xs-5">
     {!! Form::select('rest_days_preference', array('' => 'Select rest day(s) per month ', '0' => '0'
    ,'1' => '1', '2' => '2', '3' => '3', '4' => '4' ), Input::old('rest_days_preference'),
    array('class' => 'form-control')) !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Any other remarks', 'Any other remarks:') !!}
      </div>
    <div class="col-xs-5">
    {!! Form::text('medication_remarks', null, ['class'=> 'form-control']) !!}
</div>
</div>

<input type='hidden' value=' <?php echo $isapp ?>' name='isapp'>
<div class="row">
<div class="small-10 margin-left columns">
    <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
</div>
</div>

 </div>
<!--FDW Personal Form End-->
 <!-- FDW Skill Form Start -->
 <div id="tabs-2">
 </div>
 <div id="tabs-3">
 </div>
 <div id="tabs-4">
 </div>
  <div id="tabs-5">
 </div>
 </div>
 {!! Form::close() !!}
<script type="text/javascript">
var _URL = window.URL || window.webkitURL;


</script>
@stop
