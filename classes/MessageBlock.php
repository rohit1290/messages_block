<?php
use Elgg\DefaultPluginBootstrap;

class MessageBlock extends DefaultPluginBootstrap {

  public function init() {
    // Restrict user from sending message
    elgg_register_plugin_hook_handler('action:validate', 'messages/send', function (\Elgg\Hook $hook) {
      $return = $hook->getValue();
      
      // If admin is sending the message then don't block the message
      if(elgg_is_admin_logged_in()) {
        return $return;
      }
      
      $send_to = get_input('recipients');
      $user = get_user($send_to[0]);
      if (!$user instanceof ElggUser) {
        return $result;
      }

      $setting = (int)elgg_get_plugin_user_setting('messages_friends_only', $user->guid, 'messages_block');
      // check if this user wants friends only mail
      // 1 = Just friends
      // 0 = Anyone
      if ($setting == 0) {
        return $return;
      } else if (!$user->isFriendsWith(elgg_get_logged_in_user_guid())) {
        register_error(elgg_echo('mb:deny'));
        return false;
      }

      return $return;
    });
    
    //TODO: Don't show send message button on user profile
  }
  
}