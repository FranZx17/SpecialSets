<?php


namespace vale\sets;


use pocketmine\block\Block;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\scheduler\ClosureTask;
use vale\api\PlayerAPI;
use vale\Loader;

class PhantomSet implements Listener
{

    private static $hallucinating;
    private $main;
    private $player;


    public function __construct(Loader $main)
    {
        $this->main = $main;
        $this->main->getServer()->getPluginManager()->registerEvents($this, $main);

    }

    public function onEntityDamage(EntityDamageByEntityEvent $event)
    {
        $entity = $event->getEntity();
        $damager = $event->getDamager();

        if ($entity instanceof Player) {
            if ($damager instanceof Player) {

                $helm = $entity->getArmorInventory()->getHelmet();
                $chest = $entity->getArmorInventory()->getChestplate();
                $leggings = $entity->getArmorInventory()->getLeggings();
                $boots = $entity->getArmorInventory()->getBoots();
                $helmname = Loader::getInstance()->getConfig()->get("HelmetName");
                $chestname = Loader::getInstance()->getConfig()->get("ChestPlateName");
                $leggsname = Loader::getInstance()->getConfig()->get("LeggingsName");
                $bootsname = Loader::getInstance()->getConfig()->get("BootsName");
                if ($helm->getCustomName() == $helmname) {
                    if ($chest->getCustomName() == $chestname) {
                        if ($leggings->getCustomName() == $leggsname) {
                            if ($boots->getCustomName() == $bootsname) {


                                $proc = rand(1, 30);

                                switch ($proc) {

                                    case 1:
                                        $entity->sendMessage("§r§c+25% damage");
                                        $event->setBaseDamage($event->getBaseDamage() * 1.5);
                                        $damager->getLevel()->addParticle(new DestroyBlockParticle($damager->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));

                                        break;
                                    case 2:
                                         $damager->getLevel()->addParticle(new DestroyBlockParticle($damager->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));

                                        break;

                                    case 3:
                                         PlayerAPI::addLightning($damager);
                                        
                                       
                                        break;
                                    case 4:
                                      
                                        break;

                                    case 5:
                                      
                                        break;
                                        
                                        case 6:
                                            break;
                                            
                                            case 7:
                                                break;
                                                case 8:
                                                        break;
                                                        
                                                        case 9:
                                                            break;
                                                            
                                                            case 10:
                                                                break;
                                                                    
                                                                    case 11:
                                                                        break;
                                                                        case 12:
                                                                            break;
                                                                            
                                                                            case 13:
                                                                                break;
                                                                                
                                                                                
                                                                                case 14:
                                                                                    break;
                                                                                    
                                                                                    case 15:
                                                                                        
                                                                    
                                                                                    break;
                                                                                    
                                                                                    
                                                                                    case 16:
                                                                                        break;
                                                                                        case 17:
                                                                                            break;
                                                                                            case 18:
                                                                                                break;
                                                                                                case 19:
                                                                                                    break;
                                                                                                    case 20:
                                                                                                        break;
                                                                                                        case 21:
                                                                                                            break;
                                                                                                            case 22:
                                                                                                                break;
                                                                                                                case 23:
                                                                                                                    break;
                                                                                                                    case 24:
                                                                                                                        break;
                                                                                                                        case 25:
                                                                                                                            break;
                                                                                                                            case 26:
                                                                                                                                break;
                                                                                                                                case 27:
                                                                                                                                    break;
                                                                                                                                    case 28:
                                                                                                                                        break;
                                                                                                                                        case 29:
                                                                                                                                            break;
                                                                                                                                            case 30:
                                                                                                                                                break;
                                                                                                                    
                                                                                                            
                                                                                                    
                                                                                            
                                


                                }

                            }


                        }


                    }
                }
            }
        }

    }


    public function setPlayer(Player $player)
    {

        $this->player = $player;
    }

    public function getPlayer()
    {

        return $this->player;
    }

    public function PhantomSword(EntityDamageByEntityEvent $event)
    {

        $player = $event->getDamager();
        $entity = $event->getEntity();
          
              
        if ($player instanceof Player) {
            if ($entity instanceof Player) {
              

                $inv = $player->getInventory();
                $hand = $inv->getItemInHand();
                $nbt = $hand->getNamedTag();
                // Custom \nEnchantment Book Tier: 1
                
              
                $swordname = Loader::getInstance()->getConfig()->get("PhantomSwordName");
                if ($hand->getId() == 276 and $hand->getCustomName() == $swordname) {
                    

                    $chance = rand(1, 30);
                    switch ($chance) {


                        case 1:
                            $player->sendMessage("§r§c§l+25% damage");
                            $event->setBaseDamage($event->getBaseDamage() * 2.5);
                            PlayerAPI::addLightning($entity);


                            break;

                        case 2:
                            $player->sendMessage("§r§c§lPhantom Passive Activated");
                            $speed = Effect::getEffectByName("Speed");
                            $player->addEffect(new EffectInstance($speed, 10, 20));


                            break;


                        case 3:
                            if ($entity instanceof Player && !isset(self::$hallucinating[$entity->getName()])) {
                                $originalPosition = $entity->getPosition();
                                self::$hallucinating[$entity->getName()] = true;
                                $this->main->getScheduler()->scheduleRepeatingTask(($task = new ClosureTask(function () use ($entity, $originalPosition): void {
                                    for ($x = $originalPosition->x - 1; $x <= $originalPosition->x + 1; $x++) {
                                        for ($y = $originalPosition->y - 0; $y <= $originalPosition->y + 0; $y++) {
                                            for ($z = $originalPosition->z - 1; $z <= $originalPosition->z + 1; $z++) {
                                                $position = new Position($x, $y, $z, $originalPosition->getLevel());
                                                $block = Block::get(Block::COBWEB, 0, $position);
                                                $position->getLevel()->sendBlocks([$entity], [$block]);
                                            }
                                        }
                                    }
                                })), 1);
                                $this->main->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($originalPosition, $entity, $task): void {
                                    $task->getHandler()->cancel();
                                    for ($y = -1; $y <= 3; $y++) {
                                        $startBlock = $originalPosition->getLevel()->getBlock($originalPosition->add(0, $y));
                                        $originalPosition->getLevel()->sendBlocks([$entity], array_merge([$startBlock], $startBlock->getHorizontalSides(), [
                                            $startBlock->getSide(Vector3::SIDE_NORTH)->getSide(Vector3::SIDE_EAST),
                                            $startBlock->getSide(Vector3::SIDE_NORTH)->getSide(Vector3::SIDE_WEST),
                                            $startBlock->getSide(Vector3::SIDE_SOUTH)->getSide(Vector3::SIDE_EAST),
                                            $startBlock->getSide(Vector3::SIDE_SOUTH)->getSide(Vector3::SIDE_WEST)
                                        ]));
                                    }
                                    unset(self::$hallucinating[$entity->getName()]);
                                }), 10 * 8);

                            }
                            $player->sendMessage("§r§aEnemy §r§4SLOWED");
                            break;
                        case 4:

                                        $entity->getLevel()->addParticle(new DestroyBlockParticle($entity->add(0, 1), Block::get(Block::COAL_BLOCK)));
                            $entity->setImmobile(true);
                                        $entity->sendMessage("§r§4Holy Spirits Are Haunting you");
                                        $entity->setImmobile(false);
                                        break;
                                        
                                        
                                        
                                        case 5:
                                             $player->sendMessage("§r§c§l+25% damage");
                            $event->setBaseDamage($event->getBaseDamage() * 2.5);
                            PlayerAPI::addLightning($entity);
                                            
                                            break;
                                            
                                            
                                            
                                            case 6:
                                                $entity->sendMessage("§r§c+25% damage");
                                        $event->setBaseDamage($event->getBaseDamage() * 1.5);
                                        $player->getLevel()->addParticle(new DestroyBlockParticle($player->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
                                                
                                                
                                                break;
                                                
                                                
                                                
                                                
                                                case 7:
                                                    $entity->sendMessage("§r§c+50% damage");
                                        $event->setBaseDamage($event->getBaseDamage() * 3);
                                        $player->getLevel()->addParticle(new DestroyBlockParticle($player->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
                                                    break;
                                                    
                                                    
                                                    
                                                    case 8:
                                                        break;
                                                        
                                                        case 9:
                                                            break;
                                                            
                                                            case 10:
                                                                break;
                                                                    
                                                                    case 11:
                                                                        break;
                                                                        case 12:
                                                                            break;
                                                                            
                                                                            case 13:
                                                                                break;
                                                                                
                                                                                
                                                                                case 14:
                                                                                    break;
                                                                                    case 15:
                                                                                        
                                                                    
                                                                                    break;
                                                                                    
                                                                                    
                                                                                    case 16:
                                                                                        break;
                                                                                        case 17:
                                                                                            break;
                                                                                            case 18:
                                                                                                break;
                                                                                                case 19:
                                                                                                    break;
                                                                                                    case 20:
                                                                                                        break;
                                                                                                        case 21:
                                                                                                            break;
                                                                                                            case 22:
                                                                                                                break;
                                                                                                                case 23:
                                                                                                                    break;
                                                                                                                    case 24:
                                                                                                                        break;
                                                                                                                        case 25:
                                                                                                                            break;
                                                                                                                            case 26:
                                                                                                                                break;
                                                                                                                                case 27:
                                                                                                                                    break;
                                                                                                                                    case 28:
                                                                                                                                        break;
                                                                                                                                        case 29:
                                                                                                                                            break;
                                                                                                                                            case 30:
                                                                                                                                                break;
                                                                                                                    
                                                                                                            
                                                                                                    
                                                                                            //TODO REMOVE ALL THESE CASEES AND MAKE A SIMPLIER METHOD TO DO IT
                                                     
                                                    
                                        
                    }
                }
            }
        }
    }

}









