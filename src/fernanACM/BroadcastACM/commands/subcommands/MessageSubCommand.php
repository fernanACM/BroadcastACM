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
use CortexPE\Commando\args\TextArgument;
# My files
use fernanACM\BroadcastACM\BroadcastACM;
use fernanACM\BroadcastACM\utils\PermissionsUtils;
use fernanACM\BroadcastACM\utils\PluginUtils;

class MessageSubCommand extends BaseSubCommand{

    public function __construct(){
        parent::__construct("message", "", ["msg"]);
        $this->setPermission(PermissionsUtils::BROADCAST_MESSAGE);
    }

    /**
     * @return void
     */
	protected function prepare(): void{
        $this->registerArgument(0, new TextArgument("text"));
	}

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     * @return void
     */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
		if(!$sender instanceof Player){
            $sender->sendMessage("Use this command in-game");
            return;
        }
        if(!$sender->hasPermission(PermissionsUtils::BROADCAST_MESSAGE)){
            $sender->sendMessage(BroadcastACM::Prefix(). BroadcastACM::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        if(!isset($args["text"])){
            BroadcastACM::getInstance()->getBroadcastForm()->getBroadcastMessage($sender);
            PluginUtils::PlaySound($sender, "random.pop2", 1, 4.5);
            return;
        }
        BroadcastACM::getInstance()->getBroadcastManager()->sendMessage($sender, $args["text"]);
        PluginUtils::PlaySound($sender, "random.bowhit", 1, 1.6);
	}
}
