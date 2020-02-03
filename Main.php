<?php

namespace WF;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender, CommandExecutor};
use pocketmine\Player;

use pocketmine\event\block\BlockUpdateEvent;

use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\block\{Block, Cobblestone, Water, Fence, Iron, Diamond, Emerald, Gold, Coal, Lapis, Redstone, Stone};

class Main extends PluginBase implements Listener{
    
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§c§l\|/ §aPLUGIN Random Block Water Với Fence Đã Bật \|/");
    }
    
    public function block(BlockUpdateEvent $event){
        $block = $event->getBlock();
        $water = false;
        $fence = false;
        for ($i = 2; $i <= 5; $i++) {
            $nearBlock = $block->getSide($i);
            if ($nearBlock instanceof Water) {
                $water = true;
            } else if ($nearBlock instanceof Fence) {
                $fence = true;
            }
            if ($water && $fence) {
                $id = mt_rand(1, 20);
                switch ($id) {
                    case 2;
                        $newBlock = new Cobblestone();
                        break;
					case 4;
                        $newBlock = new Iron();
                        break;
                    case 6;
                        $newBlock = new Gold();
                        break;
                    case 8;
                        $newBlock = new Emerald();
                        break;
                    case 10;
                        $newBlock = new Coal();
                        break;
                    case 12;
                        $newBlock = new Redstone();
                        break;
					case 14;
                        $newBlock = new Lapis();
                        break;
                    case 16;
                        $newBlock = new Diamond();
                        break;
                    default:
                        $newBlock = new Cobblestone();
                        $newBlock = new Cobblestone();
                        $newBlock = new Stone();
                        $newBlock = new Stone();
                }
                $block->getLevel()->setBlock($block, $newBlock, true, false);
                return;
            }
        }
    }
}