<?php

namespace App\Http\Controllers;

use App\Models\Padlet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PadletController extends Controller
{

    public function index(): JsonResponse
    {
        // Load all "Padlets" and relations with eager loading
        //$padlets = Padlet::all();
        //return view('padlets.index',compact('padlets'));

        $padlets = Padlet::with(['user'])->get();
        return response()->json($padlets, 200);
    }

    public function findPadletById($id): JsonResponse
    {
        $padlet = Padlet::where('id', $id)->with(['user'])->first();
        return $padlet != null ? response()->json($padlet, 200)
            : response()->json(null, 200);
    }

    // CREATE <NEW PADLET ENTRY>
    public function save(Request $request): JsonResponse
    {
        $request = $this->parseRequest($request);

        /*+
        *  use a transaction for saving model including relations
        * if one query fails, complete SQL statements will be rolled back
        */
        DB::beginTransaction();
        try {
            $padlet = Padlet::create($request->all());
            DB::commit();
            // return a vaild http response
            return response()->json($padlet, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("Saving Padlet entry failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request): Request
    {
        // Get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }

    // UPDATE <PADLET ENTRY>
    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $padlet = Padlet::with(['user'])
                ->where('id', $id)->first();
            if ($padlet != null) {
                $request = $this->parseRequest($request);
                $padlet->update($request->all());

                $padlet->save();

                DB::commit();
                $padlet1 = Padlet::with(['user'])
                    ->where('id', $id)->first();
                // return a vaild http response
                return response()->json($padlet1, 201);
            }
            return response()->json("Padlet entry not found", 420);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("Updating Padlet entry failed: " . $e->getMessage(), 420);
        }
    }

    // DELETE <PADLET ENTRY>
    public function delete(int $id): JsonResponse
    {
        $padlet = Padlet::where('id', $id)->first();
        if ($padlet != null) {
            $padlet->delete();
            return response()->json('Padlet entry (' . $id . ') successfully deleted!', 200);
        } else
            return response()->json('Padlet entry could not be deleted - it does not exist', 422);
    }
}
