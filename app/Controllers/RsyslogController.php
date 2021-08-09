<?php
namespace App\Controllers;

use Liman\Toolkit\Shell\Command;


class RsyslogController {
     function listClients(){


        $command=runCommand("ls /var/log/clients");
        $allDataList = explode("\n",$command);
        $data = [];
        for($i=0; $i<count($allDataList); $i++){
            $item = $allDataList[$i];
            $data[] = [
                "name" => $item,
            ];  
        }
        return view('table', [
            "value" => $data,
            "title" => ["Clients"],
            "display" => ["name"],
            "menu" => [

                "syslog 10 satır" => [
                    "target" => "list10",                                  
                ],
                "toplam satır sayısı" => [
                    "target" => "listAll",                                  
                ],
                ]
            
        ]);
    

    }
    function list10(){
        $user = request("name");
        $output=runCommand(sudo()."tail -10 /var/log/clients/". $user . "/syslog.log");
        return respond($output,200);
    }
    function listAll(){
        $user = request("name");
        $output=runCommand(sudo()."wc -l /var/log/clients/" . $user . "/*");
        return respond($output,200);
    }

}