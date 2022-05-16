<?php

namespace fernanACM\BroadcastACM\forms\subforms;

use pocketmine\Server;
use pocketmine\player\Player;

use Vecnavium\FormsUI\CustomForm;

use fernanACM\BroadcastACM\Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastForm{

	public function BroadcastMessage(Player $player){
		$form = new CustomForm(function(Player $player, $data = null){
			if(!empty($data[1])){
				$prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
				Broadcast::getInstance()->getServer()->broadcastMessage(str_replace(["{LINE}", "&"], ["\n", "§"], $prefix . $data[1]));
                PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
			}else{
				$prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
				$player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
			}
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastMessage.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastMessage.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastMessage.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	public function BroadcastTitle(Player $player){
		$form = new CustomForm(function(Player $player, $data = null){
			if(!empty($data[1])){
				Broadcast::getInstance()->getServer()->broadcastTitle(str_replace(["{LINE}", "&"], ["\n", "§"], $data[1]));
                PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
			}else{
				$prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
				$player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
			}
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	public function BroadcastTip(Player $player){
		$form = new CustomForm(function(Player $player, $data = null){
		    if(!empty($data[1])){
		    	Broadcast::getInstance()->getServer()->broadcastTip(str_replace(["{LINE}", "&"], ["\n", "§"], $data[1]));
                PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		    }else{
		    	$prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
				$player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
			}	
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastTip.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastTip.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastTip.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	public function BroadcastPopup(Player $player){
		$form = new CustomForm(function(Player $player, $data = null){
		    if(!empty($data[1])){
		    	Broadcast::getInstance()->getServer()->broadcastPopup(str_replace(["{LINE}", "&"], ["\n", "§"], $data[1]));
                PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		    }else{
		    	$prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
				$player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
			}	
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastPopup.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastPopup.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastPopup.input"), "BroadcastACM");
		$player->sendForm($form);
	}
}