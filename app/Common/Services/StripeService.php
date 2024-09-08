<?php 

namespace App\Common\Services;
use Illuminate\Http\Request;

use App\Models\UserModel;
use App\Models\CardDetailsModel;

use \Stripe\Token as Token;
use \Stripe\Stripe as Stripe;
use \Stripe\Charge as Charge;
use \Stripe\Customer as Customer;

class StripeService
{
	public function __construct()
	{
		$this->stripe = Stripe::setApiKey( config('services.stripe.STRIPE_SECRET') );
	}


	/*
	| Function  : 
	| Author    : Deepak Arvind Salunke
	| Date      : 07/01/2019
	| Output    : 
	*/

	public function get_card_details( $user_id )
	{
	    $card_details = [];

	    if( !empty( $user_id ) && $user_id != null )
	    {
	        $obj_card_details = CardDetailsModel::where('user_id', $user_id)->get();

	        if($obj_card_details)
	        {
	            $arr_card_details = $obj_card_details->toArray();
	            foreach($arr_card_details as $list)
	            {
	                //\Stripe\Stripe::setApiKey( config('services.stripe.STRIPE_SECRET') );
	                $customer = Customer::retrieve( decrypt_value($list['customer_id']) );
	                $card     = $customer->sources->retrieve( decrypt_value($list['card_id']) );

	                $details['id']          = $list['id'];
	                $details['customer_id'] = encrypt_value($customer->id);
	                $details['card_id']     = encrypt_value($card->id);
	                $details['name']        = $card->name;
	                $details['card_type']   = $card->brand;
	                $details['card_no']     = $card->last4;
	                $details['exp_month']   = $card->exp_month;
	                $details['exp_year']    = $card->exp_year;
	                $details['cvv']         = 'XXX';

	                $card_details[]         = $details;
	            }
	        }
	    }

	    return $card_details;
	} // end get_card_details


	/*
	| Function  : 
	| Author    : Deepak Arvind Salunke
	| Date      : 08/01/2019
	| Output    : 
	*/

	public function store_card( $user_id, $card_data )
	{
		$data = [];

        try
        {
        	// Create a token
			$token = Token::create(array(
				"card" => array(
					"name"      => $card_data['card_name'],
					"number"    => $card_data['card_no'],
					"exp_month" => $card_data['expiry_month'],
					"exp_year"  => $card_data['expiry_year'],
					"cvc"       => $card_data['cvv'],
				)
			));
        }
        catch(\Exception $e)
        {
			$data['status']  = 'error';
			$data['message'] = $e->getMessage();
			return $data;
		}

		

		// Get Customer id if exsits or else create customer id
		$get_customer_id = CardDetailsModel::where('user_id', $user_id)->first();
		
		if(count($get_customer_id) > 0):

			$cust_list = $get_customer_id->toArray();

			// get customer id
			$customer_id = decrypt_value($cust_list['customer_id']);

		else:

			// user email id to create customer id
			$obj_user = UserModel::where('id', $user_id)->first();
			if( $obj_user ):
				$user = $obj_user->toArray();
			endif;

			try
        	{
        		// Create a new customer id
				$customer = Customer::create(array(
					"email" => $user['email']
				));
        	}
        	catch(\Exception $e)
	        {
				$data['status']  = 'error';
				$data['message'] = $e->getMessage();
				return $data;
			}

			// get customer id
			$customer_id = $customer->id;

		endif;

		try
		{
			// create new card under that customer id
			$customer = Customer::retrieve( $customer_id );
			$card = $customer->sources->create(array(
				"source" => $token
			));
		}
		catch(\Exception $e)
		{
			$data['status']  = 'error';
			$data['message'] = $e->getMessage();
			return $data;
		}
		
		$data['user_id']     = $user_id;
		$data['card_id']     = encrypt_value($card->id);
		$data['customer_id'] = encrypt_value($customer_id);

		$action = CardDetailsModel::insert($data);

		if($action):
			$data['status'] = 'success';
			return $data;
		else:
			$data['status'] = 'error';
			$data['message'] = 'Something went wrong while storing card details! Please try again.';
			return $data;
		endif;

	} // end store_card


	/*
	| Function  : 
	| Author    : Deepak Arvind Salunke
	| Date      : 08/01/2019
	| Output    : 
	*/

	public function delete_card( $user_id, $card_data )
	{
		$data = [];

        try
        {
	        $customer = Customer::retrieve( decrypt_value($card_data['customer_id']) );
	        $confirm = $customer->sources->retrieve( decrypt_value($card_data['card_id']) )->delete();
        }
        catch(\Exception $e)
        {
			$data['status']  = 'error';
			$data['message'] = $e->getMessage();
			return $data;
		}

		$data['status']  = 'error';
		$data['message'] = 'Something went wrong while deleting card details! Please try again.';

		if($confirm->deleted == true):
	        $del_card = CardDetailsModel::where('id', decrypt_value($card_data['id']) )
	                                    ->where('user_id', $user_id)
	                                    ->delete();
	        if( $del_card ):
	        	$data['status'] = 'success';
	        endif;
        endif;

        return $data;

	} // end delete_card


	/*
	| Function  : 
	| Author    : Deepak Arvind Salunke
	| Date      : 08/01/2019
	| Output    : 
	*/

	public function subscription_payment( $payment_data )
	{
		$statusMsg = null;
		$data = [];

		// for Payment
        try
        {
			$_output = Charge::create([
				"customer" => decrypt_value($payment_data['customer_id']),
				"source"   => decrypt_value($payment_data['card_id']),
				"amount"   => (int) $payment_data['payment_price'] * 100,
				'currency' => 'EUR',
			]);
        }
        catch (\Stripe\Error\RateLimit $ex_output)
        {
			$_output = $ex_output->getJsonBody();
			$statusMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }
        catch (\Stripe\Error\InvalidRequest $ex_output)
        {
			// Invalid parameters were supplied to Stripe's API
			$_output = $ex_output->getJsonBody();
			$statusMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }
        catch (\Stripe\Error\Authentication $ex_output)
        {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$_output = $ex_output->getJsonBody();
			$statusMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }
        catch (\Stripe\Error\ApiConnection $ex_output)
        {
			// Network communication with Stripe failed
			$_output = $ex_output->getJsonBody();
			$statusMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }
        catch (\Stripe\Error\Base $ex_output)
        {
			// Display a very generic error to the user, and maybe send
			$_output = $ex_output->getJsonBody();
			$statusMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }
        catch (Exception $ex_output)
        {
			// Something else happened, completely unrelated to Stripe
			$_output = $ex_output->getJsonBody();
			$statusMsg = 'Transaction failed - '.$_output['error']['message'].'.';
        }

        // If any error occur while payment
        if(($statusMsg != null) && !empty($statusMsg)):
			$data['status']  = 'error';
			$data['message'] = $statusMsg;
		endif;

		// Payment Successfully Completed
        if($_output['status'] == 'succeeded'):
			$data['status']         = 'success';
			$data['message']        = 'Payment Successfully Completed';
			$data['transaction_id'] = $_output['id'];
		endif;


        return $data;
	} // end subscription_payment
}

?>