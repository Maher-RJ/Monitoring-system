<?php

namespace App\Http\Controllers;

use App\DataProviders\DataTypeProvider;
use App\Node;
use App\DataProviders\TypeProvider;
use App\Area;
use App\Schedule;
use App\WindSpeed;
use Illuminate\Support\ServiceProvider;
use function MongoDB\BSON\toJSON;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
	
	public function getSch(){
		$nodes=Node::where('status','=','1')->get();
            $nodeC=$nodes->count();
            $areaC=Area::where('status','=','0')->get()->count();
            $wind=WindSpeed::first();

            $rnd=[];
            if($nodeC>1) {
                $rnd[0] = rand(0, $nodeC - 1);
                for($i=1;$i<$nodeC&&$i<3;$i++) {
                    do {
                        $flag=true;
                        $rnd[$i] = rand(0, $nodeC - 1);
                        for($j=0;$j<$i;$j++) {
                            if($rnd[$i]==$rnd[$j]){
                                $flag=false;
                                break;
                            }
                        }
                    } while (!$flag);
                }
            }
            $compare=array();
            for($i=0;$i<$nodeC;$i++){
                $index=$rnd[$i];
                $nodename = $nodes[$index]->name;
                $nodeid = $nodes[$index]->id;
                $sch=Schedule::select('duration as value')->Join('nodes','nodes.id','nodeId');
                $item=$sch->Where('nodes.id','=',$nodeid)->orderBy('date', 'asc')->get();

                $parsedData = array();
                foreach ($item as $k=>$s) {
                    array_push($parsedData,$s->value);
                }

                $compare[$nodename] = $parsedData;
				
            }
			$compare["number"]=$nodeC;
			return json_encode($compare);
	}
}
