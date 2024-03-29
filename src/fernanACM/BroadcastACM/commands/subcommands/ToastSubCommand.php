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

class ToastSubCommand extends BaseSubCommand{

	public function __construct(){
        parent::__construct("toast", "", []);
        $this->setPermission(PermissionsUtils::BROADCAST_TOAST);
    }

	/**
     * @return void
     */
	protected function prepare(): void{
        $this->registerArgument(0, new TextArgument("text", true));
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
        if(!$sender->hasPermission(PermissionsUtils::BROADCAST_TOAST)){
            $sender->sendMessage(BroadcastACM::Prefix(). BroadcastACM::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        if(!isset($args["text"])){
            BroadcastACM::getInstance()->getBroadcastForm()->getBroadcastToast($sender);
            PluginUtils::PlaySound($sender, "random.pop2", 1, 4.5);
            return;
        }
		$title = $args["text"];
        $subTitle = "";
		if(strpos($title, "{line}") !== false){
            $parts = explode("{line}", $title);
            $title = $parts[0];
            $subTitle = $parts[1];
        }
        BroadcastACM::getInstance()->getBroadcastManager()->sendToast($sender, PluginUtils::codeUtil($sender, $title), PluginUtils::codeUtil($sender, $subTitle));
        PluginUtils::PlaySound($sender, "random.bowhit", 1, 1.6);
	}
}
