<?php



namespace BuyFlyUI;



use pocketmine\command\{CommandSender, Command};

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\{Server, Player};



use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent};



use jojoe77777\FormAPI\{ModalFormSimple, SimpleForm};



class Main extends PluginBase implements Listener{



        public function onEnable(){

            $this->getLogger()->info("\n\n§a§lPlugin Đã Hoạt Động\n\n");

            $this->Eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");

            $this->getServer()->getPluginManager()->registerEvents($this, $this);

        }



        public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool {

            switch($cmd->getName()){

                case "buyfly":

                    $cost = 50000; // Đổi 50000 Thành Số Tiền Bạn Mún :33

                    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");

                    $form = $api->createSimpleForm(function (Player $sender, int $data = null){

                        if($data === null){

                            return true;

                        }

                        switch($data){

                            case 0:

                                $cost1 = 50000; // Đổi 50000 Thành Số Tiền Bạn Mún :33

                                $name = $sender->getName();

                                $mymoney = $this->Eco->myMoney($sender);

                                if($mymoney < $cost1) { 

                                    $sender->sendPopup("§cBạn Không Đủ Tiền Để Mua. Giá Fly Là §a$cost1");

                                }else{

                                    $sender->sendMessage("§bBạn Đã Mua Fly Thành Công");

                                    $sender->setAllowFlight(TRUE);

                                    $this->Eco->reduceMoney($name, $cost1);

                                }

                            break;

                            case 1:

                            break;

                        }

                    });

                    $form->setTitle("§a<|> §c§lBuyFly §r§a<|>");

                    $form->setContent("§c§l(!)§r§7 Giá Cost Fly:§b $cost ");

                    $form->addButton("Buy");

                    $form->addButton("No Buy");

                    $form->sendToPlayer($sender);

                    return true;

            }

        }

        

        public function JoinEvent(PlayerJoinEvent $ev){

            $sender = $ev->getPlayer();

            $sender->setAllowFlight(FALSE);

        }

        

        public function LeaveEvent(PlayerQuitEvent $ev){

            $sender = $ev->getPlayer();

            $sender->setAllowFlight(FALSE);

        }

}