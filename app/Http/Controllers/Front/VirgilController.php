<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Services\VirgilService;

use Virgil\Sdk\Api\VirgilApiContext;
use Virgil\Sdk\Api\AppCredentials;
use Virgil\Sdk\Api\VirgilApi;
use Virgil\Sdk\Buffer;

use Session;

class VirgilController extends Controller
{
	function __construct(VirgilService $virgil_service)
	{
		$this->VirgilService = $virgil_service;
	}

	
	/*
    | Function  : Fetching card from virgil
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function publish_card(Request $request)
    {
        $arr_response['status'] = 'error';

        $cardAsString = $request->input('exportedCard');

        $virgilApi = $this->VirgilService->serverToken();

        // import a Virgil Card from string
        $importedCard  = $virgilApi->Cards->import($cardAsString);
        $publishedCard = $virgilApi->Cards->publish($importedCard);

        $cardId = $importedCard->getCard()->getId();

        Session::put('cardId', $cardId);

        if($cardId != '')
        {
            $arr_response['status'] = 'success';
        }

        return response()->json($arr_response);
    } // end publish_card
}
