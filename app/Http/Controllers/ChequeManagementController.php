<?php
namespace App\Http\Controllers;

use App\User;
use App\Cheque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChequeManagementcontroller extends controller
{

    public function getReturnedRecievableCheques(){
        $cheques=\DB::table('cheques')->
            where('payable_status',0)->
            where('returned_status',1)->
            where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.ReturnedCheque',compact('cheques'));
    }


    public function getSettledRecievableCheques(){
        $cheques = \DB::table('cheques')->
            where('payable_status',0)->
            where('settled_status',1)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.SettledCheque',compact('cheques'));
    }


    public function getNonSettledRecievableCheques()
    {
        $cheques = \DB::table('cheques')->
            where('payable_status',0)->
            where('returned_status',0)->
            where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.NonSettledCheque',compact('cheques'));
    }


    public function getReturnedPayableCheques(){

        $cheques=\DB::table('cheques')->
            where('payable_status',1)->
            where('returned_status',1)->
            where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.ReturnedCheque',compact('cheques'));
    }


    public function getSettledPayableCheques(){
        $cheques = \DB::table('cheques')->
            where('payable_status',1)->
            where('settled_status',1)->get();

        $cheques=$this->sortCheques($cheques);

        return view('financialManagement.SettledCheque',compact('cheques'));
    }


    public function getNonSettledPayableCheques(){
        $cheques = \DB::table('cheques')->
            where('payable_status',1)->
            where('returned_status',0)->
            where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);

        return view('financialManagement.NonSettledCheque',compact('cheques'));
    }


    public function editCheque(Request $request){

        $chequeNo=$request['chequeNo'];
        $payableStatus=\DB::table('cheques')
            ->where('cheque_no', $chequeNo)->value('payable_status');

        \DB::table('cheques')
            ->where('cheque_no', $chequeNo)
            ->update(['settled_status' => 1, 'settled_date'=>$request['settledDate']]);

    if($payableStatus==1){
        $purchaseID=\DB::table('cheques')->where('cheque_no',$chequeNo)->value('purchase_id');
        $cheques=\DB::table('cheques')->where('purchase_id',$purchaseID)->get();
        $flag=1;
        $chequeAmount=0;
        foreach ($cheques as $cheque){

            if($cheque->settled_status!=1){
                $flag=0;
            }
            else{
                $chequeAmount+=$cheque->amount;
            }
        }
        if($flag==1){
            $record=\DB::table('purchases')->where('id',$purchaseID)->get();
            if(($record[0]->cash_amount+$chequeAmount)==($record[0]->total_price)) {
                \DB::table('purchases')->where('id', $purchaseID)
                    ->update(['settle_status' => 1]);
            }
        }
        return redirect()->route('settledPayable');

    }
    else {
        $orderID=\DB::table('cheques')->where('cheque_no',$chequeNo)->value('order_id');
        $cheques=\DB::table('cheques')->where('order_id',$orderID)->get();
        $flag=1;
        $chequeAmount=0;
        foreach ($cheques as $cheque){

            if($cheque->settled_status!=1){
                $flag=0;
            }
            else{
                $chequeAmount+=$cheque->amount;
            }
        }
        if($flag==1){
            $record=\DB::table('orders')->where('id',$orderID)->get();
            if(($record[0]->cash_amount+$chequeAmount)==($record[0]->total_price)) {
                \DB::table('orders')->where('id', $orderID)
                    ->update(['settle_status' => 1]);
            }
        }
        return redirect()->route('settledRecievable');
    }

    }

    public function postEditCheque(Request $request)
    {
        $chequeNo = $request['chequeNo'];

        $cheque = \DB::table('cheques')
            ->where('cheque_no', $chequeNo)->get();
        $error = null;
        return view('financialManagement.ChequeSettlement', compact('cheque', 'error'));
    }

    public function postViewReturnRecievable(){

        $cheques=\DB::table('cheques')->
        where('payable_status',0)->
        where('returned_status',0)->
        where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.ChequeReturns',compact('cheques'));

    }

    public function postViewReturnPayable(){

        $cheques=\DB::table('cheques')->
        where('payable_status',1)->
        where('returned_status',0)->
        where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.ChequeReturns',compact('cheques'));

    }


    public function postEditReturn(Request $request){
        $chequeNo=$request['chequeNo'];

        \DB::table('cheques')
            ->where('cheque_no',$chequeNo)
            ->update(['returned_status'=>1]);

        $payableStatus=\DB::table('cheques')
            ->where('cheque_no', $chequeNo)->value('payable_status');

        $cheques=\DB::table('cheques')->
        where('payable_status',$payableStatus)->
        where('returned_status',1)->
        where('settled_status',0)->get();

        $cheques=$this->sortCheques($cheques);
        return view('financialManagement.ReturnedCheque',compact('cheques'));
    }

    public function sortCheques($cheques){

        
        $size=sizeof($cheques);
        for($j=0;$j<$size-1;$j++){
            for ($i=0;$i<$size-1-$j;$i++) {
                $date1 = $cheques[$i]->due_date;
                $date2 = $cheques[$i + 1]->due_date;
                if($date1>$date2){
                    $temp = $cheques[$i];
                    $cheques[$i] = $cheques[$i + 1];
                    $cheques[$i + 1] = $temp;
                }
            }


        }


        return $cheques;

    }



}