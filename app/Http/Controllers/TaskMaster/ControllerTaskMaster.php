<?php

namespace App\Http\Controllers\TaskMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Taskmaker\cat_utrs;
use App\Models\Taskmaker\cat_actividades;
use App\Models\Taskmaker\actividades;

class ControllerTaskMaster extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $cat_utrs = cat_utrs::all();
        $cat_actividades = cat_actividades::all();
        $activitiesGrouped = $this->getActivities();

        $totalActivities = actividades::where('created_by', Auth::user()->id)->count();
        $cancelledActivities = actividades::where('created_by', Auth::user()->id)->where('estatus', 'Cancelada')->count();
        $pendingActivities = actividades::where('created_by', Auth::user()->id)->where('estatus', 'Pendiente')->count();
        $completedActivities = actividades::where('created_by', Auth::user()->id)->where('estatus', 'Completada')->count();
        $arrMonths = $this->getBlocksMonths(2025);
        $arrMonths = $arrMonths['arrMonths'];


        return Inertia::render('Taskmaster/Index', [
            'cat_utrs' => $cat_utrs,
            'cat_actividades' => $cat_actividades,
            'activitiesGrouped' => $activitiesGrouped,
            'totalActivities' => $totalActivities,
            'cancelledActivities' => $cancelledActivities,
            'pendingActivities' => $pendingActivities,
            'completedActivities' => $completedActivities,
            'arrMonths' => $arrMonths,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        DB::beginTransaction();
        try {
            $initialDate = date('Y-m-d', strtotime($request->initialDate));
            $finalDate = date('Y-m-d', strtotime($request->finalDate));

            $idUtr = $request->idUtr;
            $otherIdUtr = $request->otherIdUtr;
            $idActivity = $request->idActivity;
            $otherIdActivity = $request->otherIdActivity;
            $description = $request->activityDescription;
            $hours = $request->activityHours;

            if ($idUtr == 'other') { // Cear nueva UTR
                $cat_utrs = new cat_utrs();
                $cat_utrs->created_by = Auth::user()->id;
                $cat_utrs->nombre = $otherIdUtr;
                $cat_utrs->save();
            }
            $idUtr = ($idUtr == 'other') ? $cat_utrs->id : $idUtr; // Si es otra UTR, se asigna el id de la nueva UTR

            if ($idActivity == 'other') { // Crear nueva actividad
                $cat_actividades = new cat_actividades();
                $cat_actividades->created_by = Auth::user()->id;
                $cat_actividades->nombre = $otherIdActivity;
                $cat_actividades->save();
            }
            $idActivity = ($idActivity == 'other') ? $cat_actividades->id : $idActivity; // Si es otra actividad, se asigna el id de la nueva actividad


            $actividad = new actividades();
            $actividad->created_by = Auth::user()->id;
            $actividad->utr_id = $idUtr;
            $actividad->actividad_id = $idActivity;
            $actividad->plazo_inicial = $initialDate;
            $actividad->plazo_final = $finalDate;
            $actividad->descripcion = $description;
            $actividad->numero_horas = $hours;
            $actividad->save();

            DB::commit();
            return response()->json([
                'message' => 'Taskmaster created',
                'data' => $this->getActivities()
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error creating Taskmaster',
                'error' => $th->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function prueba()
    {
        return Inertia::render('Taskmaster/Prueba');
    }

    // Private functions
    private function getActivities()
    {
        // $maxMonth = $this->getBlocksMonths(2025);
        // $maxMonth = $maxMonth['maxMonth'];

        $activities = actividades::from('actividades as A')
            ->join('cat_utrs as B', 'A.utr_id', '=', 'B.id')
            ->join('cat_actividades as C', 'A.actividad_id', '=', 'C.id')
            ->select(
                'A.id',
                'B.id as id_utr',
                'C.id as id_actividad',
                'B.nombre as nombre_utr',
                'C.nombre as nombre_actividad',
                'A.plazo_inicial',
                'A.plazo_final',
                'A.descripcion',
                'A.numero_horas',
                'A.cadena',
                'A.repetible',
                'A.actividad_id'
            )
            ->where('A.created_by', Auth::user()->id)
            ->get();

        $activities = $activities->map(function ($activity) { // Transformar la colección para agregar los nuevos campos
            $plazoInicial = \Carbon\Carbon::parse($activity->plazo_inicial);
            $plazoFinal = \Carbon\Carbon::parse($activity->plazo_final);

            // Agregar los nuevos campos
            $activity->plazoInicialMes = $plazoInicial->month; // Mes del plazo inicial
            $activity->plazoInicialDia = $plazoInicial->day;   // Día del plazo inicial
            $activity->plazoFinalMes = $plazoFinal->month;     // Mes del plazo final
            $activity->plazoFinalDia = $plazoFinal->day;       // Día del plazo final

            $activity->maxBlocks = $this->getBlocksMonths(2025, $activity->actividad_id, $activity->id_utr)['maxMonth'];

            return $activity;
        });

        // Agrupar por nombre_utr y luego por nombre_actividad
        $activitiesGrouped = $activities->groupBy('nombre_utr')->map(function ($group) {
            return $group->groupBy('nombre_actividad');
        });


        function datoYaExiste($array, $id, $mes, $bloque, $utrId)
        {
            foreach ($array as $item) {
                if ($item['id'] == $id && $item['mes'] == $mes && $item['bloque'] == $bloque && $item['utrId'] == $utrId) {
                    return true; // El dato ya existe
                }
            }
            return false; // El dato no existe
        }

        $array_bloques_asignados = [];

        foreach ($activitiesGrouped as $utrName => $activities) { // Recorrer las UTRs
            foreach ($activities as $activityName => $activityList) { // Recorrer las actividades
                $maxBlock = $activityList[0]->maxBlocks;

                foreach ($activityList as $activity) { // Recorrer las actividades
                    for ($mes = $activity->plazoInicialMes; $mes <= $activity->plazoFinalMes; $mes++) { // Recorrer los meses que abarca la actividad
                        for ($b = 1; $b <= $maxBlock; $b++) { // Recorrer los bloques que hay
                            if (!datoYaExiste($array_bloques_asignados, $activity->id_actividad, $mes, $b, $activity->id_utr)) {
                                $array_bloques_asignados[] = [
                                    'id' => $activity->id_actividad,
                                    'actId' => $activity->id,
                                    'mes' => $mes,
                                    'bloque' => $b,
                                    'utrId' => $activity->id_utr
                                ];
                                break;
                            }
                        }
                    }

                    $maxBloque = 0;
                    foreach ($array_bloques_asignados as $bloque) {
                        if ($bloque['actId'] == $activity->id && $bloque['bloque'] > $maxBloque) {
                            $maxBloque = $bloque['bloque'];
                        }
                    }
                    // Actualizar todos los bloques del mismo actId al valor máximo encontrado
                    foreach ($array_bloques_asignados as &$bloque) {
                        if ($bloque['actId'] == $activity->id) {
                            $bloque['bloque'] = $maxBloque;
                        }
                    }
                    // Eliminar la referencia para evitar efectos secundarios
                    unset($bloque);
                }
            }
        }

        foreach ($array_bloques_asignados as $item) {
            $actId = $item['actId'];
            $bloque = $item['bloque'];

            // Si el actId no existe en el array o el bloque actual es mayor, lo actualizamos
            if (!isset($result[$actId]) || $bloque > $result[$actId]) {
                $result[$actId] = $bloque;
            }
        }

        foreach ($activitiesGrouped as &$utr) {
            foreach ($utr as &$actividades) {
                foreach ($actividades as &$actividad) {
                    $id = $actividad['id'];
                    // Verificamos si el id existe en $result y asignamos el valor de bloque
                    if (isset($result[$id])) {
                        $actividad['bloque'] = $result[$id];
                    } else {
                        // Si no existe, puedes asignar un valor por defecto (opcional)
                        $actividad['bloque'] = 0; // O cualquier otro valor que desees
                    }
                }
            }
        }


        return $activitiesGrouped;
    }

    private function getBlocksMonths($yearValue, $activityId = null, $urtId = null)
    {
        // Obtener el número máximo de bloques por mes
        $maxMonth = DB::table(DB::raw('(SELECT 1 AS mes UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION
        SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS meses'))
            ->leftJoin('actividades', function ($join) use ($yearValue) {
                $join->on(DB::raw('meses.mes'), '>=', DB::raw('MONTH(actividades.plazo_inicial)'))
                    ->on(DB::raw('meses.mes'), '<=', DB::raw('MONTH(actividades.plazo_final)'))
                    ->whereYear('actividades.plazo_inicial', $yearValue); // Filtra por año
            })
            ->selectRaw('COUNT(actividades.id) AS bloques')
            ->where('actividades.created_by', Auth::user()->id)
            ->when($activityId, function ($query, $activityId) {
                return $query->where('actividades.actividad_id', $activityId);
            })
            ->when($urtId, function ($query, $urtId) {
                return $query->where('actividades.utr_id', $urtId);
            })
            ->groupBy('meses.mes')
            ->orderByDesc('bloques')
            ->get();

        $maxMonth = $maxMonth->max('bloques');

        // Definir los meses del año con sus nombres
        $monthsYear = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $arrMonths = [];

        // Crear el arreglo de meses con bloques
        foreach ($monthsYear as $id => $label) {
            $bloques = [];
            for ($i = 1; $i <= $maxMonth; $i++) {
                $bloques[] = [
                    'idblock' => $i,
                ];
            }
            $arrMonths[] = [
                'id' => $id,
                'label' => $label,
                'bloques' => $bloques
            ];
        }

        return [
            'maxMonth' => $maxMonth,
            'arrMonths' => $arrMonths
        ];
    }
}
