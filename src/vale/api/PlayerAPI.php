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

    public function onPhantomPackage(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $inv = $player->getInventory();
        $hand = $inv->getItemInHand();
        $nbt = $hand->getNamedTag();
        // Custom \nEnchantment Book Tier: 1
        if ($hand->getId() == 54 and $hand->getDamage() == 0 and $hand->getCustomName() == "§r§7Special Set §c§lPhantom") {
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

    public static function addProtection(Item $item)
    {

        $protection = Enchantment::getEnchantmentByName("Protection");
        $protectionlevel = Loader::getInstance()->getConfig()->get("ProtectionLevel");
        $item->addEnchantment(new EnchantmentInstance($protection, $protectionlevel));
    }

    public static function addUnbreaking(Item $item)
    {

        $unbreaking = Enchantment::getEnchantmentByName("Unbreaking");
        $unbreakinglevel = Loader::getInstance()->getConfig()->get("UnbreakingLevel");
        $item->addEnchantment(new EnchantmentInstance($unbreaking, $unbreakinglevel));
    }

    public static function addSharpness(Item $item)
    {

        $sharpness = Enchantment::getEnchantmentByName("Sharpness");
        $sharpnesslevel = Loader::getInstance()->getConfig()->get("SharpnessLevel");
        $item->addEnchantment(new EnchantmentInstance($sharpness, $sharpnesslevel));
    }

    public static function addLightning(Player $player): void
    {
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

    public static function setArmourDurability(Item $item)
    {
        //MAKE UNBREAKABLE
    }

    public static function getPlayerByName(Player $player)
    {

        return $player->getName();

    }

    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $inv = $player->getInventory();
        $hand = $inv->getItemInHand();
        if ($player->getInventory()->getItemInHand()->getId() === 54 and $player->getInventory()->getItemInHand()->getCustomName() === "§r§7(§cSpecial Set Pouch§r§7)") {
            $hand->setCount($hand->getCount() - 1);
			$inv->setItemInHand($hand);
			$event->setCancelled(true);
            self::giveRandomReward($player);

        }
    }

    public static function giveRandomReward(Player $player): void
    {
        if ($player instanceof Player) {

            $reward = rand(1, 5);
            switch ($reward) {

                case 1:
                    $helmet = Item::get(310);
                    PlayerAPI::addProtection($helmet);
                    PlayerAPI::addUnbreaking($helmet);
                    $name1 = Loader::getInstance()->getConfig()->get("HelmetName");
                    $helmet->setCustomName($name1);
                    $helmet->setLore([
                        '§r§cThe Fabeled Hood of The Phantom.',
                        '§r§c§lPHANTOM SET BONUS',
                        '§r§cDeal +25% damage to all enemies.',
                        '§r§7(Requires all 4 Phantom Items)',

                    ]);
                    $player->getInventory()->addItem($helmet);
                    break;



                case 2:



                    $boots = Item::get(313);
                    PlayerAPI::addProtection($boots);
                    PlayerAPI::addUnbreaking($boots);
                    $name4 = Loader::getInstance()->getConfig()->get("BootsName");
                    $boots->setCustomName($name4);
                    $boots->setLore([
                        '§r§cThe Fabeled Cleaves of The Phantom.',
                        '§r§c§lPHANTOM SET BONUS',
                        '§r§cDeal +25% damage to all enemies.',
                        '§r§7(Requires all 4 Phantom Items)',


                    ]);
                    $player->getInventory()->addItem($boots);
                    break;



                case 3:
                    $legg = Item::get(312);
                    PlayerAPI::addProtection($legg);
                    PlayerAPI::addUnbreaking($legg);
                    $name3 = Loader::getInstance()->getConfig()->get("LeggingsName");
                    $legg->setCustomName($name3);
                    $legg->setLore([
                        '§r§cThe Fabeled Leggs of The Phantom.',
                        '§r§c§lPHANTOM SET BONUS',
                        '§r§cDeal +25% damage to all enemies.',
                        '§r§7(Requires all 4 Phantom Items)',


                    ]);
                    $player->getInventory()->addItem($legg);
                    break;

                case 4:
                    $chest = Item::get(311);
                    PlayerAPI::addProtection($chest);
                    PlayerAPI::addUnbreaking($chest);
                    $name2 = Loader::getInstance()->getConfig()->get("ChestPlateName");
                    $chest->setCustomName($name2);
                    $chest->setLore([
                        '§r§cThe Fabeled Robe of The Phantom.',
                        '§r§c§lPHANTOM SET BONUS',
                        '§r§cDeal +25% damage to all enemies.',
                        '§r§7(Requires all 4 Phantom Items)',

                    ]);
                    $player->getInventory()->addItem($chest);
                    break;


                case 5:
                    $sword = Item::get(276);
                    PlayerAPI::addUnbreaking($sword);
                    PlayerAPI::addSharpness($sword);
                    $swordcustomname = Loader::getInstance()->getConfig()->get("PhantomSwordName");
                    $sword->setCustomName($swordcustomname);
                    $sword->setLore([
                        '§r§c§lPHANTOM WEAPON BONUS',
                        '§r§cDeal +10% damage to all enemies',



                    ]);
                    $player->getInventory()->addItem($sword);


                    break;


            }

        }

      
    }

}
