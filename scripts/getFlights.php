<?php


include "conn.php";

$sql = "SELECT `Id`, 
    DATE_FORMAT(DepartureTime, '%d.%m.%Y') AS `DepartureDate`, 
    DATE_FORMAT(DepartureTime, '%H:%i') AS `DepartureTime`, 
    DATE_FORMAT(ArrivalTime, '%d.%m.%Y') AS `ArrivalDate`, 
    DATE_FORMAT(ArrivalTime, '%H:%i') AS `ArrivalTime`, 
    `Airline`, `Cost`, `Departure`, `Destination` 
    FROM `flights` 
    WHERE DATE_FORMAT(DepartureTime, '%d.%m.%Y') >= ";


$arr = array();

if(!isset($_GET['date'])) {
    $sql = $sql . "DATE_FORMAT(DepartureTime, '%d.%m.%Y') AND Airline = ";
} else {
    $date = $_GET['date'];
    $sql = $sql . "? AND Airline = ";
    array_push($arr, $date);
}

if(!isset($_GET['airline'])) {
    $sql = $sql . "Airline AND CONCAT(DestinationCountry, \" \", Destination) = ";
} else {
    $sql = $sql . "? AND CONCAT(DestinationCountry, \" \", Destination) = ";
    array_push($arr, $_GET['airline']);
}

if(!isset($_GET['destination'])) {
    $sql = $sql . "CONCAT(DestinationCountry, \" \", Destination);";
} else {
    $sql = $sql . "?;";
    array_push($arr, $_GET['destination']);
}

// echo $sql;


$stmt = $conn->prepare($sql);
try {
    $stmt->execute($arr);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        echo "
        <div class=\"container mt-5 flight\">
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

                    <button class=\"btn-blue\" id=\"{$row['Id']}\" onclick=\"reserve('{$row['Id']}')\">Zarezerwuj</button>
                </div>
            </div>
        </div>
        ";
    }

} catch(Exception $e) { }