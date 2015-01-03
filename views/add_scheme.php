<div class="row">
	<div class="col-md-7">
		<h3><?php echo _('Define Settings for a new Scheme')?></h3>
		<h4><?php echo _('You will be able to edit the scheme on the next page')?></h4>
		<form method="POST" action="config.php?display=superfecta&amp;action=edit" name="new_scheme" id="superfecta_options">
			<input type="hidden" name="scheme_name_orig" value="<?php echo $scheme_data['name']?>">
			<div class="form-group">
				<label><?php echo _('New Scheme Name')?></label>
				<input type="text" class="form-control" name="scheme_name" size="23" maxlength="20" value="<?php echo $scheme_data['name']?>">
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('DID Rules')?><span><?php echo _('Define the expected DID Number if your trunk passes DID on incoming calls. <br><br>Leave this blank to match calls with any or no DID info.<br><br>This rule trys both absolute and pattern matching (eg "_2[345]X", to match a range of numbers). (The "_" underscore is optional.)')?></span></a></label>
				<textarea id="DID" class="form-control" tabindex="1" cols="20" rows="5" name="DID"><?php echo $scheme_data['DID']?></textarea>
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('CID Rules')?><span><?php echo _('Incoming calls with CID matching the patterns specified here will use this CID Scheme. If this is left blank, this scheme will be used for any CID. It can be used to add or remove prefixes.<br>
					<strong>Many sources require a specific number of digits in the phone number. It is recommended that you use the patterns to remove excess country code data from incoming CID to increase the effectiveness of this module.</strong><br>
					Note that a pattern without a + or | (to add or remove a prefix) will not make any changes but will create a match. Only the first matched pattern will be executed and the remaining rules will not be acted on.<br /><br /><b>Rules:</b><br />
					<strong>X</strong>&nbsp;&nbsp;&nbsp; matches any digit from 0-9<br />
					<strong>Z</strong>&nbsp;&nbsp;&nbsp; matches any digit from 1-9<br />
					<strong>N</strong>&nbsp;&nbsp;&nbsp; matches any digit from 2-9<br />
					<strong>[1237-9]</strong>&nbsp;   matches any digit or letter in the brackets (in this example, 1,2,3,7,8,9)<br />
					<strong>.</strong>&nbsp;&nbsp;&nbsp; wildcard, matches one or more characters (not allowed before a | or +)<br />
					<strong>|</strong>&nbsp;&nbsp;&nbsp; removes a dialing prefix from the number (for example, 613|NXXXXXX would match when some one dialed "6135551234" but would only pass "5551234" to the Superfecta look up.)<br><strong>+</strong>&nbsp;&nbsp;&nbsp; adds a dialing prefix to the number (for example, 1613+NXXXXXX would match when someone dialed "5551234" and would pass "16135551234" to the Superfecta look up.)<br /><br />
					You can also use both + and |, for example: 01+0|1ZXXXXXXXXX would match "016065551234" and dial it as "0116065551234" Note that the order does not matter, eg. 0|01+1ZXXXXXXXXX does the same thing.')?></span>
					</a>
				</label>
				<textarea tabindex="2" class="form-control" id="dialrules" cols="20" rows="5" name="CID_rules"><?php echo $scheme_data['CID_rules']?></textarea>
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('Lookup Timeout')?><span><?php echo _('Specify a timeout in seconds for each source. If the source fails to return a result within the alloted time, the script will move on.')?></span></a></label>
				<input type="text" name="Curl_Timeout" class="form-control" size="4" maxlength="5" value="<?php echo $scheme_data['Curl_Timeout']?>">
			</div>
			<div class="form-group">
				<label>
					<a href="javascript:return(false);" class="info"><?php echo _('Superfecta Processor')?>
						<span><?php echo _('These are the types of Superfecta Processors')?>:<br />
							<?php foreach($scheme_data['processors_list'] as $list) { ?>
								<strong><?php echo $list['name']?>:</strong> <?php echo $list['description']?><br />
							<?php } ?>
						</span>
					</a>
				</label>
				<select class="form-control" name="processor">
					<?php foreach($scheme_data['processors_list'] as $list) { ?>
						<option value='<?php echo $list['filename']?>' <?php echo $scheme_data['processor'] == $list['filename'] ? 'selected' : ''?>><?php echo $list['name']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('Multifecta Timeout')?><span><?php echo _('Specify a timeout in seconds defining how long multifecta will obey the source priority. After this timeout, the first source to respond with a CNAM will be taken, until "Lookup Timeout" is reached')?></span></a></label>
				<input type="text" class="form-control" name="multifecta_timeout" maxlength="5" value="<?php echo $scheme_data['multifecta_timeout']?>">
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('CID Prefix URL')?><span><?php echo _('If you wish to prefix information on the caller id you can specify a url here where that prefix can be retrieved.<br>The data will not be parsed in any way, and will be truncated to the first 10 characters.<br>Example URL: http://www.example.com/GetCID.php?phone_number=[thenumber]<br>[thenumber] will be replaced with the full 10 digit phone number when the URL is called')?></span></a></label>
				<input type="text" class="form-control" name="Prefix_URL" maxlength="255" value="<?php echo $scheme_data['Prefix_URL']?>">
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('SPAM Text')?><span><?php echo _('This text will be prepended to Caller ID information to help you identify calls as SPAM calls')?></span></a></label>
				<input type="text" class="form-control" name="SPAM_Text" maxlength="20" value="<?php echo $scheme_data['SPAM_Text']?>">
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('SPAM Text Substituted')?><span><?php echo _('When enabled, the text entered in "SPAM Text" (above) will replace the CID completely rather than pre-pending the CID value')?></span></a></label>
				<input type="checkbox" class="form-control" name="SPAM_Text_Substitute" value="Y" <?php echo $scheme_data['SPAM_Text_Substitute'] ? 'checked' : ''?>>
			</div>
			<div class="form-group">
				<label><a href="javascript:return(false);" class="info"><?php echo _('Enable SPAM Interception')?><span><?php echo _('When enabled, Spam calls can be diverted or terminated')?></span></a></label>
				<input type="checkbox" class="form-control" id="enableInterceptor" name="enable_interceptor" value="Y" <?php echo $scheme_data['spam_interceptor'] ? 'checked' : ''?>>
			</div>
			<div id="InterceptorVector">
				<div class="form-group">
					<label><a href="javascript:return(false);" class="info"><?php echo _('SPAM Send Threshold')?><span><?php echo _('This is the threshold to send the call to the specified destination below')?></span></a></label>
					<input type="text" class="form-control" name="SPAM_threshold" size="4" maxlength="2" value="<?php echo $scheme_data['SPAM_threshold']?>">
				</div>
				<div class="form-group">
					<label><?php echo _('Send Spam Call To')?></label>
					<?php echo drawselects('', 0, FALSE, FALSE)?>
				</div>
			</div>
			<input type="submit" name="submit" value="<?php echo _('Submit')?>">
		</form>
	</div>
</div>
