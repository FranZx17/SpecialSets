<?php


namespace vale\api;


use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\Player;
use pocketmine\Server;
use vale\Loader;

class PlayerAPI implements Listener
{

    /**
     * @var Loader
     */
    private $main;


    public function __construct(Loader $main)
    {
        $this->main = $main;
        $this->main->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    public function onPhantomPackage(PlayerInteractEvent $event) : void{
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $inv = $player->getInventory();
        $hand = $inv->getItemInHand();
        $nbt = $hand->getNamedTag();
        // Custom \nEnchantment Book Tier: 1
        if ($hand->getId() == 54 and $hand->getDamage() == 0 and $hand->getCustomName() == "§r§7Special Set §c§lPhantom"){
            $event->setCancelled(true);
            $hand->setCount($hand->getCount() - 1);
            $inv->setItemInHand($hand);
            SpecialAPI::givePhantomHelmet($player);
            SpecialAPI::givePhantomChestPlate($player);
            SpecialAPI::givePhantomLeggings($player);
            SpecialAPI::givePhantomBoots($player);
            SpecialAPI::givePhantomSword($player);


        }
    }

    public static function addProtection(Item $item){

        $protection = Enchantment::getEnchantmentByName("Protection");
        $protectionlevel = Loader::getInstance()->getConfig()->get("ProtectionLevel");
        $item->addEnchantment(new EnchantmentInstance($protection,$protectionlevel));
    }

    public static function addUnbreaking(Item $item){

        $unbreaking = Enchantment::getEnchantmentByName("Unbreaking");
        $unbreakinglevel = Loader::getInstance()->getConfig()->get("UnbreakingLevel");
        $item->addEnchantment(new EnchantmentInstance($unbreaking,$unbreakinglevel));
    }
    public static function addSharpness(Item $item){

        $sharpness = Enchantment::getEnchantmentByName("Sharpness");
        $sharpnesslevel = Loader::getInstance()->getConfig()->get("SharpnessLevel");
        $item->addEnchantment(new EnchantmentInstance($sharpness,$sharpnesslevel));
    }
    public static function addLightning(Player $player) :void{
            $light = new AddActorPacket();
            $light->type = "minecraft:lightning_bolt";
            $light->entityRuntimeId = Entity::$entityCount++;
            $light->metadata = [];
            $light->motion = null;
            $light->yaw = $player->getYaw();
            $light->pitch = $player->getPitch();
            $light->position = new Vector3($player->getX(), $player->getY(), $player->getZ());
            Server::getInstance()->broadcastPacket($player->getLevel()->getPlayers(), $light);
            $block = $player->getLevel()->getBlock($player->getPosition()->floor()->down());
            $particle = new DestroyBlockParticle(new Vector3($player->getX(), $player->getY(), $player->getZ()), $block);
            $player->getLevel()->addParticle($particle);
            $sound = new PlaySoundPacket();
            $sound->soundName = "ambient.weather.thunder";
            $sound->x = $player->getX();
            $sound->y = $player->getY();
            $sound->z = $player->getZ();
            $volume = Loader::getInstance()->getConfig()->get("LightningVolume");
            $sound->volume = $volume;
            $sound->pitch = 1;
            Server::getInstance()->broadcastPacket($player->getLevel()->getPlayers(), $sound);
        }

      public static function setArmourDurability(Item $item){

       $durablity = Loader::getInstance()->getConfig()->get("Durability");
       $item->setDurability($durability);


   }
    
    public static function getPlayerByName(Player $player){
      
        return $player->getName();
        
    }

}
