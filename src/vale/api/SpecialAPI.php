<?php


namespace vale\api;


use pocketmine\event\Listener;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\Player;
use vale\Loader;

class SpecialAPI
{

    /**
     * @var Loader
     */
    private $main;


    public function __construct(Loader $main)
    {
        $this->main = $main;

    }


    public static function givePhantomHelmet(Player $player)
    {
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


    }

    public static function givePhantomChestPlate(Player $player)
    {
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


    }


    public static function givePhantomLeggings(Player $player)
    {
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


    }


    public static function givePhantomBoots(Player $player)
    {
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


    }

    public static function givePhantomSword(Player $player){
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
    }

    /**
     * @param Player $player
     */




   /** public static function giveYetiHelmet(Player $player){
        $helmet = Item::get(310);
        PlayerAPI::addProtection($helmet);
        PlayerAPI::addUnbreaking($helmet);
        $name1 = Loader::getInstance()->getConfig()->get("YetiHelmetName");
        $helmet->setCustomName($name1);
        $helmet->setLore([
            '§r§bThe Frozen Cap of The Yeti.',
            '§r§b§lYETI SET BONUS',
            '§r§bDeal +25% damage to all enemies.',
            '§r§7(Requires all 4 Yeti Items)',

        ]);
        $player->getInventory()->addItem($helmet);


    }
   */

    /*public static function giveYetiChestPlate(Player $player){

    }

    public static function giveYetiLeggings(Player $player){



    }


    public static function giveYetiBoots(Player $player){



    }
   */
}
