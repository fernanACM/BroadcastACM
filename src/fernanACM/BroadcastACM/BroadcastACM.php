<?php 
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\BroadcastACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use pocketmine\plugin\PluginBase;
# LIbs
use Vecnavium\FormsUI\FormsUI;

use muqsit\simplepackethandler\SimplePacketHandler;

use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\PacketHooker;

use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;
# My files
use fernanACM\BroadcastACM\commands\BroadcastCommand;
use fernanACM\BroadcastACM\utils\PluginUtils;
use fernanACM\BroadcastACM\task\BroadcastTask;
# Forms
use fernanACM\BroadcastACM\forms\BroadcastMenu;
use fernanACM\BroadcastACM\forms\subforms\BroadcastForm;
use fernanACM\BroadcastACM\manager\BroadcastManager;

class BroadcastACM extends PluginBase{

    /** @var Config $config */
    public Config $config;

    /** @var Config $messages */
    public Config $messages;

    /** @var BroadcastACM $instance */
	private static BroadcastACM $instance;

    /** @var BroadcastMenu $menu */
    private BroadcastMenu $menu;

    /** @var BroadcastForm $form */
    private BroadcastForm $form;

    /** @var BroadcastManager $manager */
    private BroadcastManager $manager;

    # CheckConfig
    public const CONFIG_VERSION = "1.0.0";
    public const LANGUAGE_VERSION = "1.0.0";

    /**
     * @return void
     */
    public function onLoad(): void{
        $this->loadVars();
        $this->loadFiles();
    }

    /**
     * @return void
     */
	public function onEnable(): void{
        $this->loadCheck();
        $this->loadVirions();
        $this->loadCommands();
        $this->loadTasks();
	}

    /**
     * @return void
     */
    public function loadFiles(): void{
        # Config files
        $this->saveResource("broadcast.yml");
        $this->config = new Config($this->getDataFolder() . "broadcast.yml");
        $this->messages = new Config($this->getDataFolder() . "messages.yml");
    }

    /**
     * @return void
     */
    public function loadCheck(): void{
        # CONFIG
        if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
        # LANGUAGES
        if((!$this->messages->exists("config-version")) || ($this->messages->get("language-version") != self::LANGUAGE_VERSION)){
            rename($this->getDataFolder() . "messages.yml", $this->getDataFolder() . "messages_old.yml");
            $this->saveResource("messages.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as messages_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
    }

    /**
     * @return void
     */
    public function loadVirions(): void{
        foreach([
            "FormsUI" => FormsUI::class,
            "SimplePacketHandler" => SimplePacketHandler::class,
            "Commando" => BaseCommand::class,
            "libPiggyUpdateChecker" => libPiggyUpdateChecker::class
            ] as $virion => $class
        ){
            if(!class_exists($class)){
                $this->getLogger()->error($virion . " virion not found. Please download BroadcastACM from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }

        if(!PacketHooker::isRegistered()){
            PacketHooker::register($this);
        }
        # Update
        libPiggyUpdateChecker::init($this);
    }

    /**
     * @return void
     */
    public function loadCommands(): void{
        Server::getInstance()->getCommandMap()->register("broadcastacm", new BroadcastCommand);
    }

    /**
     * @return void
     */
    public function loadTasks(): void{
        if(BroadcastACM::getInstance()->config->get("Broadcast")){
            $this->getScheduler()->scheduleRepeatingTask(new BroadcastTask(), $this->config->get("Broadcast-delay") * 20);
        }
    }

    /**
     * @return void
     */
    public function loadVars(): void{
        self::$instance = $this;
        $this->menu = new BroadcastMenu();
        $this->form = new BroadcastForm();
        $this->manager = new BroadcastManager();
    }

    /**
     * @return BroadcastACM
     */
    public static function getInstance(): BroadcastACM{
        return self::$instance;
    }

    /**
     * @return BroadcastMenu
     */
    public function getBroadcastMenu(): BroadcastMenu{
        return $this->menu;
    }
    
    /**
     * @return BroadcastManager
     */
    public function getBroadcastManager(): BroadcastManager{
        return $this->manager;
    }

    /**
     * @return BroadcastForm
     */
    public function getBroadcastForm(): BroadcastForm{
        return $this->form;
    }

	/**
     * @param Player $player
     * @param string $key
     * @return string
     */
    public static function getMessage(Player $player, string $key): string{
        $messageArray = self::$instance->messages->getNested($key, []);
        if(!is_array($messageArray)){
            $messageArray = [$messageArray];
        }
        $message = implode("\n", $messageArray);
        return PluginUtils::codeUtil($player, $message);
    }

    /**
     * @return string
     */
    public static function Prefix(): string{
        return TextFormat::colorize(self::$instance->config->get("Prefix"));
    }
}