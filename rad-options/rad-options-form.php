<div class="wrap">
	<h2>Company Info</h2>
</div>

<form method="post" action="options.php">
	<?php //connect the settings to this form
	settings_fields('rad_options_group');
	//get the current values to make the form "stick"
	$values = get_option('rad_options'); ?>

	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label>Company Phone Number:</label>
				</th>
				<td>
					<input type="tel" name="rad_options[phone]" 
					class="regular-text" value="<?php echo $values['phone']; ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label>Customer Service Email:</label>
				</th>
				<td>
					<input type="email" name="rad_options[email]" 
					class="regular-text" value="<?php echo $values['email']; ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label>Company Mailing Address:</label>
				</th>
				<td>
					<textarea name="rad_options[address]" class="code"><?php 
							echo $values['address'] ?></textarea>
				</td>
			</tr>	
		</tbody>
	</table>

	<?php submit_button( 'Save Company Info' ); ?>
</form>