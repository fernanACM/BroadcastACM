<?php 
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM\commands\subcommands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;
# Lib - Commando
use CortexPE\Commando\BaseSubCommand;
# My files
use fernanACM\BroadcastACM\BroadcastACM;
use fernanACM\BroadcastACM\utils\PermissionsUtils;
use fernanACM\BroadcastACM\utils\PluginUtils;

class HelpSubCommand extends BaseSubCommand{

	public function __construct(){
		parent::__construct("help", "", ["?"]);
		$this->setPermission(PermissionsUtils::BROADCAST_CMD_HELP);
	}

	/**
	 * @return void
	 */
	protected function prepare(): void{
	}

	/**
	 * @param CommandSender $sender
	 * @param string $aliasUsed
	 * @param array $args
	 * @return void
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player) {
            $sender->sendMessage("Use this command in-game");
            return;
        }
		if(!$sender->hasPermission(PermissionsUtils::BROADCAST_CMD_HELP)){
            $sender->sendMessage(BroadcastACM::Prefix(). BroadcastACM::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        $sender->sendMessage("§b»§eBROADCASTACM§b«");
        $sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm help - To see the list of commands");
        $sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm message - To make a message");
        $sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm title - To make a message");
    	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm tip - To make a message");
    	$sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm popup - To make a message");
        $sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm toast - To make a message");
        $sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm actionbar - To make a message");
        $sender->sendMessage("- §l§eUse§a»§r §7/broadcastacm discord - To make a message");
        PluginUtils::PlaySound($sender, "random.pop", 1, 4.5);
	}
}
