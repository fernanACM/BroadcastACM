<?php 

namespace fernanACM\BroadcastACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\utils\Config;

use pocketmine\plugin\PluginBase;
# LIbs
use muqsit\simplepackethandler\SimplePacketHandler;
use CortexPE\Commando\PacketHooker;
use Vecnavium\FormsUI\FormsUI;

use pocketmine\scheduler\ClosureTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
# My files
use fernanACM\BroadcastACM\commands\BroadcastCommand;
use fernanACM\BroadcastACM\utils\PluginUtils;
use fernanACM\BroadcastACM\task\BroadcastTask;
# Forms
use fernanACM\BroadcastACM\forms\BroadcastMenu;
use fernanACM\BroadcastACM\forms\subforms\BroadcastForm;
use fernanACM\BroadcastACM\forms\subforms\MotdForm;

class Broadcast extends PluginBase{

    public Config $messages;
	public Config $broadcastMS;
	public static $instance;

	public function onEnable(): void{
		self::$instance = $this;
        $this->saveDefaultConfig();
	    $this->saveResource("messages.yml");
        $this->saveResource("broadcast.yml");
        $this->messages = new Config($this->getDataFolder() . "messages.yml");
		$this->broadcastMS = new Config($this->getDataFolder() . "broadcast.yml");
        $this->broadcastMS->getAll();
        $this->loadEvents();
        if(Broadcast::getInstance()->broadcastMS->get("Broadcast", true)){
            $configVersion = "1.0.0";
            if(is_int(Broadcast::getInstance()->broadcastMS->get("Broadcast-delay"))){
                if(Broadcast::getInstance()->broadcastMS->get("Config Version") !== $configVersion){
                    $this->getLogger()->error("The config version is invalid. Please update the config.yml.");
                }else{
                    $this->getScheduler()->scheduleRepeatingTask(new BroadcastTask(), Broadcast::getInstance()->broadcastMS->get("Broadcast-delay") * 20);
                }
            }else{
                 $this->getLogger()->error("The value you entered in 'Broadcast-delay' is not an integer. Please fix it.");
            }
        }
		# Libs - Commando, FormsUI and SimplePacketHandler
        foreach ([
        	    "FormsUI" => FormsUI::class,
                "Commando" => PacketHooker::class,
                "SimplePacketHandler" => SimplePacketHandler::class
            ] as $virion => $class
        ) {
            if (!class_exists($class)) {
                $this->getLogger()->error($virion . " virion not found. Please download BroadcastACM from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }
        # Commando
        if (!PacketHooker::isRegistered()) {
            PacketHooker::register($this);
        }
	}

	public function loadEvents(){
		$this->getServer()->getCommandMap()->register("broadcastacm", new BroadcastCommand($this, "broadcastacm", "BroadcastACM by fernanACM", ["bc", "broadcast"]));
		$this->broadcastmenu = new BroadcastMenu($this);
		$this->broadcast = new BroadcastForm($this);
        $this->motd = new MotdForm($this);
	}

	public function getMessage(Player $player, string $key){
        return PluginUtils::codeUtil($player, $this->messages->getNested($key, $key));
    }

    public static function getInstance(): Broadcast{
        return self::$instance;
    }

    public function getBroadcastMenu(): BroadcastMenu{
    	return $this->broadcastmenu;
    }

    public function getBroadcastForm(): BroadcastForm{
    	return $this->broadcast;
    }

    public function getMotdServidor(): MotdForm{
        return $this->motd;
    }
}