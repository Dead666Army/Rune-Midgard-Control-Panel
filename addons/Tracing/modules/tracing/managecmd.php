<?php
if (!defined('FLUX_ROOT')) exit;

$title = Flux::message('JustificationEditTitle');
$atcommand_id = $params->get('atcommand_id');
$sql	= "SELECT * FROM cp_cmdjustification WHERE atcommand_id = ?";
$sth	= $server->connection->getStatement($sql);
$sth->execute(array($atcommand_id));
$new	= $sth->fetch();

if($new) { //edit justification
    $justification	= $new->justification;
   
    if(count($_POST)) {
        $justification	= trim($params->get('cmd_justification'));
        
        if($justification === '') {
			$errorMessage = Flux::message('JustificationEditError');
        }
		else {
			$sql = "UPDATE cp_cmdjustification SET ";
			$sql .= "justification = ? ";
			$sql .= "WHERE atcommand_id = ?";
            $sth = $server->connection->getStatement($sql);
			$sth->execute(array($justification, $atcommand_id));
			
			$session->setMessageData(Flux::message('JustificationEditOk'));
			if ($auth->actionAllowed('tracing', 'manage')) {
				$this->redirect($this->url('tracing', 'manage'));
			}
			else {
				$this->redirect();
			}           
		}
    }
}
else{ //add justification
    if(count($_POST)) {
        $justification	= trim($params->get('cmd_justification'));
        
        if($justification === '') {
			$errorMessage = Flux::message('JustificationEditError');
        }
		else {
            $sql = "INSERT INTO cp_cmdjustification (`atcommand_id`, `justification`)";
            $sql .= "VALUES (?, ?)"; 
            $sth = $server->connection->getStatement($sql);
			$sth->execute(array( $atcommand_id, $justification));
			
			$session->setMessageData(Flux::message('JustificationEditOk'));
			if ($auth->actionAllowed('tracing', 'manage')) {
				$this->redirect($this->url('tracing', 'manage'));
			}
			else {
				$this->redirect();
			}           
		}
    }
}
?>