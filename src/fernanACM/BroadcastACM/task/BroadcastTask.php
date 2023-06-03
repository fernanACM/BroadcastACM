<?php 
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM\task;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\scheduler\Task;

use fernanACM\BroadcastACM\BroadcastACM;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastTask extends Task{

	/**
	 * @return void
	 */
	public function onRun(): void{
        foreach(Server::getInstance()->getOnlinePlayers() as $player){
            if($player instanceof Player){
                self::sendMode($player);
            }
        }
	}

	/**
	 * @param Player $player
	 * @param string $key
	 * @return string
	 */
	private static function getMessage(Player $player, string $key): string {
		$messageArray = (array) BroadcastACM::getInstance()->config->getNested($key, []);
		if (empty($messageArray)) {
			return '';
		}
		$randomMessageIndex = array_rand($messageArray);
		$randomMessage = $messageArray[$randomMessageIndex];
		return PluginUtils::codeUtil($player, $randomMessage);
	}
	
	/**
	 * @param Player $player
	 * @return void
	 */
	private static function sendMode(Player $player): void{
		$config = BroadcastACM::getInstance()->config;
		$mode = $config->getNested("BroadcastMode.mode", "MESSAGE");
		switch($mode){
			case "TOAST":
				$player->sendToastNotification(BroadcastACM::Prefix(), self::getMessage($player, "Messages"));
				if($config->getNested("BroadcastMode.sound")){
					PluginUtils::PlaySound($player, $config->getNested("BroadcastMode.soundName"), 1, 1);
				}
			break;
	
			case "MESSAGE":
			default:
				$player->sendMessage(BroadcastACM::Prefix() . self::getMessage($player, "Messages"));
				if($config->getNested("BroadcastMode.sound")){
					PluginUtils::PlaySound($player, $config->getNested("BroadcastMode.soundName"), 1, 1);
				}
			break;
		}
	}
}