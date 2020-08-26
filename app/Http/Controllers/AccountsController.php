<?php

namespace App\Http\Controllers;

use App\Account;

class AccountsController extends Controller
{
    /**
     * List all accounts
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        try {
            $accounts = Account::all();

            return response()->json([
                'data'  =>  $accounts
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }
    }

    /**
     * Get an account by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id){
        try {
            $account = Account::find($id);

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
     * Get the ballance for an account by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function balance($id){
        try {
            $account = Account::find($id);
            $balance = (double) number_format($account->balance, 2, '.', '');

            return response()->json([
                'data'  =>  $balance
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }
    }

    /**
     * Generate a new account number, verify if not exist and create
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(){
        try {
            $account_number = '';

            while ($account_number == '' || Account::exists($account_number)){
                $account_number = Account::generateAccountNumber();
            }

            $account = Account::create($account_number);

            return response()->json([
                'message'   =>  'Your account has been created.',
                'data'      =>  $account
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'message'   =>  'An error has occurred, please try again in some minutes.'
            ], 500);
        }

    }
}
