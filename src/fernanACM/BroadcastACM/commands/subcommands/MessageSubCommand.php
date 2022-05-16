<?php 

namespace fernanACM\BroadcastACM\commands\subcommands;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
# Lib - Commando
use CortexPE\Commando\BaseSubCommand;
# My files
use fernanACM\BroadcastACM\Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class MessageSubCommand extends BaseSubCommand{

	protected function prepare(): void{
		$this->setPermission("broadcastacm.message.acm");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if (!$sender instanceof Player) {
              $sender->sendMessage("Use this command in-game");
              return;
        }
        if($sender->hasPermission("broadcastacm.message.acm")){
            Broadcast::getInstance()->broadcast->BroadcastMessage($sender);
            PluginUtils::PlaySound($sender, "random.pop2", 1, 4.5);
        }else{
        	$prefix = Broadcast::getInstance()->getMessage($semder, "Prefix");
        	$sender->sendMessage($prefix . Broadcast::getInstance()->getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
        }
	}
}