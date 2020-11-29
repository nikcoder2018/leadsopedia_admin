<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Integration;
use App\IntegrationData;
use App\IntegrationDataDefault;
use App\IntegrationGroup;
class IntegrationsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $integration = new Integration();
        $integration->name = $request->name;
        $integration->app_key = $request->app_key;
        $integration->description = $request->description;
        $integration->status = 'enabled';
        $integration->group_id = $request->group_id;
        $integration->scope = $request->scope;
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                // Get image file
                $image = $request->file('image');

                // Make a image name based on user name and current timestamp
                $name = Str::slug($user->name).'_'.time();

                $extension = $request->image->extension();

                $request->image->storeAs('/public/integrations/', $name.".".$extension);
                $url = Storage::url('integrations/'.$name.".".$extension);

                $integration->image = $url;
            }
        }
        $integration->save();

        if($request->get('attributes')){
            foreach($request->get('attributes') as $attr){
                IntegrationDataDefault::create([
                    'integration_id' => $integration->id,
                    'name' => $attr['name'],
                    'value' => $attr['value'],
                    'required' => 1
                ]);
            }
        }

        if($integration)
            return response()->json(array('success' => true, 'msg' => 'New Integration Created.', 'integration' => Integration::where('id', $integration->id)->with('group')->first()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $integration = Integration::with('attributes_default')->where('id',$request->id)->first();
        return response()->json($integration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $integration = Integration::find($request->id);
        $integration->name = $request->name;
        $integration->app_key = $request->app_key;
        $integration->description = $request->description;
        $integration->status = 'enabled';
        $integration->group_id = $request->group_id;
        $integration->scope = $request->scope;
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                // Get image file
                $image = $request->file('image');

                // Make a image name based on user name and current timestamp
                $name = Str::slug($user->name).'_'.time();

                $extension = $request->image->extension();

                $request->image->storeAs('/public/integrations/', $name.".".$extension);
                $url = Storage::url('integrations/'.$name.".".$extension);

                $integration->image = $url;
            }
        }
        $integration->save();

        IntegrationDataDefault::where('integration_id', $integration->id)->delete();
        if($request->get('attributes')){
            foreach($request->get('attributes') as $attr){
                IntegrationDataDefault::create([
                    'integration_id' => $integration->id,
                    'name' => $attr['name'],
                    'value' => $attr['value'],
                    'required' => 1
                ]);
            }
        }

        if($integration)
            return response()->json(array('success' => true, 'msg' => 'Integration Updated.', 'integration' => Integration::where('id', $integration->id)->with('group')->first()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Integration::find($request->id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'Integration Deleted', 'id' => $request->id));
    }
}