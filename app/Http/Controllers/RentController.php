<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\item;
use App\RentListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{
	private $itemStatus = "";

	public function validation($request){
		return [
		   	'RentDate' => 'date|required',
		   	'ReturnDate' => 'date'
		];
	}

	public function rentValidateandUpdate(Request $request, item $item){

		// $this->validate($request, [
		// 	'Rent Date' => 'date|required',
		// 	'Return Date' => 'date'
		// 	]);

		$validator = Validator::make($request->all(), $this->validation($request));

		if ($validator->fails()) {
			return redirect('/home')
			->withErrors($validator)
			->withInput();
		}

		$this->itemStatus = 'Reserved';

		// dd(
		// 	$request->input('hiddenid'),
		// 	$request->input('RentDate'),
		// 	$request->input('ReturnDate'),
		// 	$request->input('Note')
		// );

		$returnStatus = $item->updateItem($item,$request,$this->itemStatus);
		if($returnStatus['status'] == "success"){
			flash($returnStatus['message'],'info');
			return redirect('/home');
		}

		flash($returnStatus['message'],'warning');
		return redirect('/home');
	}

	public function approveRent(RentListItem $rent)
	{

		$this->itemStatus = 'Borrowed';
		$returnStatus = $rent->setRentApprove($rent,$this->itemStatus);

		if($returnStatus['status'] == "success"){
			flash($returnStatus['message'],'info');
			return redirect('/home');
		}

		flash($returnStatus['message'],'warning');
		return redirect('/home');

	}

	
}
