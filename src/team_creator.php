<?php
session_start();
// Connect to MySQL server, select database
$mysqli = new mysqli('sql211.infinityfree.com', 'if0_36325610', 'Crackerines', 'if0_36325610_pokemon');

// Check connection
if ($mysqli->connect_error) {
    die('Could not connect: ' . $mysqli->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Creator</title>
    <link rel="stylesheet" href="styles/creator_styles.css">
    <link rel="stylesheet" href="styles/creator_styles_autocomplete.css">
    <link rel="stylesheet" href="styles/creator_styles_filtering.css">
    <link rel="stylesheet" href="styles/creator_styles_results.css">
    <link rel="stylesheet" href="styles/creator_styles_min_values.css">
    <script src="./js/autocomplete.js"></script>
</head>
<body>
    <div class="header_bar">
        <!-- back button -->
        <input class="back_button" type="submit" value="Back" onclick="window.location='./index.html'">
        <!-- header text -->
        <h1 class="title_text"> Create your team! </h1>
        <input class="view_team_button" type="submit" value="View Team" onclick="window.location='./team_view.html'">
    </div>

    <div class="sections">

        <!-- display images of selected pokemon and their names to the left of the page -->
        <div class="selected_poke_block" id="selected_poke">
            <h2 class="selected_poke_text">Selected pokemon</h2>
            <!-- selected pokemon images appear below -->

        </div>
        
        <!-- elements for searching/filtering for pokemon -->
        <div class="right_section">
            <div class="filtering_block">
                
                <!-- search by pokemon name -->
                <div class="search_block">
                    <div class="pokemon_name_search">
                        <!-- autocomplete: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_autocomplete -->
                        <form action="searchpokemon.php" method="post">
                                
                            
                        <div class="autocomplete">
                            <input id="pokemon_name" type="text" placeholder="Pokemon name" name="pokename">
                            <input type="submit">
                        </div>
                        </form>
                        <script>
                            autocomplete(document.getElementById("pokemon_name"), countries);
                        </script>
                    </div>
                </div>

                <!-- filter by type -->
                <div class="type_search">
                    <!-- primary type -->
                    <select> 
                        <option value="primary_type" selected>Primary Type</option>
                        <option value="bug">Bug</option>
                        <option value="dragon">Dragon</option>
                        <option value="electric">Electric</option>
                        <option value="fighting">Fighting</option>
                        <option value="fire">Fire</option>
                        <option value="flying">Flying</option>
                        <option value="ghost">Ghost</option>
                        <option value="grass">Grass</option>
                        <option value="ground">Ground</option>
                        <option value="ice">Ice</option>
                        <option value="normal">Normal</option>
                        <option value="poison">Poison</option>
                        <option value="rock">Rock</option>
                        <option value="water">Water</option>
                    </select>
                    <!-- secondary type -->
                    <select> 
                        <option value="secondary_type" selected>Secondary Type</option>
                        <option value="bug">Bug</option>
                        <option value="dragon">Dragon</option>
                        <option value="electric">Electric</option>
                        <option value="fighting">Fighting</option>
                        <option value="fire">Fire</option>
                        <option value="flying">Flying</option>
                        <option value="ghost">Ghost</option>
                        <option value="grass">Grass</option>
                        <option value="ground">Ground</option>
                        <option value="ice">Ice</option>
                        <option value="normal">Normal</option>
                        <option value="poison">Poison</option>
                        <option value="psychic">Psychic</option>
                        <option value="rock">Rock</option>
                        <option value="water">Water</option>
                    </select>
                </div>

                <!-- weak/strong against is 5x5 selection button area -->
                <div class="weak_strong_against_block">
                    
                    <div class="weak_against_block">
                        <p>Types weak against</p>
                        <div class="weak_against_row">
                            <input type="submit" value="bug">
                            <input type="submit" value="dragon">
                            <input type="submit" value="electric">
                            <input type="submit" value="fighting">
                            <input type="submit" value="fire">
                        </div>
                        <div class="weak_against_row">
                            <input type="submit" value="flying">
                            <input type="submit" value="ghost">
                            <input type="submit" value="grass">
                            <input type="submit" value="ground">
                            <input type="submit" value="ice">
                        </div>
                        <div class="weak_against_row">
                            <input type="submit" value="normal">
                            <input type="submit" value="poison">
                            <input type="submit" value="psychic">
                            <input type="submit" value="rock">
                            <input type="submit" value="water">
                        </div>
                        
                    </div>

                    <div class="strong_against_block">
                        <p>Types strong against</p>
                        <div class="strong_against_row">
                            <input type="submit" value="bug">
                            <input type="submit" value="dragon">
                            <input type="submit" value="electric">
                            <input type="submit" value="fighting">
                            <input type="submit" value="fire">
                        </div>
                        <div class="strong_against_row">
                            <input type="submit" value="flying">
                            <input type="submit" value="ghost">
                            <input type="submit" value="grass">
                            <input type="submit" value="ground">
                            <input type="submit" value="ice">
                        </div>
                        <div class="strong_against_row">
                            <input type="submit" value="normal">
                            <input type="submit" value="poison">
                            <input type="submit" value="psychic">
                            <input type="submit" value="rock">
                            <input type="submit" value="water">
                        </div>
                        
                    </div>

                </div>

                <!-- for filtering by min value, use slider -->
                <!-- min: attack, defense, hp, special attack, special defense, speed -->
                <div class="min_values">
                    <p class="min_values_text">Minimum values</p>
                    <div class="slider_row">
                        <div class="individual_slider_block">
                            <p class="slider_text">Attack</p>
                            <input type="range" title="testing">
                        </div>
                        <div class="individual_slider_block">
                            <p class="slider_text">Defense</p>
                            <input type="range" title="testing">
                        </div>
                        <div class="individual_slider_block">
                            <p class="slider_text">HP</p>
                            <input type="range" title="testing">
                        </div>
                    </div>
                    <div class="slider_row">
                        <div class="individual_slider_block">
                            <p class="slider_text">Sp. Attack</p>
                            <input type="range" title="testing">
                        </div>
                        <div class="individual_slider_block">
                            <p class="slider_text">Sp. Defense</p>
                            <input type="range" title="testing">
                        </div>
                        <div class="individual_slider_block">
                            <p class="slider_text">Speed</p>
                            <input type="range" title="testing">
                        </div>
                    </div>

                </div>




            </div>
             <!-- display results of search in horizontal scrollbox at bottom of page -->
            <div class="results_block"> 
                <!-- <a onclick="document.getElementById('first').style.width='10px'"><img class=selected_poke_im id="first" src="./images/ditto.png"></a> -->

                <?php
                    //SOME PHP CODE
                    $res = $mysqli->query("SELECT * FROM Filtered");
                    while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <img class="selected_poke_img" onclick="selectPoke(this)" src="./images/<?php echo $row['Name'] ?>.png">
                <?php } ?>
                <!-- <img class=selected_poke_img onclick="selectPoke(this)" src="./images/ditto.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/dragonite.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/mew.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/pikachu.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/vaporeon.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png">
                <img class=selected_poke_img src="./images/ditto.png"> -->
            </div>
        </div>
    </div>    
    <script>
        
        function selectPoke(img) {
            const numSelectedPoke = document.getElementById("selected_poke").children.length;
            // const numSelectedPoke = document.querySelectorAll(".selected_poke_block").children.length;
            if (numSelectedPoke > 6) {
                alert("Cannot select any more pokemon (max 6)!");
                return;
            }

            const clone = img.cloneNode(true);
            // set clone's onclick to remove itself from the selected pokemon when its clicked
            clone.onclick = function() { deselectPoke(clone); }
            document.getElementById("selected_poke").appendChild(clone);
        } 
        function deselectPoke(img) {
            img.remove();
        }
    </script>
</body>
</html>
<?php 
$mysqli->close(); ?>
