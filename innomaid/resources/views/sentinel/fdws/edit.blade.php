@extends('sentinel.layouts.default')
@section('content')
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<style>
	.display_none{ display:none; }
</style>
<script type="text/javascript">
    $(function () {
	$('#training_center').attr("disabled", "disabled");
	$('#audited_by_EA').attr("disabled", "disabled");
	$('#training').fadeOut('fast');
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
if($("[name='country'] option:selected").text()=='Others')
		{
			$('#other_country').show();
		}else{$('#other_country').hide();
}
$('#other_workarea').hide();
 <?php if($_GET['tab']=='tab1') {?>
  $( "#tabs" ).tabs({active:1});
<?php } else if($_GET['tab']=='tab0') { ?>
  $( "#tabs" ).tabs({active:0});
  <?php } else if($_GET['tab']=='tab2') { ?>
    $('#selecttab').val("tab2");
  $( "#tabs" ).tabs({active:2});
  <?php  } else if($_GET['tab']=='tab3') { ?>
    $('#selecttab').val("tab3");
  $( "#tabs" ).tabs({active:3}); 
  <?php } else if($_GET['tab']=='tab4') { ?>
    $('#selecttab').val("tab4");
  $( "#tabs" ).tabs({active:4}); 
<?php  } else if($_GET['tab']=='tab5') { ?>
    $('#selecttab').val("tab5");
  $( "#tabs" ).tabs({active:5}); 
<?php  } else if($_GET['tab']=='tab6') { ?>
    $('#selecttab').val("tab6");
   $( "#tabs" ).tabs({active:6});
  <?php } ?>

    $( "#no_of_children" ).change(function () {

      var countchild = parseInt($( "#no_of_children" ).val());
      var str ='';
      for(var i = 0; i < countchild; i++){
      str +='<div class="row"><div class="small-width18 columns"><label for="Age of child">Age of child '+ (i+1) +' :</label></div><div class="col-xs-5"><input type="text" name="children_age[]" class= "form-control childrenage" ></div></div>';
      }
      $("#appendchildage").html(str);
    });
        var scntDiv = $('#skilltable');
        var i = $('#skilltable tbody tr').size() + 1;
        
        $('#addskillrow').on('click', function() {
                $('<p><tr><td><input type="text" id=""></td><td><input type="checkbox" value="Interviewed in person" name="interview_method[]"></td><td><input type="checkbox" value="Interviewed in person" name="interview_method[]"></td><td><select><option>1</option><option>2</option></select></td><td><input type="text" id=""></td><td><a href="#" id="remScnt">Remove</a></td></tr></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').on('click', function() {
        alert('ok'); 
                if( i > 2 ) {
                        $(this).parents('tr td').remove();
                        i--;
                }
                return false;
        });
    CKEDITOR.replace('intro');
    if($('#fdw_education').val() == 5){
        $('#other_education').show();
      }else{
        $('#other_education').hide();
    } 
    if ($('#no_evaluation').is(':checked')) 
  {
    $('#singaporeskill').attr('checked', false);
    $('#overseasskill').attr('checked', false);
    $('#Overseas').fadeOut('slow'); $('#Singapore').fadeOut('slow');
	$('.interview_method').attr("disabled", "disabled");
   }
  else if($('#singaporeskill').is(':checked')&&$('#overseasskill').is(':checked'))
  {
    $('#Singapore').fadeIn('slow');
    $('#Overseas').fadeIn('slow');
	$('.interview_method').removeAttr("disabled");
	$('#training_center').removeAttr("disabled");
	$('#audited_by_EA').removeAttr("disabled");
	$('#training').fadeIn('fast');
  }
  else if ($('#singaporeskill').is(':checked')) { 
    $('#Singapore').fadeIn('slow');
    $('#Overseas').fadeOut('slow');
	$('.interview_method').removeAttr("disabled");
  }
  else if ($('#overseasskill').is(':checked')) {
    $('#Overseas').fadeIn('slow');
    $('#Singapore').fadeOut('slow');
	$('.interview_method').removeAttr("disabled");
	$('#training_center').removeAttr("disabled");
	$('#audited_by_EA').removeAttr("disabled");
	$('#training').fadeIn('fast');
	
  }
  else{
    $('#Singapore').fadeOut('slow');
    $('#Overseas').fadeOut('slow');
	$('.interview_method').attr("disabled", "disabled");
	$('#training_center').attr("disabled", "disabled");
	$('#audited_by_EA').attr("disabled", "disabled");
	$('#training').fadeOut('fast');
  }

    $('#singaporeskill').change(function(){
      if (this.checked) { 
	$('#no_evaluation').attr('checked', false);
        $('#Singapore').fadeIn('slow');
	$('.interview_method').removeAttr("disabled");
	
	
      } else {
        $('#Singapore').fadeOut('slow');
      }                   
    });
    $('#overseasskill').change(function(){
      if (this.checked) {
	$('#no_evaluation').attr('checked', false);
        $('#Overseas').fadeIn('slow');
	$('.interview_method').removeAttr("disabled");
	$('#training_center').removeAttr("disabled");
	$('#audited_by_EA').removeAttr("disabled");
	$('#training').fadeIn('fast');
      } else {
        $('#Overseas').fadeOut('slow');
	$('#training').fadeOut('slow');
	$('#training_center').attr("disabled", "disabled");
	$('#audited_by_EA').attr("disabled", "disabled");
      }                   
    });
$('#no_evaluation').change(function(){
      if (this.checked) {
	$('#singaporeskill').attr('checked', false);
	$('#overseasskill').attr('checked', false);
        $('#Singapore').fadeOut('slow'); $('#Overseas').fadeOut('slow');
	$('.interview_method').attr("disabled", "disabled");
	$('#training_center').attr("disabled", "disabled");
	$('#audited_by_EA').attr("disabled", "disabled");
	$('#training').fadeOut('fast');
      } else {
       
      }                   
    });

	$('#skill_submit .button').click(function(event) {
		if($('#singaporeskill').is(':checked')||$('#overseasskill').is(':checked'))
  {
	var values = $('#method input:checkbox:checked').map(function() {
    	return this.value;
	}).get();

	if(values==""){
	alert('Please select any interview method.');

    	event.preventDefault();
	}
  }
	});
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
	function historyother(id)
	{     if(id=="country"){
		var countryname=$("#country option:selected").text();
		if(countryname=='Others')
		{
			$('#other_country').show();
		}
		else{
			$('#other_country').hide();
		}
		}
		 if(id=="workarea"){	
		var countryname=$("select#workarea").val(); 
		count=countryname[countryname.length-1];
		if(count=='18')
		{
			$('#other_workarea').show();
		}
		else{
			$('#other_workarea').hide();
		}
		}
		
	}
	function fdwedit(id)
    {
          //  var dat=$('#selectbox_data_'+id).val();
         
      // Then refresh

     //  $("#edit_"+id+" #work_area_history_id_edt").load(location.href+" #edit_"+id+" #work_area_history_id_edt","");
		
		//$(".edit_"+id+".multiselect select").attr('value',values.split(","));
     if($('#update_'+id).hasClass('display_none'))
     {
     	$('#update_'+id).removeClass('display_none');
     }
     else
     {
     		$('#update_'+id).addClass('display_none');
     }

      $('.edit_'+id).each(function(){

      	if($(this).hasClass('display_none')){
      		if($(this).find('select'))
      		{
				var data = $(this).attr('data');
				var valu ='';
				$(this).children('div').children('select').children('option').each(function(){
					if($(this).text()==data)
						{
						 valu = $(this).val();
						}
					});
				$(this).children('select').children('option').each(function(){
					if($(this).text()==data)
						{
						 valu = $(this).val();
						}
					});

				
      			$(this).find('select').val(valu);
      		}
      	$(this).removeClass('display_none');
      }
      else
      {
      	$(this).addClass('display_none');

      }
      });
	  var values=$('.edit_'+id+'.multiselect').attr('selected_values');
			$.each(values.split(","), function(i,e){
			$(".edit_"+id+".multiselect select option[value='" + e + "']").prop("selected", true);
			
		});
      $('.data_'+id).each(function(){

      	if($(this).hasClass('display_none')){
      	$(this).removeClass('display_none');
      }
      else
      {
      	$(this).addClass('display_none');

      }
      })
    }
    function update_data(val)
    {
      var from_month_edt='';
      var to_month_edt='';
      var year_from_edt ='';
      var year_to_edt = '';
      var country_edt = '';
      var employer_edt ='';
      var work_area_history_id_edt = '';
      var employment_remarks_edt ='';
      var employer_feedback_edt ='';
      var item_id ='';
	   item_id = $(val).attr('item_id');  
      var work_area_history_id = []; 
      $('.edit_'+item_id+' #work_area_history_id_edt :selected').each(function(i, selected){ 
        work_area_history_id[i] = $(selected).val(); 
      });
      employment_remarks  = $('.edit_'+item_id+' #employment_remarks_edt').val();  
      work_area_history = work_area_history_id.join(); 
	 from_month_edt=$('.edit_'+item_id+' #from_month_edt').val();
         to_month_edt=$('.edit_'+item_id+' #to_month_edt').val();
         year_from_edt = $('.edit_'+item_id+' #year_from_edt').val();	
    	 year_to_edt = $('.edit_'+item_id+' #year_to_edt').val();	
    	 country_edt = $('.edit_'+item_id+' #country_edt').val();	
    	 employer_edt = $('.edit_'+item_id+' #employer_edt').val();	
      	// employment_remarks_edt = $('#employment_remarks_edt').val();	
    	 employer_feedback_edt = $('.edit_'+item_id+' #employer_feedback_edt').val();	
     // alert(from_month_edt+to_month_edt);
     if(year_from_edt=='')
     {
        alert('Please select Year From.');
        return false;
     }
      if(year_to_edt=='')
     {
        alert('Please select Year To.');
        return false;
     }
      if(country_edt=='')
     {
        alert('Please select Country.');
        return false;
     }
      if(employer_edt=='')
     {
        alert('Please enter Employer Name.');
        return false;
     }

     if(work_area_history=='')
     {
        alert('Please select Work area history.');
        return false;
     }
      $.ajax({
        method: "POST",
        url: "{{ route('sentinel.fdws.updateemploymenthistoryupdate',['id'=>$fdw->id]) }}",
        data: { id:item_id,from_month:from_month_edt,to_month:to_month_edt,date_from:year_from_edt, date_to:year_to_edt,country:country_edt,employer:employer_edt,employment_remarks:employment_remarks,employer_feedback:employer_feedback_edt,work_area_history_id:work_area_history}
        }).done(function( msg ) {
          if(msg==1)
         {
            alert('Updated successfully.');
            location.href="/fdws/"+<?php echo $fdw->id;?>+"/edit?tab=tab2";
         }
         else
         {

            alert('Error: can not upload');
         }
        });


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
    function selecttab(tab){
      $('#selecttab').val(tab);
    }
</script>
<script type="text/javascript">
function validatemoplymenthistory(){
  var fromyear = $('#year_from').val();
  var toyear = $('#year_to').val();
 var frommonth=parseInt($('#from_month').val());
var tomonth=parseInt($('#to_month').val()); //alert(frommonth+tomonth)
  var workareaid = $('#work_area_history_id').val();
  if(fromyear && toyear){
    if(fromyear == toyear){ //alert('hello');
		if(frommonth>tomonth){
		alert('Please select month from less than month to.');
     		 return false;
		}
     
    }
    else if(fromyear > toyear){ 
	 alert('Please select year from less than year to.');
	return false;
    }
    else{
      if(workareaid =='')
      {
        alert('Please select work area for employment history overseas.');
        return false;
      }
    }
  }
}
var _URL = window.URL || window.webkitURL;



</script>
<?php // ini_set("upload_max_filesize","3M"); echo ini_get("upload_max_filesize"); phpinfo(); //print_r($errors); ?>
<h3>Edit FDW Bio data</h3>
<hr/>

<div id="tabs">
    <ul>
      <li><a onclick="selecttab('tab0')" href="#tabs-1"><strong>Part A.</strong> <span style="font-size:0.7em">PROFILE</span></a></li>
      <li><a onclick="selecttab('tab1')" href="#tabs-2"><strong>Part B.</strong> <span style="font-size:0.7em">SKILLS</span></a></li>
      <li><a onclick="selecttab('tab2')" href="#tabs-3"><strong>Part C.</strong> <span style="font-size:0.7em">EMPLOYMENT HISTORY</span></a></li>  
      <li><a onclick="selecttab('tab3')" href="#tabs-4"><strong>Part D.</strong> <span style="font-size:0.7em">OTHER DETAILS</span></a></li>
      <li><a onclick="selecttab('tab4')" href="#tabs-5"><strong>Part E.</strong> <span style="font-size:0.7em">UPLOAD DOCUMENTS</span></a></li>
    <li><a onclick="selecttab('tab5')" href="#tabs-6"><strong>Part F.</strong> <span style="font-size:0.7em">MAID INTRODUCTION </span></a></li>
	<li><a onclick="selecttab('tab6')" href="#tabs-7"><strong>Part G.</strong> <span style="font-size:0.7em">NOTES </span></a></li>
    </ul>
<input type="hidden" name="selecttab" id="selecttab">
<!--FDW Personal Form End-->    
<div id="tabs-1">  
{!! Form::model($fdw,array('route' => array('sentinel.fdws.update', $fdw->id),'enctype'=>'multipart/form-data')) !!}
   <!-- @include('errors.form_error')-->
<div class="small-10 columns">
  <p><span class="mandatory">*</span> Fields are required</p>
</div>

@if(Auth::user()->hasRole(['admin']))
<div class="row">
<div class="small-width18 columns">
    <label for="Name of FDW">Agency:<span class="mandatory">*</span></label>
</div>
<div class="col-xs-5 {{ ($errors->has('users_agents_id')) ? 'error' : '' }}">
    {!! Form::select('users_agents_id', [''=>'Select agency'] + $agencies,$fdw->users_agents_id, ['class' => 'form-control']) !!}
    {!! ($errors->has('users_agents_id') ? $errors->first('users_agents_id', '<small class="error">:message</small>') : '') !!}
</div>
</div> 
 @endif

<div class="row"></div>
     <div class="row">
<div class="small-width18 columns">
    <label for="Name of FDW">Name of FDW: <span class="mandatory">*</span> </label>
</div>
<div class="col-xs-5 {{ ($errors->has('name')) ? 'error' : '' }}">

    {!! Form::text('name', null, ['class'=> 'form-control', 'autocomplete'=>"off"]) !!}
    {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    <label for="Date of birth">Date of birth: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-5 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}">
 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
  {!! Form::select('day', ['' => 'Day'] + array_combine(range(1, 31), range(1, 31)),$fdw->day,['onchange'=> 'return isFutureDate()','id'=>'day']) !!}
 </div>
 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 2px;padding-right: 2px;">
 
 {!! Form::select('month', array('' => 'Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),$fdw->month,['class' => 'field','onchange'=> 'return isFutureDate()','id'=>'month']) !!}
 </div>
 
 <div class="col-xs-4 {{ ($errors->has('date_of_birth')) ? 'error' : '' }}" style="padding-left: 0px;padding-right: 0px;">
 {!! Form::select('year', ['' => 'Year'] + array_combine(range(1950, date('Y')), range(1950,  date('Y'))),$fdw->year,['onchange'=> 'return isFutureDate()','id'=>'year']) !!}
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
    {!! Form::select('nationality', [''=>'Select nationality'] + $nationality,$fdw->nationality, ['class' => 'form-control']) !!}
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
    <label for="Name of port/airport">Name of port/airport:<span class="mandatory">*</span></label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('port_name')) ? 'error' : '' }}">
    {!! Form::text('port_name', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('port_name') ? $errors->first('port_name', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Contact number">Contact number: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('contact_number')) ? 'error' : '' }}">
    {!! Form::text('contact_number', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('contact_number') ? $errors->first('contact_number', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Contact number">Passport number :</label>
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
    {!! Form::text('maid_reference_code', null, ['class'=> 'form-control', 'autocomplete' => 'off']) !!}
    {!! ($errors->has('maid_reference_code') ? $errors->first('maid_reference_code', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Religion">Religion: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('religion')) ? 'error' : '' }}">
     {!! Form::select('religion', array('' => 'Select religion', 
    'Hindu' => 'Hindu', 'Muslim' => 'Muslim', 'Free Thinker'=>'Free Thinker', 'Christian'=>'Christian', 'Catholic'=>'Catholic', 'Buddhist'=>'Buddhist', 'Sikh'=>'Sikh', 'Others'=>'Others'), Input::old('religion')
    ,array('class' => 'form-control')) !!}
    {!! ($errors->has('religion') ? $errors->first('religion', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Education level: <span class="mandatory">*</span> </label>
      </div>
    <div class="col-xs-5 {{ ($errors->has('education_level')) ? 'error' : '' }}">
    {!! Form::select('education_level', [''=>'Select education level'] + $education_levels, $fdw->title, ['class' => 'form-control', 'onchange' => 'fdweducation()','id'=>'fdw_education']) !!}
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
    'New' => 'New', 'Transfer' => 'Transfer','Ex-Singapore'=>'Ex-Singapore'), Input::old('type'),
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
    <label class="radio-inline">{!! Form::radio('marital_status', 'Single', true,['id' => 'marital_radio']) !!} Single</label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Married', null,['id' => 'marital_radio']) !!} Married </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Widowed', null,['id' => 'marital_radio']) !!} Widowed </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Divorced', null,['id' => 'marital_radio']) !!} Divorced </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Separated', null,['id' => 'marital_radio']) !!} Separated </label>
    <label class="radio-inline">{!! Form::radio('marital_status', 'Single Parent', null,['id' => 'marital_radio']) !!} Single Parent </label>
    {!! ($errors->has('marital_status') ? $errors->first('marital_status', '<small class="error">:message</small>') : '') !!}
</div>
</div>
</br>
<div class="row">
<div class="small-width18 columns">
    <label for="Education level">Display Biodata:</label>
      </div>
    <div class="col-xs-5">
     @if($fdw->display_biodata == 'Yes')
                          <label class="radio-inline"><input type="radio" value="Yes" checked="checked" name='display_biodata' > Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name='display_biodata'> No </label>
                          @else
                          <label class="radio-inline"><input type="radio" value="Yes" name='display_biodata'> Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" checked="checked" name='display_biodata'> No </label>
                          @endif
</div>
</div>
</br>
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
@if($fdw->children_age)
  <?php  $childage =  explode(',', $fdw->children_age);
   foreach ($childage as $key => $value) { ?>
     <div class="row">
  <div class="small-width18 columns">
      <label for="Children age">Age of child:<?php echo $key+1; ?></label>
        </div>
      <div class="col-xs-5">
      <input type="text" name="children_age[]" value="<?php echo $value; ?>" class= "form-control childrenage" >
  </div>
  </div>
   <?php }
   ?>
 @endif
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Profile image', 'Profile image:') !!}
      </div>
    <div class="col-xs-8">
      <div style="">
      {!! Form::file('profile_image', ['id'=> 'thumbnail','class'=> 'maid_image']) !!}
      <span class="image-description">Preferred image size 100 X 100 and formats JPEG, PNG, JPG are allowed</span>
      {!! ($errors->has('profile_image') ? $errors->first('profile_image', '<small class="error">:message</small>') : '') !!}
      </div>
  </div>
  <div class="col-xs-1">
      @if($fdw->profile_image)
      <div id="image" style=""><a class="ribbon fa fa-times" href="{{ url('/fdws/'.$fdw->id.'/tumbnailimagedelete/'.$fdw->profile_image)}}"></a><img src="{{ assetnew('uploads/maid_image/'.$fdw->profile_image) }}" title="FDW Image"   height="50px" width="100px"/></div>
      @else
      <div></div>
      @endif
  </div>
</div>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Full body image', 'Full body image:') !!}
      </div>
    <div class="col-xs-8">
      <div style="">
      {!! Form::file('image', ['id'=> 'profile','class'=> 'maid_image']) !!}
      <span class="image-description">Preferred image size 500 X 300 and formats JPEG, PNG, JPG are allowed</span>
      {!! ($errors->has('image') ? $errors->first('image', '<small class="error">:message</small>') : '') !!}
      </div>
    
  </div>
  <div class="col-xs-1">
    @if($fdw->image)
      <div id="image" style="" "><a class="ribbon fa fa-times" href="{{ url('/fdws/'.$fdw->id.'/profileimagedelete/'.$fdw->image)}}"></a><img src="{{ assetnew('uploads/maid_image/'.$fdw->image) }}" title="FDW Image"   height="50px" width="100px"/></div>
      @else
      <div></div>
      @endif
  </div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Upload Profile Document', 'Upload Profile Document:') !!}
      </div>
    <div class="col-xs-8">
      <div style="">
      {!! Form::file('profile_document', ['id'=> 'profile_document','class'=> 'maid_image']) !!}
      <span class="image-description">Preferred image size 2MB and formats pdf, docx, doc are allowed</span>
      {!! ($errors->has('profile_document') ? $errors->first('profile_document', '<small class="error">:message</small>') : '') !!}
      </div>
    </div>
  </div>
 <div class="row">
  <div class="small-width18 columns">&nbsp; </div>
    @if($fdw->profile_document)
    <div class="col-xs-8">
      <div style="">
      <a href="{{ url('uploads/maid_profile/'.$fdw->profile_document) }}" title="FDW profile" target="_new"/>View uploaded profile</a>
      </div>
    </div> 
      @endif
 </div>
<br>
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
      @if($fdw->allergies == 'Yes')
    <input type="checkbox" value="Yes" name="allergies" checked="checked" onchange="showfield()" id="allergies_check">
    @else
    <input type="checkbox" value="Yes" name="allergies" onchange="showfield()" id="allergies_check">
    @endif
    {!! Form::text('allergy_description', null, ['class'=> 'form-control','id'=>'allergies_text']) !!}
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
      <!-- collecting disease in array according to maid -->
      @if($maid_disease)
      @foreach ($maid_disease as $diseaseid => $diseasevalue)
       <?php 
        //print_r($maid_disease[0]); exit;
            $maiddisease[]=$diseasevalue->medical_desieses_id; 
            $description = $diseasevalue->description;
        ?>
      @endforeach
      @else
        <?php $maiddisease[]='test'; 
              $description = '';
        ?>
      @endif
      <!-- end -->
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
          @if(in_array($id, $maiddisease))
              <input type="checkbox" value="<?php echo $id; ?>" name="medical_desieses_id[]" checked="checked">
              {{ $title }}
          @else
          <input type="checkbox" value="<?php echo $id; ?>" name="medical_desieses_id[]">
              {{ $title }}
          @endif    
        </label>
      </div>
        <?php 
          if($count == 4){  
            $count=1;
            }
        ?>   
      @endforeach
      </br>
    <div class="col-xs-5"><label class="checkbox-inline"> 
      @if(in_array('Others', $maiddisease))
          <input type="checkbox" value="Others" name="medical_desieses_id[]" onchange="showfield()" id="med_desieses_other" checked="checked">  Others (if any)
      @else
         <input type="checkbox" value="Others" name="medical_desieses_id[]" onchange="showfield()" id="med_desieses_other">Others (if any)
      @endif  
    </label>
       {!! Form::text('description', $description, ['class'=> 'form-control','id'=>'med_desieses']) !!}
     </div>
</div>
</br>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Physical disabilities', 'Physical disabilities:') !!}
      </div>
    <div class="col-xs-5">
    @if($fdw->physical_disablity == 'Yes')
    <input type="checkbox" value="Yes" name="physical_disablity" checked="checked" onchange="showfield()" id="phy_disabilities_check">
    @else
    <input type="checkbox" value="Yes" name="physical_disablity" onchange="showfield()" id="phy_disabilities_check">
    @endif 
    {!! Form::text('physical_disability_description', null, ['class'=> 'form-control','id'=>'phy_disabilities']) !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Dietary restrictions', 'Dietary restrictions:') !!}
      </div>
    <div class="col-xs-5">
     @if($fdw->dietary_restrictions == 'Yes')
    <input type="checkbox" value="Yes" name="dietary_restrictions" checked="checked" onchange="showfield()" id="die_restrictions_check">
    @else
    <input type="checkbox" value="Yes" name="dietary_restrictions" onchange="showfield()" id="die_restrictions_check">
    @endif
    {!! Form::text('dietary_restrictions_description', null, ['class'=> 'form-control','id'=>'die_restrictions']) !!}
</div>
</div>

<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Food handling preferences', 'Food handling preferences:') !!}
      </div>
    <div class="col-xs-5">
    <label class="checkbox-inline"> 
    <?php $foodhandling = explode(',', $fdw->food_handling_prefrences); ?>
    @if(in_array('Pork',$foodhandling))
    <input type="checkbox" value="Pork" name="food_handling_prefrences[]" checked="checked"> No Pork
    @else
    <input type="checkbox" value="Pork" name="food_handling_prefrences[]"> No Pork
    @endif
    </label>

    <label class="checkbox-inline"> 
    @if(in_array('Beef',$foodhandling))
    <input type="checkbox" value="Beef" name="food_handling_prefrences[]" checked="checked"> No Beef
    @else
    <input type="checkbox" value="Beef" name="food_handling_prefrences[]"> No Beef
    @endif
    </label>
    <label class="checkbox-inline"> 
    @if(in_array('Others',$foodhandling))
    <input type="checkbox" value="Others" name="food_handling_prefrences[]" checked="checked" onchange="showfield()" id="food_handling_check"> Others (if any)
    @else
    <input type="checkbox" value="Others" name="food_handling_prefrences[]" onchange="showfield()" id="food_handling_check"> Others (if any)
    @endif
    </label>
  {!! Form::text('food_handling_preference_other', null, ['class'=> 'form-control','id'=>'food_handling']) !!}
</div>
</div>
</br>
<div class="row">
<div class="small-width18 columns">
    {!! Form::label('Preference for rest day', 'Preference for rest day:') !!}
      </div>
    <div class="col-xs-5">
     {!! Form::select('rest_days_preference', array('' => 'Select rest day(s) per month ',  '0' => '0'
    ,'1' => '1', '2' => '2', '3' => '3', '4' => '4'), Input::old('rest_days_preference'),
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

<div class="row">
<div class="small-10 margin-left columns">
    <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save & Go to List</button>
    <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
</div>
</div>
{!! Form::close() !!}
 </div>

 <!--FDW Personal Form End-->
 <!-- FDW Skill Form Start -->
<div id="tabs-2">
<form method="POST" action="{{ route('sentinel.fdws.updateskill',['id'=>$fdw->id]) }}" accept-charset="UTF-8">
  <div class="row" style="max-width: 100%;">
    <div class="small-10 columns">
      <p><span class="mandatory">*</span> Fields are required</p>
    </div>
  </div>
   <div class="row" style="max-width: 100%;">
    <div class="small-2 columns">
      <label for="Interview Method">Interviewed By: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-9">
	<div class="row">
        <label class="checkbox-inline" id=""> 
          <?php $interview_by = explode(';', $fdw->interviewed_by); //print_r($fdw->interviewed_by); //exit;?>
          @if(in_array('no evaluation',$interview_by))
            <input type="checkbox" value="no evaluation" id="no_evaluation" name="interviewed_by[]" checked="checked">  Based on FDW’s declaration, no evaluation/observation by Singapore EA or overseas training centre/EA
          @else
            <input type="checkbox" value="no evaluation" id="no_evaluation" name="interviewed_by[]">  Based on FDW’s declaration, no evaluation/observation by Singapore EA or overseas training centre/EA
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline" id=""> 
          @if(in_array('Singapore EA',$interview_by))
            <input type="checkbox" value="Singapore EA" id="singaporeskill" name="interviewed_by[]" checked="checked"> Interviewed by Singapore EA 
          @else
            <input type="checkbox" value="Singapore EA" id="singaporeskill" name="interviewed_by[]"> Interviewed by Singapore EA 
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('Overseas Training Centre',$interview_by))
            <input type="checkbox" value="Overseas Training Centre" id="overseasskill" name="interviewed_by[]" checked="checked"> Interviewed by overseas training centre / EA
          @else
            <input type="checkbox" value="Overseas Training Centre" id="overseasskill" name="interviewed_by[]"> Interviewed by overseas training centre / EA
          @endif
        </label>
      </div>
    
       {!! ($errors->has('interviewed_by') ? $errors->first('interviewed_by', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
<div id='training'>
<div class="row">
<div class=" columns">
    <label for="Training Center">Name of Foreign Training Centre / EA:</label>
      </div>
    <div class="col-xs-3" style='padding-left:0px;'>
    {!! Form::text('training_center',  $fdw->training_center, ['class'=> 'form-control', 'autocomplete' => 'off','id'=>'training_center']) !!}
    {!! ($errors->has('training_center') ? $errors->first('training_center', '<small class="error">:message</small>') : '') !!}
</div>
</div>
<div class="row">
<div class=" columns">
    <label for="Audited EA">State if the third party is certified (e.g. ISO9001) or audited periodically by the EA:</label>
      </div>
    <div class="col-xs-3" style='padding-left:0px;'>
    {!! Form::text('audited_by_EA', $fdw->audited_by_EA, ['class'=> 'form-control', 'autocomplete' => 'off','id'=>'audited_by_EA']) !!}
    {!! ($errors->has('audited_by_EA') ? $errors->first('audited_by_EA', '<small class="error">:message</small>') : '') !!}
</div>
</div>
</div>
  <br />
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns">
      <label for="Interview Method">Interview Method: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-5" id='method'>
      <div class="row">
        <label class="checkbox-inline" id=""> 
          <?php $interview_method = explode(';', $fdw->interview_method); ?>
          @if(in_array('Interviewed via telephone / teleconference',$interview_method))
            <input type="checkbox" value="Interviewed via telephone / teleconference" name="interview_method[]" checked="checked" class='interview_method'> Interviewed via telephone / teleconference
          @else
            <input type="checkbox" value="Interviewed via telephone / teleconference" name="interview_method[]" class='interview_method'> Interviewed via telephone / teleconference
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('Interviewed via videoconference',$interview_method))
            <input type="checkbox" value="Interviewed via videoconference" name="interview_method[]" checked="checked" class='interview_method'> Interviewed via videoconference
          @else
            <input type="checkbox" value="Interviewed via videoconference" name="interview_method[]" class='interview_method'> Interviewed via videoconference
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('Interviewed in person',$interview_method))
            <input type="checkbox" value="Interviewed in person" name="interview_method[]" checked="checked" onchange="showfield()" id="food_handling_check" class='interview_method'> Interviewed in person
          @else
            <input type="checkbox" value="Interviewed in person" name="interview_method[]" onchange="showfield()" id="food_handling_check" class='interview_method'> Interviewed in person
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('Interviewed in person and also made observation of FDW in the areas of work',$interview_method))
            <input type="checkbox" value="Interviewed in person and also made observation of FDW in the areas of work" name="interview_method[]" checked="checked" class='interview_method'> Interviewed in person and also made observation of FDW in the areas of work
          @else
            <input type="checkbox" value="Interviewed in person and also made observation of FDW in the areas of work" name="interview_method[]" class='interview_method' > Interviewed in person and also made observation of FDW in the areas of work
          @endif
        </label>
      </div>
       {!! ($errors->has('interview_method') ? $errors->first('interview_method', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <br /> 
  <div id='Singapore'>
  	<div class="row">
    <div class="small-10 columns">
        <p><b> Singapore EA </b></p>
      </div></div>
     
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns" id="">
      {!! Form::label('Skill', 'Skill:') !!}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="skilltable" width="100%">
          <thead>
            <tr id='addr0'>
              <th style="width:20%">Areas of Work</th>
              <th style="width:15%">Willingness</th>
              <th style="width:15%">Experience</th>
              <th style="width:15%">Assessment/Observation</th>
              <th style="width:15%">Comment</th>
            </tr>
          </thead>
          </tbody>
              <?php $radiocounter = 0; //echo '<pre>'; print_r($skillset); exit;?>
                  @foreach ($workarea as $workareaid => $workareavalue)
                  <?php $newskill = 1; $skillvalue=''; ?>
                    @if($workareavalue->otherskill == 'N')
                      @if($skillset) 
                        @foreach ($skillset as $skillid => $skillvalue)
                          @if($skillvalue->work_area_id == $workareavalue->id && $skillvalue->interview_type=='Singapore EA')
                          <?php $newskill = 0; ?>
                            <tr>
                            <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Singapore EA"></td>
                             <td> 
                             @if($workareavalue->title!='Language abilities')
                            @if($skillvalue->willingness == 'Yes') 
                            <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label>
                            @else
                            <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]"> Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > No </label>
                            @endif
                            </td>
                            <td>
                            @if($skillvalue->experience == 'Yes')
                            <label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]"> No </label>
                            @else
                            <label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"> Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]" checked="checked"> No </label>
                            @endif
                            </td>
                            <td>{!! Form::selectRange("rating[]", 1, 5, $skillvalue->rating, ["class" => "form-control"]) !!}</td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"><?php echo $skillvalue->feedback_comment; ?></textarea></td>
                            @else <td></td><td><input type='hidden' name="experience[<?php echo $radiocounter;?>]"  value="No"></td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"><?php echo $skillvalue->feedback_comment; ?></textarea></td>
                            @endif
                           </tr>
                          <?php $radiocounter++; ?>
                          @endif
                         @endforeach 
                        @if($newskill == 1)
                         <tr>
                            <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Singapore EA"></td>
                              @if($workareavalue->title!='Language abilities')
                            <td><label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label></td>
                            <td><label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]"> No </label></td> 
                            <td>{!! Form::selectRange("rating[]", 1, 5, null, ["class" => "form-control"]) !!}</td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td>@else <td></td><td></td><td><input type='hidden' name="experience[<?php echo $radiocounter;?>]"  value="No"></td> <td colspan='4'><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td> @endif
                          </tr>
                          <?php $radiocounter++; ?>
                          @endif
                      @else
                          <tr>
                            <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Singapore EA"></td>
                              @if($workareavalue->title!='Language abilities')
                            <td><label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label></td>
                            <td><label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]"> No </label></td> 
                            <td>{!! Form::selectRange("rating[]", 1, 5, null, ["class" => "form-control"]) !!}</td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td>@else <td></td><td></td><td><input type='hidden' name="experience[<?php echo $radiocounter;?>]"  value="No"></td> <td colspan='4'><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td> @endif
                          </tr>
                          <?php $radiocounter++; ?>
                    @endif
                  @endif
                 @endforeach
                <tr id='addr1'></tr>
          </tbody>
        </table>
        <!--{!! ($errors->has('work_area_id') ? $errors->first('work_area_id', '<small class="error">:message</small>') : '') !!}-->
        <!--<a id="add_row" class="btn btn-default pull-left">Add More</a><a id='delete_row' class="pull-right btn btn-default">Remove</a>-->

  </div>
  </div>
  <br />
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns" id="">
      {!! Form::label('Other Information', 'Other Information:') !!}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="skilltable" width="100%">
          <thead>
            <tr id='addr0'>
              <th style="width:20%">Areas of Work</th>
              <th style="width:15%">Willingness</th>
            </tr>
          </thead>
          </tbody>
          
              @foreach ($workarea as $workareaid => $workareavalue)
                @if($workareavalue->otherskill == 'Y')
                  @if($otherskillset)
                    @foreach ($otherskillset as $skillid => $skillvalue)
                      @if($skillvalue->work_area_id == $workareavalue->id && $skillvalue->interview_type=='Singapore EA')
                        <tr>
                          <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"> <input type="hidden" name="interview_type[]" value="Singapore EA"></td>
                          <td>
                          @if($skillvalue->willingness == 'Yes')
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label>
                          @else
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]"> Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > No </label>
                          @endif
                          </td>
                        </tr><input type='hidden' name="experience[<?php echo $radiocounter;?>]"  value="No">
                      <input type='hidden' name="feedback_comment[]"  value="">
                      <input type='hidden' name="rating[]"  value="1">
                      <?php $radiocounter++; ?>
                    @endif
			 @if($skillvalue->work_area_id == $workareavalue->id && $skillvalue->interview_type!='Singapore EA' && $skillvalue->interview_type!='Overseas EA'  )
                        <tr> 
                          <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Singapore EA">
            </td>
                          <td>
                          @if($skillvalue->willingness == 'Yes')
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label>
                          @else
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]"> Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > No </label>
                          @endif
                          </td>

                        </tr>
                      <?php $radiocounter++; ?>
                    @endif
                  @endforeach
                  @else 
                    <tr>
                      <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Singapore EA"></td>
                      <td><label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                      <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label></td>
                    </tr> <input type='hidden' name="experience[<?php echo $radiocounter;?>]"  value="No">
                    <input type='hidden' name="feedback_comment[]"  value="">
             
              <input type='hidden' name="rating[]"  value="1">
                    <?php $radiocounter++; ?>
                @endif
              @endif  
             
            @endforeach
            <tr id='addr1'></tr>
          </tbody>
        </table>
        <!--{!! ($errors->has('work_area_id') ? $errors->first('work_area_id', '<small class="error">:message</small>') : '') !!}-->
        <!--<a id="add_row" class="btn btn-default pull-left">Add More</a><a id='delete_row' class="pull-right btn btn-default">Remove</a>-->
  </div>
  </div>
  </div> 


 <div id='Overseas'>
 	<div class="row">
    <div class="small-10 columns">
        <p><b> Overseas Training Centre / EA </b></p>
      </div></div>
     
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns" id="">
      {!! Form::label('Skill', 'Skill:') !!}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="skilltable" width="100%">
          <thead>
            <tr id='addr0'>
              <th style="width:20%">Areas of Work</th>
              <th style="width:15%">Willingness</th>
              <th style="width:15%">Experience</th>
              <th style="width:15%">Assessment/Observation</th>
              <th style="width:15%">Comment</th>
            </tr>
          </thead>
          </tbody>
              <?php //echo '<pre>'; print_r($workarea); exit;?>
                  @foreach ($workarea as $workareaid => $workareavalue)
                  <?php $newskill = 1; ?>
                    @if($workareavalue->otherskill == 'N')
                      @if($skillset)
                        @foreach ($skillset as $skillid => $skillvalue)
                          @if($skillvalue->work_area_id == $workareavalue->id && $skillvalue->interview_type=='Overseas EA')
                          <?php $newskill = 0; ?>
                            <tr>
                            <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Overseas EA"> </td>
                             <td> 
                             @if($workareavalue->title!='Language abilities')
                            @if($skillvalue->willingness == 'Yes') 
                            <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label>
                            @else
                            <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]"> Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > No </label>
                            @endif
                            </td>
                            <td>
                            @if($skillvalue->experience == 'Yes')
                            <label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]"> No </label>
                            @else
                            <label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"> Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]" checked="checked"> No </label>
                            @endif
                            </td>
                            <td>{!! Form::selectRange("rating[]", 1, 5, $skillvalue->rating, ["class" => "form-control"]) !!}</td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"><?php echo $skillvalue->feedback_comment; ?></textarea></td>
                            @else <td></td><td></td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"><?php echo $skillvalue->feedback_comment; ?></textarea></td>
                            @endif
                           </tr>
                          <?php $radiocounter++; ?>
                          @endif
                         @endforeach 
                        @if($newskill == 1)
                         <tr>
                            <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Overseas EA"></td>
                              @if($workareavalue->title!='Language abilities')
                            <td><label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label></td>
                            <td><label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]"> No </label></td> 
                            <td>{!! Form::selectRange("rating[]", 1, 5, null, ["class" => "form-control"]) !!}</td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td>@else <td></td><td></td><td></td> <td colspan='4'><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td> @endif
                          </tr>
                          <?php $radiocounter++; ?>
                          @endif
                      @else
                          <tr>
                            <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Overseas EA"></td>
                              @if($workareavalue->title!='Language abilities')
                            <td><label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label></td>
                            <td><label class="radio-inline"> <input type="radio" value="Yes" name="experience[<?php echo $radiocounter;?>]"checked="checked" > Yes</label>
                            <label class="radio-inline"><input type="radio" value="No" name="experience[<?php echo $radiocounter;?>]"> No </label></td> 
                            <td>{!! Form::selectRange("rating[]", 1, 5, null, ["class" => "form-control"]) !!}</td>
                            <td><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td>@else <td></td><td></td><td></td> <td colspan='4'><textarea name="feedback_comment[]" style="width:140px; height:90px;" class="form-control"></textarea></td> @endif
                          </tr>
                          <?php $radiocounter++; ?>
                    @endif
                  @endif 
                 @endforeach
                <tr id='addr1'></tr>
          </tbody>
        </table>
        <!--{!! ($errors->has('work_area_id') ? $errors->first('work_area_id', '<small class="error">:message</small>') : '') !!}-->
        <!--<a id="add_row" class="btn btn-default pull-left">Add More</a><a id='delete_row' class="pull-right btn btn-default">Remove</a>-->
  </div>
  </div>
   <br />
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns" id="">
      {!! Form::label('Other Information', 'Other Information:') !!}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="skilltable" width="100%">
          <thead>
            <tr id='addr0'>
              <th style="width:20%">Areas of Work</th>
              <th style="width:15%">Willingness</th>
            </tr>
          </thead>
          </tbody>
          
              @foreach ($workarea as $workareaid => $workareavalue)
                @if($workareavalue->otherskill == 'Y')
                  @if($otherskillset)<?php //echo '<pre>'; print_r($skillset); exit;?>
                    @foreach ($otherskillset as $skillid => $skillvalue)
                      @if($skillvalue->work_area_id == $workareavalue->id&& $skillvalue->interview_type=='Overseas EA')
                        <tr>
                          <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Overseas EA">
            </td>
                          <td>
                          @if($skillvalue->willingness == 'Yes')
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label>
                          @else
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]"> Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > No </label>
                          @endif
                          </td>

                        </tr>
                      <?php $radiocounter++; ?>
                    @endif
		 @if($skillvalue->work_area_id == $workareavalue->id && $skillvalue->interview_type!='Singapore EA' && $skillvalue->interview_type!='Overseas EA')
                        <tr>
                          <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Overseas EA">
            </td>
                          <td>
                          @if($skillvalue->willingness == 'Yes')
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label>
                          @else
                          <label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]"> Yes</label>
                          <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > No </label>
                          @endif
                          </td>

                        </tr>
                      <?php $radiocounter++; ?>
                    @endif
                  @endforeach
                  @else
                    <tr>
                      <td>{!! $workareavalue->title !!}<input type="hidden" name="work_area_id[]" value="<?php echo $workareavalue->id; ?>"><input type="hidden" name="interview_type[]" value="Overseas EA"></td>
                      <td><label class="radio-inline"><input type="radio" value="Yes" name="willingness[<?php echo $radiocounter;?>]" checked="checked" > Yes</label>
                      <label class="radio-inline"><input type="radio" value="No" name="willingness[<?php echo $radiocounter;?>]" > No </label></td>
                    </tr>
                    <?php $radiocounter++; ?>
                @endif
              @endif 
			 @endforeach
            <tr id='addr1'></tr>
          </tbody>
        </table>
        <!--{!! ($errors->has('work_area_id') ? $errors->first('work_area_id', '<small class="error">:message</small>') : '') !!}-->
        <!--<a id="add_row" class="btn btn-default pull-left">Add More</a><a id='delete_row' class="pull-right btn btn-default">Remove</a>-->
  </div>
  </div>
  </div> 

 
<div style="margin-top:20px;"class="row" id="skill_submit">
<div class="small-10 columns" style=" margin-left:15.3%;" >
    <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save & Go to List</button>
    <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
</div>
</div>
</form>
</div>
 <!-- FDW Skill Form End -->
  <!-- FDW History Form Start -->
<div id="tabs-3">
<form method="POST" action="{{ route('sentinel.fdws.updateemploymenthistory',['id'=>$fdw->id]) }}" accept-charset="UTF-8">
  <div class="row" style="max-width: 100%;">
  <div class="small-10 columns">
    <p><span class="mandatory">*</span> Fields are required</p>
  </div>
  </div>
  <div class="row" style="max-width: 100%;">
    <div class="table-responsive">
        <table class="table table-bordered" id="historytable">
          <thead>
            <tr id='addrhistory0'>
              <th colspan="2" style="width:41%">
       <div class="col-xs-3">month From <span class="mandatory">*</span></div> <div class="col-xs-3">Year From <span class="mandatory">*</span></div>
<div class="col-xs-3">month to <span class="mandatory">*</span></div>
<div class="col-xs-3"> Year To <span class="mandatory">*</span></div></th>
              <th style="width:15%">Country <span class="mandatory">*</span></th>
              <th style="width:15%">Employer <span class="mandatory">*</span></th>
              <th style="width:20%">Work duties <span class="mandatory">*</span></th>
              <th style="width:7%">Remarks</th>
              <th style="width:7%">Feedback</th>
         <th style="width:5%">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $workarealist = array(); ?>
          @foreach($workarea as $index => $val)
            @if($val->otherskill == 'N')
            <?php  $workarealist[$val->id] = $val->title; ?>
            @endif
          @endforeach
          <?php $educationrowcounter = 0; ?>
              @foreach ($employmenthistory as $employmenthistoryid => $employmenthistoryvalue)
                 <tr>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}' data='{!! $employmenthistoryvalue->date_from !!}'><div class="col-xs-6" style="padding:0px;"> {!! Form::select('from_month', array('' => 'Select Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),$employmenthistoryvalue->from_month,['class' => 'field','id'=>'from_month_edt']) !!}</div>
 <div class="col-xs-6" style="padding:0px;"> {!! Form::select("date_from",['' => 'Select year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),$employmenthistoryvalue->date_from,["id" => "year_from_edt"]) !!}</div></span>
                <span class='data_{{$employmenthistoryvalue->id}}'> <?php echo date('M',mktime(null,null,null, $employmenthistoryvalue->from_month+1,null)); ?>/{!! $employmenthistoryvalue->date_from !!}</span></td>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}' data='{!! $employmenthistoryvalue->date_to !!}'> <div class="col-xs-6" style="padding:0px;">{!! Form::select('to_month', array('' => 'Select Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),$employmenthistoryvalue->to_month,['class' => 'field','id'=>'to_month_edt']) !!}</div>
<div class="col-xs-6" style="padding:0px;">{!! Form::select("date_to",['' => 'Select year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),$employmenthistoryvalue->date_to,["id" => "year_to_edt"]) !!}</div></span><span class='data_{{$employmenthistoryvalue->id}}'> <?php echo date('M',mktime(null,null,null, $employmenthistoryvalue->to_month+1,null)); ?>/{!! $employmenthistoryvalue->date_to !!}</span></td>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}' data='{!! $employmenthistoryvalue->countryname !!}'>{!! Form::select("country", [""=>"Select country"]  + $countries, $employmenthistoryvalue->countryname, ["class" => "form-control workareaselect","id" => "country_edt"]) !!}</span><span class='data_{{$employmenthistoryvalue->id}}'> @if($employmenthistoryvalue->countryname=="Others"){!! $employmenthistoryvalue->other_country !!} @else{!! $employmenthistoryvalue->countryname !!}@endif</span></td>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}'><input type="text" value='<?php echo  $employmenthistoryvalue->employer;?>' id='employer_edt'  name="employer" class= "form-control" style= "margin-top: 0 !important;" ></span><span class='data_{{$employmenthistoryvalue->id}}'>{!! $employmenthistoryvalue->employer !!}</span></td>
                  <?php if($employmenthistoryvalue->workareaname) {
                    $remove = array(';'); 
                    $historyworkarea = str_replace($remove,', ',$employmenthistoryvalue->workareaname); 
					$historyworkareaid = str_replace($remove,', ',$employmenthistoryvalue->workareaid); 
				    $historyworkareaid =  explode(',',$historyworkareaid);
					
                    ?>
                  <td><span selected_values='<?=$string = str_replace(' ', '',implode(',',$historyworkareaid));?>' class=' edit_{{$employmenthistoryvalue->id}} multiselect display_none'data='{!! $historyworkarea !!}' >
				  <select multiple="multiple" name="work_area_history_id[]" id="work_area_history_id_edt">
						<option>Select work area</option>
						@foreach($workarealist as $aKey => $aSport)
							
								<option value="{{$aKey}}"><?php// if(in_array("$aKey", $historyworkareaid)){echo 'selected';}?>{{str_replace(' ', '',$aSport)}}</option>
							
						@endforeach
					</select>
				  
				  
				  
				  
			</span> <span class='data_{{$employmenthistoryvalue->id}}'>{!! $historyworkarea !!}<input type='hidden' id='selectbox_data_{{$employmenthistoryvalue->id}}' value='<?= $historyworkarea;?>'></span></td>
                  <?php } else {?>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}' >{!! Form::select("work_area_history_id[]", [""=>"Select work area"] + $workarealist, null, ["class" => "form-control workareaselect","multiple"=>"true","id"=>"work_area_history_id_edt"]) !!}</span> </td>
                  <?php } ?>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}'><textarea id="employment_remarks_edt" name="employment_remarks" style="width:140px; height:90px;margin-top: 0 !important;">{{$employmenthistoryvalue->employment_remarks}}</textarea></span><span class='data_{{$employmenthistoryvalue->id}}'>{!! $employmenthistoryvalue->employment_remarks !!}</span></td>
                  <td><span class='display_none edit_{{$employmenthistoryvalue->id}}'><textarea id='employer_feedback_edt' name="employer_feedback" style="width:140px; height:90px;margin-top: 0 !important;">{!! $employmenthistoryvalue->employer_feedback !!}</textarea></span><span class='data_{{$employmenthistoryvalue->id}}'>{!! $employmenthistoryvalue->employer_feedback !!}</span></td>
                  <td>
                  <a onclick="return fdwedit({{$employmenthistoryvalue->id}});"><img src="{{ asset('uploads/edit.png') }}" title="FDW Image"   height="20px" width="20px"/></a>

                  <a onclick="return confirmdelete();" href="{{  url('/fdws/'.$employmenthistoryvalue->maid_id.'/maidemploymentdelete/'.$employmenthistoryvalue->id)}}"><img src="{{ asset('uploads/delete.png') }}" title="FDW Image"   height="20px" width="20px"/></a>
                  <button style='margin-top: 10px; padding: 5px;' type='button' onclick='update_data(this);' value='update' item_id='{{$employmenthistoryvalue->id}}'  id='update_{{$employmenthistoryvalue->id}}' class='display_none'>update</button>
                  </td>
                </tr>
                <?php $educationrowcounter++; ?>
                @endforeach
            <tr>
                <td><div class="col-xs-6" style="padding:0px;">
 {!! Form::select('from_month', array('' => 'Select Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field','id'=>'from_month']) !!}</div><div  class="col-xs-6" style="padding:0px;">
 {!! Form::select("date_from",['' => 'Select year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),null,["id" => "year_from"]) !!}</div></td>
                <td><div class="col-xs-6" style="padding:0px;">{!! Form::select('to_month', array('' => 'Select Month', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),null,['class' => 'field','id'=>'to_month']) !!}</div><div class="col-xs-6" style="padding:0px;">{!! Form::select("date_to",['' => 'Select year'] + array_combine(range(1950, date('Y')), range(1950, date('Y'))),null,["id" => "year_to"]) !!}</div></td>
                <td>{!! Form::select("country", [""=>"Select country"]  + $countries, null, ["class" => "form-control workareaselect", 'onchange' => 'historyother(this.id)','id' => 'country']) !!}
                 {!! Form::text('other_country', null, ['class'=> 'form-control','id'=>'other_country']) !!}</td>
                <td><input type="text" name="employer" class= "form-control" style= "margin-top: 0 !important;" ></td>
                <td>{!! Form::select("work_area_history_id[]", [""=>"Select work area"] + $workarealist, null, ["class" => "form-control workareaselect","multiple"=>"true","id"=>"workarea", 'onchange' => 'historyother(this.id)']) !!}
			{!! Form::text('other_workarea', null, ['class'=> 'form-control','id'=>'other_workarea']) !!}</td>
                <td><textarea name="employment_remarks" style="width:140px; height:90px;margin-top: 0 !important;"></textarea></td>
        <td><textarea name="employer_feedback" style="width:140px; height:90px;margin-top: 0 !important;"></textarea></td>
        <td><button onClick = 'return validatemoplymenthistory()' class="button small" type="submit" id="cancel" name="submit" value="list">Save</button></td>
      </tr>
            <tr id='addrhistory1'></tr>
          </tbody>
        </table>
        {!! ($errors->has('date_from') ? $errors->first('date_from', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('date_to') ? $errors->first('date_to', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('country') ? $errors->first('country', '<small class="error">:message</small>') : '') !!}
        {!! ($errors->has('employer') ? $errors->first('employer', '<small class="error">:message</small>') : '') !!}
        <!--<a id="add_row_history" class="btn btn-default pull-left">Add More</a><a id='delete_row_history' class="pull-right btn btn-default">Remove</a>-->
  </div>
  </div>
 

  <div style="margin-top:20px;"class="row">
  <div class="small-10 margin-left columns">

    <button onClick = 'return validatemoplymenthistory()' class="button small" type="submit" id="cancel" name="submit_next" value="next"> Next</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
  </div>
  </div>
 </form>
</div>
 <!-- FDW History Form End -->
<script type="text/javascript">
function removenoavailchecked(){
    $('#notavail').prop('checked', false);
}
  function removeotherchecked(){
    if($("#notavail").prop('checked') == true){
     $('.uncheck').prop('checked', false);
    }    //; // Checks it
  }
</script>
 <div id="tabs-4">
  <form method="POST" action="{{ route('sentinel.fdws.updateother',['id'=>$fdw->id]) }}" accept-charset="UTF-8">
  <div class="row" style="max-width: 100%;">
    <div class="small-10 columns">
      <p><span class="mandatory">*</span> Fields are required</p>
    </div>
  </div>
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns">
      <label for="Available for interview via">Available for interview via: <span class="mandatory">*</span> </label>
    </div>
    <div class="col-xs-5">
      <div class="row">
        <label class="checkbox-inline" id=""> 
          <?php $can_be_interviewed_via = explode(';', $fdw->can_be_interviewed_via); ?>
          @if(in_array('Telephone / Teleconference',$can_be_interviewed_via))
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="Telephone / Teleconference" name="can_be_interviewed_via[]" checked="checked"> Telephone / Teleconference
          @else
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="Telephone / Teleconference" name="can_be_interviewed_via[]"> Telephone / Teleconference
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('Videoconference',$can_be_interviewed_via))
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="Videoconference" name="can_be_interviewed_via[]" checked="checked"> Videoconference
          @else
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="Videoconference" name="can_be_interviewed_via[]"> Videoconference
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('In person',$can_be_interviewed_via))
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="In person" name="can_be_interviewed_via[]" checked="checked" onchange="showfield()" id="food_handling_check"> In person
          @else
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="In person" name="can_be_interviewed_via[]" onchange="showfield()" id="food_handling_check"> In person
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('In person with observation in the areas of work',$can_be_interviewed_via))
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="In person with observation in the areas of work" name="can_be_interviewed_via[]" checked="checked" > In person with observation in the areas of work 
          @else
            <input type="checkbox" class='uncheck' onchange="removenoavailchecked()" value="In person with observation in the areas of work" name="can_be_interviewed_via[]" > In person with observation in the areas of work 
          @endif
        </label>
      </div>
      <div class="row">
        <label class="checkbox-inline"> 
          @if(in_array('Not available',$can_be_interviewed_via))
            <input type="checkbox" id='notavail' onchange="removeotherchecked()" value="Not available" name="can_be_interviewed_via[]" checked="checked" > Not available
          @else
            <input type="checkbox" id='notavail' onchange="removeotherchecked()" value="Not available" name="can_be_interviewed_via[]" > Not available 
          @endif
        </label>
      </div>
      {!! ($errors->has('can_be_interviewed_via') ? $errors->first('can_be_interviewed_via', '<small class="error">:message</small>') : '') !!}
    </div>
  </div>
  <br/>
  <div class="row" style="max-width: 100%;">
    <div class="small-2 columns">
    {!! Form::label('Other remarks', 'Other remarks:') !!}
    </div>
    <div class="table-responsive">
  <textarea rows="10" cols="10" name="overall_remarks" style="width: 645px; height: 150px;"><?php echo $fdw->overall_remarks; ?></textarea>
    </div>
  </div>

  <div style="margin-top:20px;"class="row">
  <div class="small-10 columns" style="margin-left:15%;">
       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save & Go to List</button>
      <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
  </div>
  </div>
</form>
 </div>  
 <div id="tabs-5">
    <form method="POST" action="{{ route('sentinel.fdws.updatedocument',['id'=>$fdw->id]) }}" accept-charset="UTF-8" enctype='multipart/form-data'>
      <div class="small-8 large-centered columns">
          <div class="table-responsive">
                <table class="table table-bordered" id="contactcontent" width="100%">
                      <thead>
                          <tr id='addcontact0'>
                                <th class='text-center'>Upload Necessary Documents</th>
                            </tr>
                              </thead>
                      <tbody>
                              <tr>
                                  <td>
                                  <ul>
                                  <li><span class="">1. Document formats jpeg, bmp, png, jpg, pdf, doc, docx, txt are allowed.</span></li>
                                  <li><span class="">2. Use CTRL for multiple file upload.</span></li>
                                  <li><span class="">3. Maximum file size for upload 2 MB each.</span></li>
                                  </ul>
                                  <div style=" margin: 0 auto;width:60%;">
                                            {!! Form::file('document[]', array('multiple'=>true,'class'=> 'maid_image')) !!}
                                            {!! ($errors->has('document') ? $errors->first('document', '<small class="error">:message</small>') : '') !!}
                                        </div>
                                        <div style="margin-top:20px;"class="row">
                                            <div class="small-10 small-offset-2 columns">
                                                 <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save</button>
                                              {!! Form::reset('Reset', array('class' => 'button small')) !!}
                                               <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                                            </div>
                                      </div>
                                  </td>
                              </tr>
                      </tbody>
                </table>
          </div>
      </div>
      </br>
      <div class="small-8 large-centered columns">
      <div class="table-responsive">
                        <table class="table table-bordered" id="contactcontent" width="100%">
                              <thead>
                                <tr id='addcontact0'>
                                  <th style="width:20%">Document</th>
                                  <th style="width:15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                    @if($maid_document)
                                        @foreach($maid_document as $id => $value)
                                          <?php $extension = explode('.', $value->title);
                                           ?>
                                          <tr>
                                              <td>
                                              @if($extension[2] == 'jpeg' || $extension[2] == 'png' || $extension[2] == 'bmp' || $extension[2] == 'jpg' || $extension[2] == 'JPEG' || $extension[2] == 'PNG' || $extension[2] == 'BMP' || $extension[2] == 'jpg')
                                              <img height='100px' width='100px' src="{{ assetnew('uploads/maid_document/'.$value->title) }}"></td>
                                              @else
                                              <p><a title="Click to see document" href="{{  url('/fdws/view/'.$value->title)}}"> <?php $title = explode('.', $value->title, 2); ?>{{$title[1]}}</a></p>
                                              @endif
                                              <td><a href="{{  url('/fdws/'.$value->maid_id.'/documentdelete/'.$value->id)}}" onclick="return confirmdelete();">
                                              <img src="{{ asset('uploads/delete.png') }}" title="Delete Document"   height="20px" width="20px"/></a></td>
                                          </tr>
                                          @endforeach
                                    @else
                                          <tr>
                                              <td colspan='2' class="text-center">No Document Found.</td>
                                          </tr>
                                    @endif      
                              </tbody>
                        </table>
                      </div>
                      </div>
    </form>  
  </div>
   <div id="tabs-6">
    <form method="POST" action="{{ route('sentinel.fdws.updateintro',['id'=>$fdw->id]) }}" accept-charset="UTF-8">
   <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW"> Introduction : <span class="mandatory">*</span> </label>
                    </div>
                    <div class="col-xs-7">
                       <textarea rows="10" cols="10" id='intro' name="intro" style="width: 645px; height: 150px;" placeholder="Write your content.." >{{$fdw->intro}}</textarea>
                      {!! ($errors->has('intro') ? $errors->first('intro', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
         <div style="margin-top:20px;"class="row">
  <div class="small-10 columns" style="margin-left:15%;">
       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save & Go to List</button>
      <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
  </div>
  </div>
</form>
   </div> 
<div id="tabs-7">
    <form method="POST" action="{{ route('sentinel.fdws.updatenotes',['id'=>$fdw->id]) }}" accept-charset="UTF-8">
   <div class="row" style="max-width: 100%;">
                    <div class="small-width18 columns">
                    <label for="Name of FDW"> Note For Maid : </label>
                    </div>
                    <div class="col-xs-7">
                       <textarea rows="10" cols="10" id='note_for_maid' name="note_for_maid" style="width: 645px; height: 150px;" placeholder="Write your content.." >{{$fdw->note_for_maid}}</textarea>
                      {!! ($errors->has('note_for_maid') ? $errors->first('note_for_maid', '<small class="error">:message</small>') : '') !!}
                    </div>      
                </div>
         <div style="margin-top:20px;"class="row">
  <div class="small-10 columns" style="margin-left:15%;">
       <button  class="button small" type="submit" id="cancel" name="submit_list" value="list">Save & Go to List</button>
      <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save</button>
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
     <button onclick="window.location='{{ url("fdws") }}'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
  </div>
  </div>
</form>
   </div> 
@stop
