<div style="float:left; margin-bottom:10px">@if($data[0]->image)<img style = "height:50px; width:50px;"src="{{ assetnew('uploads/agency_logo/'.$data[0]->image) }}" />@endif</div>
<div class="table-responsive">
    <table border="0" class="table">
      <tbody>
        <tr>
          <th valign="top" align="right">Agency Name</th>
          <td valign="top" align="left">{{$data[0]->company_name}}</td>
        </tr>
        <tr>
          <th valign="top" align="right">License#</th>
          <td valign="top" align="left">{{$data[0]->license_no}}</td>
        </tr>
        <tr>
          <th valign="top" align="right">Email</th>
          <td valign="top" align="left"><a href="mailto:{{$data[0]->email}}">{{$data[0]->email}}</a></td>
        </tr>
        <tr>
          <th valign="top" align="right">Website</th>
          <td valign="top" align="left">@if($data[0]->website)<a href="{{$data[0]->website}}">{{$data[0]->website}}@else - @endif</a></td>
        </tr>
        <tr>
          <th nowrap="" valign="top" align="right">Address</th>
          <td valign="top" align="left"> {{$data[0]->address}}</td>
        </tr>
        <tr>
            <th valign="top" align="right">Opening Hour</th>
            <td valign="top" align="left">
            <table>
            <tbody>
           
            @foreach($agency_opertaing_info as $id => $value)  <tr>
            <td valign="top" align="left">{{$value->operating_day}}&nbsp</td>
            <td valign="top" align="right">{{$value->operating_hrs_from}}{{'-'}}{{$value->operating_hrs_to}}</td>
              </tr>@endforeach
          
            </tbody>
            </table>
            </td>
        </tr>
        <tr>
            <th valign="top" align="right">Tel</th>
            <td valign="top" align="left">@if($data[0]->telephone){{ $data[0]->telephone}}@else - @endif</td>
        </tr>
        <tr>
            <th valign="top" align="right">Fax</th>
            <td valign="top" align="left">@if($data[0]->fax){{ $data[0]->fax}}@else - @endif</td>
        </tr>
        <tr>
            <th valign="top" align="right">Contact</th>
            <td nowrap="" valign="top" align="left">@if($data[0]->contact_name){{ $data[0]->contact_name}} @else - @endif</td>
        </tr>
      </tbody>
    </table>
</div>

