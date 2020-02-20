<?php

namespace App\Providers;
use App\DataProviders\DataTypeProvider;
use App\Node;
use App\DataProviders\TypeProvider;
use App\Area;
use App\Schedule;
use App\WindSpeed;
use Illuminate\Support\ServiceProvider;
use function MongoDB\BSON\toJSON;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //
        view()->composer(['partial.forms._chart'], function ($view) {
            $view->with('data',
                ['nodes'=>Node::pluck('name','id'),"types"=>TypeProvider::make(),"datatypes"=>DataTypeProvider::make()]);
        });

        view()->composer(['dashboard'], function ($view) {
            $nodes=Node::where('status','=','1')->get();
            $nodeC=$nodes->count();
            $areaC=Area::where('status','=','0')->get()->count();
            $wind=WindSpeed::first();

            $rnd=[];
            if($nodeC>0) {
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
            for($i=1;$i<$nodeC;$i++){
                $index=$rnd[$i];
                $nodename = $nodes[$index]->name;
                $nodeid = $nodes[$index]->id;
                $sch=Schedule::select('name','nodes.id as node','schedules.created_at as date','duration as value')->Join('nodes','nodes.id','nodeId');
                $item=$sch->Where('nodes.id','=',$nodeid)->orderBy('date', 'asc')->get();

                $parsedData = array();
                foreach ($item as $k => $s) {
                    $parsedData[] = $s;
                }

                $compare[$nodename] = $parsedData;
            }
            $view->with('dashboard',
                ['nodec'=>$nodeC,'areac'=>$areaC,'wind'=>$wind->wind_speed,'winddate'=>$wind->create_at,'data'=>$compare]);
        });


    }
}
