<?php


namespace App\Http\Controllers\Api;

use App\Services\Stack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    /**
     * TestController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @return array
     */
    public function stackExample(Request $request)
    {

        $data = $request->request->all();
        $item = $data['item'];
        $stack = new Stack();

        foreach ($item as $key => $value) {
            $stack->push((int)$value);
        }
        return ['current' => $stack->top(), 'min' => $stack->getMin() ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function sumExample(Request $request)
    {

        $data = $request->request->all();
        $item = $data['item'];
        $sum = (int)$data['sum'];
        $arraySize = count($item);
        return ['response' => $this->checkSumValueInArray($item, $sum, $arraySize)];

    }

    /**
     * @param Request $request
     * @return array
     */
    public function childExample(Request $request)
    {
        $data = $request->request->all();
        $countStairs = (int)$data['countStairs'];
        return ['response' => $this->processStep($countStairs)];
    }

    /**
     * @param $item
     * @param $sum
     * @param $arraySize
     * @return int
     */
    private function checkSumValueInArray($item, $sum, $arraySize)
    {

        /*sort($item);
        $firstPointer = 0;
        $endPointer = $arraySize - 1;
        while ($firstPointer < $endPointer) {
            if ($item[$firstPointer] + $item[$endPointer] == $sum)
                return 1;
            else if ($item[$firstPointer] + $item[$endPointer] < $sum)
                $firstPointer++;
            else
                $endPointer--;
        }
        return 0;*/

        $hashSet =  [];
        for ($counter = 0; $counter < count($item); $counter++)
        {
            $tmp = $sum - $item[$counter];

            if (in_array($tmp, $hashSet))
            {
                return true;
            }
            array_push($hashSet, $item[$counter]);
        }
        return 0;
    }


    /**
     * @param $countStairs
     * @return int
     */
    private function processStep($countStairs)
    {

        if ($countStairs == 1 or $countStairs == 0)
            return 1;
        else if ($countStairs == 2)
            return 2;

        else
            return  $this->processStep($countStairs - 3) +
                    $this->processStep($countStairs - 2) +
                    $this->processStep($countStairs - 1);
    }

    /*public function pubish() {

        $host   = "";
        $port     = "";
        $username = "";
        $password = "";
        require("phpMQTT.php");
        //require("config.php");

        $message = "Hello CloudAMQP MQTT!";

        $mqtt = new phpMQTT($host, $port, "ClientID".rand());

        if ($mqtt->connect(true,NULL,$username,$password)) {
            $mqtt->publish("topic",$message, 0);
            $mqtt->close();
        }else{
            echo "Fail or time out";
        }
    }
    public function subscriber() {
        $host   = "";
        $port     = "";
        $username = "";
        $password = "";
        require("phpMQTT.php");
        //require("config.php");

        $mqtt = new phpMQTT($host, $port, "ClientID".rand());

        if(!$mqtt->connect(true,NULL,$username,$password)){
            exit(1);
        }

        $topics['topic'] = array("qos"=>0, "function"=>"procmsg");
        $mqtt->subscribe($topics,0);

        while($mqtt->proc()){
        }

        $mqtt->close();


        function procmsg($topic,$msg){
            echo "Msg Recieved: $msg";
        }
    }*/

}
