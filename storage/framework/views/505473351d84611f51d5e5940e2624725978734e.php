<table>
	<tr>
        <td><label class="form-label"> Patient Name :</label></td>
        <td><?php echo e(isset($arr_transactions['patient_name']) ? $arr_transactions['patient_name']:'-'); ?> </td>
    </tr>
	<tr>
		<td><label class="form-label"> Transaction ID :</label></td>
		<td> <?php echo e(isset($arr_transactions['transaction_id'])?$arr_transactions['transaction_id']:'-'); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Consultation ID :</label></td>
		<td> <?php echo e(isset($arr_transactions['consultation_id'])?$arr_transactions['consultation_id']:'-'); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Transaction Date :</label></td>
		<td> <?php echo e(isset($arr_transactions['created_at'])?date('d-M-Y',strtotime($arr_transactions['created_at'])):'00.00.0000'); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Invoice No :</label></td>
		<td> <?php echo e(isset($arr_transactions['invoice_no'])?$arr_transactions['invoice_no']:'-'); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Amount<b> (€)</b> :</label></td>
		<td> <?php echo e(isset($arr_transactions['amount'])?$arr_transactions['amount']:0.00); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Discount Code :</label></td>
		<td> <?php echo e(isset($arr_transactions['discount_details']['code'])?$arr_transactions['discount_details']['code']:'-'); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Discount Amount<b> (€)</b> :</label></td>
		<td> <?php echo e(isset($arr_transactions['discount_amount'])?$arr_transactions['discount_amount']:0.00); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Paid Amount<b> (€)</b> :</label></td>
		<td> <?php echo e(isset($arr_transactions['paid_amount'])?$arr_transactions['paid_amount']:0.00); ?> </td>
	</tr>
	<tr>
		<td><label class="form-label"> Status :</label></td>
		<td class="green-text" <?php if(isset($arr_transactions['status']) && $arr_transactions['status']!='paid'): ?> style="color: red;"<?php endif; ?>> <?php echo e(isset($arr_transactions['status'])?ucwords($arr_transactions['status']):'-'); ?> </td>
	</tr>
</table>