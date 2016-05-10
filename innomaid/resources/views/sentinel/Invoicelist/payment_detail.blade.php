
<div class="table-responsive"> <table border="0" class="table" width="100%"><tbody>
           @if ($paymentList->count() === 0 )
                    <tr>
                        <td colspan="11" style="padding:0px;"><center> <b>No Payment Record Found.</b></center></td>
                    </tr>
          @else 
		<tr><th valign="top" align="left"> Date </th> <th valign="top" align="right"> Payment Mode </th>
		<th valign="top" align="left"> Payment Amount </th> <th valign="top" align="left"> Action </th></tr>
           @foreach($paymentList as $payment)
          <tr><td valign="top" align="right"><?php echo date('d-m-Y',strtotime($payment->payment_date)); ?></td>
           <td valign="top" align="left">
                     <?php echo $payment->payment_mode; ?>
            </td>
		 <td valign="top" align="left">
                     <?php echo $payment->amount_received; ?>
            </td><td><a class="fa fa-download" title="Pdf" href="{{url('/Invoicelist/'.$payment->id.'/paymentrecordpdf/yes')}}"></a></td>
            </tr>
             @endforeach @endif</tbody></table></div>
