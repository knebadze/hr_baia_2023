<?php
namespace App\Traits;

use App\Models\Employer;

trait VerifyCodeTrait
{
    public function checkVerifyCode( $data )
    {
        // dd($data);
        if ($data['type'] == 'employer') {
            $employer = Employer::where('number', $data['number'])->first();
            $check = (int)$data['code'] === $employer->verify_code;
        }

        return $check;
    }
}
