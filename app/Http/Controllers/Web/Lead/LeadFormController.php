<?php

namespace App\Http\Controllers\Web\Lead;

use App\Http\Controllers\Controller;
use App\Models\Lead\LeadForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LeadFormController extends Controller
{
    public function saveLeadForm(Request $request){

        $validator = Validator::make($request->all(),[
            'name'         => ['required'],
            'email'        => ['required','email:rfc,dns'],
            'address'      => ['required'],
            'phone-number' => ['required'],
            'isValidPhone' => ['required','int','digits_between:0,1'],
            'comment'      => ['required'],
        ]);

        $message = "Lead Form Failed!!";
        $status = false;
        if($validator->fails()){
            $validationErrors = $validator->errors();
        }else {
            $requestAll = $request->all();

            if($requestAll['isValidPhone']){
                $leadFormData = [
                    'name' => $requestAll['name'],
                    'email' => $requestAll['email'],
                    'address' => $requestAll['address'],
                    'phone_number' => $requestAll['phone-number'],
                    'comment' => $requestAll['comment'],
                    'reference_page' => request()->getSchemeAndHttpHost(),
                    'server_ip' => request()->ip()
                ];
                LeadForm::create($leadFormData);
                $status = true;
                $message = "Lead Form send successfully..";
            }else{
                $message .= " - Phone Number is not valid. Please Check!!";
            }
        }

        return redirect()->route('leadForm')
            ->withErrors($validationErrors ?? [])
            ->with("status",$status)
            ->with("message",$message);
    }

    public function getLeadFormList(Request $request){
        if ($request->ajax()) {
            $requestBody = $request->all();

            if($requestBody){
                $leadFormList = LeadForm::orderBy("created_at","desc")->get();

                return Datatables::of($leadFormList)
                    ->addIndexColumn()
                    ->editColumn('reference_page', function($row){
                        return  '<a  href="'.$row->reference_page.'" target="_blank">Go To Page</a>';
                    })
                    ->editColumn('created_at', function($row){
                        return  $row->created_at = Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                    })
                    ->rawColumns(['reference_page'])
                    ->setRowId(function ($row) {
                        return 'row-lead-form-'.$row->process_id;
                    })
                    ->make(true);
            }
        }
    }
}
