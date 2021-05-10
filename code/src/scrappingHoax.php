<?php

require __DIR__ . "\\..\\vendor\\autoload.php";
require_once __DIR__."\\SimpleXLSX.php";

set_time_limit(10000); // 

use Goutte\Client;

class ScriptCopy
{
    public function copy_header_and_link(){
        $client = new Client();
        
        echo "<table border='1px'>";
        echo "
        <tr>
            <th>Header</th>
            <th>Link</th>
        </tr>
        ";

        //350 was the number of turnbackhoax pages
        for ($i=1; $i < 350; $i++) { 
            $crawler = $client->request('GET', 'https://turnbackhoax.id/page/'.$i);
            $data = $crawler->filter('article')->each(function ($result) {
                $column = $result->filter('h3 > a')->each(function($nested_node) {
                    $href = $nested_node->extract(array('href'));
                    echo "<tr>";
                    echo "<td>";
                    echo $nested_node->text();
                    echo "</td>";
                    echo "<td>";
                    echo $href[0];
                    echo "</td>";
                    echo "</tr>\n";
                    return $nested_node->text();
                });
                return $column;
            });
            echo $i;
        }
        echo "</table>";
    }

    public function copy_content(){
        $client = new Client();

        echo "<table border='1px'>";
        echo "
        <tr>
            
            <th>Content</th>            
        </tr>
        ";

        if ( $xlsx = SimpleXLSX::parse('Scrapping Result (Heading and Link).xlsx') ) {
            foreach($xlsx->rows() as $key => $value){
                echo "<tr>";
                // echo "<td>";
                // echo $value[0];
                // echo "</td>";
                $crawler = $client->request('GET', $value[1]);
                $data = $crawler->filter('div[class="entry-content mh-clearfix"]')->each(function ($result) {

                    echo "<td>";
                    echo $result->text();
                    echo "</td>";
                });
                echo "</tr>";
                echo $key." ";
            }
            echo "</table>";
        } else {
            echo SimpleXLSX::parseError();
        }
    }
}

$script = new ScriptCopy();

// Use one of these
$script->copy_header_and_link();
$script->copy_content();
