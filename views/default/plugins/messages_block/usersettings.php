<p>
<?php
$user_guid = elgg_get_logged_in_user_guid();
$user_setting = elgg_get_plugin_user_setting('messages_friends_only', $user_guid, 'messages_block');

echo elgg_echo('mb:instruct');
echo elgg_view('input/dropdown', [
	'name' => 'params[messages_friends_only]',
	'value' => $user_setting,
	'options_values' => [
		0 => elgg_echo('mb:anyone'),
		1 => elgg_echo('mb:friends')
	],
]);

?>
</p>