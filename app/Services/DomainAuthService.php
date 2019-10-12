<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 10:09 PM
 */

namespace App\Services;


use App\Domain;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DomainAuthService
{
    /**
     * @param $domain
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth($domain)
    {
        try {
            $result = dns_get_record($domain, DNS_TXT);
            foreach ($result as $item) {
                if (isset($item['txt'])) {
                    $text = $item['txt'];
                    $data = explode("=", $text);
                    if (isset($data)) {
                        if ($data[0] == Domain::DOMAIN_VERIFY_PREFIX) {
                            $user_token = $domain = Domain::select('hash_key')->where('user_id',Auth::id())->first();
                            if ($data[1] == $user_token->hash_key) {
                                $token = $data[1];
                                break;
                            }
                        }
                    }
                }
            }
            if (isset($token)) {
                Domain::where('name', $domain)
                    ->where('hash_key', $token)
                    ->update([
                        'status' => 1
                    ]);
                $status = Response::HTTP_OK;
                $message = 'Successfully authorized.';
            } else {
                $status = Response::HTTP_NOT_FOUND;
                $message = 'Token not founded.';
            }
            return response()->json([
                'message' => $message,
                'data' => []
            ])->setStatusCode($status);
        } catch (\Exception $exception) {

        }
    }
}