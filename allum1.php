<?php

    $matches = 11;
    $maxMatches = 3;
    $minMatches = 1;

    function init($matches)
    {
        $start = strtolower(readline("Do you want to start ? Yes/No or enter for random : "));
        if($start == "yes")
        {
            $turn = "IA";
            defineTurn($turn, $matches);
        }
        elseif($start == "no")
        {
            $turn = "PLAYER";
            defineTurn($turn, $matches);
        }
        elseif ($start == "")
        {
            $rdm = random_int(1, 2);
            if ($rdm == 1)
            {
                $turn = "PLAYER";
                defineTurn($turn, $matches);
            }
            elseif($rdm == 2)
            {
                $turn = "IA";
                defineTurn($turn, $matches);
            }
        }
        else
        {
            init($matches);
        }
    }

    function checkWin($matches, $turn)
    {
        if($matches == 0 && $turn == "IA")
        {
            echo "I lost ... snif ... but I'll get you next time !!";
            sleep(2);
            exit;
        }
        elseif($matches == 0 && $turn == "PLAYER")
        {
            echo "You lost , too bad ...";
            sleep(2);
            exit;
        }
        else
        {
            defineTurn($turn, $matches);
        }
    }

    function defineTurn($turn, $matches)
    {
        sleep(1);
        echo "There is $matches matches !\n";
        for($i = 0; $i < $matches; $i++)
        {
            echo "|";
        }
        echo "\n";
        if($turn == "IA")
        {
            $turn = "PLAYER";
            echo "Your turn :\n";
            turnPlay($turn, $matches);
        } 
        elseif($turn == "PLAYER")
        {
            $turn = "IA";
            turnPlay($turn, $matches);
        }
    }

    function turnPlay($turn, $matches)
    {
        global $minMatches, $maxMatches;
        if($turn == "IA")
        {
            echo "IA's turn...\n";
            IATurn($matches, $turn);
        }
        elseif($turn == "PLAYER")
        {
            $value = intval($str = readline("Matches : "));

            if ($str == "" || strlen($str) > 1)
            {
                echo "Error : value can't be an empty string or a string\n";
                turnPlay($turn, $matches);
            }
            elseif($value === 0)
            {
                echo "Error : you have to remove at least one match\n";
                turnPlay($turn, $matches);
            }
            elseif($value < $minMatches)
            {
                echo "Error : invalid input (positive number expected)\n";
                turnPlay($turn, $matches);
            }

            elseif($value > $maxMatches)
            {
                echo "Error : invalid input must enter a integer between $minMatches and $maxMatches\n";
                turnPlay($turn, $matches);
            }
            else
            {
                $matches = $matches-$value;
                echo "Player removed $value match(es)\n";
                checkWin($matches, $turn);
            }
        }
    }

    function IATurn($matches, $turn)
    {
        global $minMatches, $maxMatches;
        $rdmint = random_int($minMatches, $maxMatches);

        if($rdmint > $matches)
        {
            IATurn($matches, $turn);
        }

        switch($matches)
        {
            case 11:
                $matches = $matches - 2;
                sleep(2);
                echo "IA removed 3 match(es)\n";
                checkWin($matches, $turn);
                break;
            case 10:
                $matches = $matches - 1;
                sleep(2);
                echo "IA removed 2 match(es)\n";
                checkWin($matches, $turn);
                break;

            // IF MATCHES == 9, THE PLAYER CAN ENTER A NUMBER BETWEEN 1 AND 3 AND THE IA WILL AUTOMATICLY LOSE (IF THE PLAYER DOES NOT THROW THE GAME)
            // IF THE PLAYER THROW THE GAME THERE IS 3 CONDITIONS BELOW TO STILL BEAT THE PLAYER

            case 8:
                $matches = $matches - 3;
                sleep(2);
                echo "IA removed 3 match(es)\n";
                checkWin($matches, $turn);
                break;
            case 7:
                $matches = $matches - 2;
                sleep(2);
                echo "IA removed 2 match(es)\n";
                checkWin($matches, $turn);
                break;
            case 6:
                $matches = $matches - 1;
                sleep(2);
                echo "IA removed 1 match(es)\n";
                checkWin($matches, $turn);
                break;

            // IF MATCHES == 5, THE PLAYER CAN ENTER A NUMBER BETWEEN 1 AND 3 AND THE IA WILL AUTOMATICLY LOSE
            // EXAMPLE : 
            // 5 - 1 = 4 - 3 = 1
            // 5 - 2 = 3 - 2 = 1
            // 5 - 1 = 4 - 3 = 1
            // ONLY 1 MATCH REMAINS SO THE IA MUST PICK THIS LAST ONE

            case 4:
                $matches = $matches - 3;
                sleep(2);
                echo "IA removed 3 match(es)\n";
                checkWin($matches, $turn);
                break;
            case 3:
                $matches = $matches - 2;
                sleep(2);
                echo "IA removed 2 match(es)\n";
                checkWin($matches, $turn);
                break;
            case 2:
                $matches = $matches - 1;
                sleep(2);
                echo "IA removed 1 match(es)\n";
                checkWin($matches, $turn);
                break;
            default:
                $matches = $matches - $rdmint;
                sleep(2);
                echo "IA removed $rdmint match(es)\n";
                checkWin($matches, $turn);
        }

    }

init($matches);