<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="web_effects.js" type="text/javascript"></script>
    <script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    <script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <link rel="shortcut icon" href="favicon.ico" type="favicon/ico">

    <title>Enigmatic Mathematics</title>

</head>
<body>
<?php
require 'navBar.php'; navBarMake();
$action = isset($_POST['action']) ? $_POST['action'] : 'default';
?>

<?php
if ($action == 'default'):
?>
<form action=<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="signUpBox">
    <table>
        <header style="font-family: 'PT Serif', serif; font-size: 1.3em; padding-bottom: 1em;">Sign Up</header>
        <form class="signUpForm">

            <label class="signUpLabel"> <em> First name: </em> </label>
            <input id="firstname" name=firstname class="signUpFormInput" style="float: right;" oninput="checkComplete(id)"> <br> <br>

            <label class="signUpLabel"> <em> Last name: </em> </label>
            <input id="lastname" name=lastname class="signUpFormInput" style="float: right;" oninput="checkComplete(id)"> <br> <br>

            <label class="signUpLabel"> <em> Username: </em> </label>
            <input id="username" name=username class="signUpFormInput" style="float: right;" oninput="checkComplete(id)"> <br> <br>

            <label class="signUpLabel"> <em> Password: </em> </label>
            <input id="password" name=password class="signUpFormInput" style="float: right;" type="password" oninput="checkPass()"> <br> <br>

            <label class="signUpLabel"> <em> Confirm password: </em> </label>
            <input id="checkpass" name="checkpass" class="signUpFormInput" style="float: right;" type="password" oninput="checkMatch()"> <br> <br>

            <label class="signUpLabel"> <em> E-Mail: </em> </label>
            <input id="email" name=email class="signUpFormInput" style="float: right;" oninput="checkMail()"> <br> <br>

            <label class="signUpLabel"> <em> Birthdate (YYYY-MM-DD): </em> </label>
            <input id="birthdate" name=birthdate class="signUpFormInput" style="float: right;" oninput="checkDate()"> <br> <br>

            <label name=country class="signUpLabel"> <em> Country: </em> </label>
            <select name="country" onchange="countryChanged(this);" class="signUpFormInput" id="countrySelect" style="float: right; width: 136px; background-color: white;">
                <option value="US" id="USOption">United States</option>
                <option value="AF">Afghanistan</option>
                <option value="AX">Åland Islands</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AS">American Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AQ">Antarctica</option>
                <option value="AG">Antigua and Barbuda</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BY">Belarus</option>
                <option value="BE">Belgium</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia, Plurinational State of</option>
                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                <option value="BA">Bosnia and Herzegovina</option>
                <option value="BW">Botswana</option>
                <option value="BV">Bouvet Island</option>
                <option value="BR">Brazil</option>
                <option value="IO">British Indian Ocean Territory</option>
                <option value="BN">Brunei Darussalam</option>
                <option value="BG">Bulgaria</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodia</option>
                <option value="CM">Cameroon</option>
                <option value="CA">Canada</option>
                <option value="CV">Cape Verde</option>
                <option value="KY">Cayman Islands</option>
                <option value="CF">Central African Republic</option>
                <option value="TD">Chad</option>
                <option value="CL">Chile</option>
                <option value="CN">China</option>
                <option value="CX">Christmas Island</option>
                <option value="CC">Cocos (Keeling) Islands</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoros</option>
                <option value="CG">Congo</option>
                <option value="CD">Congo, the Democratic Republic of the</option>
                <option value="CK">Cook Islands</option>
                <option value="CR">Costa Rica</option>
                <option value="CI">Côte d'Ivoire</option>
                <option value="HR">Croatia</option>
                <option value="CU">Cuba</option>
                <option value="CW">Curaçao</option>
                <option value="CY">Cyprus</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="GQ">Equatorial Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estonia</option>
                <option value="ET">Ethiopia</option>
                <option value="FK">Falkland Islands (Malvinas)</option>
                <option value="FO">Faroe Islands</option>
                <option value="FJ">Fiji</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="GF">French Guiana</option>
                <option value="PF">French Polynesia</option>
                <option value="TF">French Southern Territories</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgia</option>
                <option value="DE">Germany</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GR">Greece</option>
                <option value="GL">Greenland</option>
                <option value="GD">Grenada</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GG">Guernsey</option>
                <option value="GN">Guinea</option>
                <option value="GW">Guinea-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Haiti</option>
                <option value="HM">Heard Island and McDonald Islands</option>
                <option value="VA">Holy See (Vatican City State)</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IS">Iceland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IR">Iran, Islamic Republic of</option>
                <option value="IQ">Iraq</option>
                <option value="IE">Ireland</option>
                <option value="IM">Isle of Man</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="JE">Jersey</option>
                <option value="JO">Jordan</option>
                <option value="KZ">Kazakhstan</option>
                <option value="KE">Kenya</option>
                <option value="KI">Kiribati</option>
                <option value="KP">Korea, Democratic People's Republic of</option>
                <option value="KR">Korea, Republic of</option>
                <option value="KW">Kuwait</option>
                <option value="KG">Kyrgyzstan</option>
                <option value="LA">Lao People's Democratic Republic</option>
                <option value="LV">Latvia</option>
                <option value="LB">Lebanon</option>
                <option value="LS">Lesotho</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libya</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Lithuania</option>
                <option value="LU">Luxembourg</option>
                <option value="MO">Macao</option>
                <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                <option value="MG">Madagascar</option>
                <option value="MW">Malawi</option>
                <option value="MY">Malaysia</option>
                <option value="MV">Maldives</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="MH">Marshall Islands</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritania</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia, Federated States of</option>
                <option value="MD">Moldova, Republic of</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongolia</option>
                <option value="ME">Montenegro</option>
                <option value="MS">Montserrat</option>
                <option value="MA">Morocco</option>
                <option value="MZ">Mozambique</option>
                <option value="MM">Myanmar</option>
                <option value="NA">Namibia</option>
                <option value="NR">Nauru</option>
                <option value="NP">Nepal</option>
                <option value="NL">Netherlands</option>
                <option value="NC">New Caledonia</option>
                <option value="NZ">New Zealand</option>
                <option value="NI">Nicaragua</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NU">Niue</option>
                <option value="NF">Norfolk Island</option>
                <option value="MP">Northern Mariana Islands</option>
                <option value="NO">Norway</option>
                <option value="OM">Oman</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PS">Palestinian Territory, Occupied</option>
                <option value="PA">Panama</option>
                <option value="PG">Papua New Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PN">Pitcairn</option>
                <option value="PL">Poland</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">Réunion</option>
                <option value="RO">Romania</option>
                <option value="RU">Russian Federation</option>
                <option value="RW">Rwanda</option>
                <option value="BL">Saint Barthélemy</option>
                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                <option value="KN">Saint Kitts and Nevis</option>
                <option value="LC">Saint Lucia</option>
                <option value="MF">Saint Martin (French part)</option>
                <option value="PM">Saint Pierre and Miquelon</option>
                <option value="VC">Saint Vincent and the Grenadines</option>
                <option value="WS">Samoa</option>
                <option value="SM">San Marino</option>
                <option value="ST">Sao Tome and Principe</option>
                <option value="SA">Saudi Arabia</option>
                <option value="SN">Senegal</option>
                <option value="RS">Serbia</option>
                <option value="SC">Seychelles</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SX">Sint Maarten (Dutch part)</option>
                <option value="SK">Slovakia</option>
                <option value="SI">Slovenia</option>
                <option value="SB">Solomon Islands</option>
                <option value="SO">Somalia</option>
                <option value="ZA">South Africa</option>
                <option value="GS">South Georgia and the South Sandwich Islands</option>
                <option value="SS">South Sudan</option>
                <option value="ES">Spain</option>
                <option value="LK">Sri Lanka</option>
                <option value="SD">Sudan</option>
                <option value="SR">Suriname</option>
                <option value="SJ">Svalbard and Jan Mayen</option>
                <option value="SZ">Swaziland</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="SY">Syrian Arab Republic</option>
                <option value="TW">Taiwan, Province of China</option>
                <option value="TJ">Tajikistan</option>
                <option value="TZ">Tanzania, United Republic of</option>
                <option value="TH">Thailand</option>
                <option value="TL">Timor-Leste</option>
                <option value="TG">Togo</option>
                <option value="TK">Tokelau</option>
                <option value="TO">Tonga</option>
                <option value="TT">Trinidad and Tobago</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks and Caicos Islands</option>
                <option value="TV">Tuvalu</option>
                <option value="UG">Uganda</option>
                <option value="UA">Ukraine</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="UM">United States Minor Outlying Islands</option>
                <option value="UY">Uruguay</option>
                <option value="UZ">Uzbekistan</option>
                <option value="VU">Vanuatu</option>
                <option value="VE">Venezuela, Bolivarian Republic of</option>
                <option value="VN">Viet Nam</option>
                <option value="VG">Virgin Islands, British</option>
                <option value="VI">Virgin Islands, U.S.</option>
                <option value="WF">Wallis and Futuna</option>
                <option value="EH">Western Sahara</option>
                <option value="YE">Yemen</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
            </select> <br> <br>

            <label class="signUpLabel" id="stateDropLabel"> <em> State: </em> </label>
            <select name="state" class="signUpFormInput_state" id="stateDrop">
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
            <br>
            <div class="captchaWrap">
                <div class="g-recaptcha" data-sitekey="6Le7QgcUAAAAAOQbqB3vwQ7yq1YN1Pk3Hl_g0hb8"></div>
            </div>
        </form>
        </form>
        </form> <br>
    </table>
    <input type="hidden" name="action" value="step2">
    <button id="submit" class="logInButton" disabled>Submit</button>
    <script>
        var check_complete = {"firstname": 0, "lastname": 0, "username": 0, "password": 0, "checkpass": 0, "email": 0, "birthdate": 0};
        function checkSubmit(){
            var submitBtn = document.getElementById("submit");
            var button = 1;
            for (var element in check_complete){
                if (!check_complete[element]){
                    button = 0;
                }
            }
            if (button){
                submitBtn.disabled = false;
            }
            else {
                submitBtn.disabled = true;
            }
        }
        function checkComplete(id){
            var name = document.getElementById(id);
            if (!name.value) {
                name.style.borderColor = "red";
                check_complete[id] = 0;
            }
            else {
                name.style.borderColor = "green";
                check_complete[id] = 1;
            }
        checkSubmit();
        }
        function checkPass(){
            var score = 0;
            var pass_box = document.getElementById("password");
            var password = document.getElementById("password").value;
            try {
                var special = (password.match(/[@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g)).length;
            }
            catch(e) {
                special = 0;
            }
            var upper = password.replace(/[^A-Z]/g, "").length;
            var numbers = password.replace(/[^0-9]/g,"").length;
            var lower = password.length - upper - numbers - special;
            if (password.length < 5) {
                score += 5;
            }
            else if (password.length < 7 && password.length >= 5) {
                score += 10;
            }
            else if (password.length >= 7 && password.length < 9) {
                score += 15;
            }
            else {
                score += 20;
            }
            if (upper > 0 ^ lower > 0){
                score += 10
            }
            else if (upper > 0 && lower > 0) {
                score += 20
            }
            if (numbers > 1 && numbers < 3){
                score += 5
            }
            else if (numbers >= 3){
                score += 10
            }
            if (special == 1){
                score += 10
            }
            else if (special > 1){
                score += 20
            }
            if (score > 40){
                pass_box.style.borderColor = "green";
                check_complete["password"] = 1;
            }
            else {
                pass_box.style.borderColor = "red";
                check_complete["password"] = 0;
            }
        checkSubmit()
        }
        function checkMatch() {
            var pw = document.getElementById("password").value;
            var check_box = document.getElementById("checkpass");
            var check = check_box.value;
            if (pw === check){
                check_box.style.borderColor = "green";
                check_complete["checkpass"] = 1;
            }
            else {
                check_box.style.borderColor = "red";
                check_complete["checkpass"] = 0;
            }
        checkSubmit()
        }
        function checkMail() {
            var email_box = document.getElementById("email");
            var email = email_box.value;
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (re.test(email)){
                email_box.style.borderColor = "green";
                check_complete["email"] = 1;
            }
            else {
                email_box.style.borderColor = "red";
                check_complete["email"] = 0;
            }
        checkSubmit()
        }
        function checkDate(){
            var date_box = document.getElementById("birthdate");
            var birthdate = date_box.value;
            var re = /^\d{4}-\d{2}-\d{2}$/;
            if (birthdate.match(re)){
                date_box.style.borderColor = "green";
                check_complete["birthdate"] = 1;
            }
            else {
                date_box.style.borderColor = "red";
                check_complete["birthdate"] = 0;
            }
        checkSubmit();
        }
    </script>
</div>

    <?php
endif;
?>

<?php
if ($action == 'step2'):
    $config_array = parse_ini_file("/privateconfig/webconfig.ini");
    $captcha_response = $_POST['g-recaptcha-response'];
    $google_secret = $config_array['google_secret'];
    $remote_ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$google_secret."&response=".$captcha_response."&remoteip=".$remote_ip);
    $responseKeys = json_decode($response,true);
    if(intval($responseKeys["success"]) !== 1) {
        foreach ($_POST as $key => $value) {
            if (!$value):
                echo "Please enter something into all fields.";
                break;
            endif;
        }
        if ($_POST['password'] != $_POST['checkpass']):
            echo 'Your passwords don\'t match. Please try again.';
        else:
            $username = isset($_POST['username']) ? $_POST['username'] : 0;
            try {
                $db_username = $config_array['mySQL_username'];
                $db_password = $config_array['mySQL_password'];
                $db = new PDO("mysql:host=localhost;dbname=TEST;charset=utf8", $db_username, $db_password, []);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                echo "Error connecting to mysql";
            }
            $stmt = $db->prepare("SELECT * FROM USERS WHERE username = :username");
            $stmt->bindValue(":username", $username);
            $response = $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($response)):
                echo 'That username is already taken';
            else:
                $stmt = $db->prepare("INSERT INTO USERS (firstname, lastname, username, password, email, birthdate, country, state) VALUES (:firstname, :lastname, :username, :pass, :email, :birthdate, :country, :state)");
                $stmt->bindValue(":firstname", $_POST['firstname']);
                $stmt->bindValue(":lastname", $_POST['lastname']);
                $stmt->bindValue(":username", $_POST['username']);
                $stmt->bindValue(":pass", password_hash($_POST['password'], PASSWORD_DEFAULT));
                $stmt->bindValue(":email", $_POST['email']);
                $stmt->bindValue(":birthdate", $_POST['age']);
                $stmt->bindValue(":country", $_POST['country']);
                $stmt->bindValue(":state", $_POST['state']);
                if ($response = $stmt->execute()) {
                    echo "Account successfully created.";
                } else {
                    echo "Internal error- please try again later.";
                }
            endif;
        endif;
    }
    else{
        echo "Error- possibility of spam detected.";
    }
    ?>

<?php
endif;
?>

</body>
