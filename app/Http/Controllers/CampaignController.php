<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index()
    {
        return view('campaign.form');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $campaign = Campaign::where('campaign_number', $request->input('campaign_number'))->where('active', true)->first();
            if($campaign) {
                Transaction::create([
                    'campaign_number' => $campaign->campaign_number,
                    'phone_number' => $request->input('phone_number'),
                    'date' => now(),
                ]);
                DB::commit();
                $attr['success'] = 'Transaction created successfully!';
            } else {
                DB::rollBack();
                $attr['error'] = 'Campaign number not found or active is false!';
            }
        } 
        catch (\Exception $e) {
            DB::rollBack();
            $attr['error'] = 'An error occurred: ' . $e->getMessage();
        }

        return redirect()->back()->with($attr);
    }
}
