<?php

class Player {
    public $name;
    private $age;
    public $points;
    public $contract;


    public function __construct($name, $age, $points) {
        $this->name = $name;
        $this->age = $age;
        $this->points = $points;
        $this->contract = "Active";

    }

    public function getAge() {
        return $this->age;
    }

    public function getPlayer() {
        return '
        <div class="player-info">
            <div class="flex-row">
            ' .
            "
                <strong>Player's Name:</strong> 
                <p>{$this->name}</p>
            </div>
            " .
            '
            <div class="flex-row">
            ' .
            "
                <strong>Players's Age:</strong> 
                <p>{$this->getAge()}</p>
            </div>
            " .
            '
            <div class="flex-row">
            ' .
            "
                <strong>Points During Last Game:</strong> 
                <p>{$this->points}</p> 
            </div>
            " .
            '
            <div class="flex-row">
            ' .
            "
                <strong>Contract Status:</strong> 
                <p>{$this->contract}</p>
            </div>
        </div>
        ";
    }
}

class Team {
    public $players = [];
    private $gamePoints = 0; 
    public $teamName;

    public function __construct($teamName) {
        $this->teamName = $teamName;
    }

    public function getTeamName() {
        return $this->teamName;
    }
 
    public function newPlayer($player) {
        $this->players[] = $player;
    }

    public function listPlayers() {
        foreach ($this->players as $player) {
            echo $player->getPlayer();
        }
    }

    public function inactiveContract($name) {
        foreach ($this->players as $player) {
            if ($player->name == $name) {
                $player->contract = "Inactive";
                return;
            }
        }
    } 

    public function activeContract($name) {
        foreach ($this->players as $player) {
            if ($player->name == $name) {
                $player->contract = "Active";

            }
        }
    }

    private function pointsSum() {
        $this->gamePoints = 0;
        foreach ($this->players as $player) {
            $this->gamePoints += $player->points;
        }
        
        return $this->gamePoints;
        
    
    }

    public function averagePointsOperation() {
        $this->gamePoints = 0;
        $players = count($this->players);
        $totalPoints = $this->pointsSum();
        return $totalPoints / $players;
    }

    public function showTotalPoints() {
        echo '
        <div class="flex-col">' . 
            "<h2>Total Game Points</h2> 
            <p>{$this->pointsSum()}</p>
        </div>";
    }

    public function showAveragePoints() {
        echo '
        <div class="flex-col">' . 
            "<h2>Average Game Points</h2> 
            <p>{$this->averagePointsOperation()}</p>
        </div>";
    }

}

$player1 = new Player("John", 20, 40);
$player2 = new Player("Sentret", 24, 25);
$player3 = new Player("Cronny", 32, 58);
$player4 = new Player("Coddie", 20, 40);
$player5 = new Player("Berry", 24, 25);
$player6 = new Player("Ronnie", 32, 58);
$player7 = new Player("Johnson Webfy", 20, 40);
$player8 = new Player("Laurent", 24, 25);
$player9 = new Player("Kennedy", 32, 58);
$lakers = new Team("Lakers");
$lakers->newPlayer($player1);
$lakers->newPlayer($player2);
$lakers->newPlayer($player3);
$lakers->newPlayer($player4);
$lakers->newPlayer($player5);
$lakers->newPlayer($player6);
$lakers->newPlayer($player7);
$lakers->newPlayer($player8);
$lakers->newPlayer($player9);
$lakers->inactiveContract("John");
?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball</title>
    <link rel="stylesheet" href="app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libertinus+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <style>
            * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto';
        color: white;
            }

         body {
            background-color: rgb(149, 142, 142);
            height: 100vh;
            background-image: url('wilson.webp');
            background-repeat: no-repeat;
            background-size: 300px;
            background-position: right bottom;
        }

        main {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .container {
            width: 100%;
            max-width: 1072px;
            padding: 0px 24px;
            margin: 0 auto;
            padding-top: 20px;


        }

        .team-header {
            display: flex;
            justify-content: center;
            text-transform:  uppercase;
            font-size: 32px;
        }

        .flex-row {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .flex-col {
            display: flex;
            flex-direction: column;
            text-align: center;

        }

        .player-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .players-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 60px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

    </style>
</head>
<body>
    <main class="container">
        <div class="team-header">
            <h1 class="team-name"><?php echo $lakers->getTeamName();?></h1>
        </div>
        <div class="players-grid">
            <?php $lakers->listPlayers(); ?>
        </div>
        <div class="info-grid">
            <?php $lakers->showTotalPoints(); ?>
            <?php $lakers->showAveragePoints(); ?>
        </div>
    </main>
    
</body>
</html>