<?php

namespace fernanACM\BroadcastACM\forms\subforms;

use pocketmine\Server;
use pocketmine\player\Player;

use Vecnavium\FormsUI\CustomForm;

use fernanACM\BroadcastACM\Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class MotdForm{

	public function MotdServidor(Player $player){
		$form = new CustomForm(function(Player $player, $data = null){
			if(!empty($data[1])){
				Broadcast::getInstance()->getServer()->getNetwork()->setName($data[1]);
                $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
                $message = Broadcast::getInstance()->getMessage($player,"Messages.motd-successful");
                $player->sendMessage($prefix . str_replace(["{MOTD}"], [$data[1]], $message));
                PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
			}else{
				$prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
				$player->sendMessage($prefix . Broadcast::getInstance()->getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
			}
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastMotd.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastMotd.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastMotd.input"));
		$player->sendForm($form);
	}
}