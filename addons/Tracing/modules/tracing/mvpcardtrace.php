<?php
if (!defined('FLUX_ROOT')) exit;
    $cards = Flux::config('MVPCards')->toArray();;
    $listCards = "";
    foreach ($cards as $key => $value) {
        $listCards .= "'".$key."',";
    }
    $listCards = substr($listCards, 0, -1);

    $col = "nameid,card0,card1,card2,card3,amount";

    $sqlInventory  = "select $col from {$server->loginDatabase}.`inventory` where nameid in ($listCards) or card0 in ($listCards) or card1 in ($listCards) or card2 in ($listCards) or card3 in ($listCards)";
    $sthInventory  = $server->connection->getStatement($sqlInventory);
    $sthInventory->execute();
    $CardsInventory = $sthInventory->fetchAll();

    $sqlStorage  = "select $col from {$server->loginDatabase}.`storage` where nameid in ($listCards) or card0 in ($listCards) or card1 in ($listCards) or card2 in ($listCards) or card3 in ($listCards)";
    $sthStorage  = $server->connection->getStatement($sqlStorage);
    $sthStorage->execute();
    $CardsStorage = $sthStorage->fetchAll();

    $sqlGStorage  = "select $col from {$server->loginDatabase}.`guild_storage` where nameid in ($listCards) or card0 in ($listCards) or card1 in ($listCards) or card2 in ($listCards) or card3 in ($listCards)";
    $sthGStorage  = $server->connection->getStatement($sqlGStorage);
    $sthGStorage->execute();
    $CardsGStorage = $sthGStorage->fetchAll();

    $sqlCart  = "select $col from {$server->loginDatabase}.`cart_inventory` where nameid in ($listCards) or card0 in ($listCards) or card1 in ($listCards) or card2 in ($listCards) or card3 in ($listCards)";
    $sthCart  = $server->connection->getStatement($sqlCart);
    $sthCart->execute();
    $CardsCart = $sthCart->fetchAll();

?>
