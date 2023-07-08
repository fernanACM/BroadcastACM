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

use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;

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
		self::sendDiscordMessage();
	}

	/**
	 * @param Player $player
	 * @param string $key
	 * @return string
	 */
	private static function getMessage(Player $player, string $key): string {
		$messageArray = (array) BroadcastACM::getInstance()->config->getNested($key, []);
		if(empty($messageArray)){
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

	/**
     * @param string $title
     * @param string $content
     * @param string $author
     * @return void
     */
    private static function sendDiscord(string $title, string $content, string $author = ""): void{
        $config = BroadcastACM::getInstance()->config;
        if(empty($config->getNested("Discord.url"))){
            return;
        }
        $webhook = new Webhook($config->getNested("Discord.url"));
        $msg = new Message();
        $embed = new Embed();
        $msg->setUsername($config->getNested("Discord.userName"));
        $msg->setAvatarURL($config->getNested("Discord.avatarURL"));
        $embed->setTitle("**".$title."**");
        $embed->setDescription($content);
        $embed->setColor((int)$config->getNested("Discord.color"));
        $embed->setFooter($author);
        $msg->addEmbed($embed);
        $webhook->send($msg);
    }

	/**
	 * @return void
	 */
	private static function sendDiscordMessage(): void{
		$config = BroadcastACM::getInstance()->config;
		$title = $config->getNested("Discord.Broadcast.title");
		$messages = $config->getNested("Discord.Broadcast.messages");
		if($config->getNested("Discord.Broadcast.enabled")){
			$randomMessage = $messages[array_rand($messages)];
			self::sendDiscord($title, $randomMessage);
		}
	}	
}