<?php
    
    declare(strict_types = 1);
    
    namespace TheClimbing\RPGLike\Skills;
    

    use TheClimbing\RPGLike\Players\RPGPlayer;

    class Tank extends BaseSkill
    {
        public function __construct(RPGPlayer $owner, string $namespace)
        {

            $this->setName('Tank');
            $this->setType('passive');
            $this->setCooldownTime(0);
            $this->setRange(0);
            $this->setPlayerHealth($owner);
            parent::__construct($owner, $namespace);
        }
        public function setPlayerHealth(RPGPlayer $player)
        {
            $health = $player->getMaxHealth();
            $player->setMaxHealth((int)($health * 1.15));
        }
    }