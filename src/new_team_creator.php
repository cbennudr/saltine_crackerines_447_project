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
    <!-- <link rel="stylesheet" href="styles/creator_styles.css">
    <link rel="stylesheet" href="styles/creator_styles_autocomplete.css">
    <link rel="stylesheet" href="styles/creator_styles_filtering.css">
    <link rel="stylesheet" href="styles/creator_styles_results.css">
    <link rel="stylesheet" href="styles/creator_styles_min_values.css"> -->
    <link rel="stylesheet" href="http://saltine.wuaze.com/styles/creator_styles.css?v=<? echo time(); ?>">
    <link rel="stylesheet" href="http://saltine.wuaze.com/styles/creator_styles_filtering.css?v=<? echo time(); ?>">
    <link rel="stylesheet" href="http://saltine.wuaze.com/styles/creator_styles_autocomplete.css?v=<? echo time(); ?>">
    <link rel="stylesheet" href="http://saltine.wuaze.com/styles/creator_styles_results.css?v=<? echo time(); ?>">
    <link rel="stylesheet" href="http://saltine.wuaze.com/styles/creator_styles_min_values.css?v=<? echo time(); ?>">
    <script src="./js/autocomplete.js"></script>
</head>
<body>
    <div class="header_bar">
        <!-- back button -->
        <input class="back_button" type="submit" value="Back" onclick="window.location='./home.html'">
        <!-- header text -->
        <h1 class="title_text"> Create your team! </h1>
        <input class="view_team_button" type="submit" value="View Team" onclick="window.location=getSelectedPokeURL();">
        <script>
            function getSelectedPokeURL(){
                var retStr = './team_view.html?';
                var selectedPokeBlockChildren = document.getElementById("selected_poke").children;
                var curPoke;
                for (var i=1; i < selectedPokeBlockChildren.length; i++) {
                    curPoke = selectedPokeBlockChildren[i].src.split('/').slice(-1)[0].split('.')[0];
                    if (i==1){ retStr = retStr+i+'='+curPoke; }
                    else {
                        retStr = retStr+'&'+i+'='+curPoke;
                    }
                }
                return retStr;   
            }
        </script>
    </div>

    <div class="sections">

        <!-- display images of selected pokemon and their names to the left of the page -->
        <div class="selected_poke_block" id="selected_poke">
            <p class="selected_poke_text">Selected pokemon</p>
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
            <!-- <div class="filtering_block"> -->
                <form class="filtering_block" action="searchpokemon.php" method="POST">
                    <!-- search by pokemon name -->
                    <!-- <div class="search_block">
                        <div class="pokemon_name_search"> -->
                            <!-- autocomplete: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_autocomplete -->
                            <!-- <div class="autocomplete">
                                <input class="pokemon_name_search" id="pokemon_name" type="text" name="pokename" placeholder="Pokemon name" value="<?php echo isset($_SESSION['form_data']['pokename']) ? $_SESSION['form_data']['pokename'] : ''; ?>">
                            </div>
                            <script>
                                autocomplete(document.getElementById("pokemon_name"), countries);
                            </script>
                        </div>
                    </div> -->

                    <!-- filter by type -->
                    <div class="name_type_search">
                        <div class="pokemon_name_search">
                            <!-- autocomplete: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_autocomplete -->
                            <div class="autocomplete">
                                <input class="pokemon_name_search" id="pokemon_name" type="text" name="pokename" placeholder="Pokemon name" value="<?php echo isset($_SESSION['form_data']['pokename']) ? $_SESSION['form_data']['pokename'] : ''; ?>">
                            </div>
                            <script>
                                autocomplete(document.getElementById("pokemon_name"), pokeNames);
                            </script>
                        </div>

                        <!-- primary type -->
                        <select id="primary_type" name="primary_type"> 
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
                        <select id="secondary_type" name="secondary_type"> 
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

                        <script>
                            const selectedColor = 'rgb(0, 0, 0)'; //"#000000";
                            const wDeselectedColor = 'rgb(254, 95, 85)'; //"#FE5F55";
                            const sDeselectedColor = 'rgb(36, 123, 160)';

                            function selectType(button, strong_weak) {
                                if (strong_weak == 'w') { deselectedColor = wDeselectedColor; }
                                else { deselectedColor = sDeselectedColor; }
                                var curCol = getComputedStyle(button)['background-color'];
                                if (curCol == deselectedColor) {
                                    button.style.background = selectedColor;
                                    document.getElementById(strong_weak+button.value).checked = true;
                                } else {
                                    button.style.background = deselectedColor;
                                    document.getElementById(strong_weak+button.value).checked = false;
                                }
                            }

                        </script>
                        
                        <div class="weak_against_block" id="weak_against_block">
                            <div class="hidden_weak_against" style="display: none;">
                                <input type="checkbox" name="weakness[]" id="wBug" value="Bug" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Bug', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wDragon" value="Dragon" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Dragon', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wElectric" value="Electric" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Electric', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wFighting" value="Fighting" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fighting', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wFire" value="Fire" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fire', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>

                                <input type="checkbox" name="weakness[]" id="wFlying" value="Flying" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Flying', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wGhost" value="Ghost" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ghost', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wGrass" value="Grass" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Grass', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wGround" value="Ground" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ground', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wIce" value="Ice" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ice', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>

                                <input type="checkbox" name="weakness[]" id="wNormal" value="Normal" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Normal', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wPoison" value="Poison" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Poison', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wPsychic" value="Psychic" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Psychic', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wRock" value="Rock" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Rock', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="weakness[]" id="wWater" value="Water" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Water', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            </div>

                            <p class="type_text">Types weak against</p>
                            <div class="weak_against_row">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Bug" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Bug', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Dragon" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Dragon', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Electric" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Electric', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Fighting" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fighting', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Fire" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fire', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                            </div>
                            <div class="weak_against_row">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Flying" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Flying', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Ghost" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ghost', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Grass" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Grass', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Ground" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ground', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Ice" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ice', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                            </div>
                            <div class="weak_against_row">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Normal" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Normal', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Poison" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Poison', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Psychic" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Psychic', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Rock" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Rock', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                                <input type="button" class="type_button" onclick="selectType(this, 'w');" value="Water" style="background-color: <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Water', $_SESSION['form_data']['weakness']) ? 'rgb(0, 0, 0)' : 'rgb(254, 95, 85)'; ?>">
                            </div>
                            
                        </div>

                        <div class="strong_against_block" id="strong_against_block">
                            <div class="hidden_strong_against" style="display: none;">
                                <input type="checkbox" name="strength[]" id="sBug" value="Bug" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Bug', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sDragon" value="Dragon" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Dragon', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sElectric" value="Electric" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Electric', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sFighting" value="Fighting" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fighting', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sFire" value="Fire" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Fire', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>

                                <input type="checkbox" name="strength[]" id="sFlying" value="Flying" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Flying', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sGhost" value="Ghost" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ghost', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sGrass" value="Grass" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Grass', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sGround" value="Ground" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ground', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sIce" value="Ice" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Ice', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>

                                <input type="checkbox" name="strength[]" id="sNormal" value="Normal" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Normal', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sPoison" value="Poison" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Poison', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sPsychic" value="Psychic" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Psychic', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sRock" value="Rock" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Rock', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                                <input type="checkbox" name="strength[]" id="sWater" value="Water" <?php echo isset($_SESSION['form_data']['weakness']) && in_array('Water', $_SESSION['form_data']['weakness']) ? 'checked' : ''; ?>>
                            </div>
                            <p class="type_text">Types strong against</p>
                            <div class="strong_against_row">
                                <input type="button" onclick="selectType(this, 's');" value="Bug">
                                <input type="button" onclick="selectType(this, 's');" value="Dragon">
                                <input type="button" onclick="selectType(this, 's');" value="Electric">
                                <input type="button" onclick="selectType(this, 's');" value="Fighting">
                                <input type="button" onclick="selectType(this, 's');" value="Fire">
                            </div>
                            <div class="strong_against_row">
                                <input type="button" onclick="selectType(this, 's');" value="Flying">
                                <input type="button" onclick="selectType(this, 's');" value="Ghost">
                                <input type="button" onclick="selectType(this, 's');" value="Grass">
                                <input type="button" onclick="selectType(this, 's');" value="Ground">
                                <input type="button" onclick="selectType(this, 's');" value="Ice">
                            </div>
                            <div class="strong_against_row">
                                <input type="button" onclick="selectType(this, 's');" value="Normal">
                                <input type="button" onclick="selectType(this, 's');" value="Poison">
                                <input type="button" onclick="selectType(this, 's');" value="Psychic">
                                <input type="button" onclick="selectType(this, 's');" value="Rock">
                                <input type="button" onclick="selectType(this, 's');" value="Water">
                            </div>                            
                        </div>
                    </div>

                    <!-- for filtering by min value, use slider -->
                    <!-- min: attack, defense, hp, special attack, special defense, speed -->
                    <div class="min_values">
                        <div class="slider_row">
                            <div class="individual_slider_block min_attack">
                                <!-- attack max = 190 -->
                                <p class="slider_text">Min. Attack: 0</p>
                                <input type="range" id="min_attack" name="min_attack" value=0 max="190" onchange="this.previousSibling.previousSibling.innerHTML='Min. Attack: '+this.value;">
                            </div>
                            <div class="individual_slider_block min_defense">
                                <!-- defense max = 250 -->
                                <p class="slider_text">Min. Defense: 0</p>
                                <input type="range" id="min_defense" name="min_defense" value=0 max="250" onchange="this.previousSibling.previousSibling.innerHTML='Min. Defense: '+this.value;">
                            </div>
                            <div class="individual_slider_block min_hp">
                                <!-- hp max = 255 -->
                                <p class="slider_text">Min. HP: 0</p>
                                <input type="range" id="min_hp" name="min_hp" value=0 max="255" onchange="this.previousSibling.previousSibling.innerHTML='Min. HP: '+this.value;">
                            </div>
                        </div>
                        <div class="slider_row">
                            <div class="individual_slider_block min_sp_attack">
                                <!-- sp attack max = 194 -->
                                <p class="slider_text">Min. Sp. Attack: 0</p>
                                <input type="range" id="min_sp_attack" name="min_sp_attack" value=0 max="194" onchange="this.previousSibling.previousSibling.innerHTML='Min. Sp. Attack: '+this.value;">
                            </div>
                            <div class="individual_slider_block min_sp_defense">
                                <!-- sp defense max = 250 -->
                                <p class="slider_text">Min. Sp. Defense: 0</p>
                                <input type="range" id="min_sp_defense" name="min_sp_defense" value=0 max="250" onchange="this.previousSibling.previousSibling.innerHTML='Min. Sp. Defense: '+this.value;">
                            </div>
                            <div class="individual_slider_block min_speed">
                                <!-- speed max = 200 -->
                                <p class="slider_text">Min. Speed: 0</p>
                                <input type="range" id="min_speed" name="min_speed" value=0 max="200" onchange="this.previousSibling.previousSibling.innerHTML='Min. Speed: '+this.value;">
                            </div>
                        </div>
                    </div>
                    <div class="search_button_block">
                        <input type="submit" class="search_button" value="Search">
                    </div>
                </form>

                <script>
                    function getInputs() {
                        // pokemon name
                        var pokeName = document.getElementById("pokemon_name").value;
                        console.log("poke name: "+pokeName);

                        // poke types
                        var primaryType = document.getElementById("primary_type").value;
                        console.log("primary type: "+primaryType);
                        var secondaryType = document.getElementById("secondary_type").value;
                        console.log("secondary type: "+secondaryType);

                        // types weak against
                        const weakAgainstTypes = document.getElementById("weak_against_block").children;
                        var weakAgainst = [];
                        for (var i=1; i <= 3; i++) {
                            var row = weakAgainstTypes[i].children;
                            for (var j=0; j < row.length; j++) {
                                var curCol = getComputedStyle(row[j])['background-color'];
                                if (curCol == 'rgb(0, 0, 0)') {
                                    // console.log(row[j].value);
                                    weakAgainst.push(row[j].value)
                                }
                            }
                        }
                        console.log("weak against: "+weakAgainst);
                        // types strong against
                        const strongAgainstTypes = document.getElementById("strong_against_block").children;
                        var strongAgainst = [];
                        for (var i=1; i <= 3; i++) {
                            var row = strongAgainstTypes[i].children;
                            for (var j=0; j < row.length; j++) {
                                var curCol = getComputedStyle(row[j])['background-color'];
                                if (curCol == 'rgb(0, 0, 0)') {
                                    strongAgainst.push(row[j].value)
                                }
                            }
                        }
                        console.log("strong against: "+strongAgainst);

                        // min values
                        var minAttack = document.getElementById("min_attack").value;
                        console.log("min attack: "+minAttack);
                        var minDefense = document.getElementById("min_defense").value;
                        console.log("min defense: "+minDefense);
                        var minHP = document.getElementById("min_hp").value;
                        console.log("min hp: "+minHP);
                        var minSpAttack = document.getElementById("min_sp_attack").value;
                        console.log("min sp attack: ", minSpAttack);
                        var minSpDefense = document.getElementById("min_sp_defense").value;
                        console.log("min sp defense: "+minSpDefense);
                        var minSpeed = document.getElementById("min_speed").value;
                        console.log("min speed: "+minSpeed);

                        // window.location.href = 'http://www.google.com';
                        return false;
                    }
                </script>

            <!-- </div> -->
            <!-- display results of search in horizontal scrollbox at bottom of page -->
            <div class="results_block"> 
                <?php
                    $res = $mysqli->query("SELECT * FROM Filtered");
                    while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <img class="selected_poke_img" onclick="window.location='./insertpoke.php?id=<?php echo $row['Name']?>'" src="./images/<?php echo $row['Name'] ?>.png">
                <?php } ?>
            </div>
        </div>
    </div> 
    <script>
        function selectPoke(img) {
            const numSelectedPoke = document.getElementById("selected_poke").children.length;
            if (numSelectedPoke > 6) {
                alert("Cannot select anymore pokemon (max 6)!");
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
