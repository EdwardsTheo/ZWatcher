<?php

require("../model/config.php");
require("../model/delete.php");
require("../model/insert.php");
require("../model/select.php");
require("../model/update.php");

function info_login($machine_id) {

    $req = get_listes_machine($machine_id);
    while($donnees = $req->fetch()){
        
        $login['name'] = $donnees['id_machine'];
        $login['password'] = $donnees['pwd_machine'];
        $login['ip'] = $donnees['ip'];
        $login['port'] = $donnees['port'];
    
    }
    return $login; 
}

?>