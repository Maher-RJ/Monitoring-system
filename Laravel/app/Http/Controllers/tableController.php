<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegionView;
use App\ScheduleView;
use function MongoDB\BSON\toJSON;
use DB;
use App\Light;
use App\Ph;
use App\Node;
use App\SoilHt;
use App\WeatherHt;
use App\WindSpeed;

class tableController extends Controller
{
    //
    public function fields()
    {
        return view('pages.basic')->withTitle("fields")->withType('field');
    }

    public function getFields()
    {
        return datatables(RegionView::all())->toJSON();
    }

    public function schedules()
    {
        return view('pages.basic')->withTitle("schedules")->withType('schedule');
    }

    public function getSchedules()
    {
        return datatables(ScheduleView::all())->toJSON();
    }

    public function datatable($table)
    {
        $title="";
        $type="data";
        switch ($table){
            case 1:$title="Light";$link="light";break;
            case 2:$title="Wind Speed";$link="wind";break;
            case 3:$title="Air Humidity";$link="ahumidity";break;
            case 4:$title="Soil Moisture";$link="shumidity";break;
            case 5:$title="Soil Temperature";$link="stemperature";break;
            case 6:$title="Air Temperature";$link="atemperature";break;
            case 7:$title="PH";$link="ph";break;
        }
        return view('pages.basic')->withTitle($title)->withType($type)->withLink($link);
    }

    public function getDatatable($table)
    {
        $mode=null;
        switch ($table) {
            case 1:
                $model = Light::select('name as node','light as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'light.node_id')->get();
                break;
            case 2:
                $model = WindSpeed::select('General as node','wind_speed as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->get();
                break;
            case 3:
                $model = WeatherHt::select('name as node','humidity as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'weather_ht.node_id')->get();
                break;
            case 4:
                $model = SoilHt::select('name as node','humidity as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'soil_ht.node_id')->get();
                break;
            case 5:
                $model = SoilHt::select('name as node','temperature as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'soil_ht.node_id')->get();
                break;
            case 6:
                $model = WeatherHt::select('name as node','temperature as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'weather_ht.node_id')->get();
                break;
            case 7:
                $model = Ph::select('name as node','ph as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'ph.node_id')->get();
                break;
        }
        return datatables($model)->toJSON();
    }

	public function getLastData(){
			$nodes=Node::where('status','=','1')->get();
            $compare=array();
			$i=0;
			foreach ($nodes as $k=>$s) {
				$item=array();
				$id=$s->id;
				//DB::enableQueryLog(); // Enable query log

				$model1 = WeatherHt::select('humidity as h','temperature as t',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->where("node_id",'like',$s->id)->orderby('id','desc')->first();
				$model2 = SoilHt::select('name as node','humidity as h','temperature as t',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->join('nodes', 'nodes.id', '=', 'soil_ht.node_id')->where("node_id","like",$s->id)->orderby("soil_ht.id",'desc')->orderby('soil_ht.id','desc')->first();
				$model3 = Ph::select('ph as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->where("node_id","like",$s->id)->orderby("id",'desc')->orderby('id','desc')->first();
				#$model4 = WindSpeed::select('wind_speed as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->orderby("id",'desc')->orderby('id','desc')->first();
				$model5 = Light::select('light as value',DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as time'))->where("node_id",'like',$s->id)->orderby('id','desc')->first();

				//dd(DB::getQueryLog()); // Show results of log

				$item=["name"=>$model2['node'],"light"=>$model5['value'],"wh"=>$model1['h'],"wt"=>$model1['t'],"sh"=>$model2['h'],"st"=>$model2['t'],"ph"=>$model3['value'],"wind"=>$model4['value'],"at"=>$model3['time']];
				$compare[$i++] = $item;
			}
			return json_encode(["data"=>$compare]);
	}
}
