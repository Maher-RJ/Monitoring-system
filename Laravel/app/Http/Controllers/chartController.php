<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;
use DB;
use App\Light;
use App\Ph;
use App\SoilHt;
use App\WeatherHt;
use App\WindSpeed;

class chartController extends Controller
{

	public function getSingleChart()
    {
           $html =  View::make('chart',null)->render();
		   $conv = new Converter();
		   $conv->addPage($html)->save('/your/destination/path/invoice.pdf');
    }

    public function customs()
    {
        return view('pages.basic')->withTitle("customs")->withType('custom');
    }
    public function getCustoms(Request $request)
    {
        //
        if ($request->types != 1 && $request->nodes == null) {
            return null;
        }
        if (!isset($request->start)) {
            $start = null;
        } else {
            $start = $request->start;
        }
        if (!isset($request->end)) {
            $end = null;
        } else {
            $end = $request->end;
        }
        if($request->datatypes=='1') {
            return chartController::getData($request->types, $request->nodes, $start, $end, $request->number);
        }else{
            return chartController::getAvgData($request->types, $request->nodes, $start, $end, $request->number);
        }
    }

    private static function getAvgData($type, $nodes, $start, $end, $peak)
    {
        // Load DB Data
        $compare = array();
        if ($type == 1) {
            $query = WindSpeed::select(DB::raw('date(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('Avg(wind_speed) as value'));
            if ($start != null)
                $query = $query->where('create_at', '>=', $start);
            if ($end != null)
                $query = $query->where('create_at', '<=', $end);
            $data = $query->orderBy('id', 'desc')->groupBy('date')->take($peak)->get();
            $parsedData = array();
            foreach ($data as $k => $s) {
                $parsedData[] = $s;
            }
            $compare["Wind Speed Base Station"] = $parsedData;
        } else {
            foreach ($nodes as $v) {
                $data = null;
                switch ($type) {
                    case 2:
                        $query = SoilHt::select(DB::raw('date(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('avg(humidity) as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->groupBy('date')->take($peak)->get();
                        break;
                    case 3:
                        $query = WeatherHt::select(DB::raw('date(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('avg(humidity) as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->groupBy('date')->take($peak)->get();
                        break;
                    case 4:
                        $query = Light::select(DB::raw('dat(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('avg(light) as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->groupBy('Date(datetime(stamp,\'unixepoch\',\'localtime\'))')->take($peak)->get();
                        break;
                    case 5:
                        $query = SoilHt::select(DB::raw('Date(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('avg(temperature) as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->groupBy('date')->take($peak)->get();
                        break;
                    case 6:
                        $query = WeatherHt::select(DB::raw('Date(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('avg(temperature) as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->groupBy('date')->take($peak)->get();
                        break;
                    default:
                        // code...
                        break;
                }
                $parsedData = array();
                foreach ($data as $k => $s) {
                    $parsedData[] = $s;
                }

                $compare["Node" . $v] = $parsedData;
            }
        }
        return $compare;
    }

    private static function getData($type, $nodes, $start, $end, $peak)
    {
        // Load DB Data
        $compare = array();
        if ($type == 1) {
            $query = Ph::select(DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('Ph as value'));
            if ($start != null)
                $query = $query->where('create_at', '>=', $start);
            if ($end != null)
                $query = $query->where('create_at', '<=', $end);
            $data = $query->orderBy('id', 'desc')->take($peak)->get();
            $parsedData = array();
            foreach ($data as $k => $s) {
                $parsedData[] = $s;
            }
            $compare["pH"] = $parsedData;
        } else {
            foreach ($nodes as $v) {
                $data = null;
                switch ($type) {
                    case 2:
                        $query = SoilHt::select(DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('humidity as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->take($peak)->get();
                        break;
                    case 3:
                        $query = WeatherHt::select(DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('humidity as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->take($peak)->get();
                        break;
                    case 4:
                        $query = Light::select(DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('light as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->take($peak)->get();
                        break;
                    case 5:
                        $query = SoilHt::select(DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('temperature as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->take($peak)->get();
                        break;
                    case 6:
                        $query = WeatherHt::select(DB::raw('datetime(stamp,\'unixepoch\',\'localtime\') as date'), DB::raw('temperature as value'))->where('node_id', $v);
                        if ($start != null)
                            $query = $query->where('create_at', '>=', $start);
                        if ($end != null)
                            $query = $query->where('create_at', '<=', $end);
                        $data = $query->orderBy('id', 'desc')->take($peak)->get();
                        break;
                    default:
                        // code...
                        break;
                }
                $parsedData = array();
                foreach ($data as $k => $s) {
                    $parsedData[] = $s;
                }

                $compare["Node" . $v] = $parsedData;
            }
        }
        return $compare;
    }
}
