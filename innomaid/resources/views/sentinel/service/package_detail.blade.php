<div class="table-responsive"> <table border="0" class="table" width="100%"><tbody>
           @if ($packageList->count() === 0 )
                    <tr>
                        <td colspan="11" style="padding:0px;"><center> <b>No Package Found.</b></center></td>
                    </tr>
          @else 
		<tr> <th valign="top" align="right"> Package Name </th>
		<th valign="top" align="left"> Package Fee </th> </tr>
           @foreach($packageList as $plan)
          <tr><td valign="top" align="right"><?php echo $plan->package_name; ?></td>
           <td valign="top" align="left">
                     <?php echo $plan->package_price; ?>
            </td>
            </tr>
             @endforeach @endif</tbody></table></div>
