<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;
use App\Region;
use App\Crop;
use App\Node;
use App\Area;
use App\AreaView;
use App\Soil;
use App\Coefficient;
use App\CoefficientView;
use function MongoDB\BSON\toJSON;
use DB;

class formController extends Controller
{
    //
    public function soils()
    {
        return view('pages.basic')->withTitle("soils")->withType('basic');
    }

    public function setSoils(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:soils',
            'id' => 'numeric|min:0'
        ]);
        $message = "";
        $class = "";
        if ($request->id > 0) {
            $item = Soil::find($request->id);
            if ($item === null) {
                $class = 'danger';
                $message = 'Edited item not exist in database';
            } else {
                $item->name = $request->name;
                $item->save();
                $class = "success";
                $message = "Data updated Successfully";
            }
        } else {
            $item = new Soil;
            $item->name = $request->name;
            $item->save();
            $class = "success";
            $message = "Data inserted Successfully";
        }
        return back()->with($class, $message);
    }


    public function getSoils()
    {
        return datatables(Soil::select('id', 'name')->get())->toJSON();
    }

    public function stages()
    {
        return view('pages.basic')->withTitle("stages")->withType('basic');
    }

    public function setStages(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:stages',
            'id' => 'numeric|min:0'
        ]);
        $message = "";
        $class = "";
        if ($request->id > 0) {
            $item = Stage::find($request->id);
            if ($item === null) {
                $class = 'danger';
                $message = 'Edited item not exist in database';
            } else {
                $item->name = $request->name;
                $item->save();
                $class = "success";
                $message = "Data updated Successfully";
            }
        } else {
            $item = new Stage;
            $item->name = $request->name;
            $item->save();
            $class = "success";
            $message = "Data inserted Successfully";
        }
        return back()->with($class, $message);
    }


    public function getStages()
    {
        return datatables(Stage::select('id', 'name')->get())->toJSON();
    }

    public function Regions()
    {
        return view('pages.basic')->withTitle("regions")->withType('basic');
    }

    public function setRegions(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:regions',
            'id' => 'numeric|min:0'
        ]);

        $message = "";
        $class = "";
        if ($request->id > 0) {
            $item = Region::find($request->id);
            if ($item === null) {
                $class = 'danger';
                $message = 'Edited item not exist in database';
            } else {
                $item->name = $request->name;
                $item->save();
                $class = "success";
                $message = "Data updated Successfully";
            }
        } else {
            $item = new Region;
            $item->name = $request->name;
            $item->save();
            $class = "success";
            $message = "Data inserted Successfully";
        }
        return back()->with($class, $message);
    }


    public function getRegions()
    {
        return datatables(Region::select('id', 'name')->get())->toJSON();
    }

    public function Crops()
    {
        return view('pages.basic')->withTitle("crops")->withType('basic');
    }

    public function setCrops(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:crops',
            'id' => 'numeric|min:0'
        ]);

        $message = "";
        $class = "";
        if ($request->id > 0) {
            $item = Crop::find($request->id);
            if ($item === null) {
                $class = 'danger';
                $message = 'Edited item not exist in database';
            } else {
                $item->name = $request->name;
                $item->save();
                $class = "success";
                $message = "Data updated Successfully";
            }
        } else {
            $item = new Crop;
            $item->name = $request->name;
            $item->save();
            $class = "success";
            $message = "Data inserted Successfully";
        }
        return back()->with($class, $message);
    }


    public function getCrops()
    {
        return datatables(Crop::select('id', 'name')->get())->toJSON();
    }

    public function nodes()
    {
        return view('pages.basic')->withTitle("nodes")->withType('node');
    }

    public function setNodes(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:nodes,id',
            'name' => 'required|unique:nodes,id',
        ]);

        $message = "";
        $class = "";
        $item = Node::find($request->id);
        if ($item === null) {
            $class = 'danger';
            $message = 'Edited item not exist in database';
        } else {
            $item->name = $request->name;
            $item->status = $request->status == 'active' ? true : false;
            $item->save();
            $class = "success";
            $message = "Data updated Successfully";
        }
        return back()->with($class, $message);
    }


    public function getNodes()
    {
        return datatables(Node::select('id', 'name', 'mac', DB::raw('case WHEN status = 1 then "Active" else "Disactive" end as status'), 'created_at')->get())->toJSON();
    }

    public function areas()
    {
        $regions = Region::pluck('name', 'id');
        $nodes = Node::Where('status',1)->pluck('name', 'id');
        $crops = Region::pluck('name', 'id');
        $soils = Soil::pluck('name', 'id');
        return view('pages.basic')->withTitle("areas")->withType('area')->withRegions($regions)->withSoils($soils)->withCrops($crops)->withNodes($nodes);
    }

    public function setAreas(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:areas,name',
            'crop' => 'required|exists:crops,id',
            'region' => 'required|exists:regions,id',
            'soil' => 'required|exists:soils,id',
            'node' => 'required|exists:nodes,id',
            'plantDate' => 'required|date',
            'offset' => 'required|numeric'
        ]);

        $message = "";
        $class = "";
        $find=Area::where("nodeId",$request->node)->where("status",0)->get();
        if($find->count()==0) {
            $item = new Area;
            $item->name = $request->name;
            $item->cropId = $request->crop;
            $item->nodeId = $request->node;
            $item->regionId = $request->region;
            $item->soilId = $request->soil;
            $item->plantDate = $request->plantDate;
            $item->offset = $request->offset;
            $item->save();
            $class = "success";
            $message = "Data inserted Successfully";
        }else{
            $class = "danger";
            $message = "This node already is active with another crop";
        }

        return back()->with($class, $message);
    }


    public function getAreas()
    {
        return datatables(AreaView::all())->toJSON();
    }

    public function endAreas($id){
        $message = "";
        $class = "";
        if ($id > 0) {
            $item = Area::find($id);
            if ($item === null) {
                $class = 'danger';
                $message = 'No such item';
            } else {
                $item->status = true;
                $item->save();
                $class = "success";
                $message = "This area has been done";
            }
        } else {
            $class = "danger";
            $message = "Cannot End not exist item";
        }
        return redirect()->route('form.areas.view')->with($class, $message);
    }

    public function coefficients()
    {
        $stages = Stage::pluck('name', 'id');
        $areas= Area::Where('status',0)->pluck('name', 'id');
        return view('pages.basic')->withTitle("coefficients")->withType('coefficient')->withStages($stages)->withAreas($areas);
    }

    public function setCoefficients(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'numeric|min:0',
            'area' => 'required|exists:areas,id',
            'stage' => 'required|exists:stages,id',
            'duration' => 'required|numeric',
            'value' => 'required|numeric',
        ]);

        $message = "";
        $class = "";

        if ($request->id > 0) {
            $item = Coefficient::find($request->id);
            if ($item === null) {
                $class = 'danger';
                $message = 'Edited item not exist in database';
            } else {
                $item->value = $request->value;
                $item->duration = $request->duration;
                $item->save();
                $class = "success";
                $message = "Data updated Successfully";
            }
        }else {
            $find = Coefficient::where("areaId", $request->area)->where("stageId", $request->stage)->get();
            if ($find->count()==0) {
                $item=new Coefficient;
                $item->areaId = $request->area;
                $item->stageId = $request->stage;
                $item->value = $request->value;
                $item->duration = $request->duration;
                $item->save();
                $class = "success";
                $message = "Data inserted Successfully";
            } else {
                $class = "danger";
                $message = "This item is already exist";
            }
        }

        return back()->with($class, $message);
    }


    public function getCoefficients()
    {
        return datatables(CoefficientView::all())->toJSON();
    }
}

