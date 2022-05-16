<?php

namespace fernanACM\BroadcastACM\commands;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
# Lib - Commando
use CortexPE\Commando\BaseCommand;
# My files - SubCommands
use fernanACM\BroadcastACM\commands\subcommands\HelpSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\MessageSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\TitleSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\TipSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\PopupSubCommand;
use fernanACM\BroadcastACM\commands\subcommands\MotdSubCommand;
# My files
use fernanACM\BroadcastACM\Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastCommand extends BaseCommand{

	  protected function prepare(): void{
        $this->setPermission(
        	"broadcastacm.cmd.acm;" .
            "broadcastacm.help.acm;" .
        	"broadcastacm.message.acm;" .
        	"broadcastacm.title.acm;" .
        	"broadcastacm.tip.acm;" .
        	"broadcastacm.popup.acm;" .
            "broadcastacm.motd.acm"
        );

        $this->registerSubCommand(new HelpSubCommand("help", "BroadcastACM command list by fernanACM", ["list"]));
        $this->registerSubCommand(new MessageSubCommand("message", "Write your message to inform other users", ["msg"]));
        $this->registerSubCommand(new TitleSubCommand("title", "The best titles for the day", ["tl"]));
        $this->registerSubCommand(new TipSubCommand("tip", "Recommendations for your server, use the TIP", ["tp"]));
        $this->registerSubCommand(new PopupSubCommand("popup", "How fun it is to use a Popup to brighten the day", ["pp"]));
        $this->registerSubCommand(new MotdSubCommand("motd", "Create a description for your server.", ["mt"]));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
    	  if (!$sender instanceof Player) {
              $sender->sendMessage("Use this command in-game");
              return;
        }
        if($sender->hasPermission("broadcastacm.cmd.acm")){
         	   Broadcast::getInstance()->broadcastmenu->BroadcastMenu($sender);
               PluginUtils::PlaySound($sender, "random.pop2", 1, 4.5);
        }else{
            $prefix = Broadcast::getInstance()->getMessage($semder, "Prefix");
        	$sender->sendMessage($prefix . Broadcast::getInstance()->getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
        }
    }
}