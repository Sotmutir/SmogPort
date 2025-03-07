<?php


include "conn.php";

if(session_status() != PHP_SESSION_ACTIVE) session_start();


$arr = array();

$sql;

if(isset($_SESSION['uId']) && isset($_SESSION['uEmail'])) {
    $sql = "SELECT f.`Id`, 
    DATE_FORMAT(f.DepartureTime, '%d.%m.%Y') AS `DepartureDate`, 
    DATE_FORMAT(f.DepartureTime, '%H:%i') AS `DepartureTime`, 
    DATE_FORMAT(f.ArrivalTime, '%d.%m.%Y') AS `ArrivalDate`, 
    DATE_FORMAT(f.ArrivalTime, '%H:%i') AS `ArrivalTime`, 
    f.`Airline`, f.`Cost`, f.`Departure`, f.`Destination`
    FROM `flights` f
    JOIN `reservedflights` r ON (f.Id = r.FlightId)";
    // array_push($arr, $_SESSION['uId']);
}



// echo $sql;


$stmt = $conn->prepare($sql);
try {
    $stmt->execute($arr);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        echo "
        <div class=\"container mt-5 flight\" id=\"{$row['Id']}\">
            <div class=\"row flight-card align-items-center\">
                <div class=\"col-md-8\">
                    <h5>{$row['Departure']} &rarr; {$row['Destination']}</h5>
                    <div class=\"row mt-3\">
                        <div class=\"col-6 col-md-4\">
                            <h3 class=\"mb-1\">Godzina odlotu</h3>
                            <div class=\"d-inline-flex gap-3\">
                                <strong>{$row['DepartureDate']}</strong>
                                <span>{$row['DepartureTime']}</span>
                            </div>
                        </div>
                        <div class=\"col-6 col-md-4\">
                            <h3 class=\"mb-1\">Godzina przylotu</h3>
                            <div class=\"d-inline-flex gap-3\">
                                <strong>{$row['ArrivalDate']}</strong>
                                <span>{$row['ArrivalTime']}</span>
                            </div>
                        </div>
                        <div class=\"col-12 col-md-4\">
                            <h3 class=\"mb-1\">Linia lotnicza</h3>
                            <div class=\"d-inline-flex gap-3\">
                                <strong style=\"font-size: 20pt;\">{$row['Airline']}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-4 mt-3 mt-md-0 d-flex flex-column align-items-end price-container\">
                    <div class=\"d-flex flex-column\">
                        <strong class=\"ta-left\">Koszt</strong>

                        <span class=\"price ta-right\">{$row['Cost']} zł</span>
                    </div>


                    <small>za osobę</small>

                    <button class=\"btn-white\" onclick=\"reserve('{$row['Id']}')\">Odwołaj rezerwację</button>
                </div>
            </div>
        </div>
        ";
    }

} catch(Exception $e) { }