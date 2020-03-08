<?php

namespace App\Http\Controllers;

use App\ApiCode;
use App\District;
use App\Establishment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class EstablishmentController extends Controller
{
    public function index (Request $request) {
        $user = $request->user();
        $establishments = $user->establishments()->active()->registered()->get();
        $http_code = count($establishments) ? ApiCode::OK : ApiCode::DATA_NOT_FOUND;
        return response()->json([
            'data' => $establishments
        ], $http_code);
    }

    public function store (Request $request) {
        $request->validate([
            'establishment_type_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'address.address_line_1' => 'required',
            'address.city' => 'required',
            'address.district' => 'required',
            'address.state_id' => 'required',
            'address.pincode' => 'required',
            'address.lat' => 'required',
            'address.long' => 'required'
        ]);

        $user = $request->user();

        $establishment = Establishment::create([
            'establishment_type_id' => $request->input('establishment_type_id'),
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'is_active' => true,
            'is_registered' => true,
            'registration_date' => Carbon::now(),
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        $establishment->updateStatus('REGISTERED');

        $data = null;
        $district = District::where('name', $request->input('address.district'))->first();
        $district_id = null;
        if ($district) {
            $district_id = $district->id;
        }
        else {
            $data = [
                'district' => $request->input('address.district')
            ];
        }
        $establishment->address()->create([
            'address_line_1' => $request->input('address.address_line_1'),
            'address_line_2' => $request->has('address.address_line_2') ? $request->input('address.address_line_2') : null,
            'landmark' => $request->has('address.landmark') ? $request->input('address.landmark') : null,
            'city' => $request->input('address.city'),
            'district_id' => $district_id,
            'state_id' => $request->input('address.state_id'),
            'pincode' => $request->input('address.pincode'),
            'lat' => $request->input('address.lat'),
            'long' => $request->input('address.long'),
            'data' => $data
        ]);

        return response()->json([
            'message' => 'Establishment registered successfully.'
        ], ApiCode::CREATED);
    }

    public function show (Request $request, Establishment $establishment) {
        $user = $request->user();
        if (!$user->isAssignee($establishment)) {
            throw new UnauthorizedException('Not authorized.');
        }
        return response()->json([
            'data' => $establishment->load('address')
        ]);
    }

    public function delete (Request $request, Establishment $establishment) {
        $user = $request->user();
        if (!$user->isAssignee($establishment)) {
            throw new UnauthorizedException('Not authorized.');
        }
        $establishment->delete();
        return response()->json([
            'data' => 'Establishment deleted.'
        ]);
    }

    public function disable (Request $request, Establishment $establishment) {
        $user = $request->user();
        if (!$user->isAssignee($establishment)) {
            throw new UnauthorizedException('Not authorized.');
        }
        $establishment->disable();
        return response()->json([
            'data' => 'Establishment disabled.'
        ]);
    }

    public function enable (Request $request, Establishment $establishment) {
        $user = $request->user();
        if (!$user->isAssignee($establishment)) {
            throw new UnauthorizedException('Not authorized.');
        }
        $establishment->enable();
        return response()->json([
            'data' => 'Establishment enabled.'
        ]);
    }

    public function update (Request $request, Establishment $establishment) {
        $user = $request->user();

        if (!$user->isAssignee($establishment)) {
            throw new UnauthorizedException('Not authorized.');
        }

        $establishment->fill($request->only('establishment_type_id', 'name', 'mobile'))->save();

        $address = $establishment->address;
        $data = $address->data;
        $district_id = null;
        if ($request->has('address.district')) {
            $district = District::where('name', $request->input('address.district'))->first();
            if ($district) {
                $district_id = $district->id;
            }
            else {
                $data = [
                    'district' => $request->input('address.district')
                ];
            }
        }
        $address_data = $request->only('address.address_line_1', 'address.address_line_2', 'address.landmark', 'address.city', 'address.state_id', 'address.pincode', 'address.lat', 'address.long');
        $address_data = $address_data['address'];
        $address_data['district_id'] = $district_id;
        $address_data['data'] = $data;
        $address->fill($address_data)->save();

        return response()->json([
            'message' => 'Establishment updated successfully.'
        ], ApiCode::CREATED);
    }
}
