<?php

namespace RumDaDuMCPE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;
class CombatHUD extends PluginBase implements Listener {

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("§7[§aCOMBATHUD§7] §l§bEnabled!");
	}

	/**
	 * @priority HIGH
	 */

	public function onMove (PlayerMoveEvent $event) : bool{
		if ($this->playerIsInCombat($event->getPlayer())) {
			$this->sendHUD($event->getPlayer());
		}
	}

	public function playerIsInCombat(Player $player) : bool {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		if ($cl->setTime($player)) return true;
		return false;
	}

	public function sendHUD(Player $player) : bool {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		$timeleft = $cl->getTagDuration($player);
		$player->sendPopup(
					"§l§cYou are now engaged in combat!\n".
					"§r§bTime remaining: §a".$timeleft
				  );
	}
}
