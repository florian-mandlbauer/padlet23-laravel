<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PadletContainer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PadletContainerController extends Controller
{
    public function index(): JsonResponse
    {
        //dd("XXX");
        $containers = PadletContainer::with(['user', 'padlets', 'padletContainerUsers'])->get();
        return response()->json($containers, 200);
    }

    public function findContainerById($id): JsonResponse
    {
        $container = PadletContainer::where('id', $id)->with(['user', 'padlets', 'padletContainerUsers'])->first();
        return $container != null ? response()->json($container, 200)
            : response()->json(null, 200);
    }

    public function save(Request $request): JsonResponse
    {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $container = PadletContainer::create($request->all());
            DB::commit();
            return response()->json($container, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Saving PadletContainer failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request): Request
    {
        // Eingabeüberprüfung und Formatierung hier hinzufügen, falls erforderlich
        return $request;
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $container = PadletContainer::with(['user', 'padlets'])
                ->where('id', $id)->first();
            if ($container != null) {
                $request = $this->parseRequest($request);
                $container->update($request->all());
                $container->save();
                DB::commit();
                $container = PadletContainer::with(['user', 'padlets'])
                    ->where('id', $id)->first();
                return response()->json($container, 201);
            }
            return response()->json("PadletContainer not found", 420);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Updating PadletContainer failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $container = PadletContainer::where('id', $id)->first();
        if ($container != null) {
            $container->delete();
            return response()->json('PadletContainer (' . $id . ') successfully deleted!', 200);
        } else {
            return response()->json('PadletContainer could not be deleted - it does not exist', 422);
        }
    }
}
