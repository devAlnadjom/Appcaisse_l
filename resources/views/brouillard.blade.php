<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="flex flex-col items-top justify-center bg-gray-300 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class=" bg-indigo-600 p-4 text-white w-full">
                <h3 class=" text-xl"> Brouillard du mois</h3>
            </div>
            <div class="min-h-screen w-full p-4  mt-10">
                <div class="bg-white w-full md:mx-4 rounded">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Concept</th>
                            <th class="px-4 py-3">Service</th>
                            <th class="px-4 py-3">Projet</th>
                            <th class="px-4 py-3">C. Coût</th>
                            <th class="px-4 py-3">Receveur/ Source</th>
                            <th class="px-4 py-3">Debit</th>
                            <th class="px-4 py-3">Crédit</th>
                            <th class="px-4 py-3">Solde</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            <tr  @class([
                                'text-red-700 dark:text-gray-400 font-extralight hover:bg-red-100',
                            ])  >

                                <td class="px-4 py-3"> -- </td>
                                <td class="px-4 py-3">Last Month</td>
                                <td class="px-4 py-3">Solde mois Precedent</td>
                                <td class="px-4 py-3"></td>
                                <td class="px-4 py-3"></td>
                                <td class="px-4 py-3">-</td>
                                <td class="px-4 py-3">-</td>
                                <td class="px-4 py-3">-</td>
                                <td class="px-4 py-3">-</td>

                                <td class="px-4 py-3 font-semibold">{{ number_format($SoldePrecedent) }}</td>


                            </tr>

                            @forelse ($ligne as $ligne)

                            <tr  @class([
                                'text-gray-700 dark:text-gray-400 font-extralight hover:bg-gray-100',
                                'bg-green-100 text-green-900' => $ligne->type_finn==2,
                            ]) style="font-weight: 400" >

                                <td class="px-4 py-3">{{ $ligne->id_finn }}</td>
                                <td class="px-4 py-3">{{ $ligne->date_finn }}</td>
                                <td class="px-4 py-3">{{ $ligne->libelle_finn }}</td>
                                <td class="px-4 py-3">{{ $ligne->service->libelle_ser }}</td>
                                <td class="px-4 py-3">{{ $ligne->projet->libelle_projet }}</td>
                                <td class="px-4 py-3">{{ $ligne->cdc->libelle_cdc}}</td>
                                <td class="px-4 py-3">C{{ $ligne->source_finn }}</td>
                                <td class="px-4 py-3">{{ $ligne->sortie_finn }}</td>
                                <td class="px-4 py-3">{{ $ligne->entre_finn }}</td>

                                <td class="px-4 py-3 font-semibold">{{ number_format($ligne->solde_finn) }}</td>


                            </tr>
                            @empty
                            <p>No Items Sorry</p>
                            @endforelse


                          </tbody>


                    </table>
                </div>

            </div>
        </div>
    </body>
</html>
