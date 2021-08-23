<?php
namespace App\Http\Controllers;
use App\Models\Currency;

class MainController extends Controller
{

    public function saveCurrency()
    {
         $tableNBP = file_get_contents("https://api.nbp.pl/api/exchangerates/tables/a/?format=json");    // pobieranie kursów walut w formacie JSON z NBP
         if($tableNBP){
            $resultRate = json_decode($tableNBP,TRUE);
            foreach ($resultRate[0]["rates"] as $r){
                $tableCurrencyCheck = \App\Models\Currency::where('currency_code', $r["code"])->first(); // sprawdzanie czy istnieje waluta w bazie
                if ($tableCurrencyCheck) {                                                               // jeśli tak nadpisujemy kurs
                    $tableCurrencyCheck->currency_code = $r["code"];
                    $tableCurrencyCheck->save();
                }else{                                                                                   // jeśli nie tworzymy nowy wpis w bazie
                    $tableCurrency = \App\Models\Currency::create([
                        'name' => $r["currency"],
                        'currency_code' => $r["code"],
                        'exchange_rate' => $r["mid"]
                    ]);
                    $tableCurrency->save();
                } 
            }
         }
    }
   

    public function currency()
    {
        $this->saveCurrency();                                           // wyciągnięcie kursów walut z api NBP w formacie JSON i zapis do bazy
    
        $currency = \App\Models\Currency::orderBy('name', 'asc')->get();   // pobranie z bazy zapisanych kursów walut i przekazanie do widoku
        return view('currency', compact('currency'));
    }

   
}
