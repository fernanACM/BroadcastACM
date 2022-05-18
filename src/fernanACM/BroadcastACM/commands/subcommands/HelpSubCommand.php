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

class HelpSubCommand extends BaseSubCommand{

	protected function prepare(): void{
		$this->setPermission("broadcastacm.help.acm");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if (!$sender instanceof Player) {
              $sender->sendMessage("Use this command in-game");
              return;
        }
        if($sender->hasPermission("broadcastacm.help.acm")){
        	$sender->sendMessage("§b»§eBROADCASTACM§b«");
        	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm help - To see the list of commands");
        	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm message - To make a message");
        	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm title - To make a message");
        	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm tip - To make a message");
        	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm popup - To make a message");
        	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm motd - To make a message");
                PluginUtils::PlaySound($sender, "random.pop", 1, 4.5);
        }else{
        	$prefix = Broadcast::getInstance()->getMessage($sender, "Prefix");
        	$sender->sendMessage($prefix . Broadcast::getInstance()->getMessage($sender, "Messages.no-permission"));
                PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
             }
	}
}
