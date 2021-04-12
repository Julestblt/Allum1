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
            exit("I lost ... snif ... but I'll get you next time !!");
        }
        elseif($matches == 0 && $turn == "PLAYER")
        {
            exit("You lost , too bad ...");
        }
        else
        {
            defineTurn($turn, $matches);
        }
    }

    function defineTurn($turn, $matches)
    {
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
        elseif($matches == 4)
        {
            $matches = $matches - 3;
            sleep(1);
            echo "IA removed 3 match(es)\n";
            checkWin($matches, $turn);
        }
        elseif ($matches == 3)
        {
            $matches = $matches - 2;
            sleep(1);
            echo "IA removed 2 match(es)\n";
            checkWin($matches, $turn);
        }
        elseif($matches == 2)
        {
            $matches = $matches - 1;
            sleep(1);
            echo "IA removed 1 match(es)\n";
            checkWin($matches, $turn);
        }
        else
        {
            $matches = $matches - $rdmint;
            sleep(1);
            echo "IA removed $rdmint match(es)\n";
            checkWin($matches, $turn);
        }
    }

init($matches);