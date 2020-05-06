<?php
    
    namespace TheClimbing\RPGLike\Commands;
    
    use pocketmine\command\Command;
    use pocketmine\command\CommandSender;
    use pocketmine\Player;

    use TheClimbing\RPGLike\Forms\RPGForms;
    use TheClimbing\RPGLike\Players\PlayerManager;
    use TheClimbing\RPGLike\RPGLike;

    class RPGCommand extends Command
    {
        private $loader;
        public function __construct(RPGLike $rpg)
        {
            parent::__construct('rpg');
            $this->loader = $rpg;
            $this->setDescription('Opens RPG Menu');
            $this->setPermission('rpgcommand');
            $this->setUsage('rpg stats|skills|upgrade or rpg help <skillName>');
        }
        public function execute(CommandSender $sender, string $commandLabel, array $args)
        {
            if($sender instanceof Player && $sender->hasPermission($this->getPermission()) || $sender->isOp()){
                $player = PlayerManager::getPlayer($sender->getName());
                if(empty($args) || $args[0] == '' || $args[0] == ' '){
                    RPGForms::menuForm($player);
                }else{
                    $args = array_map('strtolower', $args);
                    switch($args){
                        case "stats":
                            RPGForms::statsForm($player);
                            break;
                        case "skills":
                            RPGForms::skillsHelpForm($player);
                            break;
                        case "help":
                            if (array_key_exists(1, $args )){
                                RPGForms::skillHelpForm($player, $args[1]);
                            }else{
                                $sender->sendMessage($this->getUsage());
                            }
                            break;
                        case "upgrade":
                            RPGForms::upgradeStatsForm($player, 0);
                    }
                }
            }else{
                $sender->sendMessage($this->getPermissionMessage());
            }
        }
    }