<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Innomaid</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<?php $path = public_path(); ?>
<style type="text/css">

body {
    color: #333;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857;
}
.h3, h3 {
    font-size: 24px;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: inherit;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1;
    height: 0;
}
.fkm-heading {
    text-align:center
}
.fkm-heading h4, h5 {
    font-size: 20px;
    font-weight: bold;
   
}
.personal-info-2 label {
    width: 100%;
}
label {
    display: inline-block;
    font-weight: 700;
    margin-bottom: 5px;
    max-width: 100%;
}

.notbold {
    font-weight: 100;
}
.table-bordered {
    border: 1px solid #ddd;
}
.table {
    margin-bottom: 20px;
    max-width: 100%;
    width: 100%;
}
table {
    background-color: transparent;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #ddd;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    line-height: 1.42857;
    padding: 8px;
    vertical-align: top;
}
</style>
<body style="background:white;">
  <div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
      <div class="col-sm-9 col-md-11 main navi-right" style="background:white !important">
        <div id="demo" class="collapse">
          <div class="col-md-10 col-md-offset-1 form-box-popup">
          </div>               
        </div>
        <div class="row" style="margin-bottom:20px;"> 
          <div style="overflow:hidden;">
            <div>
              <div><!--header-->
                <div class="fkm-heading">
                </div>
              </div>
              <div class="fkm-heading"><h3>{{strtoupper($agency_detail[0]->company_name)}} EMPLOYMENT AGENCY (License No: {{$agency_detail[0]->license_no}})</h3><br />
                 Services and Fees Schedule<br />
                  for 
                  @if($servicefees[0]->form_type == 'New Transfer') 
                  New/Transfer*
                  @else 
                  Replacement
                  @endif 
                  of FDW
              </div>
              <br />
              <div style="clear:both;"></div>
                <h5 style="float:left; width: 100%;">PART A: Particulars of FDW Selected</h5>
                 <table width="70%"> 
                    <tbody>      
                      <tr>
                        <td>Name of FDW Selected:</td>
                        <td>{{$maid_details[0]->name}}</td>
                        <td>Date:</td>
                        <td>@if( $servicefees[0]->date =='0000-00-00')
                          {{ '' }}
                          @else
                          {{  date("d M Y", strtotime($servicefees[0]->date)) }}
                          @endif</td>
                      </tr>
                      <tr>
                        <td>Nationality:</td>
                        <td>{{$maid_details[0]->nationality}}</td>
                      </tr>
                    </tbody>
                </table> 
                      <h5 style="float:left">PART B: Service Fee</h5>
                      <h4>The Service Fee shall include the following:</h4>

                <table class="table table-bordered">
                    <tr>
                      <td style='width:10%'><b>S/No</b>
                      </td>
                      <td><b>Name of Service</b>
                      </td>
                      <td style='width:10%'><b>Price (S$)</b>
                      </td>
                    </tr>
			<tr><td></td>1 <td> Service Fee </td>
                           <td> {{$servicefees[0]->service_fee}}</td>
			</tr>
                    <?php $sno=2;
                      $totalprice = 0;
                      $data = 'no';
                     ?>
                    @foreach($agencymaidservice as $agency_maid_service_id => $agency_maid_service_value)           
                      @if($agency_maid_service_value->type == 'S')
                      <?php $data = 'yes'; ?>
                        <tr>
                          <td>{{$sno}}
                          </td>
                          <td>{{$agency_maid_service_value->title}}
                          </td>
                          <td>{{$agency_maid_service_value->service_cost}}
                          </td>
                        </tr>
                        <?php $sno++; $totalprice =  $agency_maid_service_value->service_cost + $totalprice;?>
                      @endif
                    @endforeach
                    @if($data == 'no')
                      <tr>
                        <td colspan="3" style="text-align:center">No service available.
                        </td>
                      </tr>
                    @endif
                </table>

                @if($servicefees[0]->form_type == 'New Transfer')
                <h4>Cost for Replacement within the Maximum Replacement Period of {{$servicefees[0]->month}} *months/years @if(count($replacementcost) == 0) <?php echo 'n/a'; ?> @endif</h4>
                <table class="table table-bordered">
                    @foreach($replacementcost as $replacement_cost_id => $replacement_cost_value)           
                        <tr>
                          <td>{{$replacement_cost_value->replacement_number}}
                          </td>
                          <td style="text-align:center">replacement within</td>
                          <td>{{$replacement_cost_value->replacement_month}}
                          </td>
                          <td style="text-align:center">months</td>
                          <td style='width:10%'>{{$replacement_cost_value->cost}}
                          </td>
                        </tr>
                        <?php $totalprice =  $replacement_cost_value->cost + $totalprice;?>
                    @endforeach
                </table>
                @endif
                <h4>Other Services Provided (where applicable)</h4>
                <table class="table table-bordered">
                    <tr>
                      <td style='width:10%'><b>S/No</b>
                      </td>
                      <td><b>Name of Service</b>
                      </td>
                      <td style='width:10%'><b>Price (S$)</b>
                      </td>
                    </tr>
                    <?php $sno=1; 
                      $data = 'no';
                    ?>
                    @foreach($agencyotherservice as $agency_other_service_id => $agency_other_service_value)           
                      <?php $data = 'yes'; ?>  
                        <tr>
                          <td>{{$sno}}
                          </td>
                          <td>{{$agency_other_service_value->other_service_title}}
                          </td>
                          <td>{{$agency_other_service_value->other_service_price}}
                          </td>
                        </tr>
                        <?php $sno++; $totalprice =  $agency_other_service_value->other_service_price + $totalprice; ?>
                    @endforeach
                    @if($data == 'no')
                      <tr>
                        <td colspan="3" style="text-align:center">No other service available.
                        </td>
                      </tr>
                    @endif
                </table>
                <table class="table table-bordered">
                  <tr>
                    <td style="text-align:right"><strong>Total Package Service Fee: </strong></td>
                    <td style="width:10%">{{$totalprice}}</td>
                  </tr>
                </table>
                <h4>Payment of Service Fee as agreed in this schedule shall be made as follows:</h4>
                <table class="table">
                  <tr>
                    <td>1</td>
                    <td>Deposit - On confirmation of  FDW through Bio data/ Others: @if($servicefees[0]->deposite){{$servicefees[0]->deposite}} @else <?php echo 'n/a'; ?> @endif</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Final Payment - When the FDW reports for work/ Others: @if($servicefees[0]->final_payment){{$servicefees[0]->final_payment}} @else <?php echo 'n/a'; ?> @endif</td>
                  </tr>
                </table>
                <h5 style="float:left">PART C: Placement Fee</h5>
                @if($servicefees[0]->form_type == 'New Transfer')
                <h4>The Placement Fee shall include the following:</h4>
                <table class="table table-bordered">
                    <tr>
                      <td style='width:10%'><b>S/No</b>
                      </td>
                      <td><b>Name of Service</b>
                      </td>
                      <td style='width:10%'><b>Price (S$)</b>
                      </td>
                    </tr>
                    <?php $sno=1;
                      $totalplacprice = 0; 
                      $data = 'no';
                      ?>
                    @foreach($agencymaidservice as $agency_maid_service_id => $agency_maid_service_value)           
                      @if($agency_maid_service_value->type == 'P')
                      <?php $data = 'yes'; ?>
                        <tr>
                          <td>{{$sno}}
                          </td>
                          <td>{{$agency_maid_service_value->title}}
                          </td>
                          <td>{{$agency_maid_service_value->service_cost}}
                          </td>
                        </tr>
                        <?php $sno++; $totalplacprice =  $agency_maid_service_value->service_cost + $totalplacprice; ?>
                      @endif
                    @endforeach
                    @if($data == 'no')
                      <tr>
                        <td colspan="3" style="text-align:center">No service available.
                        </td>
                      </tr>
                    @endif
                </table>
                <table class="table table-bordered">
                  <tr>
                    <td style="text-align:right"><strong>Total Placement Fee: </strong></td>
                    <td style="width:10%">{{$totalplacprice}}</td>
                  </tr>
                </table>
                @endif
                <h4>Payment of Placement Fee as agreed in this schedule shall be made as </h4> 
                @if($servicefees[0]->payment_placement_fee == 'Upfront Placement Fee')
                <div class="personal-info-2" >
                  <ul>Upfront Placement Fee and post dated cheques
                     <li>{{$servicefees[0]->upfront_month}} months upfront Placement Fee {{$servicefees[0]->upfront_fee}}.
                      </li>
                     @foreach($placement_fee_schedule as $placement_fee_schedule_id => $placement_fee_schedule_value)  
                      <li>{{$placement_fee_schedule_value->post_dated_cheque_number}} post-dated cheques of S$ {{$placement_fee_schedule_value->post_dated_cheque_cost}} each.
                      </li>
                    @endforeach
                  </ul>
              </div>
              @elseif($servicefees[0]->payment_placement_fee == "Full sum payable")
              Full sum payable upon *handover / signing of contract / others: {{$servicefees[0]->placement_full_sum}}
              @elseif($servicefees[0]->payment_placement_fee == "Others")
              {{$servicefees[0]->placement_other}}
              @else
              <?php echo 'n/a'; ?>
              @endif
              <br />
              @if($servicefees[0]->form_type != 'New Transfer')
              <h4>I confirm that the replacement Foreign Domestic Worker named in Part A of this Schedule is selected by me and I agree to pay the various fees and schedule of payment stated in Parts B and C.</h4>
              <br />
              @endif
              <table class="table">
              <tr>
              <td style="text-align:left">
              _____________________ <br />
              Signature by Employer
              </td>
              <td style="text-align:right">
              _____________________ <br />
              Signed for and on behalf of<br />
              {{strtoupper($agency_detail[0]->company_name)}} EMPLOYMENT AGENCY
              </td>
              </tr>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

</body>
</html>
<?php //exit; ?>
