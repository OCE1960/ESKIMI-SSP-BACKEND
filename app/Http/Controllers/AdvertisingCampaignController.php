<?php

namespace App\Http\Controllers;

use App\Models\AdvertisingCampaign;
use App\Models\CampaignFiles;
use Illuminate\Http\Request;
use File;
use Session;
use Validator;
use Illuminate\Http\Response;

class AdvertisingCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = AdvertisingCampaign::all();
        $campaignFiles = CampaignFiles::all();
        return response()->json([
            'campaigns' => $campaigns,
            'campaignFiles' => $campaignFiles
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validateStore($request);

         //Return Erro Response if Vlidation Fails.
        if ($validator->fails()) {
            ///return response()->json($validator, 200);
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $campaign = new AdvertisingCampaign;
        $campaign->name = $request->name;
        $campaign->from = $request->from;
        $campaign->to = $request->to;
        $campaign->total_budget = $request->total_budget;
        $campaign->daily_budget = $request->daily_budget;
        $campaign->save();

        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name = time().rand(1,20).'.'.$file->extension();
                $path = $file->move(public_path('uploads'), $name);

                // save the file to the database
                $campaign_file = new CampaignFiles;
                $campaign_file->file_path = "public/uploads/".$name; 
                $campaign_file->advertising_campaign_id = $campaign->id; 
                $campaign_file->save();   
            }
        }

        return response()->json([
            'success' => true
        ], 201);

        
    }

    /**
     * Validate Record to be saved.
     *
     */
    public function validateStore(Request $request)
    {

        $validation_rules = array(
            'name' => "required|max:190",
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'total_budget' => 'required|numeric',
            'daily_budget' => 'required|numeric',
            'campaign_files' => 'nullable|mimes:jpg,png,jpeg',
        );

        $validation_messages = array(
            'required' => 'The :attribute field is required.',
        );

        $attributes = [
            'name' => 'Name',
            'from' => 'From',
            'to' => 'To',
            'total_budget' => 'Total Budget',
            'daily_budget' => 'Daily Budget',
            'campaign_files' => 'Files',
        ];

        //Create a validator for the data in the request
        return Validator::make($request->all(), $validation_rules, $validation_messages, $attributes);

    }

    /**
     * Display the specified resource to edit.
     *
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = AdvertisingCampaign::find($id);
        if($campaign === null){
            return response()->json(['errors'=>"Campaign Record does not exist"]);
        }
        return response()->json(['campaign'=>$campaign]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateStore($request);

         //Return Erro Response if Vlidation Fails.
        if ($validator->fails()) {
            ///return response()->json($validator, 200);
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $campaign = AdvertisingCampaign::find($id);
        if($campaign === null){
            return response()->json(['errors'=>"Campaign Record does not exist"]);
        }
        $campaign->name = $request->name;
        $campaign->from = $request->from;
        $campaign->to = $request->to;
        $campaign->total_budget = $request->total_budget;
        $campaign->daily_budget = $request->daily_budget;
        $campaign->save();

        if($request->hasfile('files'))
        {
            $old_files = CampaignFiles::where('advertising_campaign_id', $id)->get();
            if($old_files != null) {
                foreach($old_files as $old_file){
                    File::delete($old_file->file_path);
                    $old_file->delete();
                }
            }
            foreach($request->file('files') as $file)
            {
                $name = time().rand(1,20).'.'.$file->extension();
                $path = $file->move(public_path('uploads'), $name);

                // save the file to the database
                $campaign_file = new CampaignFiles;
                $campaign_file->file_path = "public/uploads/".$name; 
                $campaign_file->advertising_campaign_id = $campaign->id; 
                $campaign_file->save();   
            }
        }

        return response()->json([
            'success' => true
        ], 201);
    }

    /**
     * Display the specified Campaign resource.
     *
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * * @param  \App\Models\CampaignFiles  $advertisingCampaign
     * @return \Illuminate\Http\Response
     */
    public function viewCampaign($id)
    {
        $campaign = AdvertisingCampaign::find($id);
        if($campaign === null){
            return response()->json(['errors'=>"Campaign Record does not exist"]);
        }
        $files = CampaignFiles::where('advertising_campaign_id', $id)->get();
        return response()->json(['success' => true,
                                'campaign'=>$campaign,
                                'files' => $files
                                ]);
    }
}
