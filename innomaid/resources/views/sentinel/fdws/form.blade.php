<div class="row">
<div class="small-2 columns">
    {!! Form::label('Name of FDW', 'Name of FDW:') !!}
</div>
<div class="small-10 columns">
    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
</div>
</div>

<div class="row">
<div class="small-2 columns">
    {!! Form::label('Date of birth', 'Date of birth:') !!}
    </div>
    <div class="small-10 columns">
    {!! Form::text('date_of_birth', null, ['class'=> 'form-control','id'=>'date_of_birth']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Place of birth', 'Place of birth:') !!}
      </div>
    <div class="small-10 columns">
  {!! Form::select('place_of_birth', [''=>'Select place of birth'] + $countries, ['class' => 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Height', 'Height (cm):') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('height', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Weight', 'Weight (kg):') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('weight', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Nationality', 'Nationality:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::select('nationality', [''=>'Select nationality'] + $nationality, ['class' => 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Address', 'Address:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('address', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Name of port/airport', 'Name of port/airport:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('port_name', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Contact number', 'Contact number:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('contact_number', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Religion', 'Religion:') !!}
      </div>
    <div class="small-10 columns">
     {!! Form::select('religion', array('0' => 'Select religion', 
    'Hindu' => 'Hindu', 'Muslim' => 'Muslim'), Input::old('religion'),
    array('class' => 'form-control')) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Education level', 'Education level:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('education_level', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('No. of siblings', 'No. of siblings:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('no_of_siblings', null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('Marital status', 'Marital status:') !!}
      </div>
    <div class="small-10 columns">
    Married {!! Form::radio('marital_status', 'Married', true) !!}
    Un-married {!! Form::radio('marital_status', 'Un-married') !!}
    Widow {!! Form::radio('marital_status', 'Widow') !!}
    
</div>
</div>
<div class="row">
<div class="small-2 columns">
    {!! Form::label('No. of children', 'No. of children:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('no_of_children', null, ['class'=> 'form-control']) !!}
</div>
</div>

<div class="row">
<div class="small-2 columns">
    {!! Form::label('Children age', 'Children age:') !!}
      </div>
    <div class="small-10 columns">
    {!! Form::text('children_age', null, ['class'=> 'form-control']) !!}
</div>
</div>

<div class="row">
<div class="small-2 columns">
    {!! Form::label('Profile image', 'Profile image:') !!}
      </div>
    <div class="small-10 columns" style="width:50%">
   	{!! Form::file('image') !!}
   
</div>
</div>
@if(Route::current()->getName() == 'fdws/create')
    Hello This is testing
    @else
    no
    @endif
<div class="row">
<div class="small-10 small-offset-2 columns">
    {!! Form::submit($submitTextButton, array('class' => 'button small')) !!}
    {!! Form::reset('Reset', array('class' => 'button small')) !!}
</div>