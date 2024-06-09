<?php

namespace App\Listeners;

use App\Models\SmsTemplate;
use App\Services\SmsService;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSmsNotificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    use InteractsWithQueue;

    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SmsNotificationEvent $event)
    {
        $data = $event->data;
        $type = $event->type;
        // dd($type);
        $smsTemplate = $this->getSmsTemplate($type); // Implement this method to get the SMS template from the database

        // Replace dynamic parameters in the template
        preg_match_all('/\{(.*?)\}/', $smsTemplate, $matches);
        $placeholders = $matches[0];
        $dynamicParams = $matches[1];

        // Replace dynamic parameters in the template
        $replacementArray = $this->buildReplacementArray($data, $dynamicParams);

        $smsMessage = str_replace($placeholders, $replacementArray, $smsTemplate);


        // Send SMS using your SMS service
        $this->smsService->sendSms($data['to'], $smsMessage, $type);
    }

    protected function getSmsTemplate($type)
    {
        // Retrieve the SMS template from the database based on your logic
        // Example: SmsTemplate::where('name', 'Deposit Notification')->first()->template;
        $cacheKey = 'all_sms_templates';
        $templates = Cache::rememberForever($cacheKey, function () use ($type) {
            return SmsTemplate::all();
        });

        $filteredTemplates = $templates->where('name', $type)->first();
        // dd($filteredTemplates->template_ka);
        return $filteredTemplates->template_ka;
    }

    protected function buildReplacementArray($data, $dynamicParams)
    {

        $replacementArray = [];


        foreach ($dynamicParams as $param) {
            // Add additional conditions or data retrieval based on dynamic parameter names
            $replacementArray[] = $data[$param] ?? '';
        }

        return $replacementArray;
    }
}
