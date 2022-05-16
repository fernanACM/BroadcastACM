<?php 

namespace fernanACM\BroadcastACM\forms;

use pocketmine\Server;
use pocketmine\player\Player;

use Vecnavium\FormsUI\SimpleForm;

use fernanACM\BroadcastACM\Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastMenu{

	public function BroadcastMenu(Player $player){
		$form = new SimpleForm(function(Player $player, $data){
			if($data !== null){
				switch($data){
					case 0: //Message
					    if($player->hasPermission("broadcastacm.message.acm")){
					    	Broadcast::getInstance()->broadcast->BroadcastMessage($player);
                            PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
					    }else{
                            $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
                            $player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player, "Messages.no-permission"));
                            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                        }
					break;

					case 1: //Title
					    if($player->hasPermission("broadcastacm.title.acm")){
					    	Broadcast::getInstance()->broadcast->BroadcastTitle($player);
                            PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
					    }else{
                            $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
                            $player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player, "Messages.no-permission"));
                            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                        }
					break;

					case 2: //Tip
					    if($player->hasPermission("broadcastacm.tip.acm")){
					    	Broadcast::getInstance()->broadcast->BroadcastTip($player);
                            PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
					    }else{
                            $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
                            $player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player, "Messages.no-permission"));
                            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                        }
					break;

					case 3: //Popup
					    if($player->hasPermission("broadcastacm.popup.acm")){
					    	Broadcast::getInstance()->broadcast->BroadcastPopup($player);
                            PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
					    }else{
                            $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
                            $player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player, "Messages.no-permission"));
                            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                        }
					break;

					case 4: //Motd
					    if($player->hasPermission("broadcastacm.motd.acm")){
					    	Broadcast::getInstance()->motd->MotdServidor($player);
                            PluginUtils::PlaySound($player, "random.bow", 1, 1.6);
					    }else{
                            $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
                            $player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player, "Messages.no-permission"));
                            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
                        }
					break;

					case 5: //Exit
                        PluginUtils::PlaySound($player, "random.screenshot", 1, 1.7);
					break;
				}
			}
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.title"));
		$form->setContent(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.content"));
		$form->addButton(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.button-message"),1,"https://i.imgur.com/wj2PDPC.png");
		$form->addButton(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.button-title"),1,"https://i.imgur.com/u4VBUB2.png");
		$form->addButton(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.button-tip"),1,"https://i.imgur.com/m1wKMGh.png");
		$form->addButton(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.button-popup"),1,"https://i.imgur.com/tnZ6tdR.png");
		$form->addButton(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.button-motd"),1,"https://i.imgur.com/D1XoJhN.png");
		$form->addButton(Broadcast::getInstance()->getMessage($player, "BroadcastMenu.button-exit"),1,"https://i.imgur.com/dZdhhWp.png");
		$player->sendForm($form);
	}
}