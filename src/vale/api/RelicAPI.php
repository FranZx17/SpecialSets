<?php
namespace vale\api;


use pocketmine\entity\Entity;
use pocketmine\event\block\BlockBreakEvent;
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

class RelicAPI implements Listener
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
    public function onBlockBreak(BlockBreakEvent $event){
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $chance = rand(1,100);
        if($block->getId() === 1){
            if($chance === 1){


                $relic = Item::get(54, 0, 1);
                $relic->setCustomName("§r§7(§cSpecial Set Pouch§r§7)");
                $relic->setLore([
                    '§r§6Found from mining',
                    '§r§cTap the ground to open',
                    '§r§a§lCHANCE TO GET:',
                    '§r§f§l* §r§c Phantom Helmet',
                    '§r§f§l* §r§c Phantom ChestPlate',
                    '§r§f§l* §r§c Phantom Leggings',
                    '§r§f§l* §r§c Phantom Boots',
                    '§r§f§l* §r§b Yeti Helmet',
                    '§r§f§l* §r§b Yeti Chestplate',
                    '§r§f§l* §r§b Yeti Leggings',
                    '§r§f§l* §r§b Yeti Boots',
                ]);
                $player->getInventory()->addItem($relic);
                $name = $player->getName();
                $player->getServer()->broadcastMessage("§r§7(§l§c!§r§7) §r§5$name §r§7Has found a Special Set §r§4Pouch §r§7from mining");
            }



        }
    }
}
