<?php 
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM\forms;

use pocketmine\player\Player;

use Vecnavium\FormsUI\SimpleForm;

use fernanACM\BroadcastACM\BroadcastACM as Broadcast;
use fernanACM\BroadcastACM\utils\PermissionsUtils;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastMenu{

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastMenu(Player $player): void{
		$form = new SimpleForm(function(Player $player, $data){
			if(is_null($data)){
				return true;
			}
			switch($data){
				case 0: // MESSAGE
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_MESSAGE)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastMessage($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;

				case 1: // TITLE
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_TITLE)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastTitle($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;

				case 2: // TIP
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_TIP)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastTip($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;

				case 3: // POPUP
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_POPUP)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastPopup($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;

				case 4: //  ACTION_BAR
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_ACTIONBAR)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastActionBar($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;

				case 5: // TOAST
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_TOAST)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastToast($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;

				/*case 6: // DISCORD
					if(!$player->hasPermission(PermissionsUtils::BROADCAST_DISCORD)){
						$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player, "Messages.no-permission"));
						PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
						return;
					}
					Broadcast::getInstance()->getBroadcastForm()->getBroadcastDiscord($player);
					PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
				break;*/

				case 6: // CLOSE
					PluginUtils::PlaySound($player, "random.screenshot", 1, 1.7);
				break;
			}
		});
		$form->setTitle(Broadcast::getMessage($player, "BroadcastMenu.title"));
		$form->setContent(Broadcast::getMessage($player, "BroadcastMenu.content"));
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-message"),1,"https://i.imgur.com/PvtNPU7.png");
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-title"),1,"https://i.imgur.com/kA18I2w.png");
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-tip"),1,"https://i.imgur.com/FlpVoo7.png");
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-popup"),1,"https://i.imgur.com/08UVTNH.png");
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-actionbar"),1,"https://i.imgur.com/bMtGh7U.png");
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-toast"),1,"https://i.imgur.com/fL7SNpP.png");
		//$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-discord"),1,"https://i.imgur.com/PAwhnh8.png");
		$form->addButton(Broadcast::getMessage($player, "BroadcastMenu.button-exit"),0,"textures/ui/cancel");
		$player->sendForm($form);
	}
}