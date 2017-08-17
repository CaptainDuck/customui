<?php

namespace xenialdan\customuitest\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use xenialdan\customui\network\ModalFormRequestPacket;
use xenialdan\customui\windows\ModalWindow;

class TestModalSubCommand extends SubCommand{

	public function canUse(CommandSender $sender){
		return ($sender instanceof Player) and $sender->hasPermission("cui.command.testmodal");
	}

	public function getUsage(){
		return "testmodal";
	}

	public function getName(){
		return "testmodal";
	}

	public function getDescription(){
		return "test a modal gui";
	}

	public function getAliases(){
		return [];
	}

	/**
	 * @param CommandSender $sender
	 * @param array $args
	 * @return bool
	 */
	public function execute(CommandSender $sender, array $args){
		$player = $sender->getServer()->getPlayer($sender->getName());
		$modal = new ModalWindow('Bananas', 'We finally want bananas!', 'yes', 'no');
		$pk = new ModalFormRequestPacket();
		$pk->formId = 1;
		$pk->formData = json_encode($modal);
		var_dump($pk);
		$player->dataPacket($pk);
		return true;
	}
}
