<?php 

namespace fernanACM\BroadcastACM\task;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

use fernanACM\BroadcastACM\Broadcast;
use fernanACM\BroadcastACM\utils\PluginUtils;

class BroadcastTask extends Task{

	public function onRun(): void{
		# utils
        foreach (Server::getInstance()->getOnlinePlayers() as $player){
            if($player instanceof Player){
                $prefix = Broadcast::getInstance()->getMessage($player, "Prefix");
		        $messagesACM = Broadcast::getInstance()->broadcastMS->get("Messages");
		        # Messages
		        $message = $messagesACM[array_rand($messagesACM)];
		        $message = str_replace(["&"], ["§"], $message);
		        $message = str_replace(["{LINE}"], ["\n"], $message);
		        $message = str_replace(["{ONLINE}"], [count(Broadcast::getInstance()->getServer()->getOnlinePlayers())], $message);
		        $message = str_replace(["{MAX_ONLINE}"], [Broadcast::getInstance()->getServer()->getMaxPlayers()], $message);
		        $message = str_replace(["{PLAYER}"], [$player->getName()], $message);
		        $message = str_replace(["{PING}"], [$player->getNetworkSession()->getPing()], $message);
		        $message = str_replace(["{WORLD_NAME}"], [$player->getWorld()->getFolderName()], $message);
		        $message = str_replace(["{TPS}"], [$player->getServer()->getTicksPerSecond()], $message);
		        # Message BroadCast
                if(Broadcast::getInstance()->broadcastMS->get("Broadcast", true)){
                    $player->sendMessage($prefix . $message);
                }
            }
        }
	}
}