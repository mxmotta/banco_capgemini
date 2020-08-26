<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\MovementsRequest;
use App\Movement;

class MovementsController extends Controller
{
    /**
     * List all accounts movements
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($account_id){
        try {
            $account = Account::find($account_id)->movements;

            return response()->json([
                'data'  =>  $account
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }
    }

    /**
     * List all incoming accounts movements
     * @return \Illuminate\Http\JsonResponse
     */
    public function deposits($account_id){
        try {
            $movements = Movement::deposits()->where('account_id', $account_id)->get();

            return response()->json([
                'data'  =>  $movements,
                'total' =>  $movements->sum('value')
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }
    }

    /**
     * List all out accounts movements
     * @return \Illuminate\Http\JsonResponse
     */
    public function withdraws($account_id){
        try {
            $movements = Movement::withdraws()->where('account_id', $account_id)->get();

            return response()->json([
                'data'  =>  $movements,
                'total' =>  $movements->sum('value')
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }
    }

    /**
     * Get an movement by account and movement id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id, $movement_id){
        try {
            $movement = Movement::where('account_id', $id)->where('id', $movement_id)->first();

            return response()->json([
                'data'  =>  $movement
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }
    }


    /**
     * Create a new movement
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($account_id, MovementsRequest $request){
        try {
            $account = Account::find($account_id);
            $data = $request->all();

            $movement = $account->movements()->create([
                'value' => $data['value'],
                'type'  => $data['type']
            ]);

            return response()->json([
                'message'   =>  'Your transection has been complete.',
                'data'      =>  $movement
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }

    }
}
