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
            <?php
                    $res = $mysqli->query("SELECT DISTINCT LOWER(Name) FROM Pokemon_In_Team, Pokemon WHERE Player_Name='" . $_SESSION['user'] . "' AND Pokemon_ID=ID AND ID>0");
                    while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <img class="selected_poke_img" onclick="window.location='./deletepoke.php?id=<?php echo $row['LOWER(Name)']?>'" src="./images/<?php echo $row['LOWER(Name)'] ?>.png">
                <?php } ?>

        </div>
        
        <!-- elements for searching/filtering for pokemon -->
        <div class="right_section">
            <div class="filtering_block">
                <form action="searchpokemon.php" method="post">
                <!-- search by pokemon name -->
                <div class="search_block">
                    <div class="pokemon_name_search">
                        <!-- autocomplete: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_autocomplete -->
                        
                                
                            
                        <div class="autocomplete">
                            <input id="pokemon_name" type="text" placeholder="Pokemon name" name="pokename" value="<?php echo isset($_SESSION['form_data']['pokename']) ? $_SESSION['form_data']['pokename'] : ''; ?>"> 
                            <input type="submit">
                        </div>
                        
                        <script>
                            autocomplete(document.getElementById("pokemon_name"), countries);
                        </script>
                    </div>
                </div>

                <!-- filter by type -->
                <div class="type_search">
                    <!-- primary type -->
                    <select name="primary_type"> 
                        <option value="primary_type" <?php echo ($_SESSION['form_data']['primary_type'] == 'primary_type' || !isset($_SESSION['form_data']['primary_type'])) ? 'selected' : ''; ?>>Primary Type</option>
                        <option value="Bug" <?php echo $_SESSION['form_data']['primary_type'] == 'Bug' ? 'selected' : ''; ?>>Bug</option>
                        <option value="Dragon" <?php echo $_SESSION['form_data']['primary_type'] == 'Dragon' ? 'selected' : ''; ?>>Dragon</option>
                        <option value="Electric" <?php echo $_SESSION['form_data']['primary_type'] == 'Electric' ? 'selected' : ''; ?>>Electric</option>
                        <option value="Fighting" <?php echo $_SESSION['form_data']['primary_type'] == 'Fighting' ? 'selected' : ''; ?>>Fighting</option>
                        <option value="Fire" <?php echo $_SESSION['form_data']['primary_type'] == 'Fire' ? 'selected' : ''; ?>>Fire</option>
                        <option value="Flying" <?php echo $_SESSION['form_data']['primary_type'] == 'Flying' ? 'selected' : ''; ?>>Flying</option>
                        <option value="Ghost" <?php echo $_SESSION['form_data']['primary_type'] == 'Ghost' ? 'selected' : ''; ?>>Ghost</option>
                        <option value="Grass" <?php echo $_SESSION['form_data']['primary_type'] == 'Grass' ? 'selected' : ''; ?>>Grass</option>
                        <option value="Ground" <?php echo $_SESSION['form_data']['primary_type'] == 'Ground' ? 'selected' : ''; ?>>Ground</option>
                        <option value="Ice" <?php echo $_SESSION['form_data']['primary_type'] == 'Ice' ? 'selected' : ''; ?>>Ice</option>
                        <option value="Normal" <?php echo $_SESSION['form_data']['primary_type'] == 'Normal' ? 'selected' : ''; ?>>Normal</option>
                        <option value="Poison" <?php echo $_SESSION['form_data']['primary_type'] == 'Poison' ? 'selected' : ''; ?>>Poison</option>
                        <option value="Psychic" <?php echo $_SESSION['form_data']['primary_type'] == 'Psychic' ? 'selected' : ''; ?>>Psychic</option>
                        <option value="Rock" <?php echo $_SESSION['form_data']['primary_type'] == 'Rock' ? 'selected' : ''; ?>>Rock</option>
                        <option value="Water" <?php echo $_SESSION['form_data']['primary_type'] == 'Water' ? 'selected' : ''; ?>>Water</option>
                    </select>
                    <!-- secondary type -->
                    <select name="secondary_type"> 
                        <option value="secondary_type" <?php echo ($_SESSION['form_data']['secondary_type'] == 'secondary_type' || !isset($_SESSION['form_data']['secondary_type'])) ? 'selected' : ''; ?>>Secondary Type</option>
                        <option value="Bug" <?php echo $_SESSION['form_data']['secondary_type'] == 'Bug' ? 'selected' : ''; ?>>Bug</option>
                        <option value="Dragon" <?php echo $_SESSION['form_data']['secondary_type'] == 'Dragon' ? 'selected' : ''; ?>>Dragon</option>
                        <option value="Electric" <?php echo $_SESSION['form_data']['secondary_type'] == 'Electric' ? 'selected' : ''; ?>>Electric</option>
                        <option value="Fighting" <?php echo $_SESSION['form_data']['secondary_type'] == 'Fighting' ? 'selected' : ''; ?>>Fighting</option>
                        <option value="Fire" <?php echo $_SESSION['form_data']['secondary_type'] == 'Fire' ? 'selected' : ''; ?>>Fire</option>
                        <option value="Flying" <?php echo $_SESSION['form_data']['secondary_type'] == 'Flying' ? 'selected' : ''; ?>>Flying</option>
                        <option value="Ghost" <?php echo $_SESSION['form_data']['secondary_type'] == 'Ghost' ? 'selected' : ''; ?>>Ghost</option>
                        <option value="Grass" <?php echo $_SESSION['form_data']['secondary_type'] == 'Grass' ? 'selected' : ''; ?>>Grass</option>
                        <option value="Ground" <?php echo $_SESSION['form_data']['secondary_type'] == 'Ground' ? 'selected' : ''; ?>>Ground</option>
                        <option value="Ice" <?php echo $_SESSION['form_data']['secondary_type'] == 'Ice' ? 'selected' : ''; ?>>Ice</option>
                        <option value="Normal" <?php echo $_SESSION['form_data']['secondary_type'] == 'Normal' ? 'selected' : ''; ?>>Normal</option>
                        <option value="Poison" <?php echo $_SESSION['form_data']['secondary_type'] == 'Poison' ? 'selected' : ''; ?>>Poison</option>
                        <option value="Psychic" <?php echo $_SESSION['form_data']['secondary_type'] == 'Psychic' ? 'selected' : ''; ?>>Psychic</option>
                        <option value="Rock" <?php echo $_SESSION['form_data']['secondary_type'] == 'Rock' ? 'selected' : ''; ?>>Rock</option>
                        <option value="Water" <?php echo $_SESSION['form_data']['secondary_type'] == 'Water' ? 'selected' : ''; ?>>Water</option>
                    </select>
                </div>

                <!-- weak/strong against is 5x5 selection button area -->
                <div class="weak_strong_against_block">
                    
                    <div class="weak_against_block">
                        <p>Types weak against</p>
                        <div class="weak_against_row">
                            <input type="checkbox" name="weakness[]" id="Bug" value="Bug" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Bug', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Bug">Bug</label>
                            <input type="checkbox" name="weakness[]" id="Dragon" value="Dragon" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Dragon', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Dragon">Dragon</label>
                            <input type="checkbox" name="weakness[]" id="Electric" value="Electric" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Electric', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Electric">Electric</label>
                            <input type="checkbox" name="weakness[]" id="Fighting" value="Fighting" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fighting', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Fighting">Fighting</label>
                            <input type="checkbox" name="weakness[]" id="Fire" value="Fire" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fire', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Fire">Fire</label>
                        </div>
                        <div class="weak_against_row">
                            <input type="checkbox" name="weakness[]" id="Flying" value="Flying" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Flying', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Flying">Flying</label>
                            <input type="checkbox" name="weakness[]" id="Ghost" value="Ghost" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ghost', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Ghost">Ghost</label>
                            <input type="checkbox" name="weakness[]" id="Grass" value="Grass" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Grass', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Grass">Grass</label>
                            <input type="checkbox" name="weakness[]" id="Ground" value="Ground" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ground', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Ground">Ground</label>
                            <input type="checkbox" name="weakness[]" id="Ice" value="Ice" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ice', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Ice">Ice</label>
                        </div>
                        <div class="weak_against_row">
                            <input type="checkbox" name="weakness[]" id="Normal" value="Normal" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Normal', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Normal">Normal</label>
                            <input type="checkbox" name="weakness[]" id="Poison" value="Poison" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Poison', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Poison">Poison</label>
                            <input type="checkbox" name="weakness[]" id="Psychic" value="Psychic" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Psychic', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Psychic">Psychic</label>
                            <input type="checkbox" name="weakness[]" id="Rock" value="Rock" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Rock', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Rock">Rock</label>
                            <input type="checkbox" name="weakness[]" id="Water" value="Water" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Water', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            <label for="Water">Water</label>
                        </div>


                        
                    </div>

                    <div class="strong_against_block">
                        <p>Types strong against</p>
                        <div class="strong_against_row">
                            <input type="checkbox" name="strength[]" id="Bug" value="Bug" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Bug', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Bug">Bug</label>
                            <input type="checkbox" name="strength[]" id="Dragon" value="Dragon" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Dragon', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Dragon">Dragon</label>
                            <input type="checkbox" name="strength[]" id="Electric" value="Electric" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Electric', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Electric">Electric</label>
                            <input type="checkbox" name="strength[]" id="Fighting" value="Fighting" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Fighting', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Fighting">Fighting</label>
                            <input type="checkbox" name="strength[]" id="Fire" value="Fire" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Fire', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Fire">Fire</label>
                        </div>
                        <div class="strong_against_row">
                            <input type="checkbox" name="strength[]" id="Flying" value="Flying" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Flying', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Flying">Flying</label>
                            <input type="checkbox" name="strength[]" id="Ghost" value="Ghost" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Ghost', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Ghost">Ghost</label>
                            <input type="checkbox" name="strength[]" id="Grass" value="Grass" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Grass', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Grass">Grass</label>
                            <input type="checkbox" name="strength[]" id="Ground" value="Ground" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Ground', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Ground">Ground</label>
                            <input type="checkbox" name="strength[]" id="Ice" value="Ice" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Ice', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Ice">Ice</label>
                        </div>
                        <div class="strong_against_row">
                            <input type="checkbox" name="strength[]" id="Normal" value="Normal" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Normal', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Normal">Normal</label>
                            <input type="checkbox" name="strength[]" id="Poison" value="Poison" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Poison', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Poison">Poison</label>
                            <input type="checkbox" name="strength[]" id="Psychic" value="Psychic" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Psychic', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Psychic">Psychic</label>
                            <input type="checkbox" name="strength[]" id="Rock" value="Rock" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Rock', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Rock">Rock</label>
                            <input type="checkbox" name="strength[]" id="Water" value="Water" <?php echo isset($_SESSION['form_data']['strength']) && in_array('Water', $_SESSION['form_data']['strength']) ? 'checked' : ''; ?>>
                            <label for="Water">Water</label>
                        </div>

                        
                    </div>

                </div>

                <!-- for filtering by min value, use slider -->
                <!-- min: attack, defense, hp, special attack, special defense, speed -->
                <div class="min_values">
                    <div class="slider_row">
                        <div class="individual_slider_block">
                            <!-- attack max = 190 -->
                            <p class="slider_text">Min. Attack: 0</p>
                            <input type="range" name="min_attack" id="min_attack" value=0 max="190" onchange="this.previousSibling.previousSibling.innerHTML='Min. Attack: '+this.value;">
                        </div>
                        <div class="individual_slider_block">
                            <!-- defense max = 250 -->
                            <p class="slider_text">Min. Defense: 0</p>
                            <input type="range" name="min_defense" id="min_defense" value=0 max="250" onchange="this.previousSibling.previousSibling.innerHTML='Min. Defense: '+this.value;">
                        </div>
                        <div class="individual_slider_block">
                            <!-- hp max = 255 -->
                            <p class="slider_text">Min. HP: 0</p>
                            <input type="range" name="min_hp" id="min_hp" value=0 max="255" onchange="this.previousSibling.previousSibling.innerHTML='Min. HP: '+this.value;">
                        </div>
                    </div>
                    <div class="slider_row">
                        <div class="individual_slider_block">
                            <!-- sp attack max = 194 -->
                            <p class="slider_text">Min. Sp. Attack: 0</p>
                            <input type="range" name="min_sp_attack" id="min_sp_attack" value=0 max="194" onchange="this.previousSibling.previousSibling.innerHTML='Min. Sp. Attack: '+this.value;">
                        </div>
                        <div class="individual_slider_block">
                            <!-- sp defense max = 250 -->
                            <p class="slider_text">Min. Sp. Defense: 0</p>
                            <input type="range" name="min_sp_defense" id="min_sp_defense" value=0 max="250" onchange="this.previousSibling.previousSibling.innerHTML='Min. Sp. Defense: '+this.value;">
                        </div>
                        <div class="individual_slider_block">
                            <!-- speed max = 200 -->
                            <p class="slider_text">Min. Speed: 0</p>
                            <input type="range" name="min_speed" id="min_speed" value=0 max="200" onchange="this.previousSibling.previousSibling.innerHTML='Min. Speed: '+this.value;">
                        </div>
                    </div>

                </div>
                </form>



            </div>
             <!-- display results of search in horizontal scrollbox at bottom of page -->
            <div class="results_block"> 
                <!-- <a onclick="document.getElementById('first').style.width='10px'"><img class=selected_poke_im id="first" src="./images/ditto.png"></a> -->

                <?php
                    //SOME PHP CODE
                    $res = $mysqli->query("SELECT * FROM Filtered");
                    while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <img class="selected_poke_img" onclick="window.location='./insertpoke.php?id=<?php echo $row['Name']?>'" src="./images/<?php echo $row['Name'] ?>.png">

                <?php } ?>
                <!-- <img class=selected_poke_img onclick="selectPoke(this)" src="./images/ditto.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/dragonite.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/mew.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/pikachu.png">
                <img class=selected_poke_img onclick="selectPoke(this)" src="./images/vaporeon.png">
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
        function filter(weak) {

        }
        function deselectPoke(img) {
            img.remove();
        }
    </script>
</body>
</html>
<?php 
$mysqli->close(); ?>
