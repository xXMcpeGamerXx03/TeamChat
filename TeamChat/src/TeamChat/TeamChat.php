<?php


namespace TeamChat;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;

class TeamChat extends PluginBase implements Listener {

    public function onEnable()
    {
        $this->getLogger()->info("§8[§4TeamChat§8] §aPlugin wurde geladen!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $msg = $event->getMessage();
        $words = explode(' ', $msg);
        if ($event->getPlayer()->hasPermission('teamchat.use')) {
            if ($words[0] === '@t' or $words[0] === '@team' or $words[0] === "@teamchat") {
                array_shift($words);
                $msg = implode(" ", $words);
                $event->setCancelled();
                foreach ($this->getServer()->getOnlinePlayers() as $pn) {

                    if ($pn->hasPermission('teamchat.use')) {
                        $pn->sendMessage("§7[§4TeamChat§8] " . $player->getNameTag() . " §e» " . $msg);
                    }
                }
            }
        }
    }
}