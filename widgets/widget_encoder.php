<?php

	$widgets = array(
		array(
			"name" => "paypal_buynow",
			"label" => 'Buy It Now Button',
			"template" => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_xclick"><input type="hidden" name="business" value="{email:payee}"><input type="hidden" name="lc" value="US"><input type="hidden" name="item_name" value="{text:item_name}"><input type="hidden" name="item_number" value="{text:item_number}"><input type="hidden" name="amount" value="{text:amount}"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="button_subtype" value="services"><input type="hidden" name="no_note" value="0"><input type="hidden" name="no_shipping" value="2"><input type="hidden" name="rm" value="1"><input type="hidden" name="return" value="{baseurl}/paypal-complete.php"><input type="hidden" name="cancel_return" value="{baseurl}/paypal-cancel.php"><input type="hidden" name="tax_rate" value="{text:tax_rate}"><input type="hidden" name="shipping" value="{text:shipping}"><input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted"><input type="hidden" name="notify_url" value="{baseurl}/paypal-notify.php"><button type="submit" name="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Pay Securely with Paypal">{text:button_label}</button><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>'
		),
		array(
			"name" => "paypal_addtocart",
			"label" => 'Add to Cart Button',
			"template" => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_cart"><input type="hidden" name="business" value="{email:payee}"><input type="hidden" name="lc" value="US"><input type="hidden" name="item_name" value="{text:item_name}"><input type="hidden" name="item_number" value="{text:item_number}"><input type="hidden" name="amount" value="{text:amount}"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="button_subtype" value="services"><input type="hidden" name="no_note" value="0"><input type="hidden" name="no_shipping" value="2"><input type="hidden" name="rm" value="1"><input type="hidden" name="return" value="{baseurl}/paypal-complete.php"><input type="hidden" name="cancel_return" value="{baseurl}/paypal-cancel.php"><input type="hidden" name="tax_rate" value="{text:tax_rate}"><input type="hidden" name="shipping" value="{text:shipping}"><input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted"><input type="hidden" name="notify_url" value="{baseurl}/paypal-notify.php"><button type="submit" name="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Pay Securely with Paypal">{text:button_label}</button><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>'
		),
		array(
			"name" => "paypal_showcart",
			"label" => 'Show Cart Button',
			"template" => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_cart"><input type="hidden" name="business" value="{email:payee}"><button type="submit" name="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Pay Securely with Paypal">{text:button_label}</button><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>'
		)
	);
	
	foreach($widgets as $widget) {
	 	$widget_json = json_encode($widget);
	 	file_put_contents($widget['name'].".json",$widget_json);
	}

?>