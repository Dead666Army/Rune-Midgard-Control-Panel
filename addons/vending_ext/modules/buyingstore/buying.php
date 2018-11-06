<?php
if (!defined('FLUX_ROOT')) {
    exit;
}

require_once 'Flux/TemporaryTable.php';

$title = "Objets en achat";

try {
    if ($server->isRenewal) {
        $fromTables = array("{$server->charMapDatabase}.item_db_re", "{$server->charMapDatabase}.item_db2_re");
    } else {
        $fromTables = array("{$server->charMapDatabase}.item_db", "{$server->charMapDatabase}.item_db2");
    }
    $itemDB = "{$server->charMapDatabase}.items";
    $tempTable = new Flux_TemporaryTable($server->connection, $itemDB, $fromTables);
    
    $bind = array();
    $sqlpartial = "WHERE 1=1 ";
    $itemName = $params->get('name');
    
    if ($itemName) {
        $sqlpartial .= "AND (i.name_japanese LIKE ? OR i.name_japanese = ?) ";
        $bind[]      = "%$itemName%";
        $bind[]      = $itemName;
    }

    $sql = "SELECT COUNT(buyingstore_id) AS total FROM buyingstore_items AS vi "
         . "LEFT JOIN items i ON i.id = vi.item_id ";
    $sth = $server->connection->getStatement("$sql $sqlpartial");
    $sth->execute($bind);
    $paginator = $this->getPaginator($sth->fetch()->total);

    $sortable = array('title', 'merchant', 'item_name' => 'asc');
    $paginator->setSortableColumns($sortable);
    
    $cols = "i.name_japanese AS item_name, i.slots, i.type, vi.item_id, vi.amount"
          . ", vi.price, v.title, v.map, v.x, v.y, v.id AS shop_id, c2.name AS merchant ";
    $sql = "SELECT $cols FROM  buyingstore_items AS vi "
         . "LEFT JOIN buyingstores AS v ON v.id = vi.buyingstore_id "
         . "LEFT JOIN items AS i ON i.id = vi.item_id "
         . "LEFT JOIN {$server->charMapDatabase}.`char` AS c2 "
         . "ON c2.char_id = v.char_id ";
    $sql = $paginator->getSQL("$sql $sqlpartial");  
    $sth = $server->connection->getStatement($sql);
    $sth->execute($bind);
    $items = $sth->fetchAll();
    
    $cards = array();
    $itemAttributes = Flux::config('Attributes')->toArray();
} catch(Exception $e) {
    $items = array();
}
