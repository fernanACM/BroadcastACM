<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM\forms\subforms;

use pocketmine\player\Player;

use Vecnavium\FormsUI\CustomForm;

use fernanACM\BroadcastACM\BroadcastACM as Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastForm{

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastMessage(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
			if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1])){
				$player->sendMessage(Broadcast::Prefix().Broadcast::getMessage($player, "Messages.error-line"));
				PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendMessage($player, $data[1]);
            PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getMessage($player, "BroadcastMessage.title"));
		$form->addLabel(Broadcast::getMessage($player, "BroadcastMessage.content"));
		$form->addInput(Broadcast::getMessage($player, "BroadcastMessage.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastTitle(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
			if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1])){
				$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendTitle($player, $data[1], $data[2]);
			PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.title-input"), "BroadcastACM");
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastTitle.subTitle-input"), "BroadcastACM");
		$player->sendForm($form);
	}

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastTip(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
		    if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1])){
				$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendTip($player, $data[1]);
			PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastTip.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastTip.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastTip.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastPopup(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
		    if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1])){
				$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendPopup($player, $data[1]);
			PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastPopup.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastPopup.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastPopup.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastToast(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
		    if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1]) || empty($data[2])){
				$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendToast($player, $data[1], $data[2]);
			PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastToast.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastToast.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastToast.title-input"), "BroadcastACM");
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastToast.subTitle-input"), "BroadcastACM");
		$player->sendForm($form);
	}

	/**
	 * @param Player $player
	 * @return void
	 */
	public function getBroadcastActionBar(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
		    if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1])){
				$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendActionBar($player, $data[1]);
			PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastActionBar.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastActionBar.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastActionBar.input"), "BroadcastACM");
		$player->sendForm($form);
	}

	/**
	 * @param Player $player
	 * @return void
	 */
	/*public function getBroadcastDiscord(Player $player): void{
		$form = new CustomForm(function(Player $player, $data){
		    if(is_null($data)){
				PluginUtils::PlaySound($player, "random.pop2", 1, 8.1);
				return true;
			}

			if(empty($data[1]) || empty($data[2])){
				$player->sendMessage(Broadcast::Prefix(). Broadcast::getMessage($player,"Messages.error-line"));
                PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
				return;
			}
			Broadcast::getInstance()->getBroadcastManager()->sendDiscord($player, $data[1], $data[2], $data[3]);
			PluginUtils::PlaySound($player, "random.bowhit", 1, 1.6);
		});
		$form->setTitle(Broadcast::getInstance()->getMessage($player, "BroadcastDiscord.title"));
		$form->addLabel(Broadcast::getInstance()->getMessage($player, "BroadcastDiscord.content"));
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastDiscord.title-input"), "BroadcastACM");
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastDiscord.content-input"), "BroadcastACM");
		$form->addInput(Broadcast::getInstance()->getMessage($player, "BroadcastDiscord.author-input"), "BroadcastACM", $player->getName());
		$player->sendForm($form);
	}*/
}