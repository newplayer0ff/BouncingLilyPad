<?php


namespace NewPlayerMC\LilyPad;


use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;

class Main extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener
{
    /** @var Config */
    public $config;

    private static $instance;

    public function onEnable()
    {
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function onMove(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        $block = $player->getLevel()->getBlock($player->subtract(0, 0.7, 0));
        if ($block->getId() === 111)
        {
            $player->setMotion(new Vector3(0, $this->config->get("jump_force"), 0));
        }
    }


    public static function getInstance(): self
    {
        return self::$instance;
    }

}