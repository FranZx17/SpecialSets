<?php


namespace vale;


use pocketmine\plugin\PluginBase;
use vale\api\PlayerAPI;
use vale\api\SpecialAPI;
use vale\commands\PhantomBag;
use vale\sets\PhantomSet;
//use vale\sets\YijkiSet;


class Loader extends PluginBase
{


    /**
     * @var Loader
     */
    private static $instance;


    /**
     * @var \pocketmine\command\SimpleCommandMap|null
     */
    private $command;

    public function onEnable()
    {
        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getLogger()->info("Enabling Special Sets");
        $this->command = $this->getServer()->getCommandMap();
        $this->getServer()->getCommandMap()->register("phantombag", new PhantomBag("phantombag", $this));
        $this->loadSets();
        $this->API();

    }

    /**
     * @param string $set
     */

    public function loadSets()
    {
        new PhantomSet($this);
        //new YijkiSet($this);


    }

    /**
     * @param string $api
     */

    public function API()
    {
        new PlayerAPI($this);
        new SpecialAPI($this);


    }
    public static function getInstance(): Loader{

        return self::$instance;


    }



}
