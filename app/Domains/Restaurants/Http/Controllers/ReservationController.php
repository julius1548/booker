<?php

namespace App\Domains\Restaurants\Http\Controllers;

use App\Domains\Restaurants\Actions\CreateReservationAction;
use App\Domains\Restaurants\Exceptions\NoAvailableTablesException;
use App\Domains\Restaurants\Exceptions\OccupancyOverLimitException;
use App\Domains\Restaurants\Http\Requests\StoreReservationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ReservationController
{
    public function store(StoreReservationRequest $request): JsonResponse
    {
        try {
            /** @var CreateReservationAction $action */
            $action = app(CreateReservationAction::class);
            $action->execute($request->validated());

        } catch (NoAvailableTablesException) {
            return Response::json(['success' => false, 'error' => 'There are no tables available for the selected time.'], 400);
        } catch (OccupancyOverLimitException) {
            return Response::json(['success' => false, 'error' => 'The restaurant is at full capacity during the selected time.'], 400);
        } catch (\Exception $e) {
            report($e);
            return Response::json(['success' => false, 'error' => 'Something went wrong'], 500);
        }

        return response()->json(['success' => true]);
    }
}
