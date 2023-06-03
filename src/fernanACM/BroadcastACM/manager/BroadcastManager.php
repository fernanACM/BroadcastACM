<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM\manager;

use pocketmine\Server;
use pocketmine\player\Player;

use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;

use fernanACM\BroadcastACM\BroadcastACM;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastManager{

    /**
     * @param Player $player
     * @param string $text
     * @return void
     */
    public function sendMessage(Player $player, string $text): void{
        Server::getInstance()->broadcastMessage(BroadcastACM::Prefix(). PluginUtils::codeUtil($player, $text));
    }

    /**
     * @param Player $player
     * @param string $title
     * @param string $subTitle
     * @return void
     */
    public function sendTitle(Player $player, string $title, string $subTitle = ""): void{
        Server::getInstance()->broadcastTitle(PluginUtils::codeUtil($player, $title), PluginUtils::codeUtil($player, $subTitle));
    }

    /**
     * @param Player $player
     * @param string $text
     * @return void
     */
    public function sendPopup(Player $player, string $text): void{
        Server::getInstance()->broadcastPopup(PluginUtils::codeUtil($player, $text));
    }

    /**
     * @param Player $player
     * @param string $text
     * @return void
     */
    public function sendTip(Player $player, string $text): void{
        Server::getInstance()->broadcastTip(PluginUtils::codeUtil($player, $text));
    }

    /**
     * @param Player $player
     * @param string $text
     * @return void
     */
    public function sendActionBar(Player $player, string $text): void{
        foreach(Server::getInstance()->getOnlinePlayers() as $players){
            if($players instanceof Player){
                $players->sendActionBarMessage(PluginUtils::codeUtil($player, $text));
            }
        }
    }

    /**
     * @param Player $player
     * @param string $title
     * @param string $subTitle
     * @return void
     */
    public function sendToast(Player $player, string $title, string $subTitle): void{
        foreach(Server::getInstance()->getOnlinePlayers() as $players){
            if($players instanceof Player){
                $players->sendToastNotification(PluginUtils::codeUtil($player, $title), PluginUtils::codeUtil($player, $subTitle));
            }
        }
    }

    /**
     * @param Player $player
     * @param string $title
     * @param string $content
     * @param string $author
     * @return void
     */
    public function sendDiscord(Player $player, string $title, string $content, string $author = ""): void{
        $config = BroadcastACM::getInstance()->config;
        if(empty($config->getNested("Discord.url"))){
            $player->sendMessage(BroadcastACM::Prefix(). BroadcastACM::getMessage($player, "Messages.no-url"));
            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
            return;
        }
        $webhook = new Webhook($config->getNested("Discord.url"));
        $msg = new Message();
        $embed = new Embed();
        $msg->setUsername($config->getNested("Discord.userName"));
        $embed->setTitle($title);
        $embed->setDescription(PluginUtils::codeUtil($player, $content));
        $embed->setAuthor($author);
        $msg->addEmbed($embed);
        $webhook->send($msg);
    }
}