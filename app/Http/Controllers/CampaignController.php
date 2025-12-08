<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Http\Requests\CampaignRegisterRequest;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index()
    {
        return view('campaign.form');
    }

    public function store(CampaignRegisterRequest $request)
    {
        try {
            $formData = $request->validated();
            $campaign = Campaign::where('campaign_number', $formData['campaign_number'])->where('active', true)->first();

            if (!$campaign) {
                return response()->json([
                    'success' => false,
                    'message' => 'الحملة غير موجودة أو غير فعالة!',
                ], 404);
            }

            $phone = preg_replace('/^(?:\+?972|\+?970|00972|00970)/', '', $formData['phone']);

            if (!str_starts_with($phone, '0')) {
                $phone = '0' . $phone;
            }

            $browserData = [
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'referer' => $request->headers->get('referer'),
                'accept_language' => $request->headers->get('accept-language'),
            ];

            $fingerprint = md5(
                $request->ip() .
                    $request->userAgent() .
                    json_encode($browserData)
            );

            $alreadySubmitted = Transaction::where('campaign_number', $formData['campaign_number'])
                ->where('phone',  $phone)
                ->exists();

            if ($alreadySubmitted) {
                return response()->json([
                    'success' => false,
                    'message' => 'تم التسجيل بالفعل لهذه الحملة!',
                ], 422);
            }

            $browserData['timestamp'] = now()->toISOString();

            Transaction::create(
                [
                    'campaign_id'  => $campaign->id,
                    'phone'        =>  $phone,
                    'campaign_number' => $formData['campaign_number'],
                    'ip_address'   => $request->ip(),
                    'user_agent'   => $request->userAgent(),
                    'browser_data' => $browserData,
                    'fingerprint'  => $fingerprint,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'تم التسجيل بنجاح!',
            ], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ ما',
            ], 500);
        }
    }
}
