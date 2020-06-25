<?php

namespace Imobinit\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Imobinit\Http\Controllers\Controller;
use Imobinit\Http\Requests\Admin\Property as PropertyRequest;
use Imobinit\Property;
use Imobinit\PropertyImage;
use Imobinit\User;

class PropertyController extends Controller
{

    public function index()
    {
        $properties = Property::orderBy('id', 'DESC')->get();

        return view('admin.properties.index',[
            'properties' => $properties
        ]);
    }


    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('admin.properties.create',[
            'users' => $users
        ]);
    }


    public function store(PropertyRequest $request)
    {
        $createProperty = Property::create($request->all());

        if($request->allFiles()){
            foreach($request->allFiles()['files'] as $image){
                $propertyImage = new PropertyImage();
                $propertyImage->property = $createProperty->id;
                $propertyImage->path = $image->storeAs('properties/' . $createProperty->id, str_slug($request->title) . '-' . str_replace('.', '', microtime(true)) . '.' . $image->extension());
                $propertyImage->save();
                unset($propetyImage);
            }
        }

        return redirect()->route('admin.properties.edit',[
            'property' => $createProperty->id
        ])->with(['color' => 'green', 'message' => 'Imovel cadastrado com sucesso!']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $property = Property::where('id', $id)->first();
        $users = User::orderBy('name')->get();

        return view('admin.properties.edit',[
            'property' => $property,
            'users'    => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $property = Property::where('id', $id)->first();
        $property->fill($request->all());

        $property->setSaleAttribute($request->sale);
        $property->setRentAttribute($request->rent);
        $property->setAirConditioningAttribute($request->air_conditioning);
        $property->setBarAttribute($request->bar);
        $property->setLibraryAttribute($request->library);
        $property->setBarbecueGrillAttribute($request->barbecue_grill);
        $property->setAmericanKitchenAttribute($request->american_kitchen);
        $property->setFittedKitchenAttribute($request->fitted_kitchen);
        $property->setPantryAttribute($request->pantry);
        $property->setEdiculeAttribute($request->edicule);
        $property->setOfficeAttribute($request->office);
        $property->setBathtubAttribute($request->bathtub);
        $property->setFirePlaceAttribute($request->fireplace);
        $property->setLavatoryAttribute($request->lavatory);
        $property->setFurnishedAttribute($request->furnished);
        $property->setPoolAttribute($request->pool);
        $property->setSteamRoomAttribute($request->steam_room);
        $property->setViewOfTheSeaAttribute($request->view_of_the_sea);

        $property->save();

        if($request->allFiles()){
            foreach($request->allFiles()['files'] as $image){
                $propertyImage = new PropertyImage();
                $propertyImage->property = $property->id;
                $propertyImage->path = $image->storeAs('properties/' . $property->id, str_slug($request->title) . '-' . str_replace('.', '', microtime(true)) . '.' . $image->extension());
                $propertyImage->save();
                unset($propetyImage);
            }
        }


        return redirect()->route('admin.properties.edit',[
            'property' => $property->id
        ])->with(['color' => 'green', 'message' => 'Imovel alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
