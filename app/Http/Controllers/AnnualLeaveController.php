<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AnnualLeave;
use Illuminate\Http\Request;
use App\Models\LeaveEmployee;
use App\Models\LeaveEmployeeDetail;
use App\Http\Resources\AnnualLeaveResource;
use App\Http\Resources\AnnualLeaveDetailResource;
use App\Http\Requests\addAnnualLeaveEmployeeRequest;
use App\Http\Requests\addTotalAnnualLeaveEmployeeRequest;
use App\Http\Requests\AnnualLeaveRequest;
use App\Http\Resources\AnnualLeaveEmployeeResource;
use App\Http\Resources\ApplicationResource;
use App\Models\LeaveApplication;

class AnnualLeaveController extends Controller
{
    public function __construct()
    {
      
        $this->middleware('can:addAnnualLeaveEmployee,App\Models\User')->only('addAnnualLeaveEmployee');
        $this->middleware('can:accAnnualLeaveEmployee,App\Models\User')->only('accAnnualLeaveEmployee');
        $this->middleware('can:readRemainingLeave,App\Models\User')->only('readRemainingLeave');
        $this->middleware('can:readRemainingLeaveEmployee,App\Models\User')->only('readRemainingLeaveEmployee');
        $this->middleware('can:leaveApplication,App\Models\User')->only('leaveApplication');
    }

    public function showRemainingAnnualLeave()
    {
        $this->authorize('readRemainingLeaveEmployee', new User);

        $employee_id = auth()->user()->id;
        $leave_employee = LeaveEmployee::where('user_id', $employee_id)->get();

        return AnnualLeaveEmployeeResource::collection($leave_employee, 200);
    }

    public function accApplication(Request $request)
    {
        $this->authorize('accAnnualLeaveEmployee', new User);
        $annual_leave_application_id = $request->application_id;

        $application = LeaveApplication::where('id', $annual_leave_application_id)->first();

        $annual_leave = $application->leave_employee->detail->update([
            'applied' => $application->total_leave,
        ]);

        if ($annual_leave) {
            $update_status_application = $application->update([
                'status' => 1
            ]);

            return $update_status_application ? $this->RequestSuccess($update_status_application) : $this->RequestFailed();
        }
        #
    }

    public function storeleaveApplication(AnnualLeaveRequest $request)
    {
        $this->authorize('leaveApplication', new User);

        $employee_id = auth()->user()->id;
        $leave_employee_id = $request->leave_employee_id;
        $leave_employee = LeaveEmployee::where('id', $leave_employee_id)->first();
        $annual_leave_remaining = $leave_employee->detail->quota - $leave_employee->detail->applied;

        if ($leave_employee->user_id != $employee_id) {
            return $this->Unauthhorized();
        } else {
            if ($request->total_leave > $annual_leave_remaining) {
                # code...
                return response()->json(['messsage' => 'melampaui batas kuota'], 502);
            } else {
                $store_leave_application = LeaveApplication::create([
                    'leave_employee_id' => $leave_employee_id,
                    'total_leave' => $request->total_leave
                ]);

                return $store_leave_application ? $this->RequestSuccess($store_leave_application) : $this->RequestFailed();
            }
        }
    }

    public function showEmployeeLeave()
    {
        $this->authorize('readRemainingLeave', new User);

        $list_annual_leave_employee = LeaveEmployee::latest()->get();

        return AnnualLeaveResource::collection($list_annual_leave_employee, 200);
    }

    public function showEmployeeLeaveDetail()
    {
        $this->authorize('readRemainingLeave', new User);

        $list_annual_leave_employee_detail = LeaveEmployeeDetail::latest()->get();

        return AnnualLeaveDetailResource::collection($list_annual_leave_employee_detail, 200);
    }

    public function AddAnnualLiveEmployee(addAnnualLeaveEmployeeRequest $request)
    {
        $this->authorize('addAnnualLeaveEmployee', new User);
        $employee_id = $request->employee_id;
        $annual_leave_id = $request->annual_leave_id;

        $store_new_data = LeaveEmployee::create([
            'user_id' => $employee_id,
            'annual_leave_id' => $annual_leave_id,
            'user' => auth()->user()->name
        ]);

        return $store_new_data ? $this->RequestSuccess($store_new_data) : $this->RequestFailed();
    }

    public function AddTotalAnnualLiveEmployee(addTotalAnnualLeaveEmployeeRequest $request)
    {
        $this->authorize('addAnnualLeaveEmployee', new User);
        $leave_employee_id = $request->leave_employee_id;

        $store_new_data = LeaveEmployeeDetail::create([
            'leave_employee_id' => $leave_employee_id,
            'quota' => $request->quota,
            // 'user' => auth()->user()->name
        ]);

        return $store_new_data ? $this->RequestSuccess($store_new_data) : $this->RequestFailed();
    }

    public function showListApplicationEmployee()
    {
        $this->authorize('readRemainingLeave', new User);
        $application_list = LeaveApplication::latest()->get();

        return ApplicationResource::collection($application_list, 200);
    }
}
