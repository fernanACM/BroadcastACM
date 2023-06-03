<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM\commands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;
# Lib - Commando
use CortexPE\Commando\BaseCommand;
# My files - SubCommands
use fernanACM\BroadcastACM\commands\subcommands\HelpSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\MessageSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\TitleSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\TipSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\PopupSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\ActionBarSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\DiscordSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\ToastSubCommand;
# My files
use fernanACM\BroadcastACM\BroadcastACM;
use fernanACM\BroadcastACM\utils\PermissionsUtils;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastCommand extends BaseCommand{

    public function __construct(){
        parent::__construct(BroadcastACM::getInstance(), "broadcastacm", "BroadcastACM by fernanACM", ["broadcast"]);
        $this->setPermission(PermissionsUtils::BROADCAST_CMD);
    }

    /**
     * @return void
     */
	protected function prepare(): void{
        $this->registerSubCommand(new ActionBarSubCommand);
        $this->registerSubCommand(new DiscordSubCommand);
        $this->registerSubCommand(new HelpSubCommand);
        $this->registerSubCommand(new MessageSubCommand);
        $this->registerSubCommand(new PopupSubCommand);
        $this->registerSubCommand(new TipSubCommand);
        $this->registerSubCommand(new TitleSubCommand);
        $this->registerSubCommand(new ToastSubCommand);
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
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        if(!$sender->hasPermission(PermissionsUtils::BROADCAST_CMD)){
            $sender->sendMessage(BroadcastACM::Prefix(). BroadcastACM::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        BroadcastACM::getInstance()->getBroadcastMenu()->getBroadcastMenu($sender);
        PluginUtils::PlaySound($sender, "random.pop", 1, 2.3);
    }
}
